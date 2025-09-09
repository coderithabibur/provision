<?php
while (function_exists('ob_get_level') && ob_get_level() > 0) { ob_end_clean(); }
header_remove();
header('Content-Type: text/xml; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

require_once __DIR__ . '/config.php';

// --- DB connect ---
$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
  http_response_code(500);
  echo '<?xml version="1.0" encoding="UTF-8"?><error>DB connect error</error>';
  exit;
}
$mysqli->set_charset('utf8mb4');

// --- Helpers ---
$e   = fn($s) => htmlspecialchars((string)$s, ENT_XML1 | ENT_COMPAT, 'UTF-8');
$now = new DateTime('now', new DateTimeZone('UTC'));

// Absolute base URL
$base = rtrim(
  (defined('HTTPS_SERVER') && HTTPS_SERVER ? HTTPS_SERVER :
   (defined('HTTP_SERVER') && HTTP_SERVER ? HTTP_SERVER :
    ('http://' . $_SERVER['HTTP_HOST'] . '/'))),
  '/'
);

// --- OC basics ---
$prefix      = DB_PREFIX;
$store_name  = 'Store';
$lang_id     = 1;
$currency    = 'USD';
$include_out = false;      // include OOS items as "out of stock"
$max_desc    = 5000;       // GMC description limit
$ship_service_default = 'Standard';
$ship_price_default   = 0.00;     // fallback shipping price if nothing else known

// Settings: store name, lang, currency, weight class, country
$config_country_id = null;
$config_weight_class_id = null;

if ($res = $mysqli->query("SELECT `key`,`value` FROM {$prefix}setting WHERE store_id=0 AND `key` IN ('config_name','config_language_id','config_currency','config_country_id','config_weight_class_id')")) {
  while ($row = $res->fetch_assoc()) {
    if ($row['key'] === 'config_name')               $store_name = $row['value'];
    if ($row['key'] === 'config_language_id')        $lang_id    = (int)$row['value'];
    if ($row['key'] === 'config_currency' && !empty($row['value'])) $currency = strtoupper($row['value']);
    if ($row['key'] === 'config_country_id')         $config_country_id = (int)$row['value'];
    if ($row['key'] === 'config_weight_class_id')    $config_weight_class_id = (int)$row['value'];
  }
  $res->free();
}

// Country ISO2 for <g:shipping><g:country>
$store_country_iso2 = '';
if ($config_country_id) {
  if ($r = $mysqli->query("SELECT iso_code_2 FROM {$prefix}country WHERE country_id=".(int)$config_country_id." LIMIT 1")) {
    if ($row = $r->fetch_assoc()) $store_country_iso2 = strtoupper(trim($row['iso_code_2'] ?? ''));
    $r->free();
  }
}

// --- Optional paging (?limit=, ?page=) ---
$limit  = isset($_GET['limit']) ? max(1, min(50000, (int)$_GET['limit'])) : 20000;
$page   = isset($_GET['page'])  ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// --- Google Category attribute id (optional) ---
$google_attr_id = null;
$sqlGoogleAttr = "
  SELECT a.attribute_id
  FROM {$prefix}attribute a
  JOIN {$prefix}attribute_description ad ON ad.attribute_id = a.attribute_id
  WHERE LOWER(ad.name) IN ('google category','google product category')
    AND ad.language_id IN ({$lang_id}, 0)
  LIMIT 1";
if ($r = $mysqli->query($sqlGoogleAttr)) {
  if ($row = $r->fetch_assoc()) $google_attr_id = (int)$row['attribute_id'];
  $r->free();
}

// --- Pull products (add weight + weight_class_id) ---
$sqlProducts = "
SELECT
  p.product_id, p.model, p.sku, p.upc, p.ean, p.jan, p.isbn, p.mpn,
  p.quantity, p.stock_status_id, p.image, p.price, p.tax_class_id, p.status,
  p.weight, p.weight_class_id,
  pd.name AS product_name, pd.description,
  m.name  AS brand
FROM {$prefix}product p
JOIN {$prefix}product_description pd
  ON pd.product_id = p.product_id AND pd.language_id = {$lang_id}
LEFT JOIN {$prefix}manufacturer m
  ON m.manufacturer_id = p.manufacturer_id
WHERE p.status = 1
ORDER BY p.product_id DESC
LIMIT {$offset}, {$limit}";
$products = [];
if ($q = $mysqli->query($sqlProducts)) {
  while ($row = $q->fetch_assoc()) $products[] = $row;
  $q->free();
}

// --- Helper fns ---
$prodUrl = fn($id) => $base . '/index.php?route=product/product&product_id=' . (int)$id;

$imgAbs = function($rel) use ($base) {
  $rel = (string)$rel;
  if ($rel === '') return '';
  if (preg_match('~^https?://~i', $rel)) return $rel;
  $rel = ltrim($rel, '/');
  if (stripos($rel, 'image/') !== 0) $rel = 'image/' . $rel;
  return $base . '/' . $rel;
};

$getAdditionalImages = function($pid) use ($mysqli, $prefix, $imgAbs) {
  $imgs = [];
  $sql = "SELECT image FROM {$prefix}product_image WHERE product_id=".(int)$pid." ORDER BY sort_order ASC, product_image_id ASC";
  if ($r = $mysqli->query($sql)) {
    while ($row = $r->fetch_assoc()) {
      if (!empty($row['image'])) $imgs[] = $imgAbs($row['image']);
    }
    $r->free();
  }
  return $imgs;
};

// Valid special now (by date)
$getSpecial = function($pid) use ($mysqli, $prefix) {
  $sql = "
    SELECT price, date_start, date_end
    FROM {$prefix}product_special
    WHERE product_id=".(int)$pid."
    ORDER BY priority ASC, price ASC
    LIMIT 1";
  if (!($r = $mysqli->query($sql))) return null;
  $row = $r->fetch_assoc();
  $r->free();
  if (!$row) return null;

  $now = new DateTime('now', new DateTimeZone('UTC'));
  $ds = trim((string)($row['date_start'] ?? ''));
  $de = trim((string)($row['date_end']   ?? ''));
  $openStart = ($ds === '' || $ds === '0000-00-00' || $ds === '0000-00-00 00:00:00');
  $openEnd   = ($de === '' || $de === '0000-00-00' || $de === '0000-00-00 00:00:00');

  $startOk = $openStart;
  if (!$openStart) { try { $startOk = (new DateTime($ds, new DateTimeZone('UTC'))) <= $now; } catch (Exception $e) { $startOk = true; } }

  $endOk = $openEnd;
  if (!$openEnd) { try { $endOk = (new DateTime($de, new DateTimeZone('UTC'))) >= $now; } catch (Exception $e) { $endOk = true; } }

  if ($startOk && $endOk) return [ (float)$row['price'], $ds, $de ];
  return null;
};

// Build ALL product_type paths for a product (one tag per path)
$getAllProductTypes = function($pid) use ($mysqli, $prefix, $lang_id) {
  $paths = [];
  $catIds = [];
  if ($r = $mysqli->query("SELECT category_id FROM {$prefix}product_to_category WHERE product_id=".(int)$pid)) {
    while ($row = $r->fetch_assoc()) $catIds[] = (int)$row['category_id'];
    $r->free();
  }
  foreach ($catIds as $cid) {
    // ascend to root
    $chain = [];
    $cur = $cid;
    $guard = 0;
    while ($cur && $guard++ < 25) {
      $q = $mysqli->query("SELECT category_id, parent_id FROM {$prefix}category WHERE category_id=".(int)$cur." LIMIT 1");
      if (!$q) break;
      $row = $q->fetch_assoc();
      $q->free();
      if (!$row) break;
      array_unshift($chain, (int)$row['category_id']);
      $cur = (int)$row['parent_id'];
    }
    if ($chain) {
      // to names
      $names = [];
      foreach ($chain as $cid2) {
        $q2 = $mysqli->query("SELECT name FROM {$prefix}category_description WHERE category_id=".(int)$cid2." AND language_id={$lang_id} LIMIT 1");
        if ($q2 && ($n = $q2->fetch_assoc())) {
          $nm = trim($n['name']);
          if ($nm !== '') $names[] = $nm;
        }
        if ($q2) $q2->free();
      }
      if ($names) $paths[] = implode(' > ', $names);
    }
  }
  // de-dup
  $paths = array_values(array_unique($paths));
  return $paths;
};

// Google product category via attribute; fallback to a category name
$getGoogleCategory = function($pid) use ($mysqli, $prefix, $lang_id, $google_attr_id) {
  if ($google_attr_id) {
    $sql = "
      SELECT text
      FROM {$prefix}product_attribute
      WHERE product_id=".(int)$pid."
        AND attribute_id={$google_attr_id}
        AND language_id IN ({$lang_id}, 0)
      ORDER BY (language_id = {$lang_id}) DESC
      LIMIT 1";
    if ($r = $mysqli->query($sql)) {
      if ($row = $r->fetch_assoc()) {
        $txt = trim(strip_tags(html_entity_decode($row['text'], ENT_QUOTES, 'UTF-8')));
        $r->free();
        if ($txt !== '') return $txt;
      } else { $r->free(); }
    }
  }
  $sql2 = "
    SELECT cd.name
    FROM {$prefix}category_description cd
    INNER JOIN {$prefix}product_to_category pc ON cd.category_id = pc.category_id
    WHERE pc.product_id=".(int)$pid." AND cd.language_id=".(int)$lang_id."
    ORDER BY pc.category_id DESC
    LIMIT 1";
  if ($r2 = $mysqli->query($sql2)) {
    if ($row2 = $r2->fetch_assoc()) {
      $name = trim((string)$row2['name']);
      $r2->free();
      if ($name !== '') return $name;
    } else { $r2->free(); }
  }
  return '';
};

// Reviews (count + average rating)
$getReviewStats = function($pid) use ($mysqli, $prefix) {
  $stats = [0, null];
  $sql = "SELECT COUNT(*) AS c, AVG(rating) AS a FROM {$prefix}review WHERE product_id=".(int)$pid." AND status=1";
  if ($r = $mysqli->query($sql)) {
    if ($row = $r->fetch_assoc()) {
      $stats[0] = (int)$row['c'];
      $stats[1] = $row['a'] !== null ? round((float)$row['a'], 2) : null;
    }
    $r->free();
  }
  return $stats;
};

// Weight to Google-acceptable unit (kg or lb)
$weightUnitCache = []; // weight_class_id => ['unit' => 'kg', 'value' => float]
$getWeightInfo = function($weight_class_id) use ($mysqli, $prefix, &$weightUnitCache) {
  if (!$weight_class_id) return ['unit' => 'kg', 'value' => 1.0, 'label' => 'kg'];
  if (isset($weightUnitCache[$weight_class_id])) return $weightUnitCache[$weight_class_id];

  $row = null;
  $sql = "SELECT w.value, wd.unit
          FROM {$prefix}weight_class w
          JOIN {$prefix}weight_class_description wd ON wd.weight_class_id = w.weight_class_id
          WHERE w.weight_class_id=".(int)$weight_class_id." AND wd.language_id=(SELECT value FROM {$prefix}setting WHERE store_id=0 AND `key`='config_language_id' LIMIT 1)";
  if ($r = $mysqli->query($sql)) { $row = $r->fetch_assoc(); $r->free(); }

  $value = isset($row['value']) ? (float)$row['value'] : 1.0;
  $unit  = strtolower(trim($row['unit'] ?? 'kg'));

  // Normalize to kg/lb only (Google allows both)
  $label = 'kg';
  if (in_array($unit, ['kg', 'kgs'])) { $label = 'kg'; }
  elseif (in_array($unit, ['g', 'gram', 'grams'])) { $label = 'kg'; $value /= 1000.0; }
  elseif (in_array($unit, ['lb', 'lbs', 'pound', 'pounds'])) { $label = 'lb'; }
  elseif (in_array($unit, ['oz', 'ounce', 'ounces'])) { $label = 'lb'; $value /= 16.0; }
  else { $label = 'kg'; } // fallback

  return $weightUnitCache[$weight_class_id] = ['unit' => $unit, 'value' => $value, 'label' => $label];
};

// --- OUTPUT XML (RSS 2.0 + Google namespace) ---
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
  <channel>
    <title><?= $e($store_name) ?></title>
    <link><?= $e($base) ?>/</link>
    <description><?= $e($store_name) ?> - Google Merchant RSS Feed</description>
<?php
foreach ($products as $p):
  $pid   = (int)$p['product_id'];
  $qty   = (int)($p['quantity'] ?? 0);
  if (!$include_out && $qty <= 0) continue;

  $availability = $qty > 0 ? 'in stock' : 'out of stock';

  $name  = (string)$p['product_name'];
  $link  = $prodUrl($pid);

  // Description: strip HTML, condense whitespace, cap at 5000 chars
  $desc  = trim(preg_replace('/\s+/u', ' ', strip_tags(html_entity_decode((string)$p['description'], ENT_QUOTES, 'UTF-8'))));
  if (mb_strlen($desc, 'UTF-8') > $max_desc) $desc = mb_substr($desc, 0, $max_desc - 3, 'UTF-8') . '...';

  // Prices
  $orig_price = (float)$p['price'];
  $special    = $getSpecial($pid); // [price, start, end] or null
  $sale_price = $special ? (float)$special[0] : null;

  $price_str = number_format($orig_price, 2, '.', '') . ' ' . $currency;
  $sale_str  = $sale_price !== null ? (number_format($sale_price, 2, '.', '') . ' ' . $currency) : null;

  // Images
  $main_image = $imgAbs($p['image'] ?? '');
  $add_images = $getAdditionalImages($pid);

  // Brand/MPN/GTIN
  $brand = trim((string)($p['brand'] ?? ''));
  $mpn   = trim((string)($p['mpn']   ?? ''));
  if ($mpn === '') $mpn = trim((string)$p['model']);

  $gtin = '';
  foreach (['ean','upc','isbn','jan'] as $k) { if (!empty($p[$k])) { $gtin = trim((string)$p[$k]); break; } }

  $identifier_exists = ($gtin !== '' || ($brand !== '' && $mpn !== '')) ? 'TRUE' : 'FALSE';

  // Product types (multiple)
  $ptype_paths = $getAllProductTypes($pid);

  // Google product category (optional)
  $gcat  = $getGoogleCategory($pid);

  // Reviews
  [$review_count, $review_avg] = $getReviewStats($pid);

  // Shipping weight
  $w = (float)($p['weight'] ?? 0.0);
  $wc = (int)($p['weight_class_id'] ?? $config_weight_class_id);
  $wi = $getWeightInfo($wc);
  // Convert to chosen Google unit label (kg or lb)
  $weight_out = '';
  if ($w > 0) {
    if ($wi['label'] === 'kg') {
      // if unit was g, wi['value'] already adjusted to kg multiplier
      // In OC weight_class.value typically is a multiplier to base; we keep simple normalization above
      $weight_out = number_format($w * ($wi['label']==='kg' ? 1.0 : 0.45359237), 2, '.', '') . ' kg';
      // Note: for 'lb' label path below we don't hit this branch
    } else {
      // output pounds
      // If store unit was oz we converted to lb via value above; keep simple
      $weight_out = number_format($w * ($wi['label']==='lb' ? 1.0 : 2.20462262), 2, '.', '') . ' lb';
    }
  }

  // Shipping block (use store country if known; price fallback from $ship_price_default)
  $ship_country = $store_country_iso2 ?: 'US';
  $ship_service = $ship_service_default;
  $ship_price   = number_format($ship_price_default, 2, '.', '') . ' ' . $currency;
?>
    <item>
      <g:id><?= $pid.'_au' ?></g:id>
      <g:title><?= $e($name) ?></g:title>
      <g:description><?= $e($desc) ?></g:description>
      <g:link><?= $e($link) ?></g:link>
<?php if ($main_image !== ''): ?>
      <g:image_link><?= $e($main_image) ?></g:image_link>
<?php endif;
      $i = 0; foreach ($add_images as $ai): if (++$i > 10) break; ?>
      <g:additional_image_link><?= $e($ai) ?></g:additional_image_link>
<?php endforeach; ?>
      <g:condition>new</g:condition>
      <g:availability><?= $e($availability) ?></g:availability>
      <g:price><?= $e($price_str) ?></g:price>
<?php if ($sale_str !== null): ?>
      <g:sale_price><?= $e($sale_str) ?></g:sale_price>
<?php endif; ?>
      <g:shipping>
        <g:country><?= $e($ship_country) ?></g:country>
        <g:service><?= $e($ship_service) ?></g:service>
        <g:price><?= $e($ship_price) ?></g:price>
      </g:shipping>
<?php if ($gtin !== ''): ?>
      <g:gtin><?= $e($gtin) ?></g:gtin>
<?php endif; ?>
<?php if ($brand !== ''): ?>
      <g:brand><?= $e($brand) ?></g:brand>
<?php endif; ?>
<?php if ($mpn !== ''): ?>
      <g:mpn><?= $e($mpn) ?></g:mpn>
<?php endif; ?>
      <g:identifier_exists><?= $identifier_exists ?></g:identifier_exists>
<?php if ($gcat !== ''): ?>
      <g:google_product_category><?= $e($gcat) ?></g:google_product_category>
<?php endif; ?>
<?php foreach ($ptype_paths as $pp): ?>
      <g:product_type><?= $e($pp) ?></g:product_type>
<?php endforeach; ?>
<?php if ($weight_out !== ''): ?>
      <g:shipping_weight><?= $e($weight_out) ?></g:shipping_weight>
<?php endif; ?>
<?php if ($review_count > 0): ?>
      <g:product_review_count><?= (int)$review_count ?></g:product_review_count>
<?php if ($review_avg !== null): ?>
      <g:product_review_average><?= $e(number_format((float)$review_avg, 2, '.', '')) ?></g:product_review_average>
<?php endif; ?>
<?php endif; ?>
    </item>
<?php endforeach; ?>
  </channel>
</rss>
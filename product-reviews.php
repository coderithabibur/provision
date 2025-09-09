<?php
while (function_exists('ob_get_level') && ob_get_level() > 0) { ob_end_clean(); }
header_remove();
header('Content-Type: text/xml; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

// -- load OC config for DB_* and HTTP_* constants
require_once __DIR__ . '/config.php';

// -- db connect
$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
  http_response_code(500);
  echo '<?xml version="1.0" encoding="UTF-8"?><error>DB connect error</error>';
  exit;
}
$mysqli->set_charset('utf8mb4');

// -- helpers
$e = fn($s) => htmlspecialchars((string)$s, ENT_XML1 | ENT_COMPAT, 'UTF-8');
$iso = function($dt) {
  try { $t = new DateTime($dt ?: 'now', new DateTimeZone('UTC')); }
  catch (Exception $ex) { $t = new DateTime('now', new DateTimeZone('UTC')); }
  return $t->format('Y-m-d\TH:i:s\Z');
};

// -- basic settings
$prefix    = DB_PREFIX;
$publisher = 'Store';
$lang_id   = 1;
$lang_code = 'en';

// store name + default language id
if ($res = $mysqli->query("SELECT `key`,`value` FROM {$prefix}setting WHERE store_id=0 AND `key` IN ('config_name','config_language_id')")) {
  while ($row = $res->fetch_assoc()) {
    if ($row['key'] === 'config_name')        $publisher = $row['value'];
    if ($row['key'] === 'config_language_id') $lang_id   = (int)$row['value'];
  }
  $res->free();
}
// map language_id -> code (e.g. en-gb -> en)
if ($res = $mysqli->query("SELECT code FROM {$prefix}language WHERE language_id = {$lang_id} LIMIT 1")) {
  if ($row = $res->fetch_assoc()) {
    // Google expects ISO 2-letter; take the part before '-' (en-gb -> en)
    $lang_code = strtolower(preg_replace('~^([a-z]{2}).*$~i', '$1', $row['code'] ?? 'en'));
  }
  $res->free();
}

// optional paging (?limit=, ?page=)
$limit  = isset($_GET['limit']) ? max(1, min(50000, (int)$_GET['limit'])) : 20000;
$page   = isset($_GET['page'])  ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// reviews + product joins
$sql = "
SELECT
  r.review_id, r.product_id, r.customer_id, r.author, r.text, r.rating, r.date_added, r.status,
  p.sku, p.upc, p.ean, p.jan, p.isbn, p.mpn, p.manufacturer_id,
  pd.name AS product_name,
  m.name AS brand
FROM {$prefix}review r
JOIN {$prefix}product p
  ON p.product_id = r.product_id
JOIN {$prefix}product_description pd
  ON pd.product_id = p.product_id
  AND pd.language_id = {$lang_id}
LEFT JOIN {$prefix}manufacturer m
  ON p.manufacturer_id = m.manufacturer_id
WHERE r.status = 1
ORDER BY r.date_added DESC
LIMIT {$offset}, {$limit};";
$rows = [];
if ($q = $mysqli->query($sql)) {
  while ($row = $q->fetch_assoc()) $rows[] = $row;
  $q->free();
}

// base product URL
$base   = rtrim((defined('HTTP_SERVER') ? HTTP_SERVER : ('http://' . $_SERVER['HTTP_HOST'] . '/')), '/');
$prodUrl = fn($id) => $base . '/index.php?route=product/product&product_id=' . (int)$id;

// ---------- OUTPUT XML ----------
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<feed xmlns:vc="http://www.w3.org/2007/XMLSchema-versioning"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="http://www.google.com/shopping/reviews/schema/product/2.4/product_reviews.xsd">
  <version>2.4</version>
 
  <aggregator>
    <name><?= $e($publisher) ?> Aggregator</name>
  </aggregator>

  <publisher>
    <name><?= $e($publisher) ?></name>
  </publisher>

  <reviews>
<?php foreach ($rows as $r):
  $rid     = (int)$r['review_id'];
  $pid     = (int)$r['product_id'];
  $purl    = $prodUrl($pid);

  // reviewer name + id (use customer_id when available)
  $name    = trim((string)$r['author']) !== '' ? $r['author'] : 'Anonymous';
  $isAnon  = ($name === 'Anonymous') ? ' is_anonymous="true"' : '';
  $reviewer_id = (int)$r['customer_id'] > 0 ? (int)$r['customer_id'] : null;

  // text + rating + time
  $text    = trim(strip_tags(html_entity_decode((string)$r['text'], ENT_QUOTES, 'UTF-8')));
  $rating  = number_format((float)$r['rating'], 1, '.', '');
  $ts      = $iso($r['date_added']);

  // product identifiers
  $gtin = '';
  foreach (['ean','upc','isbn','jan'] as $k) { if (!empty($r[$k])) { $gtin = $r[$k]; break; } }
  $mpn   = (string)($r['mpn'] ?? '');
  $sku   = (string)($r['sku'] ?? '');
  $brand = $r['brand'] ?? '';
?>
    <review>
      <review_id><?= $rid ?></review_id>
      <reviewer>
        <name<?= $isAnon ?>><?= $e($name) ?></name>
<?php if ($reviewer_id !== null): ?>
        <reviewer_id><?= $reviewer_id ?></reviewer_id>
<?php endif; ?>
      </reviewer>

      <is_verified_purchase>true</is_verified_purchase>
      <is_incentivized_review>false</is_incentivized_review>

      <review_timestamp><?= $ts ?></review_timestamp>

      <content><?= $e($text) ?></content>

      <review_language><?= $e($lang_code) ?></review_language>


      <review_url type="singleton"><?= $e($purl) ?>#review-<?= $rid ?></review_url>

      <ratings>
        <overall min="1" max="5"><?= $rating ?></overall>
      </ratings>

      <products>
        <product>
          <product_ids>
<?php if ($gtin !== ''): ?>
            <gtins><gtin><?= $e($gtin) ?></gtin></gtins>
<?php endif; if ($mpn !== ''): ?>
            <mpns><mpn><?= $e($mpn) ?></mpn></mpns>
<?php endif; if ($sku !== ''): ?>
            <skus><sku><?= $e($sku) ?></sku></skus>
<?php endif; if ($brand !== ''): ?>
            <brands><brand><?= $brand ?></brand></brands>
<?php endif; ?>

          </product_ids>
<?php if (!empty($r['product_name'])): ?>
          <product_name><?= $e($r['product_name']) ?></product_name>
<?php endif; ?>
          <product_url><?= $e($purl) ?></product_url>
        </product>
      </products>

    </review>
<?php endforeach; ?>
  </reviews>
</feed>

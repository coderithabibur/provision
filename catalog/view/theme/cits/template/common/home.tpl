<?php echo $header; ?>

<?php echo $my_video_section; ?>

<!-- Features -->
<?php echo $feature_section_module; ?>

<section class="buy-one-get-on-free">
  <div class="container">
    <h2><?php echo $data['buy_one_get_one_title']; ?></h2>
    <div class="category-cards">
      <?php foreach ($data['buy_one_get_one_offers'] as $offer) : 
        // Extract numeric value (keeps decimals)
        $price = preg_replace('/[^0-9.]/', '', $offer['price']); 
        $price = (float)$price;

        // Extract currency symbol if present (like $, ৳, etc.)
        $currency = preg_replace('/[0-9.,]/', '', $offer['price']); 

        // Format both prices with 2 decimals
        $original = number_format($price, 2);
        $double   = number_format($price * 2, 2);
      ?>
      <div class="category-card">
        <div class="category-card-content">
          <h3>buy one</h3>
          <h3>get one free</h3>
          <p><?php echo $offer['model']; ?> - Now 50% Savings</p>
          <span>
            <strong><?php echo $currency . $original; ?></strong>
            <del><?php echo $currency . $double; ?></del>
          </span>
          <a href="<?php echo $offer['href']; ?>">buy Now</a>
        </div>
        <div class="single-buy-get-free">
          <div class="buy-get-free-images">
            <a href="<?php echo $offer['href']; ?>"><img src="<?php echo $offer['image']; ?>" alt="<?php echo $offer['name']; ?>"></a>
            <div class="plus-sybol"><p>+</p></div>
            <a href="<?php echo $offer['href']; ?>"><img src="<?php echo $offer['image']; ?>" alt="<?php echo $offer['name']; ?>"></a>
          </div>
          <h2><a href="<?php echo $offer['href']; ?>"><?php echo $offer['name']; ?></a></h2>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- Featured Categories Section -->
<section class="best-seller-area">
  <div class="container">
    <div class="best-seller-title">
      <h2>featured products</h2>
      <?php if ($data['filter_categories']) { ?>
      <ul>
        <?php foreach ($data['filter_categories'] as $key => $category) { ?>
        <li>
          <button class="<?php echo ($key == 0) ? 'active' : ''; ?> category-filter"
            data-categoryid="<?php echo $category['category_id']; ?>">
            <?php echo $category['name']; ?>
          </button>
        </li>
        <?php } ?>
      </ul>
      <?php } ?>
    </div>

    <div class="best-seller-product-grid">
      <?php if ($data['initial_products']) { ?>
      <?php foreach ($data['initial_products'] as $product) { ?>
      <div class="single-product-item">
        <a href="<?php echo $product['href']; ?>">
          <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"
            title="<?php echo $product['name']; ?>">
        </a>
        <div class="single-product-item-info">
          <h2><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>

          <div class="best-sellers-item-price">
            <?php if ($product['special']) { ?>
            <span><?php echo $product['special']; ?></span>
            <del><?php echo $product['price']; ?></del>
            <?php if ($product['save_percent']) { ?>
            <div class="save-price">
              <p>save <?php echo $product['save_percent']; ?>%</p>
            </div>
            <?php } ?>
            <?php } else { ?>
            <span><?php echo $product['price']; ?></span>
            <?php } ?>
          </div>

          <div class="single-product-reviews">
            <ul>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
            </ul>
            <p><?php echo $product['reviews']; ?> reviews</p>
          </div>

          <div class="single-product-btn-group">
            <button type="button" class="add-to-cart-btn" onclick="cart.add('<?php echo $product['product_id']; ?>');">add to cart</button>
            <button type="button" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i
                class="fa-solid fa-code-compare"></i></button>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</section>

<section class="hightlights-area">
  <div class="hightlights-content-area">
    <?php if ($data['highlight_categories']) { ?>
    <?php foreach($data['highlight_categories'] as $category) { ?>
    <div class="single-highlights-item" style="background-image: url('<?php echo $category['image']; ?>');">
      <div class="highlights-item-info">
        <span><?php echo $category['product_total']; ?> products</span>
        <h2><?php echo $category['name']; ?></h2>
      </div>
      <a href="<?php echo $category['href']; ?>">Shop now</a>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
</section>

<!-- Video -->
<section class="video-hero">
  <video autoplay muted loop playsinline class="video-bg">
    <source src="https://cdn.shopify.com/videos/c/o/v/18c2e078311d40b38447d79e0db19bc8.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="video-overlay"></div>
  <div class="video-content">
    <h1><?php echo $data['buy1get1']['name']; ?></h1>
    <p><?php echo $data['buy1get12']['model']; ?></p>
    <a href="<?php echo $data['buy1get1']['href'] ?>">Shop now </a>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function () {
    $('.category-filter').on('click', function (e) {
      e.preventDefault();
      var category_id = $(this).data('categoryid');
      $('.category-filter').removeClass('active');
      $(this).addClass('active');

      $.ajax({
        url: 'index.php?route=common/home/getCategoryProducts&category_id=' + category_id,
        type: 'get',
        dataType: 'html',
        beforeSend: function () {
          $('.best-seller-product-grid').html(
            '<span class="loader"></span>');
        },
        success: function (html) {
          $('.best-seller-product-grid').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    });
  });
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AutoPartsStore",
  "name": "<?php echo addslashes($name); ?>",
  "url": "<?php echo $home; ?>",
  "logo": "<?php echo $logo; ?>",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+61-2-9698-2543",
    "contactType": "Customer Service"
  },
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "PO Box 7180",
    "addressLocality": "Urangan",
    "addressRegion": "QLD",
    "postalCode": "4655",
    "addressCountry": "AU"
  },
  "sameAs": [ 
    "https://www.facebook.com/provisionlights/",
    "https://www.youtube.com/channel/UCZTBBnEykt7tK5amksqmABQ",
    "https://www.instagram.com/pro_vision_led_lighting/"
  ]
}
</script>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "<?php echo HTTPS_SERVER; ?>",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "<?php echo HTTPS_SERVER; ?>index.php?route=product/search&search={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
</script>

<?php if (!empty($initial_products)) { ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Best Selling Products",
    "numberOfItems": <?php echo count($initial_products); ?>,
    "itemListElement": [
      <?php foreach ($initial_products as $i => $product) { ?>
      {
        "@type": "ListItem",
        "position": <?php echo $i + 1; ?>,
        "item": {
          "@type": "Product",
          "name": "<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>",
          "url": "<?php echo htmlspecialchars($product['href'], ENT_QUOTES, 'UTF-8'); ?>",
          "image": "<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>",
          "offers": {
            "@type": "Offer",
            "priceCurrency": "<?php echo htmlspecialchars($this->session->data['currency'], ENT_QUOTES, 'UTF-8'); ?>",
            "price": "<?php echo preg_replace('/[^0-9.]/', '', $product['special'] ? $product['special'] : $product['price']); ?>",
            "availability": "<?php echo ($product['quantity'] > 0) ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'; ?>",
            "url": "<?php echo htmlspecialchars($product['href'], ENT_QUOTES, 'UTF-8'); ?>"
          }
        }
      }<?php if ($i < count($initial_products) - 1) echo ','; ?>
      <?php } ?>
    ]
  }
  </script>
<?php } ?>

<?php if ($review_status) { ?>
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?php echo $rating; ?>",
    "reviewCount": "<?php echo $reviews; ?>"
  },
<?php } ?>



<?php echo $footer; ?>
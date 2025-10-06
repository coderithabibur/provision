<?php echo $header; ?>

<pre>
  <?php // print_r($data['categories']);?>
  <?php // print_r($data['buy1get1']);?>
  <?php // print_r($data['buy1get12']);?>
  <?php // print_r($data['featured_products']);?>
</pre>


<section class="hero-area">
  <div class="hero-slide">
    <video autoplay muted loop playsinline class="slide-video">
      <source src="https://cdn.shopify.com/videos/c/o/v/18c2e078311d40b38447d79e0db19bc8.mp4" type="video/mp4">
    </video>
    <div class="container slide-content">
      <span>NEVER MISS A SALE</span>
      <h1>Rocket Racing Wheels</h1>
      <p>Lorem ipsum dolor sit amet sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <a href="#" class="hero-button">SHOP NOW</a>
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
            <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');">add to cart</button>
            <button type="button" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i
                class="fa-solid fa-code-compare"></i></button>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>

  <!-- Buy One Get One Free -->
  <div class="container category-cards">
    <div class="category-card">
      <div class="category-card-content">
        <h3>buy one</h3>
        <h3>get one free</h3>
        <p><?php echo $data['buy1get1']['model']; ?> - Now 50% Savings</p>
        <span>Total = <strong><?php echo $data['buy1get1']['price']; ?></strong></span>
        <a href="<?php echo $data['buy1get1']['href'] ?>">buy Now</a>
      </div>
      <div class="single-buy-get-free">
        <div class="buy-get-free-images">
          <img src="<?php echo $data['buy1get1']['image']; ?>">
          <div class="plus-sybol">
            <p>+</p>
          </div>
          <img src="<?php echo $data['buy1get1']['image']; ?>">
        </div>
        <h2><a href="<?php echo $data['buy1get1']['href'] ?>"><?php echo $data['buy1get1']['name']; ?></a></h2>
        <div class="best-sellers-item-price">
          <?php if (!empty($data['buy1get12']['special'])) { ?>
          <span><?php echo $data['buy1get12']['special']; ?></span>
          <del><?php echo $data['buy1get12']['price']; ?></del>
          <div class="save-price">
            <p>
              save
              <?php
                    $old = (float) filter_var($data['buy1get12']['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $new = (float) filter_var($data['buy1get12']['special'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                    if ($old > 0 && $new > 0 && $new < $old) {
                        echo round((($old - $new) / $old) * 100) . '%';
                    } else {
                        echo '0%';
                    }
                    ?>
            </p>
          </div>
          <?php } else { ?>
          <span><?php echo $data['buy1get12']['price']; ?></span>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="category-card">
      <div class="category-card-content">
        <h3>buy one</h3>
        <h3>get one free</h3>
        <p><?php echo $data['buy1get12']['model']; ?> - Now 50% Savings</p>
        <span>Total = <strong><?php echo $data['buy1get12']['price'] ?></strong></span>
        <a href="<?php echo $data['buy1get12']['href'] ?>">buy Now</a>
      </div>
      <div class="single-buy-get-free">
        <div class="buy-get-free-images">
          <img src="<?php echo $data['buy1get12']['image']; ?>">
          <div class="plus-sybol">
            <p>+</p>
          </div>
          <img src="<?php echo $data['buy1get12']['image']; ?>">
        </div>
        <h2><a href="<?php echo $data['buy1get12']['href'] ?>"><?php echo $data['buy1get12']['name']; ?></a></h2>
        <div class="best-sellers-item-price">
          <?php if (!empty($data['buy1get12']['special'])) { ?>
          <span><?php echo $data['buy1get12']['special']; ?></span>
          <del><?php echo $data['buy1get12']['price']; ?></del>
          <div class="save-price">
            <p>
              save
              <?php
                  $old = (float) filter_var($data['buy1get12']['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                  $new = (float) filter_var($data['buy1get12']['special'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                  if ($old > 0 && $new > 0 && $new < $old) {
                      echo round((($old - $new) / $old) * 100) . '%';
                  } else {
                      echo '0%';
                  }
                  ?>
            </p>
          </div>
          <?php } else { ?>
          <span><?php echo $data['buy1get12']['price']; ?></span>
          <?php } ?>
        </div>
      </div>
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

<!-- <section class="category-based-products">
  <div class="container">
    <div class="single-category-based">
      <div class="single-category-based-left"
        style="background-image: url(https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D2R-Globes/D2R-HID-Xenon-Globe-Replacements-Australia-450x450.jpg);">
        <h2>Flash Sale</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <a href="#">shop now</a>
      </div>
      <div class="single-category-based-right">
        <div class="best-seller-title">
          <h2>featured products</h2>
          <ul>
            <li><button class="active">all</button></li>
            <li><button>LED LIGHT BARS</button></li>
            <li><button>LED Headlights</button></li>
            <li><button>LED Work Lights</button></li>
          </ul>
        </div>
        <div class="best-seller-product-grid">
          <?php echo $column_right; ?>
        </div>
      </div>
    </div>

  </div>
</section> -->

<!-- Video -->
<section class="video-hero">
  <video autoplay muted loop playsinline class="video-bg">
    <source src="https://cdn.shopify.com/videos/c/o/v/18c2e078311d40b38447d79e0db19bc8.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="video-overlay"></div>

  <div class="video-content">
    <h1>NEXT GEN - 8.5" SPOT LIGHT KIT</h1>
    <p>Ranger/Everest Stealth Kit</p>
    <a href="#">Shop now </a>
  </div>
</section>

<img src="assets/images/review.png" style="width: 100%;">

<!-- Features -->
<section class="section-features">
  <div class="container features-inner">
    <div class="feature-item">
      <span class="feature-icon"><i class="fa-solid fa-gear"></i></span>
      <div class="feature-content">
        <h4>Best quality</h4>
        <p>Best quality is a must at organic</p>
      </div>
    </div>
    <div class="feature-item">
      <span class="feature-icon"><i class="fa-solid fa-truck-fast"></i></span>
      <div class="feature-content">
        <h4>Shipping</h4>
        <p>Deliver within 24 hours</p>
      </div>
    </div>
    <div class="feature-item">
      <span class="feature-icon"><i class="fa-solid fa-headset"></i></span>
      <div class="feature-content">
        <h4>Support 24/7</h4>
        <p>Contact us 24 hours a day</p>
      </div>
    </div>
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
            '<p style="text-align: center; width: 100%; padding: 20px;">Loading...</p>');
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
<?php echo $footer; ?>
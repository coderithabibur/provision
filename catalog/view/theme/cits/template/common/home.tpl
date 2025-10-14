<?php echo $header; ?>

<?php echo $my_video_section; ?>

<!-- Features -->
<?php echo $feature_section_module; ?>

<section class="buy-one-get-on-free">
  <div class="container">
    <h2>buy one get one free</h2>
    <div class="category-cards">
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
            <a href="<?php echo $data['buy1get1']['href'] ?>"><img src="<?php echo $data['buy1get1']['image']; ?>"></a>            
            <div class="plus-sybol">
              <p>+</p>
            </div>
            <a href="<?php echo $data['buy1get1']['href'] ?>"><img src="<?php echo $data['buy1get1']['image']; ?>"></a>
          </div>
          <h2><a href="<?php echo $data['buy1get1']['href'] ?>"><?php echo $data['buy1get1']['name']; ?></a></h2>
          <!-- <div class="best-sellers-item-price">
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
          </div> -->
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
            <a href="<?php echo $data['buy1get12']['href'] ?>"><img src="<?php echo $data['buy1get1']['image']; ?>"></a>
            <div class="plus-sybol">
              <p>+</p>
            </div>
            <a href="<?php echo $data['buy1get12']['href'] ?>"><img src="<?php echo $data['buy1get1']['image']; ?>"></a>
          </div>
          <h2><a href="<?php echo $data['buy1get12']['href'] ?>"><?php echo $data['buy1get12']['name']; ?></a></h2>
          <!-- <div class="best-sellers-item-price">
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
          </div> -->
        </div>
      </div>
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
    <h1>NEXT GEN - 8.5" SPOT LIGHT KIT</h1>
    <p>Ranger/Everest Stealth Kit</p>
    <a href="#">Shop now </a>
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
<?php echo $header; ?>

<section class="product-gallery-info">
  <div class="container">
    <div class="product-main-content">      
      <div class="product__carousel">
        <!-- Main Product Gallery -->
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            <?php if ($popup) { ?>
            <div class="swiper-slide">
              <a href="<?php echo $popup; ?>" class="popup-link" title="<?php echo $heading_title; ?>" aria-label="View main product image">
                <img src="<?php echo $popup; ?>" alt="<?php echo $heading_title; ?>" />
              </a>
            </div>
            <?php } ?>

            <?php if ($images) { ?>
              <?php foreach ($images as $index => $image) { ?>
              <div class="swiper-slide">
                <a href="<?php echo $image['popup']; ?>" class="popup-link" title="<?php echo $heading_title; ?>" aria-label="View gallery image <?php echo $index + 1; ?>">
                  <img src="<?php echo $image['popup']; ?>" alt="<?php echo $heading_title; ?>" />
                </a>
              </div>
              <?php } ?>
            <?php } ?>
          </div>

          <!-- Swiper navigation -->
          <div class="swiper-button-next swiper-button-white"></div>
          <div class="swiper-button-prev swiper-button-white"></div>
        </div>

        <!-- Thumbnail Gallery -->
        <div class="swiper-container gallery-thumbs">
          <div class="swiper-wrapper">
            <?php if ($thumb) { ?>
            <div class="swiper-slide">
              <img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" />
            </div>
            <?php } ?>

            <?php if ($images) { ?>
              <?php foreach ($images as $image) { ?>
              <div class="swiper-slide">
                <img src="<?php echo $image['thumb']; ?>" alt="<?php echo $heading_title; ?>" />
              </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="product-info">
        <h1 class="product-title"><?php echo $heading_title; ?></h1>
        <p class="product-desc"></p>

        <form id="product" method="post" enctype="multipart/form-data">
        <?php if (!empty($options)) { ?>
          <div class="product-options-area">

            <?php foreach ($options as $option) { ?>
              <div class="product-option-box">

                <label>
                  <?php echo $option['name']; ?>
                  <?php if ($option['required']) { ?>
                    <span style="color:red">*</span>
                  <?php } ?>
                </label>

                <!-- SELECT -->
                <?php if ($option['type'] == 'select') { ?>
                  <select 
                    name="option[<?php echo $option['product_option_id']; ?>]" 
                    class="form-control"
                    aria-label="<?php echo $option['name']; ?>"
                    <?php if ($option['required']) { ?>required<?php } ?>>
                    <option value="">-- Select <?php echo $option['name']; ?> --</option>
                    <?php foreach ($option['product_option_value'] as $option_value) { ?>
                      <option value="<?php echo $option_value['product_option_value_id']; ?>">
                        <?php echo $option_value['name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                <?php } ?>

                <!-- RADIO (Bulb Type, Size, Color) -->
                <?php if ($option['type'] == 'radio') { ?>
                  <div class="option-radio-group">
                    <?php foreach ($option['product_option_value'] as $option_value) { ?>
                      <label class="option-radio-label">
                        <input 
                          type="radio"
                          name="option[<?php echo $option['product_option_id']; ?>]"
                          value="<?php echo $option_value['product_option_value_id']; ?>"
                          <?php if ($option['required']) { ?>required<?php } ?>
                        >
                        <span><?php echo $option_value['name']; ?></span>
                      </label>
                    <?php } ?>
                  </div>
                <?php } ?>

                <!-- CHECKBOX -->
                <?php if ($option['type'] == 'checkbox') { ?>
                  <div class="option-checkbox-group">
                    <?php foreach ($option['product_option_value'] as $option_value) { ?>
                      <label>
                        <input 
                          type="checkbox"
                          name="option[<?php echo $option['product_option_id']; ?>][]"
                          value="<?php echo $option_value['product_option_value_id']; ?>">
                        <?php echo $option_value['name']; ?>
                      </label>
                    <?php } ?>
                  </div>
                <?php } ?>

                <!-- TEXT -->
                <?php if ($option['type'] == 'text') { ?>
                  <input 
                    type="text"
                    name="option[<?php echo $option['product_option_id']; ?>]"
                    class="form-control"
                    aria-label="<?php echo $option['name']; ?>"
                    <?php if ($option['required']) { ?>required<?php } ?>>
                <?php } ?>

                <!-- TEXTAREA -->
                <?php if ($option['type'] == 'textarea') { ?>
                  <textarea
                    name="option[<?php echo $option['product_option_id']; ?>]"
                    class="form-control"
                    aria-label="<?php echo $option['name']; ?>"
                    <?php if ($option['required']) { ?>required<?php } ?>></textarea>
                <?php } ?>

              </div>
            <?php } ?>

          </div>
        <?php } ?>

        <!-- Current Price -->
        <div class="product-current-price">
          <?php if ($special) { ?>
            <span class="special-price"><?php echo $special; ?></span>
            <del class="old-price"><?php echo $price; ?></del>
          <?php } else { ?>
            <span class="regular-price"><?php echo $price; ?></span>
          <?php } ?>
        </div>

        <?php if ($discounts) { ?>
        <?php foreach ($discounts as $discount) { ?>
        <p class="splDes">
          <?php echo $discount['quantity']; ?><?php echo $text_discount; ?><span><?php echo $discount['price']; ?><span
              class="eachText"> (<?php echo $txt_each; ?>)</span></span></p>
          <?php } ?>
        <?php } ?>

        <?php if ($review_status) { ?>
          <div class="ratingsAndReviews">
            <div class="ratingInfo">
              <div class="ratingBox">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($rating < $i) { ?>
                <a href="" aria-label="Rate <?php echo $i; ?> out of 5 stars"> <i class="fas fa-star"></i> </a>
                <?php } else { ?>
                <a class="active" href="" aria-label="Rate <?php echo $i; ?> out of 5 stars"><i class="fas fa-star"></i></a>
                <?php } ?>
                <?php } ?>
              </div>
              <div class="reviews"> <p><?php echo $reviews; ?></p> | <a href="#tab-review"><?php echo $text_write; ?></a></div>
            </div>
          </div>
        <?php } ?>

        <?php if ($manufacturer) { ?>
        <p class="spl"><?php echo $text_manufacturer; ?> <a
            href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></p>
        <?php } ?>
        <p class="spl"><?php echo $text_model; ?> <span> <?php echo $model; ?></span></p>
        <?php if ($reward) { ?>
        <p class="spl"><?php echo $text_reward; ?> <span><?php echo $reward; ?></span></p>
        <?php } ?>
        <script id="payment-method-messaging-script" data-oc="2" src="catalog/view/javascript/stripe_messaging.js"></script>
        <p class="spl"><?php echo $text_stock; ?> <span><?php echo $stock; ?></span></p>

        <!-- Quantity & Add to Cart -->
        
          <div class="product-cart">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
            <div class="quantity">
              <button type="button" class="quantity-minus" aria-label="Decrease quantity">-</button>
              <input type="text" id="input-quantity" name="quantity" value="1" aria-label="Quantity">
              <button type="button" class="quantity-plus" aria-label="Increase quantity">+</button>
            </div>            
            <button type="button" id="button-cart" class="add-to-cart">ADD TO CART</button>
          </div>
        </form>

        <!-- Extra Actions -->
        <div class="extra-actions">
          <a href="/index.php?route=information/contact"><i class="fa-solid fa-circle-question"></i>Ask a Question</a>
          <!-- <a href="#"><i class="fa-solid fa-share-nodes"></i>Social Share</a> -->
        </div>

        <!-- Secure Checkout -->
        <div class="secure-checkout">
          <p>Guarantee safe & secure checkout</p>
          <div class="cards">
            <img src="/catalog/view/theme/cits/assets/images/payment-method.png" alt="Payment Methods">
          </div>
        </div>

        <!-- Delivery Info -->
        <div class="delivery-info">
          <!-- <p><i class="fa-solid fa-clock"></i> <span>Estimated Delivery</span> : 10 - 15 Aug, 2025</p> -->
          <p><i class="fa-solid fa-truck"></i> <span>Free Shipping & Returns</span> : On all order over $200.00</p>
        </div>

        <!-- Meta Info -->
        <div class="meta">
          <!-- SKU -->
          <?php if (!empty($sku)) { ?>
              <p><span>SKU:</span> <?php echo $sku; ?></p>
          <?php } ?>

          <!-- Categories -->
          <?php if (!empty($categories)) { ?>
              <p><span>Categories:</span>
                  <?php foreach ($categories as $index => $category) { ?>
                      <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a><?php if ($index < count($categories) - 1) { echo ', '; } ?>
                  <?php } ?>
              </p>
          <?php } ?>

          <!-- Tags -->
          <?php if (!empty($tags)) { ?>
              <p><span><?php echo $text_tags; ?></span>
                  <?php foreach ($tags as $index => $tag) { ?>
                      <a href="<?php echo $tag['href']; ?>"><?php echo $tag['tag']; ?></a><?php if ($index < count($tags) - 1) { echo ', '; } ?>
                  <?php } ?>
              </p>
          <?php } ?>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="product-featured-section" style="padding-top: 0;">
<?php if (!empty($product_sections)) { ?>
  <?php foreach ($product_sections as $section) { ?>

    <?php if ($section['section_type'] == 'image') { ?>
      <div class="single-product-featured" style="background-image: url('<?php echo $section['background_image']; ?>');">
        <div class="container">
          <div class="single-product-featured-content">
            <?php if (!empty($section['title'])) { ?>
              <h2><?php echo $section['title']; ?></h2>
            <?php } ?>
            <?php if (!empty($section['description'])) { ?>
              <p><?php echo $section['description']; ?></p>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } elseif ($section['section_type'] == 'video') { ?>
      <div class="video-hero">
        <video autoplay muted loop playsinline class="background-video">
          <source src="<?php echo $section['video_path']; ?>" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        <div class="video-content">
          <?php if (!empty($section['title'])) { ?>
            <h1><?php echo $section['title']; ?></h1>
          <?php } ?>
          <?php if (!empty($section['description'])) { ?>
            <p><?php echo $section['description']; ?></p>
          <?php } ?>
          <a href="#">Shop now </a>
        </div>
      </div>

    <?php } ?>

  <?php } ?>
<?php } ?>

</div>


<section class="product-tech-info-area">
  <div class="container">
    <div class="product-info-container">
      <!-- Left Side: Product Features -->
      <div class="product-features">
        <h2 class="section-title">Description</h2>
        <div class="feature-description-wrapper">
          <div class="feature-description" id="featureDescription">
            <?php echo $description; ?>
          </div>
          <button class="read-more-btn" id="readMoreBtn" style="display:none;">Read more</button>
        </div>
      </div>

      <!-- Right Side: Technical Specifications -->
      <div class="tech-specs" id="techSpecs">
        <h2 class="section-title">tech specs</h2>
        <?php echo $short_description; ?>
      </div>
    </div>
  </div>
</section>

<section class="product-reviews-content" id="tab-review">
  <div class="container">
    <h2>Reviews</h2>
    <?php if ($review_status) { ?>
      <div id="review"></div>
      <!-- Add Review Form -->
      <div class="add-review">
        <h4><?php echo $text_write; ?></h4>
        <p><?php echo $text_note; ?></p>
        <?php if ($review_guest) { ?>
        <form class="form-horizontal" id="form-review">
          <label><?php echo $entry_rating; ?> *</label>
          <div class="rating-stars">
            <input type="radio" id="star-5" name="rating" value="5"><label for="star-5"><i class="active fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="star-4" name="rating" value="4"><label for="star-4"><i class="active fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="star-3" name="rating" value="3"><label for="star-3"><i class="active fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="star-2" name="rating" value="2"><label for="star-2"><i class="active fa fa-star" aria-hidden="true"></i></label>
            <input type="radio" id="star-1" name="rating" value="1"><label for="star-1"><i class="active fa fa-star" aria-hidden="true"></i></label>
          </div>

          <label><?php echo $entry_review; ?> *</label>
          <input type="text" name="title" id="input-title" placeholder="Enter review title…" required>

          <label><?php echo $entry_name; ?> *</label>
          <input type="text" name="name" value="" id="input-name" placeholder="Enter your name…" required>

          <label>Email *</label>
          <input type="email" name="email" id="input-email" placeholder="Enter your email…" required>

          <label><?php echo $entry_review; ?> *</label>
          <textarea name="text" id="input-review" placeholder="Write Review" required></textarea>

          <label>
            <input type="checkbox"> Save my name, email, and website in this browser for the next time I comment.
          </label>

          <div class="captcha">
            <?php echo $captcha; ?>
          </div>

          <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>">
            <?php echo $button_continue ?? 'Submit'; ?>
          </button>
        </form>
        <?php } else { ?>
          <p><?php echo $text_login; ?></p>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</section>

<?php if (!empty($products)) { ?>
<!-- Related Products -->
<section class="related-products-area">
  <div class="container">
    <div class="related-products-slider">
      <h2><?php echo $text_related; ?></h2>
      <div class="swiper-wrapper">
        <?php foreach ($products as $product) { ?>
        <div class="swiper-slide">
          <div class="single-product-item">
            <!-- Product Image -->
            <a href="<?php echo $product['href']; ?>">
              <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>"
                title="<?php echo $product['name']; ?>" />
            </a>

            <!-- Product Info -->
            <div class="single-product-item-info">
              <h2>
                <a href="<?php echo $product['href']; ?>">
                  <?php echo $product['name']; ?>
                </a>
              </h2>

              <!-- Price -->
              <div class="best-sellers-item-price">
                <?php if ($product['special']) { ?>
                <span><?php echo $product['special']; ?></span>
                <del><?php echo $product['price']; ?></del>
                <div class="save-price">
                  <p>save <?php
                      $old = preg_replace('/[^\d.]/', '', $product['price']);
                      $new = preg_replace('/[^\d.]/', '', $product['special']);
                      if ($old > 0) {
                        echo round((($old - $new) / $old) * 100) . '%';
                      }
                    ?></p>
                </div>
                <?php } else { ?>
                <span><?php echo $product['price']; ?></span>
                <?php } ?>
              </div>

              <!-- Reviews -->
              <div class="single-product-reviews">
                <?php if ($product['rating']) { ?>
                <ul>
                  <?php for ($j = 1; $j <= 5; $j++) { ?>
                  <li>
                    <?php if ($product['rating'] < $j) { ?>
                    <i class="fa-regular fa-star"></i>
                    <?php } else { ?>
                    <i class="fa-solid fa-star"></i>
                    <?php } ?>
                  </li>
                  <?php } ?>
                </ul>
                <?php } ?>
                <p><?php echo $product['reviews']; ?></p>
              </div>

              <!-- Buttons -->
              <div class="single-product-btn-group">
                <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');">
                  <?php echo $button_cart; ?>
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

      <!-- Swiper Navigation -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>

  </div>
</section>
<?php } ?>



<script type="text/javascript">
    $(document).ready(function () {
        tabControl();

        var resizeTimer;
        $(window).on('resize', function (e) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                tabControl();
            }, 250);
        });

        function tabControl() {
            var tabs = $('.tabbed-content').find('.tabs');
            if (tabs.is(':visible')) {
                tabs.find('a').on('click', function (event) {
                    event.preventDefault();
                    var target = $(this).attr('href'),
                        tabs = $(this).parents('.tabs'),
                        buttons = tabs.find('a'),
                        item = tabs.parents('.tabbed-content').find('.item');
                    buttons.removeClass('active');
                    item.removeClass('active');
                    $(this).addClass('active');
                    $(target).addClass('active');
                });
            } else {
                $('.item').on('click', function () {
                    var container = $(this).parents('.tabbed-content'),
                        currId = $(this).attr('id'),
                        items = container.find('.item');
                    container.find('.tabs a').removeClass('active');
                    items.removeClass('active');
                    $(this).addClass('active');
                    container.find('.tabs a[href$="#' + currId + '"]').addClass('active');
                });
            }
        }

        $('.tabbed-content .item').click(function () {

            $('html, body').animate({

                scrollTop: $(".item.active").offset().top

            }, 1000)

        });
    });

</script>


  <script type="text/javascript"><!--
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function() {
                $('#recurring-description').html('');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
  </script>

  <!-- Button Cart -->
  <script>
$(document).ready(function() {

    // Quantity buttons
    $('.quantity-minus').on('click', function() {
        var $input = $(this).siblings('#input-quantity');
        var value = parseInt($input.val()) || 1;
        if (value > 1) $input.val(value - 1);
    });

    $('.quantity-plus').on('click', function() {
        var $input = $(this).siblings('#input-quantity');
        var value = parseInt($input.val()) || 1;
        $input.val(value + 1);
    });

    // Add to cart
    // $('#button-cart').on('click', function() {
    //   var product_id = $('input[name="product_id"]').val();
    //   var quantity = parseInt($('#input-quantity').val()) || 1;

    //   if (quantity <= 0) {
    //       alert('Invalid quantity supplied');
    //       return false;
    //   }

    //   // Call global cart.add function
    //   $.ajax({
    //     url: 'index.php?route=checkout/cart/add',
    //     type: 'post',
    //     data: 'product_id=' + product_id + '&quantity=' + quantity,
    //     dataType: 'json',
    //     beforeSend: function() {
    //       $('#button-cart').prop('disabled', true).text('Adding...');
    //     },
    //     complete: function() {
    //       $('#button-cart').prop('disabled', false).text('ADD TO CART');
    //     },
    //     success: function(json) {
    //       $('.alert, .text-danger').remove();

    //       if (json['error']) {
    //           alert(json['error']); // simple error alert
    //           return;
    //       }

    //       if (json['success']) {
    //         // Success alert
    //         $('#content').before(
    //             '<div class="alert alert-success">' + 
    //             json['success'] + 
    //             '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
    //         );

    //         // Update mini-cart total
    //         const match = json['total'].match(/\d+/);
    //         const itemCount = match ? match[0] : 0;
    //         $('.cartInfo .item').text(itemCount);

    //         // Refresh mini-cart items
    //         $('.cartInputBox').load('index.php?route=common/cart/info ul li');

    //         $('html, body').animate({ scrollTop: 0 }, 'slow');
    //       }
    //     },
    //     error: function(xhr, ajaxOptions, thrownError) {
    //       alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    //       $('#button-cart').prop('disabled', false).text('ADD TO CART');
    //     }
    //   });
    // });

      // ADD TO CART (WITH OPTIONS SUPPORT)
    $('#button-cart').on('click', function() {

      $.ajax({
        url: 'index.php?route=checkout/cart/add',
        type: 'post',
        data: $('#product').serialize(),   // THIS IS THE MAIN FIX
        dataType: 'json',

        beforeSend: function() {
          $('.text-danger').remove();
          $('#button-cart').prop('disabled', true).text('Adding...');
        },

        complete: function() {
          $('#button-cart').prop('disabled', false).text('ADD TO CART');
        },

        success: function(json) {

          $('.alert, .text-danger').remove();

          // OPTION / VALIDATION ERRORS
          // OPTION / VALIDATION ERRORS
          if (json['error']) {
            if (json['error']['option']) {
              for (i in json['error']['option']) {
                var element = $('[name="option[' + i + ']"]');
                
                if (element.length == 0) {
                    element = $('[name="option[' + i + '][]"]');
                }
                
                if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
                    // Append after the group container
                    element.closest('.product-option-box').append('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                } else {
                    // Select, text, textarea
                     element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                }
              }
              
              // Scroll to the first error
              if ($('.text-danger').length > 0) {
                  $('html, body').animate({ scrollTop: $('.text-danger:first').offset().top - 150 }, 'slow');
              }
            }

            if (json['error']['recurring']) {
              $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
            }

            return;
          }

          // SUCCESS
          if (json['success']) {

            $('#content').before(
              '<div class="alert alert-success">' +
              json['success'] +
              '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );

            // Update minicart count
            const match = json['total'].match(/\d+/);
            const itemCount = match ? match[0] : 0;
            $('.cartInfo .item').text(itemCount);

            // Reload minicart items
            $('.cartInputBox').load('index.php?route=common/cart/info ul li');

            $('html, body').animate({ scrollTop: 0 }, 'slow');
            
            // Open Sidecart on Success
            $(".minicart").addClass("active");
            $("body").addClass("active");
          }
        },

        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\n" + xhr.statusText + "\n" + xhr.responseText);
        }
      });

    });


});
</script>

<script type="text/javascript"><!--
    $('.date').datetimepicker({
        pickTime: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function() {
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: 'index.php?route=tool/upload',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(node).button('loading');
                    },
                    complete: function() {
                        $(node).button('reset');
                    },
                    success: function(json) {
                        $('.text-danger').remove();

                        if (json['error']) {
                            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $(node).parent().find('input').attr('value', json['code']);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    //--></script>
<script type="text/javascript"><!--
    $('#review').delegate('.pagination a', 'click', function(e) {
        e.preventDefault();

        $('#review').fadeOut('slow');

        $('#review').load(this.href);

        $('#review').fadeIn('slow');
    });

    $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

    $('#button-review').on('click', function() {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            data: $("#form-review").serialize(),
            beforeSend: function() {
                $('#button-review').button('loading');
            },
            complete: function() {
                $('#button-review').button('reset');
            },
            success: function(json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    grecaptcha.reset();
                    $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });

    $(document).ready(function() {
        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
        });
    });

    (function() {
        /* Define a variável que dá swipe no lightbox */
        var magnificPopup = $.magnificPopup.instance;

        /* Carrega a função quando clica no lightbox (senão não pega a classe utilizada) */
        $(".thumbnails").click(function(e) {

            /* Espera carregar o lightbox */
            setTimeout(function() {
                /* Swipe para a esquerda - Próximo */
                $(".mfp-container").swipe( {
                    swipeLeft:function(event, direction, distance, duration, fingerCount) {
                        console.log("swipe right");
                        magnificPopup.next();
                    },

                    /* Swipe para a direita - Anterior */
                    swipeRight:function(event, direction, distance, duration, fingerCount) {
                        console.log("swipe left");
                        magnificPopup.prev();
                    },
                });
            }, 500);
        });

    }).call(this);
    $('.product-faq-form').on('click', function() {
        $('#section-product-question-form').hide();
    });
</script>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Product",
  "name": "<?php echo $heading_title; ?>",
  "image": [
    "<?php echo $popup; ?>"
    <?php if ($images) { ?>
    <?php foreach ($images as $image) { ?>
    , "<?php echo $image['popup']; ?>"
    <?php } ?>
    <?php } ?>
   ],
  "description": "<?php echo strip_tags($description); ?>",
  "sku": "<?php echo $sku; ?>",
  "brand": {
    "@type": "Brand",
    "name": "<?php echo $manufacturer; ?>"
  },
  <?php if ($rating) { ?>
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?php echo $rating; ?>",
    "reviewCount": "<?php echo preg_replace('/[^0-9]/', '', $reviews); ?>"
  },
  <?php } ?>
  "offers": {
    "@type": "Offer",
    "url": "<?php echo $base; ?>index.php?route=product/product&product_id=<?php echo $product_id; ?>",
    "priceCurrency": "<?php echo $currency_code; ?>",
    "price": "<?php echo ($special_value) ? $special_value : $price_value; ?>",
    "availability": "<?php echo ($stock) ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock'; ?>",
    "itemCondition": "http://schema.org/NewCondition"
  }
}
</script>





			<?php if($config_gr_status) { ?>
	<span itemscope itemtype="http://schema.org/Product">
		<meta itemprop="name" content="<?php echo $heading_title; ?>">
		<meta itemprop="url" content="<?php echo $plink; ?>">
		<?php if($meta_description != "") { ?><meta itemprop="description" content="<?php echo $meta_description; ?>" /><?php } ?>
		<?php if(isset($pimage)) { ?><meta itemprop="image" content="<?php echo str_replace(" ","%20",$pimage); ?>" /><?php } ?>
		<?php if($model != "") { ?><meta itemprop="model" content="<?php echo $model; ?>"><?php } ?>
		<?php if($manufacturer != "") { ?><meta itemprop="brand" content="<?php echo $manufacturer; ?>"><?php } ?>
	 	<?php foreach ($pcurrencies as $currency) { ?><span itemscope itemprop="offers" itemtype="http://schema.org/Offer">
				<meta itemprop="price" content="<?php echo $currency['price']; ?>">
				<meta itemprop="priceCurrency" content="<?php echo $currency['code']; ?>">
				<meta itemprop="availability" itemtype="http://schema.org/ItemAvailability" content="http://schema.org/<?php echo ($pstock ? "InStock" : "OutOfStock") ?>">
				<meta itemprop="itemCondition" content="http://schema.org/NewCondition" />
			</span>
		<?php } ?>
		<?php if(isset($ptotalreviews) && $ptotalreviews) { ?>
			<span itemscope itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating">
				<meta itemprop="reviewCount" content="<?php echo $ptotalreviews; ?>">
				<meta itemprop="ratingValue" content="<?php echo $prating; ?>">
			</span>
		<?php } ?>
		<?php foreach($reviewresults as $result) { ?>
			<span itemprop="review" itemscope itemtype="http://schema.org/Review" />
				<meta itemprop="name"  content = "<?php echo substr($result['text'], 0, 15); ?>" />
				<meta itemprop="description" content = "<?php echo $result['text']; ?>" />
				<span itemprop="author" itemscope itemtype="http://schema.org/Person">
				 	<meta itemprop="name" content = "<?php echo $result['author']; ?>" />
				</span>
				<meta itemprop="datePublished" content="<?php echo date('Y-m-d', strtotime($result['date_added'])); ?>" />
				<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
					<meta itemprop="ratingValue" content = "<?php echo $result['rating']; ?>" />
					<meta itemprop="bestRating" content = "5" />
					<meta itemprop="worstRating" content="1" />
				</span>
			</span>
		<?php } ?>
	</span>
<?php } ?>
<?php if($config_gr_status) { ?><?php if(isset($breadcrumbs) && !empty($breadcrumbs)) { ?><script type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [
<?php $temp = 0;end($breadcrumbs); $lastElement = key($breadcrumbs); foreach ($breadcrumbs as $key => $value) { $temp = $temp + 1;?>
{
"@type": "ListItem",
"position": <?php echo $temp ?>,
"item": {
"@id": "<?php echo $value['href']; ?>",
"name": "<?php echo strip_tags($value['text']); ?>"
}  
}<?php if($key == $lastElement) {}else{echo ",";}?>
<?php } ?>
]
}
</script>
<?php } ?>
<?php } ?>


			    <!--START - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
			        <?php echo $product_view_script; ?> 
			        <script type="text/javascript">
			           function sendAddProductInfo() {
    			            $.ajax({
                    		    url: 'index.php?route=extension/module/google_ecommerce/get_product_info&product_id=<?php echo $product_id; ?>',
                    	    	type: 'post',
                    		    dataType: 'json',
                    		    success: function(json) {
                    		        if (json['error']) {
                    		            console.log(json['error']);
                    		        }else{
                    		            gtag('event', 'add_to_cart', {
                                          "items": [
                                            {
                                              "id": json.id,
                                              "name": json.product_name,
                                              "list_name": "Product Page",
                                              "brand": json.brand,
                                              "category": json.category,
                                              "price": json.price
                                            }
                                          ]
                                        });
                    		        }
                    		    }
    	                    });
	                   }
			        </script>
			    <!--END - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
            	
<?php echo $footer; ?>
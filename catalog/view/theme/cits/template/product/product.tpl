<?php echo $header; ?>

<!-- Product custom sections  $data['product_sections'] -->
<?php// print_r($data['product_sections']); ?>

<section class="product-gallery-info">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="product__carousel">
          <!-- Main Product Gallery -->
          <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
              <?php if ($thumb) { ?>
              <div class="swiper-slide">
                <a href="<?php echo $popup; ?>" class="popup-link" title="<?php echo $heading_title; ?>">
                  <img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" />
                </a>
              </div>
              <?php } ?>

              <?php if ($images) { ?>
                <?php foreach ($images as $image) { ?>
                <div class="swiper-slide">
                  <a href="<?php echo $image['popup']; ?>" class="popup-link" title="<?php echo $heading_title; ?>">
                    <img src="<?php echo $image['thumb']; ?>" alt="<?php echo $heading_title; ?>" />
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
      </div>

      <div class="col-md-6">
        <div class="product-info">
          <h2 class="product-title"><?php echo $heading_title; ?></h2>
          <p class="product-desc">
          </p>

          <!-- Variation -->
          <!-- <div class="product-variation">
            <label>Size: 18 inch</label>
            <div class="pro-var-group">
              <label for="size-18">
                <input type="radio" name="size" id="size-18" value="18" checked>
                18 inch
              </label>
              <label for="size-20">
                <input type="radio" name="size" id="size-20" value="20">
                20 inch
              </label>
              <label for="size-22">
                <input type="radio" name="size" id="size-22" value="22">
                22 inch
              </label>
            </div>
          </div> 
          
          <div class="more-quantity-area">
            <ul>
              <li><button>2 or more $186.00 <p>(Each)</p></button></li>
              <li><button>4 or more $168.00 <p>(Each)</p></button></li>
              <li><button>6 or more $155.00 <p>(Each)</p></button></li>
              <li><button>8 or more $145.25 <p>(Each)</p></button></li>
              <li><button>10 or more $135.00 <p>(Each)</p></button></li>
            </ul>
          </div> -->

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

          <!-- <p class="newprice"><?php //echo $special; ?><span class="eachText"> (<?php //echo $txt_each; ?>)</span>
            <span class="newprice" style="font-size: 16px;"> - Discount:
              <?php
                  //$prica = str_replace(',','',$price);
                  //$pricb = str_replace(',','',$special);
                  //$priceInt= str_replace('$','',$prica);
                  //$specialInt= str_replace('$','',$pricb);
                  //$disc = (($priceInt-$specialInt)/$priceInt)*100;
                  ?>
              <?php //echo round($disc,2);?>% </span>
          </p> -->

          <?php if ($review_status) { ?>
            <div class="ratingsAndReviews">
              <div class="ratingInfo">
                <div class="ratingBox">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($rating < $i) { ?>
                  <a href=""onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"> <i class="fas fa-star"></i> </a>
                  <?php } else { ?>
                  <a class="active" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><i class="fas fa-star"></i></a>
                  <?php } ?>
                  <?php } ?>
                </div>
                <div class="reviews">  <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a> | <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $text_write; ?></a></div>            
                <!-- AddThis Button BEGIN>
                <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                <!-- AddThis Button END -->
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
          <p class="spl"><?php echo $text_stock; ?> <span><?php echo $stock; ?></span></p>

          <!-- Quantity & Add to Cart -->
          <form id="product" class="product-cart" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
            <div class="quantity">
              <button type="button" class="quantity-minus">-</button>
              <input type="text" id="input-quantity" name="quantity" value="1">
              <button type="button" class="quantity-plus">+</button>
            </div>
            
            <button type="button" id="button-cart" class="add-to-cart">ADD TO CART</button>
          </form>

          <!-- Extra Actions -->
          <div class="extra-actions">
            <a href="#"><i class="fa-solid fa-code-compare"></i>Compare</a>
            <a href="/index.php?route=information/contact"><i class="fa-solid fa-circle-question"></i>Ask a Question</a>
            <!-- <a href="#"><i class="fa-solid fa-share-nodes"></i>Social Share</a> -->
          </div>

          <!-- Secure Checkout -->
          <div class="secure-checkout">
            <p>Guarantee safe & secure checkout</p>
            <div class="cards">
              <img src="/catalog/view/theme/cits/assets/images/payment-method.png">
            </div>
          </div>

          <!-- Delivery Info -->
          <div class="delivery-info">
            <p><i class="fa-solid fa-clock"></i> <span>Estimated Delivery</span> : 10 - 15 Aug, 2025</p>
            <p><i class="fa-solid fa-truck"></i> <span>Free Shipping & Returns</span> : On all order over $200.00</p>
          </div>

          <!-- Meta Info -->
          <div class="meta">
            <p><span>SKU:</span> Woo-Long-Sleeve-Tee</p>
            <p><span>Categories:</span> Car Audio Systems, Headlight, Tires & Wheels</p>
            <p><span><?php echo $text_tags; ?> </span> 
              <?php for ($i = 0; $i < count($tags); $i++) { ?>
              <?php if ($i < (count($tags) - 1)) { ?>
              <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
              <?php } else { ?>
              <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
              <?php } ?>
              <?php } ?>
            </p>
          </div>

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

      <!-- <div class="single-product-featured video-section">
        <video autoplay muted loop playsinline class="background-video">
          <source src="<?php// echo $section['video_path']; ?>" type="video/mp4">
        </video>
        <div class="container">
          <div class="single-product-featured-content">
            <?php //if (!empty($section['title'])) { ?>
              <h2><?php //echo $section['title']; ?></h2>
            <?php// } ?>
            <?php //if (!empty($section['description'])) { ?>
              <p><?php //echo $section['description']; ?></p>
            <?php// } ?>
          </div>
        </div>
      </div> -->

    <?php } ?>

  <?php } ?>
<?php } ?>

</div>

<!-- <section class="dimensions-area">
  <div class="container">
    <img src="/catalog/view/theme/cits/assets/images/d3s-01.avif">
  </div>
</section> -->

<section class="product-tech-info-area">
  <div class="container">
    <div class="product-info-container">
      <!-- Left Side: Product Features -->
      <div class="product-features">
        <div class="section-title">Description</div>
        <div class="feature-description">
          <?php echo $description; ?>
        </div>
      </div>

      <!-- Right Side: Technical Specifications -->
      <div class="tech-specs">
        <h2 class="section-title">TECH SPECS</h2>
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
                <button type="button" onclick="compare.add('<?php echo $product['product_id']; ?>');"
                  aria-label="Add to Compare">
                  <i class="fa-solid fa-code-compare"></i>
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
    //--></script>
<script type="text/javascript"><!--
    $('#button-cart').on('click', function() {
        var quantity = $('#input-quantity').val();
        //~ var requiredQuantity = $("#requiredQuantity").val();
        //~ if(quantity < requiredQuantity ){
        //~ alert('Required quantity is: ' + requiredQuantity);
        //~ return false;
        //~ }
        var result = $.isNumeric(quantity);
        if(result == true){
            $.ajax({
                url: 'index.php?route=checkout/cart/add',
                type: 'post',
                data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
                dataType: 'json',
                beforeSend: function() {
                    $('#button-cart').button('loading');
                },
                complete: function() {
                    $('#button-cart').button('reset');
                },
                success: function(json) {
                    $('.alert, .text-danger').remove();
                    $('.form-group').removeClass('has-error');

                    if (json['error']) {
                        if (json['error']['option']) {
                            for (i in json['error']['option']) {
                                var element = $('#input-option' + i.replace('_', '-'));

                                if (element.parent().hasClass('input-group')) {
                                    element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                } else {
                                    element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                }
                            }
                        }

                        if (json['error']['recurring']) {
                            $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                        }

                        // Highlight any found errors
                        $('.text-danger').parent().addClass('has-error');
                        /*$('#button-cart').hide();
                        $('#button-cart1').show();*/
                    }

                    if (json['success']) {
                        $('#content').before('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                        $('#cart > button').html(json['total']);
                        // $('#button-cart').hide();
                        $('#button-cart1').show();

                        //$('html, body').animate({ scrollTop: 0 }, 'slow');

                        $('#cart > ul').load('index.php?route=common/cart/info ul li');

                        // Log success message with item count to console
                        console.log("Add to cart successful item = " + json['total']);
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }else{
            alert('Invalid quanity supplied');
        }
    });
    //--></script>
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

    // Quantity increment/decrement
    $('.quantity-plus').on('click', function() {
        var input = $(this).siblings('input[name="quantity"]');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1);
        }
    });

    $('.quantity-minus').on('click', function() {
        var input = $(this).siblings('input[name="quantity"]');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal) && currentVal > 1) {
            input.val(currentVal - 1);
        }
    });
    //--></script>

<?php echo $footer; ?>
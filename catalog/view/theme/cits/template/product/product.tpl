<?php echo $header; ?>

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
              <?php echo $short_description; ?>
            </p>

            <!-- Variation -->
            <div class="product-variation">
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
            </div>

            <!-- Current Price -->
            <div class="product-current-price"><?php echo $price; ?> <del>$150.00</del></div>

            <?php if ($discounts) { ?>
              <?php foreach ($discounts as $discount) { ?>
              <p class="splDes"><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><span><?php echo $discount['price']; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span></span></p>
              <?php } ?>
            <?php } ?>

            <p class="newprice"><?php echo $special; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span>
              <span class="newprice" style="font-size: 16px;"> - Discount:
                <?php
                  $prica = str_replace(',','',$price);
                  $pricb = str_replace(',','',$special);
                  $priceInt= str_replace('$','',$prica);
                  $specialInt= str_replace('$','',$pricb);
                  $disc = (($priceInt-$specialInt)/$priceInt)*100;
                  ?>
                <?php echo round($disc,2);?>% </span>
            </p>

            <div class="ratingsAndReviews">
              <?php if ($product['rating']) { ?>
              <div class="rating">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($product['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
              </div>
              <?php } ?>

              <div class="reviews">
                  <a href="<?php echo $product['href']; ?>#customerReview"><?php echo $product['reviews']; ?></a>
                  |
                  <a href="<?php echo $product['href']; ?>#customerReview"><?php echo $text_write; ?></a>
              </div>

          </div>

            <?php if ($manufacturer) { ?>
            <p class="spl"><?php echo $text_manufacturer; ?> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></p>
            <?php } ?>
            <p class="spl"><?php echo $text_model; ?> <span> <?php echo $model; ?></span></p>
            <?php if ($reward) { ?>
            <p class="spl"><?php echo $text_reward; ?> <span><?php echo $reward; ?></span></p>
            <?php } ?>
            <p class="spl"><?php echo $text_stock; ?> <span><?php echo $stock; ?></span></p>
            
            <!-- Quantity & Add to Cart -->
            <div class="product-cart">
              <div class="quantity">
                <button>-</button>
                <input type="text" value="1">
                <button>+</button>
              </div>
              <button class="add-to-cart">ADD TO CART</button>
            </div>

            <!-- Extra Actions -->
            <div class="extra-actions">
              <a href="#"><i class="fa-solid fa-code-compare"></i>Compare</a>
              <a href="#"><i class="fa-solid fa-circle-question"></i>Ask a Question</a>
              <a href="#"><i class="fa-solid fa-share-nodes"></i>Social Share</a>
            </div>

            <!-- Secure Checkout -->
            <div class="secure-checkout">
              <p>Guarantee safe & secure checkout</p>
              <div class="cards">
                <img src="assets/images/payment-method.png" alt="">
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
              <p><span>Tags:</span> Ducati, Hyundai, Kia, Lamborghini, Toyota, Triumph</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="product-page-gallery">
    <div class="pro-left-image">
      <a href="assets/images/product-1.jpg" class="popup-link">
        <img src="assets/images/product-1.jpg">
      </a>
    </div>
    <div class="pro-right-images">
      <a href="assets/images/product-2.jpg" class="popup-link">
        <img src="assets/images/product-2.jpg">
      </a>
      <a href="assets/images/product-3.jpg" class="popup-link">
        <img src="assets/images/product-3.jpg">
      </a>
      <a href="assets/images/product-1.jpg" class="popup-link">
        <img src="assets/images/product-1.jpg">
      </a>
      <a href="assets/images/product-2.jpg" class="popup-link">
        <img src="assets/images/product-2.jpg">
      </a>
    </div>
  </section>

  <div class="product-featured-section" style="padding-top: 0;">
    <div class="single-product-featured" style="background-image: url(assets/images/img-1.jpg);">
      <div class="container">
        <div class="single-product-featured-content">
          <h2>the pro standard</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eius tenetur recusandae natus illum
            architecto nemo repellendus iste, ab autem accusantium laudantium eaque sint culpa fugiat vero. Repellat,
            consequatur ab?</p>
        </div>
      </div>
    </div>
    <div class="single-product-featured" style="background-image: url(assets/images/img-4.jpg);">
      <div class="container">
        <div class="single-product-featured-content">
          <h2>the pro standard</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eius tenetur recusandae natus illum
            architecto nemo repellendus iste, ab autem accusantium laudantium eaque sint culpa fugiat vero. Repellat,
            consequatur ab?</p>
        </div>
      </div>
    </div>
    <div class="single-product-featured" style="background-image: url(assets/images/img-3.jpg);">
      <div class="container">
        <div class="single-product-featured-content">
          <h2>the pro standard</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eius tenetur recusandae natus illum
            architecto nemo repellendus iste, ab autem accusantium laudantium eaque sint culpa fugiat vero. Repellat,
            consequatur ab?</p>
        </div>
      </div>
    </div>
  </div>

  <section class="dimensions-area">
    <div class="container">
      <img src="assets/images/d3s-01.avif">
    </div>
  </section>

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

  <section class="product-reviews-content">
    <div class="container">
      <h2>Reviews</h2>
      <div class="reviews-list">
        <div class="review-item">
          <div class="review-avatar">
            <img src="assets/images/user.png">
          </div>
          <div class="review-content">
            <div class="review-rating">★★★☆☆</div>
            <div class="review-author">Alex — June 12, 2024</div>
            <p>Full of flavour but with palate cleansing acidity, our kiwifruit are rich in fibre and packed with
              the
              enzyme actinidin which are brilliant for digestion.</p>
          </div>
        </div>

        <div class="review-item">
          <div class="review-avatar">
            <img src="assets/images/user.png">
          </div>
          <div class="review-content">
            <div class="review-rating">★★★★★</div>
            <div class="review-author">Admin — June 14, 2024</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae malesuada velit, ac eleifend purus.
              Cras fermentum dictum massa, sit amet rhoncus purus tincidunt vel.</p>
          </div>
        </div>

        <div class="review-item">
          <div class="review-avatar">
            <img src="assets/images/user.png">
          </div>
          <div class="review-content">
            <div class="review-rating">★★★★★</div>
            <div class="review-author">Tony Nguyen — June 14, 2024</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae malesuada velit, ac eleifend purus.
              Cras fermentum dictum massa, sit amet rhoncus purus tincidunt vel.</p>
          </div>
        </div>

        <div class="review-item">
          <div class="review-avatar">
            <img src="assets/images/user.png">
          </div>
          <div class="review-content">
            <div class="review-rating">★★★★★</div>
            <div class="review-author">Nathan Lee — June 14, 2024</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae malesuada velit, ac eleifend purus.
              Cras fermentum dictum massa, sit amet rhoncus purus tincidunt vel.</p>
          </div>
        </div>
      </div>

      <div class="tab-content">
    <?php if ($review_status) { ?>
    <div class="tab-pane active" id="tab-review">
        <form class="form-horizontal" id="form-review">
            <div id="review"></div>
            <div class="reviewForm">
                <div class="panel-box-title">
                    <h2 class="title-orange"><?php echo $text_write; ?></h2>
                </div>
                <?php if ($review_guest) { ?>
                <div class="fullWidth required">
                    <div class="halfwidth">
                        <label for="input-name"><?php echo $entry_name; ?></label>
                        <input type="text" name="name" value="" id="input-name" placeholder="Enter your name…" class="textfeild" />
                    </div>
                </div>

                <div class="fullWidth required">
                    <div class="halfwidth">
                        <label for="input-review"><?php echo $entry_review; ?></label>
                        <textarea name="text" rows="0" cols="0" id="input-review" placeholder="Write Review" class="textareafeild"></textarea>
                        <!--div class="help-block"><?php //echo $text_note; ?></div-->
                    </div>
                </div>

                <div class="fullWidth required">
                    <label><?php echo $entry_rating; ?></label>
                    <div class="star-rating">
                        <input id="star-5" type="radio" name="rating" value="5">
                        <label for="star-5" title="5 stars"><i class="active fa fa-star" aria-hidden="true"></i></label>

                        <input id="star-4" type="radio" name="rating" value="4">
                        <label for="star-4" title="4 stars"><i class="active fa fa-star" aria-hidden="true"></i></label>

                        <input id="star-3" type="radio" name="rating" value="3">
                        <label for="star-3" title="3 stars"><i class="active fa fa-star" aria-hidden="true"></i></label>

                        <input id="star-2" type="radio" name="rating" value="2">
                        <label for="star-2" title="2 stars"><i class="active fa fa-star" aria-hidden="true"></i></label>

                        <input id="star-1" type="radio" name="rating" value="1">
                        <label for="star-1" title="1 star"><i class="active fa fa-star" aria-hidden="true"></i></label>
                    </div>
                </div>

                <div class="fullWidth required">
                    <div class="halfwidth captcha">
                        <?php echo $captcha; ?>
                    </div>
                </div>

                <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="yellowbtn"><?php echo "Post"; ?></button>
                <?php } else { ?>
                    <?php echo $text_login; ?>
                <?php } ?>
            </div>
        </form>
    </div>
    <?php } ?>
</div>


      <!-- Add Review Form -->
      <div class="add-review">
        <h4>Add a Review</h4>
        <p>Your email address will not be published. Required fields are marked *</p>
        <form>
          <label>Your rating *</label>
          <div class="rating-stars">
            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
          </div>
          <label>Review Title *</label>
          <input type="text" required>
          <label>Name *</label>
          <input type="text" required>
          <label>Email *</label>
          <input type="email" required>
          <label>Your review *</label>
          <textarea required></textarea>
          <label>
            <input type="checkbox"> Save my name, email, and website in this browser for the next time I comment.
          </label>
          <button type="submit">Submit</button>
        </form>
      </div>
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
                      <img src="<?php echo $product['thumb']; ?>" 
                          alt="<?php echo $product['name']; ?>" 
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
                          <?php if ((float)$product['price'] > 0) { ?>
                              <?php if (!$product['special']) { ?>
                                  <span><?php echo $product['price']; ?></span>
                              <?php } else { ?>
                                  <span><?php echo $product['special']; ?></span>
                                  <del><?php echo $product['price']; ?></del>
                                  <div class="save-price">
                                      <p>
                                          save 
                                          <?php
                                              $old = preg_replace('/[^\d.]/', '', $product['price']);
                                              $new = preg_replace('/[^\d.]/', '', $product['special']);
                                              if ($old > 0) {
                                                  echo round((($old - $new) / $old) * 100) . '%';
                                              }
                                          ?>
                                      </p>
                                  </div>
                              <?php } ?>
                          <?php } else { ?>
                              <span>&nbsp;</span>
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
                          <button type="button" onclick="compare.add('<?php echo $product['product_id']; ?>');" aria-label="Add to Compare">
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

<?php echo $footer; ?>
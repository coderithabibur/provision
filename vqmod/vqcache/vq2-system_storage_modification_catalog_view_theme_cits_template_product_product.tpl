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
            <p class="splDes"><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><span><?php echo $discount['price']; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span></span></p>
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

  <!-- Product Tabs -->
  <section class="product-tabs">
    <div class="container">
      <ul class="product-tab-nav">
        <li class="active" data-tab="description">Description</li>
        <li data-tab="additional">Additional information</li>
        <li data-tab="reviews">Reviews (0)</li>
      </ul>

      <!-- Description Tab -->
      <div class="product-tab-content active" id="description">
        <?php echo $description; ?>
      </div>

      <!-- Additional Information Tab -->
      <div class="product-tab-content" id="additional">
        <p>Additional information content goes here...</p>
      </div>

      <!-- Reviews Tab -->
      <div class="product-tab-content" id="reviews">
        <div class="reviews-list">
          <div class="review-item">
            <div class="review-avatar">
              <img src="assets/images/user.png">
            </div>
            <div class="review-content">
              <div class="review-rating">★★★☆☆</div>
              <div class="review-author">Alex — June 12, 2024</div>
              <p>Full of flavour but with palate cleansing acidity, our kiwifruit are rich in fibre and packed with the
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
    </div>
  </section>

  <div class="product-featured-section">
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


  <!-- Related Products -->
  <section class="related-products-area">
    <div class="container">
      <div class="related-products-slider">
        <h2>Related products</h2>
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="single-product-item">
              <a href="#"><img src="assets/images/product-1.jpg"></a>
              <div class="single-product-item-info">
                <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
                <div class="best-sellers-item-price">
                  <span>$35.00</span>
                  <del>$40.00</del>
                  <div class="save-price">
                    <p>save 5%</p>
                  </div>
                </div>
                <div class="single-product-reviews">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <p>575 reviews</p>
                </div>
                <div class="single-product-btn-group">
                  <button type="submit">add to cart</button>
                  <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="single-product-item">
              <a href="#"><img src="assets/images/product-2.jpg"></a>
              <div class="single-product-item-info">
                <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
                <div class="best-sellers-item-price">
                  <span>$35.00</span>
                  <del>$40.00</del>
                  <div class="save-price">
                    <p>save 5%</p>
                  </div>
                </div>
                <div class="single-product-reviews">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <p>575 reviews</p>
                </div>
                <div class="single-product-btn-group">
                  <button type="submit">add to cart</button>
                  <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="single-product-item">
              <a href="#"><img src="assets/images/product-3.jpg"></a>
              <div class="single-product-item-info">
                <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
                <div class="best-sellers-item-price">
                  <span>$35.00</span>
                  <del>$40.00</del>
                  <div class="save-price">
                    <p>save 5%</p>
                  </div>
                </div>
                <div class="single-product-reviews">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <p>575 reviews</p>
                </div>
                <div class="single-product-btn-group">
                  <button type="submit">add to cart</button>
                  <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="single-product-item">
              <a href="#"><img src="assets/images/product-1.jpg"></a>
              <div class="single-product-item-info">
                <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
                <div class="best-sellers-item-price">
                  <span>$35.00</span>
                  <del>$40.00</del>
                  <div class="save-price">
                    <p>save 5%</p>
                  </div>
                </div>
                <div class="single-product-reviews">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <p>575 reviews</p>
                </div>
                <div class="single-product-btn-group">
                  <button type="submit">add to cart</button>
                  <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="single-product-item">
              <a href="#"><img src="assets/images/product-2.jpg"></a>
              <div class="single-product-item-info">
                <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
                <div class="best-sellers-item-price">
                  <span>$35.00</span>
                  <del>$40.00</del>
                  <div class="save-price">
                    <p>save 5%</p>
                  </div>
                </div>
                <div class="single-product-reviews">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <p>575 reviews</p>
                </div>
                <div class="single-product-btn-group">
                  <button type="submit">add to cart</button>
                  <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="single-product-item">
              <a href="#"><img src="assets/images/product-3.jpg"></a>
              <div class="single-product-item-info">
                <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
                <div class="best-sellers-item-price">
                  <span>$35.00</span>
                  <del>$40.00</del>
                  <div class="save-price">
                    <p>save 5%</p>
                  </div>
                </div>
                <div class="single-product-reviews">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <p>575 reviews</p>
                </div>
                <div class="single-product-btn-group">
                  <button type="submit">add to cart</button>
                  <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section>


			<?php if($config_gr_status) { ?>
	<span itemscope itemtype="http://schema.org/Product">
		<meta itemprop="name" content="<?php echo $heading_title; ?>">
 <?php if(!empty($sku)) { ?><meta itemprop="sku" content="<?php echo $sku; ?>"> <?php }?> <?php if(!empty($thumb)) { ?><meta itemprop="image" content="<?php echo $thumb ?>"> <?php }?><?php if(!empty($isbn)) { ?><meta itemprop="mpn" content="<?php echo $isbn; ?>"> <?php }?>  
		<meta itemprop="url" content="<?php echo $plink; ?>">
		<?php if($meta_description != "") { ?><meta itemprop="description" content="<?php echo $meta_description; ?>" /><?php } ?>
		<?php if(isset($pimage)) { ?><meta itemprop="image" content="<?php echo str_replace(" ","%20",$pimage); ?>" /><?php } ?>
		<?php if($model != "") { ?><meta itemprop="model" content="<?php echo $model; ?>"><?php } ?>
		<?php if($manufacturer != "") { ?><meta itemprop="brand" content="<?php echo $manufacturer; ?>"><?php } ?>
	 	<?php foreach ($pcurrencies as $currency) { ?><span itemscope itemprop="offers" itemtype="http://schema.org/Offer">
				<meta itemprop="price" content="<?php echo $currency['price']; ?>">
<meta itemprop="url" content="<?php echo $plink; ?>"><meta itemprop="priceValidUntil" content="2025-12-02">
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
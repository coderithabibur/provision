<?php echo $header; ?>

  <section class="hero-slider swiper">
    <div class="swiper-wrapper">

      <!-- Slide 1 -->
      <div class="swiper-slide hero-slide">
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

      <!-- Slide 2 -->
      <div class="swiper-slide hero-slide">
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

      <!-- Slide 3 -->
      <div class="swiper-slide hero-slide">
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

    </div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>

    <!-- Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </section>

  <section class="greyBg">
    <div class="container">
      <div class="row inline-flex"><?php //echo $column_left; ?>
        <div class="col-xs-12">
          <div class="row">
            <div class="">
              <div class="theading" id="featuredBlock">
                <h1>Featured Products</h1>
              </div>
            </div>
          </div>
          <div id="content"></div>
          <?php echo $column_right; ?>
      </div>
    </div>
  </section>

  <!-- Featured Categories Section -->
  <section class="best-seller-area">
    <div class="container">
      <div class="best-seller-title">
        <h2>best selling</h2>
        <ul>
          <li><button class="active">led</button></li>
          <li><button>hid</button></li>
          <li><button>Laser Driving Lights</button></li>
          <li><button>Laser Light Bar</button></li>
        </ul>
      </div>
      <div class="best-seller-product-grid">

          <?php echo $column_right; ?>
        
          <div class="single-product-item">
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>"></a>
            <div class="single-product-item-info">
              <h2><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>
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

    <div class="container category-cards">
      <div class="category-card">
        <div class="category-card-content">
          <h3>buy one</h3>
          <h3>get one free</h3>
          <p>Exhaust Pipe - Now 50% Savings</p>
          <span>Total = <strong>$35.00</strong></span>
          <a href="#">buy Now</a>
        </div>
        <div class="single-buy-get-free">
          <div class="buy-get-free-images">
            <img src="assets/images/light-1.png">
            <div class="plus-sybol">
              <p>+</p>
            </div>
            <img src="assets/images/light-1.png">
          </div>
          <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
          <div class="best-sellers-item-price">
            <span>$35.00</span>
            <del>$70.00</del>
            <div class="save-price">
              <p>save 5%</p>
            </div>
          </div>
        </div>
      </div>
      <div class="category-card">
        <div class="category-card-content">
          <h3>buy one</h3>
          <h3>get one free</h3>
          <p>Exhaust Pipe - Now 50% Savings</p>
          <span>Total = <strong>$35.00</strong></span>
          <a href="#">buy Now</a>
        </div>
        <div class="single-buy-get-free">
          <div class="buy-get-free-images">
            <img src="assets/images/light-1.png">
            <div class="plus-sybol">
              <p>+</p>
            </div>
            <img src="assets/images/light-1.png">
          </div>
          <h2><a href="#">D2R HID Xenon Bulbs - Buy One Get One Free - Express Delivery Included</a></h2>
          <div class="best-sellers-item-price">
            <span>$35.00</span>
            <del>$70.00</del>
            <div class="save-price">
              <p>save 5%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

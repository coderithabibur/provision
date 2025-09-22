<?php echo $header; ?>

<!-- <pre>
  <?php //print_r($data['categories']);?>
  <?php //print_r($data['buy1get1']);?>
  <?php //print_r($data['buy1get12']);?>
</pre> -->

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
            <img src="https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D1S-Globes/HID-D1S-HID-Xenon-Globes-Australia-450x450.png">
            <div class="plus-sybol">
              <p>+</p>
            </div>
            <img src="https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D1S-Globes/HID-D1S-HID-Xenon-Globes-Australia-450x450.png">
          </div>
          <h2><a href="<?php echo $data['buy1get1']['href'] ?>"><?php echo $data['buy1get1']['name']; ?></a></h2>
          <div class="best-sellers-item-price">
            <span><?php echo $data['buy1get1']['price'] ?></span>
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
          <p><?php echo $data['buy1get1']['model']; ?> - Now 50% Savings</p>
          <span>Total = <strong><?php echo $data['buy1get12']['price'] ?></strong></span>
          <a href="<?php echo $data['buy1get1']['href'] ?>">buy Now</a>
        </div>
        <div class="single-buy-get-free">
          <div class="buy-get-free-images">
            <img src="https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D2R-Globes/D2R-HID-Xenon-Globe-Replacements-Australia-450x450.jpg">
            <div class="plus-sybol">
              <p>+</p>
            </div>
            <img src="https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D2R-Globes/D2R-HID-Xenon-Globe-Replacements-Australia-450x450.jpg">
          </div>
          <h2><a href="<?php echo $data['buy1get12']['href'] ?>"><?php echo $data['buy1get12']['name']; ?></a></h2>
          <div class="best-sellers-item-price">
            <span><?php echo $data['buy1get12']['price'] ?></span>
            <del>$70.00</del>
            <div class="save-price">
              <p>save 5%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="hightlights-area">
    <div class="hightlights-content-area">
    <?php if (!empty($data['categories'])) : ?>
      <?php foreach($data['categories'] as $category) : ?>
        <div class="single-highlights-item" style="background-image: url('https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D2R-Globes/D2R-HID-Xenon-Globe-Replacements-Australia-450x450.jpg);">
          <div class="highlights-item-info">
            <span>4 products</span>
            <h2><?php echo $category['name'] ?></h2>
          </div>
          <a href="index.php?route=product/category&path=<?php echo $category['category_id']; ?>">Shop now</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>

  <section class="category-based-products">
    <div class="container">
      <div class="single-category-based">
        <div class="single-category-based-left" style="background-image: url(https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D2R-Globes/D2R-HID-Xenon-Globe-Replacements-Australia-450x450.jpg);">
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
  </section>
     
  <!-- Product Categories -->
  <section class="product-categories">
    <div class="category-grid">
      <a href="#" class="category-item" style="background-image: url(https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D1S-Globes/HID-D1S-HID-Xenon-Globes-Australia-450x450.png);">
        <div class="category-content">
          <h4>Driving Lights</h4>
          <h2>Type-X™ EVO</h2>
          <p>Shaping the Future.</p>
          <span>Learn more ></span>
        </div>
      </a>
      <a href="#" class="category-item" style="background-image: url(https://dy2yl24vzmra3.cloudfront.net/image/cache/catalog/HID/HID-Bulbs/OEM Bulbs/D1S-Globes/HID-D1S-HID-Xenon-Globes-Australia-450x450.png);">
        <div class="category-content">
          <p>LED Driving Lights</p>
          <h2>Type-X™ Sport</h2>
          <p>Legendary Hyper™ DNA.</p>
          <span>Learn more ></span>
        </div>
      </a>
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

  <img src="assets/images/review.png" style="width: 100%;">

  <!-- Logo Slider -->
  <!-- <section class="brand-logo-slider">
    <div class="container">
      <h2>featured brand</h2>
      <div class="brand-slider swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="assets/images/logo-1.png" alt="Brand 1"></div>
          <div class="swiper-slide"><img src="assets/images/logo-2.png" alt="Brand 2"></div>
          <div class="swiper-slide"><img src="assets/images/logo-3.png" alt="Brand 3"></div>
          <div class="swiper-slide"><img src="assets/images/logo-4.png" alt="Brand 4"></div>
          <div class="swiper-slide"><img src="assets/images/logo-5.png" alt="Brand 5"></div>
          <div class="swiper-slide"><img src="assets/images/logo-6.png" alt="Brand 6"></div>
          <div class="swiper-slide"><img src="assets/images/logo-1.png" alt="Brand 1"></div>
          <div class="swiper-slide"><img src="assets/images/logo-2.png" alt="Brand 2"></div>
          <div class="swiper-slide"><img src="assets/images/logo-3.png" alt="Brand 3"></div>
          <div class="swiper-slide"><img src="assets/images/logo-4.png" alt="Brand 4"></div>
          <div class="swiper-slide"><img src="assets/images/logo-5.png" alt="Brand 5"></div>
          <div class="swiper-slide"><img src="assets/images/logo-6.png" alt="Brand 6"></div>
        </div>
      </div>
    </div>
  </section> -->

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

  <?php echo $footer; ?>
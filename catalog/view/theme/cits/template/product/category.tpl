<?php echo $header; ?>

<section class="category-product-area">
    <div class="container">
      <div class="category-title">
        <h2><?php echo $heading_title; ?></h2>
      </div>
      <div class="category-filter-area">
        <ul>
          <li><button class="active">LED Headlights</button></li>
          <li><button>LED Headlight Bulbs</button></li>
          <li><button>LED LIGHT BARS</button></li>
          <li><button>LED Work Lights</button></li>
          <li><button>LED Driving Lights</button></li>
          <li><button>LED Headlight Control Modules</button></li>
        </ul>
      </div>
      <div class="category-product-grid"> 
        <?php if ($products) { ?>
        <?php foreach ($products as $product) { ?>
          <div class="single-product-item">
            <a href="<?php echo $product['href']; ?>">
              <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
            </a>
            <div class="single-product-item-info">
              <h2><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>
              <div class="best-sellers-item-price">
                <span><?php echo $product['price']; ?></span>
                <del><?php echo $product['special']; ?></del>
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
                <p><?php echo $product['reviews']; ?></p>
              </div>
              <div class="single-product-btn-group">
                <button onclick="cart.add('<?php echo $product['product_id']; ?>');">
                  <?php echo $button_cart; ?>
                </button>
                <button><i class="fa-solid fa-code-compare"></i></button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="pagination">
        <?php echo $pagination; ?>
        <span class="results"><?php echo $results; ?></span>
      </div>

      <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
      <?php } ?>
    </div>
  </section>

  <section class="category-info-area">
    <div class="container">
      <!-- <h2>Led lights</h2> -->
      <div class="category-content-area">
        <?php echo $description; ?>
      </div>
    </div>
  </section>

  <?php echo $footer; ?>
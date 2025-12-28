<?php if ($products) { ?>
  <?php foreach ($products as $product) { ?>
    <div class="single-product-item">
      <a href="<?php echo $product['href']; ?>">
        <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
      </a>
      <div class="single-product-item-info">
        <h2><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>
        <div class="best-sellers-item-price">
          <?php if ($product['special']) { ?>
            <span><?php echo $product['special']; ?></span>
            <del><?php echo $product['price']; ?></del>
            <div class="save-price">
              <p>save 
                <?php
                  // This calculation is preserved from your original code
                  $old = (float)preg_replace('/[^0-9.]/', '', $product['price']);
                  $new = (float)preg_replace('/[^0-9.]/', '', $product['special']);
                  if ($old > 0 && $new > 0) { echo round((($old - $new) / $old) * 100) . '%'; }
                ?>
              </p>
            </div>
          <?php } else { ?>
            <span><?php echo $product['price']; ?></span>
          <?php } ?>
        </div>
        <div class="single-product-reviews">
          <ul>
            <li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li>
          </ul>
          <p><?php echo $product['reviews']; ?> reviews</p>
        </div>
        <div class="single-product-btn-group">
          <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></button>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <p style="text-align: center; width: 100%; padding: 20px;"><?php echo $text_empty; ?></p>
<?php } ?>


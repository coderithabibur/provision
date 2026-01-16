  <div id="cart" class="cartBoxTop">
    <!-- Restoring button for JS compatibility (hidden via CSS if acceptable, or kept as invisible hook) -->
    <button type="button" data-loading-text="<?php echo $text_loading; ?>" class="heading dropdown-toggle" style="display:none;">
      <span id="cart-total"><?php echo $text_items; ?></span>
    </button>

    <div class="sidebar-cart">
      <div class="sidebar-cart-top">
        <h3>Shopping Cart</h3> 
        <button class="sidebar-cart-close" aria-label="Close Cart">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <!-- Changed back to ul for JS 'load' compatibility: $('#cart ul').load(...) -->
      <ul class="cartInputBox">      
        <?php if ($products || $vouchers) { ?>
        
          <div class="cart-products-list">
            <?php foreach ($products as $product) { ?>
              <li class="minicart-item">
                <div class="minicart-img">
                  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>">
                </div>
                <div class="minicart-item-info">
                  <a href="<?php echo $product['href']; ?>" class="product-name"><?php echo $product['name']; ?></a>

                  <div class="minicart-quantity-price">
                    <div class="minicart-qty">
                      x<?php echo $product['quantity']; ?>                  
                    </div>
                    <span class="minicart-price"><?php echo $product['total']; ?></span>
                  </div>
                </div>
                <button type="button" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"
                  title="<?php echo $button_remove; ?>" class="minicart-remove"><i class="fa fa-times"></i></button>
              </li>
            <?php } ?>
          </div>

          <li class="cart-totals">
            <table class="table table-bordered tableCart">
              <?php foreach ($totals as $total) { ?>
              <tr>
                <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
                <td class="text-right"><?php echo $total['text']; ?></td>
              </tr>
              <?php } ?>
            </table>
            <div class="cart-buttons">
              <a class="viewCart minicart-btn minicart-view-cart" href="<?php echo $cart; ?>">
                <strong><i class="fa fa-shopping-cart"></i> <?php echo $text_cart; ?></strong>
              </a>
              <a class="viewCart minicart-btn minicart-checkout" href="<?php echo $checkout; ?>">
                <strong><i class="fa fa-share"></i> <?php echo $text_checkout; ?></strong>
              </a>
            </div>
          </li>

        <?php } else { ?>
          <li class="empty-cart-message">
            <p class="text-center"><?php echo $text_empty; ?></p>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
                <?php if (isset($nitropack_script)) { echo $nitropack_script; } ?>
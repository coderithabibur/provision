  <div id="cart" class="cartBoxTop">
    <div class="cartInfo" id="cart">
      <?php
        preg_match('/\d+/', $text_items, $matches);
        $item_count = isset($matches[0]) ? $matches[0] : 0;
      ?>
      <button type="button" data-loading-text="<?php echo $text_loading; ?>" class="item">
        <?php echo $item_count; ?>
      </button>
    </div>
    <div class="sidebar-cart">
      <div class="sidebar-cart-top">
        <h3>Shopping Cart</h3> 
        <button class="sidebar-cart-close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <ul class="cartInputBox">      
        <?php if ($products || $vouchers) { ?>
        <li>
          <table class="table cartTable">
            <?php foreach ($products as $product) { ?>
              <div class="minicart-item">
                <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>">
                <div class="minicart-item-info">
                  <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>

                  <?php if ($product['option']) { ?>
                  <?php foreach ($product['option'] as $option) { ?>
                  <small>- <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br>
                  <?php } ?>
                  <?php } ?>

                  <div class="minicart-quantity-price">
                    <div class="minicart-quantity">
                      x<?php echo $product['quantity']; ?>                  
                    </div>
                    <span class="minicart-price"><?php echo $product['total']; ?></span>
                  </div>
                </div>
                <button class="minicart-remove" type="button" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"
                  title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
              </div>
            <?php } ?>
          </table>
        </li>

        <li>
          <div>
            <table class="table table-bordered tableCart">
              <?php foreach ($totals as $total) { ?>
              <tr>
                <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
                <td class="text-right"><?php echo $total['text']; ?></td>
              </tr>
              <?php } ?>
            </table>
            <p class="text-right">
              <a class="viewCart minicart-btn minicart-view-cart" href="<?php echo $cart; ?>"><strong><i class="fa fa-shopping-cart"></i> 
                <?php echo $text_cart; ?></strong>
              </a>
              <a class="viewCart minicart-btn minicart-checkout" href="<?php echo $checkout; ?>"><strong><i class="fa fa-share"></i>
              <?php echo $text_checkout; ?></strong>
            </a>
          </p>
          </div>
        </li>

        <?php } else { ?>
        <li>
          <p class="text-center"><?php echo $text_empty; ?></p>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
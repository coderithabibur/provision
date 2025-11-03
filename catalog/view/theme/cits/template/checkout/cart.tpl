<?php echo $header; ?>
<section class="bannerOuter paddingless cart-title">
  <div class="container">
    <div class="cits-shopping-tab-area">
      <ul>
        <li><a class="active" href="/index.php?route=checkout/cart"><span><?php echo $heading_title; ?> <span
                class="num-text">01</span></span></a></li>
        <li><a href="/index.php?route=checkout/checkout"><span>checkout <span class="num-text">02</span></span></a></li>
        <li>
          <a href="#">
            <span>order complete <span class="num-text">03</span></span>            
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>
<section class="greyBg paddingtop30 cart-content-area">
  <div class="cits-shopping-cart-layout">
    <div class="container">
      <div class="cits-cart-left">
        <?php if ($attention) { ?>
        <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="row"><?php echo $column_left; ?>
          <?php if ($column_left && $column_right) { ?>
          <?php $class = 'col-sm-6'; ?>
          <?php } elseif ($column_left || $column_right) { ?>
          <?php $class = 'col-md-9 col-sm-8 col-xs-12'; ?>
          <?php } else { ?>
          <?php $class = 'col-sm-12'; ?>
          <?php } ?>
          <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div id="preCheckout">
                <div class="orderTable table-responsive">
                  <table>
                    <tbody>
                      <tr class="tableHead">
                        <td class="text-center"><?php echo $column_image; ?></td>
                        <td class="text-left"><?php echo $column_name; ?></td>
                        <td class="text-left"><?php echo $column_model; ?></td>
                        <td class="text-left"><?php echo $column_quantity; ?></td>
                        <td class="text-right"><?php echo $column_price; ?></td>
                        <td class="text-right"><?php echo $column_total; ?></td>
                      </tr>
                      <?php $i = 1; ?>
                      <?php foreach ($products as $product) { ?>
                      <tr id="cross-<?php echo $i ?>">
                        <td class="text-center"><?php if ($product['thumb']) { ?>
                          <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>"
                              alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                          <?php } else { ?>
                          <a href="<?php echo $product['href']; ?>"><img height="47" width="47"
                              src="<?php echo $base."image/cache/placeholder-239x247.png"; ?>"
                              alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"
                              class="img-thumbnail" /></a>
                          <?php } ?></td>
                        <td class="text-left"><a
                            href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                          <?php if (!$product['stock']) { ?>
                          <span class="text-danger">***</span>
                          <?php } ?>
                          <?php if ($product['option']) { ?>
                          <?php foreach ($product['option'] as $option) { ?>
                          <br />
                          <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                          <?php } ?>
                          <?php } ?>
                          <?php if ($product['reward']) { ?>
                          <br />
                          <small><?php echo $product['reward']; ?></small>
                          <?php } ?>
                          <?php if ($product['recurring']) { ?>
                          <br />
                          <span class="label label-info"><?php echo $text_recurring_item; ?></span>
                          <small><?php echo $product['recurring']; ?></small>
                          <?php } ?></td>
                        <td class="text-left">
                          <p>Model: </p><?php echo $product['model']; ?>
                        </td>
                        <td class="text-left">
                          <p>Quantity: </p>
                          <input type="number" name="quantity[<?php echo $product['cart_id']; ?>]"
                            value="<?php echo $product['quantity']; ?>" class="qtyValue" />
                          <button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>"
                            class="refresh"><img src="catalog/view/theme/hidlighting/images/refreshicon.png"
                              alt=""></button>
                          <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>"
                            class="crossIcon" value="Delete Row"
                            onclick="cart.remove('<?php echo $product['cart_id']; ?>'); window.location.reload();"> <i
                              class="fa-solid fa-times"
                              style="color: red; font-size: 23px; transform: translateY(3px);"></i> </button>
                        </td>
                        <td class="text-left">
                          <p>Unit Price: </p><?php echo $product['price']; ?>
                        </td>
                        <td>
                          <p>Total Price: </p><?php echo $product['total']; ?>
                        </td>
                      </tr>
                      <?php $i++; ?>
                      <?php } ?>
                      <?php foreach ($vouchers as $vouchers) { ?>
                      <tr>
                        <td></td>
                        <td class="text-left"><?php echo $vouchers['description']; ?></td>
                        <td class="text-left"></td>
                        <td class="text-left">
                          <div class="input-group btn-block" style="max-width: 200px;">
                            <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                            <span class="input-group-btn"><button type="button" data-toggle="tooltip"
                                title="<?php echo $button_remove; ?>" class="btn btn-danger"
                                onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"><i
                                  class="fa fa-times-circle"></i></button></span></div>
                        </td>
                        <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                        <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- <p class="slideView01">Slide table to view </p> -->
              </div>
            </form>

            <div class="cart-coupon-info">
              <?php if ($coupon || $voucher || $reward || $shipping) { ?>
              <h2><?php echo $text_next; ?></h2>
              <p><?php echo $text_next_choice; ?></p>
              <div class="cartCouponArea" id="accordion">
                <?php echo $coupon; ?>
                <?php echo $voucher; ?>
                <?php echo $reward; ?>
                <?php echo $shipping; ?>
              </div>
              <?php } ?>
            </div>

          </div>
          <?php echo $column_right; ?></div>

      </div>
      <div class="cits-cart-right">
        <div class="order-summary-top">
          <h3>Order Summary</h3>
        </div>
        <div class="cartTotal">
          <?php foreach ($totals as $total) { ?>
          <div class="cartAmount">
            <label><?php echo $total['title']; ?>: </label>
            <div class="labelInfo"><?php echo $total['text']; ?></div>
          </div>
          <?php } ?>
        </div>
        <div class="cartbtnArea">
          <a href="<?php echo $checkout; ?>"><?php echo $button_checkout; ?></a>
        </div>
        <?php echo $content_bottom; ?>
        <div class="cits-cart-right-payment-image">
          <img src="catalog/view/theme/cits/assets/images/Payment Option.webp">
        </div>
      </div>
    </div>
  </div>



</section>
<script>
  if ($(window).width() < 360) {
    $(document).ready(function () {
      $('html, body').animate({
        scrollTop: $('.pageTitle').offset().top
      }, 'slow');
    });
  }
</script>
<script>
  $('.crossIcon').click(function (e) {
    $(this).closest('tr').remove();
    return false;
  })
</script>
<?php echo $footer; ?>
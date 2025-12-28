  


<?php echo $header; ?>
<section class="greyBg paddingtop30">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
         <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
        </ol>
      </div>
    </div>

    <section class="bannerOuter paddingless">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="pageTitle"><h1><?php echo $heading_title; ?></h1></div>
          </div>
        </div>
      </div>
    </section>

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      
      <div id="content"><?php echo $content_top; ?>
      <?php if ($products) { ?>   
      <div class="category-product-grid">
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
                          $old = floatval(strip_tags(preg_replace('/[^0-9.]/', '', $product['price'])));
                          $new = floatval(strip_tags(preg_replace('/[^0-9.]/', '', $product['special'])));

                          if ($old > 0) {
                            echo round((($old - $new) / $old) * 100) . '%';
                          }
                        ?>
                      </p>
                    </div>
                <?php } else { ?>
                    <span><?php echo $product['price']; ?></span>
                <?php } ?>
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
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php if($pagination){?>
      <div class="row">
          <div class="col-xs-12">
            <div class="paginationOuter">
              <?php echo $pagination; ?>
            </div>
          </div>
        </div>
      <?php } } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
    </div>
    </div>
  
</section>
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
  url = 'index.php?route=product/search';

  var search = $('#content input[name=\'search\']').prop('value');

  if (search) {
    url += '&search=' + encodeURIComponent(search);
  }

  var category_id = $('#content select[name=\'category_id\']').prop('value');

  if (category_id > 0) {
    url += '&category_id=' + encodeURIComponent(category_id);
  }

  var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');

  if (sub_category) {
    url += '&sub_category=true';
  }

  var filter_description = $('#content input[name=\'description\']:checked').prop('value');

  if (filter_description) {
    url += '&description=true';
  }

  location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
  if (e.keyCode == 13) {
    $('#button-search').trigger('click');
  }
});

$('select[name=\'category_id\']').on('change', function() {
  if (this.value == '0') {
    $('input[name=\'sub_category\']').prop('disabled', true);
  } else {
    $('input[name=\'sub_category\']').prop('disabled', false);
  }
});

$('select[name=\'category_id\']').trigger('change');
--></script>

			    <!--START - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
			        <?php if (isset($product_impression_script)) { echo $product_impression_script; } ?> 
			    <!--END - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
            	
<?php echo $footer; ?>

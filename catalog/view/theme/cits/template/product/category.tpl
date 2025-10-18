<?php echo $header; ?>
<section class="category-product-area">
  <div class="container">
    <div class="category-title">
      <h2><?php echo $heading_title; ?></h2>
    </div>

    <!-- ============================================= -->
    <!-- === 1. DYNAMIC SUB-CATEGORY FILTER AREA === -->
    <!-- ============================================= -->
    <?php if ($sub_categories) { ?>
    <div class="category-filter-area">
      <ul> 
        <li><button class="category-filter-btn active" data-categoryid="<?php echo $current_category_id; ?>">All <?php echo $heading_title; ?></button></li>
         
        <?php foreach ($sub_categories as $sub_category) { ?>
          <li><button class="category-filter-btn" data-categoryid="<?php echo $sub_category['category_id']; ?>"><?php echo $sub_category['name']; ?></button></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
    <!-- ============================================= -->
 
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
                  <li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li>
                </ul>
                <p><?php echo $product['reviews']; ?> Reviews</p>
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
      <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
      <?php } ?>
    </div>
    
    <div class="pagination category-product-pagination">
      <?php echo $pagination; ?>
      <span class="results"><?php echo $results; ?></span>
    </div>
  </div>
</section>

<section class="category-info-area">
  <div class="container">
    <div class="category-content-area">
      <?php echo $description; ?>
    </div>
  </div>
</section>

<!-- ============================================= -->
<!-- === 2. JAVASCRIPT FOR THE AJAX FILTER === -->
<!-- ============================================= -->
<script type="text/javascript">
$(document).ready(function() {
    $('.category-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('.category-filter-btn').removeClass('active');
        $(this).addClass('active');
        var category_id = $(this).data('categoryid');

        $.ajax({ 
            url: 'index.php?route=product/category/getCategoryProducts&category_id=' + category_id,
            type: 'get',
            dataType: 'html',
            beforeSend: function() {
                $('.category-product-grid').html('<span class="loader"></span>');
                $('.pagination').hide();  
            },
            success: function(html) {
                $('.category-product-grid').html(html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
});
</script>

<style>
.category-filter-area button.active {
    background-color: #f0ad4e; 
    color: #fff;
}
</style>

<?php echo $footer; ?>


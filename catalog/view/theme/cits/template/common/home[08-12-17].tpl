<?php echo $header; ?>
<section class="bannerOuter">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="banner">
        <?php echo $content_top; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="greyBg">
  <div class="container">
    <div class="row"><?php echo $column_left; ?>     
      <div class="col-md-9 col-sm-8 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="theading testClass" id="featuredBlock">
              <h2>Featured Products</h2>
            </div>
          </div>
        </div>
         <div id="content"></div>
          <?php echo $column_right; ?>          
        </div>
    </div>  
</section>
 <?php echo $content_bottom; ?>
<?php echo $footer; ?>
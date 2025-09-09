<?php echo $header; ?>

<section class="bannerOuter home100">
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

<?php echo $content_bottom; ?>
<?php echo $footer; ?>
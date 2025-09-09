<section class="greyPattern" id="latestBlock">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="heading"><span><b>
          <h2><?php echo $heading_title; ?></h2>
          </b></span></div>
      </div>
    </div>
    <div class="row">
      <div class="newArrivalsOuter">
          <?php $i=1 ;?>
          <?php foreach ($products as $product) {
            if($i > 4){
              break;
            }
            ?>
        <div class="col-md-3 col-sm-4 col-xs-6 full">          
        <div class="column">
           <div class="productThumb"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
           <div class="desc"><div class="thead"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
           <div class="cartBox">
          <?php if ($product['price']) { ?>
         <?php if (!$product['special']) { ?>
          <p class="price">   
          <?php echo $product['price']; ?>
          </p>
          <?php } else { ?>
          <p class="price"><?php echo $product['special']; ?> <span class="price-old"><?php echo $product['price']; ?></span></p>
          <?php } ?> 
        <?php } ?>
       <button class="yellowbtn btn-2 btn-2a" onclick="cart.add('<?php echo $product['product_id']; ?>');"><img src="catalog/view/theme/hidlighting/images/cart.png" alt=""><b><?php echo $button_cart; ?></b></button>
  <button class="yellowbtn combtn Btn1<?php echo $product['product_id']; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"> <b>Add To Compare </b></button>
       <button class="yellowbtn combtn1 Btn12<?php echo $product['product_id']; ?>" onclick="location.href = '<?php echo $compare; ?>';"  style="display: none;"><b>Compare Now</b></button> 
           </div>
           </div>     
         </div>
        </div>     
      <?php $i++ ; } ?>
      </div>
    </div>
  </div>
</section>


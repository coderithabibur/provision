<div class="row inline-flex">
  <?php foreach ($products as $product) {
    ?>
  <div class="col-md-3 col-sm-6 col-xs-6 full">
   <div class="columnOuter">
    <div class="column">
      <div class="productThumb"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
      <div class="desc"><div class="thead"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
      <div class="cartBox">



 <?php $productmoney = $product['price']; ?>
         <?php if ($productmoney == '$0.00') { ?>
         <p class="price">&nbsp;</p>
          <?php } else { ?>


  	<?php if ($product['price']) { ?>
          <?php if (!$product['special']) { ?>
          <p class="price">
          <?php echo $product['price']; ?>
          </p>
          <?php } else { ?>
          <p class="price"><?php echo $product['special']; ?> <span class="price-old"><?php echo $product['price']; ?></span></p>
          <?php } ?>
        <?php } ?>
         <?php } ?>


       <button class="yellowbtn btn-2 btn-2a" onclick="cart.add('<?php echo $product['product_id']; ?>');"><img src="catalog/view/theme/hidlighting/images/cart.png" alt=""><b><?php echo $button_cart; ?></b></button>
  <button class="yellowbtn combtn Btn1<?php echo $product['product_id']; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"> <b>Add To Compare </b></button>
       <button class="yellowbtn combtn1 Btn12<?php echo $product['product_id']; ?>" onclick="location.href = '<?php echo $compare; ?>';"  style="display: none;"><b>Compare Now</b></button>
      </div>
      </div>
		<div class="ratingsAndReviews">
			 <?php if ($product['rating']) { ?>
			<div class="rating">
			  <?php for ($i = 1; $i <= 5; $i++) { ?>
			  <?php if ($product['rating'] < $i) { ?>
			  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } else { ?>
			  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } ?>
			  <?php } ?>
			</div>
        <?php } ?>

			<div class="reviews">
				<a href="<?php echo $product['href']; ?>#customerReview"><?php echo $product['reviews']; ?></a>
				|
				<a href="<?php echo $product['href']; ?>#customerReview"><?php echo $text_write; ?></a>
			</div>

		</div>



    </div>
  </div>
  </div>
  <?php
  } ?>
</div>

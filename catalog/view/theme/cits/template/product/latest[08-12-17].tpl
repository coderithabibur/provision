<?php echo $header; ?>
<section class="bannerOuter paddingless">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="pageTitle"><h1>Product listing</h1></div>
      </div>
    </div>
  </div>
</section>
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
    <div class="row">
    <?php echo $column_left; ?>
      <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-md-9 col-sm-8 col-xs-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div class="<?php echo $class?>"><?php echo $content_top; ?>     
    
          <div class="row">
          <div class="col-xs-12">
            <div class="theading">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 full">
                  <h2><?php echo $heading_title; ?></h2>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 full">
                  <?php if ($products) { ?>
                  <div class="selectBox">
                    <label><?php echo $text_limit; ?></label>
                    <div class="selectBG left">
                      <select id="input-limit" onchange="location = this.value;">
                          <?php foreach ($limits as $limits) { ?>
                        <?php if ($limits['value'] == $limit) { ?>
                        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                        <?php } ?>
                        <?php } ?>
                                              
                      </select>
                    </div>
                  </div>
                  <div class="selectBox">
                    <label><?php echo $text_sort; ?></label>
                    <div class="selectBG">
                      <select id="input-sort" onchange="location = this.value;">
                      <?php foreach ($sorts as $sorts) { ?>
                          <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                          <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                          <?php } ?>
                          <?php } ?>  
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
			<div id="content"></div> 
          </div>
        </div>     
      <?php if ($products) { ?>   
      <div class="row">
      <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-md-4 col-sm-6 col-xs-6 full'; ?>
    <?php } else { ?>
    <?php $class = 'col-md-3 col-sm-6 col-xs-6 full'; ?>
    <?php } ?>
        <?php foreach ($products as $product) { ?>
          <div class="<?php echo $class?>">
          <div class="columnOuter">
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
    <?php echo $column_right; ?>
      
    </div>
  
    
    </div>   
</section>
<?php echo $footer; ?>

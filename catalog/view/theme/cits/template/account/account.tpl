<?php echo $header; ?>
<section class="bannerOuter paddingless">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="pageTitle"><h1><?php echo $heading_title; ?></h1></div>
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
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-xs-12 col-sm-8 col-lg-9 col-md-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
       <div class="row">
          <div class="col-xs-12">
            <div class="theading">
              <h2><?php echo $heading_title; ?></h2>
            </div>
          </div>
        </div>
        <div class="accountInformation">
              <div class="informationBox">
         	<div class="informationBoxContent">
				<div class="heading">
				<h3><?php echo $text_my_account; ?></h3>
				</div>
				</div>	
				<div class="informationBoxInfoBox mbtm">
				<div class="address01">
				<ul class="list-unstyled">
                  <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                  <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                   <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                   <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
				</ul>
				</div>
			  </div>
                </div>
				</div> 
               
               <div class="accountInformation">
              <div class="informationBox"> 
              <div class="informationBoxContent">
				<div class="heading">
				<h3><?php echo $text_my_orders; ?></h3>
				</div>
				</div>
				<div class="informationBoxInfoBox mbtm">
				<div class="address01">
				<ul class="list-unstyled">
                      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                    <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
                    <?php if ($reward) { ?>
                    <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                    <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                    <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
				</ul>
				</div>
				</div>
                </div>
				</div> 
                
        <div class="accountInformation">
              <div class="informationBox">       
               <div class="informationBoxContent">
				<div class="heading">
				<h3><?php echo $text_my_orders; ?></h3>
				</div>
				</div>	
				<div class="informationBoxInfoBox mbtm">
				<div class="address01">
			 <ul class="list-unstyled">
              <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
              </ul>
				</div>
				</div>
                </div>
				</div> 
  
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</section>
<?php echo $footer; ?>

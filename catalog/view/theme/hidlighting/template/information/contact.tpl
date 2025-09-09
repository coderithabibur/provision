<?php echo $header; ?>
<section class="bannerOuter paddingless">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="pageTitle"><h1>Contact Us</h1></div>
      </div>
    </div>
  </div>
</section>
<section class="contentOuter">
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
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-md-9 col-sm-8 col-xs-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">
      <div class="col-xs-12">
        <div class="whiteShadowBox"><?php if ($image) { ?>
          <div class="contactThumb"><img src="<?php echo $image; ?>" alt="<?php echo $store; ?>" title="<?php echo $store; ?>"></div>  <?php } ?>
          <h3 class="contadd"><?php echo $text_address; ?></h3>
          <div class="leftsideadd">
            <p><i aria-hidden="true" class="fa fa-map-marker"></i> <?php echo $address; ?></p>
            <p><i aria-hidden="true" class="fa fa-phone"></i> <?php echo $telephone; ?>, <?php echo $fax; ?>.</p>
          </div>
          <div class="rightsideadd">
            <p><i aria-hidden="true" class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $e_mail; ?>"><?php echo $e_mail; ?></a></p>
            <?php /*if ($fax) { ?><p><i aria-hidden="true" class="fa fa-fax"></i><?php echo $fax; ?></p> <?php } */ ?>
          </div>
        </div>
      </div>
    </div>
      
        <div class="row">
      <div class="col-xs-12">
        <div class="heading top"><span>
          <h2>Have a question or comment?</h2>
          </span></div>        
      </div>
 <div class="col-xs-12">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact-form">
       <div class="fullwidth">
            <div class="left">
              <div class="form-group controls required">
                <label class="control-label"><?php echo $entry_name; ?></label>
                <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control textfeild" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
              </div>
            </div>
            <div class="right">
              <div class="form-group controls required">
                <label class="control-label"><?php echo $entry_phone; ?></label>
                <input type="text" name="phone" value="<?php echo $phone; ?>" id="input-phone" class="form-control textfeild" />
					   <?php if ($error_phone) { ?>
					  <div class="text-danger"><?php echo $error_phone; ?></div>
					  <?php } ?>  
              </div>
            </div>
          </div>
           <div class="fullwidth">
            <div class="left">
              <div class="form-group controls required">
                <label class="control-label"><?php echo $entry_email; ?></label>
               <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control textfeild" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
              </div>
            </div>
            <div class="right">
              <div class="form-group controls required">
               <label class="control-label"><?php echo $entry_subject; ?></label>
                <input type="text" name="subject" value="<?php echo $subject; ?>" id="input-subject" class="form-control textfeild" />
              <?php if ($error_subject) { ?>
              <div class="text-danger"><?php echo $error_subject; ?></div>
              <?php } ?> 
              </div>
            </div>
          </div>
            <div class="fullwidth">
           <div class="form-group controls required"> <label class="control-label"><?php echo $entry_enquiry; ?></label>
             <textarea name="enquiry" rows="10" id="input-enquiry" class="textarea textfeild"><?php echo $enquiry; ?></textarea>
           <?php if ($error_enquiry) { ?>
              <div class="text-danger"><?php echo $error_enquiry; ?></div>
              <?php } ?></div>
          </div>
            <div class="fullwidth captchaContact">
               <div class="form-group controls required"> <label class="control-label"><?php echo $entry_captcha; ?></label>
             <?php echo $captcha; ?>             
            </div>
            </div>
      <div class="fullwidth">
            <input type="submit" class="yellowbtn" value="<?php echo $button_submit; ?>" />
          </div>     
      </form>
 </div>
        </div>
        
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</section>
<?php echo $footer; ?>

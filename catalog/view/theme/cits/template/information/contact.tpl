<?php echo $header; ?>
<section class="contact-us-area">
    <div class="container">
      <div class="contact-header">
        <h2><?php echo $contact_main_title; ?></h2>
        <p><?php echo $contact_main_desc; ?></p>
      </div>
      <?php if ($contact_page_info_status) { ?>
      <div class="contact-content">
        <div class="single-contact-info">
          <i class="fa-solid fa-phone"></i>
          <h2><?php echo $cs_title; ?></h2>
          <a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a>
          <p><?php echo $cs_text; ?></p>
        </div>
        <div class="single-contact-info">
          <i class="fa-solid fa-envelope"></i>
          <h2><?php echo $wtu_title; ?></h2>
          <a href="mailto:<?php echo $e_mail; ?>"><?php echo $e_mail; ?></a>
        </div>
        <div class="single-contact-info">
          <i class="fa-solid fa-user-plus"></i>
          <h2><?php echo $fu_title; ?></h2>
          <ul class="contact-social">
            <?php if (!empty($facebook)) { ?><li><a href="<?php echo $facebook; ?>" target="_blank"><i aria-hidden="true" class="fab fa-facebook"></i></a></li><?php } ?>
            <?php if (!empty($youtube)) { ?><li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fab fa-youtube-play" aria-hidden="true"></i></a></li><?php } ?>
            <?php if (!empty($blogger)) { ?><li><a href="<?php echo $blogger; ?>" target="_blank"><i class="fab fa-blogger-b"></i></a></li><?php } ?>
            <?php if (!empty($instagram)) { ?><li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
          </ul>
        </div>
      </div>
      <?php } ?>
      <div class="contact-form">
        <h2>Do you have some questions?</h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="contact-form">
          <div class="form-group">
            <div class="single-input-item">
              <input 
                type="text" 
                name="name" 
                value="<?php echo $name; ?>" 
                placeholder="Name *" 
                id="input-name" />
              <?php if ($error_name) { ?>
                <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
            <div class="single-input-item">
              <input 
                type="text" 
                name="phone" 
                value="<?php echo $phone; ?>" 
                placeholder="Phone *" 
                id="input-phone" />
              <?php if ($error_phone) { ?>
                <div class="text-danger"><?php echo $error_phone; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group">
            <div class="single-input-item">
              <input 
                type="email" 
                name="email" 
                value="<?php echo $email; ?>" 
                placeholder="Email *" 
                id="input-email" />
              <?php if ($error_email) { ?>
                <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
            <div class="single-input-item">
              <input 
                type="text" 
                name="subject" 
                value="<?php echo $subject; ?>" 
                placeholder="Subject *" 
                id="input-subject" />
              <?php if ($error_subject) { ?>
                <div class="text-danger"><?php echo $error_subject; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <div class="single-input-item">
              <textarea 
                name="enquiry" 
                rows="6" 
                placeholder="Message *" 
                id="input-enquiry"><?php echo $enquiry; ?></textarea>
              <?php if ($error_enquiry) { ?>
                <div class="text-danger"><?php echo $error_enquiry; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <div class="single-input-item contact-captcha">
              <label class="control-label"><?php echo $entry_captcha; ?></label>
              <?php echo $captcha; ?>
            </div>
          </div>

          <button type="submit" class="yellowbtn">
            <?php echo $button_submit; ?>
          </button>
        </form>
        
      </div> 
    </div>
  </section>
<?php echo $footer; ?>

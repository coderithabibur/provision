<?php echo $header; ?>
<section class="contact-us-area">
    <div class="container">
      <div class="contact-header">
        <h2>contact us</h2>
        <p><?php echo $address; ?></p>
      </div>
      <div class="contact-content">
        <div class="single-contact-info">
          <i class="fa-solid fa-phone"></i>
          <h2>Customer service</h2>
          <a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a>
          <p>Call us from 8am to 8pm</p>
        </div>
        <div class="single-contact-info">
          <i class="fa-solid fa-envelope"></i>
          <h2>Write to us</h2>
          <a href="mailto:<?php echo $e_mail; ?>"><?php echo $e_mail; ?></a>
        </div>
        <div class="single-contact-info">
          <i class="fa-solid fa-user-plus"></i>
          <h2>Follow us</h2>
          <ul class="contact-social">
            <?php if (isset($facebook)) { ?><li><a href="<?php echo $facebook; ?>" target="_blank"><i aria-hidden="true" class="fab fa-facebook"></i></a></li><?php } ?>
            <?php if (isset($youtube)) { ?><li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fab fa-youtube-play" aria-hidden="true"></i></a></li><?php } ?>
            <?php if (isset($blogger)) { ?><li><a href="<?php echo $blogger; ?>" target="_blank"><i class="fab fa-blogger-b"></i></a></li><?php } ?>
            <?php if (isset($instagram)) { ?><li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
          </ul>
        </div>
      </div>
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

  <section class="google-map-section">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.37047050643!2d152.8672064761683!3d-25.291754227437703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6bec8055f962236d%3A0xaf31abc68d0e2f39!2sUrangan%20St%2C%20Torquay%20QLD%204655%2C%20Australia!5e0!3m2!1sen!2sbd!4v1760781948810!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>

  <section class="stores-area">
    <div class="container">
      <h2>Stores around the world</h2>
      <div class="stores-grid">
        <div class="single-store">
          <img src="/catalog/view/theme/cits/assets/images/img-1.jpg" alt="Los Angeles">
          <a href="#">Los Angeles</a>
          <p>34 Main Street, Los Angeles 9021 United States</p>
        </div>
        <div class="single-store">
          <img src="/catalog/view/theme/cits/assets/images/img-2.jpg" alt="New York">
          <a href="#">New York</a>
          <p>515 Broadway 10015 New York United States</p>
        </div>
        <div class="single-store">
          <img src="/catalog/view/theme/cits/assets/images/img-3.jpg" alt="California">
          <a href="#">California</a>
          <p>1000 California St 6814 Omaha United States</p>
        </div>
      </div>
    </div>
  </section>

  <!-- <img src="assets/images/review.png" style="width: 100%;"> -->
<?php echo $footer; ?>

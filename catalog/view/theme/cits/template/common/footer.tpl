<?php echo $client_logos_section; ?>
  <!-- Footer Section -->
  <footer class="site-footer">
    
    <!-- Newsletter -->
    <div class="footer-newsletter">
      <div class="container">
        <div class="newsletter-content">
          <div class="newsletter-text">
            <h2>Newsletter</h2>
            <p>Subscribe to our Newsletter and get 10% discount code</p>
          </div>
          <!-- Newsletter Form -->
          <div class="newsletter-form-area">
            <div class="newsletter-form" id="subscribe_field">
              <input 
                type="email" 
                class="footer-input" 
                placeholder="Your e-mail address" 
                name="sub_email" 
                id="sub_email"
              >
              <button class="btn" type="button" id="subscriber">
                SUBSCRIBE
              </button>
            </div>
            <!-- Message area -->
            <span class="subscribe_msg" id="subscribe_msg">
              <span id="error_subscribe" class="error"></span>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Main -->
    <div class="footer-main">
      <div class="container footer-grid">
        <div class="footer-about">
          <a href="<?php echo $home; ?>" class="footer-logo">
            <img src="catalog/view/theme/cits/assets/images/footer-logo.jpg" alt="<?php echo $name; ?>">
          </a>
          <p>Preferred supplier of lighting to professionals for more than 20 years.</p>
          <h2>Social Links</h2>
          <div class="footer-social">
            <ul>
              <li><a href="<?php echo $facebook; ?>" target="_blank"><i aria-hidden="true" class="fab fa-facebook"></i></a></li>
              <li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fab fa-youtube-play" aria-hidden="true"></i></a></li>
              <li><a href="<?php echo $blogger; ?>" target="_blank"><i class="fab fa-blogger-b"></i></a></li>              
              <li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>

        <div class="footer-links">
          <h2>Quick Links</h2>
           <?php if ($informations) { ?>
           <!-- <ul>
            <?php
              $i=1;
              foreach ($informations as $information) {
              if($i == 4){
                break;
              }
            ?>
            <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
            <?php $i++; } ?>
          </ul> -->
          <ul>
            <li><a href="/index.php?route=information/information&information_id=6">Disclaimers</a></li>
            <li><a href="/index.php?route=information/information&information_id=4">About Us</a></li>
            <li><a href="/index.php?route=information/information&information_id=3">Privacy Policy</a></li>
            <li><a href="/index.php?route=information/information&information_id=5">Terms and Conditions</a></li>
            <li><a href="/index.php?route=information/information&information_id=8">Return and Refund Policy</a></li>
          </ul>
          <?php } ?>
        </div>
 
        <div class="footer-contact">
          <h2>Contact</h2>
          <a href="tel:<?php echo $telephone;?>" class="contact-item">
            <i class="fas fa-headset"></i>
            <span>8-4pm Mon-Fri AEST</span>
            <h3><?php echo $telephone;?></h3>
          </a>
          <p><i class="fa-solid fa-location-dot"></i><span><?php echo $address;?></span></p>
          <p><i class="fa-solid fa-phone"></i><a href="tel:<?php echo $telephone;?>"><?php echo $telephone;?></a></p>
          <p><i class="fa-solid fa-envelope"></i><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></p>
        </div>
      </div>
    </div>  

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="container">
        <p><?php echo $powered; ?></p>
        <div class="footer-payments"> 
          <img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/paypal.png">
          <img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/visa.png">
          <img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/discover.png">
          <img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/mastercard.png">
          <img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/american.png"> 
          <img src="catalog/view/theme/cits/images/pp4.png">
        </div>
      </div>
    </div>
  </footer>

  <!-- Newsletter Script -->
<script type="text/javascript"><!--
  $('#subscriber').bind('click', function() { <!-- 
    var email=$("#sub_email").val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if(email == '' || email == "Enter your email") {
      $("#error_subscribe").html('E-Mail id is required!');
      return false;
            }
    else if( !emailReg.test( email ) ) {
      $("#error_subscribe").html('E-Mail id is  not valid!');
      return false;
      }   
    $.ajax({
      url: 'index.php?route=common/footer/subscriber',
      type: 'post',
      data: 'email='+email,
      dataType: 'json',
      beforeSend: function() { 
      /*$('#sub_email').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');*/
      },
      complete: function() {
        $('.wait').remove(); 
      },			
      success: function(json) { 
        //$("#subscribe_field").remove(); 
        if(json['success']==0){
        $("#error_subscribe").html('Email address already exists !');
      }
      else if(json['success']==2){
        $("#error_subscribe").html('Error in subscription!');
      }
      else if(json['success']==1){
        $("#subscribe_msg").html('<span class="subscribe_msg">Sucessfully subscribe!</span>');
      }
      },
      error: function(xhr, ajaxOptions, thrownError) {   
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
      });  
    });
    
    $(document).ready(function(e) {
      $('.responsiveCat button').click(function(e) {
        $('#column-left').removeClass('hidden-xs');		
        $('.category-sec .panel-group').slideToggle(700);
      });	
    }); 
</script>

<script type="text/javascript"><!--
$('#button-search2').bind('click', function() {
  url = 'index.php?route=product/search';

  var search = $('.header-search-box input[name=\'search\']').prop('value');

  if (search) {
    url += '&search=' + encodeURIComponent(search);
  }

  var category_id = $('.header-search-box select[name=\'category_id\']').prop('value');

  if (category_id > 0) {
    url += '&category_id=' + encodeURIComponent(category_id);
  }

  var sub_category = $('.header-search-box input[name=\'sub_category\']:checked').prop('value');

  if (sub_category) {
    url += '&sub_category=true';
  }

  var filter_description = $('.header-search-box input[name=\'description\']:checked').prop('value');

  if (filter_description) {
    url += '&description=true';
  }

  location = url;
});

$('.header-search-box input[name=\'search\']').bind('keydown', function(e) {
  if (e.keyCode == 13) {
    $('#button-search2').trigger('click');
  }
});
 
$(document).ready(function() {
  $('.header-search-category').on('change', function() {
      let $selectedOption = $(this).find('option:selected');
      let optionText = $selectedOption.text();
      let trimmedText = optionText.replace(/^(\s|\u00A0)+/g, '').trim();
      $selectedOption.text(trimmedText);
  });
}); 

$('select[name=\'category_id\']').on('change', function() {
  if (this.value == '0') {
    $('input[name=\'sub_category\']').prop('disabled', true);
  } else {
    $('input[name=\'sub_category\']').prop('disabled', false);
  }
});

$('select[name=\'category_id\']').trigger('change');
--></script>

  
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="catalog/view/theme/cits/assets/js/script.js?v=<?php echo time(); ?>"></script>
  
  <?php echo $custom_footer_code; ?>
  
</body>
</html>
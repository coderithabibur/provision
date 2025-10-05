  <section class="brand-logo-slider">
    <div class="container">
      <h2>Our Clients</h2>
      <div class="brand-slider swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-1.png" alt="Brand 1"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-2.png" alt="Brand 2"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-3.png" alt="Brand 3"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-4.png" alt="Brand 4"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-5.png" alt="Brand 5"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-6.png" alt="Brand 6"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-1.png" alt="Brand 1"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-2.png" alt="Brand 2"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-3.png" alt="Brand 3"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-4.png" alt="Brand 4"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-5.png" alt="Brand 5"></div>
          <div class="swiper-slide"><img src="catalog/view/theme/cits/assets/images/logo-6.png" alt="Brand 6"></div>
        </div>
      </div> 
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="site-footer">
    
    <!-- Newsletter -->
    <div class="footer-newsletter">
      <div class="container">
        <div class="newsletter-content">
          <div class="newsletter-text">
            <h2>Newsletter</h2>
            <p>Subscribe to our Newsletter get 10% discount code</p>
          </div>
          <div class="newsletter-form">
            <input type="email" placeholder="Your e-mail address"><button type="submit">SUBSCRIBE</button>
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
          <p>The small round table in the dinette may be great for casual me. Is simply dummy text of the printing.</p>
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
          <ul>
            <?php
              $i=1;
              foreach ($informations as $information) {
              if($i == 4){
                break;
              }
            ?>
            <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
            <?php $i++; } ?>
          </ul>
          <?php } ?>
        </div>

        <!-- <div class="footer-links">
          <h2>Company</h2>
          <ul>
            <li><a href="#">Advertising</a></li>
            <li><a href="#">Business Development</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Permissions</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div> -->
         i. Disclaimers ii. About Us iii. Privacy Policy iv. Terms and Conditions v. Return and Refund Policy


        <div class="footer-contact">
          <h2>Contact</h2>
          <a href="tel:<?php echo $telephone;?>" class="contact-item">
            <i class="fas fa-headset"></i>
            <span>Call us 24/7</span>
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
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="catalog/view/theme/cits/assets/js/script.js"></script>

</body>
</html>
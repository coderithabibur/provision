<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>" />
    <?php if (isset($route) && $route == 'common/home') { ?>
    <meta name="description" content="Pro-Vision, a leading supplier of LED and HID lighting solutions. Over 20 years of expertise in automotive light upgrades and fleet enhancements. Committed to delivering optimal lighting solutions at competitive prices." />
<?php } elseif ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
    <?php if ($keywords) { ?>
    <meta name="keywords" content= "<?php echo $keywords; ?>" />
    <?php } ?>
    <meta name="msvalidate.01" content="63BF2CA10896D52F7D0E3239BF477F37" />
    <link href="catalog/view/theme/cits/stylesheet/bootstrap.css" rel="stylesheet" media="screen" />
    <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/cits/assets/css/style.css">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-MPKDL3R');</script>
    <!-- End Google Tag Manager -->
    
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0MZLPW6V1Z"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-0MZLPW6V1Z');
    </script>
    

    <script  src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script  src="catalog/view/theme/cits/js/bootstrap.min.js" type="text/javascript"></script>
    <script  src="catalog/view/javascript/common.js" type="text/javascript"></script>

    <script  src="catalog/view/theme/cits/js/core.js"></script>
    <script  src="catalog/view/theme/cits/js/menu.js" type="text/javascript"></script>
    
    <script>
    (function(w,d,t,r,u)
    {
        var f,n,i;
        w[u]=w[u]||[],f=function()
        {
            var o={ti:"134605428"};
            o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")
        },
        n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function()
        {
            var s=this.readyState;
            s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)
        },
        i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)
    })
    (window,document,"script","//bat.bing.com/bat.js","uetq");
</script>
    
    
    <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php }
    ?>
    <?php $url= 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    ?>

    <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>
    <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript"></script>
    <?php } ?>
    <?php foreach ($analytics as $analytic) { ?>
    <?php echo $analytic; ?>
    <?php } ?>

    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/8f2ffea973282e9b7646fc605/dc91b8a5890542f9057383d0a.js");</script>



    <?php if (!empty($route) && $route == 'checkout/checkout' || $route == 'checkout/cart' || $route == 'account/order' || $route == 'checkout/confirm') { ?>
    <script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>
    <script>
        window.renderOptIn = function() {
            window.gapi.load('surveyoptin', function() {

                window.gapi.surveyoptin.render(
                    {
                        // REQUIRED FIELDS
                        "merchant_id": 114170849,
                        "order_id": "ORDER_ID",
                        "email": "CUSTOMER_EMAIL",
                        "delivery_country": "COUNTRY_CODE",
                        "estimated_delivery_date": "YYYY-MM-DD",
                        // OPTIONAL FIELDS
                        "products": [{"gtin":"GTIN1"}, {"gtin":"GTIN2"}]
                    });
            });
        }
    </script>
    <?php } ?>


</head>
<body  class="<?php echo $class; ?>">

<!-- Header Top Bar -->
  <div class="header-top">
    <div class="container">
      <div class="header-top-left">
        <p> <i class="fa-solid fa-truck-fast"></i> Delivery Costs are Included in the Price</p>
      </div>
      <div class="header-top-center">
        <p><i class="fa-solid fa-bolt-lightning"></i> <strong>FLASH SALE:</strong> 60% OFF CAR BATTERIES | USE CODE
          "BATT60"</p>
      </div>
      <div class="header-top-right">
        <a href="/login">
          <i class="fa-solid fa-right-to-bracket"></i> Login
        </a>
        <a href="/register">
          <i class="fa-solid fa-user-plus"></i> Register
        </a>
      </div>
    </div>
  </div>

  <!-- Header Main -->
  <header class="header-main">
    <div class="container header-inner">
      <div class="header-logo">
        <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $name; ?>"></a>
      </div>
      <nav class="header-nav">
        <div class="mobile-menu-header">
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $name; ?>"></a>
          <button class="menu-close-btn"><i class="fa-solid fa-close"></i></button>
        </div>
        <ul>

          <li><a href="/">home</a></li>
          <li><a href="#">pages <i class="fa-solid fa-chevron-down"></i></a>
            <ul>
              <li><a href="#">Menu Item 1</a></li>
              <li><a href="#">Menu Item 2</a></li>
              <li><a href="#">Menu Item 3</a></li>
              <li><a href="#">Menu Item 4</a></li>
              <li><a href="#">Menu Item 5</a></li>
              <li><a href="#">Menu Item 6</a></li>
              <li><a href="#">Menu Item 7</a></li>
              <li><a href="#">Menu Item 8</a></li>
              <li><a href="#">Menu Item 9</a></li>
            </ul>
          </li>
          <li><a href="#">shop</a></li>
          <li><a href="about-us.html">about</a></li>
          <li><a href="#">blog</a></li>
          <li><a href="contact.html">contact</a></li>
          <div class="mobile-category">
            <li><a href="#">
                <span><img src="catalog/view/theme/cits/assets/images/light-icons/light-bulb.png">LED</span>
                <i class="fa-solid fa-chevron-down"></i></a>
              <div class="cat-submenu">
                <ul>
                  <li><a href="#"><img src="assets/images/light-icons/day-mode.png">LED Headlight Bulbs.</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/idea(1).png">LED Headlights</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/idea.png">LED LIGHT BARS</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/light-bulb(1).png">LED Work Lights</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/light-bulb(3).png">LED Driving Lights</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/light-bulb(4).png">LED Headlight Control
                      Modules</a>
                  </li>
                </ul>
              </div>
            </li>
            <li><a href="#">
                <span> <img src="catalog/view/theme/cits/assets/images/light-icons/light-bulb.png"> HID </span>
                <i class="fa-solid fa-chevron-down"></i></a>
              <div class="cat-submenu">
                <ul>
                  <li><a href="#"><img src="assets/images/light-icons/day-mode.png">HID Conversion Kits</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/idea(1).png">HID Driving Lights</a></li>
                  <li><a href="#"><img src="assets/images/light-icons/idea.png">HID Spare Parts</a></li>
                </ul>

              </div>
            </li>
            <li><a href="#"><span><img src="assets/images/light-icons/light-bulb.png">Laser Driving Lights</span></a>
            </li>
            <li><a href="#"><span><img src="assets/images/light-icons/day-mode.png">Laser Light Bar</span></a></li>
          </div>
        </ul>
        <div class="mobile-nav-bottom">
          <div class="mobile-nav-account-info">
            <a href="<?php echo $login; ?>">
              <i class="fa-solid fa-right-to-bracket"></i> Login
            </a>
            <a href="<?php echo $register; ?>">
              <i class="fa-solid fa-user-plus"></i> Register
            </a>
          </div>
          <div class="header-phone">
            <a href="#"><i class="fas fa-headset"></i>
              <p>Call us 24/7 <br> <span class="header-phone-number">+08 9229 8228</span></p>
            </a>
          </div>
        </div>
      </nav>
      <!-- Right Side -->
      <div class="header-right">
        <a href="#" class="header-reviews">
          <img src="catalog/view/theme/cits/assets/images/Trustpilot_logo-1.png"> 651 reviews on <span class="header-trust">Trustpilot</span>
        </a>
        <div class="header-cart">
          <button><i class="fa-solid fa-shopping-cart"></i> <span class="header-cart-count">0</span></button>
          <div class="minicart">
            <div class="minicart-item">
              <img src="catalog/view/theme/cits/assets/images/product-1.jpg" alt="Kit Brembo GT BMW">
              <div class="minicart-item-info">
                <h4>Kit Brembo GT BMW</h4>
                <div class="minicart-quantity-price">
                  <div class="minicart-quantity">
                    <button class="minicart-minus">-</button>
                    <input type="text" value="1" min="1">
                    <button class="minicart-plus">+</button>
                  </div>
                  <span class="minicart-price">$69.75</span>
                </div>
              </div>
              <button class="minicart-remove">×</button>
            </div>
            <div class="minicart-item">
              <img src="catalog/view/theme/cits/assets/images/product-2.jpg" alt="Nuna car seats S134">
              <div class="minicart-item-info">
                <h4>Nuna car seats S134</h4>
                <div class="minicart-quantity-price">
                  <div class="minicart-quantity">
                    <button class="minicart-minus">-</button>
                    <input type="text" value="1" min="1">
                    <button class="minicart-plus">+</button>
                  </div>
                  <span class="minicart-price">$38.24</span>
                </div>
              </div>
              <button class="minicart-remove">×</button>
            </div>
            <div class="minicart-subtotal">
              <span>SUBTOTAL</span>
              <span class="minicart-total">$107.99</span>
            </div>
            <button class="minicart-btn minicart-view-cart">VIEW CART</button>
            <button class="minicart-btn minicart-checkout">CHECKOUT</button>
          </div>
        </div>
        <button class="mobile-menu-trigger"><i class="fa-solid fa-bars"></i></button>
      </div>
    </div>
  </header>

  <!-- Header Search Section -->
  <div class="header-search">
    <div class="container header-search-inner">
      <!-- Categories -->
      <div class="header-categories">
        <button><i class="fa-solid fa-bars"></i>
          <p>ALL CATEGORIES</p>
        </button>
        <ul class="category-list">
          <li><a href="#">
              <span> <img src="assets/images/light-icons/bulb.png">LED</span>
              <i class="fa-solid fa-chevron-right"></i></a>
            <div class="cat-submenu">
              <ul>
                <li><a href="#" data-image="assets/images/product-1.jpg">
                    <img src="assets/images/light-icons/day-mode.png">LED Headlight Bulbs</a>
                </li>
                <li><a href="#" data-image="assets/images/product-2.jpg">
                    <img src="assets/images/light-icons/idea(1).png">LED Headlights</a>
                </li>
                <li><a href="#" data-image="assets/images/product-3.jpg">
                    <img src="assets/images/light-icons/idea.png">LED LIGHT BARS</a>
                </li>
                <li><a href="#" data-image="assets/images/product-1.jpg">
                    <img src="assets/images/light-icons/light-bulb(1).png">LED Work Lights</a>
                </li>
                <li><a href="#" data-image="assets/images/product-2.jpg">
                    <img src="assets/images/light-icons/light-bulb(3).png">LED Driving Lights</a>
                </li>
                <li><a href="#" data-image="assets/images/product-3.jpg">
                    <img src="assets/images/light-icons/light-bulb(4).png">LED Headlight Control Modules</a>
                </li>
              </ul>
              <div class="cat-submenu-image">
                <img src="assets/images/product-1.jpg" class="submenu-preview">
              </div>
            </div>
          </li>
          <li><a href="#">
              <span>
                <img src="assets/images/light-icons/light-bulb(4).png">HID
              </span>
              <i class="fa-solid fa-chevron-right"></i></a>
            <div class="cat-submenu">
              <ul>
                <li><a href="#" data-image="assets/images/product-1.jpg">
                    <img src="assets/images/light-icons/day-mode.png">HID Conversion Kits</a>
                </li>
                <li><a href="#" data-image="assets/images/product-2.jpg">
                    <img src="assets/images/light-icons/idea(1).png">HID Driving Lights</a>
                </li>
                <li><a href="#" data-image="assets/images/product-3.jpg">
                    <img src="assets/images/light-icons/idea.png">HID Spare Parts</a>
                </li>
              </ul>
              <div class="cat-submenu-image">
                <img src="assets/images/product-1.jpg" class="submenu-preview">
              </div>
            </div>
          </li>
          <li><a href="#"><span><img src="assets/images/light-icons/light-bulb.png">Laser Driving Lights</span></a></li>
          <li><a href="#"><span><img src="assets/images/light-icons/day-mode.png">Laser Light Bar</span></a></li>
        </ul>
      </div>
      <!-- Search Box -->
      <div class="header-search-box">
        <input type="text" placeholder="Search for products">
        <button type="submit"><i class="fas fa-search"></i></button>
      </div>
      <div class="header-phone">
        <a href="#"><i class="fas fa-headset"></i>
          <p>Call us 24/7 <br> <span class="header-phone-number">+08 9229 8228</span></p>
        </a>
      </div>
    </div>
  </div>

  <!-- End Header -->


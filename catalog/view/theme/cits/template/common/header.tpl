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
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/cits/assets/css/responsive.css">

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

  <?php echo $custom_header_code; ?>

</head>
<body  class="<?php echo $class; ?>">
<?php echo $custom_body_code; ?>
<!-- Header Top Bar -->
  <div class="header-top">
    <div class="container">
      <div class="header-top-left">
        <?php if ($delivery_text) { ?>
          <p> <i class="fa-solid fa-truck-fast"></i> <?php echo $delivery_text; ?></p>
        <?php } ?>
      </div>
      <div class="header-top-center">
        <?php if ($flash_sale_text) { ?>
          <p><i class="fa-solid fa-bolt-lightning"></i> <?php echo $flash_sale_text; ?></p>
        <?php } ?>
      </div>
      <div class="header-top-right">
        <?php if ($logged) { ?>
          <a href="<?php echo $account; ?>" class="nav-link">
              <i class="fa-solid fa-user"></i> <?php echo $text_account; ?>
          </a>
          <a href="<?php echo $logout; ?>" class="nav-link">
              <i class="fa-solid fa-right-from-bracket"></i> <?php echo $text_logout; ?>
          </a>
        <?php } else { ?>
          <a href="<?php echo $login; ?>" class="nav-link">
              <i class="fa-solid fa-right-to-bracket"></i> <?php echo $text_login; ?>
          </a>
          <a href="<?php echo $register; ?>" class="nav-link">
              <i class="fa-solid fa-user-plus"></i> <?php echo $text_register; ?>
          </a>
        <?php } ?>
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
          <li><a href="/index.php?route=product/category&path=115">shop</a></li>
          <li><a href="/index.php?route=information/information&information_id=4">about</a></li>
          <li><a href="/index.php?route=information/contact">contact</a></li>
        <div class="mobile-category">
          <?php foreach ($categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>">
                <span>
                  <img src="<?php echo $category['icon']; ?>">
                  <?php echo $category['name']; ?>
                </span>
                <?php if ($category['children']) { ?><i class="fa-solid fa-chevron-down"></i><?php } ?></a>
              <?php if ($category['children']) { ?>
              <div class="cat-submenu">
                <ul>
                  <?php foreach ($category['children'] as $child) { ?>
                    <li><a href="<?php echo $child['href']; ?>">
                      <?php echo $child['name']; ?></a>
                    </li>
                    <?php if ($child['subChild']) { ?>
                      <?php foreach ($child['subChild'] as $subchild) { ?>
                        <li><a href="<?php echo $subchild['href']; ?>">
                          <?php echo $subchild['name']; ?></a>
                        </li>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </ul>
              </div>
              <?php } ?>
            </li>
          <?php } ?>
        </div>
        </ul>
        <div class="mobile-nav-bottom">
          <div class="mobile-nav-account-info">
            <?php if ($logged) { ?>
              <a href="<?php echo $account; ?>" class="nav-link">
                  <i class="fa-solid fa-user"></i> <?php echo $text_account; ?>
              </a>
              <a href="<?php echo $logout; ?>" class="nav-link">
                  <i class="fa-solid fa-right-from-bracket"></i> <?php echo $text_logout; ?>
              </a>
            <?php } else { ?>
              <a href="<?php echo $login; ?>" class="nav-link">
                  <i class="fa-solid fa-right-to-bracket"></i> <?php echo $text_login; ?>
              </a>
              <a href="<?php echo $register; ?>" class="nav-link">
                  <i class="fa-solid fa-user-plus"></i> <?php echo $text_register; ?>
              </a>
            <?php } ?>
          </div>
          <div class="header-phone">
            <a href="tel:<?php echo $telephone;?>"><i class="fas fa-headset"></i>
              <p>8-4pm Mon-Fri AEST <br> <span class="header-phone-number"><?php echo $telephone;?></span></p>
            </a>
          </div>
        </div>
      </nav>

      <!-- Right Side -->
      <div class="header-right">
        <div class="header-reviews">          
          <!-- TrustBox script -->
          <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
          <!-- End TrustBox script -->

          <!-- TrustBox widget - Micro Review Count -->
          <div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5d425ee701425c0001a15e2b" data-style-height="24px" data-style-width="100%" data-theme="light" data-style-alignment="center">
            <a href="https://uk.trustpilot.com/review/pro-vision-lighting.com" target="_blank" rel="noopener">Trustpilot</a>
          </div>
          <!-- End TrustBox widget -->
        </div>
        <div class="header-cart">
          <button class="minicart-trigger"><i class="fa-solid fa-shopping-cart"></i> <p class="header-cart-count"> <span><?php echo $cart_count; ?></span> </p></button>
          <div class="minicart just-count">
            <?php echo $cart; ?>
          </div>
        </div>
        <button class="mobile-menu-trigger"><i class="fa-solid fa-bars"></i></button>
      </div>
    </div>
    <div class="minicart">
      <?php echo $cart; ?>
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
          <?php foreach ($categories as $category) { ?>
            <li>
              <a href="<?php echo $category['href']; ?>" data-image="<?php echo $category['image']; ?>">
                <span>                  
                  <img src="<?php echo $category['icon']; ?>">                    
                  <?php echo $category['name']; ?>
                </span>
                <?php if ($category['children']) { ?><i class="fa-solid fa-chevron-right"></i><?php } ?></a>
              <?php if ($category['children']) { ?>
              <div class="cat-submenu">
                <ul>
                  <?php foreach ($category['children'] as $child) { ?>
                    <li><a href="<?php echo $child['href']; ?>">
                        <?php echo $child['name']; ?></a>
                    </li>
                    <?php if ($child['subChild']) { ?>
                      <?php foreach ($child['subChild'] as $subchild) { ?>
                        <li><a href="<?php echo $subchild['href']; ?>">
                            <?php echo $subchild['name']; ?></a>
                        </li>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </ul>
                <div class="cat-submenu-image">
                  <img src="<?php echo $category['image']; ?>" class="submenu-preview">
                </div>
              </div>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
      </div>
      <!-- Search Box -->
      <!-- <div class="header-search-box">
        <input type="text" placeholder="Search for products">
        <button type="submit"><i class="fas fa-search"></i></button>
      </div> -->

      <!-- Search Box -->
      <div class="header-search-box">
          <select name="category_id" class="header-search-category" style="width:200px">
            <option value="0">All Categories</option>
            <?php foreach ($categories as $category_1) { ?>
            <?php if ($category_1['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <?php if ($category_2['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_2['children'] as $category_3) { ?>
            <?php if ($category_3['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </select>
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search Products…" id="input-search" class="form-control" />
          
          <!-- <input type="button" value="Search" id="button-search2" class="yellowbtn" /> -->
          <button type="button" value="Search" id="button-search2"><i class="fas fa-search"></i></button>  
      </div>
      
      <div class="header-phone">
        <a href="tel:<?php echo $telephone;?>"><i class="fas fa-headset"></i>
          <p>8-4pm Mon-Fri AEST <br> <span class="header-phone-number"><?php echo $telephone;?></span></p>
        </a>
      </div>
    </div>
  </div>

  <?php if (!empty($breadcrumbs)) { ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
      <?php foreach ($breadcrumbs as $i => $breadcrumb) { ?>
        {
          "@type": "ListItem",
          "position": <?php echo $i + 1; ?>,
          "name": "<?php echo htmlspecialchars($breadcrumb['text'], ENT_QUOTES, 'UTF-8'); ?>",
          "item": "<?php echo htmlspecialchars($breadcrumb['href'], ENT_QUOTES, 'UTF-8'); ?>"
        }<?php if ($i < count($breadcrumbs) - 1) { echo ","; } ?>
      <?php } ?>
      ]
    }
    </script>
  <?php } ?>


  <!-- End Header -->


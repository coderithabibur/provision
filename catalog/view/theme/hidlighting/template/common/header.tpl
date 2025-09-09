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
    <link href="catalog/view/theme/hidlighting/stylesheet/bootstrap.css" rel="stylesheet" media="screen" />
    <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" /-->

    <!-- <link type="text/css" rel="stylesheet" href="catalog/view/theme/hidlighting/stylesheet/jquery.smartmenus.bootstrap.css"> -->
    <link href="catalog/view/theme/hidlighting/stylesheet/stylesheet.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/hidlighting/stylesheet/core.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/hidlighting/stylesheet/responsive.css">

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
    <script  src="catalog/view/theme/hidlighting/js/bootstrap.min.js" type="text/javascript"></script>
    <script  src="catalog/view/javascript/common.js" type="text/javascript"></script>
    <!-- <script async type="text/javascript" src="catalog/view/theme/hidlighting/js/jquery.smartmenus.js"></script>
    <script async type="text/javascript" src="catalog/view/theme/hidlighting/js/jquery.smartmenus.bootstrap.js"></script> -->
    <!--script src="catalog/view/theme/hidlighting/js/jquery.ieresponsify-1.1.js"></script-->
    <script  src="catalog/view/theme/hidlighting/js/core.js"></script>
    <script  src="catalog/view/theme/hidlighting/js/menu.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script  src="catalog/view/theme/hidlighting/js/html5shiv.js"></script>
    <script  src="catalog/view/theme/hidlighting/js/respond.js"></script>
    <script  src="catalog/view/theme/hidlighting/js/i.e-bootstrap.min.js"></script>
    <![endif]-->
    
    
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
<header>
    <div class="topBar 1">
        <div class="container 1">
            <div class="row">
                <div class="col-md-8 col-sm-7 col-xs-6 fullblock">
                    <ul class="topleft one" style="display:block">
                        <li style="font-size: 16px;">
                            Email:<a style="font-size: 14px;
                                            color: #fffbfb;
                                            font-family: roboto_condensedregular;
                                            font-weight: 400;
                                            padding-top: 3px;" href="mailto: <?php echo $e_mail;?>"><?php echo $e_mail;?></a>
                        </li>
                        <!--<li><?php echo $text_call;?><b><a href="tel:<?php echo $telephone;?>">  <?php echo $telephone;?></b></li>-->
                    </ul>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-6 fullblock">
                    <ul class="topright">
                        <?php if ($logged) { ?>
                        <li> <a href="<?php echo $logout; ?>"><img src="catalog/view/theme/hidlighting/images/logout.png" alt=""><b><?php echo $text_logout; ?></b></a></li>
                        <li><a href="<?php echo $account; ?>"><img src="catalog/view/theme/hidlighting/images/user.png" alt=""><b><?php echo $text_account; ?></b></a></li>
                        <?php } else {  ?>
                        <li><a href="<?php echo $login; ?>"><img src="catalog/view/theme/hidlighting/images/login.png" alt=""> <b><?php echo $text_login; ?></b></a></li>
                        <li><a href="<?php echo $register; ?>"><img src="catalog/view/theme/hidlighting/images/register.png" alt=""><b><?php echo $text_register; ?></b></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="logo-class">



                        <div class="logo">
                            <?php if ($logo) { ?>
                            <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                            <?php } else { ?>
                            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="col-md-5 col-sm-4 col-xs-12 rating-main">
                    <?php //$ip = $_SERVER['REMOTE_ADDR']; 
                    //if($ip=='182.68.180.165'){ ?>
                       <!--  <div class="c-message" style="border: 4px solid #fe7200; text-align: center; height: 81px;padding: 9px;font-size: 15px; margin-bottom: 10px;display: flex; flex-direction: column; justify-content: center;">We will be closed on December 11th, which fall on Monday.<br></div> -->
                    <?php //} ?>
                    <div class="">
                     <div class="rating-info">
                        <g:ratingbadge merchant_id=114170849></g:ratingbadge>​
                    </div>
                    </div>
                    </div>
                <div class="col-md-4 col-sm-4 col-xs-12">

                   <!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->


<!-- TrustBox widget - Micro Review Count -->
<div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5d425ee701425c0001a15e2b" data-style-height="24px" data-style-width="100%" data-theme="light" data-style-alignment="center">
  <a href="https://uk.trustpilot.com/review/pro-vision-lighting.com" target="_blank" rel="noopener">Trustpilot</a>
</div>
<!-- End TrustBox widget -->
                    <div class="cartTop">

                        <?php echo $cart; ?>

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            <p class="menu">Menu</p>

                        </div>




                    </div>
                </div>
            </div>
        </div>
</header>
<div class="container">

</div>
<section class="navigationOuter">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <nav class="navbar navbar-default">
                    <div class="">

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <button type="button" class="navbar-close">
                     <span aria-hidden="true">
                         <img src="catalog/view/theme/hidlighting/images/close-icon.svg" alt="Close">
                     </span>
                            </button>

                            <ul class="nav navbar-nav">

                                <li class="<?php if($url == $base){ echo "active"; } ?>"><a href="<?php echo $home; ?>" title="Home"><?php echo $text_home; ?></a></li>
                                <?php foreach ($categories as $category) { ?>

                                <li class="dropdown open" id="dropdown11">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <?php if ($category['children']) { ?>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        <?php } ?>
                                    </a>
                                    <a class="main-category" href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?>
                                    </a>


                                    <?php if ($category['children']) { ?>
                                    <ul class="dropdown-menu dropdown-sub dropdown-sub-first">
                                        <?php foreach ($category['children'] as $child) { ?>
                                        <li class="dropdown <?php // if ($category['category_id'] == $category_id) { echo 'active'; }?> " id="dropdownMenu">
                                            <?php if ($child['subChild']) { ?>
                                            <a href="javascript:void(0)" class="class-arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <?php } ?>
                                            <a href="<?php echo $child['href']; ?>" class="list-group-item1"><?php echo $child['name']; ?>	<?php if ($child['subChild']) { ?>
                                                <!-- <i class="fa fa-angle-right" aria-hidden="true"></i> -->
                                                <?php } ?>
                                            </a>
                                            <?php if($child['subChild']){ ?>
                                            <ul class="dropdown-menu dropdown-sub dropdown-sub-second">
                                                <?php foreach($child['subChild'] as $sub){ ?>
                                                <li>
                                                    <a href="<?php echo $sub['href']; ?>"><?php echo $sub['name']; ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </li>
                                <?php } ?>

                                <li><a href="<?php echo $contact; ?>" title="Need Help">Need Help</a></li>
                                <li><a href="<?php echo $special; ?>" title="Special Offer/Today's Offers">Special Offer/Today's Offers</a></li>
                                <!--
                                                <li><a href="<?php echo $latest ?>" title="New Arrivals">New Arrivals</a></li>
                                              -->
                                <li class="borderNone"><a href="<?php echo $featured; ?>" title="Featured Products">featured Products</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('.class-arrow').on('click', function(e) {
            e.stopPropagation();
            $(this).parent().find('.dropdown-sub').toggleClass('show');
            // $('#dropdownMenu').toggleClass('open-submenu');
        });

        $('.navbar-nav > li.dropdown').click(function () {
            if ($(this).hasClass('open')) {
                $('.class-arrow').parent().parent().find('.dropdown-sub').removeClass('show')
            }
        });

        $('#dropdownMenu .class-arrow').click(function() {
            $(this).toggleClass("open-submenu");
        });

        $(window).scroll(function () {

            if ($(this).scrollTop() > 100) {
                $('.header').addClass('newClass');
            } else {
                $('.header').removeClass('newClass');
            }
        });

    });
</script>


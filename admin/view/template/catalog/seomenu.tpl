<div class="sidebar-left">
    <!--responsive view logo start-->
    <div class="logo dark-logo-bg hidden-xs hidden-sm">
            <a href="http://www.opencart.com/index.php?route=extension/extension/info&extension_id=7540&filter_search=seo%20module%20opencart" target="_blank" title="All in one seo features for opencart">
                <img src="view/javascript/aios/img/logo-icon.png" alt="">
                <!--<i class="fa fa-maxcdn"></i>-->
                <span class="brand-name"><?php echo $text_headingtitle; ?></span>
            </a>
        </div>
    <!--responsive view logo end-->

    <div class="sidebar-left-info">
        <!-- visible small devices start-->
        <div class=" search-field">  </div>
        <!-- visible small devices end-->

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked side-navigation">
            <li>
                <h3 class="navigation-title"><?php echo $text_generators; ?></h3>
            </li>
            <li class="menu-list">
                <a><i class="fa fa-cogs"></i>  <span><?php echo $text_autogenerators; ?></span></a>
                <ul class="child-list">
                    <li><a href="<?php echo $autogenerate_product; ?>"> <?php echo $text_product; ?></a></li>
                    <li><a href="<?php echo $autogenerate_category; ?>"> <?php echo $text_category; ?></a></li>
                    <li><a href="<?php echo $autogenerate_manufacturer; ?>"> <?php echo $text_manufacturer; ?></a></li>
                    <li><a href="<?php echo $autogenerate_information; ?>"> <?php echo $text_information; ?></a></li>
                    <li><a href="<?php echo $autogenerate_general; ?>"><?php echo $text_general; ?></a></li>
                </ul>
            </li>
            <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span><?php echo $text_editor; ?></span></a>
                <ul class="child-list">
                    <li><a href="<?php echo $customize_product; ?>"> <?php echo $text_product; ?></a></li>
                    <li><a href="<?php echo $customize_category; ?>"> <?php echo $text_category; ?></a></li>
                    <li><a href="<?php echo $customize_manufacturer; ?>"> <?php echo $text_manufacturer; ?></a></li>
                    <li><a href="<?php echo $customize_information; ?>"> <?php echo $text_information; ?></a></li>
                    <li><a href="<?php echo $customize_general; ?>"><?php echo $text_general; ?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $report_completeseo; ?>"><i class="fa fa-file-text"></i> <span><?php echo $text_report; ?></span></a></li>
            <li><a href="<?php echo $seo_settings; ?>"><i class="fa fa-gear"></i> <span>Settings</span></a></li>
            <li>
                <h3 class="navigation-title"><?php echo $text_socialrichsnippets; ?></h3>
            </li>
            <li class="menu-list"><a href=""><i class="fa fa-star"></i> <span><?php echo $text_richsnippets; ?></span></a>
                <ul class="child-list">
                   <li><a href="<?php echo $snippet_google; ?>"><i class="fa fa-google"></i> <span><?php echo $text_google; ?></span></a></li>
                   <li><a href="<?php echo $snippet_twitter; ?>"><i class="fa fa-twitter"></i> <span><?php echo $text_twitter; ?></span></a></li>
                   <li><a href="<?php echo $snippet_facebook; ?>"><i class="fa fa-facebook"></i> <span><?php echo $text_facebook; ?></span></a></li>
                  <li><a href="<?php echo $snippet_pinterest; ?>"><i class="fa fa-pinterest"></i> <span><?php echo $text_pinterest; ?></span></a></li> 
                </ul>
            </li>
            <li><a href="<?php echo $sitemap; ?>"><i class="fa fa-sitemap"></i> <span><?php echo $text_sitemap; ?></span></a></li>
            <!--<li><a href="<?php $robots; ?>"><i class="fa fa-ban"></i> <span><?php $text_robots; ?></span></a></li>-->

            <li>
                <h3 class="navigation-title"><?php echo $text_seoredirectmanager; ?></h3>
            </li>
            <li><a href="<?php echo $redirectmanager; ?>"><i class="fa fa-random"></i> <span><?php echo $text_redirectmanager; ?></span></a></li>

             <li><a href="<?php echo $failedlinks; ?>"><i class="fa fa-remove"></i> <span><?php echo $text_failedlinks; ?></span></a>
            </li>

            <li>
                <h3 class="navigation-title"><?php echo $text_clearseotool; ?></h3>
            </li>

            <li><a href="<?php echo $clearseo; ?>"><i class="fa fa-bomb"></i> <span><?php echo $text_clearseo; ?></span></a>
            </li>

        </ul>
        <!--sidebar nav end-->
    </div>
</div>
<!-- sidebar left end-->
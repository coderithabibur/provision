<?php echo $header; ?><?php echo $column_left; ?><?php echo $seoloadstyles; ?>
<section class="sticky-header">
        <!-- sidebar left start-->
        <?php echo $seomenu; ?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" >
            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="index.html">
                        <img src="view/javascript/aios/img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <!--mega menu start-->
               <?php echo $seomegamenu; ?>
                <!--mega menu end-->

                <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                <ul class="notification-menu">

                <!--task info start-->
                <?php echo $seotask; ?>
                <!--task info end-->

                 <!--notification info start-->
                <?php echo $seonotification; ?>
                <!--notification info end-->
               
                </ul>
                </div>
                <!--left notification end-->
                
                </div>

            </div>
            <!-- header section end-->

            <!--body wrapper start-->
          <div class="wrapper">

  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
   <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>


        <div class="alert alert-warning alert-block fade in">
          <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
        <?php echo $seordata; ?>
        </div>
        <form action="<?php echo $sitemapg; ?>" method="post" enctype="multipart/form-data" id="sitemapg">

   <?php if(isset($sitemapexists)) { ?>
              <br><div style="text-align:center;"><a href="<?php echo $sitemapexists; ?>" target="_blank" class="sitemap btn btn-round btn-success">Sitemap is found. Click To View</a></div>
            <?php } else { ?>
             <br><div style="text-align:center;"><a class="sitemap btn btn-round btn-danger">Sitemap Doesn't Exist</a></div>
            <?php } ?>

          <br>
           <?php if(isset($sitemapexists)) { ?>
           <div style="text-align:center;"><a onclick="$('#sitemapg').submit();" class="btn btn-success m-b-10" >Update Sitemap</a></div>
           <?php } else { ?>
           <div style="text-align:center;"><a onclick="$('#sitemapg').submit();" class="btn btn-success m-b-10" ><?php echo $button_generate; ?></a></div>
           <?php } ?>
        </form>
</div>

    <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">How to generate seo automatically?</h1>
            </div>
            <div class="modal-body">
               <?php echo $help; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  <?php echo $footer; ?>
<?php echo $seoloadscripts; ?>
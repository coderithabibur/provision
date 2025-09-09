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
              <div class="page-header">
                                  <div class="pull-right">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-cogs"></i> <?php echo $howtouse; ?></button>
      </div>
      <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:80%; z-index:1111;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Help guide</h4>
      </div>
      <div class="modal-body">
        <?php echo $help_general_generate_howtouse; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  </div>

          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <section class="panel">
           <div class="page-head">
                <h3 class="m-b-less">
                   <i class="fa  fa-file-text"></i> Seo report for information
                </h3>
            </div>
           <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Language</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($genreport as $key => $value) { ?>
               <tr>
              <td class="langimg">
                <?php if($version < 2200) { ?>
                <img src="view/image/flags/<?php echo $value['image']; ?>" title="<?php echo $value['lname']; ?>" >
                 <?php } else { ?>
                 <img src="language/<?php echo $value['code']; ?>/<?php echo $value['code']; ?>.png" title="<?php echo $value['lname']; ?>" />
                 <?php } ?>
                <?php echo $value['lname']; ?></td>
              <?php if($value['count']) { ?>
                 <td class="g">Seo data is created for general page. <a href="<?php echo $customizegeneral; ?>">Check Here</a> </td>
              <?php } else  { ?>
                 <td class="s">Seo data is not present for general page. Kindly create from below</td>
              <?php } ?>
            </tr>
            <?php  } ?>
            </tbody>
          </table>
          </section>
           <section class="panel">
         <div class="page-head">
              <h3 class="m-b-less">
                <i class="fa fa-cog"></i> General Pages Seo Generators
              </h3>
          </div>

          <div class="row">
              <div class="col-md-12">
                  <section class="panel">
                      <header class="panel-heading">
                          <b>Seo KeyWord Generator </b>
                          <span class="tools pull-right">
                              <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                          </span>
                      </header>
                      <div class="panel-body">
                          <div class="row earning-chart-info">
                              <div class="col-sm-10 col-xs-12">
                                <?php echo $help_general_data; ?>
                                <div class="pattern-helper-msg"><?php echo $help_general1_data; ?></div>
                              </div>
                              <div class="col-sm-2 col-xs-12">
                                  <button type="submit" name="general_pages" value="general_pages" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button>
                              </div>
                          </div>
                      </div>
                  </section>
              </div>
            </div>

          </section>
       </form>

        </div>
        <!--body wrapper end-->


        <!--footer section start-->
        <footer>
            2016 &copy; ALL IN ONE SEO by NERDHERD
        </footer>
        <!--footer section end--> 

        </div>
        <!-- body content end-->
    </section>
<?php echo $footer; ?>
<!--jquery-ui-->
<?php echo $seoloadscripts; ?>
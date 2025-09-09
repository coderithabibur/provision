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
        <?php echo $help_manufacturer_generate_howtouse; ?>
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
                   <i class="fa  fa-file-text"></i> Seo report for Manufacturer
                </h3>
            </div>
           <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Language</th>
              <th>Total Manufacturers Found</th>
              <th>Seo Keywords Found</th>
              <th>Meta Title Found</th>
              <th>Meta Keywords Found</th>
              <th>Meta Description Found</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($manreport as $key => $value) { ?>
               <tr>
              <td class="langimg">
                <?php if($version < 2200) { ?>
                <img src="view/image/flags/<?php echo $value['image']; ?>" title="<?php echo $value['lname']; ?>" >
                 <?php } else { ?>
                 <img src="language/<?php echo $value['code']; ?>/<?php echo $value['code']; ?>.png" title="<?php echo $value['lname']; ?>" />
                 <?php } ?>
                <?php echo $value['lname']; ?></td>
              <td>
                <h1 class="timer" data-from="0" data-to="<?php echo $value['count']; ?>"
                                    data-speed="1000">
                                </h1>
              </td>
              <td <?php if($value['seok'] == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                 <h1 class="timer" data-from="0" data-to="<?php echo $value['seok']; ?>"
                                    data-speed="1000">
                                </h1>
              </td>
              <td <?php if($value['metal']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                  <h1 class="timer" data-from="0" data-to="<?php echo $value['metal']; ?>"
                                    data-speed="1000">
                                </h1>
              </td>
              <td <?php if($value['metak']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                 <h1 class="timer" data-from="0" data-to="<?php echo $value['metak']; ?>"
                                    data-speed="1000">
                                </h1>
              </td>
              <td <?php if($value['metad']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                 <h1 class="timer" data-from="0" data-to=" <?php echo $value['metad']; ?>"
                                    data-speed="1000">
                                </h1>
              </td>
            </tr>
            <?php  } ?>
            </tbody>
          </table>
          </section>
           <section class="panel">
         <div class="page-head">
              <h3 class="m-b-less">
                <i class="fa fa-cog"></i> Manufacturer seo generators
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
                              <div class="col-sm-12 col-xs-12">
                                 <p><?php echo $help_manufacturer_seo_description; ?></p>
                              </div>
                              <div class="col-sm-10 col-xs-12">
                                  <input type="text" id="manufacturer_url_template" name="manufacturer_url_template" value="<?php echo $manufacturer_url_template;?>"  class="form-control">
                              </div>
                              <div class="col-sm-2 col-xs-12">
                                  <button type="submit" name="manufacturers_url" value="manufacturers_url" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button>
                              </div>
                          </div>
                      </div>
                  </section>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                  <section class="panel">
                      <header class="panel-heading">
                         <b>Manufacturer Meta Title</b>
                          <span class="tools pull-right">
                              <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                          </span>
                      </header>
                      <div class="panel-body">
                          <div class="row earning-chart-info">
                              <div class="col-sm-12 col-xs-12">
                                 <p><?php echo $help_manufacturer_title; ?></p>
                              </div>
                              <div class="col-sm-10 col-xs-12">
                                 <input type="text" id="manufacturer_title_template" name="manufacturer_title_template" value="<?php echo $manufacturer_title_template;?>" class="form-control">
                              </div>
                              <div class="col-sm-2 col-xs-12">
                                <button type="submit" name="manufacturer_title" value="manufacturer_title" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button>
                              </div>
                          </div>
                      </div>
                  </section>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                  <section class="panel">
                      <header class="panel-heading">
                       <b>Manufacturer Meta keywords</b>
                          <span class="tools pull-right">
                              <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                          </span>
                      </header>
                      <div class="panel-body">
                          <div class="row earning-chart-info">
                              <div class="col-sm-12 col-xs-12">
                                 <p><?php echo $help_manufacturer_meta_keyword; ?></p>
                              </div>
                              <div class="col-sm-10 col-xs-12">
                                <input type="text" id="manufacturer_keyword_template" name="manufacturer_keyword_template" value="<?php echo $manufacturer_keyword_template;?>" size="80" class="form-control">
                              </div>
                              <div class="col-sm-2 col-xs-12">
                                <button type="submit" name="manufacturer_keyword" value="manufacturer_keyword" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button>
                              </div>
                          </div>
                      </div>
                  </section>
              </div>
            </div>

             <div class="row">
              <div class="col-md-12">
                  <section class="panel">
                      <header class="panel-heading">
                      <b>Manufacturer Meta Description</b>
                          <span class="tools pull-right">
                              <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                          </span>
                      </header>
                      <div class="panel-body">
                          <div class="row earning-chart-info">
                              <div class="col-sm-12 col-xs-12">
                                 <p><?php echo $help_manufacturer_description; ?></p>
                              </div>
                              <div class="col-sm-10 col-xs-12">
                               <input type="text" id="manufacturer_description_template" name="manufacturer_description_template" value="<?php echo $manufacturer_description_template;?>" class="form-control">
                              </div>
                              <div class="col-sm-2 col-xs-12">
                               <button type="submit" name="manufacturer_description" value="manufacturer_description" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button>
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
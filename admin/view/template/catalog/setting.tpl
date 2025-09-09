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
          <form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                  <div class="container-fluid">
                      <div class="pull-right">
                             <button onclick="$('#form').submit();" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                         </div>
                  </div>
                   <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Setting Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                             <tbody>
                            <tr>
                                <td><?php echo $text_self_generate; ?></td>
                                <td><?php echo $help_self_generate; ?></td>
                                <td>
                                  <div class="onoffswitch">
                                      <input type="checkbox" name="nerdherd_self_generate" class="onoffswitch-checkbox nerdherd_self_generate" id="myonoffswitch2"  <?php if($nerdherd_self_generate) echo "checked"; ?> >
                                      <label class="onoffswitch-label" for="myonoffswitch2">
                                          <span class="onoffswitch-inner"></span>
                                          <span class="onoffswitch-switch"></span>
                                      </label>
                                  </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $text_direct_links; ?></td>
                                <td><?php echo $help_direct_links; ?></td>
                                <td>
                                 <div class="onoffswitch">
                                    <input type="checkbox" name="nerdherd_direct_links" class="onoffswitch-checkbox nerdherd_direct_links" id="myonoffswitch3"  <?php if($nerdherd_direct_links) echo "checked"; ?> >
                                    <label class="onoffswitch-label" for="myonoffswitch3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $text_multi_lang; ?></td>
                                <td><?php echo $help_multi_lang; ?></td>
                                <td>
                                 <div class="onoffswitch">
                                    <input type="checkbox" name="nerdherd_breadcrumblink" class="onoffswitch-checkbox nerdherd_breadcrumblink" id="myonoffswitch1" <?php if($nerdherd_breadcrumblink) echo "checked"; ?> >
                                    <label class="onoffswitch-label" for="myonoffswitch1">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                  </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $text_manufacturer_breadcrumb; ?></td>
                                <td><?php echo $help_manufacturer_breadcrumb; ?></td>
                                <td>
                                 <div class="onoffswitch">
                                    <input type="checkbox" name="nerdherd_manu_breadcrumblink" class="onoffswitch-checkbox nerdherd_manu_breadcrumblink" id="myonoffswitch4" <?php if($nerdherd_manu_breadcrumblink) echo "checked"; ?> >
                                    <label class="onoffswitch-label" for="myonoffswitch4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                  </div>
                                </td>
                            </tr>

                      </tbody>
                  </table>
              </form>
          </div>
      </div>
    </div>
  </div>
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">How to generate seo automatically?</h1>
            </div>
            <div class="modal-body">
               <?php echo $text_about; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
<?php echo $footer; ?>
<?php echo $seoloadscripts; ?>
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

 <div class="wrapper">
  <?php if (isset($success)) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
          <div class="alert alert-success alert-block fade in">
          <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
        <?php echo $text_multistoresupport; ?>
        </div>
      

          <form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data" class="form-horizontal"> 
               <div class="container-fluid">
                    <div class="pull-right">
                        <button onclick="$('#form').submit();" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                  <br>
                  <fieldset>
                   <legend><img style="width: 10%;" src="view/image/seo/facebookicon.png"> Facebook Snippet</legend>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_facebook_status; ?></label>
                      <div class="col-sm-10" style="display: inline-flex;">
                        <select name="grsnippetfacebook_status" class="form-control">
                          <?php if ($grsnippetfacebook_status) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                          <?php } else { ?>
                            <option value="1"  ><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                          <?php }?>
                        </select> 
                      </div>
                    </div>

                  </fieldset>
                  <br><br>
          <br><br>
          <fieldset>
            <legend>Example image about how your facebook share shall look: </legend>
             <table class="form">
                    <tr>
                       <td class="title"><b>Large Image Share</b></td>
                      <td class="title"><img src="view/image/seo/facebook_large.png" alt="Facebook achievement" title="Facebook share with large image"></td>
                    </tr>
                    <tr>
                       <td class="title"><b>Side Image Share</b></td>
                      <td class="title"><img src="view/image/seo/facebook_square.png" alt="Facebook achievement" title="Facebook share with small image"></td>
                    </tr>
             </table>
              </fieldset>
             <br><br>
            <fieldset class="facebook">
            <legend>How to activate facebook rich snippet?</legend>
             <table class="form">
                    <tr>
                      <td align="left">
                          <div class="helper-msg">1) Facebook rich snippet status should be enabled</div>
                        <div class="helper-msg">2) Sign into your facebook account.</div>
                        <div class="helper-msg">3) Click this link <a href="https://developers.facebook.com/tools/debug" target="_blank">Facebook Verification Tool</a></div><vr>
                        <div class="helper-msg">4) Enter any of your product link and click debug.</div>
                        </td>
                    </tr>
             </table>
           </fieldset>
      </form>
  </div>
</div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">How to use rich snippet?</h1>
            </div>
            <div class="modal-body">
               <?php echo $text_about; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
        <!--body wrapper end-->

        </div>
        <!-- body content end-->
    </section>
<!--jquery-ui-->
<?php echo $seoloadscripts; ?>
<?php echo $footer; ?>
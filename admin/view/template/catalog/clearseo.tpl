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
            <div class="helper-msg">
             Each seo data can be clear individually as per requirement.
            </div>
                   
                   <legend>Clear Products Seo</legend>
                   <table class="table table-bordered table-hover">
                        <tbody>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="productseokeyword">Clear Product Seo Keywords</button></td>
                              </tr>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="producttitle">Clear Product Meta Title</button></td>
                              </tr>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="productmetakeyword">Clear Product Meta Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="productmetadescription">Clear Product Meta Description</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="producttags">Clear Product Tags</button></td>
                              </tr>
                        </tbody>
                    </table>
                  
            <br><br>
                  
                   <legend>Clear Category Seo</legend>
                    <table class="table table-bordered table-hover">
                            <tbody>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="categoryseokeyword">Clear Category Seo Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="categorytitle">Clear Category Title</button></td>
                              </tr>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="categorymetakeyword">Clear Category Meta Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="categorymetadescription">Clear Category Meta Description</button></td>
                              </tr>
                        </tbody>
                        </table>
                      <br><br>
                       <legend>Clear Manufacturer Seo</legend>
                      <table class="table table-bordered table-hover">
                      <tbody>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="manufacturerseokeyword">Clear Manufacturer Seo Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="manufacturertitle">Clear Manufacturer Title</button></td>
                              </tr>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="manufacturermetakeyword">Clear Manufacturer Meta Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="manufacturermetadescription">Clear Manufacturer Meta Description</button></td>
                              </tr>
                        </tbody>
                    </table>
                <br><br>
                 
                   <legend>Clear Information Seo</legend>
                      <table class="table table-bordered table-hover">
                            <tbody>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="informationseokeyword">Clear Information Seo Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="informationtitle">Clear Information Title</button></td>
                              </tr>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="informationmetakeyword">Clear Information Meta Keywords</button></td>
                              </tr>
                               <tr>
                                <td colspan="2"><button class="btn btn-primary" id="informationmetadescription">Clear Information Meta Description</button></td>
                              </tr>
                        </tbody>
                      </table>
                      <br><br>
                       <legend>Clear General Page Seo</legend>
                      <table class="table table-bordered table-hover">
                            <tbody>
                              <tr>
                                <td colspan="2"><button class="btn btn-primary" id="clearGeneral">Clear General Seo Keywords</button></td>
                              </tr>
                        </tbody>
                      </table>

</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">How to use clear seo tool?</h1>
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
<script type="text/javascript">
$("table button").addClass("red");
$('table button').click(function(){
  $(".alert").remove();
   if (confirm('Are you sure you want to delete this?')) {
      $(this).removeClass("red");
      var name = $(this).attr("id");
      $.ajax({
          url: 'index.php?route=catalog/clearseo/deletedata&token=<?php echo $token; ?>&name=' +  name,
          dataType: 'json',
          success: function(data) {
              $('#'+name).addClass("btn-success");
              $('.page-header').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Seo data has been cleared. Go to auto generate page for generating again.</div>')
          }
        });
  } 
});
</script>
<?php echo $seoloadscripts; ?>
<?php echo $footer; ?>
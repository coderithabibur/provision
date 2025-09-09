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
            <section class="panel">
             <div class="page-head">
                  <h3 class="m-b-less">
                     <i class="fa  fa-file-text"></i> <b>Seo report for product</b>
                  </h3>
              </div>
             <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Language</th>
                <th>Total Products Found</th>
                <th>Seo Keywords Found</th>
                <th>Meta Title Found</th>
                <th>Meta Keywords Found</th>
                <th>Meta Description Found</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($productreport as $key => $value) { ?>
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
            <div class="row state-overview">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol <?php echo ($productmetatitle['totalcount']) ? 'red-color':'green-color'; ?>">
                           <?php if($productmetatitle['totalcount']) { ?>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php } else { ?>
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            <?php } ?>
                        </div>
                        <div class="value">
                            <h1 class="timer" data-from="0" data-to="<?php echo $productmetatitle['totalcount']; ?>"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <?php if($productmetatitle['totalcount']) { ?>
                            <a onclick="openDuplicateReport(7,'product_description','meta_title', 'Duplicate Meta Title For Products');"><p>Duplicate meta title</p></a>
                            <?php } else { ?>
                            <p>Duplicate meta title</p>
                            <?php } ?>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel ">
                        <div class="symbol <?php echo ($productmetakey['totalcount']) ? 'red-color':'green-color'; ?>">
                            <?php if($productmetakey['totalcount']) { ?>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php } else { ?>
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            <?php } ?>
                        </div>
                        <div class="value">
                            <h1 class="timer" data-from="0" data-to="<?php echo $productmetakey['totalcount']; ?>"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <?php if($productmetakey['totalcount']) { ?>
                            <a onclick="openDuplicateReport(9,'product_description','meta_keyword','Duplicate Meta Keywords For Products');"><p>Duplicate meta keywords</p></a>
                            <?php } else { ?>
                            <p>Duplicate meta keywords</p>
                            <?php } ?>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol <?php echo ($productmetadesc['totalcount']) ? 'red-color':'green-color'; ?>">
                             <?php if($productmetadesc['totalcount']) { ?>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php } else { ?>
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            <?php } ?>
                        </div>
                        <div class="value">
                            <h1 class="timer" data-from="0" data-to="<?php echo $productmetadesc['totalcount']; ?>"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                             <?php if($productmetadesc['totalcount']) { ?>
                            <a onclick="openDuplicateReport(8,'product_description','meta_description','Duplicate Meta Description For Products');"><p>Duplicate meta description</p></a>
                            <?php } else { ?>
                            <p>Duplicate meta description</p>
                            <?php } ?>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6" style="display:none;">
                    <section class="panel">
                        <div class="symbol <?php echo ($productmetakey['totalcount']) ? 'red-color':'green-color'; ?>">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value">
                            <h1 class="timer" data-from="0" data-to="2345"
                                data-speed="3000">
                                <!--2345-->
                            </h1>
                             <a><p>Duplicate meta tags</p></a>
                        </div>
                    </section>
                </div>
            </div>



            <section class="panel catreport">
             <div class="page-head">
                  <h3 class="m-b-less">
                     <i class="fa  fa-file-text"></i> <b>Seo report for category</b>
                  </h3>
              </div>
             <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Language</th>
                <th>Total Categories Found</th>
                <th>Seo Keywords Found</th>
                <th>Meta Title Found</th>
                <th>Meta Keywords Found</th>
                <th>Meta Description Found</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($catreport as $key => $value) { ?>
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
                   <h1 class="timer catkeyword<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['seok']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metal']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                    <h1 class="timer cattitle<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['metal']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metak']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                   <h1 class="timer catmetakeyword<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['metak']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metad']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                   <h1 class="timer catmetadesc<?php echo $key; ?>" data-from="0" data-to=" <?php echo $value['metad']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
              </tr>
              <?php  } ?>
              </tbody>
            </table>
            </section>

            <div class="row state-overview catreport">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol cattitledsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value white">
                            <h1 class="timer cattitled" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="cattitlea">Duplicate meta title</p>
                            <a onclick="openDuplicateReport(7,'category_description','meta_title','Duplicate Meta Title For Categories');" class="cattitlea" style="display:none;"><p>Duplicate meta Title</p></a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel ">
                        <div class="symbol catmetakeyworddsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value gray">
                            <h1 class="purple-color timer catmetakeywordd" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="catkeyworda">Duplicate meta keywords</p>
                            <a onclick="openDuplicateReport(9,'category_description','meta_keyword','Duplicate Meta Keywords For Categories');" class="catkeyworda" style="display:none;"><p>Duplicate meta keywords</p></a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol catmetadescdsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value white">
                            <h1 class="timer catmetadescd" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="catdesca">Duplicate meta description</p>
                            <a onclick="openDuplicateReport(8,'category_description','meta_description','Duplicate Meta Description For Categories');" class="catdesca" style="display:none;"><p>Duplicate meta description</p></a>
                        </div>
                    </section>
                </div>
            </div>
            

             <section class="panel inforeport">
             <div class="page-head">
                  <h3 class="m-b-less">
                     <i class="fa  fa-file-text"></i> <b>Seo report for information pages</b>
                  </h3>
              </div>
             <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Language</th>
                <th>Total Info Pages Found</th>
                <th>Seo Keywords Found</th>
                <th>Meta Title Found</th>
                <th>Meta Keywords Found</th>
                <th>Meta Description Found</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($inforeport as $key => $value) { ?>
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
                   <h1 class="timer infokeyword<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['seok']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metal']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                    <h1 class="timer infotitle<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['metal']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metak']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                   <h1 class="timer infometakeyword<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['metak']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metad']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                   <h1 class="timer infometadesc<?php echo $key; ?>" data-from="0" data-to=" <?php echo $value['metad']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
              </tr>
              <?php  } ?>
              </tbody>
            </table>
            </section>

            <div class="row state-overview inforeport">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol infotitledsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value white">
                            <h1 class="timer infotitled" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="infotitlea">Duplicate meta title</p>
                            <a onclick="openDuplicateReport(7,'information_description','meta_title','Duplicate Meta Title For Information Pages');" class="infotitlea" style="display:none;"><p>Duplicate meta Title</p></a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel ">
                        <div class="symbol infometakeyworddsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value gray">
                            <h1 class="purple-color timer infometakeywordd" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="infokeyworda">Duplicate meta keywords</p>
                            <a onclick="openDuplicateReport(9,'information_description','meta_keyword','Duplicate Meta Keywords For Information Pages');" class="infokeyworda" style="display:none;"><p>Duplicate meta keywords</p></a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel g">
                        <div class="symbol infometadescdsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value white">
                            <h1 class="timer infometadescd" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="infodesca">Duplicate meta description</p>
                            <a onclick="openDuplicateReport(8,'information_description','meta_description','Duplicate Meta Description For Information Pages');" class="infodesca" style="display:none;"><p>Duplicate meta description</p></a>
                        </div>
                    </section>
                </div>
            </div>


            <section class="panel manreport">
             <div class="page-head">
                  <h3 class="m-b-less">
                     <i class="fa  fa-file-text"></i> <b>Seo report for manufacturer pages</b>
                  </h3>
              </div>
             <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Language</th>
                <th>Total Brand Pages Found</th>
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
                   <h1 class="timer mankeyword<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['seok']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metal']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                    <h1 class="timer mantitle<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['metal']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metak']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                   <h1 class="timer manmetakeyword<?php echo $key; ?>" data-from="0" data-to="<?php echo $value['metak']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
                <td <?php if($value['metad']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>>
                   <h1 class="timer manmetadesc<?php echo $key; ?>" data-from="0" data-to=" <?php echo $value['metad']; ?>"
                                      data-speed="1000">
                                  </h1>
                </td>
              </tr>
              <?php  } ?>
              </tbody>
            </table>
            </section>

            <div class="row state-overview manreport">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol mantitledsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value white">
                            <h1 class="timer mantitled" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="mantitlea">Duplicate meta title</p>
                            <a onclick="openDuplicateReport(11,'title','title','Duplicate Meta Title For Manufacturer Pages');" class="mantitlea" style="display:none;"><p>Duplicate meta title</p></a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel ">
                        <div class="symbol manmetakeyworddsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value gray">
                            <h1 class="purple-color timer manmetakeywordd" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="mankeyworda">Duplicate meta keywords</p>
                            <a onclick="openDuplicateReport(11,'meta_keywords','meta_keywords','Duplicate Meta Keywords For Manufacturer Pages');" class="mankeyworda" style="display:none;"><p>Duplicate meta keywords</p></a>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel g">
                        <div class="symbol manmetadescdsymbol green-color">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="value white">
                            <h1 class="timer manmetadescd" data-from="0" data-to="0"
                                data-speed="1000">
                                <!--0-->
                            </h1>
                            <p class="mandesca">Duplicate meta description</p>
                            <a onclick="openDuplicateReport(11,'meta_description','meta_description','Duplicate Meta Description For Manufacturer Pages');" class="mandesca" style="display:none;"><p>Duplicate meta description</p></a>
                        </div>
                    </section>
                </div>
            </div>


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
<div id="duplicateReport" class="modal fade" role="dialog">
  <div class="modal-dialog" style="z-index:10000;">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $text_seoreport_duplicate; ?></h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover" id="reportContent">

        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--jquery-ui-->
<?php echo $seoloadscripts; ?>
<script type="text/javascript">
$(document).ready(function(){
   var request_1 = $.ajax({
        url: 'index.php?route=catalog/seoReport/catreport&token=<?php echo $token; ?>',
        type: 'get',
        dataType: 'json',
        beforeSend: function() {
            $('#button-product-add').button('loading');
        },
        complete: function() {
            $('.catreport').css('visibility','visible');
        },
        success: function(json) {
            var seoreport = json.seoreport;
            $.each(seoreport , function( index, value ){

                $('.catkeyword'+index).countTo({from: 0, to: value['seok']});
                $('.cattitle'+index).countTo({from: 0, to: value['metal']});
                $('.catmetakeyword'+index).countTo({from: 0, to: value['metak']});
                $('.catmetadesc'+index).countTo({from: 0, to: value['metad']});
                if(value['count'] == value['seok']) {
                  $('.catkeyword'+index).parent().addClass("g").removeClass("s");
                }
                if(value['count'] == value['metal']) {
                  $('.cattitle'+index).parent().addClass("g").removeClass("s");
                } 
                if(value['count'] == value['metak']) {
                  $('.catmetakeyword'+index).parent().addClass("g").removeClass("s");
                } 
                if(value['count'] == value['metad']) {
                  $('.catmetadesc'+index).parent().addClass("g").removeClass("s");
                } 
            });
            $('.cattitled').countTo({from: 0, to: json.categorymetatitle.totalcount});
            $('.catmetakeywordd').countTo({from: 0, to: json.categorymetakey.totalcount});
            $('.catmetadescd').countTo({from: 0, to: json.categorymetadesc.totalcount});
            
            if(json.categorymetatitle.totalcount != 0) {
              $('.cattitledsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
              $('p.cattitlea').hide();
              $('a.cattitlea').show();
            }
            if(json.categorymetakey.totalcount != 0) {
              $('.catmetakeyworddsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
              $('p.catkeyworda').hide();
              $('a.catkeyworda').show();
            }
            if(json.categorymetadesc.totalcount != 0) {
              $('.catmetadescdsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
              $('p.catdesca').hide();
              $('a.catdesca').show();
            }

    },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

     var request_2 = request_1.then(function() {
      $.ajax({
          url: 'index.php?route=catalog/seoReport/inforeport&token=<?php echo $token; ?>',
          type: 'get',
          dataType: 'json',
          beforeSend: function() {
              $('#button-voucher-add').button('loading');
          },
          complete: function() {
             $('.inforeport').css('visibility','visible');
          },
          success: function(json) {

              var seoreport = json.inforeport;
              $.each(seoreport , function( index, value ){
                  $('.infokeyword'+index).countTo({from: 0, to: value['seok']});
                  $('.infotitle'+index).countTo({from: 0, to: value['metal']});
                  $('.infometakeyword'+index).countTo({from: 0, to: value['metak']});
                  $('.infometadesc'+index).countTo({from: 0, to: value['metad']});
                  if(value['count'] == value['seok']) {
                    $('.infokeyword'+index).parent().addClass("g").removeClass("s");
                  }
                  if(value['count'] == value['metal']) {
                    $('.infotitle'+index).parent().addClass("g").removeClass("s");
                  } 
                  if(value['count'] == value['metak']) {
                    $('.infometakeyword'+index).parent().addClass("g").removeClass("s");
                  } 
                  if(value['count'] == value['metad']) {
                    $('.infometadesc'+index).parent().addClass("g").removeClass("s");
                  }
              });
              $('.infotitled').countTo({from: 0, to: json.informationmetatitle.totalcount});
              $('.infometakeywordd').countTo({from: 0, to: json.informationmetakey.totalcount});
              $('.infometadescd').countTo({from: 0, to: json.informationmetadesc.totalcount});

              if(json.informationmetatitle.totalcount != 0) {
                $('.infotitledsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                $('p.infotitlea').hide();
                $('a.infotitlea').show();
              }
              if(json.informationmetakey.totalcount != 0) {
                $('.infometakeyworddsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                $('p.infokeyworda').hide();
                $('a.infokeyworda').show();
              }
              if(json.informationmetadesc.totalcount != 0) {
                $('.infometadescdsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                $('p.infodesca').hide();
                $('a.infodesca').show();
              }

      },
          error: function(xhr, ajaxOptions, thrownError) {
              alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });

    });
       var request_3 = request_2.then(function() {
      $.ajax({
          url: 'index.php?route=catalog/seoReport/manreport&token=<?php echo $token; ?>',
          type: 'get',
          dataType: 'json',
          beforeSend: function() {
              $('#button-voucher-add').button('loading');
          },
          complete: function() {
             $('.manreport').css('visibility','visible');
          },
          success: function(json) {

              var seoreport = json.manreport;
              $.each(seoreport , function( index, value ){
                  $('.mankeyword'+index).countTo({from: 0, to: value['seok']});
                  $('.mantitle'+index).countTo({from: 0, to: value['metal']});
                  $('.manmetakeyword'+index).countTo({from: 0, to: value['metak']});
                  $('.manmetadesc'+index).countTo({from: 0, to: value['metad']});
                  if(value['count'] == value['seok']) {
                    $('.mankeyword'+index).parent().addClass("g").removeClass("s");
                  }
                  if(value['count'] == value['metal']) {
                    $('.mantitle'+index).parent().addClass("g").removeClass("s");
                  } 
                  if(value['count'] == value['metak']) {
                    $('.manmetakeyword'+index).parent().addClass("g").removeClass("s");
                  } 
                  if(value['count'] == value['metad']) {
                    $('.manmetadesc'+index).parent().addClass("g").removeClass("s");
                  }
              });
              $('.mantitled').countTo({from: 0, to: json.manreport_duplicatereport.metatitletotalcount});
              $('.manmetakeywordd').countTo({from: 0, to: json.manreport_duplicatereport.metakeywordtotalcount});
              $('.manmetadescd').countTo({from: 0, to: json.manreport_duplicatereport.metadesctotalcount});

              if(json.manreport_duplicatereport.metatitletotalcount != 0) {
                $('.mantitledsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                $('p.mantitlea').hide();
                $('a.mantitlea').show();
              }
              if(json.manreport_duplicatereport.metakeywordtotalcount != 0) {
                $('.manmetakeyworddsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                $('p.mankeyworda').hide();
                $('a.mankeyworda').show();
              }
              if(json.manreport_duplicatereport.metadesctotalcount != 0) {
                $('.manmetadescdsymbol').addClass("red-color").removeClass("green-color").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                $('p.mandesca').hide();
                $('a.mandesca').show();
              }

      },
          error: function(xhr, ajaxOptions, thrownError) {
              alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });
    });
               
});

</script>
         <script type="text/javascript">
  function openDuplicateReport(number,name,tablename, title) {
      $.ajax({
      url: 'index.php?route=catalog/seoReport/duplicatereport&token=<?php echo $token; ?>',
      type: 'post',
      dataType: 'json',
      data: {"number" : number,"name" : name} ,
      success: function(json) {
        var name = "";
        var count = "";
        var html = "";
        if(json.details != undefined) {
           html += '<tr><td><b>Content</b></td><td><b>Repeated</b></td></tr>';
          for (var i = 0; i < json.details.length; i++) {
            html += '<tr><td>'+json.details[i][tablename]+'</td><td>'+json.details[i].count +' times</td></tr>';
          };
          console.log(html);
          $('#duplicateReport .modal-title').html(title);
          $('#duplicateReport .modal-body #reportContent').html(html);
          }
          $('#duplicateReport').modal('show'); 
       } 
    });
  }
</script>
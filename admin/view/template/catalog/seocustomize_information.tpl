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

             <div class="page-head">
                <h3>
                    <?php echo $tab_information_pages; ?>
                </h3>
                <span class="sub-title"><?php echo $tab_information_pages_help; ?></span>
            </div>
            <br>

            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-info" class="form-horizontal">
        <div id="tab_information_pages">
            <div class="row">
                    <div class="col-sm-6">
                        &nbsp;
                    </div>
                    <div class="col-sm-4">
                        <?php foreach ($languages as $language) { ?>
                        <div class="buttons button_tabs">
                            <a value="information_language<?php echo $language['language_id']; ?>" class="btn btn-primary information_language_button" onclick="showLang('information_language<?php echo $language['language_id']; ?>','information_language');"><span>
                                <?php if($version < 2200) { ?>
                                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" >
                                 <?php } else { ?>
                                 <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                 <?php } ?>
                                <?php echo $language['name']; ?></span></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2">
                        <div class="pull-right">
                           <button type="submit"  form="form-info" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                       </div>
                    </div>
             </div>
             <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php } ?>
                                      <?php if ($error_warning) { ?>
  <div class="alert alert-warning"><i class="fa fa-check-circle"></i> <?php echo $error_warning; ?>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
  <?php } ?>  
  <?php if ($error_already_exists) { ?>
  <div class="alert alert-warning"><i class="fa fa-check-circle"></i> <?php echo $error_already_exists; ?>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
  <?php } ?>
            <div class="clear" style="margin-top: 25px;"></div>
            <table class="pure-table pure-table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <td class="left"><?php echo $column_name; ?></td>
                        <td class="left"><?php echo $column_keyword; ?></td>
                        <td class="center brt"><?php echo $column_title; ?><a class="help_icon" title="<?php echo $title_help ?>"></a></td>
                        <td class="center brt"><?php echo $column_meta_keyword; ?><a class="help_icon" title="<?php echo $keywords_help ?>"></a></td>
                        <td class="center"><?php echo $column_meta_description; ?><a class="help_icon" title="<?php echo $description_help ?>"></a></td>
                    </tr>
                </thead>    
                    
                <tbody>
                   <?php if ($informations) { ?>
                        <?php foreach ($informations as $information) { ?>
                            <tr>
                                <td class="left"><?php echo $information['name']; ?></td>
                                <td class="left"><?php echo $domain; ?>
                                    <?php foreach ($languages as $language) { ?>
                                    <input size="30"  type="text" class="information_language<?php echo $language['language_id']; ?> form-control"  name="information[keyword][<?php echo $information['information_id'] ?>][<?php echo $language['language_id']; ?>]" value="<?php echo $information['keyword']['language_id'][$language['language_id']]; ?>" />
                                    <?php } ?>
                                </td>
                                <td class="brt center">
                                    <?php foreach ($languages as $language) { ?>
                                        <textarea class="information_language<?php echo $language['language_id']; ?> ct form-control" name="information[information_description][<?php echo $information['information_id']; ?>][<?php echo $language['language_id']; ?>][title]" cols="20" rows="6"><?php echo isset($information['information_description'][$language['language_id']]) ? $information['information_description'][$language['language_id']]['title'] : ''; ?></textarea>
                                        <span class="information_language<?php echo $language['language_id']; ?> countt">-</span>
                                        <?php if (isset(${'error_name_information_'.$information['information_id'].'_'.$language['language_id']})) { ?>
                                            <span class="information_language<?php echo $language['language_id']; ?> error"><?php echo ${'error_name_information_'.$information['information_id'].'_'.$language['language_id']}; ?></span>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                                <td class="brt center">
                                    <?php foreach ($languages as $language) { ?>
                                        <textarea class="information_language<?php echo $language['language_id']; ?> ck form-control" name="information[information_description][<?php echo $information['information_id']; ?>][<?php echo $language['language_id']; ?>][meta_keywords]" cols="25" rows="6"><?php echo isset($information['information_description'][$language['language_id']]) ? $information['information_description'][$language['language_id']]['meta_keywords'] : ''; ?></textarea>
                                        <span class="information_language<?php echo $language['language_id']; ?> countk">-</span>
                                    <?php } ?>
                                </td>
                                <td class="center">
                                    <?php foreach ($languages as $language) { ?>
                                        <textarea name="information[information_description][<?php echo $information['information_id']; ?>][<?php echo $language['language_id']; ?>][meta_description]" cols="25" rows="6" class="information_language<?php echo $language['language_id']; ?> cc form-control"><?php echo isset($information['information_description'][$language['language_id']]) ? $information['information_description'][$language['language_id']]['meta_description'] : ''; ?></textarea>
                                        <span class="information_language<?php echo $language['language_id']; ?> count">-</span>        
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                            <tr>
                                <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                            </tr>
                    <?php } ?>
                </tbody>    
            </table>
        </div>
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

<script type="text/javascript"><!--
var currency = "<?php echo $currency; ?>";
var edited = false;
function showLang(selected,button){
    $('.'+selected).siblings().hide();
    $('.'+selected).show();
    $('.button_tabs .'+button+'_button').css('opacity','1');
    $('.button_tabs a[value="'+selected+'"]').css('opacity','0.5');
}

showLang('information_language'+currency,'information_language');

$(document).ready(function() {
    $("input, textarea").keypress(function() {
        edited = true;
    });
    $("form").submit(function(e) {
        edited = false;
    });

    $(".count").each(function() {
        var l = $(this).prev().val().length;
        if(l == 0){
            $(this).html('✘');
        } else {
            $(this).html('✔');
        }
    });
    $(".countk").each(function() {
        var l = $(this).prev().val().length;
        if(l == 0){
            $(this).html('✘');
        } else {
            $(this).html('✔');
        }
    });

    $(".countt").each(function() {
        var l = $(this).prev().val().length;
        if(l == 0){
            $(this).html('✘');
        } else {
            $(this).html('✔');
        }
    });

    $(".countta").each(function() {
        var l = $(this).prev().val().length;
        if(l == 0){
            $(this).html('✘');
        } else {
            $(this).html('✔');
        }
    });

    
});

$(function(){
    $(".help_icon").tipTip({
        maxWidth: "275px", 
        defaultPosition: "top",
        delay: 100
    });
});

<?php if(isset($existing_keyword) && $existing_keyword){ ?>
    var existing_keyword = "<?php echo $existing_keyword; ?>";
    var selector = $('input[value*="'+existing_keyword+'"]');
    var trimmed;
    $(selector).each(function() {
        trimmed = $.trim($(this).val());
        if(trimmed == existing_keyword){
            $(this).addClass('existing_keyword');
        }
    });
    $(selector).keyup(function() {
        $(this).removeClass('existing_keyword');
    });
<?php } ?>

//--></script>

<script type="text/javascript"><!--

$('.cc').keyup(function(){
    var l = $(this).val().length;
    if (l == 0) {
         $(this).next().html('✘');
    } else {
         $(this).next().html('✔');
    }
});

$('.ck').keyup(function(){
    var l = $(this).val().length;
    if (l == 0) {
         $(this).next().html('✘');
    } else {
         $(this).next().html('✔');
    }
});

$('.ct').keyup(function(){
    var l = $(this).val().length;
    if (l == 0) {
         $(this).next().html('✘');
    } else {
         $(this).next().html('✔');
    }
});


$('.cta').keyup(function(){
    var l = $(this).val().length;
    if (l == 0) {
         $(this).next().html('✘');
    } else {
         $(this).next().html('✔');
    }
});


/*
$('input[name=filter_keyword]').keydown(function(e) {
    if (e.keyCode == 13) {
        filter();
    }
});
*/
    
//--></script>
<?php echo $seoloadscripts; ?>
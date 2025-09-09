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
                    <?php echo $tab_general; ?>
                </h3>
                <span class="sub-title"><?php echo $tab_general_help; ?></span>
            </div>
            <br>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-general" class="form-horizontal">
        <div id="tab_general">
            <div class="row">
                    <div class="col-sm-6">
                        &nbsp;
                    </div>
                    <div class="col-sm-4">
                        <?php foreach ($languages as $language) { ?>
                        <div class="buttons button_tabs">
                            <a value="custom_url_store_language<?php echo $language['language_id']; ?>" class="btn btn-primary custom_url_store_language_button" onclick="showLang('custom_url_store_language<?php echo $language['language_id']; ?>','custom_url_store_language');"><span>
                            <?php if($version < 2200) { ?>
                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" >
                             <?php } else { ?>
                             <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                             <?php } ?>
                            </span></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2">
                        <div class="pull-right">
                           <button type="submit"  form="form-general" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
            <table id="custom_url_store" class="pure-table pure-table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <td class="left"><?php echo $column_url; ?></td>
                        <td class="left"><?php echo $column_keyword; ?></td>
                        <td class="center brt"><?php echo $column_title; ?><a class="help_icon" title="<?php echo $title_help ?>"></a></td>
                        <td class="center brt"><?php echo $column_meta_keyword; ?><a class="help_icon" title="<?php echo $keywords_help ?>"></a></td>
                        <td class="center"><?php echo $column_meta_description; ?><a class="help_icon" title="<?php echo $description_help ?>"></a></td>
                        <td align="center"><?php echo 'Action'; ?></td>
                    </tr>
                </thead>    
                                <?php $custom_url_store_row = 0; ?>
                <?php foreach($custom_url_store_data as $key => $value) { ?>   
                    <tbody id="custom_url_store_row<?php echo $custom_url_store_row; ?>">
                        <tr>   <td><?php echo $domain; ?>index.php?route=<input class="blueprint" type="text" size="20" name="custom_url_store[<?php echo $custom_url_store_row; ?>][query]" value="<?php echo $value['id']; ?>" /></td>
                                <?php foreach($value as $row => $custom_url_store_top){ ?>
                                <?php if(isset($row) && $row == 'keyword') { ?>
                                     <td>
                                     <?php foreach ($languages as $language) { ?>
                                    <?php echo $domain; ?><input size="30"  type="text" class="custom_url_store_language<?php echo $language['language_id']; ?> ct form-control" name="custom_url_store[<?php echo $custom_url_store_row; ?>][keyword][<?php echo $language['language_id']; ?>]" value="<?php echo $custom_url_store_top['language_id'][$language['language_id']]; ?>" class="form-control" />
                                     <?php } ?>
                                     </td>
                                <?php } ?>
                                <?php if(isset($row) && $row == 'custom_url_store_description') { ?>
                                    <td class="brt center">
                                        <?php foreach ($languages as $language) { ?>
                                            <textarea class="custom_url_store_language<?php echo $language['language_id']; ?> ct" name="custom_url_store[<?php echo $custom_url_store_row; ?>][custom_url_store_description][<?php echo $language['language_id']; ?>][name]" cols="20" rows="6"><?php echo isset($value[$row][$language['language_id']]) ? $value[$row][$language['language_id']]['name'] : ''; ?></textarea>
                                            <span class="custom_url_store_language<?php echo $language['language_id']; ?> countt">-</span>
                                            <?php if (isset(${'error_name_custom_url_store_'.$custom_url_store_row.'_'.$language['language_id']})) { ?>
                                                <span class="custom_url_store_language<?php echo $language_id; ?> error"><?php echo ${'error_name_custom_url_store_'.$custom_url_store_row.'_'.$language['language_id']}; ?></span>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td class="brt center">
                                        <?php foreach ($languages as $language) { ?>
                                            <textarea class="custom_url_store_language<?php echo $language['language_id']; ?> ck" name="custom_url_store[<?php echo $custom_url_store_row; ?>][custom_url_store_description][<?php echo $language['language_id']; ?>][meta_keywords]" cols="20" rows="6"><?php echo isset($value[$row][$language['language_id']]) ? $value[$row][$language['language_id']]['meta_keywords'] : ''; ?></textarea>
                                            <span class="custom_url_store_language<?php echo $language['language_id']; ?> countk">-</span>
                                        <?php } ?>
                                    </td>
                                    <td class="center">
                                        <?php foreach ($languages as $language) { ?>
                                            <textarea class="custom_url_store_language<?php echo $language['language_id']; ?> cc" name="custom_url_store[<?php echo $custom_url_store_row; ?>][custom_url_store_description][<?php echo $language['language_id']; ?>][meta_description]" cols="20" rows="6"><?php echo isset($value[$row][$language['language_id']]) ? $value[$row][$language['language_id']]['meta_description'] : ''; ?></textarea>
                                            <span class="custom_url_store_language<?php echo $language['language_id']; ?> count">-</span>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            <?php } ?>
                            <td align="center"><a style="text-decoration: none;"  onclick="$('#custom_url_store_row<?php echo $custom_url_store_row; ?>').remove();" class="btn btn-danger"><span><?php echo $button_remove; ?></span></a></td>
                        </tr>
                    </tbody>
                    <?php $custom_url_store_row++; ?>
                <?php } ?>
                <tfoot>
                    <tr>
                        <td width="90%" colspan="5">&nbsp;</td>
                        <td width="10%" align="center"><a style="text-decoration: none;" onclick="addcustom_url_store();" class="btn btn-primary"><span><i class="fa fa-plus"></i>  <?php echo $button_add_custom_url_store; ?></span></a></td>
                    </tr>
                </tfoot>              
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
var custom_url_store_row = <?php echo $custom_url_store_row; ?>;
var currency = "<?php echo $currency; ?>";
var edited = false;
function addcustom_url_store() {
    html  = '<tbody id="custom_url_store_row' + custom_url_store_row + '">';
    html += '<tr>'; 
    html += '<td class="left"><?php echo $domain; ?>index.php?route=<input type="text" size="18" name="custom_url_store['+custom_url_store_row+'][query]" value="" /></td>';
  
    <?php foreach ($languages as $language) { ?>
     html += '<td class="left"><?php echo $domain; ?><input type="text" size="30" class="custom_url_store_language'+language_id+'"  name="custom_url_store['+custom_url_store_row+'][keyword]['+language_id+']" value="" /></td>';

    html += '<td class="brt center">'
    var language_id = "<?php echo $language['language_id']; ?>";
    html += '<textarea class="custom_url_store_language'+language_id+'" name="custom_url_store['+custom_url_store_row+'][custom_url_store_description]['+language_id+'][name]" cols="20" rows="6"></textarea>';
    <?php } ?>
    html += '</td>';
    html += '<td class="brt center">';
    <?php foreach ($languages as $language) { ?>
        var language_id = "<?php echo $language['language_id']; ?>";
        html += '<textarea class="custom_url_store_language'+language_id+'" name="custom_url_store['+custom_url_store_row+'][custom_url_store_description]['+language_id+'][meta_keywords]" cols="20" rows="6"></textarea>';
    <?php } ?>
    html += '</td>';
    html += '<td class="center">';
    <?php foreach ($languages as $language) { ?>
        var language_id = "<?php echo $language['language_id']; ?>";
        html += '<textarea class="custom_url_store_language'+language_id+'" name="custom_url_store['+custom_url_store_row+'][custom_url_store_description]['+language_id+'][meta_description]" cols="20" rows="6"></textarea>';
    <?php } ?>
    html += '</td>';
    html += '<td align="center"><a style="text-decoration: none;" onclick="$(\'#custom_url_store_row' + custom_url_store_row + '\').remove();" class="btn btn-danger"><span><?php echo $button_remove; ?></span></a></td>';
    html += '</tr>';
    html += '</tbody>';
    
    $('#custom_url_store tfoot').before(html);
    
    custom_url_store_row++;
    showLang('custom_url_store_language'+currency,'custom_url_store_language');
}

function showLang(selected,button){
    $('.'+selected).siblings().hide();
    $('.'+selected).show();
    $('.button_tabs .'+button+'_button').css('opacity','1');
    $('.button_tabs a[value="'+selected+'"]').css('opacity','0.5');
}

showLang('custom_url_store_language'+currency,'custom_url_store_language');

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
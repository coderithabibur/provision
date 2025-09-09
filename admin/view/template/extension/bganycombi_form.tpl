<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-bganycombi" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a> </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-bganycombi" class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <label class="radio-inline">
                    <input type="radio" name="status" value="1" <?php if ($status == 1) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_enabled; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" value="0" <?php if ($status == 0) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_disabled; ?> </label>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label" for="input-disctype"><?php echo $entry_disctype; ?></label>
                <div class="col-sm-8">
                  <label class="radio-inline">
                    <input type="radio" name="disctype" value="1" <?php if ($disctype == 1) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_free; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="disctype" value="2" <?php if ($disctype == 2) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_per; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="disctype" value="3" <?php if ($disctype == 3) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_fix; ?> </label>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <div id="discount" style="visibility:hidden">
                  <label class="col-sm-4 control-label" for="input-discount"><?php echo $entry_discount; ?></label>
                  <div class="col-sm-8">
                    <input type="text" name="discount" value="<?php echo $discount; ?>" placeholder="<?php echo $entry_discount; ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label" for="input-buyqty"><?php echo $entry_buyqty; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="buyqty" value="<?php echo $buyqty; ?>" placeholder="<?php echo $entry_buyqty; ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label" for="input-getqty"><?php echo $entry_getqty; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="getqty" value="<?php echo $getqty; ?>" placeholder="<?php echo $entry_getqty; ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label" for="input-startdate"><?php echo $entry_startdate; ?></label>
                <div class="col-sm-8">
                  <div class="input-group date">
                    <input type="text" name="startdate" value="<?php echo $startdate; ?>" placeholder="<?php echo $entry_startdate; ?>" data-date-format="YYYY-MM-DD" id="input-startdate" class="form-control" />
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label" for="input-enddate"><?php echo $entry_enddate; ?></label>
                <div class="col-sm-8">
                  <div class="input-group date">
                    <input type="text" name="enddate" value="<?php echo $enddate; ?>" placeholder="<?php echo $entry_enddate; ?>" data-date-format="YYYY-MM-DD" id="input-enddate" class="form-control" />
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label"><?php echo $entry_customer_group; ?></label>
                <div class="col-sm-8">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($customer_groups as $cgrp) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($cgrp['customer_group_id'], $customer_group)) { ?>
                        <input type="checkbox" name="customer_group[]" value="<?php echo $cgrp['customer_group_id']; ?>" checked="checked" />
                        <?php echo $cgrp['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="customer_group[]" value="<?php echo $cgrp['customer_group_id']; ?>" />
                        <?php echo $cgrp['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <a class="badge" onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a class="badge" onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label"><?php echo $entry_store; ?></label>
                <div class="col-sm-8">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($stores as $storers) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($storers['store_id'], $store)) { ?>
                        <input type="checkbox" name="store[]" value="<?php echo $storers['store_id']; ?>" checked="checked" />
                        <?php echo $storers['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="store[]" value="<?php echo $storers['store_id']; ?>" />
                        <?php echo $storers['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <a class="badge" onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a class="badge" onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> </div>
              </div>
              <div style="clear:both;padding:15px;"></div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th><?php echo $text_buyprodlist; ?></th>
                    <th><?php echo $text_getprodlist; ?></th>
                  </tr>
                  <tr>
                    <td><div>
                        <label class="control-label" for="input-buyproduct"><?php echo $entry_buyproduct; ?></label>
                        <input type="text" name="buyproduct" value=""  id="input-buyproduct" class="form-control" />
                        <div id="buyproduct" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($buyproduct_data) { ?>
                          <?php foreach ($buyproduct_data as $product) { ?>
                          <div id="buyproduct-<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                            <input type="hidden" name="buyproduct[]" value="<?php echo $product['product_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div>
                        <label class="control-label" for="input-exbuyproduct"><?php echo $entry_exbuyproduct; ?></label>
                        <input type="text" name="exbuyproduct" value=""  id="input-exbuyproduct" class="form-control" />
                        <div id="exbuyproduct" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($exbuyproduct_data) { ?>
                          <?php foreach ($exbuyproduct_data as $product) { ?>
                          <div id="exbuyproduct-<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                            <input type="hidden" name="exbuyproduct[]" value="<?php echo $product['product_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div></td>
                    <td><div>
                        <label class="control-label" for="input-getproduct"><?php echo $entry_getproduct; ?></label>
                        <input type="text" name="getproduct" value=""  id="input-getproduct" class="form-control" />
                        <div id="getproduct" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($getproduct_data) { ?>
                          <?php foreach ($getproduct_data as $product) { ?>
                          <div id="getproduct-<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                            <input type="hidden" name="getproduct[]" value="<?php echo $product['product_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div>
                        <label class="control-label" for="input-exgetproduct"><?php echo $entry_exgetproduct; ?></label>
                        <input type="text" name="exgetproduct" value=""  id="input-exgetproduct" class="form-control" />
                        <div id="exgetproduct" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($exgetproduct_data) { ?>
                          <?php foreach ($exgetproduct_data as $product) { ?>
                          <div id="exgetproduct-<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                            <input type="hidden" name="exgetproduct[]" value="<?php echo $product['product_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div>
                        <label class="control-label" for="input-buycategory"><?php echo $entry_buycategory; ?></label>
                        <input type="text" name="buycategory" value=""  id="input-buycategory" class="form-control" />
                        <div id="buycategory" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($buycategory_data) { ?>
                          <?php foreach ($buycategory_data as $category) { ?>
                          <div id="buycategory-<?php echo $category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                            <input type="hidden" name="buycategory[]" value="<?php echo $category['category_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div>
                        <label class="control-label" for="input-exbuycategory"><?php echo $entry_exbuycategory; ?></label>
                        <input type="text" name="exbuycategory" value=""  id="input-exbuycategory" class="form-control" />
                        <div id="exbuycategory" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($exbuycategory_data) { ?>
                          <?php foreach ($exbuycategory_data as $category) { ?>
                          <div id="exbuycategory-<?php echo $category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                            <input type="hidden" name="exbuycategory[]" value="<?php echo $category['category_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div></td>
                    <td><div>
                        <label class="control-label" for="input-getcategory"><?php echo $entry_getcategory; ?></label>
                        <input type="text" name="getcategory" value=""  id="input-getcategory" class="form-control" />
                        <div id="getcategory" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($getcategory_data) { ?>
                          <?php foreach ($getcategory_data as $category) { ?>
                          <div id="getcategory-<?php echo $category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                            <input type="hidden" name="getcategory[]" value="<?php echo $category['category_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div>
                        <label class="control-label" for="input-exgetcategory"><?php echo $entry_exgetcategory; ?></label>
                        <input type="text" name="exgetcategory" value=""  id="input-exgetcategory" class="form-control" />
                        <div id="exgetcategory" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($exgetcategory_data) { ?>
                          <?php foreach ($exgetcategory_data as $category) { ?>
                          <div id="exgetcategory-<?php echo $category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                            <input type="hidden" name="exgetcategory[]" value="<?php echo $category['category_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div>
                        <label class="control-label" for="input-buymanufacturer"><?php echo $entry_buymanufacturer; ?></label>
                        <input type="text" name="buymanufacturer" value=""  id="input-buymanufacturer" class="form-control" />
                        <div id="buymanufacturer" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($buymanufacturer_data) { ?>
                          <?php foreach ($buymanufacturer_data as $manufacturer) { ?>
                          <div id="buymanufacturer-<?php echo $manufacturer['manufacturer_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $manufacturer['name']; ?>
                            <input type="hidden" name="buymanufacturer[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div>
                        <label class="control-label" for="input-exbuymanufacturer"><?php echo $entry_exbuymanufacturer; ?></label>
                        <input type="text" name="exbuymanufacturer" value=""  id="input-exbuymanufacturer" class="form-control" />
                        <div id="exbuymanufacturer" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($exbuymanufacturer_data) { ?>
                          <?php foreach ($exbuymanufacturer_data as $manufacturer) { ?>
                          <div id="exbuymanufacturer-<?php echo $manufacturer['manufacturer_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $manufacturer['name']; ?>
                            <input type="hidden" name="exbuymanufacturer[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div></td>
                    <td><div>
                        <label class="control-label" for="input-getmanufacturer"><?php echo $entry_getmanufacturer; ?></label>
                        <input type="text" name="getmanufacturer" value=""  id="input-getmanufacturer" class="form-control" />
                        <div id="getmanufacturer" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($getmanufacturer_data) { ?>
                          <?php foreach ($getmanufacturer_data as $manufacturer) { ?>
                          <div id="getmanufacturer-<?php echo $manufacturer['manufacturer_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $manufacturer['name']; ?>
                            <input type="hidden" name="getmanufacturer[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                      <div>
                        <label class="control-label" for="input-exgetmanufacturer"><?php echo $entry_exgetmanufacturer; ?></label>
                        <input type="text" name="exgetmanufacturer" value=""  id="input-exgetmanufacturer" class="form-control" />
                        <div id="exgetmanufacturer" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php if ($exgetmanufacturer_data) { ?>
                          <?php foreach ($exgetmanufacturer_data as $manufacturer) { ?>
                          <div id="exgetmanufacturer-<?php echo $manufacturer['manufacturer_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $manufacturer['name']; ?>
                            <input type="hidden" name="exgetmanufacturer[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div></td>
                  </tr>
                </table>
              </div>
              <div style="clear:both;padding:15px;"></div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-showofferat"><?php echo $entry_showofferat; ?></label>
                <div class="col-sm-10">
                  <label class="radio-inline">
                    <input type="radio" name="showofferat" value="1" <?php if ($showofferat == 1) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_afterprc; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="showofferat" value="2" <?php if ($showofferat == 2) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_atbtnpop; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="showofferat" value="3" <?php if ($showofferat == 3) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_beforedesctab; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="showofferat" value="4" <?php if ($showofferat == 4) { ?>checked="checked"<?php } ?> />
                    <?php echo $text_extradesctab; ?> </label>
                </div>
              </div>
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="<?php echo $language['imgsrc']; ?>"/> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($title[$language['language_id']]) ? $title[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-ribbontext"><?php echo $entry_ribbontext; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="ribbontext[<?php echo $language['language_id']; ?>]" value="<?php echo isset($ribbontext[$language['language_id']]) ? $ribbontext[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_ribbontext; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-ordtotaltext"><?php echo $entry_ordtotaltext; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="ordtotaltext[<?php echo $language['language_id']; ?>]" value="<?php echo isset($ordtotaltext[$language['language_id']]) ? $ordtotaltext[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_ordtotaltext; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-offer_heading"><?php echo $entry_offer_heading; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="offer_heading[<?php echo $language['language_id']; ?>]" value="<?php echo isset($offer_heading[$language['language_id']]) ? $offer_heading[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_offer_heading; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-offer_content"><?php echo $entry_offer_content; ?></label>
                    <div class="col-sm-10">
                      <textarea name="offer_content[<?php echo $language['language_id']; ?>]" class="form-control summernote" data-toggle="summernote" data-lang="{{ summernote }}"><?php echo isset($offer_content[$language['language_id']]) ? $offer_content[$language['language_id']] : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>

        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#language a:first').tab('show');
</script>
<?php if($isoc2021) { ?>
<script type="text/javascript">$('.summernote').summernote({height: 300});</script>
<?php } ?>
<?php if($isoc23) { ?>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<?php } ?>
<?php if($isoc30) { ?>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/summernote-image-attributes.js"></script> 
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<?php } ?>
<?php echo $footer; ?>
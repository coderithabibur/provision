<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-bganycombi').submit() : false;"><i class="fa fa-trash-o"></i></button>
        <?php echo $extdoc; ?> </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="checkboxcolumn dropdown" style="float:right">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $text_display_col; ?> <span class="caret"></span></button>
            <ul class="dropdown-menu" style="height: 300px; overflow-y: scroll;">
              <?php foreach ($checkcolumns as $chkcol) { ?>
              <li class="label label-default" style="display:block;text-align:left">
                <label>
                  <input type="checkbox" data-str="<?php echo $chkcol;?>" class="chkcolumn"/>
                  <?php echo $check_head_columns[$chkcol]; ?> </label>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="dropdown" style="width:90%">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $text_filter; ?> <span class="caret"></span></button>
            <ul class="dropdown-menu" style="width:100%">
              <div class="form-group col-sm-3">
                <label class="control-label"><?php echo $entry_title; ?></label>
                <input type="text" name="filter_title" value="<?php echo $filter_title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filribbontext">
                <label class="control-label"><?php echo $entry_ribbontext; ?></label>
                <input type="text" name="filter_ribbontext" value="<?php echo $filter_ribbontext; ?>" placeholder="<?php echo $entry_ribbontext; ?>" id="input-ribbontext" class="form-control" />
              </div>
              <div class="form-group col-sm-3 fildisctype">
                <label class="control-label"><?php echo $entry_disctype; ?></label>
                <select name="filter_disctype" id="filter_disctype" class="form-control">
                  <option value=""></option>
                  <option value="1" <?php if($filter_disctype == 1) { ?>selected="selected"<?php } ?>><?php echo $text_per; ?></option>
                  <option value="2" <?php if($filter_disctype == 2) { ?>selected="selected"<?php } ?>><?php echo $text_per; ?></option>
                  <option value="3" <?php if($filter_disctype == 3) { ?>selected="selected"<?php } ?>><?php echo $text_fix; ?></option>
                </select>
              </div>
              <div class="form-group col-sm-3 fildiscount">
                <label class="control-label"><?php echo $entry_discount; ?></label>
                <input type="text" name="filter_discount" value="<?php echo $filter_discount; ?>" placeholder="<?php echo $entry_discount; ?>" id="input-discount" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filbuyqty">
                <label class="control-label"><?php echo $entry_buyqty; ?></label>
                <input type="text" name="filter_buyqty" value="<?php echo $filter_buyqty; ?>" placeholder="<?php echo $entry_buyqty; ?>" id="input-buyqty" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filgetqty">
                <label class="control-label"><?php echo $entry_getqty; ?></label>
                <input type="text" name="filter_getqty" value="<?php echo $filter_getqty; ?>" placeholder="<?php echo $entry_getqty; ?>" id="input-getqty" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filstartdate">
                <label class="control-label"><?php echo $entry_startdate; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_startdate" value="<?php echo $filter_startdate; ?>" placeholder="<?php echo $entry_startdate; ?>" data-date-format="YYYY-MM-DD" id="input-startdate" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group col-sm-3 filenddate">
                <label class="control-label" ><?php echo $entry_enddate; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_enddate" value="<?php echo $filter_enddate; ?>" placeholder="<?php echo $entry_enddate; ?>" data-date-format="YYYY-MM-DD" id="input-enddate" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group col-sm-3 filstatus">
                <label class="control-label" ><?php echo $entry_status; ?></label>
                <select name="filter_status" id="filter_status" class="form-control">
                  <option value=""></option>
                  <option value="1" <?php if($filter_status == '1') { ?>selected="selected"<?php } ?>><?php echo $text_enabled; ?></option>
                  <option value="0" <?php if($filter_status == '0') { ?>selected="selected"<?php } ?>><?php echo $text_disabled; ?></option>
                </select>
              </div>
              <div class="form-group col-sm-3 filcustomer_group">
                <label class="control-label" ><?php echo $entry_customer_group; ?></label>
                <select name="filter_customer_group_id" id="filter_customer_group_id" class="form-control">
                  <option value=""></option>
                  <?php foreach ($customer_groups as $cgrp) { ?>
                  <option value="<?php echo $cgrp['customer_group_id']; ?>" <?php if($filter_customer_group_id == $cgrp['customer_group_id']) { ?>selected="selected"<?php } ?>><?php echo $cgrp['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-sm-3 filstore">
                <label class="control-label" ><?php echo $entry_store; ?></label>
                <select name="filter_store_id" id="filter_store_id" class="form-control">
                  <option value=""></option>
                  <?php foreach ($stores as $stor) { ?>
                  <option value="<?php echo $stor['store_id']; ?>" <?php if($filter_store_id == $stor['store_id']) { ?>selected="selected"<?php } ?>><?php echo $stor['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-sm-3 filbuyproduct">
                <label class="control-label" ><?php echo $entry_buyproduct; ?></label>
                <input type="text" name="filter_buyproduct_name" value="<?php echo $filter_buyproduct_name; ?>" placeholder="<?php echo $entry_buyproduct; ?>" class="form-control" />
                <input type="hidden" name="filter_buyproduct_id" value="<?php echo $filter_buyproduct_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filexbuyproduct">
                <label class="control-label" ><?php echo $entry_exbuyproduct; ?></label>
                <input type="text" name="filter_exbuyproduct_name" value="<?php echo $filter_exbuyproduct_name; ?>" placeholder="<?php echo $entry_exbuyproduct; ?>"  class="form-control" />
                <input type="hidden" name="filter_exbuyproduct_id" value="<?php echo $filter_exbuyproduct_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filgetproduct">
                <label class="control-label" ><?php echo $entry_getproduct; ?></label>
                <input type="text" name="filter_getproduct_name" value="<?php echo $filter_getproduct_name; ?>" placeholder="<?php echo $entry_getproduct; ?>" class="form-control" />
                <input type="hidden" name="filter_getproduct_id" value="<?php echo $filter_getproduct_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filexgetproduct">
                <label class="control-label" ><?php echo $entry_exgetproduct; ?></label>
                <input type="text" name="filter_exgetproduct_name" value="<?php echo $filter_exgetproduct_name; ?>" placeholder="<?php echo $entry_exgetproduct; ?>" class="form-control" />
                <input type="hidden" name="filter_exgetproduct_id" value="<?php echo $filter_exgetproduct_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filbuycategory">
                <label class="control-label" ><?php echo $entry_buycategory; ?></label>
                <input type="text" name="filter_buycategory_name" value="<?php echo $filter_buycategory_name; ?>" placeholder="<?php echo $entry_buycategory; ?>" class="form-control" />
                <input type="hidden" name="filter_buycategory_id" value="<?php echo $filter_buycategory_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filexbuycategory">
                <label class="control-label" ><?php echo $entry_exbuycategory; ?></label>
                <input type="text" name="filter_exbuycategory_name" value="<?php echo $filter_exbuycategory_name; ?>" placeholder="<?php echo $entry_exbuycategory; ?>" class="form-control" />
                <input type="hidden" name="filter_exbuycategory_id" value="<?php echo $filter_exbuycategory_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filgetcategory">
                <label class="control-label" ><?php echo $entry_getcategory; ?></label>
                <input type="text" name="filter_getcategory_name" value="<?php echo $filter_getcategory_name; ?>" placeholder="<?php echo $entry_getcategory; ?>" class="form-control" />
                <input type="hidden" name="filter_getcategory_id" value="<?php echo $filter_getcategory_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filexgetcategory">
                <label class="control-label" ><?php echo $entry_exgetcategory; ?></label>
                <input type="text" name="filter_exgetcategory_name" value="<?php echo $filter_exgetcategory_name; ?>" placeholder="<?php echo $entry_exgetcategory; ?>" class="form-control" />
                <input type="hidden" name="filter_exgetcategory_id" value="<?php echo $filter_exgetcategory_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filbuymanufacturer">
                <label class="control-label" ><?php echo $entry_buymanufacturer; ?></label>
                <input type="text" name="filter_buymanufacturer_name" value="<?php echo $filter_buymanufacturer_name; ?>" placeholder="<?php echo $entry_buymanufacturer; ?>" class="form-control" />
                <input type="hidden" name="filter_buymanufacturer_id" value="<?php echo $filter_buymanufacturer_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filexbuymanufacturer">
                <label class="control-label" ><?php echo $entry_exbuymanufacturer; ?></label>
                <input type="text" name="filter_exbuymanufacturer_name" value="<?php echo $filter_exbuymanufacturer_name; ?>" placeholder="<?php echo $entry_exbuymanufacturer; ?>" class="form-control" />
                <input type="hidden" name="filter_exbuymanufacturer_id" value="<?php echo $filter_exbuymanufacturer_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filgetmanufacturer">
                <label class="control-label" ><?php echo $entry_getmanufacturer; ?></label>
                <input type="text" name="filter_getmanufacturer_name" value="<?php echo $filter_getmanufacturer_name; ?>" placeholder="<?php echo $entry_getmanufacturer; ?>" class="form-control" />
                <input type="hidden" name="filter_getmanufacturer_id" value="<?php echo $filter_getmanufacturer_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3 filexgetmanufacturer">
                <label class="control-label" ><?php echo $entry_exgetmanufacturer; ?></label>
                <input type="text" name="filter_exgetmanufacturer_name" value="<?php echo $filter_exgetmanufacturer_name; ?>" placeholder="<?php echo $entry_exgetmanufacturer; ?>" class="form-control" />
                <input type="hidden" name="filter_exgetmanufacturer_id" value="<?php echo $filter_exgetmanufacturer_id; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label col-sm-12" for="input-btnfilter">&nbsp;</label>
                <button type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
              </div>
            </ul>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-bganycombi">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $entry_title; ?></td>
                  <td class="text-left colribbontext"><?php echo $entry_ribbontext; ?></td>
                  <td class="text-left coldisctype"><?php echo $entry_disctype; ?></td>
                  <td class="text-left coldiscount"><?php echo $entry_discount; ?></td>
                  <td class="text-left colbuyqty"><?php echo $entry_buyqty; ?></td>
                  <td class="text-left colgetqty"><?php echo $entry_getqty; ?></td>
                  <td class="text-left colstartdate"><?php echo $entry_startdate; ?></td>
                  <td class="text-left colenddate"><?php echo $entry_enddate; ?></td>
                  <td class="text-left colcustomer_group"><?php echo $entry_customer_group; ?></td>
                  <td class="text-left colstore"><?php echo $entry_store; ?></td>
                  <td class="text-left colbuyproduct"><?php echo $entry_buyproduct; ?></td>
                  <td class="text-left colexbuyproduct"><?php echo $entry_exbuyproduct; ?></td>
                  <td class="text-left colgetproduct"><?php echo $entry_getproduct; ?></td>
                  <td class="text-left colexgetproduct"><?php echo $entry_exgetproduct; ?></td>
                  <td class="text-left colbuycategory"><?php echo $entry_buycategory; ?></td>
                  <td class="text-left colexbuycategory"><?php echo $entry_exbuycategory; ?></td>
                  <td class="text-left colgetcategory"><?php echo $entry_getcategory; ?></td>
                  <td class="text-left colexgetcategory"><?php echo $entry_exgetcategory; ?></td>
                  <td class="text-left colbuymanufacturer"><?php echo $entry_buymanufacturer; ?></td>
                  <td class="text-left colexbuymanufacturer"><?php echo $entry_exbuymanufacturer; ?></td>
                  <td class="text-left colgetmanufacturer"><?php echo $entry_getmanufacturer; ?></td>
                  <td class="text-left colexgetmanufacturer"><?php echo $entry_exgetmanufacturer; ?></td>
                  <td class="text-left colstatus"><?php echo $entry_status; ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($bganycombis) { ?>
                <?php foreach ($bganycombis as $bganycombi) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($bganycombi['bganycombi_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $bganycombi['bganycombi_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $bganycombi['bganycombi_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $bganycombi['title']; ?></td>
                  <td class="text-left colribbontext"><?php echo $bganycombi['ribbontext']; ?></td>
                  <td class="text-left coldisctype"><?php echo $bganycombi['disctype']; ?></td>
                  <td class="text-left coldiscount"><?php echo $bganycombi['discount']; ?></td>
                  <td class="text-left colbuyqty"><?php echo $bganycombi['buyqty']; ?></td>
                  <td class="text-left colgetqty"><?php echo $bganycombi['getqty']; ?></td>
                  <td class="text-left colstartdate"><?php echo $bganycombi['startdate']; ?></td>
                  <td class="text-left colenddate"><?php echo $bganycombi['enddate']; ?></td>
                  <td class="text-left colcustomer_group"><?php echo $bganycombi['customer_group_data']; ?></td>
                  <td class="text-left colstore"><?php echo $bganycombi['store_data']; ?></td>
                  <td class="text-left colbuyproduct"><?php echo $bganycombi['buyproduct_data']; ?></td>
                  <td class="text-left colexbuyproduct"><?php echo $bganycombi['exbuyproduct_data']; ?></td>
                  <td class="text-left colgetproduct"><?php echo $bganycombi['getproduct_data']; ?></td>
                  <td class="text-left colexgetproduct"><?php echo $bganycombi['exgetproduct_data']; ?></td>
                  <td class="text-left colbuycategory"><?php echo $bganycombi['buycategory_data']; ?></td>
                  <td class="text-left colexbuycategory"><?php echo $bganycombi['exbuycategory_data']; ?></td>
                  <td class="text-left colgetcategory"><?php echo $bganycombi['getcategory_data']; ?></td>
                  <td class="text-left colexgetcategory"><?php echo $bganycombi['exgetcategory_data']; ?></td>
                  <td class="text-left colbuymanufacturer"><?php echo $bganycombi['buymanufacturer_data']; ?></td>
                  <td class="text-left colexbuymanufacturer"><?php echo $bganycombi['exbuymanufacturer_data']; ?></td>
                  <td class="text-left colgetmanufacturer"><?php echo $bganycombi['getmanufacturer_data']; ?></td>
                  <td class="text-left colexgetmanufacturer"><?php echo $bganycombi['exgetmanufacturer_data']; ?></td>
                  <td class="text-left colstatus"><?php echo $bganycombi['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $bganycombi['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="30"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
<!--Header Start-->
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" onClick="document.getElementById('form-language').submit();" form="form-latest" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
		<a href="https://www.huntbee.com/documentation/docs/google-analytics-enhanced-ecommerce-tracking-for-opencart" target="_blank" class="btn btn-default"><i class="fa fa-book"></i> Documentation</a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
	  </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
 <!--Header End--> 
 
  <div class="container-fluid">
    <!--Start - Error / Success Message if any -->
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
	<!--End - Error / Success Message if any -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
			<?php if ($stores) { ?>
			<div class="pull-right">
			<select id="store">
				<option value="0" <?php echo ($store_id == 0)?'selected':''; ?>>Default Store</option>
				<?php foreach ($stores as $store) { ?>
					<option value="<?php echo $store['store_id']; ?>" <?php echo ($store_id == $store['store_id'])?'selected':''; ?>><?php echo $store['name']; ?></option>
				<?php } ?>
			</select>
			</div>
			<?php } ?>
      </div>
      <div class="panel-body">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-3">Product ID / SKU</label>
					<div class="col-sm-9">
						<select name="ga_ecom_id" class="form-control">
							<option value="product_id" <?php echo ($ga_ecom_id == 'product_id')? 'selected':''; ?>>Product ID</option>
							<option value="sku" <?php echo ($ga_ecom_id == 'sku')? 'selected':''; ?>>SKU</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3">Currency Code (should be same as in your google analytics setup)</label>
					<div class="col-sm-9">
						<select name="ga_ecom_currency" id="input-currency" class="form-control">
						<?php foreach ($currencies as $currency) { ?>
						<?php if ($currency['code'] == $ga_ecom_currency) { ?>
						<option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['code']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $currency['code']; ?>"><?php echo $currency['code']; ?></option>
						<?php } ?>
						<?php } ?>
					  </select>
					</div>
				</div>				
          </form>
      </div>
    </div>
  </div>
  <div class="container-fluid"> <!--Huntbee copyrights-->
 <center>
    <span class="help"><?php echo $heading_title; ?> - <?php echo $extension_version; ?> &copy; <a href="https://www.huntbee.com/">WWW.HUNTBEE.COM</a> | <a href="https://www.huntbee.com/get-support" target="_blank">SUPPORT</a> | <a href="https://www.huntbee.com/documentation/docs/google-analytics-enhanced-ecommerce-tracking-for-opencart" target="_blank">DOCUMENTATION</a></span></center>
</div><!--Huntbee copyrights end-->
</div>

<style type="text/css">
.pr_error,.pr_info,.pr_infos,.pr_success,.pr_warning{margin:10px 0;padding:12px}.pr_info{color:#00529B;background-color:#BDE5F8}.pr_success{color:#4F8A10;background-color:#DFF2BF}.pr_warning{color:#9F6000;background-color:#FEEFB3}.pr_error{color:#D8000C;background-color:#FFBABA}.pr_error i,.pr_info i,.pr_success i,.pr_warning i{margin:10px 0;vertical-align:middle}
</style>

<script type="text/javascript">
$('#store').on('change', function() {
	window.location.href = 'index.php?route=<?php echo $base_route; ?>/google_ecommerce&token=<?php echo $token; ?>&store_id='+$('#store').val();
});
</script>

<?php echo $footer; ?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-aftership" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-aftership" class="form-horizontal">
			<ul class="nav nav-tabs" id="tabs">
				<li class="active"><a href="#tab-setting" data-toggle="tab"><i class="fa fa-fw fa-wrench"></i> <?php echo $tab_setting; ?></a></li>
				<li><a href="#tab-courier" data-toggle="tab"><i class="fa fa-fw fa-truck"></i> <?php echo $tab_courier; ?></a></li>
				<li><a href="#tab-order-comment" data-toggle="tab"><i class="fa fa-fw fa-comments"></i> <?php echo $tab_order_comment; ?></a></li>
				<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-fw fa-question"></i> <?php echo $tab_help; ?></a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tab-setting">  
					<fieldset>	
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status;?></label>
							<div class="col-sm-10">
								<select name="aftership_status" id="input-status" class="form-control">
									<?php if ($aftership_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</fieldset>
					
					<fieldset>
						<legend class="small text-center"><?php echo $legend_aftership_account; ?></legend>

						<div class="aftership-info">
							<div class="aftership-info-container">
								<div class="aftership-info-message"><?php echo $help_register; ?></div>
								<div class="aftership-info-action"><a href="<?php echo $affiliate_url; ?>" target="_blank" class="btn btn-success btn-sync"><i class="fa fa-fw fa-refresh"></i> <?php echo $button_register; ?></a></div>
							</div>
						</div>
						
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-api-key"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_api_key; ?>"><?php echo $entry_api_key;?></span></label>
							<div class="col-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key"></i></span>	
									<input type="text" name="aftership_api_key" placeholder="<?php echo $entry_api_key; ?>" id="input-api-key" value="<?php echo $aftership_api_key; ?>" class="form-control" />
								</div>
								<?php if ($error_api_key) { ?>
								<div class="text-danger"><?php echo $error_api_key; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-username"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_username; ?>"><?php echo $entry_username;?></span></label>
							<div class="col-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>	
									<input type="text" name="aftership_username" placeholder="<?php echo $entry_username; ?>" id="input-username" value="<?php echo $aftership_username; ?>" class="form-control" />
								</div>
								<?php if ($error_username) { ?>
								<div class="text-danger"><?php echo $error_username; ?></div>
								<?php } ?>
							</div>
						</div>						
					</fieldset>	
					
					<fieldset>
						<legend class="small text-center"><?php echo $legend_order_statuses; ?></legend>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-order-status"><span data-toggle="tooltip" title="<?php echo $help_order_status; ?>"><?php echo $entry_order_status; ?></span></label>
							<div class="col-sm-10">
								<div class="well well-sm" style="height: 150px; overflow: auto;">
									<?php foreach ($order_statuses as $order_status) { ?>
									<div class="checkbox">
										<label>
											<?php if (in_array($order_status['order_status_id'], $aftership_order_statuses)) { ?>
											<input type="checkbox" name="aftership_order_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
											<?php echo $order_status['name']; ?>
											<?php } else { ?>
											<input type="checkbox" name="aftership_order_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" />
											<?php echo $order_status['name']; ?>
											<?php } ?>
										</label>
									</div>
									<?php } ?>
								</div>
								<?php if ($error_order_statuses) { ?>
								<div class="text-danger"><?php echo $error_order_statuses; ?></div>
								<?php } ?>
							</div>
						</div>
					</fieldset>
				</div>
				
				<div class="tab-pane" id="tab-courier">
					<div class="tab-content">
						<div class="aftership-info">
							<div class="aftership-info-container">
								<div class="aftership-info-message"><?php echo $help_courier_info; ?></div>
								<div class="aftership-info-action"><a id="syncronize-couriers" class="btn btn-success"><i class="fa fa-fw fa-refresh"></i> <?php echo $button_syncronize; ?></a></div>
							</div>
						</div>
					
						<div id="couriers-list"></div>
					</div>		
				</div>	
				
				<div class="tab-pane" id="tab-order-comment">
					<div class="tab-content">
						<fieldset>	
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-comment-auto"><span data-toggle="tooltip" title="<?php echo $help_comment_auto; ?>"><?php echo $entry_comment_auto;?></span></label>
								<div class="col-sm-10">
									<select name="aftership_comment_auto" id="input-comment-auto" class="form-control">
										<?php if ($aftership_comment_auto) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</fieldset>
						
						<fieldset class="comment-auto">
							<legend class="small text-center"></legend>
							<ul id="languages" class="nav nav-tabs">
								<?php foreach ($languages as $language) { ?>
								<li><a data-toggle="tab" href="#language-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div id="language-<?php echo $language['language_id']; ?>" class="tab-pane">
									<div class="alert alert-info"><i class="fa fa-fw fa-info-circle"></i> <?php echo $help_keywords; ?></div>
									
									<div class="form-group required">
										<label class="col-sm-2 control-label" for="input-tracking-comment-<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_comment; ?>"><?php echo $entry_comment_template; ?></span></label>
										<div class="col-sm-10">
											<textarea name="aftership_comment[<?php echo $language['language_id']; ?>][description]" id="input-tracking-comment-<?php echo $language['language_id']; ?>" rows="8" class="form-control"><?php echo isset($aftership_comment[$language['language_id']]) ? $aftership_comment[$language['language_id']]['description'] : ''; ?></textarea>
											<?php if (isset($error_order_comment[$language['language_id']])) { ?>
											<div class="text-danger"><?php echo $error_order_comment[$language['language_id']]; ?></div>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</fieldset>
					</div>		
				</div>	
				
				<div class="tab-pane" id="tab-help">
					<div class="tab-content">
						Change Log and HELP Guide is available : <a href="http://www.oc-extensions.com/AfterShip-Opencart-2.x" target="blank">HERE</a><br /><br />
						If you need support email us at <strong>support@oc-extensions.com</strong> (Please first read help guide)				
					</div>
				</div>
			</div>
        </form>
    </div>
  </div>
<script type="text/javascript"><!--
$('select[name=\'aftership_comment_auto\']').on('change', function(){
	if ($(this).val() == 1) {
		$('.comment-auto').show();
	} else {
		$('.comment-auto').hide();
	}
});

$('select[name=\'aftership_comment_auto\']').trigger('change');

$('#syncronize-couriers').on('click', function(){
	syncronizeCouriers();
});

getCouriers();

$('#languages li:first-child a').tab('show');

// ---- START FUNCTIONS --------
function getCouriers() {
	$.ajax({
		type: 'GET',
		url: 'index.php?route=module/aftership/getCouriers&token=<?php echo $token; ?>',
		beforeSend: function () {
			$('.aftership-loading-overlay').remove();
			$('#couriers-list').html('<div class="aftership-loading-overlay"><i class="fa fa-5x fa-spinner fa-spin aftership-loading"></i></div>');	
		},
		success: function(html) {
			$('.aftership-loading-overlay').remove();	
			$('#couriers-list').html(html);
		}
	});
}

function syncronizeCouriers() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=module/aftership/syncronizeCouriers&token=<?php echo $token; ?>',
		data: 'api_key=' + $('input[name=\'aftership_api_key\']').val(),
		dataType: 'json',
		beforeSend: function () {
			$('.aftership-loading-overlay, .aftership-sync-status').remove();
			$('#couriers-list').html('<div class="aftership-loading-overlay"><i class="fa fa-5x fa-spinner fa-spin aftership-loading"></i></div>');	
		},
		success: function(json) {
			$('.aftership-loading-overlay, .aftership-sync-status').remove();
			
			if (json['error']) {
				$('#couriers-list').before('<div class="alert alert-danger aftership-sync-status"><i class="fa fa-fw fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}
			
			if (json['success']) {
				$('#couriers-list').before('<div class="alert alert-success aftership-sync-status"><i class="fa fa-fw fa-check-circle"></i> ' + json['success'] + '</div>');
			}
			
			getCouriers();  // load updated list of couriers
		}
	});	
}
// ---- STOP FUNCTIONS --------
//--></script></div>
<?php echo $footer; ?>
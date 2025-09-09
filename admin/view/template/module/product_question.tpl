<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-pq-settings" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
		<div class="bs-callout bs-callout-install-service"><?php echo $help_install; ?></div>

		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pq-settings" class="form-pq-settings form-horizontal">
			<ul class="nav nav-tabs" id="tabs">
				<li class="active"><a href="#tab-general" data-toggle="tab"><i class="fa fa-fw fa-cogs"></i> <?php echo $tab_general; ?></a></li>
				<li><a href="#tab-question" data-toggle="tab"><i class="fa fa-fw fa-bars"></i> <?php echo $tab_question; ?></a></li>
				<li><a href="#tab-extra-button" data-toggle="tab"><i class="fa fa-fw fa-sliders"></i> <?php echo $tab_extra_button; ?></a></li>
				<li><a href="#tab-email" data-toggle="tab"><i class="fa fa-fw fa-envelope-o"></i> <?php echo $tab_email; ?></a></li>
				<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-fw fa-question-circle"></i> <?php echo $tab_help; ?></a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tab-general">
					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status;?></label>
							<div class="col-sm-10">
								<select name="product_question_status" id="input-status" class="form-control">
									<?php if ($product_question_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
								<div class="help"><i class="fa fa-fw fa-info-circle"></i> <?php echo $help_status; ?></div>
							</div>
						</div>
					</fieldset>
               <fieldset>
                  <legend class="small text-center"><?php echo $legend_admin_notification; ?></legend>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-admin-notification"><?php echo $entry_admin_notification;?></label>
							<div class="col-sm-10">
								<select name="product_question_admin_notification" id="input-admin-notification" class="form-control">
									<?php if ($product_question_admin_notification) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
								<div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_admin_notification; ?></div>
							</div>
						</div>
						<div class="form-group admin-notification">
							<label class="col-sm-2 control-label" for="input-admin-notification-additional"><?php echo $entry_admin_notification_additional;?></label>
							<div class="col-sm-10">
								<select name="product_question_admin_notification_additional" id="input-admin-notification-additional" class="form-control">
									<?php if ($product_question_admin_notification_additional) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
								<div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_admin_notification_additional; ?></div>
							</div>
						</div>
					</fieldset>
               <fieldset>
                  <legend class="small text-center"><?php echo $legend_answer_language; ?></legend>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-answer-language-type"><?php echo $entry_answer_language_type;?></label>
							<div class="col-sm-10">
								<select name="product_question_answer_language_type" id="input-answer-language-type" class="form-control">
									<?php if ($product_question_answer_language_type == 'custom') { ?>
									<option value="custom" selected="selected"><?php echo $text_custom_language; ?></option>
									<option value="customer-prefered-language"><?php echo $text_customer_prefered_language; ?></option>
									<?php } else { ?>
									<option value="custom"><?php echo $text_custom_language; ?></option>
									<option value="customer-prefered-language" selected="selected"><?php echo $text_customer_prefered_language; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
                  <div class="form-group custom-language">
							<label class="col-sm-2 control-label" for="input-answer-language-id"><?php echo $entry_answer_language_id ;?></label>
							<div class="col-sm-10">
								<select name="product_question_answer_language_id" id="input-answer-language-id" class="form-control">
									<?php foreach($languages as $language) { ?>
                           <?php if ($language['language_id'] == $product_question_answer_language_id) { ?>
                           <option value="<?php echo $language['language_id']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                           <?php } else { ?>
                           <option value="<?php echo $language['language_id']; ?>"><?php echo $language['name']; ?></option>
                           <?php } ?>
                           <?php } ?>
								</select>
							</div>
						</div>
					</fieldset>
               <fieldset class="hidden">
                  <legend class="small text-center"><?php echo $legend_force_multilanguage; ?></legend>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-force-multilanguage"><?php echo $entry_force_multilanguage;?></label>
							<div class="col-sm-10">
								<select name="product_question_force_multilanguage" id="input-force-multilanguage" class="form-control">
									<?php if ($product_question_force_multilanguage) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
								<div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_force_multilanguage; ?></div>
							</div>
						</div>
					</fieldset>
				</div>

				<div class="tab-pane" id="tab-question">
					<div class="tab-content">
                  <fieldset>
                     <legend class="small text-center"><?php echo $legend_tab_name; ?></legend>
                     <div class="form-group required">
                        <label class="col-sm-2 control-label" for=""><?php echo $entry_tab_name; ?></label>
                        <div class="col-sm-10">
                           <?php foreach ($languages as $language) { ?>
                              <div class="input-group">
                                 <span class="input-group-addon input-group-addon-custom"><img src="view/image/flags/<?php echo $language['image']; ?>" /> <?php echo $language['name']; ?></span>
                                 <input name="product_question_tab_name[<?php echo $language['language_id']; ?>][tab_name]" placeholder="<?php echo $entry_tab_name; ?>" id="input-tab-name-<?php echo $language['language_id']; ?>" value="<?php echo isset($product_question_tab_name[$language['language_id']]) ? $product_question_tab_name[$language['language_id']]['tab_name'] : ''; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_tab_name[$language['language_id']])) { ?>
                              <div class="text-danger"><?php echo $error_tab_name[$language['language_id']]; ?></div>
                              <?php } ?>
                              <div class="help extra-space"></div>
                           <?php } ?>
                        </div>
                     </div>
                  </fieldset>
						<fieldset>
							<legend class="small text-center"><?php echo $legend_tab_header_position; ?></legend>
                     <div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-header-format"><?php echo $entry_tab_header_format; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-code"></i></span>
										<textarea name="product_question_tab_header_format" placeholder="<?php echo $entry_tab_header_format; ?>" id="input-tab-header-format" class="form-control"><?php echo $product_question_tab_header_format; ?></textarea>
                              <span class="input-group-addon input-group-act-as-button import-example" data-toggle="tooltip" title="<?php echo $text_import_example; ?>" data-import-key="tab-header-format"><i class="fa fa-download"></i></span>
                           </div>

									<?php if ($error_tab_header_format) { ?>
									<div class="text-danger"><?php echo $error_tab_header_format; ?></div>
									<?php } ?>

                           <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_tab_header_format; ?></div>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-header-position-selector"><?php echo $entry_position_selector; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">$('</span>
										<input type="text" name="product_question_tab_header_position_selector" placeholder="<?php echo $entry_position_selector; ?>" id="input-tab-header-position-selector" value="<?php echo $product_question_tab_header_position_selector; ?>" class="form-control" />
										<span class="input-group-addon">')</span>
									</div>

									<?php if ($error_tab_header_position_selector) { ?>
									<div class="text-danger"><?php echo $error_tab_header_position_selector; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-header-position-function"><?php echo $entry_position_function; ?></label>
								<div class="col-sm-10">
									<select name="product_question_tab_header_position_function" id="input-tab-header-position-function" class="form-control">
										<?php if ($product_question_tab_header_position_function == 'prepend') { ?>
										<option value="prepend" selected="selected"><?php echo $text_prepend; ?></option>
										<?php } else { ?>
										<option value="prepend"><?php echo $text_prepend; ?></option>
										<?php } ?>

										<?php if ($product_question_tab_header_position_function == 'append') { ?>
										<option value="append" selected="selected"><?php echo $text_append; ?></option>
										<?php } else { ?>
										<option value="append"><?php echo $text_append; ?></option>
										<?php } ?>

										<?php if ($product_question_tab_header_position_function == 'before') { ?>
										<option value="before" selected="selected"><?php echo $text_before; ?></option>
										<?php } else { ?>
										<option value="before"><?php echo $text_before; ?></option>
										<?php } ?>

										<?php if ($product_question_tab_header_position_function == 'after') { ?>
										<option value="after" selected="selected"><?php echo $text_after; ?></option>
										<?php } else { ?>
										<option value="after"><?php echo $text_after; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</fieldset>
                  <fieldset>
							<legend class="small text-center"><?php echo $legend_tab_content_position; ?></legend>
                     <div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-content-format"><?php echo $entry_tab_content_format; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-code"></i></span>
										<textarea name="product_question_tab_content_format" placeholder="<?php echo $entry_tab_content_format; ?>" id="input-tab-content-format" class="form-control"><?php echo $product_question_tab_content_format; ?></textarea>
                              <span class="input-group-addon input-group-act-as-button import-example" data-toggle="tooltip" title="<?php echo $text_import_example; ?>" data-import-key="tab-content-format"><i class="fa fa-download"></i></span>
                           </div>

									<?php if ($error_tab_content_format) { ?>
									<div class="text-danger"><?php echo $error_tab_content_format; ?></div>
									<?php } ?>

                           <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_tab_content_format; ?></div>
								</div>
							</div>
                     <div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-content-position-selector"><?php echo $entry_position_selector; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">$('</span>
										<input type="text" name="product_question_tab_content_position_selector" placeholder="<?php echo $entry_position_selector; ?>" id="input-tab-content-position-selector" value="<?php echo $product_question_tab_content_position_selector; ?>" class="form-control" />
										<span class="input-group-addon">')</span>
									</div>

									<?php if ($error_tab_content_position_selector) { ?>
									<div class="text-danger"><?php echo $error_tab_content_position_selector; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-content-position-function"><?php echo $entry_position_function; ?></label>
								<div class="col-sm-10">
									<select name="product_question_tab_content_position_function" id="input-tab-content-position-function" class="form-control">
										<?php if ($product_question_tab_content_position_function == 'prepend') { ?>
										<option value="prepend" selected="selected"><?php echo $text_prepend; ?></option>
										<?php } else { ?>
										<option value="prepend"><?php echo $text_prepend; ?></option>
										<?php } ?>

										<?php if ($product_question_tab_content_position_function == 'append') { ?>
										<option value="append" selected="selected"><?php echo $text_append; ?></option>
										<?php } else { ?>
										<option value="append"><?php echo $text_append; ?></option>
										<?php } ?>

										<?php if ($product_question_tab_content_position_function == 'before') { ?>
										<option value="before" selected="selected"><?php echo $text_before; ?></option>
										<?php } else { ?>
										<option value="before"><?php echo $text_before; ?></option>
										<?php } ?>

										<?php if ($product_question_tab_content_position_function == 'after') { ?>
										<option value="after" selected="selected"><?php echo $text_after; ?></option>
										<?php } else { ?>
										<option value="after"><?php echo $text_after; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</fieldset>
                  <fieldset>
							<legend class="small text-center"><?php echo $legend_tab_question_limit; ?></legend>
                     <div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-question-limit"><?php echo $entry_tab_question_limit; ?></label>
								<div class="col-sm-10">
								   <input type="text" name="product_question_tab_question_limit" placeholder="<?php echo $entry_tab_question_limit; ?>" id="input-tab-question-limit" value="<?php echo $product_question_tab_question_limit; ?>" class="form-control" />

									<?php if ($error_tab_question_limit) { ?>
									<div class="text-danger"><?php echo $error_tab_question_limit; ?></div>
									<?php } ?>
								</div>
							</div>
						</fieldset>
					</div>
				</div>

            <div class="tab-pane" id="tab-extra-button">
					<div class="tab-content">
                  <fieldset>
   						<div class="form-group">
   							<label class="col-sm-2 control-label" for="input-extra-button-status"><?php echo $entry_extra_button_status;?></label>
   							<div class="col-sm-10">
   								<select name="product_question_extra_button_status" id="input-extra-button-status" class="form-control">
   									<?php if ($product_question_extra_button_status) { ?>
   									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
   									<option value="0"><?php echo $text_disabled; ?></option>
   									<?php } else { ?>
   									<option value="1"><?php echo $text_enabled; ?></option>
   									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
   									<?php } ?>
   								</select>

                           <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_extra_button; ?></div>
   							</div>
   						</div>
   					</fieldset>
                  <fieldset class="extra-button">
                     <legend class="small text-center"><?php echo $legend_extra_button_name; ?></legend>
                     <div class="form-group required">
                        <label class="col-sm-2 control-label" for=""><?php echo $entry_extra_button_name; ?></label>
                        <div class="col-sm-10">
                           <?php foreach ($languages as $language) { ?>
                              <div class="input-group">
                                 <span class="input-group-addon input-group-addon-custom"><img src="view/image/flags/<?php echo $language['image']; ?>" /> <?php echo $language['name']; ?></span>
                                 <input name="product_question_extra_button_name[<?php echo $language['language_id']; ?>][extra_button_name]" placeholder="<?php echo $entry_extra_button_name; ?>" id="input-extra-button-name-<?php echo $language['language_id']; ?>" value="<?php echo isset($product_question_extra_button_name[$language['language_id']]) ? $product_question_extra_button_name[$language['language_id']]['extra_button_name'] : ''; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_extra_button_name[$language['language_id']])) { ?>
                              <div class="text-danger"><?php echo $error_extra_button_name[$language['language_id']]; ?></div>
                              <?php } ?>
                              <div class="help extra-space"></div>
                           <?php } ?>
                        </div>
                     </div>
                  </fieldset>
						<fieldset class="extra-button">
							<legend class="small text-center"><?php echo $legend_extra_button_position; ?></legend>
                     <div class="form-group required">
								<label class="col-sm-2 control-label" for="input-extra-button-format"><?php echo $entry_extra_button_format; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-code"></i></span>
										<textarea name="product_question_extra_button_format" placeholder="<?php echo $entry_extra_button_format; ?>" id="input-extra-button-format" class="form-control"><?php echo $product_question_extra_button_format; ?></textarea>
                              <span class="input-group-addon input-group-act-as-button import-example" data-toggle="tooltip" title="<?php echo $text_import_example; ?>" data-import-key="extra-button-format"><i class="fa fa-download"></i></span>
                           </div>

									<?php if ($error_extra_button_format) { ?>
									<div class="text-danger"><?php echo $error_extra_button_format; ?></div>
									<?php } ?>

                           <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_extra_button_format; ?></div>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-tab-header-position-selector"><?php echo $entry_position_selector; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">$('</span>
										<input type="text" name="product_question_extra_button_position_selector" placeholder="<?php echo $entry_position_selector; ?>" id="input-extra-button-position-selector" value="<?php echo $product_question_extra_button_position_selector; ?>" class="form-control" />
										<span class="input-group-addon">')</span>
									</div>

									<?php if ($error_extra_button_position_selector) { ?>
									<div class="text-danger"><?php echo $error_extra_button_position_selector; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-extra-button-position-function"><?php echo $entry_position_function; ?></label>
								<div class="col-sm-10">
									<select name="product_question_extra_button_position_function" id="input-extra-button-position-function" class="form-control">
										<?php if ($product_question_extra_button_position_function == 'prepend') { ?>
										<option value="prepend" selected="selected"><?php echo $text_prepend; ?></option>
										<?php } else { ?>
										<option value="prepend"><?php echo $text_prepend; ?></option>
										<?php } ?>

										<?php if ($product_question_extra_button_position_function == 'append') { ?>
										<option value="append" selected="selected"><?php echo $text_append; ?></option>
										<?php } else { ?>
										<option value="append"><?php echo $text_append; ?></option>
										<?php } ?>

										<?php if ($product_question_extra_button_position_function == 'before') { ?>
										<option value="before" selected="selected"><?php echo $text_before; ?></option>
										<?php } else { ?>
										<option value="before"><?php echo $text_before; ?></option>
										<?php } ?>

										<?php if ($product_question_extra_button_position_function == 'after') { ?>
										<option value="after" selected="selected"><?php echo $text_after; ?></option>
										<?php } else { ?>
										<option value="after"><?php echo $text_after; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-extra-button-behaviour"><?php echo $entry_extra_button_behaviour;?></label>
                        <div class="col-sm-10">
                           <select name="product_question_extra_button_behaviour" id="input-extra-button-status" class="form-control">
                              <?php if ($product_question_extra_button_behaviour == 'open-question-tab') { ?>
                              <option value="open-question-tab" selected="selected"><?php echo $text_open_question_tab; ?></option>
                              <option value="open-question-form"><?php echo $text_open_question_form; ?></option>
                              <?php } else { ?>
                              <option value="open-question-tab"><?php echo $text_open_question_tab; ?></option>
                              <option value="open-question-form" selected="selected"><?php echo $text_open_question_form; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
						</fieldset>
					</div>
				</div>

            <div class="tab-pane" id="tab-email">
					<div class="tab-content">
                  <fieldset class="fieldset-email-admin-notification-enabled">
                     <legend class="small text-center"><?php echo $legend_email_admin_notification; ?></legend>
                     <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-admin-notification-subject"><?php echo $entry_email_subject; ?></label>
                        <div class="col-sm-10">
                           <div class="input-group">
                              <input name="product_question_admin_notification_subject" placeholder="<?php echo $entry_email_subject; ?>" id="input-admin-notification-subject" value="<?php echo $product_question_admin_notification_subject; ?>" class="form-control" />
                              <span class="input-group-addon input-group-act-as-button import-example" data-toggle="tooltip" title="<?php echo $text_import_example; ?>" data-import-key="admin-notification-subject"><i class="fa fa-fw fa-download"></i></span>
                           </div>
                           <?php if ($error_admin_notification_subject) { ?>
                           <div class="text-danger"><?php echo $error_admin_notification_subject; ?></div>
                           <?php } ?>

                           <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_email_admin_notification_subject_keywords; ?></div>
                        </div>
                     </div>
                     <div class="form-group required summernote-with-import">
                        <label class="col-sm-2 control-label" for="input-admin-notification-message"><?php echo $entry_email_message; ?></label>
                        <div class="col-sm-10">
                           <textarea name="product_question_admin_notification_message" placeholder="<?php echo $entry_email_message; ?>" id="input-admin-notification-message" class="form-control summernote"><?php echo $product_question_admin_notification_message; ?></textarea>

                           <div class="import-example-container">
                              <a class="btn btn-default btn-block btn-import-example import-example" data-import-key="admin-notification-message"><i class="fa fa-fw fa-download"></i> <?php echo $text_import_example; ?></a>
                           </div>

                           <?php if ($error_admin_notification_message) { ?>
                           <div class="text-danger"><?php echo $error_admin_notification_message; ?></div>
                           <?php } ?>

                           <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_email_admin_notification_message_keywords; ?></div>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset class="fieldset-email-customer-answer-enabled">
                     <legend class="small text-center"><?php echo $legend_email_customer_answer; ?></legend>

                     <ul class="nav nav-tabs" id="email-languages">
                        <?php foreach ($languages as $language) { ?>
                        <li><a data-toggle="tab" href="#email-language-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php } ?>
                     </ul>

					 <div class="tab-content">
						 <?php foreach ($languages as $language) { ?>
						 <div id="email-language-<?php echo $language['language_id']; ?>" class="tab-pane">
							<div class="form-group required">
							   <label class="col-sm-2 control-label" for="input-customer-answer-subject-<?php echo $language['language_id']; ?>"><?php echo $entry_email_subject; ?></label>
							   <div class="col-sm-10">
								  <div class="input-group">
									 <input name="product_question_mail[<?php echo $language['language_id']; ?>][customer_answer_subject]" placeholder="<?php echo $entry_email_subject; ?>" id="input-customer-answer-subject-<?php echo $language['language_id']; ?>" value="<?php echo isset($product_question_mail[$language['language_id']]) ? $product_question_mail[$language['language_id']]['customer_answer_subject'] : ''; ?>" class="form-control" />
									 <span class="input-group-addon input-group-act-as-button import-example" data-toggle="tooltip" title="<?php echo $text_import_example; ?>" data-import-key="customer-answer-subject" data-language-id="<?php echo $language['language_id']; ?>"><i class="fa fa-fw fa-download"></i></span>
								  </div>
								  <?php if (isset($error_customer_answer_subject[$language['language_id']])) { ?>
								  <div class="text-danger"><?php echo $error_customer_answer_subject[$language['language_id']]; ?></div>
								  <?php } ?>

								  <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_email_customer_answer_subject_keywords; ?></div>
							   </div>
							</div>
							<div class="form-group required summernote-with-import">
							   <label class="col-sm-2 control-label" for="input-customer-answer-message-<?php echo $language['language_id']; ?>"><?php echo $entry_email_message; ?></label>
							   <div class="col-sm-10">
								  <textarea name="product_question_mail[<?php echo $language['language_id']; ?>][customer_answer_message]" placeholder="<?php echo $entry_email_message; ?>" id="input-customer-answer-message-<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($product_question_mail[$language['language_id']]) ? $product_question_mail[$language['language_id']]['customer_answer_message'] : ''; ?></textarea>

								  <div class="import-example-container">
									 <a class="btn btn-default btn-block btn-import-example import-example" data-import-key="customer-answer-message" data-language-id="<?php echo $language['language_id']; ?>"><i class="fa fa-fw fa-download"></i> <?php echo $text_import_example; ?></a>
								  </div>

								  <?php if (isset($error_customer_answer_message[$language['language_id']])) { ?>
								  <div class="text-danger"><?php echo $error_customer_answer_message[$language['language_id']]; ?></div>
								  <?php } ?>

								  <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_email_customer_answer_message_keywords; ?></div>
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
						HELP Guide is available : <a href="http://www.oc-extensions.com/OpenCart-Product-Questions-Answers-FAQ-OpenCart-2.x-Help" target="blank">HERE</a><br /><br />
						If you need support, email us at <strong>support@oc-extensions.com</strong>
					</div>
				</div>
			</div>
		</form>
    </div>
  </div>

<script type="text/javascript"><!--
$('#input-admin-notification-message').summernote({height: 300});

<?php foreach ($languages as $language) { ?>
$('#input-customer-answer-message-<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
$('select[name=\'product_question_admin_notification\']').on('change', function(){
   $('.admin-notification').hide();
   $('.fieldset-email-admin-notification-enabled').hide();

   if ($(this).val() == 1) {
      $('.admin-notification').show();
      $('.fieldset-email-admin-notification-enabled').show();
   }
});

$('select[name=\'product_question_admin_notification\']').trigger('change');

$('.import-example').on('click', function(){
   var import_key = $(this).attr('data-import-key');
   var language_id = typeof($(this).attr('data-language-id')) != 'undefined' ? $(this).attr('data-language-id') : false;
   var target_selector = '#input-' + import_key;

   if (language_id) {
      target_selector += '-' + language_id;
   }

   $.ajax({
      url: 'index.php?route=module/product_question/import&token=<?php echo $token; ?>',
      data: 'import_key=' + import_key,
      dataType: 'json',
      success: function(json) {
         if (json['target_type'] == 'input') {
            $(target_selector).val(json['template']);
         }

         if (json['target_type'] == 'textarea') {
            $(target_selector).val(json['template']);
         }

         if (json['target_type'] == 'summernote') {
            //$(target_selector).summernote('code', json['template']); in new summernote
            $(target_selector).code( json['template']);
         }
      }
   })
});

$('select[name=\'product_question_answer_language_type\']').on('change', function(){
   $('.custom-language').hide();

   if ($(this).val() == 'custom') {
      $('.custom-language').show();
   }
});

$('select[name=\'product_question_answer_language_type\']').trigger('change');

$('select[name=\'product_question_extra_button_status\']').on('change', function(){
   $('.extra-button').hide();

   if ($(this).val() == 1) {
      $('.extra-button').show();
   }
});

$('select[name=\'product_question_extra_button_status\']').trigger('change');

$('#email-languages li:first-child a').tab('show');
//--></script>
</div>
<?php echo $footer; ?>

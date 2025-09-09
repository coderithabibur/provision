<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-question" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-question" class="form-horizontal">
          <?php if ($original_question_description) { ?>
          <div class="form-group">
             <label class="col-sm-2 control-label" for=""><i class="fa fa-2x fa-comments-o"></i></label>
             <div class="col-sm-10">
                 <blockquote class="blockquote-question">
                    <div class="question-description"><?php echo $original_question_description; ?></div>
                    <div class="sender-info sender-info-bottom">
                       <span class="question-dash"></span>
                       <span class="sender-name"><?php echo $customer_name; ?>,</span>
                       <span class="sender-email"><?php echo $customer_email; ?></span>
                    </div>
                  </blockquote>
             </div>
          </div>
          <hr />
          <?php } ?>

           <ul class="nav nav-tabs" id="language">
            <?php foreach ($languages as $language) { ?>
            <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
            <?php } ?>
           </ul>

           <div class="tab-content">
            <?php foreach ($languages as $language) { ?>
            <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
               <div class="form-group required">
                 <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                 <div class="col-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" /></span>
                       <input type="text" name="question_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($question_description[$language['language_id']]) ? $question_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                    <?php if (isset($error_title[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                    <?php } ?>

                    <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_title; ?></div>
                 </div>
               </div>
               <div class="form-group form-group-import-answer required">
                 <label class="col-sm-2 control-label" for="input-answer<?php echo $language['language_id']; ?>"><?php echo $entry_answer; ?></label>
                 <div class="col-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" /></span>
                       <textarea name="question_description[<?php echo $language['language_id']; ?>][answer]" rows="8" placeholder="<?php echo $entry_answer; ?>" id="input-answer<?php echo $language['language_id']; ?>" class="form-control summernote square-textarea"><?php echo isset($question_description[$language['language_id']]) ? $question_description[$language['language_id']]['answer'] : ''; ?></textarea>
                     </div>
                     <?php if ($import_answer) { ?>
                     <div class="import-answer-container">
                        <a class="btn btn-default btn-block btn-import-answer import-answer" data-question-id="<?php echo $question_id; ?>" data-language-id="<?php echo $language['language_id']; ?>"><i class="fa fa-fw fa-download"></i> <?php echo $text_import_answer; ?></a>
                     </div>

                     <div id="import-result-notification-<?php echo $language['language_id']; ?>"></div>
                     <?php } ?>

                     <?php if (isset($error_answer[$language['language_id']])) { ?>
                     <div class="text-danger"><?php echo $error_answer[$language['language_id']]; ?></div>
                     <?php } ?>

                     <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_answer; ?></div>
                 </div>
               </div>
            </div>
            <?php } ?>
           </div>

           <hr />

           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-general"><?php echo $entry_general; ?></label>
            <div class="col-sm-10">
              <select name="general" id="input-general" class="form-control">
                <?php if ($general) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select>

              <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_general; ?></div>
            </div>
          </div>
          <div class="form-group question-to-products">
            <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
            <div class="col-sm-10">
              <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
              <div id="question-product" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($question_products as $question_product) { ?>
                <div id="question-product<?php echo $question_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $question_product['name'] . ' - ' . $question_product['model']; ?>
                  <input type="hidden" name="question_product[]" value="<?php echo $question_product['product_id']; ?>" />
                </div>
                <?php } ?>
              </div>
              <?php if ($error_product) { ?>
              <div class="text-danger"><?php echo $error_product; ?></div>
              <?php } ?>

              <div class="bs-callout bs-callout-info"><i class="fa fa-fw fa-lightbulb-o"></i> <?php echo $help_more_products; ?></div>
            </div>
          </div>
          <div class="form-group">
           <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
           <div class="col-sm-10">
             <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
           </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-answer<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
//--></script>  
<script type="text/javascript"><!--
$('select[name=\'general\']').on('change', function(){
   $('.question-to-products').hide();

   if ($(this).val() == 0) {
      $('.question-to-products').show();
   }
});

$('select[name=\'general\']').trigger('change');

$('.import-answer').on('click', function() {
   var question_id = $(this).attr('data-question-id');
   var language_id = $(this).attr('data-language-id');

   if (question_id) {
      $.ajax({
         url: 'index.php?route=catalog/question/importReply&token=<?php echo $token; ?>',
         data: 'question_id=' + question_id + '&language_id=' + language_id,
         dataType: 'json',
         success: function(json) {
            if (json['error']) {
               $('#import-result-notification-' + language_id).html('<div class="alert alert-warning">' + json['error'] + '</div>');

               setTimeout(function () {
                  $('#import-result-notification-' + language_id + ' .alert').remove();
               }, 3000);
            }

            if (json['success']) {
               $('#input-answer' + language_id).summernote('code', json['reply_message']);
            }
         }
      });
   }
});

$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'] + ' - ' + item['model'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	select: function(item) {
		$('input[name=\'product\']').val('');

		$('#question-product' + item['value']).remove();

		$('#question-product').append('<div id="question-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="question_product[]" value="' + item['value'] + '" /></div>');
	}
});

$('#question-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>

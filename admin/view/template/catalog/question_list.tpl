<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-question').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
          <div class="row">
            <div class="col-sm-3">
               <div class="form-group">
                <label class="control-label" for="input-title"><?php echo $entry_title; ?></label>
                <input type="text" name="filter_title" value="<?php echo $filter_title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                <input type="text" name="filter_product" value="<?php echo $filter_product; ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-view"><?php echo $entry_view; ?></label>
                <select name="filter_view" id="input-view" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_view) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!$filter_view && !is_null($filter_view)) { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-reply"><?php echo $entry_reply; ?></label>
                <select name="filter_reply" id="input-reply" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_reply) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!$filter_reply && !is_null($filter_reply)) { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_general; ?></label>
                <select name="filter_general" id="input-general" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_general) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!$filter_general && !is_null($filter_general)) { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_modified; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>" placeholder="<?php echo $entry_date_modified; ?>" data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-question">
          <div class="table-responsive">
            <table class="table table-hover table-question-list">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td style="width: 1px;"></td>
                  <td class="text-left"><?php echo $column_title; ?></td>
                  <td class="text-center"><?php if ($sort == 'q.general') { ?>
                    <a href="<?php echo $sort_general; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_general; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_general; ?>"><?php echo $column_general; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'q.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'q.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($questions) { ?>
                <?php foreach ($questions as $question) { ?>
                <tr class="<?php echo $question['view'] ? '' : 'question-new'; ?>" id="row-question-<?php echo $question['question_id']; ?>">
                  <td class="text-center"><?php if (in_array($question['question_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $question['question_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $question['question_id']; ?>" />
                    <?php } ?>
                  </td>
                  <td class="question-action-status">
                     <?php if ($question['reply']) { ?>
                     <i class="fa fa-reply question-reply-status-sent"></i>
                     <?php } elseif (!$question['view']) { ?>
                     <i class="fa fa-circle question-view-status-new"></i>
                     <?php } ?>
                  </td>
                  <?php if ($question['answer']) { ?>
                  <td class="text-left" data-toggle="question-tooltip" data-html="true" title="<?php echo $question['tooltip']; ?>"><?php echo $question['title']; ?></td>
                  <?php } else { ?>
                  <td class="text-left" data-toggle="question-tooltip" data-html="true" title="<?php echo $question['tooltip']; ?><hr /><?php echo $question['customer_details']; ?>"><?php echo $question['title']; ?></td>
                  <?php } ?>
                  <td class="text-center"><?php echo $question['general']; ?></td>
                  <td class="text-center"><?php echo $question['status']; ?></td>
                  <td class="text-center"><?php echo $question['date_added']; ?></td>
                  <td class="text-right">
                     <?php if ($question['internal']) { ?>
                     <a href="javascript:void(0);" data-toggle="tooltip" data-html="true" title="<?php echo $help_internal; ?>" class="btn btn-default"><i class="fa fa-info-circle"></i></a>
                     <?php } else { ?>
                     <a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $button_reply; ?>" class="btn btn-success button-start-reply" data-question-id="<?php echo $question['question_id']; ?>"><i class="fa fa-paper-plane-o"></i></a>
                     <?php } ?>
                     <a href="<?php echo $question['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
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
<script type="text/javascript"><!--
$('[data-toggle=\'question-tooltip\']').tooltip({container: 'body', html: true, template: '<div class="tooltip question-tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});

$('.button-start-reply').on('click', function(){
   var question_id = $(this).attr('data-question-id');

   // if no readed yet - mark as read
   if ($('#row-question-' + question_id).hasClass('question-new')) {
      $('#row-question-' + question_id).removeClass('question-new');
      $('#row-question-' + question_id + ' .question-action-status i.fa').remove();
   }

   $.ajax({
      url: 'index.php?route=catalog/question/reply&token=<?php echo $token; ?>',
      type: 'GET',
      data: 'question_id=' + question_id,
      dataType: 'json',
      success: function(json) {
         $('#question-reply-modal').remove();
			$('body').prepend(json['output']);

			$('#question-reply-modal').modal('show');

         // update unread status from column left menu
         getProductQuestionUnreadStats();
      }
   });
});

$('#button-filter').on('click', function() {
	url = 'index.php?route=catalog/question&token=<?php echo $token; ?>';

   var filter_title = $('input[name=\'filter_title\']').val();

	if (filter_title) {
		url += '&filter_title=' + encodeURIComponent(filter_title);
	}

   var filter_product = $('input[name=\'filter_product\']').val();

	if (filter_product) {
		url += '&filter_product=' + encodeURIComponent(filter_product);
	}

   var filter_view = $('select[name=\'filter_view\']').val();

	if (filter_view != '*') {
		url += '&filter_view=' + encodeURIComponent(filter_view);
	}

   var filter_reply = $('select[name=\'filter_reply\']').val();

	if (filter_reply != '*') {
		url += '&filter_reply=' + encodeURIComponent(filter_reply);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

   var filter_general = $('select[name=\'filter_general\']').val();

	if (filter_general != '*') {
		url += '&filter_general=' + encodeURIComponent(filter_general);
	}

	var filter_date_added = $('input[name=\'filter_date_added\']').val();

	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}

   var filter_date_modified = $('input[name=\'filter_date_modified\']').val();

	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}

	location = url;
});

$('input[name=\'filter_product\']').autocomplete({
 'source': function(request, response) {
    $.ajax({
       url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
       dataType: 'json',
       success: function(json) {
          response($.map(json, function(item) {
             return {
                label: item['name'],
                value: item['product_id']
             }
          }));
       }
    });
 },
 'select': function(item) {
    $('input[name=\'filter_product\']').val(item['label']);
 }
});

$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<?php echo $footer; ?>

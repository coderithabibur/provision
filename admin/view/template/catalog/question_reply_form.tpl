<div id="question-reply-modal" class="modal modal-ocx fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-uppercase"><?php echo $heading_title; ?></h4>
      </div>
      <div class="modal-body">
			<div class="form-horizontal">
            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
            <div class="form-group">
                 <div class="col-sm-12">
                     <blockquote class="blockquote-question">
                        <div class="sender-info sender-info-top">
                           <span class="sender-name"><?php echo $customer_name; ?>,</span>
                           <span class="sender-email"><?php echo $customer_email; ?></span>
                           <span class="question-dash"></span>
                           <?php if ($general) { ?>
                           <span class="label label-info"><?php echo $text_general_question; ?></span>
                           <?php } elseif ($multiple_products) { ?>
                           <span class="multiple-products"><?php echo $text_question_about; ?> <span class="multiple-products-list" data-toggle="tooltip" data-html="true" title="<?php echo $products_list; ?>"><?php echo $text_multiple_products; ?></span></span>
                           <?php } elseif (!$multiple_products) { ?>
                           <span class="about-product"><?php echo $text_question_about; ?> <a href="<?php echo $product_url; ?>" target="_blank" class="about-product-url"><?php echo $product_name; ?></a></span>
                           <?php } ?>
                        </div>
                        <div class="question-description"><?php echo $question; ?></div>
                     </blockquote>
                 </div>
            </div>
            <?php if ($related_product_replies) { ?>
            <div class="form-group predefined-answers">
				  <div class="col-sm-12">
					<label class="control-label" for="input-predefined-answer"><?php echo $entry_choose_answer; ?></label>
               <select name="predefined_replies" data-placeholder="<?php echo $entry_choose_answer; ?>" class="chosen-select" tabindex="0">
                  <option value="0"><?php echo $text_select; ?></option>
                  <?php foreach($related_product_replies as $reply) { ?>
                  <option value="<?php echo $reply['question_reply_id']; ?>"><?php echo $reply['description']; ?></option>
                  <?php } ?>
               </select>
				  </div>
				</div>
            <?php } ?>
				<div class="form-group required">
				  <div class="col-sm-12">
               <div class="double-label">
                  <div class="pull-left">
   					   <label class="control-label" for="input-answer"><?php echo $entry_answer; ?></label>
                  </div>
                  <div class="pull-right">
                     <?php if ($related_product_replies) { ?>
                     <a class="button-import-answer" href="javascript:void(0)" id="button-import-answer"><i class="fa fa-download"></i> <?php echo $button_import_answer; ?></a>
                     <?php } ?>
                  </div>
               </div>
					<textarea name="answer" rows="5" id="input-answer" class="form-control"></textarea>
				  </div>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <a id="button-send-reply" class="button-send-answer"><?php echo $button_send_answer; ?></a>
      </div>

		<div class="loading-mask-overlay">
			<div class="loading-mask-loading">
				<div class='uil-ripple-css'><div></div><div></div></div>
			</div>
		</div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
   $('.chosen-select').chosen();
});

$('#button-import-answer').on('click', function() {
   if ($('.predefined-answers').is(':visible')) {
      $('.predefined-answers').hide();
   } else {
      $('.predefined-answers').show();
   }
});

$('select[name=\'predefined_replies\']').on('change', function() {
   var reply_id = $(this).val();

   if (reply_id) {
      $.ajax({
         url: 'index.php?route=catalog/question/getPredefinedReply&token=<?php echo $token; ?>',
         data: 'reply_id=' + reply_id,
         dataType: 'json',
         success: function(json) {
            if (json['success']) {
               $('#question-reply-modal textarea[name=\'answer\']').val(json['reply_message']);
            }
         }
      });
   }
});

$('#button-send-reply').on('click', function() {
   var question_id = $('#question-reply-modal .modal-body input[name=\'question_id\']').val();
   var answer      = $('#question-reply-modal .modal-body textarea[name=\'answer\']').val();

	$.ajax({
		url: 'index.php?route=catalog/question/reply&token=<?php echo $token; ?>',
		type: 'POST',
		dataType: 'json',
		data: 'question_id=' + encodeURIComponent(question_id) + '&answer=' + encodeURIComponent(answer),
		beforeSend: function() {
			$('#question-reply-modal .loading-mask-overlay').show();
		},
		complete: function() {
			$('#question-reply-modal .loading-mask-overlay').hide();
		},
		success: function(json) {
			$('#question-reply-modal .alert').remove();

			if (json['error']) {
				$('#question-reply-modal .modal-body').prepend('<div class="alert alert-danger"><i class="fa fa-fw fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#question-reply-modal .modal-body').prepend('<div class="alert alert-success"><i class="fa fa-fw fa-check-circle"></i> ' + json['success'] + '</div>');
				$('#question-reply-modal .modal-body textarea[name=\'answer\']').val('');

            // remove old status icons
            $('#row-question-' + question_id + ' .question-action-status i.fa').remove();

            // add reply status icon
            $('#row-question-' + question_id + ' .question-action-status').prepend('<i class="fa fa-reply question-reply-status-sent"></i>');

				setTimeout(function () {
				   $('#question-reply-modal').modal('hide');
				}, 3000);
			}
		}
	});
});
//--></script>

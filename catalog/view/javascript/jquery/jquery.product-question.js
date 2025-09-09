/* Sorry for Long variable/function name | To avoid any conflicts with other js scripts & functions */

// CHECK ON PAGE LOAD
$(document).ready(function(){
	checkProductQuestionTab();
});

// FUNCTIONS --------------------------------------------------------------------
function checkProductQuestionTab() {
	$.ajax({
		url: 'index.php?route=module/product_question/check',
		dataType: 'json',
		success: function(json) {
			if (json['success']) {
				addProductQuestionSection('tab_header', json);
				addProductQuestionSection('tab_content', json);

				if (json['extra_button_status']) {
					addProductQuestionSection('extra_button', json);
					addExtraButtonBehaviourClass(json['extra_button_behaviour']);
				}

				loadProductQuestions(json['product_id']);
			}
		}
	});
}


function addProductQuestionSection(section, settings) {
	var template = settings[section + '_format'];
	var position_selector = settings[section + '_position_selector'];
	var position_function = settings[section + '_position_function'];

	if (position_function == 'prepend') {
		$(position_selector).prepend(template);
	}

	if (position_function == 'append') {
		$(position_selector).append(template);
	}

	if (position_function == 'before') {
		$(position_selector).before(template);
	}

	if (position_function == 'after') {
		$(position_selector).after(template);
	}
}

function addExtraButtonBehaviourClass(behaviour_class) {
	$('.product-question-extra-button').addClass(behaviour_class);
}

function loadProductQuestions(product_id) {
	$('#product-question-list').load('index.php?route=module/product_question/getQuestions&product_id=' + product_id);
}

function productQuestionLoadMore(url) {
	$.ajax({
		url: url,
		beforeSend: function() {
			$('#product-question-list .product-question-load-more-container .loading-mask-overlay').show();
		},
		complete: function() {
			$('#product-question-list .product-question-load-more-container .loading-mask-overlay').hide();
		},
		success: function(html) {
			$('#product-question-list .product-question-load-more-container').remove();

			$('#product-question-list .faq-item:last-child').after(html);
		}
	});
}

$(document).delegate('.product-question-extra-button', 'click', function(){
	$('a[href=\'#tab-questions\']').trigger('click');

	if ($(this).hasClass('open-question-form')) {
		if (!$('#section-product-question-form').is(':visible')) {
			$('#button-ask-product-question').trigger('click');
		}
	}

	var scroll_stop_before = 100;

	$('html, body').animate({scrollTop: $('#tab-questions').offset().top - scroll_stop_before}, 1000);
});

$(document).delegate('.faq-item .faq-question', 'click', function(){
	if ($(this).parent().hasClass('active')) {
		$(this).parent().removeClass('active');
	} else {
		$(this).parent().addClass('active');
	}
});

$(document).delegate('#button-ask-product-question', 'click', function(){
	if ($('#section-product-question-form').is(':visible')) {
		$('#product-question-list').show();
		$('#section-product-question-form').hide();
	} else {
		$('#product-question-list').hide();
		$('#section-product-question-form').show();
	}
});

$(document).delegate('#button-send-product-question', 'click', function() {
	$.ajax({
		url: 'index.php?route=module/product_question/sendQuestion',
		type: 'POST',
		dataType: 'json',
		data: $("#form-product-question").serialize(),
		beforeSend: function() {
			$('#section-product-question-form .loading-mask-overlay').show();
		},
		complete: function() {
			$('#section-product-question-form .loading-mask-overlay').hide();
		},
		success: function(json) {
			$('#section-product-question-form .alert').remove();

			if (json['error']) {
				$('#section-product-question-form .form-horizontal').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#section-product-question-form .form-horizontal').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				//$('#section-product-question-form input[name=\'name\']').val('');
				//$('#section-product-question-form input[name=\'email\']').val('');
				$('#section-product-question-form textarea[name=\'question\']').val('');

				setTimeout(function () {
				   $('#section-product-question-form .alert').remove();
				   $('#section-product-question-form').fadeOut(500);
				   $('#product-question-list').show();
			   }, 5000);
			}
		}
	});
});

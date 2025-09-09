$(document).ready(function() {
   getProductQuestionUnreadStats();
});

function getProductQuestionUnreadStats() {
   $.ajax({
		url: 'index.php?route=module/product_question/getTotalUnread&token=' + getURLVar('token'),
		dataType: 'json',
		success: function(json) {
         $('#menu-product-question .product-question-stats-unread').remove();

         if (json['total_unread'] > 0) {
            $('#menu-product-question a.parent').prepend('<span class="product-question-stats-unread animated bounce">' + json['total_unread'] + '</span>');
         }
		}
	});
}

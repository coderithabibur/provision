//==============================================================================
// Braintree Payment Gateway v303.6
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
// 
// All code within this file is copyright Clear Thinking, LLC.
// You may not copy or reuse code within this file without written permission.
//==============================================================================

function getQueryVariable(variable) {
	var vars = window.location.search.substring(1).split('&');
	for (i = 0; i < vars.length; i++) {
		var pair = vars[i].split('=');
		if (pair[0] == variable) return pair[1];
	}
	return false;
}

function braintreeSubmit(element, charge_amount, charge_id) {
	var token = getQueryVariable('token');
	token = (token) ? '&token=' + token : '&user_token=' + getQueryVariable('user_token');
	
	amount = prompt('Enter the amount to submit:', charge_amount.toFixed(2));
	
	if (amount != null && amount > 0) {
		element.after('<span id="please-wait" style="font-size: 11px"> Please wait...</span>');
		$.get('index.php?route=extension/payment/braintree/submit&charge_id=' + charge_id + '&amount=' + amount + token,
			function(error) {
				$('#please-wait').remove();
				if (error) {
					alert(error);
				} else {
					element.prev().html('Yes (' + parseFloat(amount).toFixed(2) + ' submitted)');
					element.remove();
				}
			}
		);
	}
}

function braintreeRefund(element, charge_amount, charge_id) {
	var token = getQueryVariable('token');
	token = (token) ? '&token=' + token : '&user_token=' + getQueryVariable('user_token');
	
	amount = prompt('Enter the amount to refund.' + "\n\n" + 'Note that payments made in the last 24 hours cannot be partially refunded, since they must be marked as "voided" in Braintree. Refunding these within 24 hours will always refund the entire payment, no matter what amount you enter.', charge_amount.toFixed(2));
	
	if (amount != null && amount > 0) {
		element.after('<span id="please-wait" style="font-size: 11px"> Please wait...</span>');
		$.get('index.php?route=extension/payment/braintree/refund&amount=' + amount + '&charge_id=' + charge_id + token,
			function(error) {
				$('#please-wait').remove();
				if (error) {
					alert(error);
				} else {
					alert('Success!');
					$('#history').load('index.php?route=sale/order/history&order_id=' + getQueryVariable('order_id') + token);
				}
			}
		);
	}
}
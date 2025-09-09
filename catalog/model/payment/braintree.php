<?php
//==============================================================================
// Braintree Payment Gateway v3
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
// 
// All code within this file is copyright Clear Thinking, LLC.
// You may not copy or reuse code within this file without written permission.
//==============================================================================

class ModelPaymentBraintree extends Model {		
	private $type = 'payment';
	private $name = 'braintree';
	
	public function recurringPayments() {
		return true;
	}
	
	public function getMethod($address, $total = 0) {
		$this->load->model('extension/' . $this->type . '/' . $this->name);
		return $this->{'model_extension_' . $this->type . '_'. $this->name}->getMethod($address, $total);
	}
}
?>
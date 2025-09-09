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

class ControllerPaymentBraintree extends Controller {
	private $type = 'payment';
	private $name = 'braintree';
	
	public function index() {
		return $this->load->controller('extension/' . $this->type . '/' . $this->name);
	}
}
?>
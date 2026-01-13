<?php
//==============================================================================
// Stripe Payment Gateway Pro v2
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
// 
// All code within this file is copyright Clear Thinking, LLC.
// You may not copy or reuse code within this file without written permission.
//==============================================================================

class ControllerPaymentStripe extends Controller { 
	private $type = 'payment';
	private $name = 'stripe';
	
	public function index() {
		$this->response->redirect(str_replace('&amp;', '&', $this->url->link('extension/' . $this->type . '/' . $this->name, 'token=' . $this->session->data['token'], 'SSL')));
	}
}
?>
<?php
class ControllerExtensionbganycombi extends Controller {
	public function getcache() {
		$this->load->model('extension/bganycombi');
		$json['prodlist'] = $this->model_extension_bganycombi->getcachedata();
 		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json,true));	
	}
}
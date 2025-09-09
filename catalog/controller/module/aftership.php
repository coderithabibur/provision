<?php
class ControllerModuleAfterShip extends Controller {
	public function index() {
		
	} 
	
	public function getTrackingInfo() {
		$this->load->language('module/aftership');
		$this->load->model('module/aftership');

		$json = array();
		
		$order_id = (isset($this->request->post['order_id'])) ? $this->request->post['order_id'] : 0;
		
		$tracking_info = $this->model_module_aftership->getTrackingInfo($order_id);
		
		if ($tracking_info) {
			$data['text_tracking_number'] = $this->language->get('text_tracking_number');
			$data['button_track'] = $this->language->get('button_track');
		
			$data['order_id'] = $order_id;
			$data['courier_name'] = $tracking_info['name'];
			$data['courier_phone'] = $tracking_info['phone'];
			$data['courier_website'] = $tracking_info['website'];
			$data['courier_logo'] = $this->getCourierLogo($tracking_info['slug']);
			$data['tracking_number'] = $tracking_info['tracking_number'];
			$data['tracking_url'] = $this->getTrackingURL($tracking_info['tracking_number']);
			
			$json['success'] = true;

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/aftership_tracking_info.tpl')) {
				$json['output'] = $this->load->view($this->config->get('config_template') . '/template/module/aftership_tracking_info.tpl', $data);
			} else {
				$json['output'] = $this->load->view('default/template/module/aftership_tracking_info.tpl', $data);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	private function getTrackingURL($tracking_number) {
		return 'https://' . $this->config->get('aftership_username') . '.aftership.com/' . $tracking_number;
	}	
	
	private function getCourierLogo($slug) {
		return 'https://assets.aftership.com/couriers/svg/' . $slug . '.svg';
	}
}
?>
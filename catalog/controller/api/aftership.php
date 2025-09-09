<?php
class ControllerApiAfterShip extends Controller {
	public function tracking() {
		$this->load->language('api/aftership');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			
			$order_id        = isset($this->request->post['order_id']) ? $this->request->post['order_id'] : 0;
			$order_status_id = isset($this->request->post['order_status_id']) ? $this->request->post['order_status_id'] : 0;
			$courier_id      = (isset($this->request->post['courier_id']) && !empty($this->request->post['courier_id'])) ? $this->request->post['courier_id'] : 0;
			$tracking_number = isset($this->request->post['tracking_number']) ? $this->request->post['tracking_number'] : '';
			
			if ($this->config->get('aftership_status')) {
				if (in_array($order_status_id, $this->config->get('aftership_order_statuses'))) {
					if ($courier_id && !empty($tracking_number)) {	
						
						$this->load->model('checkout/order');
						$this->load->model('module/aftership');
						
						$order_info = $this->model_checkout_order->getOrder($order_id);
						
						if ($order_info) {
							if ($order_info['courier_id'] != $courier_id || $order_info['tracking_number'] != $tracking_number) {
								
								$aftership_tracking_info = array(
									'slug'                         => $this->model_module_aftership->getCourierSlug($courier_id),
									'tracking_number'              => $tracking_number,
									'title'                        => '#' . $order_id,
									'order_id'		  	           => '#' . $order_id,
									'customer_name'                => $order_info['firstname'] . ' ' . $order_info['lastname'], 
									'smses'                        => array($order_info['telephone']),
									'emails'                       => array($order_info['email']),
									'tracking_postal_code'         => $order_info['shipping_postcode'],  // required by deutsch post
									'tracking_ship_date'   	       => date('Ymd'),                       // required by deutsch post
									'tracking_account_number' 	   => '',                                // required by dinamic logistics
									'tracking_destination_country' => $order_info['shipping_country']
									//'destination_country_iso3'     => $order_info['shipping_iso_code_3']
								);
								
								try {
									$aftership_tracking = new AfterShip\Trackings($this->config->get('aftership_api_key'));
								
									$aftership_response = $aftership_tracking->create($tracking_number, $aftership_tracking_info);
								
								} catch(Exception $e) {
									$json['error'] = sprintf($this->language->get('error_tracking'), $e->getMessage());
								}
								
								// after ship ok => update courier + tracking number in order
								if (!isset($json['error'])) {
									$this->model_module_aftership->editTrackingInfo($order_id, $courier_id, $tracking_number);
								}	
							}
						}	
					}
				}
			}
		}

		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}

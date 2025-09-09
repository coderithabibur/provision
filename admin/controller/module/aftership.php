<?php
class ControllerModuleAfterShip extends Controller {
	private $error = array(); 
	private $version = '1.2';
	private $affiliate_url = 'https://secure.aftership.com/?ref=bkldbe4EEZ';
	
	public function install() {
		$this->load->model('module/aftership');
		$this->model_module_aftership->createTables();
	}
	
	public function uninstall(){		
	}
	
	public function index() {   
		$this->load->language('module/aftership');

		$this->document->setTitle($this->language->get('heading_title'));
		
		// check if new version is available
		$this->document->addScript('https://www.oc-extensions.com/catalog/view/javascript/api/js/update.min.js?extension_version=' . $this->version . '&oc_version=' . VERSION . '&email=' . $this->config->get('config_email'));								
		
		$this->document->addStyle('view/stylesheet/aftership.css');
		
		$this->load->model('module/aftership');
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('aftership', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;
		
		$data['tab_setting']       = $this->language->get('tab_setting');
		$data['tab_courier']       = $this->language->get('tab_courier');
		$data['tab_order_comment'] = $this->language->get('tab_order_comment');
		$data['tab_help']          = $this->language->get('tab_help');
		
		$data['legend_aftership_account'] = $this->language->get('legend_aftership_account');
		$data['legend_order_statuses']    = $this->language->get('legend_order_statuses');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled']  = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_api_key'] = $this->language->get('entry_api_key');
		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_comment_auto'] = $this->language->get('entry_comment_auto');
		$data['entry_comment_template'] = $this->language->get('entry_comment_template');
		
		$data['help_register'] = $this->language->get('help_register');
		$data['help_api_key'] = $this->language->get('help_api_key');
		$data['help_username'] = $this->language->get('help_username');
		$data['help_order_status'] = $this->language->get('help_order_status');
		$data['help_courier_info'] = $this->language->get('help_courier_info');
		$data['help_keywords'] = $this->language->get('help_keywords');
		$data['help_comment_auto'] = $this->language->get('help_comment_auto');
		$data['help_comment'] = $this->language->get('help_comment');
		
		$data['button_register'] = $this->language->get('button_register');
		$data['button_syncronize'] = $this->language->get('button_syncronize');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['api_key'])) {
			$data['error_api_key'] = $this->error['api_key'];
		} else {
			$data['error_api_key'] = '';
		}	

		if (isset($this->error['username'])) {
			$data['error_username'] = $this->error['username'];
		} else {
			$data['error_username'] = '';
		}		
		
 		if (isset($this->error['order_statuses'])) {
			$data['error_order_statuses'] = $this->error['order_statuses'];
		} else {
			$data['error_order_statuses'] = '';
		}		
		
 		if (isset($this->error['comment'])) {
			$data['error_order_comment'] = $this->error['comment'];
		} else {
			$data['error_order_comment'] = array();
		}			
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/aftership', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		$data['action'] = $this->url->link('module/aftership', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['affiliate_url'] = $this->affiliate_url;
		
		$this->update_check();		
		
		if (isset($this->request->post['aftership_status'])){
			$data['aftership_status'] = $this->request->post['aftership_status'];
		} elseif ( $this->config->get('aftership_status')){
			$data['aftership_status'] = $this->config->get('aftership_status');
		} else {
			$data['aftership_status'] = '';
		}
		
		if (isset($this->request->post['aftership_api_key'])){
			$data['aftership_api_key'] = $this->request->post['aftership_api_key'];
		} elseif ( $this->config->get('aftership_api_key')){
			$data['aftership_api_key'] = $this->config->get('aftership_api_key');
		} else {
			$data['aftership_api_key'] = '';
		}

		if (isset($this->request->post['aftership_username'])){
			$data['aftership_username'] = $this->request->post['aftership_username'];
		} elseif ( $this->config->get('aftership_username')){
			$data['aftership_username'] = $this->config->get('aftership_username');
		} else {
			$data['aftership_username'] = '';
		}		
		
		if (isset($this->request->post['aftership_order_statuses'])){
			$data['aftership_order_statuses'] = $this->request->post['aftership_order_statuses'];
		} elseif ( $this->config->get('aftership_order_statuses')){
			$data['aftership_order_statuses'] = $this->config->get('aftership_order_statuses');
		} else {
			$data['aftership_order_statuses'] = array();
		}
		
		if (isset($this->request->post['aftership_comment_auto'])){
			$data['aftership_comment_auto'] = $this->request->post['aftership_comment_auto'];
		} elseif ( $this->config->get('aftership_comment_auto')){
			$data['aftership_comment_auto'] = $this->config->get('aftership_comment_auto');
		} else {
			$data['aftership_comment_auto'] = '';
		}		
		
		if (isset($this->request->post['aftership_comment'])){
			$data['aftership_comment'] = $this->request->post['aftership_comment'];
		} elseif ( $this->config->get('aftership_comment')){
			$data['aftership_comment'] = $this->config->get('aftership_comment');
		} else {
			$data['aftership_comment'] = array();
		}
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();		
		
		$data['token'] = $this->session->data['token'];
						
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/aftership.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/aftership')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (utf8_strlen($this->request->post['aftership_api_key']) < 20) {
			$this->error['api_key'] = $this->language->get('error_api_key');
		}
		
		if (!$this->request->post['aftership_username']) {
			$this->error['username'] = $this->language->get('error_username');
		}
		
		if (!isset($this->request->post['aftership_order_statuses'])) {
			$this->error['order_statuses'] = $this->language->get('error_order_statuses');
		}		

		if ($this->request->post['aftership_comment_auto']) {
			foreach ($this->request->post['aftership_comment'] as $language_id => $value) {
				if (utf8_strlen($value['description']) < 1) {
					$this->error['comment'][$language_id] = $this->language->get('error_order_comment');
				}
			}
		}	

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}	
				
		return !$this->error;	
	}
	
	public function syncronizeCouriers() {
		$this->load->language('module/aftership');
		
		$this->load->model('module/aftership');
		
		$json = array();
		
		if (isset($this->request->post['api_key'])) {
			try {
				$aftership_couriers = new AfterShip\Couriers($this->request->post['api_key']);
				$aftership_response = $aftership_couriers->get();
				
				if (isset($aftership_response['data']['couriers'])) {
					// set all couriers already added as disabled (case one is removed and is set status = 0)  | on sync is enabled back only couriers also available on AfterShip Account
					$this->model_module_aftership->disableCouriers();
					
					$sort_order = 0;
					
					foreach($aftership_response['data']['couriers'] as $courier) {
						$courier['sort_order'] = ++$sort_order;
						
						$courier_id = $this->model_module_aftership->getCourierIdBySlug($courier['slug']);
						
						if ($courier_id) {
							$this->model_module_aftership->editCourier($courier_id, $courier);
						} else {
							$this->model_module_aftership->addCourier($courier);
						}	
					}
				}
				
				$json['success'] = $this->language->get('text_sync_complete');
				
			} catch(Exception $e) {
				$json['error'] = sprintf($this->language->get('error_sync_courier'), $e->getMessage());
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	// Get enabled couriers already stored in database
	public function getCouriers() {
		$this->load->language('module/aftership');
		$this->load->model('module/aftership');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['column_name'] = $this->language->get('column_name');
		$data['column_phone'] = $this->language->get('column_phone');
		$data['column_website'] = $this->language->get('column_website');
		
		$data['couriers'] = array();

		$couriers = $this->model_module_aftership->getCouriers();
		
		if ($couriers) {
			foreach($couriers as $courier) {
				$data['couriers'][] = array(
					'courier_id' => $courier['courier_id'],
					'name'       => $courier['name'],
					'phone'      => $courier['phone'],
					'website'    => $courier['website']
				);
			}
		}
		
		$this->response->setOutput($this->load->view('module/aftership_courier_list.tpl', $data));
	}
	
	public function generateComment() {
		$this->load->model('module/aftership');
		
		$json = array();
		
		if (isset($this->request->post['courier_id']) && isset($this->request->post['tracking_number']) && isset($this->request->post['order_id'])) {
			
			$courier_info = $this->model_module_aftership->getCourier($this->request->post['courier_id']);
			
			$find = array(
				'{courier_name}',
				'{courier_phone}',
				'{courier_website}',
				'{tracking_number}',
				'{tracking_url}'
			);
			
			$replace = array(
				'courier_name' 	  => $courier_info['name'],
				'courier_phone'   => $courier_info['phone'],
				'courier_website' => $courier_info['website'],
				'tracking_number' => $this->request->post['tracking_number'],
				'tracking_url'    => $this->getTrackingURL($this->request->post['tracking_number'])
			);
			
			$comment_language_id = $this->model_module_aftership->getOrderLanguageId($this->request->post['order_id']);
			
			$comments_template = $this->config->get('aftership_comment');
			
			if (!isset($comments_template[$comment_language_id])) {
				$comment_language_id = $this->model_module_aftership->getFrontStoreDefaultLanguageId();
			}
			
			$json['output'] = str_replace($find, $replace, $comments_template[$comment_language_id]['description']); 
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getTrackingInfo() {
		$this->load->language('module/aftership');
		$this->load->model('module/aftership');

		$data['text_tracking_number'] = $this->language->get('text_tracking_number');
		
		$data['button_track'] = $this->language->get('button_track');
		
		$order_id = (isset($this->request->get['order_id'])) ? $this->request->get['order_id'] : 0;
		
		$tracking_info = $this->model_module_aftership->getTrackingInfo($order_id);
		
		if ($tracking_info) {	
			$data['order_id'] = $order_id;
			$data['courier_name'] = $tracking_info['name'];
			$data['courier_phone'] = $tracking_info['phone'];
			$data['courier_website'] = $tracking_info['website'];
			$data['courier_logo'] = $this->getCourierLogo($tracking_info['slug']);
			$data['tracking_number'] = $tracking_info['tracking_number'];
			$data['tracking_url'] = $this->getTrackingURL($tracking_info['tracking_number']);
			
			$this->response->setOutput($this->load->view('module/aftership_tracking_info.tpl', $data));
		}
	}

	private function getTrackingURL($tracking_number) {
		return 'https://' . $this->config->get('aftership_username') . '.aftership.com/' . $tracking_number;
	}	
	
	private function getCourierLogo($slug) {
		return 'https://assets.aftership.com/couriers/svg/' . $slug . '.svg';
	}	

	private function update_check() {
		$data = 'v=' . $this->version . '&ex=40&e=' . $this->config->get('config_email') . '&ocv=' . VERSION;
        $curl = false;
        
        if (extension_loaded('curl')) {
			$ch = curl_init();
			
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_URL, 'https://www.oc-extensions.com/api/v1/update_check');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'OCX-Adaptor: curl'));
			curl_setopt($ch, CURLOPT_REFERER, HTTP_CATALOG);
			
			if (function_exists('gzinflate')) {
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			}
            
			$result = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			if ($http_code == 200) {
				$result = json_decode($result);
				
                if ($result) {
                    $curl = true;
                }
                
                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
        
        if (!$curl) {
			if (!$fp = @fsockopen('ssl://www.oc-extensions.com', 443, $errno, $errstr, 20)) {
				return false;
			}

			socket_set_timeout($fp, 20);
			
			$headers = array();
			$headers[] = "POST /api/v1/update_check HTTP/1.0";
			$headers[] = "Host: www.oc-extensions.com";
			$headers[] = "Referer: " . HTTP_CATALOG;
			$headers[] = "OCX-Adaptor: socket";
			if (function_exists('gzinflate')) {
				$headers[] = "Accept-encoding: gzip";
			}	
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: application/json";
			$headers[] = 'Content-Length: '.strlen($data);
			$request = implode("\r\n", $headers)."\r\n\r\n".$data;
			fwrite($fp, $request);
			$response = $http_code = null;
			$in_headers = $at_start = true;
			$gzip = false;
			
			while (!feof($fp)) {
				$line = fgets($fp, 4096);
				
				if ($at_start) {
					$at_start = false;
					
					if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
						return false;
					}
					
					$http_code = $m[2];
					continue;
				}
				
				if ($in_headers) {

					if (trim($line) == '') {
						$in_headers = false;
						continue;
					}

					if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
						continue;
					}
					
					if ( strtolower(trim($m[1])) == 'content-encoding' && trim($m[2]) == 'gzip') {
						$gzip = true;
					}
					
					continue;
				}
				
                $response .= $line;
			}
					
			fclose($fp);
			
			if ($http_code == 200) {
				if ($gzip && function_exists('gzinflate')) {
					$response = substr($response, 10);
					$response = gzinflate($response);
				}
				
				$result = json_decode($response);
				
                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
	}
	
}
?>
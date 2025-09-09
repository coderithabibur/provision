<?php
if (version_compare(VERSION,'3.0.0.0','>=' )) {
	define('TEMPLATE_FOLDER', 'oc3');
	define('EXTENSION_BASE', 'marketplace/extension');
	define('TOKEN_NAME', 'user_token');
	define('TEMPLATE_EXTN', '');
	define('EXTN_ROUTE', 'extension/hbapps');
}else if (version_compare(VERSION,'2.2.0.0','<=' )) {
	define('TEMPLATE_FOLDER', 'oc2');
	define('EXTENSION_BASE', 'extension/hbapps');
	define('TOKEN_NAME', 'token');
	define('TEMPLATE_EXTN', '.tpl');
	define('EXTN_ROUTE', 'hbapps');
}else{
	define('TEMPLATE_FOLDER', 'oc2');
	define('EXTENSION_BASE', 'extension/extension');
	define('TOKEN_NAME', 'token');
	define('TEMPLATE_EXTN', '');
	define('EXTN_ROUTE', 'extension/hbapps');
}
define('EXTN_VERSION', '2.2.0'); 
class ControllerHbappsGoogleEcommerce extends Controller {
	
	private $error = array(); 
	
	public function index() {   
		$data['extension_version'] = EXTN_VERSION;
				
		if (isset($this->request->get['store_id'])){
			$data['store_id'] = (int)$this->request->get['store_id'];
		}else{
			$data['store_id'] = 0;
		}
		
		$this->load->language(EXTN_ROUTE.'/google_ecommerce');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();

		$this->load->model('setting/setting');
		
		$store_info = $this->model_setting_setting->getSetting('ga_ecom', $this->request->get['store_id']);
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ga_ecom', $this->request->post, $this->request->get['store_id']);	
			
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link(EXTN_ROUTE.'/google_ecommerce', TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME].'&store_id='.$data['store_id'], true));
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		
		$text_strings = array(
				'heading_title','button_save','button_cancel'
		);
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
	
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME], true)
   		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link(EXTENSION_BASE, TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME] . '&type=hbapps', true)
		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link(EXTN_ROUTE.'/google_ecommerce', TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME].'&store_id='.$data['store_id'], true)
   		);
		
		$data['action'] = $this->url->link(EXTN_ROUTE.'/google_ecommerce', TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME].'&store_id='.$data['store_id'], true);
		
		$data['cancel'] = $this->url->link(EXTENSION_BASE, TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME] . '&type=hbapps', true);
		$data[TOKEN_NAME] = $this->session->data[TOKEN_NAME];
		$data['base_route'] = EXTN_ROUTE;
		
		$this->load->model('localisation/currency');
		$data['currencies'] = $this->model_localisation_currency->getCurrencies();

		$data['ga_ecom_id'] = (isset($store_info['ga_ecom_id']))? $store_info['ga_ecom_id'] : 'product_id';
		$data['ga_ecom_currency'] 	= (isset($store_info['ga_ecom_currency']))? $store_info['ga_ecom_currency'] : $this->config->get('config_currency');
					
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/hbapps/'.TEMPLATE_FOLDER.'/google_ecommerce'.TEMPLATE_EXTN, $data));

	}
	
	public function ga_refund_block(){
		$order_id = (int)$this->request->get['order_id'];
		
		$data['products'] = array();
		$product_query = $this->db->query("SELECT * FROM `".DB_PREFIX."order_product` WHERE order_id = '".(int)$order_id."'");
		if ($product_query->rows){
			$products = $product_query->rows;
			foreach ($products as $product){
				$data['products'][] = array(
					'product_id'		=> $product['product_id'],
					'name'				=> $product['name']
				);
			}
		}
		
		$data['action'] = $this->url->link(EXTN_ROUTE.'/google_ecommerce/send_info_to_ga', TOKEN_NAME.'=' . $this->session->data[TOKEN_NAME].'&order_id='.$order_id, true);
		$this->response->setOutput($this->load->view('extension/hbapps/'.TEMPLATE_FOLDER.'/google_ecommerce_refund'.TEMPLATE_EXTN, $data));
	}
	
	public function send_info_to_ga(){
		$order_id = (int)$this->request->get['order_id'];
		
		$product = (int)$this->request->post['ga_refund_products'];
		if (isset($this->request->post['ga_refund_qty'])) {
			$qty = $this->request->post['ga_refund_qty'];
		}else{
			$qty = 1;
		}
		
		$this->load->model('sale/order');
		$order_info = $this->model_sale_order->getOrder($order_id);
		
		$this->load->model('setting/setting');

		$extn_info = $this->model_setting_setting->getSetting('ga_ecom', $order_info['store_id']);
		
		if (version_compare(VERSION,'2.2.0.0','<' )) {
			$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
			$ga_script = $store_info['config_google_analytics'];
		}else{
			$store_info = $this->model_setting_setting->getSetting('google_analytics', $order_info['store_id']);
			$ga_script = $store_info['google_analytics_code'];
		}
		
		$ga_ecom_id = (isset($extn_info['ga_ecom_id']))? $extn_info['ga_ecom_id'] : 'product_id';
		
		$tracking_code  = '';
		
		if ($product == 0){
			$tracking_code .= "gtag('event', 'refund', ";
			$tracking_code .= '{ "transaction_id": "'.$order_id.'" });';
		}else{
			if ($ga_ecom_id == 'sku') {
				$id = $this->getProductSku($product);
			}else{
				$id = $product;
			}
			
			$product_query = $this->db->query("SELECT name FROM `".DB_PREFIX."order_product` WHERE order_id = '".(int)$order_id."' AND product_id = '".(int)$product."' LIMIT 1");
			$product_name = $product_query->row['name'];
			$tracking_code .= "gtag('event', 'refund', {";
			$tracking_code .= '"transaction_id": "'.$order_id.'", "items": [{"id": "'.$id.'", "name": "'.$product_name.'","list_name": "Admin Refund Page","quantity": '.$qty.'}]});';
		}
		
		echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Send Refund Info to GA</title>';
		echo html_entity_decode($ga_script);
		echo '</head><body>';
		echo '<script type="text/javascript">';
		echo $tracking_code;
		echo '</script>';
		echo 'Enhanced Ecommerce Refund tracking data sent to google analytics. You can close this page now.';
		echo '</body></html>';

	}
	
	public function getProductSku($product_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product` WHERE product_id = '".(int)$product_id."' LIMIT 1");
		if ($query->row){
			if ($query->row['sku'] == '') {
				return 'Product ID: '.$product_id. ' - Model: '.$query->row['model'];
			}else {
				return $query->row['sku'];
			}
		} else {
			return $product_id;	
		}
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', EXTN_ROUTE.'/google_ecommerce')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	public function install(){
		if (version_compare(VERSION,'2.2.0.0','<' )) {
			$theme = $this->config->get('config_template');
		}else if (version_compare(VERSION,'3.0.0.0','>' )) {
			$theme = $this->config->get('config_theme');
		} else {
			$theme = $this->config->get('theme_default_directory');
		}
		
		if ($theme == 'journal2') {
			$template_name = 'journal2';
		}else if ($theme == 'journal3') {
			$template_name = 'journal3';
		}else{
			$template_name = 'default';
		}
		
		if ((version_compare(VERSION,'2.0.0.0','>=' )) and (version_compare(VERSION,'2.3.0.0','<' ))) {
			$ocmod_filename = 'ocmod_ga_ecommerce_'.$template_name.'_2000_2200.txt';
			$ocmod_name = 'Google Analytics - Enhanced Ecommerce ['.$template_name.'] [2000-2200]';
		}else if ((version_compare(VERSION,'2.3.0.0','>=' )) and (version_compare(VERSION,'3.0.0.0','<' ))) {
			$ocmod_filename = 'ocmod_ga_ecommerce_'.$template_name.'_23xx.txt';
			$ocmod_name = 'Google Analytics - Enhanced Ecommerce ['.$template_name.'] [23xx]';
		}else if (version_compare(VERSION,'3.0.0.0','>=' )) {
			$ocmod_filename = 'ocmod_ga_ecommerce_'.$template_name.'_3xxx.txt';
			$ocmod_name = 'Google Analytics - Enhanced Ecommerce ['.$template_name.'] [3xxx]';
		}
		
		$ocmod_version = EXTN_VERSION;
		$ocmod_code = 'huntbee_analytics_ecommerce_ocmod';	
		$ocmod_author = 'HuntBee OpenCart Services';
		$ocmod_link = 'https://www.huntbee.com';
		
		$file = DIR_APPLICATION . 'view/template/extension/hbapps/ocmod/'.$ocmod_filename;
		if (file_exists($file)) {
			$ocmod_xml = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
			$this->db->query("INSERT INTO " . DB_PREFIX . "modification SET code = '" . $this->db->escape($ocmod_code) . "', name = '" . $this->db->escape($ocmod_name) . "', author = '" . $this->db->escape($ocmod_author) . "', version = '" . $this->db->escape($ocmod_version) . "', link = '" . $this->db->escape($ocmod_link) . "', xml = '" . $this->db->escape($ocmod_xml) . "', status = '1', date_added = NOW()");
		}
		
		$data['success'] = 'This extension has been installed successfully';
	}
	
	public function uninstall(){
		$this->db->query("DELETE FROM " . DB_PREFIX . "modification WHERE `code` = 'huntbee_analytics_ecommerce_ocmod'");
		$data['success'] = 'This extension is uninstalled successfully';
	}
	
}
?>
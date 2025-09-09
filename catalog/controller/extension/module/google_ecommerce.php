<?php
class ControllerExtensionModuleGoogleEcommerce extends Controller {
	public function get_product_info() {
		if (isset($this->request->get['product_id'])){
			$product_id = $this->request->get['product_id'];
			
			if (isset($_SERVER['HTTP_REFERER'])) {
				$referrer = parse_url($_SERVER['HTTP_REFERER']);
				$list = $referrer['path'];
				$json['list_name'] = $list;
			}else{
				$json['list_name'] = '';
			}

if ($json['list_name'] == '/') {
			    $json['list_name'] = 'Home Page';
			}
			
			$this->load->model('extension/module/google_ecommerce');
			$this->load->model('catalog/product');
			
			$ga_ecom_id = ($this->config->get('ga_ecom_id'))? $this->config->get('ga_ecom_id') : 'product_id';
			
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($ga_ecom_id == 'sku') {
				$json['id'] 			= $this->model_extension_module_google_ecommerce->getProductSku($product_info['product_id']);
			} else {
				$json['id'] 			= $product_info['product_id'];
			}
			$json['product_name'] 	= $product_info['name'];
			$json['brand']			= $this->model_extension_module_google_ecommerce->getProductBrand($product_info['product_id']);
			$json['category']		= $this->model_extension_module_google_ecommerce->getProductCategory($product_info['product_id'], $this->config->get('config_language_id'));
			
			if ((float)$product_info['special']) {
				$json['price'] = $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));
			} else {
				$json['price'] = $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
			}
		}else{
			$json['error'] = 'Product ID not mentioned';
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
?>
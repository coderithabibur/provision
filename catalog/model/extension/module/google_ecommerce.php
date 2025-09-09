<?php
class ModelExtensionModuleGoogleEcommerce extends Model {
	public function getOrderTax($order_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE code = 'tax' AND order_id = '" . (int)$order_id . "' LIMIT 1");
		if ($query->row) {
			return $query->row['value'];	
		}else{
			return '0';
		}
	}
	
	public function getOrderShipping($order_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE code = 'shipping' AND order_id = '" . (int)$order_id . "' LIMIT 1");
		if ($query->row) {
			return $query->row['value'];	
		}else{
			return '0';
		}	
	}
	
	public function getOrderCoupon($order_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE code = 'coupon' AND order_id = '" . (int)$order_id . "' LIMIT 1");
		if ($query->row) {
			return $query->row['title'];	
		}else{
			return false;
		}	
	}
	
	public function getOrderProducts($order_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
	
		if($query->rows){
			return $query->rows;
		} else {
			return false;	
		}
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

	public function getProductCost($product_id){
		$query = $this->db->query("SELECT product_cost FROM `" . DB_PREFIX . "product` WHERE product_id = '".(int)$product_id."' LIMIT 1");
		
		$product_cost = number_format($query->row['product_cost'], 2, '.', '');
		return $product_cost;
	}
	
	public function getProductBrand($product_id){
		$query = $this->db->query("SELECT b.name FROM `" . DB_PREFIX . "product` a, `" . DB_PREFIX . "manufacturer` b WHERE a.manufacturer_id = b.manufacturer_id AND a.product_id = '".(int)$product_id."' LIMIT 1");
		if ($query->row){
			return $query->row['name'];
		} else {
			return '';	
		}
	}
	
	public function getProductCategory($product_id, $language_id){
		$query = $this->db->query("SELECT a.name FROM `" . DB_PREFIX . "category_description` a, `" . DB_PREFIX . "product_to_category` b where a.category_id = b.category_id AND b.product_id = '".(int)$product_id."' AND a.language_id = '".(int)$language_id."' ORDER BY b.category_id DESC LIMIT 1");
		if ($query->row){
			return $query->row['name'];
		} else {
			return 'Category Not Assigned';	
		}
	}
	
	public function build_ecommerce($order_id) {
// 		$item_data = array();
// 		$ecommerce = array();
		
// 		$this->load->model('checkout/order');
// 		$order_info = $this->model_checkout_order->getOrder($order_id);
		
// 		$this->load->model('setting/setting');
// 		$extn_info = $this->model_setting_setting->getSetting('ga_ecom', $order_info['store_id']);
		
// 		$ga_ecom_id = (isset($extn_info['ga_ecom_id']))? $extn_info['ga_ecom_id'] : 'product_id';
// 		$ga_ecom_currency = (isset($extn_info['ga_ecom_currency']))? $extn_info['ga_ecom_currency'] : $this->config->get('config_currency');
		
// 		$products = $this->getOrderProducts($order_id);
// 		if ($products) {
// 			foreach ($products as $product) {
// 				$product_cost = $this->getProductCost($product['product_id']);
// 				$product_cost = $product_cost * $product['quantity'];

// 				$price = number_format($product['price'], 2, '.', '');
				
// 				$total_price = $price * $product['quantity'];
// 				$net_profit = $total_price - $product_cost;
				
// 				$product_cost = number_format($product_cost, 2, '.', '');
// 				$net_profit = number_format($net_profit, 2, '.', '');
				
// 				$item_data[] = array(
// 						'name'			=> $product['name'],
// 						'sku'			=> ($ga_ecom_id == 'sku')? $this->getProductSku($product['product_id']) : $product['product_id'],
// 						'brand'			=> $this->getProductBrand($product['product_id']),
// 						'product_cost'	=> $product_cost,
// 						'net_profit'	=> $net_profit,
// 						'category'		=> $this->getProductCategory($product['product_id'], $order_info['language_id']),
// 						'price'			=> $price,
// 						'quantity'		=> $product['quantity']
// 					);
// 			}
// 		}
		
// 		$ecommerce = array(
// 			'id' 			=> $order_id,
// 			'affiliation'	=> $order_info['store_name'],
// 			'revenue'		=> number_format($order_info['total'], 2, '.', ''),
// 			'shipping'		=> $this->getOrderShipping($order_id),
// 			'tax'			=> $this->getOrderTax($order_id),
// 			'currency'		=> $ga_ecom_currency,//$order_info['currency_code'],
// 		);
		
// 		$tracking_code = '';
// 		$tracking_code .= '<script type="text/javascript">';
// 		$tracking_code .= "gtag('event', 'purchase', {";
		
// 		$tracking_code .= '"transaction_id": "'.$ecommerce['id'].'", "affiliation": "'.$ecommerce['affiliation'].'", "value": '.$ecommerce['revenue'].', "currency": "'.$ecommerce['currency'].'", "tax": '.$ecommerce['tax'].', "shipping": '.$ecommerce['shipping'];
		
// 		if ($this->getOrderCoupon($order_id)) {
// 			$tracking_code .= ',"coupon": "'.$this->getOrderCoupon($order_id).'"';
// 		}
		
// 		$tracking_code .= ', "items": [';
// 		foreach ($item_data as $item) {
// 			$tracking_code .= '{"id": "'.$item['sku'].'", "name": "'.$item['name'].'", "list_name": "Checkout Success Page", "brand": "'.$item['brand'].'", "category": "'.$item['category'].'", "quantity": '.$item['quantity'].', "price": '.$item['price'].', "product_cost": '.$item['product_cost'].', "net_profit": '.$item['net_profit'].'},';
// 		}
// 		$tracking_code .= "]});";
// 		$tracking_code .= "</script>";
		
// 		return $tracking_code;
	}
	
	public function build_begin_checkout() {
		$item_data = array();
				
		$ga_ecom_id = ($this->config->get('ga_ecom_id'))? $this->config->get('ga_ecom_id') : 'product_id';
		
		$products = $this->cart->getProducts();
		
		if ($products) {
			foreach ($products as $product) {
				$product_cost = $this->getProductCost($product['product_id']);
				$product_cost = $product_cost * $product['quantity'];
				
				$item_data[] = array(
						'name'			=> $product['name'],
						'sku'			=> ($ga_ecom_id == 'sku')? $this->getProductSku($product['product_id']) : $product['product_id'],
						'brand'			=> $this->getProductBrand($product['product_id']),
						'product_cost'	=> $product_cost,
						'category'		=> $this->getProductCategory($product['product_id'], $this->config->get('config_language_id')),
						'price'			=> number_format($product['price'], 2, '.', ''),
						'quantity'		=> $product['quantity']
					);
			}
		}
		
		$tracking_code = '';
		$tracking_code .= '<script type="text/javascript">';
		$tracking_code .= "gtag('event', 'begin_checkout', {";
		$tracking_code .= '"items": [';
		
		foreach ($item_data as $item) {
			$tracking_code .= '{"id": "'.$item['sku'].'", "name": "'.$item['name'].'", "list_name": "Checkout Page", "brand": "'.$item['brand'].'", "category": "'.$item['category'].'", "quantity": '.$item['quantity'].', "price": '.$item['price'].'},';
		}
		$tracking_code .= "]});";
		$tracking_code .= "</script>";
		
		return $tracking_code;
	}
	
	public function build_product_impression($results, $page, $limit, $breadcrumbs, $list_name) {
		$index = 1;
		$bb = array();
		
		$ga_ecom_id = ($this->config->get('ga_ecom_id'))? $this->config->get('ga_ecom_id') : 'product_id';
		
		$tracking_code = '';
		$tracking_code .= '<script type="text/javascript">';
		$tracking_code .= "gtag('event', 'view_item_list', {";
		$tracking_code .= '"items": [';
		foreach ($breadcrumbs as $breadcrumb) {
			$bb[] = $breadcrumb['text'];
		}
		
		if (!empty($bb)) {
			array_shift($bb);
			$category = implode('/',$bb);
		}else{
			$category = false;
		}
		
		foreach ($results as $result) {
			if ($ga_ecom_id == 'sku') {
				$id = $this->getProductSku($result['product_id']);
			} else {
				$id = $result['product_id'];
			}
			$product_name = $result['name'];
			$brand = $this->getProductBrand($result['product_id']);
			
			$product_cost = $this->getProductCost($result['product_id']);
			
			if ($category == false){
				$category = $this->getProductCategory($result['product_id'], $this->config->get('config_language_id'));
			}
			
			$page = (int) $page;
            $limit = (int) $limit;
            $index = (int) $index;
            			
			if ($page > 1) {
				$list_position = (($page-1) * $limit) + $index;
			}else{
				$list_position = $index;
			}
			
			if ((float)$result['special']) {
				$price = $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'));
			} else {
				$price = $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'));
			}
			
			$tracking_code .= '{"id": "'.$id.'_au", "name": "'.$product_name.'", "list_name": "'.$list_name.'", "brand": "'.$brand.'", "category": "'.$category.'", "list_position": '.$list_position.', "price": '.$price.'},';

			$index++;
		}
		
		$tracking_code .= "]});";
		$tracking_code .= "</script>";
		
		return $tracking_code;
	}
	
	public function build_product_view($product_info, $breadcrumbs) {
		$bb = array();
		
		$ga_ecom_id = ($this->config->get('ga_ecom_id'))? $this->config->get('ga_ecom_id') : 'product_id';
		
		if ($ga_ecom_id == 'sku') {
			$id = $this->getProductSku($product_info['product_id']);
		} else {
			$id = $product_info['product_id'];
		}
		$product_name = $product_info['name'];
		$brand = $this->getProductBrand($product_info['product_id']);
		
		$product_cost = $this->getProductCost($product_info['product_id']);
		
		foreach ($breadcrumbs as $breadcrumb) {
			$bb[] = $breadcrumb['text'];
		}
		
		if (!empty($bb)) {
			array_shift($bb);
			$category = implode('/',$bb);
		}else{
			$category = $this->getProductCategory($product_info['product_id'], $this->config->get('config_language_id'));
		}
		
		if ($category == ''){
			$category = $this->getProductCategory($product_info['product_id'], $this->config->get('config_language_id'));
		}
		
		if ((float)$product_info['special']) {
			$price = $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));
		} else {
			$price = $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
		}
		
		$tracking_code = '';
		$tracking_code .= '<script type="text/javascript">';
		$tracking_code .= "gtag('event', 'view_item', {";
		$tracking_code .= '"items": [';
		$tracking_code .= '{"id": "'.$id.'_au", "name": "'.$product_name.'", "list_name": "Product Page", "brand": "'.$brand.'", "category": "'.$category.'", "price": '.$price.'}';
		$tracking_code .= "]});";
		$tracking_code .= "</script>";
		
		return $tracking_code;
	}
	
	
}
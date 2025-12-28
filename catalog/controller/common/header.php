<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('analytics/' . $analytic['code']);
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['yoyo'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');
        $this->response->setOutput($this->load->view('common/header', $data));
		$data['text_home'] = $this->language->get('text_home');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_call'] = $this->language->get('text_call');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['special'] = $this->url->link('product/special', '', 'SSL');
		$data['latest'] = $this->url->link('product/latest', '', 'SSL');
		$data['featured'] = $this->url->link('information/information&information_id=7','', 'SSL');
		$data['contact'] = $this->url->link('information/contact','', 'SSL');
		
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['geocode'] = $this->config->get('config_geocode');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['e_mail'] = $this->config->get('config_email');		
		$data['fax'] = $this->config->get('config_fax');
		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');
		$this->load->model('tool/image');
		$this->load->model('catalog/product');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
			$data['category_id'] = (int)array_pop($parts);
		} else {
			$data['category_id'] = 0;
		}

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $key => $category) {
			if (trim($category['name']) == 'Laser') {
				$laser = $categories[$key];
				unset($categories[$key]);
				$categories[] = $laser;
				break;
			}
		}
		
		foreach ($categories as $category) {
			// if ($category['top']) {
				$icon = '';
				if ($category['icon']) {
					$icon = HTTP_SERVER . 'image/' . $category['icon'];
				}  
				$image = '';
				if ($category['image'] && is_file(DIR_IMAGE . $category['image'])) { 
					$image = HTTP_SERVER . 'image/' . $category['image'];
				} 
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach($children as $child) {
					$sub_childData = array();
					$child_data = $this->model_catalog_category->getCategories($child['category_id']);
					if(isset($child_data) && (!empty($child_data))){
						foreach($child_data as $subChild){
							$filter_data = array('filter_category_id' => $subChild['category_id'], 'filter_sub_category' => true);
							$sub_childData[] = array(
								'category_id' => $subChild['category_id'],
								'name' => $subChild['name'] /*. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '')*/,
								'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'].'_'.$subChild['category_id'])
							);
						}
					}
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] /*. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '')*/,
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						'children'	=>  $sub_childData,
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'icon'     => $icon,
					'image'    => $image,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			// }
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency'); 
		$data['cart'] = $this->load->controller('common/cart');

		// Mini cart data 
		$this->load->language('checkout/cart');

		$data['cart_count'] = $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0);

		$data['cart_items'] = array();
		$products = $this->cart->getProducts();
		foreach ($products as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], 450, 450);
			} else {
				$image = '';
			}
			$data['cart_items'][] = array(
				'key' => $product['cart_id'],
				'name' => $product['name'],
				'image' => $image,
				'quantity' => $product['quantity'],
				'price' => $this->currency->format($product['price'], $this->session->data['currency']),
				'total' => $this->currency->format($product['total'], $this->session->data['currency'])
			);
		}
		$data['cart_total'] = $this->currency->format($this->cart->getTotal(), $this->session->data['currency']);

		if (!empty($this->request->get['route'])) {
			$data['route'] = $this->request->get['route'];
		} else {
			$data['route'] = '';
		}

		// Header options 
		$custom_code_settings = $this->model_setting_setting->getSetting('module_custom_code');

		// Custom Header Codes Options
		if (!empty($custom_code_settings['module_custom_code_status'])) {
			// Top Bar Text
			$data['delivery_text'] = $custom_code_settings['module_custom_code_delivery_text'];
			$data['flash_sale_text'] = $custom_code_settings['module_custom_code_flash_sale_text'];

			// Custom Scripts
			if (!empty($custom_code_settings['module_custom_code_header_code'])) {
				$data['custom_header_code'] = html_entity_decode($custom_code_settings['module_custom_code_header_code'], ENT_QUOTES, 'UTF-8');
			} else {
				$data['custom_header_code'] = '';
			}
			if (!empty($custom_code_settings['module_custom_code_body_code'])) {
				$data['custom_body_code'] = html_entity_decode($custom_code_settings['module_custom_code_body_code'], ENT_QUOTES, 'UTF-8');
			} else {
				$data['custom_body_code'] = '';
			}
		} 
 
		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'] . ' product-custom';
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}

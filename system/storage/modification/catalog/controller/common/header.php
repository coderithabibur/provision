<?php
class ControllerCommonHeader extends Controller {
	public function index() {
if(file_exists('catalog/model/extension/bganycombi.php')) { 
				$this->document->addStyle('catalog/view/javascript/bganycombi.css');
				$this->document->addScript('catalog/view/javascript/bganycombi.js');
			}
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


			// Product Questions
			if ($this->config->get('product_question_status')) {

				if (isset($this->request->get['route'])) {
					$route = $this->request->get['route'];
				} else {
					$route = 'common/home';
				}

				if (isset($this->request->get['product_id'])) {
					$product_id = $this->request->get['product_id'];
				} else {
					$product_id = 0;
				}

				$this->session->data['product_question_product_id'] = $product_id;

				if ($route == 'product/product' && $product_id) {
					$this->document->addScript('catalog/view/javascript/jquery/jquery.product-question.js');

					if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/product-question.css')) {
						$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/product-question.css');
					} else {
						$this->document->addStyle('catalog/view/theme/default/stylesheet/product-question.css');
					}

					if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/animate.css')) {
						$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/animate.css');
					} else {
						$this->document->addStyle('catalog/view/theme/default/stylesheet/animate.css');
					}
				}
			}
			// Stop Product Question
			
		$data['title'] = $this->document->getTitle();


	if(isset($this->session->data['plink'])) {
		$data['plink'] = $this->session->data['plink'];
	} 
	unset($this->session->data['plink']);

	if(isset($this->session->data['pimage'])) {
		$data['pimage'] = $this->session->data['pimage'];
	}
	unset($this->session->data['pimage']);

	if(isset($this->session->data['twitimage'])) {
		$data['twitimage'] = str_replace(" ","%20",$this->session->data['twitimage']);
	}
	unset($this->session->data['twitimage']);

	if(isset($this->session->data['pinimage'])) {
		$data['pinimage'] = str_replace(" ","%20",$this->session->data['pinimage']);
	}
	unset($this->session->data['pinimage']);

	if(isset($this->session->data['pstock'])) {
	$data['pstock'] = $this->session->data['pstock'];
	} 
	unset($this->session->data['pstock']);

	if(isset($this->session->data['pbrand'])) {
	$data['pbrand'] = $this->session->data['pbrand'];
	} 
	unset($this->session->data['pbrand']);

	if(isset($this->session->data['pprice'])) {
		$data['pprice'] = $this->session->data['pprice'];
	} 
	unset($this->session->data['pprice']);

	if(isset($this->session->data['pmodel'])) {
		$data['pmodel'] = $this->session->data['pmodel'];
	} 
	unset($this->session->data['pmodel']);

	$data['config_name'] = $this->config->get('config_name');
	$data['config_currency'] = $this->config->get('config_currency');

	$data['config_google_pageid'] = $this->config->get('config_google_pageid');

	$data['config_twitter_status'] = $this->config->get('twittersnippet_status');
	$data['config_twitter_uername'] = $this->config->get('config_twitter_uername');
	$data['tcardsize'] = $this->config->get('config_twitter_cardsize');

	$data['config_facebook_status'] = $this->config->get('grsnippetfacebook_status');
	$data['config_facebook_adminid'] = $this->config->get('config_facebook_adminid');

	$data['config_pinterest_status'] = $this->config->get('grsnippetpinterest_status');

	
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

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
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
if($this->config->get("nerdherd_direct_links")) {
	$link = $this->url->link('product/category', 'path=' . $child['category_id'],'SSL');
} else {
    $link = $this->url->link('product/category','path=' . $category['category_id'] . '_' . $child['category_id'],'SSL');
} 
					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] /*. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '')*/,
						'href' => $link,
						'subChild'	=>  $sub_childData,
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		if (!empty($this->request->get['route'])) {
			$data['route'] = $this->request->get['route'];
		} else {
			$data['route'] = '';
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

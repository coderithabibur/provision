<?php
//==============================================================================
// Braintree Payment Gateway v303.6
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
// 
// All code within this file is copyright Clear Thinking, LLC.
// You may not copy or reuse code within this file without written permission.
//==============================================================================

class ControllerExtensionPaymentBraintree extends Controller {
	private $type = 'payment';
	private $name = 'braintree';
	
	public function logFatalErrors() {
		$error = error_get_last();
		if ($error && $error['type'] === E_ERROR) {
			$this->log->write(strtoupper($this->name) . ': Order could not be completed due to the following fatal error:');
			$this->log->write('PHP Fatal Error:  ' . $error['message'] . ' in ' . $error['file'] . ' on line ' . $error['line']);
		} 
	}
	
	//==============================================================================
	// index()
	//==============================================================================
	public function index() {
		register_shutdown_function(array($this, 'logFatalErrors'));
		
		$data['type'] = $this->type;
		$data['name'] = $this->name;
		
		$settings = $this->getSettings();
		$data['settings'] = $settings;
		
		// Get Order Total line items
		$prefix = (version_compare(VERSION, '3.0', '<')) ? '' : 'total_';
		
		$order_totals_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'total' ORDER BY `code` ASC");
		$order_totals = $order_totals_query->rows;
		
		$sort_order = array();
		foreach ($order_totals as $key => $value) {
			$sort_order[$key] = $this->config->get($prefix . $value['code'] . '_sort_order');
		}
		array_multisort($sort_order, SORT_ASC, $order_totals);
		
		$total_data = array();
		$order_total = 0;
		$taxes = $this->cart->getTaxes();
		$total_array = array('totals' => &$total_data, 'total' => &$order_total, 'taxes' => &$taxes);
		
		foreach ($order_totals as $ot) {
			if (!$this->config->get($prefix . $ot['code'] . '_status') || $ot['code'] == 'intermediate_order_total') continue;
			if (version_compare(VERSION, '2.2', '<')) {
				$this->load->model('total/' . $ot['code']);
				$this->{'model_total_' . $ot['code']}->getTotal($total_data, $order_total, $taxes);
			} elseif (version_compare(VERSION, '2.3', '<')) {
				$this->load->model('total/' . $ot['code']);
				$this->{'model_total_' . $ot['code']}->getTotal($total_array);
			} else {
				$this->load->model('extension/total/' . $ot['code']);
				$this->{'model_extension_total_' . $ot['code']}->getTotal($total_array);
			}
		}
		
		// not needed at this point
		//$data['line_items'] = $total_data;
		
		// Get order info
		if (!empty($this->session->data['order_id'])) {
			$order_id = $this->session->data['order_id'];
			
			$this->load->model('checkout/order');
			$data['order_info'] = $this->model_checkout_order->getOrder($order_id);
		} else {
			$customer_id = (int)$this->customer->getId();
			if ($customer_id) {
				$customer = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = " . (int)$customer_id)->row;
				$customer['address'] = (!empty($customer['address_id'])) ? $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id = " . (int)$customer['address_id'])->row : array();
			} else {
				$customer = (!empty($this->session->data['guest'])) ? $this->session->data['guest'] : array();
				$customer['address'] = (!empty($this->session->data['payment_address'])) ? $this->session->data['payment_address'] : array();
			}
			
			$zone_id = (!empty($customer['address']['zone_id'])) ? $customer['address']['zone_id'] : $this->config->get('config_zone_id');
			$zone_name = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE country_id = " . (int)$zone_id)->row['name'];
			
			$country_id = (!empty($customer['address']['country_id'])) ? $customer['address']['country_id'] : $this->config->get('config_country_id');
			$country_code = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = " . (int)$country_id)->row['iso_code_2'];
			
			$order_info = array(
				'order_id'				=> 0,
				'total'					=> $order_total,
				'firstname'				=> (!empty($customer['firstname'])) ? $customer['firstname'] : '',
				'lastname'				=> (!empty($customer['lastname'])) ? $customer['lastname'] : '',
				'email'					=> (!empty($customer['email'])) ? $customer['email'] : '',
				'telephone'				=> (!empty($customer['telephone'])) ? $customer['telephone'] : '',
				'customer_id'			=> $customer_id,
				'comment'				=> '',
				'ip'					=> $this->request->server['REMOTE_ADDR'],
				'payment_firstname'		=> (!empty($customer['address']['firstname'])) ? $customer['address']['firstname'] : '',
				'payment_lastname'		=> (!empty($customer['address']['lastname'])) ? $customer['address']['lastname'] : '',
				'payment_address_1'		=> (!empty($customer['address']['address_1'])) ? $customer['address']['address_1'] : '',
				'payment_address_2'		=> (!empty($customer['address']['address_2'])) ? $customer['address']['address_2'] : '',
				'payment_city'			=> (!empty($customer['address']['city'])) ? $customer['address']['city'] : '',
				'payment_zone'			=> $zone_name,
				'payment_iso_code_2'	=> $country_code,
				'currency_code'			=> $this->session->data['currency'],
			);
		}
		
		$main_currency = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `key` = 'config_currency' AND store_id = 0")->row['value'];
		$decimal_places = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE `code` = '" . $this->db->escape($data['order_info']['currency_code']) . "'")->row['decimal_place'];
		$data['order_amount'] = round($this->currency->convert($data['order_info']['total'], $main_currency, $data['order_info']['currency_code']), (int)$decimal_places);
		
		// Sanitize order data
		$replace = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ','Ά','ά','Έ','έ','Ό','ό','Ώ','ώ','Ί','ί','ϊ','ΐ','Ύ','ύ','ϋ','ΰ','Ή','ή', '(', ')', '[', ']', '{', '}', "'");

		$with = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o','Α','α','Ε','ε','Ο','ο','Ω','ω','Ι','ι','ι','ι','Υ','υ','υ','υ','Η','η', '', '', '', '', '', '', "\'");
		
		foreach ($data['order_info'] as $key => &$value) {
			if (is_array($value)) {
				continue;
			}
			if ($key == 'email' || $key == 'telephone' || strpos($key, 'payment_') === 0 || strpos($key, 'shipping_') === 0) {
				$value = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
				$value = str_replace($replace, $with, $value);
				$value = substr($value, 0, 50);
			}
		}
		
		// Set data for other payment methods
		$data['currency'] = $this->session->data['currency'];
		$data['language'] = $this->session->data['language'];
		$data['checkout_success'] = $this->url->link('checkout/success', '', 'SSL');
		$data['paypal_flow'] = (!empty($settings['subscriptions']) || $settings['store_payment_method'] == 'allow') ? 'vault' : 'checkout';
		
		// Set error overrides
		$data['error_overrides'] = array();
		
		$error_overrides = explode("\n", $settings['error_overrides_' . $data['language']]);
		foreach ($error_overrides as $line) {
			if (empty(trim($line))) continue;
			$explode = explode('=', $line);
			$data['error_overrides'][$explode[0]] = $explode[1];
		}
		
		// Set Drop-in UI locale
		if (!empty($settings['dropin_locale_' . $data['language']])) {
			$data['locale'] = $settings['dropin_locale_' . $data['language']];
		} elseif (!empty($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$language_region = strtolower(substr($this->request->server['HTTP_ACCEPT_LANGUAGE'], 0, 5));
			$data['locale'] = str_replace('-', '_', substr($language_region, 0, 2));
		} else {
			$data['locale'] = 'en_US';
		}
		
		// Generate client token
		$this->loadBraintree($settings);
		
		try {
			$braintree_customer = Braintree_Customer::find('customer_' . $this->customer->getId());
		} catch (Exception $e) {
			if (!$this->customer->isLogged() || $settings['store_payment_method'] == 'never' || !$settings['allow_stored_cards']) {
				$braintree_customer = 'not_found';
			} else {
				$braintree_customer = Braintree_Customer::create(array(
					'id'		=> 'customer_' . $this->customer->getId(),
					'firstName'	=> $this->customer->getFirstName(),
					'lastName'	=> $this->customer->getLastName(),
					'email'		=> $this->customer->getEmail(),
					'phone'		=> $this->customer->getTelephone(),
				));
			}
		}
		
		if ($braintree_customer != 'not_found' && $settings['store_payment_method'] != 'never' && $settings['allow_stored_cards']) {
			$data['client_token'] = Braintree_ClientToken::generate(array(
				'customerId' 		=> 'customer_' . $this->customer->getId(),
				'merchantAccountId'	=> $settings[$this->session->data['currency'] . '_' . $settings['server_mode'] . '_merchant_account'],
			));
		} else {
			$data['client_token'] = Braintree_ClientToken::generate(array(
				'merchantAccountId'	=> $settings[$this->session->data['currency'] . '_' . $settings['server_mode'] . '_merchant_account'],
			));
		}
		
		// Render
		$theme = (version_compare(VERSION, '2.2', '<')) ? $this->config->get('config_template') : str_replace('theme_', '', $this->config->get('config_theme'));
		$template = (file_exists(DIR_TEMPLATE . $theme . '/template/extension/' . $this->type . '/' . $this->name . '.twig')) ? $theme : 'default';
		$template_file = DIR_TEMPLATE . $template . '/template/extension/' . $this->type . '/' . $this->name . '.twig';
		
		if (is_file($template_file)) {
			extract($data);
			
			ob_start();
			require(class_exists('VQMod') ? VQMod::modCheck(modification($template_file)) : modification($template_file));
			$output = ob_get_clean();
			
			return $output;
		} else {
			return 'Error loading template file';
		}
	}
	
	//==============================================================================
	// Private functions
	//==============================================================================
	private function getSettings() {
		$code = (version_compare(VERSION, '3.0', '<') ? '' : $this->type . '_') . $this->name;
		
		$settings = array();
		$settings_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($code) . "' ORDER BY `key` ASC");
		
		foreach ($settings_query->rows as $setting) {
			$value = $setting['value'];
			if ($setting['serialized']) {
				$value = (version_compare(VERSION, '2.1', '<')) ? unserialize($setting['value']) : json_decode($setting['value'], true);
			}
			$split_key = preg_split('/_(\d+)_?/', str_replace($code . '_', '', $setting['key']), -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			
				if (count($split_key) == 1)	$settings[$split_key[0]] = $value;
			elseif (count($split_key) == 2)	$settings[$split_key[0]][$split_key[1]] = $value;
			elseif (count($split_key) == 3)	$settings[$split_key[0]][$split_key[1]][$split_key[2]] = $value;
			elseif (count($split_key) == 4)	$settings[$split_key[0]][$split_key[1]][$split_key[2]][$split_key[3]] = $value;
			else 							$settings[$split_key[0]][$split_key[1]][$split_key[2]][$split_key[3]][$split_key[4]] = $value;
		}
		
		return $settings;
	}
	
	private function loadBraintree($settings) {
		require_once(DIR_SYSTEM . 'library/braintree/lib/Braintree.php');
		Braintree_Configuration::environment($settings['server_mode']);
		Braintree_Configuration::merchantId($settings[$settings['server_mode'] . '_merchant_id']);
		Braintree_Configuration::publicKey($settings[$settings['server_mode'] . '_public_key']);
		Braintree_Configuration::privateKey($settings[$settings['server_mode'] . '_private_key']);
	}
	
	private function overrideError($original_error) {
		$settings = $this->getSettings();
		
		$error_overrides = explode("\n", $settings['error_overrides_' . $this->session->data['language']]);
		foreach ($error_overrides as $line) {
			$explode = explode('=', $line);
			if ($original_error == trim($explode[0])) {
				return trim($explode[1]);
			}
		}
		
		return $original_error;
	}
	
	//==============================================================================
	// chargeNonce()
	//==============================================================================
	public function chargeNonce() {
		register_shutdown_function(array($this, 'logFatalErrors'));
		unset($this->session->data[$this->name . '_order_error']);
		
		$settings = $this->getSettings();
		$this->loadBraintree($settings);
		
		$language = (isset($this->session->data['language'])) ? $this->session->data['language'] : $this->config->get('config_language');
		
		// Check if customer has already exceeded the allowed number of payment attempts
		if (empty($this->session->data[$this->name . '_payment_attempts'])) {
			$this->session->data[$this->name . '_payment_attempts'] = 1;
		} else {
			$this->session->data[$this->name . '_payment_attempts']++;
		}
		
		if (!empty($settings['attempts']) && $this->session->data[$this->name . '_payment_attempts'] > (int)$settings['attempts']) {
			echo html_entity_decode($settings['attempts_exceeded_' . $language], ENT_QUOTES, 'UTF-8');
			return;
		}
		
		// Get order data
		$data = (version_compare(VERSION, '2.3', '<')) ? $this->load->language('total/total') : $this->load->language('extension/total/total');
		
		$this->load->model('checkout/order');
		$order_id = $this->session->data['order_id'];
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		// Check for subscription products
		$subscriptions = array();
		
		if (!empty($settings['subscriptions'])) {
			try {
				$plans = Braintree_Plan::all();
			} catch (Exception $e) {
				$plans = array();
			}
			
			foreach ($this->cart->getProducts() as $product) {
				$plan_ids = array();
				
				if (empty($plan_ids)) {
					$product_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE product_id = " . (int)$product['product_id'])->row;
					if (!empty($product_info['location'])) {
						$plan_ids[] = trim($product_info['location']);
					}
				}
				
				if (empty($plan_ids)) continue;
				
				foreach ($plan_ids as $plan_id) {
					foreach ($plans as $plan) {
						if ($plan->id == $plan_id) {
							if ($settings['prevent_guests'] && !$this->customer->getId()) {
								echo $settings['text_customer_required_' . $language];
								return;
							}
							$subscriptions[] = array(
								'cost'			=> $product['total'],
								'id'			=> $plan->id,
								'key'			=> $product[version_compare(VERSION, '2.1', '<') ? 'key' : 'cart_id'],
								'name'			=> $plan->name,
								'product'		=> $product['name'],
								'quantity'		=> $product['quantity'],
								'tax_class_id'	=> $product['tax_class_id'],
								'separate'		=> (!empty($plan->billingDayOfMonth) || !empty($plan->trialDuration)),
								'product_id'	=> $product['product_id'],
							);
						}
					}
				}
			}
		}
		
		// Add in shipping and tax costs for subscription products
		if ($settings['subscription_shipping']) {
			$country_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = " . (int)$order_info['shipping_country_id']);
			$shipping_address = array(
				'firstname'		=> $order_info['shipping_firstname'],
				'lastname'		=> $order_info['shipping_lastname'],
				'company'		=> $order_info['shipping_company'],
				'address_1'		=> $order_info['shipping_address_1'],
				'address_2'		=> $order_info['shipping_address_2'],
				'city'			=> $order_info['shipping_city'],
				'postcode'		=> $order_info['shipping_postcode'],
				'zone'			=> $order_info['shipping_zone'],
				'zone_id'		=> $order_info['shipping_zone_id'],
				'zone_code'		=> $order_info['shipping_zone_code'],
				'country'		=> $order_info['shipping_country'],
				'country_id'	=> $order_info['shipping_country_id'],
				'iso_code_2'	=> $order_info['shipping_iso_code_2'],
			);
			
			$cart_products = $this->cart->getProducts();
			
			foreach ($subscriptions as &$subscription) {
				// Remove ineligible products
				foreach ($cart_products as $product) {
					$key = $product[version_compare(VERSION, '2.1', '<') ? 'key' : 'cart_id'];
					if ($key != $subscription['key']) {
						$this->cart->remove($key);
					}
				}
				
				// Get shipping rates
				$subscription['cost'] = $this->tax->calculate($subscription['cost'], $subscription['tax_class_id']);
				
				if ($this->cart->hasShipping()) {
					$shipping_methods = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'shipping' ORDER BY `code` ASC")->rows;
					$prefix = (version_compare(VERSION, '3.0', '<')) ? '' : 'shipping_';
					
					foreach ($shipping_methods as $shipping_method) {
						if (!$this->config->get($prefix . $shipping_method['code'] . '_status')) continue;
						
						if (version_compare(VERSION, '2.3', '<')) {
							$this->load->model('shipping/' . $shipping_method['code']);
							$quote = $this->{'model_shipping_' . $shipping_method['code']}->getQuote($shipping_address);
						} else {
							$this->load->model('extension/shipping/' . $shipping_method['code']);
							$quote = $this->{'model_extension_shipping_' . $shipping_method['code']}->getQuote($shipping_address);
						}
						
						if (empty($quote)) continue;
						
						foreach ($quote['quote'] as $q) {
							if ($q['title'] == $order_info['shipping_method']) {
								$subscription['cost'] += $this->tax->calculate($q['cost'], $q['tax_class_id']);
								break;
							}
						}
					}
				}
				
				// Restore cart
				$this->cart->clear();
				foreach ($cart_products as $product) {
					$options = array();
					foreach ($product['option'] as $option) {
						if (isset($options[$option['product_option_id']])) {
							if (!is_array($options[$option['product_option_id']])) $options[$option['product_option_id']] = array($options[$option['product_option_id']]);
							$options[$option['product_option_id']][] = $option['product_option_value_id'];
						} else {
							$options[$option['product_option_id']] = (!empty($option['product_option_value_id'])) ? $option['product_option_value_id'] : $option['value'];
						}
					}
					$this->cart->add($product['product_id'], $product['quantity'], $options, $product['recurring']['recurring_id']);
				}
			}
		}
		
		// Take subscription costs out of total
		$revised_total = $order_info['total'];
		
		foreach ($subscriptions as $subscription) {
			$revised_total -= $subscription['cost'];
		}
		
		// Set up address arrays
		$billing_address = array(
			'firstName'			=> html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8'),
			'lastName'			=> html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8'),
			'company'			=> html_entity_decode($order_info['payment_company'], ENT_QUOTES, 'UTF-8'),
			'streetAddress' 	=> html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8'),
			'extendedAddress'	=> html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8'),
			'locality'			=> html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8'),
			'region'			=> html_entity_decode($order_info['payment_zone_code'], ENT_QUOTES, 'UTF-8'),
			'postalCode'		=> html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8'),
			'countryCodeAlpha2'	=> html_entity_decode($order_info['payment_iso_code_2'], ENT_QUOTES, 'UTF-8')
		);
		
		$shipping_address = array(
			'firstName'			=> html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8'),
			'lastName'			=> html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8'),
			'company'			=> html_entity_decode($order_info['shipping_company'], ENT_QUOTES, 'UTF-8'),
			'streetAddress' 	=> html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8'),
			'extendedAddress'	=> html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8'),
			'locality'			=> html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8'),
			'region'			=> html_entity_decode($order_info['shipping_zone_code'], ENT_QUOTES, 'UTF-8'),
			'postalCode'		=> html_entity_decode($order_info['shipping_postcode'], ENT_QUOTES, 'UTF-8'),
			'countryCodeAlpha2'	=> html_entity_decode($order_info['shipping_iso_code_2'], ENT_QUOTES, 'UTF-8')
		);
		
		// Find or create customer, and update stored card address
		$old_customer = '';
		$new_customer = '';
		$card_nonce = $this->request->post['nonce'];
		
		try {
			$customer = Braintree_Customer::find('customer_' . $this->customer->getId());
			$old_customer = $customer->id;
			if ($customer->email != $order_info['email']) {
				$update_result = Braintree_Customer::update($old_customer, array('email' => $order_info['email']));
				if (!$update_result->success) {
					$this->log->write(strtoupper($this->name) . ' CUSTOMER UPDATE ERROR: ' . $update_result->message);
				}
			}
		} catch (Exception $e) {
			$new_customer = ($this->customer->isLogged()) ? 'customer_' . $this->customer->getId() : 'guest_' . $order_id;
		}
		
		$customer = array(
			'id'				=> $new_customer,
			'firstName'			=> html_entity_decode($order_info['firstname'], ENT_QUOTES, 'UTF-8'),
			'lastName'			=> html_entity_decode($order_info['lastname'], ENT_QUOTES, 'UTF-8'),
			'company'			=> html_entity_decode($order_info['payment_company'], ENT_QUOTES, 'UTF-8'),
			'phone'				=> $order_info['telephone'],
			'fax'				=> (isset($order_info['fax'])) ? $order_info['fax'] : '',
			'email'				=> $order_info['email']
		);
		
		// Check fraud data
		$submit_for_settlement = ($settings['charge_mode'] == 'submit') ? true : false;
		
		if ($settings['charge_mode'] == 'fraud') {
			if (version_compare(VERSION, '2.0.3', '<')) {
				if ($this->config->get('config_fraud_detection')) {
					$this->load->model('checkout/fraud');
					if ($this->model_checkout_fraud->getFraudScore($order_info) > $this->config->get('config_fraud_score')) {
						$submit_for_settlement = false;
					}
				}
			} else {
				$this->load->model('account/customer');
				$customer_info = $this->model_account_customer->getCustomer($order_info['customer_id']);
				
				if (empty($customer_info['safe'])) {
					$fraud_extensions = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'fraud' ORDER BY `code` ASC")->rows;
					
					foreach ($fraud_extensions as $extension) {
						$prefix = (version_compare(VERSION, '3.0', '<')) ? '' : 'fraud_';
						if (!$this->config->get($prefix . $extension['code'] . '_status')) continue;
						
						if (version_compare(VERSION, '2.3', '<')) {
							$this->load->model('fraud/' . $extension['code']);
							$fraud_status_id = $this->{'model_fraud_' . $extension['code']}->check($order_info);
						} else {
							$this->load->model('extension/fraud/' . $extension['code']);
							$fraud_status_id = $this->{'model_extension_fraud_' . $extension['code']}->check($order_info);
						}
						
						if ($fraud_status_id) {
							$submit_for_settlement = false;
						}
					}
				}
			}
		}
		
		// Charge card
		if ($revised_total >= 0.01) {
			// Set up transaction data
			$store_card = (!empty($subscriptions) || $settings['store_payment_method'] == 'always');
			$device_data = (!empty($this->request->post['device_data'])) ? $this->request->post['device_data'] : '';
			
			$transaction_array = array(
				'channel'				=> 'ClearThinking_BraintreePaymentGateway',
				'orderId'				=> $order_id,
				'customerId'			=> $old_customer,
				'paymentMethodNonce'	=> $card_nonce,
				'customer'				=> $customer,
				'billing'				=> $billing_address,
				'shipping'				=> $shipping_address,
				'deviceData'			=> html_entity_decode($device_data, ENT_QUOTES, 'UTF-8'),
				'options'	=> array(
					'submitForSettlement'				=> $submit_for_settlement,
					'storeInVaultOnSuccess'				=> ($store_card) ? true : false,
					'addBillingAddressToPaymentMethod'	=> ($store_card && $settings['store_billing']) ? true : false,
					'storeShippingAddressInVault'		=> ($store_card && $settings['store_shipping']) ? true : false
				),
			);
			
			// Check 3D Secure
			if (!empty($settings['three_d_secure'])) {
				$nonce_check = 'pass';
				
				try {
					$nonce_info = Braintree_PaymentMethodNonce::find($card_nonce);
					if ($nonce_info->type == 'CreditCard') {
						if (!empty($nonce_info->threeDSecureInfo) && $nonce_info->threeDSecureInfo->liabilityShiftPossible && !$nonce_info->threeDSecureInfo->liabilityShifted) {
							$nonce_check = 'fail';
						} elseif ($settings['three_d_secure'] == 'deny' && (empty($nonce_info->threeDSecureInfo) || !$nonce_info->threeDSecureInfo->liabilityShiftPossible)) {
							$nonce_check = 'fail';
						}
					}
				} catch (Exception $e) {
					$nonce_check = 'fail';
				}
				
				if ($nonce_check == 'fail') {
					echo html_entity_decode($settings['error_three_d_failure_' . $language], ENT_QUOTES, 'UTF-8');
					return;
				}
			}
			
			// Get correct currency and amount
			$transaction_currency = $this->config->get('config_currency');
			
			if (!empty($settings[$this->session->data['currency'] . '_' . $settings['server_mode'] . '_merchant_account'])) {
				$transaction_array['merchantAccountId'] = $settings[$this->session->data['currency'] . '_' . $settings['server_mode'] . '_merchant_account'];
				
				$result = Braintree_MerchantAccount::find($transaction_array['merchantAccountId']);
				
				$currency_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE `code` = '" . $this->db->escape($result->currencyIsoCode) . "'");
				if ($currency_query->num_rows) {
					$transaction_currency = $result->currencyIsoCode;
				}
			}
			
			$main_currency = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `key` = 'config_currency' AND store_id = 0")->row['value'];
			$transaction_array['amount'] = number_format(round($this->currency->convert($revised_total, $main_currency, $transaction_currency), (int)$this->currency->getDecimalPlace($transaction_currency)), 2, '.', '');
			
			// Find tax value on order
			$tax_amount = 0;
			$order_totals = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE order_id = " . (int)$order_id)->rows;
			
			foreach ($order_totals as $line_item) {
				if ($line_item['code'] == 'tax' || $line_item['code'] == 'taxcloud_integration' || $line_item['code'] == 'taxjar_integration') {
					$tax_amount = $line_item['value'];
				}
			}
			
			if ($tax_amount) {
				$transaction_array['taxAmount'] = number_format(round($this->currency->convert($tax_amount, $main_currency, $transaction_currency), (int)$this->currency->getDecimalPlace($transaction_currency)), 2, '.', '');
			}
			
			// Create transaction
			$result = Braintree_Transaction::sale($transaction_array);
			
			if (!$result->success) {
				//$result->message = str_replace('payment_method_nonce does not contain a valid payment instrument type.', '', $result->message);
				//$result->message = str_replace('Credit card must include number, payment_method_nonce, or venmo_sdk_payment_method_code.', '', $result->message);
				echo $this->overrideError($result->message);
				return;
			} else {
				$transaction = $result->transaction;
				$payment_type = $transaction->paymentInstrumentType;
				
				if ($payment_type == 'credit_card') {
					$card_token = $transaction->creditCardDetails->token;
				} elseif ($payment_type == 'paypal_account') {
					$card_token = $transaction->paypalDetails->token;
				}
			}
		} else {
			// Order is only subscription products
			if ($old_customer) {
				$result = Braintree_PaymentMethod::create(array(
					'customerId'			=> $old_customer,
					'paymentMethodNonce'	=> $card_nonce,
					'billingAddress'		=> $billing_address,
					'options'				=> array(
						'makeDefault'					=> true,
						'failOnDuplicatePaymentMethod'	=> true
					)
				));
				if (!$result->success) {
					echo $this->overrideError($result->message);
					return;
				} else {
					$card_token = $result->paymentMethod->token;
				}
			} else {
				$customer['paymentMethodNonce'] = $card_nonce;
				$result = Braintree_Customer::create($customer);
				if (!$result->success) {
					echo $this->overrideError($result->message);
					return;
				} else {
					$card_token = $result->customer->paymentMethods[0]->token;
				}
			}
		}
		
		// Subscribe customer to plans
		$plans_subscribed = array();
		
		foreach ($subscriptions as $subscription) {
			$result = Braintree_Subscription::create(array(
				'paymentMethodToken'	=> $card_token,
				'planId'				=> $subscription['id'],
				'price'					=> round($subscription['cost'], 2),
			));
			
			if (!$result->success) {
				echo $this->overrideError($result->message);
				return;
			} else {
				$plans_subscribed[] = $result;
				
				if (empty($result->subscription->transactions) && $subscription['separate']) {
					$prefix = (version_compare(VERSION, '3.0', '<')) ? '' : 'total_';
					$this->db->query("UPDATE `" . DB_PREFIX . "order` SET total = " . (float)$revised_total . " WHERE order_id = " . (int)$order_id);
					$this->db->query("UPDATE " . DB_PREFIX . "order_total SET value = " . (float)$revised_total . " WHERE order_id = " . (int)$order_id . " AND title = '" . $this->db->escape($data['text_total']) . "'");
					$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = " . (int)$order_id . ", code = 'total', title = '" . $this->db->escape($settings['text_to_be_charged_' . $language]) . " (" . $subscription['product'] . ")', value = " . (float)-$subscription['cost'] . ", sort_order = " . ((int)$this->config->get($prefix . 'total_sort_order')-1));
				}
			}
		}
		
		// Set comment data
		$strong = '<strong style="display: inline-block; width: 225px; padding: 2px 5px">';
		$comment = $strong . 'BRAINTREE TRANSACTION DATA</strong>';
		
		$verification_codes = array(
			''  => '(Unchecked)',
			'M'	=> 'Matches',
			'N'	=> 'Does Not Match',
			'U'	=> 'Not Verified',
			'I'	=> 'Not Provided',
			'A'	=> 'Not Applicable',
			'S' => 'Issuing Bank Does Not Support AVS',
			'E' => 'System Error',
		);
		
		$three_d_enrolled = array(
			'Y' => 'Yes',
			'N' => 'No',
			'U' => 'Unavailable',
			'B' => 'Bypass',
			'E' => 'RequestFailure',
		);
		
		if (!empty($transaction)) {
			$comment .= '<br><script type="text/javascript" src="view/javascript/braintree.js"></script><br>';
			$comment .= $strong . 'Charge Transaction ID:</strong>' . $transaction->id . '<br>';
			$comment .= $strong . 'Charge Transaction Status:</strong>' . $transaction->status . '<br>';
			$comment .= $strong . 'Charge Amount:</strong>' . $this->currency->format($transaction->amount, strtoupper($transaction->currencyIsoCode), 1) . '<br>';
			$comment .= $strong . 'Submitted for Settlement:</strong>' . ($transaction->status != 'authorized' ? 'Yes' : '<span>No &nbsp;</span> <a style="cursor: pointer" onclick="braintreeSubmit($(this), ' . number_format($transaction->amount, 2, '.', '') . ', \'' . $transaction->id . '\')">(Submit Now)</a>') . '<br>';
			$comment .= $strong . 'Payment Method Type:</strong>' . $payment_type . '<br>';
			
			if ($payment_type == 'credit_card') {
				$comment .= $strong . 'Card Number:</strong>**** **** **** ' . $transaction->creditCardDetails->last4 . '<br>';
				$comment .= $strong . 'Card Expiry:</strong>' . $transaction->creditCardDetails->expirationMonth . ' / ' . $transaction->creditCardDetails->expirationYear . '<br>';
				$comment .= $strong . 'Card Type:</strong>' . $transaction->creditCardDetails->cardType . '<br>';
				$comment .= $strong . 'Country of Issuance:</strong>' . $transaction->creditCardDetails->countryOfIssuance . '<br>';
				
				if (!empty($settings['three_d_secure']) && !empty($transaction->threeDSecureInfo)) {
					$three_d_result = (isset($three_d_enrolled[$transaction->threeDSecureInfo->enrolled])) ? $three_d_enrolled[$transaction->threeDSecureInfo->enrolled] : '';
					$comment .= $strong . '3D Secure Enrolled:</strong>' . $three_d_result . '<br>';
					$comment .= $strong . '3D Secure Status:</strong>' . $transaction->threeDSecureInfo->status . '<br>';
					$comment .= $strong . '3D Secure Liability Shift Possible:</strong>' . ($transaction->threeDSecureInfo->liabilityShiftPossible ? 'Yes' : 'No') . '<br>';
					$comment .= $strong . '3D Secure Liability Shifted:</strong>' . ($transaction->threeDSecureInfo->liabilityShifted ? 'Yes' : 'No') . '<br>';
				} else {
					$comment .= $strong . '3D Secure:</strong>Not checked<br>';
				}
			} elseif ($payment_type == 'paypal_account') {
				$comment .= $strong . 'PayPal E-mail:</strong>' . $transaction->paypalDetails->payerEmail . '<br>';
				$comment .= $strong . 'PayPal Payment ID:</strong>' . $transaction->paypalDetails->paymentId . '<br>';
				$comment .= $strong . 'PayPal Authorization ID:</strong>' . $transaction->paypalDetails->authorizationId . '<br>';
			}
			
			$comment .= $strong . 'CVV Response Code:</strong>' . $transaction->cvvResponseCode . ' = ' . $verification_codes[$transaction->cvvResponseCode] . '<br>';
			$comment .= $strong . 'AVS Street Response Code:</strong>' . $transaction->avsStreetAddressResponseCode . ' = ' . $verification_codes[$transaction->avsStreetAddressResponseCode] . '<br>';
			$comment .= $strong . 'AVS Postcode Response Code:</strong>' . $transaction->avsPostalCodeResponseCode . ' = ' . $verification_codes[$transaction->avsPostalCodeResponseCode] . '<br>';
			
			if (!empty($transaction->riskData)) {
				$comment .= $strong . 'Risk Data ID:</strong>' . $transaction->riskData->id . '<br>';
				$comment .= $strong . 'Risk Data Decision:</strong>' . $transaction->riskData->decision. '<br>';
			}
			
			$comment .= $strong . 'Refund:</strong><a style="cursor: pointer" onclick="braintreeRefund($(this), ' . $transaction->amount . ', \'' . $transaction->id . '\')">(Refund)</a>';
		}
		
		foreach ($plans_subscribed as $plan) {
			$comment .= '<hr />';
			$comment .= $strong . 'Subscription Plan:</strong>' . $plan->subscription->planId . '<br>';
			$comment .= $strong . 'Subscription Status:</strong>' . $plan->subscription->status . '<br>';
			
			if (!empty($plan->subscription->transactions)) {
				$subscription_transaction = $plan->subscription->transactions[0];
				$subscription_payment_type = $subscription_transaction->paymentInstrumentType;
				
				$comment .= $strong . 'Subscription Transaction ID:</strong>' . $subscription_transaction->id. '<br>';
				$comment .= $strong . 'Subscription Transaction Status:</strong>' . $subscription_transaction->status . '<br>';
				$comment .= $strong . 'Charge Amount:</strong>' . $this->currency->format($subscription_transaction->amount, strtoupper($subscription_transaction->currencyIsoCode), 1) . '<br>';
				$comment .= $strong . 'Payment Method Type:</strong>' . $subscription_payment_type . '<br>';
				
				if ($subscription_payment_type == 'credit_card') {
					$comment .= $strong . 'Card Number:</strong>**** **** **** ' . $subscription_transaction->creditCardDetails->last4 . '<br>';
					$comment .= $strong . 'Card Expiry:</strong>' . $subscription_transaction->creditCardDetails->expirationMonth . ' / ' . $subscription_transaction->creditCardDetails->expirationYear . '<br>';
					$comment .= $strong . 'Card Type:</strong>' . $subscription_transaction->creditCardDetails->cardType . '<br>';
				} elseif ($subscription_payment_type == 'paypal_account') {
					$comment .= $strong . 'PayPal E-mail:</strong>' . $subscription_transaction->paypalDetails->payerEmail . '<br>';
					$comment .= $strong . 'PayPal Payment ID:</strong>' . $subscription_transaction->paypalDetails->paymentId . '<br>';
					$comment .= $strong . 'PayPal Authorization ID:</strong>' . $subscription_transaction->paypalDetails->authorizationId . '<br>';
				}
				
				$comment .= $strong . 'CVV Response Code:</strong>' . $subscription_transaction->cvvResponseCode . ' = ' . $verification_codes[$subscription_transaction->cvvResponseCode] . '<br>';
				$comment .= $strong . 'AVS Postcode Response Code:</strong>' . $subscription_transaction->avsPostalCodeResponseCode . ' = ' . $verification_codes[$subscription_transaction->avsPostalCodeResponseCode] . '<br>';
				$comment .= $strong . 'AVS Street Response Code:</strong>' . $subscription_transaction->avsStreetAddressResponseCode . ' = ' . $verification_codes[$subscription_transaction->avsStreetAddressResponseCode] . '<br>';
			} else {
				$comment .= $strong . 'First Billing Date:</strong>' . $plan->subscription->firstBillingDate->format('Y-m-d') . '<br>';
			}
		}
		
		// Set order status
		$order_status_id = ($submit_for_settlement) ? $settings['success_status_id'] : $settings['authorize_status_id'];
		
		if (!empty($transaction)) {
			if (!empty($settings['cvv_status_id']) && $transaction->cvvResponseCode == 'N') {
				$order_status_id = $settings['cvv_status_id'];
			} elseif (!empty($settings['postcode_status_id']) && $transaction->avsPostalCodeResponseCode == 'N') {
				$order_status_id = $settings['postcode_status_id'];
			} elseif (!empty($settings['street_status_id']) && $transaction->avsStreetAddressResponseCode == 'N') {
				$order_status_id = $settings['street_status_id'];
			}
		}
		
		// Add order history
		$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = " . (int)$order_id . ", order_status_id = " . (int)$order_status_id . ", notify = 0, comment = '" . $this->db->escape($comment) . "', date_added = NOW()");
		
		/*
		if ($payment_type == 'credit_card') {
			$payment_method = $transaction->creditCardDetails->cardType . ' **** **** **** ' . $transaction->creditCardDetails->last4;
		} else {
			$payment_method = 'PayPal (' . $transaction->paypalDetails->payerEmail . ')';
		}
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET payment_method = '" . $this->db->escape($payment_method) . "' WHERE order_id = " . (int)$order_id);
		*/
		
		unset($this->session->data[$this->name . '_payment_attempts']);
		
		if (empty($settings['advanced_error_handling'])) {
			$this->load->model('checkout/order');
			$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
		} else {
			$this->session->data[$this->name . '_order_id'] = $order_id;
			$this->session->data[$this->name . '_order_status_id'] = $order_status_id;
		}
	}
	
	//==============================================================================
	// completeOrder()
	//==============================================================================
	public function completeOrder() {
		if (empty($this->session->data[$this->name . '_order_id'])) {
			echo 'No order data';
			return;
		}
		
		$order_id = $this->session->data[$this->name . '_order_id'];
		$order_status_id = $this->session->data[$this->name . '_order_status_id'];
		
		unset($this->session->data[$this->name . '_order_id']);
		unset($this->session->data[$this->name . '_order_status_id']);
		
		$this->session->data[$this->name . '_order_error'] = $order_id;
		
		$this->load->model('checkout/order');
		$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
	}
	
	//==============================================================================
	// completeWithError()
	//==============================================================================
	public function completeWithError() {
		if (empty($this->session->data[$this->name . '_order_error'])) {
			echo 'Payment was not processed';
			return;
		}
		
		$settings = $this->getSettings();
		
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = " . (int)$settings['error_status_id'] . ", date_modified = NOW() WHERE order_id = " . (int)$this->session->data[$this->name . '_order_error']);
		$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = " . (int)$this->session->data[$this->name . '_order_error'] . ", order_status_id = '" . (int)$settings['error_status_id'] . "', notify = 0, comment = 'The order could not be completed normally due to the following error:<br><br><em>" . $this->db->escape($this->request->post['error_message']) . "</em><br><br>Double-check your SMTP settings in System > Settings > Mail, and then try disabling or uninstalling any modifications that affect customer orders (i.e. the /catalog/model/checkout/order.php file). One of those is usually the cause of errors like this.', date_added = NOW()");
		
		unset($this->session->data[$this->name . '_order_error']);
	}
	
	//==============================================================================
	// webhook()
	//==============================================================================
	public function webhook() {
		$settings = $this->getSettings();
		$this->loadBraintree($settings);
		
		if (!empty($this->request->get['bt_challenge'])) {
			echo Braintree_WebhookNotification::verify($this->request->get['bt_challenge']);
			return;
		}
		
		if (!isset($this->request->get['key']) || $this->request->get['key'] != md5($this->config->get('config_encryption'))) {
			$this->log->write(strtoupper($this->name) . ' WEBHOOK ERROR: webhook URL key ' . $this->request->get['key'] . ' does not match the encryption key ' . md5($this->config->get('config_encryption')));
			return;
		}
		
		if (empty($settings['subscriptions'])) {
			$this->log->write(strtoupper($this->name) . ' WEBHOOK ERROR: subscription products are not enabled');
			return;
		}
		
		if (empty($this->request->post['bt_signature']) || empty($this->request->post['bt_payload'])) {
			echo 'The Braintree Payment Gateway webhook is working';
			return;
		}
		
		$webhook = Braintree_WebhookNotification::parse($this->request->post['bt_signature'], $this->request->post['bt_payload']);
		
		if ($webhook->kind == 'subscription_charged_successfully') {
			$braintree_transaction = $webhook->subscription->transactions[0];
			$braintree_currency = $braintree_transaction->currencyIsoCode;
			$braintree_customer = $braintree_transaction->customer;
			$braintree_customer_id = explode('_', $braintree_customer['id']);
			$braintree_billing = $braintree_transaction->billing;
			$braintree_shipping = $braintree_transaction->shipping;
			$braintree_plan = $webhook->subscription->planId;
			$braintree_plan_name = '';
			
			try {
				$plans = Braintree_Plan::all();
			} catch (Exception $e) {
				$plans = array();
			}
			foreach ($plans as $plan) {
				if ($plan->id == $braintree_plan) {
					$braintree_plan_name = $plan->name;
				}
			}
			
			$now_query = $this->db->query("SELECT NOW()");
			$last_order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE email = '" . $this->db->escape($braintree_customer['email']) . "' ORDER BY date_added DESC");
			if ($last_order_query->num_rows && (strtotime($now_query->row['NOW()']) - strtotime($last_order_query->row['date_added'])) < 600) {
				// Customer's last order is within 10 minutes, so it most likely was an immediate subscription and is already shown on their last order
				return;
			}
			
			if ($braintree_customer_id[0] == 'guest') {
				if ($settings['prevent_guests']) {
					$this->log->write(strtoupper($this->name) . ' WEBHOOK ERROR: customer with Braintree ID ' . $braintree_customer_id[0] . '_' . $braintree_customer_id[1] . ' does not exist in OpenCart, and guests are currently prevented from using subscriptions');
					return;
				}
				$data = array(
					'customer_id'		=> 0,
					'customer_group_id'	=> $this->config->get('config_customer_group_id'),
					'firstname'			=> $braintree_customer['firstName'],
					'lastname'			=> $braintree_customer['lastName'],
					'email'				=> $braintree_customer['email'],
					'telephone'			=> $braintree_customer['phone'],
					'fax'				=> $braintree_customer['fax']
				);
			} else {
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = " . (int)$braintree_customer_id[1]);
				if (!$customer_query->num_rows) {
					$this->log->write(strtoupper($this->name) . ' WEBHOOK ERROR: customer with OpenCart ID ' . $braintree_customer_id[1] . ' does not exist in OpenCart, so subscription cannot be charged');
					return;
				}
				$data = array(
					'customer_id'		=> $customer_query->row['customer_id'],
					'customer_group_id'	=> $customer_query->row['customer_group_id'],
					'firstname'			=> $customer_query->row['firstname'],
					'lastname'			=> $customer_query->row['lastname'],
					'email'				=> $customer_query->row['email'],
					'telephone'			=> $customer_query->row['telephone'],
					'fax'				=> $customer_query->row['fax']
				);
			}
			
			$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			$data['store_id'] = $this->config->get('config_store_id');
			$data['store_name'] = $this->config->get('config_name');
			$data['store_url'] = ($data['store_id']) ? $this->config->get('config_url') : HTTP_SERVER;
			
			$billing_country = (!empty($braintree_billing['countryCodeAlpha2'])) ? $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE iso_code_2 = '" . $this->db->escape($braintree_billing['countryCodeAlpha2']) . "'") : array();
			$billing_zone = (!empty($braintree_billing['region'])) ? $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE `name` = '" . $this->db->escape($braintree_billing['region']) . "' AND country_id = '" . $this->db->escape($billing_country->row['country_id']) . "'") : array();
			
			$data['payment_firstname']		= $braintree_billing['firstName'];
			$data['payment_lastname']		= $braintree_billing['lastName'];
			$data['payment_company']		= $braintree_billing['company'];
			$data['payment_company_id']		= '';
			$data['payment_tax_id']			= '';
			$data['payment_address_1']		= $braintree_billing['streetAddress'];
			$data['payment_address_2']		= $braintree_billing['extendedAddress'];
			$data['payment_city']			= $braintree_billing['locality'];
			$data['payment_postcode']		= $braintree_billing['postalCode'];
			$data['payment_zone']			= $braintree_billing['region'];
			$data['payment_zone_id']		= (isset($billing_zone->row['zone_id'])) ? $billing_zone->row['zone_id'] : '';
			$data['payment_country']		= $braintree_billing['countryName'];
			$data['payment_country_id']		= (isset($billing_country->row['country_id'])) ? $billing_country->row['country_id'] : '';
			$data['payment_address_format']	= (isset($billing_country->row['address_format'])) ? $billing_country->row['address_format'] : '';
			
			$data['payment_method']			= html_entity_decode($settings['title_' . $this->config->get('config_language')], ENT_QUOTES, 'UTF-8');
			$data['payment_code']			= $this->name;
			
			$shipping_country = (!empty($braintree_shipping['countryCodeAlpha2'])) ? $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE iso_code_2 = '" . $this->db->escape($braintree_shipping['countryCodeAlpha2']) . "'") : array();
			$shipping_zone = (!empty($braintree_shipping['region'])) ? $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE `name` = '" . $this->db->escape($braintree_shipping['region']) . "' AND country_id = '" . $this->db->escape($shipping_country->row['country_id']) . "'") : array();
			
			$data['shipping_firstname']			= $braintree_shipping['firstName'];
			$data['shipping_lastname']			= $braintree_shipping['lastName'];
			$data['shipping_company']			= $braintree_shipping['company'];
			$data['shipping_company_id']		= '';
			$data['shipping_tax_id']			= '';
			$data['shipping_address_1']			= $braintree_shipping['streetAddress'];
			$data['shipping_address_2']			= $braintree_shipping['extendedAddress'];
			$data['shipping_city']				= $braintree_shipping['locality'];
			$data['shipping_postcode']			= $braintree_shipping['postalCode'];
			$data['shipping_zone']				= $braintree_shipping['region'];
			$data['shipping_zone_id']			= (isset($shipping_zone->row['zone_id'])) ? $shipping_zone->row['zone_id'] : '';
			$data['shipping_country']			= $braintree_shipping['countryName'];
			$data['shipping_country_id']		= (isset($shipping_country->row['country_id'])) ? $shipping_country->row['country_id'] : '';
			$data['shipping_address_format']	= (isset($shipping_country->row['address_format'])) ? $shipping_country->row['address_format'] : '';
			
			$data['shipping_method']			= html_entity_decode($settings['title_' . $this->config->get('config_language')], ENT_QUOTES, 'UTF-8');
			$data['shipping_code']				= $this->name;
			
			$product_data = array();
			$total_data = array();
			
			$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE p.location = '" . $this->db->escape($braintree_plan) . "' ORDER BY p.product_id DESC");
			if ($product_query->num_rows) {
				$product = $product_query->row;
			} else {
				$product = array(
					'product_id'	=> 0,
					'name'			=> $braintree_plan_name,
					'model'			=> '',
					'subtract'		=> 0,
					'tax_class_id'	=> 0,
				);
			}
			
			$product_data[] = array(
				'product_id' => $product['product_id'],
				'name'       => $product['name'],
				'model'      => $product['model'],
				'option'     => array(),
				'download'   => array(),
				'quantity'   => 1,
				'subtract'   => $product['subtract'],
				'price'      => $braintree_transaction->amount,
				'total'      => $braintree_transaction->amount,
				'tax'        => $this->tax->getTax($braintree_transaction->amount, $product['tax_class_id']),
				'reward'     => isset($product['reward']) ? $product['reward'] : 0
			);
			
			if (version_compare(VERSION, '2.3', '<')) {
				$this->load->language('total/sub_total');
				$this->load->language('total/total');
			} else {
				$this->load->language('extension/total/sub_total');
				$this->load->language('extension/total/total');
			}
			
			$total_data[] = array(
				'code'			=> 'sub_total',
				'title'			=> $this->language->get('text_sub_total'),
				'text'			=> $this->currency->format($braintree_transaction->amount, $braintree_currency),
				'value'			=> $braintree_transaction->amount,
				'sort_order'	=> 1
			);
			
			/*
			foreach ($braintree_transaction->addOns as $addon) {
				$total_data[] = array(
					'code'			=> $addon->id,
					'title'			=> $addon->name,
					'text'			=> $this->currency->format($addon->amount, $braintree_currency),
					'value'			=> $addon->amount,
					'sort_order'	=> 2
				);
			}
			*/
			
			$total_data[] = array(
				'code'			=> 'total',
				'title'			=> $this->language->get('text_total'),
				'text'			=> $this->currency->format($braintree_transaction->amount, $braintree_currency),
				'value'			=> $braintree_transaction->amount,
				'sort_order'	=> 3
			);
			
			$data['products'] = $product_data;
			$data['vouchers'] = array();
			$data['totals'] = $total_data;
			$data['total'] = $braintree_transaction->amount;
			
			$data['comment'] = '';
			$data['affiliate_id'] = 0;
			$data['commission'] = 0;
			
			$data['marketing_id'] = 0;
			$data['tracking'] = '';
			
			$currency_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE code = '" . $braintree_currency . "'");
			$data['currency_id'] = $currency_query->row['currency_id'];
			$data['currency'] = $braintree_currency;
			$data['currency_code'] = $braintree_currency;
			$data['value'] = $this->currency->getValue($braintree_currency);
			$data['currency_value'] = $this->currency->getValue($braintree_currency);
			
			$data['language_id'] = $this->config->get('config_language_id');
			$data['ip'] = $this->request->server['REMOTE_ADDR'];
			$data['user_agent'] = (isset($this->request->server['HTTP_USER_AGENT'])) ? $this->request->server['HTTP_USER_AGENT'] : '';
			$data['accept_language'] = (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) ? $this->request->server['HTTP_ACCEPT_LANGUAGE'] : '';
			
			if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
				$data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];	
			} elseif(!empty($this->request->server['HTTP_CLIENT_IP'])) {
				$data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];	
			} else {
				$data['forwarded_ip'] = '';
			}	
			
			$this->load->model('checkout/order');
			$order_id = $this->model_checkout_order->addOrder($data);
			$order_status_id = $settings['success_status_id'];
			
			$strong = '<strong style="display: inline-block; width: 205px; padding: 2px 5px">';
			$comment = $strong . 'BRAINTREE TRANSACTION DATA</strong><br>';
			$comment .= $strong . 'Transaction Status:</strong>' . $braintree_transaction->status . '<br>';
			$comment .= $strong . 'Transaction ID:</strong>' . $braintree_transaction->id . '<br>';
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = " . (int)$order_id . ", order_status_id = '" . (int)$order_status_id . "', notify = 0, comment = '" . $this->db->escape($comment) . "', date_added = NOW()");
			
			register_shutdown_function(array($this, 'logFatalErrors'));
			$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
		}
	}
}
?>
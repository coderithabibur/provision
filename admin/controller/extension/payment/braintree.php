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
	
	public function install() {
		if (defined('DIR_STORAGE') && is_dir(DIR_STORAGE . 'vendor/braintree')) {
			rename(DIR_STORAGE . 'vendor/braintree', DIR_STORAGE . 'vendor/braintree-disabled');
		}
	}
	
	public function index() {
		$data = array(
			'type'			=> $this->type,
			'name'			=> $this->name,
			'autobackup'	=> false,
			'save_type'		=> 'keepediting',
			'permission'	=> $this->hasPermission('modify'),
		);
		
		$this->loadSettings($data);
		$this->loadBraintree();
		
		//------------------------------------------------------------------------------
		// Data Arrays
		//------------------------------------------------------------------------------
		$data['language_array'] = array($this->config->get('config_language') => '');
		$data['language_flags'] = array();
		$this->load->model('localisation/language');
		foreach ($this->model_localisation_language->getLanguages() as $language) {
			$data['language_array'][$language['code']] = $language['name'];
			$data['language_flags'][$language['code']] = (version_compare(VERSION, '2.2', '<')) ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png';
		}
		
		$data['order_status_array'] = array(0 => $data['text_ignore']);
		$this->load->model('localisation/order_status');
		foreach ($this->model_localisation_order_status->getOrderStatuses() as $order_status) {
			$data['order_status_array'][$order_status['order_status_id']] = $order_status['name'];
		}
		
		$data['customer_group_array'] = array(0 => $data['text_guests']);
		$this->load->model((version_compare(VERSION, '2.1', '<') ? 'sale' : 'customer') . '/customer_group');
		foreach ($this->{'model_' . (version_compare(VERSION, '2.1', '<') ? 'sale' : 'customer') . '_customer_group'}->getCustomerGroups() as $customer_group) {
			$data['customer_group_array'][$customer_group['customer_group_id']] = $customer_group['name'];
		}
		
		$data['geo_zone_array'] = array(0 => $data['text_everywhere_else']);
		$this->load->model('localisation/geo_zone');
		foreach ($this->model_localisation_geo_zone->getGeoZones() as $geo_zone) {
			$data['geo_zone_array'][$geo_zone['geo_zone_id']] = $geo_zone['name'];
		}
		
		$data['store_array'] = array(0 => $this->config->get('config_name'));
		$store_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "store ORDER BY name");
		foreach ($store_query->rows as $store) {
			$data['store_array'][$store['store_id']] = $store['name'];
		}
		
		$data['currency_array'] = array($this->config->get('config_currency') => '');
		$this->load->model('localisation/currency');
		foreach ($this->model_localisation_currency->getCurrencies() as $currency) {
			$data['currency_array'][$currency['code']] = $currency['code'];
		}
		
		//------------------------------------------------------------------------------
		// Extensions Settings
		//------------------------------------------------------------------------------
		$data['settings'] = array();
		
		$data['settings'][] = array(
			'type'		=> 'tabs',
			'tabs'		=> array('extension_settings', 'order_statuses', 'restrictions', 'braintree_settings', 'other_payment_methods', 'subscription_products'),
		);
		$data['settings'][] = array(
			'key'		=> 'extension_settings',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'status',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_enabled'], 0 => $data['text_disabled']),
		);
		$data['settings'][] = array(
			'key'		=> 'sort_order',
			'type'		=> 'text',
			'default'	=> 1,
			'class'		=> 'short',
		);
		$data['settings'][] = array(
			'key'		=> 'title',
			'type'		=> 'multilingual_text',
			'default'	=> 'Credit / Debit Card',
		);
		$data['settings'][] = array(
			'key'		=> 'badge_type',
			'type'		=> 'select',
			'options'	=> array(
				''				=> $data['text_none'],
				'dark'			=> $data['text_dark'],
				'light'			=> $data['text_light'],
				'wide-dark'		=> $data['text_wide_dark'],
				'wide-light'	=> $data['text_wide_light'],
			),
		);
		$data['settings'][] = array(
			'key'		=> 'button_text',
			'type'		=> 'multilingual_text',
			'default'	=> 'Confirm Order',
		);
		$data['settings'][] = array(
			'key'		=> 'button_class',
			'type'		=> 'text',
			'default'	=> 'btn btn-primary',
		);
		$data['settings'][] = array(
			'key'		=> 'button_styling',
			'type'		=> 'text',
		);
		
		// Payment Page Text
		$data['settings'][] = array(
			'key'		=> 'payment_page_text',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'text_loading',
			'type'		=> 'multilingual_text',
			'default'	=> 'Loading...',
		);
		$data['settings'][] = array(
			'key'		=> 'text_please_wait',
			'type'		=> 'multilingual_text',
			'default'	=> 'Please wait...',
		);
		
		foreach ($data['language_array'] as $code => $name) {
			if (empty($data['saved']['dropin_locale_' . $code])) {
				$explode = explode('-', $code);
				if (isset($explode[1])) {
					$data['saved']['dropin_locale_' . $code] = strtolower($explode[0]) . '_' . strtoupper($explode[1]);
				}
			}
		}
		
		$data['settings'][] = array(
			'key'		=> 'dropin_locale',
			'type'		=> 'multilingual_text',
			'default'	=> 'en_US',
		);
		$data['settings'][] = array(
			'key'		=> 'translation_overrides',
			'type'		=> 'multilingual_textarea',
		);
		$data['settings'][] = array(
			'key'		=> 'error_overrides',
			'type'		=> 'multilingual_textarea',
		);
		
		//------------------------------------------------------------------------------
		// Order Statuses
		//------------------------------------------------------------------------------
		$data['settings'][] = array(
			'key'		=> 'order_statuses',
			'type'		=> 'tab',
		);
		$data['settings'][] = array(
			'type'		=> 'html',
			'content'	=> '<div class="text-info text-center" style="padding-bottom: 5px">' . $data['help_order_statuses'] . '</div>',
		);
		$data['settings'][] = array(
			'key'		=> 'order_statuses',
			'type'		=> 'heading',
		);
		
		$processing_status_id = $this->config->get('config_processing_status');
		$processing_status_id = $processing_status_id[0];
		
		foreach (array('success', 'authorize', 'mismatch', 'error', 'cvv', 'postcode', 'street', 'refund') as $order_status) {
			if ($order_status == 'success' || $order_status == 'authorize') {
				$default_status = ($processing_status_id) ? $processing_status_id : $this->config->get('config_order_status_id');
			} elseif ($order_status == 'error') {
				$default_status = 10;
			} else {
				$default_status = 0;
			}
			
			$data['settings'][] = array(
				'key'		=> $order_status . '_status_id',
				'type'		=> 'select',
				'options'	=> $data['order_status_array'],
				'default'	=> $default_status,
			);
		}
		
		//------------------------------------------------------------------------------
		// Restrictions
		//------------------------------------------------------------------------------
		$data['settings'][] = array(
			'key'		=> 'restrictions',
			'type'		=> 'tab',
		);
		$data['settings'][] = array(
			'key'		=> 'restrictions',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'min_total',
			'type'		=> 'text',
			'attributes'=> array('style' => 'width: 50px !important'),
			'default'	=> '0.50',
		);
		$data['settings'][] = array(
			'key'		=> 'max_total',
			'type'		=> 'text',
			'attributes'=> array('style' => 'width: 50px !important'),
		);
		$data['settings'][] = array(
			'key'		=> 'stores',
			'type'		=> 'checkboxes',
			'options'	=> $data['store_array'],
			'default'	=> array_keys($data['store_array']),
		);
		$data['settings'][] = array(
			'key'		=> 'geo_zones',
			'type'		=> 'checkboxes',
			'options'	=> $data['geo_zone_array'],
			'default'	=> array_keys($data['geo_zone_array']),
		);
		$data['settings'][] = array(
			'key'		=> 'customer_groups',
			'type'		=> 'checkboxes',
			'options'	=> $data['customer_group_array'],
			'default'	=> array_keys($data['customer_group_array']),
		);
		$data['settings'][] = array(
			'key'		=> 'currencies',
			'type'		=> 'checkboxes',
			'options'	=> $data['currency_array'],
			'default'	=> array_keys($data['currency_array']),
		);
		
		//------------------------------------------------------------------------------
		// Braintree Settings
		//------------------------------------------------------------------------------
		$data['settings'][] = array(
			'key'		=> 'braintree_settings',
			'type'		=> 'tab',
		);
		$data['settings'][] = array(
			'key'		=> 'braintree_settings',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'server_mode',
			'type'		=> 'select',
			'options'	=> array('production' => $data['text_production'], 'sandbox' => $data['text_sandbox']),
		);
		$data['settings'][] = array(
			'key'		=> 'charge_mode',
			'type'		=> 'select',
			'options'	=> array('authorize' => $data['text_authorize'], 'submit' => $data['text_submit_for_settlement'], 'fraud' => $data['text_fraud_authorize']),
			'default'	=> 'submit',
		);
		$data['settings'][] = array(
			'key'		=> 'attempts',
			'type'		=> 'text',
			'default'	=> '5',
			'class'		=> 'short',
		);
		$data['settings'][] = array(
			'key'		=> 'attempts_exceeded',
			'type'		=> 'multilingual_text',
			'default'	=> 'Your card has been declined.',
		);
		$data['settings'][] = array(
			'key'		=> 'store_payment_method',
			'type'		=> 'select',
			'options'	=> array('never' => $data['text_never'], 'choice' => $data['text_customers_choice'], 'always' => $data['text_always']),
		);
		$data['settings'][] = array(
			'key'		=> 'allow_stored_cards',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_yes'], 0 => $data['text_no']),
			'default'	=> 0,
		);
		$data['settings'][] = array(
			'key'		=> 'store_billing',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_yes'], 0 => $data['text_no']),
			'default'	=> 0,
		);
		$data['settings'][] = array(
			'key'		=> 'store_shipping',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_yes'], 0 => $data['text_no']),
			'default'	=> 0,
		);
		$data['settings'][] = array(
			'key'		=> 'advanced_error_handling',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_enabled'], 0 => $data['text_disabled']),
			'default'	=> 1,
		);
		
		// API Keys
		foreach (array('production', 'sandbox') as $server_mode) {
			$data['settings'][] = array(
				'key'		=> $server_mode . '_api_keys',
				'type'		=> 'heading',
			);
			$data['settings'][] = array(
				'title'		=> '',
				'type'		=> 'html',
				'content'	=> '<div class="text-info">' . $data['help_' . $server_mode . '_api_keys'] . '</div>',
			);
			$data['settings'][] = array(
				'key'		=> $server_mode . '_merchant_id',
				'type'		=> 'text',
				'attributes'=> array('onchange' => '$(this).val($(this).val().trim())'),
			);
			$data['settings'][] = array(
				'key'		=> $server_mode . '_public_key',
				'type'		=> 'text',
				'attributes'=> array('onchange' => '$(this).val($(this).val().trim())'),
			);
			$data['settings'][] = array(
				'key'		=> $server_mode . '_private_key',
				'type'		=> 'text',
				'attributes'=> array('onchange' => '$(this).val($(this).val().trim())'),
			);
			$data['settings'][] = array(
				'title'		=> '',
				'type'		=> 'html',
				'content'	=> '<div class="well" style="margin: 0">' . $data['help_merchant_account_id'] . '</div>',
			);
			foreach ($data['currency_array'] as $currency) {
				$data['settings'][] = array(
					'key'		=> $currency . '_' . $server_mode . '_merchant_account',
					'title'		=> $currency . $data['text_merchant_account_id'],
					'type'		=> 'text',
					'attributes'=> array('onchange' => '$(this).val($(this).val().trim())'),
				);
			}
		}
		
		//------------------------------------------------------------------------------
		// Other Payment Methods
		//------------------------------------------------------------------------------
		$data['settings'][] = array(
			'key'		=> 'other_payment_methods',
			'type'		=> 'tab',
		);
		
		// Standard-specific
		$data['settings'][] = array(
			'type'		=> 'html',
			'content'	=> '<div class="text-info text-center" style="padding-bottom: 5px">' . $data['help_other_payment_methods'] . '</div>',
		);
		
		// 3D Secure
		$data['settings'][] = array(
			'key'		=> 'three_d_secure',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'three_d_secure',
			'type'		=> 'select',
			'options'	=> array('' => $data['text_no'], 'allow' => $data['text_yes_allow_ineligible_cards'], 'deny' => $data['text_yes_deny_ineligible_cards']),
			'default'	=> '',
		);
		$data['settings'][] = array(
			'key'		=> 'error_three_d_failure',
			'type'		=> 'multilingual_text',
			'default'	=> 'Your card has failed the 3D Secure check. Please use a different card for payment.',
			'class'		=> 'long',
		);
		
		// PayPal
		$data['settings'][] = array(
			'key'		=> 'paypal',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'paypal',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_enabled'], 0 => $data['text_disabled']),
			'default'	=> 0,
		);
		
		//------------------------------------------------------------------------------
		// Subscription Products
		//------------------------------------------------------------------------------
		$data['settings'][] = array(
			'key'		=> 'subscription_products',
			'type'		=> 'tab',
		);
		$data['settings'][] = array(
			'type'		=> 'html',
			'content'	=> '<div class="text-info text-center" style="padding-bottom: 5px">' . $data['help_subscription_products'] . '</div>',
		);
		$data['settings'][] = array(
			'key'		=> 'subscription_products',
			'type'		=> 'heading',
		);
		$data['settings'][] = array(
			'key'		=> 'subscriptions',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_yes'], 0 => $data['text_no']),
			'default'	=> 0,
		);
		
		unset($data['saved']['webhook_url']);
		$data['settings'][] = array(
			'key'		=> 'webhook_url',
			'type'		=> 'text',
			'default'	=> str_replace('http:', 'https:', HTTP_CATALOG) . 'index.php?route=extension/' . $this->type . '/' . $this->name . '/webhook&key=' . md5($this->config->get('config_encryption')),
			'attributes'=> array('readonly' => 'readonly', 'onclick' => 'this.select()', 'style' => 'background: #EEE; cursor: pointer; font-family: monospace; width: 100% !important;'),
			'after'		=> $data['help_webhook_url'],
		);
		
		$data['settings'][] = array(
			'key'		=> 'text_to_be_charged',
			'type'		=> 'multilingual_text',
			'default'	=> 'To Be Charged Later',
		);
		$data['settings'][] = array(
			'key'		=> 'prevent_guests',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_yes'], 0 => $data['text_no']),
			'default'	=> 0,
		);
		$data['settings'][] = array(
			'key'		=> 'text_customer_required',
			'type'		=> 'multilingual_text',
			'default'	=> 'Error: You must create a customer account to purchase a subscription product.',
			'class'		=> 'long',
		);
		$data['settings'][] = array(
			'key'		=> 'subscription_shipping',
			'type'		=> 'select',
			'options'	=> array(1 => $data['text_yes'], 0 => $data['text_no']),
			'default'	=> 0,
		);
		
		// Current Subscription Products
		$data['settings'][] = array(
			'key'		=> 'current_subscriptions',
			'type'		=> 'heading',
		);
		
		$data['subscription_products'] = array();
			
		try {
			$plans = Braintree_Plan::all();
		} catch (Exception $e) {
			$plans = array();
		}
		
		foreach ($plans as $plan) {
			$product_query = $this->db->query("SELECT *, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = " . (int)$this->config->get('config_customer_group_id') . " AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = " . (int)$this->config->get('config_language_id') . ") WHERE p.location = '" . $this->db->escape($plan->id) . "'");
			foreach ($product_query->rows as $product) {
				$data['subscription_products'][] = array(
					'product_id'	=> $product['product_id'],
					'name'			=> $product['name'],
					'price'			=> $this->currency->format($product['special'] ? $product['special'] : $product['price'], $this->config->get('config_currency')),
					'location'		=> $product['location'],
					'plan'			=> $plan->name,
					'interval'		=> $plan->billingFrequency . ($plan->billingFrequency > 1 ? ' months' : ' month'),
					'charge'		=> $this->currency->format($plan->price, $plan->currencyIsoCode)
				);
			}
		}
		
		$subscription_products_table = '
			<br />
			<table class="table table-stripe table-bordered">
				<thead>
					<tr>
						<td colspan="3" style="text-align: center">' . $data['text_thead_opencart'] . '</td>
						<td colspan="3" style="text-align: center">' . $data['text_thead_braintree'] . '</td>
					</tr>
					<tr>
						<td class="left">' . $data['text_product_name'] . '</td>
						<td class="left">' . $data['text_product_price'] . '</td>
						<td class="left">' . $data['text_location_plan_id'] . '</td>
						<td class="left">' . $data['text_plan_name'] . '</td>
						<td class="left">' . $data['text_plan_interval'] . '</td>
						<td class="left">' . $data['text_plan_charge'] . '</td>
					</tr>
				</thead>
		';
		if (empty($data['subscription_products'])) {
			$subscription_products_table .= '
				<tr><td class="center" colspan="6">' . $data['text_no_subscription_products'] . '</td></tr>
				<tr><td class="center" colspan="6">' . $data['text_create_one_by_entering'] . '</td></tr>
			';
		}
		foreach ($data['subscription_products'] as $product) {
			$highlight = ($product['price'] == $product['charge']) ? '' : 'style="background: #FFD"';
			$subscription_products_table .= '
				<tr>
					<td class="left"><a target="_blank" href="index.php?route=catalog/product/edit&amp;product_id=' . $product['product_id'] . '&amp;token=' . $data['token'] . '">' . $product['name'] . '</a></td>
					<td class="left" ' . $highlight . '>' . $product['price'] . '</td>
					<td class="left">' . $product['location'] . '</td>
					<td class="left">' . $product['plan'] . '</td>
					<td class="left">' . $product['interval'] . '</td>
					<td class="left" ' . $highlight . '>' . $product['charge'] . '</td>
				</tr>
			';
		}
		$subscription_products_table .= '</table>';
		
		$data['settings'][] = array(
			'title'		=> str_replace('[server_mode]', ucwords(isset($data['saved']['server_mode']) ? $data['saved']['server_mode'] : 'sandbox'), $data['entry_current_subscriptions']),
			'type'		=> 'html',
			'content'	=> $subscription_products_table,
		);
		
		//------------------------------------------------------------------------------
		// end settings
		//------------------------------------------------------------------------------
		
		$this->document->setTitle($data['heading_title']);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$template_file = DIR_TEMPLATE . 'extension/' . $this->type . '/' . $this->name . '.twig';
		
		if (is_file($template_file)) {
			extract($data);
			
			ob_start();
			require(class_exists('VQMod') ? VQMod::modCheck(modification($template_file)) : modification($template_file));
			$output = ob_get_clean();
			
			if (version_compare(VERSION, '3.0', '>=')) {
				$output = str_replace(array('&token=', '&amp;token='), '&user_token=', $output);
			}
			
			echo $output;
		} else {
			echo 'Error loading template file';
		}
	}
	
	//==============================================================================
	// Helper functions
	//==============================================================================
	private function hasPermission($permission) {
		return ($this->user->hasPermission($permission, $this->type . '/' . $this->name) || $this->user->hasPermission($permission, 'extension/' . $this->type . '/' . $this->name));
	}
	
	private function loadLanguage($path) {
		$_ = array();
		$language = array();
		$admin_language = (version_compare(VERSION, '2.2', '<')) ? $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE `code` = '" . $this->db->escape($this->config->get('config_admin_language')) . "'")->row['directory'] : $this->config->get('config_admin_language');
		foreach (array('english', 'en-gb', $admin_language) as $directory) {
			$file = DIR_LANGUAGE . $directory . '/' . $directory . '.php';
			if (file_exists($file)) require($file);
			$file = DIR_LANGUAGE . $directory . '/default.php';
			if (file_exists($file)) require($file);
			$file = DIR_LANGUAGE . $directory . '/' . $path . '.php';
			if (file_exists($file)) require($file);
			$file = DIR_LANGUAGE . $directory . '/extension/' . $path . '.php';
			if (file_exists($file)) require($file);
			$language = array_merge($language, $_);
		}
		return $language;
	}
	
	private function getTableRowNumbers(&$data, $table, $sorting) {
		$groups = array();
		$rules = array();
		
		foreach ($data['saved'] as $key => $setting) {
			if (preg_match('/' . $table . '_(\d+)_' . $sorting . '/', $key, $matches)) {
				$groups[$setting][] = $matches[1];
			}
			if (preg_match('/' . $table . '_(\d+)_rule_(\d+)_type/', $key, $matches)) {
				$rules[$matches[1]][] = $matches[2];
			}
		}
		
		if (empty($groups)) $groups = array('' => array('1'));
		ksort($groups, defined('SORT_NATURAL') ? SORT_NATURAL : SORT_REGULAR);
		
		foreach ($rules as $key => $rule) {
			ksort($rules[$key], defined('SORT_NATURAL') ? SORT_NATURAL : SORT_REGULAR);
		}
		
		$data['used_rows'][$table] = array();
		$rows = array();
		foreach ($groups as $group) {
			foreach ($group as $num) {
				$data['used_rows'][preg_replace('/module_(\d+)_/', '', $table)][] = $num;
				$rows[$num] = (empty($rules[$num])) ? array() : $rules[$num];
			}
		}
		sort($data['used_rows'][$table]);
		
		return $rows;
	}
	
	//==============================================================================
	// Setting functions
	//==============================================================================
	private $encryption_key = '';
	
	public function loadSettings(&$data) {
		$backup_type = (empty($data)) ? 'manual' : 'auto';
		if ($backup_type == 'manual' && !$this->hasPermission('modify')) {
			return;
		}
		
		$this->cache->delete($this->name);
		unset($this->session->data[$this->name]);
		$code = (version_compare(VERSION, '3.0', '<') ? '' : $this->type . '_') . $this->name;
		
		// Set exit URL
		$data['token'] = $this->session->data[version_compare(VERSION, '3.0', '<') ? 'token' : 'user_token'];
		$data['exit'] = $this->url->link((version_compare(VERSION, '3.0', '<') ? 'extension' : 'marketplace') . '/' . (version_compare(VERSION, '2.3', '<') ? '' : 'extension&type=') . $this->type . '&token=' . $data['token'], '', 'SSL');
		
		// Load saved settings
		$data['saved'] = array();
		$settings_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($code) . "' ORDER BY `key` ASC");
		
		foreach ($settings_query->rows as $setting) {
			$key = str_replace($code . '_', '', $setting['key']);
			$value = $setting['value'];
			if ($setting['serialized']) {
				$value = (version_compare(VERSION, '2.1', '<')) ? unserialize($setting['value']) : json_decode($setting['value'], true);
			}
			
			$data['saved'][$key] = $value;
			
			if (is_array($value)) {
				foreach ($value as $num => $value_array) {
					foreach ($value_array as $k => $v) {
						$data['saved'][$key . '_' . $num . '_' . $k] = $v;
					}
				}
			}
		}
		
		// Load language and run standard checks
		$data = array_merge($data, $this->loadLanguage($this->type . '/' . $this->name));
		
		if (ini_get('max_input_vars') && ((ini_get('max_input_vars') - count($data['saved'])) < 50)) {
			$data['warning'] = $data['standard_max_input_vars'];
		}
		
		// Modify files according to OpenCart version
		if ($this->type == 'total' && version_compare(VERSION, '2.2', '<')) {
			file_put_contents(DIR_CATALOG . 'model/' . $this->type . '/' . $this->name . '.php', str_replace('public function getTotal($total) {', 'public function getTotal(&$total_data, &$order_total, &$taxes) {' . "\n\t\t" . '$total = array("totals" => &$total_data, "total" => &$order_total, "taxes" => &$taxes);', file_get_contents(DIR_CATALOG . 'model/' . $this->type . '/' . $this->name . '.php')));
		}
		
		if (version_compare(VERSION, '2.3', '>=')) {
			$filepaths = array(
				DIR_APPLICATION . 'controller/' . $this->type . '/' . $this->name . '.php',
				DIR_CATALOG . 'controller/' . $this->type . '/' . $this->name . '.php',
				DIR_CATALOG . 'model/' . $this->type . '/' . $this->name . '.php',
			);
			foreach ($filepaths as $filepath) {
				if (file_exists($filepath)) {
					rename($filepath, str_replace('.php', '.php-OLD', $filepath));
				}
			}
		}
		
		// Set save type and skip auto-backup if not needed
		if (!empty($data['saved']['autosave'])) {
			$data['save_type'] = 'auto';
		}
		
		if ($backup_type == 'auto' && empty($data['autobackup'])) {
			return;
		}
		
		// Create settings auto-backup file
		$manual_filepath = DIR_LOGS . $this->name . $this->encryption_key . '.backup';
		$auto_filepath = DIR_LOGS . $this->name . $this->encryption_key . '.autobackup';
		$filepath = ($backup_type == 'auto') ? $auto_filepath : $manual_filepath;
		if (file_exists($filepath)) unlink($filepath);
		
		file_put_contents($filepath, 'SETTING	NUMBER	SUB-SETTING	SUB-NUMBER	SUB-SUB-SETTING	VALUE' . "\n", FILE_APPEND|LOCK_EX);
		
		foreach ($data['saved'] as $key => $value) {
			if (is_array($value)) continue;
			
			$parts = explode('|', preg_replace(array('/_(\d+)_/', '/_(\d+)/'), array('|$1|', '|$1'), $key));
			
			$line = '';
			for ($i = 0; $i < 5; $i++) {
				$line .= (isset($parts[$i]) ? $parts[$i] : '') . "\t";
			}
			$line .= str_replace(array("\t", "\n"), array('    ', '\n'), $value) . "\n";
			
			file_put_contents($filepath, $line, FILE_APPEND|LOCK_EX);
		}
		
		$data['autobackup_time'] = date('Y-M-d @ g:i a');
		$data['backup_time'] = (file_exists($manual_filepath)) ? date('Y-M-d @ g:i a', filemtime($manual_filepath)) : '';
		
		if ($backup_type == 'manual') {
			echo $data['autobackup_time'];
		}
	}
	
	public function saveSettings() {
		if (!$this->hasPermission('modify')) {
			echo 'PermissionError';
			return;
		}
		
		$this->cache->delete($this->name);
		unset($this->session->data[$this->name]);
		$code = (version_compare(VERSION, '3.0', '<') ? '' : $this->type . '_') . $this->name;
		
		if ($this->request->get['saving'] == 'manual') {
			$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($code) . "' AND `key` != '" . $this->db->escape($this->name . '_module') . "'");
		}
		
		$module_id = 0;
		$modules = array();
		$module_instance = false;
		
		foreach ($this->request->post as $key => $value) {
			if (strpos($key, 'module_') === 0) {
				$parts = explode('_', $key, 3);
				$module_id = $parts[1];
				$modules[$parts[1]][$parts[2]] = $value;
				if ($parts[2] == 'module_id') $module_instance = true;
			} else {
				$key = (version_compare(VERSION, '3.0', '<') ? '' : $this->type . '_') . $this->name . '_' . $key;
				
				if ($this->request->get['saving'] == 'auto') {
					$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '" . $this->db->escape($key) . "'");
				}
				
				$this->db->query("
					INSERT INTO " . DB_PREFIX . "setting SET
					`store_id` = 0,
					`code` = '" . $this->db->escape($code) . "',
					`key` = '" . $this->db->escape($key) . "',
					`value` = '" . $this->db->escape(stripslashes(is_array($value) ? implode(';', $value) : $value)) . "',
					`serialized` = 0
				");
			}
		}
		
		foreach ($modules as $module_id => $module) {
			if (!$module_id) {
				$this->db->query("
					INSERT INTO " . DB_PREFIX . "module SET
					`name` = '" . $this->db->escape($module['name']) . "',
					`code` = '" . $this->db->escape($this->name) . "',
					`setting` = ''
				");
				$module_id = $this->db->getLastId();
				$module['module_id'] = $module_id;
			}
			$module_settings = (version_compare(VERSION, '2.1', '<')) ? serialize($module) : json_encode($module);
			$this->db->query("
				UPDATE " . DB_PREFIX . "module SET
				`name` = '" . $this->db->escape($module['name']) . "',
				`code` = '" . $this->db->escape($this->name) . "',
				`setting` = '" . $this->db->escape($module_settings) . "'
				WHERE module_id = " . (int)$module_id . "
			");
		}
	}
	
	public function deleteSetting() {
		if (!$this->hasPermission('modify')) {
			echo 'PermissionError';
			return;
		}
		$prefix = (version_compare(VERSION, '3.0', '<')) ? '' : $this->type . '_';
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($prefix . $this->name) . "' AND `key` = '" . $this->db->escape($prefix . $this->name . '_' . str_replace('[]', '', $this->request->get['setting'])) . "'");
	}
	
	//==============================================================================
	// loadBraintree()
	//==============================================================================
	private function loadBraintree() {
		$data = array('autobackup' => false);
		$this->loadSettings($data);
		$settings = $data['saved'];
		
		require_once(DIR_SYSTEM . 'library/braintree/lib/Braintree.php');

		if (!empty($settings['server_mode']) &&
			!empty($settings[$settings['server_mode'] . '_merchant_id']) &&
			!empty($settings[$settings['server_mode'] . '_public_key']) &&
			!empty($settings[$settings['server_mode'] . '_private_key'])
		) {
			Braintree_Configuration::environment($settings['server_mode']);
			Braintree_Configuration::merchantId($settings[$settings['server_mode'] . '_merchant_id']);
			Braintree_Configuration::publicKey($settings[$settings['server_mode'] . '_public_key']);
			Braintree_Configuration::privateKey($settings[$settings['server_mode'] . '_private_key']);
		}
		
		return $settings;
	}
	
	//==============================================================================
	// submit()
	//==============================================================================
	public function submit() {
		if (!$this->hasPermission('modify')) {
			echo 'PermissionError';
			return;
		}
		
		$settings = $this->loadBraintree();
		
		$result = Braintree_Transaction::submitForSettlement($this->request->get['charge_id'], $this->request->get['amount']);
		
		if (!$result->success) {
			$this->log->write(strtoupper($this->name) . ' SUBMIT ERROR: ' . $result->message);
			echo 'Error: ' . $result->message;
		} else {
			$order_id = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_history WHERE `comment` LIKE '%" . $this->db->escape($this->request->get['charge_id']) . "%'")->row['order_id'];
			$order_info = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = " . (int)$order_id)->row;
			$order_status_id = ($settings['success_status_id']) ? $settings['success_status_id'] : $order_info['order_status_id'];
			
			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = " . (int)$order_status_id . ", date_modified = NOW() WHERE order_id = " . (int)$order_id);
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = " . (int)$order_id . ", order_status_id = " . (int)$order_status_id . ", notify = 0, `comment` = 'Submitted for Settlement', date_added = NOW()");
			$this->db->query("UPDATE " . DB_PREFIX . "order_history SET `comment` = REPLACE(`comment`, '<span>No &nbsp;</span> <a', 'Yes (" . number_format($this->request->get['amount'], 2, '.', '') . " submitted) <a style=\"display: none\"') WHERE `comment` LIKE '%submit($(this), %, \'" . $this->db->escape($this->request->get['charge_id']) . "\')%'");
		}
	}
	
	//==============================================================================
	// refund()
	//==============================================================================
	public function refund() {
		if (!$this->hasPermission('modify')) {
			echo 'PermissionError';
			return;
		}
		
		$settings = $this->loadBraintree();
		
		$result = Braintree_Transaction::void($this->request->get['charge_id']);
		if ($result->success) {
			$voided = true;
		} else {
			$result = Braintree_Transaction::refund($this->request->get['charge_id'], $this->request->get['amount']);
			if (!$result->success) {
				$this->log->write(strtoupper($this->name) . ' REFUND ERROR: ' . $result->message);
				echo 'Error: ' . $result->message;
			}
		}
		
		if ($result->success) {
			$order_id = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_history WHERE `comment` LIKE '%" . $this->db->escape($this->request->get['charge_id']) . "%'")->row['order_id'];
			$order_info = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = " . (int)$order_id)->row;
			
			$order_status_id = ($settings['refund_status_id']) ? $settings['refund_status_id'] : $order_info['order_status_id'];
			$comment = (!empty($voided)) ? 'Payment voided in Braintree' : $this->currency->format($this->request->get['amount'], $result->transaction->currencyIsoCode, 1) . ' refunded in Braintree';
			
			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = " . (int)$order_status_id . ", date_modified = NOW() WHERE order_id = " . (int)$order_id);
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = " . (int)$order_id . ", order_status_id = " . (int)$order_status_id . ", notify = 0, `comment` = '" . $comment . "', date_added = NOW()");
		}
	}
}
?>
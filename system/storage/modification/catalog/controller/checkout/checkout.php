<?php
class ControllerCheckoutCheckout extends Controller {
	
	private function getProductCost($product_id) {
		$q = $this->db->query("SELECT product_cost FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		return $q->num_rows ? (float)$q->row['product_cost'] : 0.0;
	}

	public function index() {
		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$this->response->redirect($this->url->link('checkout/cart'));
		}
		 
		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts(); 

			    $this->load->model('extension/module/google_ecommerce');
			    $data['ecommerce_checkout_script'] =  $this->model_extension_module_google_ecommerce->build_begin_checkout();
			
		$total_product_cost = 0.0;
		$cost_map           = array(); 

		foreach ($products as $p) {
			$pid  = (int)$p['product_id'];
			$qty  = (int)$p['quantity'];
			$unit = $this->getProductCost($pid);

			// key by product_id
			$cost_map[$pid] = $unit;

			// key by cart key too (Dreamvention QC uses this in the JSON model)
			$cart_key = !empty($p['cart_id']) ? $p['cart_id'] : (!empty($p['key']) ? $p['key'] : $pid);
			$cost_map[$cart_key] = $unit;

			$total_product_cost += ($unit * $qty);
		}

		$data['total_product_cost_raw'] = $total_product_cost;
		$data['total_product_cost']     = $this->currency->format($total_product_cost, $this->session->data['currency']);
		$data['product_cost_map']       = $cost_map;                   // stays numeric; format in JS if needed
		$data['order_currency']         = $this->session->data['currency'];

		// Product Costing End

 
		  // --------------------------------------------------
		 // GA customer block (works for logged & guest)
		// --------------------------------------------------

		$this->load->model('account/address');

		$ga_customer = array(
			'first_name' => '',
			'last_name'  => '',
			'email'      => '',
			'phone'      => '',
			'address'    => array(
				'street_address' => '',
				'city'           => '',
				'state'          => '',
				'postal_code'    => '',
				'country'        => ''
			)
		);

		if ($this->customer->isLogged()) {
			// base profile
			$ga_customer['first_name'] = $this->customer->getFirstName();
			$ga_customer['last_name']  = $this->customer->getLastName();
			$ga_customer['email']      = $this->customer->getEmail();
			$ga_customer['phone']      = $this->customer->getTelephone();

			// prefer QC-prepared payment_address; fallback to default address
			$pa = isset($this->session->data['payment_address']) ? $this->session->data['payment_address'] : array();
			if (!empty($pa) && !empty($pa['address_1'])) {
				$ga_customer['address']['street_address'] = isset($pa['address_1']) ? $pa['address_1'] : '';
				$ga_customer['address']['city']           = isset($pa['city']) ? $pa['city'] : '';
				$ga_customer['address']['state']          = isset($pa['zone']) ? $pa['zone'] : '';
				$ga_customer['address']['postal_code']    = isset($pa['postcode']) ? $pa['postcode'] : '';
				$ga_customer['address']['country']        = isset($pa['iso_code_2']) ? $pa['iso_code_2'] : '';
			} else {
				$addr_id = $this->customer->getAddressId();
				if ($addr_id) {
					$addr = $this->model_account_address->getAddress($addr_id);
					if ($addr) {
						$ga_customer['address']['street_address'] = isset($addr['address_1']) ? $addr['address_1'] : '';
						$ga_customer['address']['city']           = isset($addr['city']) ? $addr['city'] : '';
						$ga_customer['address']['state']          = isset($addr['zone']) ? $addr['zone'] : '';
						$ga_customer['address']['postal_code']    = isset($addr['postcode']) ? $addr['postcode'] : '';
						$ga_customer['address']['country']        = isset($addr['iso_code_2']) ? $addr['iso_code_2'] : '';
					}
				}
			}
		} else {
			// guest (QC initialize() has already populated session)
			$pa = isset($this->session->data['payment_address']) ? $this->session->data['payment_address'] : array();
			$ga_customer['first_name'] = isset($pa['firstname']) ? $pa['firstname'] : '';
			$ga_customer['last_name']  = isset($pa['lastname'])  ? $pa['lastname']  : '';
			$ga_customer['email']      = isset($pa['email'])     ? $pa['email']     : '';
			$ga_customer['phone']      = isset($pa['telephone']) ? $pa['telephone'] : '';

			$ga_customer['address']['street_address'] = isset($pa['address_1']) ? $pa['address_1'] : '';
			$ga_customer['address']['city']           = isset($pa['city']) ? $pa['city'] : '';
			$ga_customer['address']['state']          = isset($pa['zone']) ? $pa['zone'] : '';
			$ga_customer['address']['postal_code']    = isset($pa['postcode']) ? $pa['postcode'] : '';
			$ga_customer['address']['country']        = isset($pa['iso_code_2']) ? $pa['iso_code_2'] : '';
		}

		// expose individual fields (used by hidden inputs in twig)
		$data['customer_firstname']   = $ga_customer['first_name'];
		$data['customer_lastname']    = $ga_customer['last_name'];
		$data['customer_email']       = $ga_customer['email'];
		$data['customer_phone']       = $ga_customer['phone'];
		$data['billing_address_1']    = $ga_customer['address']['street_address'];
		$data['billing_city']         = $ga_customer['address']['city'];
		$data['billing_state']        = $ga_customer['address']['state'];
		$data['billing_postcode']     = $ga_customer['address']['postal_code'];
		$data['billing_country_iso2'] = $ga_customer['address']['country'];

		$data['ga_customer'] = $ga_customer;

		  // --------------------------------------------------
		 // GA customer block (works for logged & guest)
		// --------------------------------------------------

		$this->load->language('checkout/checkout');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		// Required by klarna
		if ($this->config->get('klarna_account') || $this->config->get('klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_checkout_option'] = $this->language->get('text_checkout_option');
		$data['text_checkout_account'] = $this->language->get('text_checkout_account');
		$data['text_checkout_payment_address'] = $this->language->get('text_checkout_payment_address');
		$data['text_checkout_shipping_address'] = $this->language->get('text_checkout_shipping_address');
		$data['text_checkout_shipping_method'] = $this->language->get('text_checkout_shipping_method');
		$data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();

		if (isset($this->session->data['account'])) {
			$data['account'] = $this->session->data['account'];
		} else {
			$data['account'] = '';
		}

		$data['shipping_required'] = $this->cart->hasShipping();

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');

        if($this->config->get('d_quickcheckout_status')){
            $data['d_quickcheckout'] = $this->load->controller('extension/module/d_quickcheckout');
        }
        
		$data['header'] = $this->load->controller('common/header');

		
            // a_vqmod_d_quickcheckout.xml
            if($this->config->get('d_quickcheckout_status')){
                $template = 'd_quickcheckout';
            }else{
                $template = 'checkout';
            }
            
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/'.$template.'.tpl')) {
                $template = $this->config->get('config_template') . '/template/checkout/'.$template.'.tpl';
            } else {
                $template = 'default/template/checkout/'.$template.'.tpl';
            }
            $this->response->setOutput($this->load->view($template, $data));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
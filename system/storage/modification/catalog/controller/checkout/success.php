<?php
class ControllerCheckoutSuccess extends Controller {
	private function getProductCost($product_id) {
		$q = $this->db->query("SELECT product_cost FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		return $q->num_rows ? (float)$q->row['product_cost'] : 0.0;
	}

	public function index() {
		$this->load->language('checkout/success');

			
			if (isset($this->session->data['order_id'])) {
		    	$order_id = $this->session->data['order_id'];
			    $this->load->model('extension/module/google_ecommerce');
			    $data['ecommerce_tracking_script'] =  $this->model_extension_module_google_ecommerce->build_ecommerce($order_id);
			} else {
			    $data['ecommerce_tracking_script'] = '';
			}
			

		if (isset($this->session->data['order_id'])) {
            $order_id = (int)$this->session->data['order_id'];

            // we must load the order model before using it
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($order_id);

            // defaults
            $data['order_id']        = $order_id;
            $data['order_currency']  = isset($this->session->data['currency']) ? $this->session->data['currency'] : '';
            $data['order_total']     = 0.0;
            $data['shipping_total']  = 0.0;

            if ($order_info) {
                // fill from order
                $data['order_total']       = (float)$order_info['total'];
                $data['order_currency']    = $order_info['currency_code'];

                $data['customer_firstname']   = $order_info['firstname'];
                $data['customer_lastname']    = $order_info['lastname'];
                $data['customer_email']       = $order_info['email'];
                $data['customer_phone']       = $order_info['telephone'];
                $data['billing_address_1']    = $order_info['payment_address_1'];
                $data['billing_city']         = $order_info['payment_city'];
                $data['billing_state']        = $order_info['payment_zone'];
                $data['billing_postcode']     = $order_info['payment_postcode'];
                $data['billing_country_iso2'] = $order_info['payment_iso_code_2'];

                // shipping line from order_total
                $qShip = $this->db->query("SELECT value FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' AND code = 'shipping' LIMIT 1");
                if ($qShip->num_rows) {
                    $data['shipping_total'] = (float)$qShip->row['value'];
                }

                // ---------- Build GA4 purchase payload (no LocalStorage) ----------
                $items               = array();
                $total_product_cost  = 0.0;
                $total_gross_profit  = 0.0;
                $country_suffix      = '_au';

                $op = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
                foreach ($op->rows as $row) {
                    $pid      = (int)$row['product_id'];
                    $name     = $row['name'];
                    $model    = $row['model'];
                    $qty      = (int)$row['quantity'];
                    $price    = (float)$row['price']; 
                    $unitCost = $this->getProductCost($pid);

                    $line_cost   = $unitCost * $qty;
                    $line_profit = ($price - $unitCost) * $qty;

                    $total_product_cost += $line_cost;
                    $total_gross_profit += $line_profit;

                    $items[] = array(
                        'item_id'      => (string)$pid . $country_suffix,
                        'item_name'    => $name,
                        'item_sku'     => $model,
                        'price'        => $price,
                        'quantity'     => $qty,
                        'product_cost' => $line_cost,
                        'gross_profit' => $line_profit
                    );
                }

                $data['ga4_purchase'] = array(
                    'transaction_id'     => (string)$order_id,
                    'value'              => (float)$data['order_total'],
                    'shipping'           => (float)$data['shipping_total'],
                    'currency'           => $data['order_currency'],
                    'total_product_cost' => $total_product_cost,
                    'total_gross_profit' => $total_gross_profit,
                    'items'              => $items
                );
                $data['ga4_purchase_json'] = json_encode($data['ga4_purchase']);
                // ---------- /GA4 payload ----------
            }

			
			$this->cart->clear();

			// Add to activity log
			$this->load->model('account/activity');
			$getProductDetails = $this->model_account_activity->getOrderProducts($this->session->data['order_id']);
			$getProductDetailsDate = $this->model_account_activity->getOrderProductsDate($this->session->data['order_id']);
			
			
			$order_Date = strtotime($getProductDetailsDate['date_added']);
			$original_date = date('Y-m-d', $order_Date);
			
			foreach($getProductDetails as $getProductIds){
				$newArray[] = $getProductIds['product_id'];
			}
			$getProductsAll = $this->model_account_activity->getProducts($newArray);
			$num_of_days = $getProductsAll['max(delivery_days)'];
			if($num_of_days > 0){
				$total_days = $num_of_days;
			}else{
				$total_days = 5;
				
			}
			$getProductDetails= $this->model_account_activity->getProducts($newArray);

			
			
			$Finaldate = date('Y-m-d', strtotime('+'.$total_days.' days', strtotime($original_date)));
			
			if ($this->customer->isLogged()) {
				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
					'order_id'    => $this->session->data['order_id']
				);
				
				$data['testData'] = array(			
					'email'     => $this->customer->getEmail(),
					'estimated_delivery_date' => $Finaldate,
					'delivery_country' =>$this->session->data['payment_address']['iso_code_2'],
					'order_id' => $this->session->data['order_id']
				);
				
				$this->model_account_activity->addActivity('order_account', $activity_data);
			} else {
				$activity_data = array(
					'name'     => $this->session->data['guest']['firstname'] . ' ' . $this->session->data['guest']['lastname'],
					'order_id' => $this->session->data['order_id']
				);
				
				$data['testData'] = array(				
					'email'     => $this->session->data['guest']['email'],
					'estimated_delivery_date' => $Finaldate,
					'delivery_country' =>$this->session->data['payment_address']['iso_code_2'],
					'order_id' => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_guest', $activity_data);
			}

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('checkout/success')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		if ($this->customer->isLogged()) {
			$data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
		} else {
			$data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['order_success'] = 1;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}
}

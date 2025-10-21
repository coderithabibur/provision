<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		$data['base'] = $server;
		$data['home'] = $this->url->link('common/home');

		$data['scripts'] = $this->document->getScripts('footer');

		$data['text_information'] = $this->language->get('text_information');
		$data['text_service'] = $this->language->get('text_service');
		$data['text_extra'] = $this->language->get('text_extra');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_compare'] = $this->language->get('text_comparelink');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}

		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', 'SSL');
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
		$data['compare'] = $this->url->link('product/compare');
		
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['geocode'] = $this->config->get('config_geocode');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['email'] = $this->config->get('config_email');		
		$data['fax'] = $this->config->get('config_fax');
		$data['facebook'] = $this->config->get('config_facebook');
		$data['instagram'] = $this->config->get('config_instagram');
		$data['google'] = $this->config->get('config_google');
		$data['youtube'] = $this->config->get('config_youtube');
		$data['blogger'] = $this->config->get('config_blogger');
		$data['linkedin'] = $this->config->get('config_linked');
		$data['twitter'] = $this->config->get('config_twitter');
		$data['name'] = $this->config->get('config_name');

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Custom Footer Codes Options
		$this->load->model('setting/setting');
		$custom_code_settings = $this->model_setting_setting->getSetting('module_custom_code');
		if (!empty($custom_code_settings['module_custom_code_status']) && !empty($custom_code_settings['module_custom_code_footer_code'])) {
			$data['custom_footer_code'] = html_entity_decode($custom_code_settings['module_custom_code_footer_code'], ENT_QUOTES, 'UTF-8');
		} else {
			$data['custom_footer_code'] = '';
		}

		// ===========================
		// === CLIENT LOGOS MODULE ===
		// ===========================
		$this->load->model('setting/setting');
		$client_logos_settings = $this->model_setting_setting->getSetting('client_logos');
		$data['client_logos_section'] = $this->load->controller('extension/module/client_logos', $client_logos_settings);
		// ===========================
		
		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

        if (!empty($this->config->get('config_cloudfront_url'))) {
            if ($this->request->server['HTTPS']) {
                $data['image_url'] = $this->config->get('config_cloudfront_url');
            } else {
                $data['image_url'] = $this->config->get('config_cloudfront_url');
            }
        } else {
            if ($this->request->server['HTTPS']) {
                $data['image_url'] = $this->config->get('config_ssl');
            } else {
                $data['image_url'] = $this->config->get('config_ssl');
            }
        }

        if(isset($this->request->get['route']) && $this->request->get['route'] == 'product/product'){
		  $data['is_product'] = 'yes'; 
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/common/footer.tpl', $data);
		}
	}
			//Subscription
		public function subscriber(){
		$email = $this->request->post['email'];
		$root = DIR_SYSTEM .'library/';		
		 if (file_exists($root . 'MCAPI.php')) {
		require_once($root . 'MCAPI.php');
		 }
		 $mailchimp =  new MCAPI(" ");
		 $listID       = "79f7ef757c"; // obtained by calling lists();  
				$retval       = $mailchimp->listSubscribe( $listID, $email ); 
				if ( $mailchimp->errorCode ) {   
						if($mailchimp->errorCode == 214)
							{
								$json['success'] = 0 ;	
							}
						else
							{
						$json['success'] = 2;	
							}  
				   } else {
					$json['success'] = 1 ;	
				   }
			  $this->response->setOutput(json_encode($json));
			
		/*$this->load->model('catalog/information');
		$returnVal=$this->model_catalog_information->subscriberInsert($this->request->post['email']);
		$json = array();
			if($returnVal){
				$json['success']   =1 ;	
						
			}else {
				$json['success']=0; 
				 
			}
		$this->response->setOutput(json_encode($json));*/
	
		}
}

<?php 
class ControllerFeedUksbGoogleMerchant extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('uksb_licensing/uksb_licensing');
		
		$data['regerror_email'] = $this->language->get('regerror_email');
		$data['regerror_orderid'] = $this->language->get('regerror_orderid');
		$data['regerror_noreferer'] = $this->language->get('regerror_noreferer');
		$data['regerror_localhost'] = $this->language->get('regerror_localhost');
		$data['regerror_licensedupe'] = $this->language->get('regerror_licensedupe');
		$data['regerror_quote_msg'] = $this->language->get('regerror_quote_msg');
		$data['license_purchase_thanks'] = $this->language->get('license_purchase_thanks');
		$data['license_registration'] = $this->language->get('license_registration');
		$data['license_opencart_email'] = $this->language->get('license_opencart_email');
		$data['license_opencart_orderid'] = $this->language->get('license_opencart_orderid');
		$data['check_email'] = $this->language->get('check_email');
		$data['check_orderid'] = $this->language->get('check_orderid');
		$data['server_error_curl'] = $this->language->get('server_error_curl');
		
		$data['uksb_install_link'] = $this->url->link('feed/uksb_google_merchant/uksb_install', 'token=' . $this->session->data['token'], 'SSL');
		

		$this->load->language('feed/uksb_google_merchant');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('uksb_google_merchant', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['config_cron'] = $this->config->get('uksb_google_merchant_cron');
		$data['config_language'] = $this->config->get('config_language');
		$data['config_currency'] = $this->config->get('config_currency');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_condition_new'] = $this->language->get('text_condition_new');
		$data['text_condition_used'] = $this->language->get('text_condition_used');
		$data['text_condition_ref'] = $this->language->get('text_condition_ref');
		$data['text_male'] = $this->language->get('text_male');
		$data['text_female'] = $this->language->get('text_female');
		$data['text_unisex'] = $this->language->get('text_unisex');
		$data['text_newborn'] = $this->language->get('text_newborn');
		$data['text_toddler'] = $this->language->get('text_toddler');
		$data['text_infant'] = $this->language->get('text_infant');
		$data['text_kids'] = $this->language->get('text_kids');
		$data['text_adult'] = $this->language->get('text_adult');
		$data['text_big_and_tall'] = $this->language->get('text_big_and_tall');
		$data['text_maternity'] = $this->language->get('text_maternity');
		$data['text_petite'] = $this->language->get('text_petite');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_regular'] = $this->language->get('text_regular');

		$data['text_gpc_gb'] = $this->language->get('text_gpc_gb');
		$data['text_gpc_us'] = $this->language->get('text_gpc_us');
		$data['text_gpc_au'] = $this->language->get('text_gpc_au');
		$data['text_gpc_fr'] = $this->language->get('text_gpc_fr');
		$data['text_gpc_de'] = $this->language->get('text_gpc_de');
		$data['text_gpc_it'] = $this->language->get('text_gpc_it');
		$data['text_gpc_nl'] = $this->language->get('text_gpc_nl');
		$data['text_gpc_es'] = $this->language->get('text_gpc_es');
		$data['text_gpc_pt'] = $this->language->get('text_gpc_pt');
		$data['text_gpc_cz'] = $this->language->get('text_gpc_cz');
		$data['text_gpc_jp'] = $this->language->get('text_gpc_jp');
		$data['text_gpc_da'] = $this->language->get('text_gpc_da');
		$data['text_gpc_no'] = $this->language->get('text_gpc_no');
		$data['text_gpc_pl'] = $this->language->get('text_gpc_pl');
		$data['text_gpc_ru'] = $this->language->get('text_gpc_ru');
		$data['text_gpc_sv'] = $this->language->get('text_gpc_sv');
		$data['text_gpc_tr'] = $this->language->get('text_gpc_tr');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_location'] = $this->language->get('text_location');
		$data['text_gtin'] = $this->language->get('text_gtin');
		$data['text_mpn'] = $this->language->get('text_mpn');
		$data['text_sku'] = $this->language->get('text_sku');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_initialise_data'] = $this->language->get('text_initialise_data');
		$data['text_initialise_data_text'] = $this->language->get('text_initialise_data_text');

		$data['tab_google_settings'] = $this->language->get('tab_google_settings');
		$data['tab_google_feeds'] = $this->language->get('tab_google_feeds');
		$data['tab_bulk_update'] = $this->language->get('tab_bulk_update');
		$data['tab_videos'] = $this->language->get('tab_videos');

		$data['entry_free_support'] = $this->language->get('entry_free_support');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_gtin'] = $this->language->get('entry_gtin');
		$data['entry_characters'] = $this->language->get('entry_characters');
		$data['entry_split'] = $this->language->get('entry_split');
		$data['entry_cron'] = $this->language->get('entry_cron');
		$data['entry_site'] = $this->language->get('entry_site');
		$data['entry_google_category'] = $this->language->get('entry_google_category');
		$data['entry_choose_google_category'] = $this->language->get('entry_choose_google_category');
		$data['entry_choose_google_category_xml'] = $this->language->get('entry_choose_google_category_xml');
		$data['entry_info'] = $this->language->get('entry_info');
		$data['entry_data_feed'] = $this->language->get('entry_data_feed');
		$data['entry_cron_data_feed'] = $this->language->get('entry_cron_data_feed');
		$data['entry_cron_code'] = $this->language->get('entry_cron_code');
				
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_gtin'] = $this->language->get('help_gtin');
		$data['help_characters'] = $this->language->get('help_characters');
		$data['help_split'] = $this->language->get('help_split');
		$data['help_split_help'] = $this->language->get('help_split_help');
		$data['help_cron'] = $this->language->get('help_cron');
		$data['help_cron_code'] = $this->language->get('help_cron_code');
		$data['help_site'] = $this->language->get('help_site');
		$data['help_google_category'] = $this->language->get('help_google_category');
		$data['help_info'] = $this->language->get('help_info');
		$data['help_google_help'] = $this->language->get('help_google_help');
		
		$data['button_run'] = $this->language->get('button_run');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		// Bulk Update
		$data['uksbhome'] = 'https://www.secureserverssl.co.uk/opencart-extensions/google-merchant/';
		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['help_bulk_update_info'] = $this->language->get('help_bulk_update_info');
		$data['entry_ignore'] = $this->language->get('entry_ignore');
		$data['entry_p_on_google'] = $this->language->get('entry_p_on_google');
		$data['help_p_on_google'] = $this->language->get('help_p_on_google');
		$data['entry_p_promotion_id'] = $this->language->get('entry_p_promotion_id');
		$data['help_p_promotion_id'] = $this->language->get('help_p_promotion_id');
		$data['entry_p_expiry_date'] = $this->language->get('entry_p_expiry_date');
		$data['help_p_expiry_date'] = $this->language->get('help_p_expiry_date');
		$data['entry_p_identifier_exists'] = $this->language->get('entry_p_identifier_exists');
		$data['help_p_identifier_exists'] = $this->language->get('help_p_identifier_exists');
		$data['entry_p_condition'] = $this->language->get('entry_p_condition');
		$data['help_p_condition'] = $this->language->get('help_p_condition');
		$data['entry_p_brand'] = $this->language->get('entry_p_brand');
		$data['help_p_brand'] = $this->language->get('help_p_brand');
		$data['entry_p_mpn'] = $this->language->get('entry_p_mpn');
		$data['help_p_mpn'] = $this->language->get('help_p_mpn');
		$data['entry_p_gtin'] = $this->language->get('entry_p_gtin');
		$data['help_p_gtin'] = $this->language->get('help_p_gtin');
		$data['entry_p_google_category'] = $this->language->get('entry_p_google_category');
		$data['entry_choose_google_category'] = $this->language->get('entry_choose_google_category');
		$data['entry_choose_google_category_xml'] = $this->language->get('entry_choose_google_category_xml');
		$data['help_p_google_category'] = $this->language->get('help_p_google_category');
		$data['entry_p_multipack'] = $this->language->get('entry_p_multipack');
		$data['help_p_multipack'] = $this->language->get('help_p_multipack');
		$data['entry_p_is_bundle'] = $this->language->get('entry_p_is_bundle');
		$data['help_p_is_bundle'] = $this->language->get('help_p_is_bundle');
		$data['entry_p_adult'] = $this->language->get('entry_p_adult');
		$data['help_p_adult'] = $this->language->get('help_p_adult');
		$data['entry_p_energy_efficiency_class'] = $this->language->get('entry_p_energy_efficiency_class');
		$data['help_p_energy_efficiency_class'] = $this->language->get('help_p_energy_efficiency_class');
		$data['entry_p_unit_pricing_measure'] = $this->language->get('entry_p_unit_pricing_measure');
		$data['help_p_unit_pricing_measure'] = $this->language->get('help_p_unit_pricing_measure');
		$data['entry_p_unit_pricing_base_measure'] = $this->language->get('entry_p_unit_pricing_base_measure');
		$data['help_p_unit_pricing_base_measure'] = $this->language->get('help_p_unit_pricing_base_measure');
		$data['entry_p_gender'] = $this->language->get('entry_p_gender');
		$data['entry_p_age_group'] = $this->language->get('entry_p_age_group');
		$data['entry_p_size_type'] = $this->language->get('entry_p_size_type');
		$data['help_p_size_type'] = $this->language->get('help_p_size_type');
		$data['entry_p_size_system'] = $this->language->get('entry_p_size_system');
		$data['help_p_size_system'] = $this->language->get('help_p_size_system');

		$data['entry_variant_section'] = $this->language->get('entry_variant_section');
		$data['help_variant_bulk'] = $this->language->get('help_variant_bulk');
		$data['entry_p_size'] = $this->language->get('entry_p_size');
		$data['entry_p_colour'] = $this->language->get('entry_p_colour');
		$data['entry_p_material'] = $this->language->get('entry_p_material');
		$data['entry_p_pattern'] = $this->language->get('entry_p_pattern');
		$data['entry_v_prices'] = $this->language->get('entry_v_prices');
		$data['help_v_prices'] = $this->language->get('help_v_prices');
		
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_variant'] = $this->language->get('button_add_variant');
		$data['button_bulk_update'] = $this->language->get('button_bulk_update');
		$data['button_bulk_reset'] = $this->language->get('button_bulk_reset');

		$data['entry_adwords_section'] = $this->language->get('entry_adwords_section');
		$data['help_p_custom_label'] = $this->language->get('help_p_custom_label');
		$data['entry_p_custom_label_0'] = $this->language->get('entry_p_custom_label_0');
		$data['entry_p_custom_label_1'] = $this->language->get('entry_p_custom_label_1');
		$data['entry_p_custom_label_2'] = $this->language->get('entry_p_custom_label_2');
		$data['entry_p_custom_label_3'] = $this->language->get('entry_p_custom_label_3');
		$data['entry_p_custom_label_4'] = $this->language->get('entry_p_custom_label_4');
		$data['entry_p_adwords_redirect'] = $this->language->get('entry_p_adwords_redirect');
		$data['help_p_adwords_redirect'] = $this->language->get('help_p_adwords_redirect');
		$data['entry_products_to_update'] = $this->language->get('entry_products_to_update');
		$data['help_products_to_update'] = $this->language->get('help_products_to_update');
		$data['entry_categories'] = $this->language->get('entry_categories');
		$data['help_categories'] = $this->language->get('help_categories');
		$data['entry_manufacturers'] = $this->language->get('entry_manufacturers');
		$data['help_manufacturers'] = $this->language->get('help_manufacturers');
		$data['entry_products'] = $this->language->get('entry_products');
		$data['help_products'] = $this->language->get('help_products');

 		if(isset($this->request->get['emailmal'])){
			$data['emailmal'] = true;
		}

 		if(isset($this->request->get['clear'])){
			$data['clearform'] = true;
		}

		if(isset($this->request->get['regerror'])){
		    if($this->request->get['regerror']=='emailmal'){
		    	$this->error['warning'] = $this->language->get('regerror_email');
		    }elseif($this->request->get['regerror']=='orderidmal'){
		    	$this->error['warning'] = $this->language->get('regerror_orderid');
		    }elseif($this->request->get['regerror']=='noreferer'){
		    	$this->error['warning'] = $this->language->get('regerror_noreferer');
		    }elseif($this->request->get['regerror']=='localhost'){
		    	$this->error['warning'] = $this->language->get('regerror_localhost');
		    }elseif($this->request->get['regerror']=='licensedupe'){
		    	$this->error['warning'] = $this->language->get('regerror_licensedupe');
		    }
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['duplicate'])) {
			$data['error_duplicate'] = $this->error['duplicate'];
		} else {
			$data['error_duplicate'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_feed'),
			'href'      => $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href'      => $this->url->link('feed/uksb_google_merchant', 'token=' . $this->session->data['token'], 'SSL')
		);
				
		$data['action'] = $this->url->link('feed/uksb_google_merchant', 'token=' . $this->session->data['token'], 'SSL');
		$data['action_bulk_update'] = $this->url->link('feed/uksb_google_merchant/bulk_update', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['uksb_google_merchant_status'])) {
			$data['uksb_google_merchant_status'] = $this->request->post['uksb_google_merchant_status'];
		} else {
			$data['uksb_google_merchant_status'] = $this->config->get('uksb_google_merchant_status');
		}
		
		if (isset($this->request->post['uksb_google_merchant_mpn'])) {
			$data['uksb_google_merchant_mpn'] = $this->request->post['uksb_google_merchant_mpn'];
		} else {
			$data['uksb_google_merchant_mpn'] = $this->config->get('uksb_google_merchant_mpn');
		}
		
		if (isset($this->request->post['uksb_google_merchant_condition'])) {
			$data['uksb_google_merchant_condition'] = $this->request->post['uksb_google_merchant_condition'];
		} else {
			$data['uksb_google_merchant_condition'] = $this->config->get('uksb_google_merchant_condition');
		}
		
		if (isset($this->request->post['uksb_google_merchant_g_gtin'])) {
			$data['uksb_google_merchant_g_gtin'] = $this->request->post['uksb_google_merchant_g_gtin'];
		} else {
			$data['uksb_google_merchant_g_gtin'] = $this->config->get('uksb_google_merchant_g_gtin');
		}
		
		if (isset($this->request->post['uksb_google_merchant_gender'])) {
			$data['uksb_google_merchant_gender'] = $this->request->post['uksb_google_merchant_gender'];
		} else {
			$data['uksb_google_merchant_gender'] = $this->config->get('uksb_google_merchant_gender');
		}
		
		if (isset($this->request->post['uksb_google_merchant_age_group'])) {
			$data['uksb_google_merchant_age_group'] = $this->request->post['uksb_google_merchant_age_group'];
		} else {
			$data['uksb_google_merchant_age_group'] = $this->config->get('uksb_google_merchant_age_group');
		}
				
		if (isset($this->request->post['uksb_google_merchant_characters'])) {
			$data['uksb_google_merchant_characters'] = $this->request->post['uksb_google_merchant_characters'];
		} else {
			$data['uksb_google_merchant_characters'] = $this->config->get('uksb_google_merchant_characters');
		}
		
		if (isset($this->request->post['uksb_google_merchant_split'])) {
			$data['uksb_google_merchant_split'] = $this->request->post['uksb_google_merchant_split'];
		} else {
			$data['uksb_google_merchant_split'] = $this->config->get('uksb_google_merchant_split');
		}
		
		if (isset($this->request->post['uksb_google_merchant_cron'])) {
			$data['uksb_google_merchant_cron'] = $this->request->post['uksb_google_merchant_cron'];
		} else {
			$data['uksb_google_merchant_cron'] = $this->config->get('uksb_google_merchant_cron');
		}
		
		if (isset($this->request->post['uksb_google_merchant_google_category_gb'])) {
			$data['uksb_google_merchant_google_category_gb'] = $this->request->post['uksb_google_merchant_google_category_gb'];
			$data['uksb_google_merchant_google_category_us'] = $this->request->post['uksb_google_merchant_google_category_us'];
			$data['uksb_google_merchant_google_category_au'] = $this->request->post['uksb_google_merchant_google_category_au'];
			$data['uksb_google_merchant_google_category_fr'] = $this->request->post['uksb_google_merchant_google_category_fr'];
			$data['uksb_google_merchant_google_category_de'] = $this->request->post['uksb_google_merchant_google_category_de'];
			$data['uksb_google_merchant_google_category_it'] = $this->request->post['uksb_google_merchant_google_category_it'];
			$data['uksb_google_merchant_google_category_nl'] = $this->request->post['uksb_google_merchant_google_category_nl'];
			$data['uksb_google_merchant_google_category_es'] = $this->request->post['uksb_google_merchant_google_category_es'];
			$data['uksb_google_merchant_google_category_pt'] = $this->request->post['uksb_google_merchant_google_category_pt'];
			$data['uksb_google_merchant_google_category_cz'] = $this->request->post['uksb_google_merchant_google_category_cz'];
			$data['uksb_google_merchant_google_category_jp'] = $this->request->post['uksb_google_merchant_google_category_jp'];
			$data['uksb_google_merchant_google_category_dk'] = $this->request->post['uksb_google_merchant_google_category_dk'];
			$data['uksb_google_merchant_google_category_no'] = $this->request->post['uksb_google_merchant_google_category_no'];
			$data['uksb_google_merchant_google_category_pl'] = $this->request->post['uksb_google_merchant_google_category_pl'];
			$data['uksb_google_merchant_google_category_ru'] = $this->request->post['uksb_google_merchant_google_category_ru'];
			$data['uksb_google_merchant_google_category_sv'] = $this->request->post['uksb_google_merchant_google_category_sv'];
			$data['uksb_google_merchant_google_category_tr'] = $this->request->post['uksb_google_merchant_google_category_tr'];
		} else {
			$data['uksb_google_merchant_google_category_gb'] = $this->config->get('uksb_google_merchant_google_category_gb');
			$data['uksb_google_merchant_google_category_us'] = $this->config->get('uksb_google_merchant_google_category_us');
			$data['uksb_google_merchant_google_category_au'] = $this->config->get('uksb_google_merchant_google_category_au');
			$data['uksb_google_merchant_google_category_fr'] = $this->config->get('uksb_google_merchant_google_category_fr');
			$data['uksb_google_merchant_google_category_de'] = $this->config->get('uksb_google_merchant_google_category_de');
			$data['uksb_google_merchant_google_category_it'] = $this->config->get('uksb_google_merchant_google_category_it');
			$data['uksb_google_merchant_google_category_nl'] = $this->config->get('uksb_google_merchant_google_category_nl');
			$data['uksb_google_merchant_google_category_es'] = $this->config->get('uksb_google_merchant_google_category_es');
			$data['uksb_google_merchant_google_category_pt'] = $this->config->get('uksb_google_merchant_google_category_pt');
			$data['uksb_google_merchant_google_category_cz'] = $this->config->get('uksb_google_merchant_google_category_cz');
			$data['uksb_google_merchant_google_category_jp'] = $this->config->get('uksb_google_merchant_google_category_jp');
			$data['uksb_google_merchant_google_category_dk'] = $this->config->get('uksb_google_merchant_google_category_dk');
			$data['uksb_google_merchant_google_category_no'] = $this->config->get('uksb_google_merchant_google_category_no');
			$data['uksb_google_merchant_google_category_pl'] = $this->config->get('uksb_google_merchant_google_category_pl');
			$data['uksb_google_merchant_google_category_ru'] = $this->config->get('uksb_google_merchant_google_category_ru');
			$data['uksb_google_merchant_google_category_sv'] = $this->config->get('uksb_google_merchant_google_category_sv');
			$data['uksb_google_merchant_google_category_tr'] = $this->config->get('uksb_google_merchant_google_category_tr');
		}
		
		$this->load->model('feed/uksb_google_merchant');
		
		$data['data_feed'] = '';
		if(!$this->config->get('uksb_google_merchant_cron')){
			if($this->config->get('uksb_google_merchant_split')>0){
				$split = $this->config->get('uksb_google_merchant_split');
				$totalproducts = $this->model_feed_uksb_google_merchant->getTotalProductsByStore(0);
				if($totalproducts>$split){
					$j = floor($totalproducts/$split);
					$rem = $totalproducts-($j*$split);
					for($i=1; $i<=$j; $i++){
						$from = (($i-1)*$split)+1;
						$to = $i*$split;
						$data['data_feed'] .= ($i>1?'^':'').HTTP_CATALOG.'index.php?route=feed/uksb_google_merchant&send='.$from.'-'.$to;
					}
					if($rem>0){
						$data['data_feed'] .= '^'.HTTP_CATALOG.'index.php?route=feed/uksb_google_merchant&send='.($to+1).'-'.($to+$split);
					}
				}else{
					$data['data_feed'] = HTTP_CATALOG.'index.php?route=feed/uksb_google_merchant';
				}
			}else{
				$data['data_feed'] = HTTP_CATALOG.'index.php?route=feed/uksb_google_merchant';
			}
		}else{
			$data['data_feed'] = HTTP_CATALOG.'uksb_feeds/';
			$data['data_cron_path'] = HTTP_CATALOG.'index.php?route=feed/uksb_google_merchant&mode=cron';
		}
		
		$this->load->model('setting/store');

		if($this->model_setting_store->getTotalStores()>0){
			$stores = $this->model_setting_store->getStores();
			$stores = array_reverse($stores);
			
			foreach($stores as $store){
				if(!$this->config->get('uksb_google_merchant_cron')){
					if($this->config->get('uksb_google_merchant_split')>0){
						$split = $this->config->get('uksb_google_merchant_split');
						$totalproducts = $this->model_feed_uksb_google_merchant->getTotalProductsByStore($store['store_id']);
						if($totalproducts>$split){
							$j = floor($totalproducts/$split);
							$rem = $totalproducts-($j*$split);
							for($i=1; $i<=$j; $i++){
								$from = (($i-1)*$split)+1;
								$to = $i*$split;
								$data['data_feed'] .= '^'.$store['url'].'index.php?route=feed/uksb_google_merchant&send='.$from.'-'.$to;
							}
							if($rem>0){
								$data['data_feed'] .= '^'.$store['url'].'index.php?route=feed/uksb_google_merchant&send='.($to+1).'-'.($to+$split);
							}
						}else{
							$data['data_feed'] .= '^'.$store['url'].'index.php?route=feed/uksb_google_merchant';
						}
					}else{
						$data['data_feed'] .= '^'.$store['url'].'index.php?route=feed/uksb_google_merchant';
					}
				}else{
					$data['data_feed'] .= '^'.$store['url'].'uksb_feeds/';
					$data['data_cron_path'] .= '^'.$store['url'].'index.php?route=feed/uksb_google_merchant&mode=cron';
				}
			}
		}
		
		$data['state'] = $this->model_feed_uksb_google_merchant->checkInstallState();
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		$data['home'] = 'https://www.secureserverssl.co.uk/opencart-extensions/google-merchant/';
		$domainssl = explode("//", HTTPS_SERVER);
		$domainnonssl = explode("//", HTTP_SERVER);
		$domain = ($domainssl[1] != '' ? $domainssl[1] : $domainnonssl[1]);

		$data['licensed'] = @file_get_contents($data['home'] . 'licensed.php?domain=' . $domain . '&extension=19110');

		if(!$data['licensed'] || $data['licensed'] == ''){
			if(extension_loaded('curl')) {
		        $post_data = array('domain' => $domain, 'extension' => '19110');
		        $curl = curl_init();
		        curl_setopt($curl, CURLOPT_HEADER, false);
		        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		        curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
		        $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
		        if ($follow_allowed) {
		            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		        }
		        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 9);
		        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
		        curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
		        curl_setopt($curl, CURLOPT_VERBOSE, 1);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($curl, CURLOPT_URL, $data['home'] . 'licensed.php');
		        curl_setopt($curl, CURLOPT_POST, true);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
		        $data['licensed'] = curl_exec($curl);
		        curl_close($curl);
		    }else{
		        $data['licensed'] = 'curl';
		    }
		}

		$order_date = @file_get_contents($data['home'] . 'order_date.php?domain=' . $domain . '&extension=19110');

		if(!$order_date || $order_date == ''){
			if(extension_loaded('curl')) {
		        $post_data2 = array('domain' => $domain, 'extension' => '19110');
		        $curl2 = curl_init();
		        curl_setopt($curl2, CURLOPT_HEADER, false);
		        curl_setopt($curl2, CURLINFO_HEADER_OUT, true);
		        curl_setopt($curl2, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
		        $follow_allowed2 = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
		        if ($follow_allowed2) {
		            curl_setopt($curl2, CURLOPT_FOLLOWLOCATION, 1);
		        }
		        curl_setopt($curl2, CURLOPT_CONNECTTIMEOUT, 9);
		        curl_setopt($curl2, CURLOPT_TIMEOUT, 60);
		        curl_setopt($curl2, CURLOPT_AUTOREFERER, true); 
		        curl_setopt($curl2, CURLOPT_VERBOSE, 1);
		        curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, false);
		        curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($curl2, CURLOPT_FORBID_REUSE, false);
		        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($curl2, CURLOPT_URL, $data['home'] . 'order_date.php');
		        curl_setopt($curl2, CURLOPT_POST, true);
		        curl_setopt($curl2, CURLOPT_POSTFIELDS, http_build_query($post_data2));
		        $order_date = curl_exec($curl2);
		        curl_close($curl2);
		    }else{
		        $order_date = 'unknown';
		    }
		}

		if($order_date == '' || $order_date == 'unknown'){
			$data['text_free_support_remaining'] = sprintf($this->language->get('text_free_support_remaining'), 'unknown');
		}else{
			$isSecure = false;
			if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
				$isSecure = true;
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
				$isSecure = true;
			}

			if((time() - $order_date) > 31536000){
				$data['text_free_support_remaining'] = sprintf($this->language->get('text_free_support_expired'), 1, ($isSecure ? 1 : 0), urlencode($domain), '19110', $this->session->data['token']);
			}else{
				$data['text_free_support_remaining'] = sprintf($this->language->get('text_free_support_remaining'), 366 - ceil((time() - $order_date) / 86400));
			}
		}

		$data['token'] = $this->session->data['token'];

		$this->response->setOutput($this->load->view('feed/uksb_google_merchant.tpl', $data));
	} 
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'feed/uksb_google_merchant')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['uksb_google_merchant_status'])&&$this->request->post['uksb_google_merchant_mpn']==$this->request->post['uksb_google_merchant_g_gtin']) {
			$this->error['duplicate'] = $this->language->get('error_duplicate');
		}

		return !$this->error;
	}	
	
	public function bulk_update(){
		$json = array();
		//$data = array();
		$this->load->language('feed/uksb_google_merchant');

		if (!$this->user->hasPermission('modify', 'feed/uksb_google_merchant')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (!isset($json['error'])) {
			if(isset($this->request->post['x_g_on_google']) && isset($this->request->post['x_g_promotion_id']) && isset($this->request->post['x_g_expiry_date']) && isset($this->request->post['x_g_identifier_exists']) && isset($this->request->post['x_g_condition']) && isset($this->request->post['x_g_brand']) && isset($this->request->post['x_google_categories']) && isset($this->request->post['x_g_multipack']) && isset($this->request->post['x_g_is_bundle']) && isset($this->request->post['x_g_adult']) && isset($this->request->post['x_g_energy_efficiency_class']) && isset($this->request->post['x_g_unit_pricing_measure']) && isset($this->request->post['x_g_unit_pricing_base_measure']) && isset($this->request->post['x_g_gender']) && isset($this->request->post['x_g_age_group']) && isset($this->request->post['x_g_size_type']) && isset($this->request->post['x_g_size_system']) && isset($this->request->post['x_variants']) && isset($this->request->post['x_g_custom_label_0']) && isset($this->request->post['x_g_custom_label_1']) && isset($this->request->post['x_g_custom_label_2']) && isset($this->request->post['x_g_custom_label_3']) && isset($this->request->post['x_g_custom_label_4']) && isset($this->request->post['x_g_adwords_redirect'])){
				$json['error'] = $this->language->get('error_bulk_ignored');
			}elseif(!isset($json['error'])){
				if (!isset($this->request->post['x_g_on_google'])) {
		      		$data['g_on_google'] = $this->request->post['g_on_google'];
		    	}
				
				if (!isset($this->request->post['x_g_promotion_id'])) {
		      		$data['g_promotion_id'] = $this->request->post['g_promotion_id'];
		    	}
				
				if (!isset($this->request->post['x_g_expiry_date'])) {
		      		$data['g_expiry_date'] = $this->request->post['g_expiry_date'];
		    	}

				if (!isset($this->request->post['x_g_identifier_exists'])) {
		      		$data['g_identifier_exists'] = $this->request->post['g_identifier_exists'];
		    	}
						
				if (!isset($this->request->post['x_g_condition'])) {
		      		$data['g_condition'] = $this->request->post['g_condition'];
		    	}

				if (!isset($this->request->post['x_g_brand'])) {
		      		$data['g_brand'] = $this->request->post['g_brand'];
		    	}

				if (!isset($this->request->post['x_google_categories'])) {
					$data['google_category_gb'] = $this->request->post['google_category_gb'];
					$data['google_category_us'] = $this->request->post['google_category_us'];
					$data['google_category_au'] = $this->request->post['google_category_au'];
					$data['google_category_fr'] = $this->request->post['google_category_fr'];
					$data['google_category_de'] = $this->request->post['google_category_de'];
					$data['google_category_it'] = $this->request->post['google_category_it'];
					$data['google_category_nl'] = $this->request->post['google_category_nl'];
					$data['google_category_es'] = $this->request->post['google_category_es'];
					$data['google_category_pt'] = $this->request->post['google_category_pt'];
					$data['google_category_cz'] = $this->request->post['google_category_cz'];
					$data['google_category_jp'] = $this->request->post['google_category_jp'];
					$data['google_category_dk'] = $this->request->post['google_category_dk'];
					$data['google_category_no'] = $this->request->post['google_category_no'];
					$data['google_category_pl'] = $this->request->post['google_category_pl'];
					$data['google_category_ru'] = $this->request->post['google_category_ru'];
					$data['google_category_sv'] = $this->request->post['google_category_sv'];
					$data['google_category_tr'] = $this->request->post['google_category_tr'];
				}

				if (!isset($this->request->post['x_g_multipack'])) {
		      		$data['g_multipack'] = $this->request->post['g_multipack'];
		    	}
						
				if (!isset($this->request->post['x_g_is_bundle'])) {
		      		$data['g_is_bundle'] = $this->request->post['g_is_bundle'];
		    	}
						
				if (!isset($this->request->post['x_g_adult'])) {
		      		$data['g_adult'] = $this->request->post['g_adult'];
		    	}

				if (!isset($this->request->post['x_g_energy_efficiency_class'])) {
		      		$data['g_energy_efficiency_class'] = $this->request->post['g_energy_efficiency_class'];
		    	}

				if (!isset($this->request->post['x_g_unit_pricing_measure'])) {
		      		$data['g_unit_pricing_measure'] = $this->request->post['g_unit_pricing_measure'];
		    	}
						
				if (!isset($this->request->post['x_g_unit_pricing_base_measure'])) {
		      		$data['g_unit_pricing_base_measure'] = $this->request->post['g_unit_pricing_base_measure'];
		    	}

				if (!isset($this->request->post['x_g_gender'])) {
		      		$data['g_gender'] = $this->request->post['g_gender'];
		    	}

				if (!isset($this->request->post['x_g_age_group'])) {
		      		$data['g_age_group'] = $this->request->post['g_age_group'];
		    	}

				if (!isset($this->request->post['x_g_size_type'])) {
		      		$data['g_size_type'] = $this->request->post['g_size_type'];
		    	}

				if (!isset($this->request->post['x_g_size_system'])) {
		      		$data['g_size_system'] = $this->request->post['g_size_system'];
		    	}

				if (!isset($this->request->post['x_variants'])) {
					$variants = $this->request->post['variant'];

					$data['variants'] = array();

					foreach ($variants as $variant) {
						if ($variant['v_images'] && file_exists(DIR_IMAGE . $variant['v_images'])) {
							$v_images = $variant['v_images'];
						} else {
							$v_images = 'no_image.jpg';
						}

						$data['variants'][] = array(
							'g_colour'               => $variant['g_colour'],
							'g_size'                 => $variant['g_size'],
							'g_material'             => $variant['g_material'],
							'g_pattern'              => $variant['g_pattern'],
							'v_prices'               => $variant['v_prices'],
							'v_images'               => $v_images
						);
					}
			    }
									
				if (!isset($this->request->post['x_g_custom_label_0'])) {
		      		$data['g_custom_label_0'] = $this->request->post['g_custom_label_0'];
		    	}
						
				if (!isset($this->request->post['x_g_custom_label_1'])) {
		      		$data['g_custom_label_1'] = $this->request->post['g_custom_label_1'];
		    	}
						
				if (!isset($this->request->post['x_g_custom_label_2'])) {
		      		$data['g_custom_label_2'] = $this->request->post['g_custom_label_2'];
		    	}
						
				if (!isset($this->request->post['x_g_custom_label_3'])) {
		      		$data['g_custom_label_3'] = $this->request->post['g_custom_label_3'];
		    	}
						
				if (!isset($this->request->post['x_g_custom_label_4'])) {
		      		$data['g_custom_label_4'] = $this->request->post['g_custom_label_4'];
		    	}			

				if (!isset($this->request->post['x_g_adwords_redirect'])){
					$data['g_adwords_redirect'] = $this->request->post['g_adwords_redirect'];
				}

				if (isset($this->request->post['product_manufacturers'])){
					$data['product_manufacturers'] = $this->request->post['product_manufacturers'];
				}

				if (isset($this->request->post['product_categories'])){
					$data['product_categories'] = $this->request->post['product_categories'];
				}

				if (isset($this->request->post['product_products'])){
					$data['product_products'] = $this->request->post['product_products'];
				}

				$this->load->model('feed/uksb_google_merchant');

				$json['updated'] = sprintf($this->language->get('text_bulk_updated'), $this->model_feed_uksb_google_merchant->update($data));
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function uksb_install() {
		$this->load->model('feed/uksb_google_merchant');
		$this->model_feed_uksb_google_merchant->uksbInstall();
		$this->response->redirect($this->url->link('feed/uksb_google_merchant', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	public function install() {
		$this->load->model('feed/uksb_google_merchant');
		
		$this->model_feed_uksb_google_merchant->install();
	}	
}
<?php
class ControllerModuleProductQuestion extends Controller {
	private $version = '2.1';
	private $error = array();

	public function install() {
		$this->load->model('module/product_question');
		$this->load->model('extension/event');

		$this->model_module_product_question->createTables();
	}

	public function uninstall() {
      $this->load->model('module/product_question');
		$this->load->model('extension/event');

		if (isset($this->request->get['full_uninstall'])) {
			$this->model_module_product_question->removeTables();
		}
	}

	public function index() {
		$this->load->language('module/product_question');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addStyle('view/stylesheet/product-question.css');
		
		// check update | if new version is available	
		$this->document->addScript('https://www.oc-extensions.com/catalog/view/javascript/api/js/update.min.js?extension_version=' . $this->version . '&oc_version=' . VERSION . '&email=' . $this->config->get('config_email'));
		

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('product_question', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;

		// Tabs
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_question'] = $this->language->get('tab_question');
		$data['tab_extra_button'] = $this->language->get('tab_extra_button');
		$data['tab_email'] = $this->language->get('tab_email');
		$data['tab_help'] = $this->language->get('tab_help');

		// Legend
		$data['legend_answer_language'] = $this->language->get('legend_answer_language');
		$data['legend_force_multilanguage'] = $this->language->get('legend_force_multilanguage');
		$data['legend_admin_notification'] = $this->language->get('legend_admin_notification');
		$data['legend_tab_name'] = $this->language->get('legend_tab_name');
		$data['legend_tab_header_position'] = $this->language->get('legend_tab_header_position');
		$data['legend_tab_content_position'] = $this->language->get('legend_tab_content_position');
		$data['legend_tab_question_limit'] = $this->language->get('legend_tab_question_limit');
		$data['legend_extra_button_name'] = $this->language->get('legend_extra_button_name');
		$data['legend_extra_button_position'] = $this->language->get('legend_extra_button_position');

		$data['legend_email_admin_notification'] = $this->language->get('legend_email_admin_notification');
		$data['legend_email_customer_answer'] = $this->language->get('legend_email_customer_answer');

		// Text
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_select'] = $this->language->get('text_select');

		$data['text_prepend'] = $this->language->get('text_prepend');
		$data['text_append'] = $this->language->get('text_append');
		$data['text_before'] = $this->language->get('text_before');
		$data['text_after'] = $this->language->get('text_after');

		$data['text_customer_prefered_language'] = $this->language->get('text_customer_prefered_language');
		$data['text_custom_language'] = $this->language->get('text_custom_language');

		$data['text_open_question_tab'] = $this->language->get('text_open_question_tab');
		$data['text_open_question_form'] = $this->language->get('text_open_question_form');

		$data['text_import_example'] = $this->language->get('text_import_example');

		// Entry
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_admin_notification'] = $this->language->get('entry_admin_notification');
		$data['entry_admin_notification_additional'] = $this->language->get('entry_admin_notification_additional');
		$data['entry_answer_language_type'] = $this->language->get('entry_answer_language_type');
		$data['entry_answer_language_id'] = $this->language->get('entry_answer_language_id');
		$data['entry_force_multilanguage'] = $this->language->get('entry_force_multilanguage');

		$data['entry_tab_name'] = $this->language->get('entry_tab_name');
		$data['entry_tab_header_format'] = $this->language->get('entry_tab_header_format');
		$data['entry_tab_content_format'] = $this->language->get('entry_tab_content_format');
		$data['entry_tab_question_limit'] = $this->language->get('entry_tab_question_limit');

		$data['entry_extra_button_status'] = $this->language->get('entry_extra_button_status');
		$data['entry_extra_button_name'] = $this->language->get('entry_extra_button_name');
		$data['entry_extra_button_format'] = $this->language->get('entry_extra_button_format');
		$data['entry_extra_button_behaviour'] = $this->language->get('entry_extra_button_behaviour');

		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_position_selector'] = $this->language->get('entry_position_selector');
		$data['entry_position_function'] = $this->language->get('entry_position_function');

		$data['entry_email_subject'] = $this->language->get('entry_email_subject');
		$data['entry_email_message'] = $this->language->get('entry_email_message');

		// Help
		$data['help_extra_button'] = $this->language->get('help_extra_button');
		$data['help_install'] = $this->language->get('help_install');
		$data['help_status'] = $this->language->get('help_status');
		$data['help_admin_notification'] = $this->language->get('help_admin_notification');
		$data['help_admin_notification_additional'] = $this->language->get('help_admin_notification_additional');
		$data['help_force_multilanguage'] = $this->language->get('help_force_multilanguage');

		$data['help_tab_header_format'] = $this->language->get('help_tab_header_format');
		$data['help_tab_content_format'] = $this->language->get('help_tab_content_format');

		$data['help_extra_button_format'] = $this->language->get('help_extra_button_format');

		$data['help_email_admin_notification_subject_keywords'] = $this->language->get('help_email_admin_notification_subject_keywords');
		$data['help_email_admin_notification_message_keywords'] = $this->language->get('help_email_admin_notification_message_keywords');
		$data['help_email_customer_answer_subject_keywords'] = $this->language->get('help_email_customer_answer_subject_keywords');
		$data['help_email_customer_answer_message_keywords'] = $this->language->get('help_email_customer_answer_message_keywords');

		// Buttons
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		// Error Messages
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = array();
		}

		if (isset($this->error['tab_name'])) {
			$data['error_tab_name'] = $this->error['tab_name'];
		} else {
			$data['error_tab_name'] = array();
		}

		if (isset($this->error['tab_header_position_selector'])) {
			$data['error_tab_header_position_selector'] = $this->error['tab_header_position_selector'];
		} else {
			$data['error_tab_header_position_selector'] = '';
		}

		if (isset($this->error['tab_content_position_selector'])) {
			$data['error_tab_content_position_selector'] = $this->error['tab_content_position_selector'];
		} else {
			$data['error_tab_content_position_selector'] = '';
		}

		if (isset($this->error['tab_header_format'])) {
			$data['error_tab_header_format'] = $this->error['tab_header_format'];
		} else {
			$data['error_tab_header_format'] = '';
		}

		if (isset($this->error['tab_content_format'])) {
			$data['error_tab_content_format'] = $this->error['tab_content_format'];
		} else {
			$data['error_tab_content_format'] = '';
		}

		if (isset($this->error['tab_content_position_selector'])) {
			$data['error_tab_content_position_selector'] = $this->error['tab_content_position_selector'];
		} else {
			$data['error_tab_content_position_selector'] = '';
		}

		if (isset($this->error['tab_question_limit'])) {
			$data['error_tab_question_limit'] = $this->error['tab_question_limit'];
		} else {
			$data['error_tab_question_limit'] = '';
		}

		if (isset($this->error['extra_button_name'])) {
			$data['error_extra_button_name'] = $this->error['extra_button_name'];
		} else {
			$data['error_extra_button_name'] = array();
		}

		if (isset($this->error['extra_button_position_selector'])) {
			$data['error_extra_button_position_selector'] = $this->error['extra_button_position_selector'];
		} else {
			$data['error_extra_button_position_selector'] = '';
		}

		if (isset($this->error['extra_button_format'])) {
			$data['error_extra_button_format'] = $this->error['extra_button_format'];
		} else {
			$data['error_extra_button_format'] = '';
		}

		if (isset($this->error['admin_notification_subject'])) {
			$data['error_admin_notification_subject'] = $this->error['admin_notification_subject'];
		} else {
			$data['error_admin_notification_subject'] = '';
		}

		if (isset($this->error['admin_notification_message'])) {
			$data['error_admin_notification_message'] = $this->error['admin_notification_message'];
		} else {
			$data['error_admin_notification_message'] = '';
		}

		if (isset($this->error['customer_answer_subject'])) {
			$data['error_customer_answer_subject'] = $this->error['customer_answer_subject'];
		} else {
			$data['error_customer_answer_subject'] = array();
		}

		if (isset($this->error['customer_answer_message'])) {
			$data['error_customer_answer_message'] = $this->error['customer_answer_message'];
		} else {
			$data['error_customer_answer_message'] = array();
		}

		// Bradcrumbs
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_extension'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/product_question', 'token=' . $this->session->data['token'], 'SSL')
		);

		// Actions
		$data['action'] = $this->url->link('module/product_question', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		// Update check
		$this->update_check();

		$data['update'] = '';

		// Extension settings
		if (isset($this->request->post['product_question_status'])) {
			$data['product_question_status'] = $this->request->post['product_question_status'];
		} elseif ($this->config->get('product_question_status')) {
			$data['product_question_status'] = $this->config->get('product_question_status');
		} else {
			$data['product_question_status'] = '';
		}

		if (isset($this->request->post['product_question_admin_notification'])) {
			$data['product_question_admin_notification'] = $this->request->post['product_question_admin_notification'];
		} elseif ($this->config->get('product_question_admin_notification')) {
			$data['product_question_admin_notification'] = $this->config->get('product_question_admin_notification');
		} else {
			$data['product_question_admin_notification'] = '';
		}

		if (isset($this->request->post['product_question_admin_notification_additional'])) {
			$data['product_question_admin_notification_additional'] = $this->request->post['product_question_admin_notification_additional'];
		} elseif ($this->config->get('product_question_admin_notification_additional')) {
			$data['product_question_admin_notification_additional'] = $this->config->get('product_question_admin_notification_additional');
		} else {
			$data['product_question_admin_notification_additional'] = '';
		}

		if (isset($this->request->post['product_question_answer_language_type'])) {
			$data['product_question_answer_language_type'] = $this->request->post['product_question_answer_language_type'];
		} elseif ($this->config->get('product_question_answer_language_type')) {
			$data['product_question_answer_language_type'] = $this->config->get('product_question_answer_language_type');
		} else {
			$data['product_question_answer_language_type'] = 'customer-prefered-language';
		}

		if (isset($this->request->post['product_question_answer_language_id'])) {
			$data['product_question_answer_language_id'] = $this->request->post['product_question_answer_language_id'];
		} elseif ($this->config->get('product_question_answer_language_id')) {
			$data['product_question_answer_language_id'] = $this->config->get('product_question_answer_language_id');
		} else {
			$data['product_question_answer_language_id'] = '';
		}

		if (isset($this->request->post['product_question_force_multilanguage'])) {
			$data['product_question_force_multilanguage'] = $this->request->post['product_question_force_multilanguage'];
		} elseif ($this->config->get('product_question_force_multilanguage')) {
			$data['product_question_force_multilanguage'] = $this->config->get('product_question_force_multilanguage');
		} else {
			$data['product_question_force_multilanguage'] = '1';  // enabled by default
		}

		if (isset($this->request->post['product_question_tab_name'])) {
			$data['product_question_tab_name'] = $this->request->post['product_question_tab_name'];
		} elseif ($this->config->get('product_question_tab_name')) {
			$data['product_question_tab_name'] = $this->config->get('product_question_tab_name');
		} else {
			$data['product_question_tab_name'] = array();
		}

		if (isset($this->request->post['product_question_tab_header_position_selector'])) {
			$data['product_question_tab_header_position_selector'] = $this->request->post['product_question_tab_header_position_selector'];
		} elseif ($this->config->get('product_question_tab_header_position_selector')) {
			$data['product_question_tab_header_position_selector'] = $this->config->get('product_question_tab_header_position_selector');
		} else {
			$data['product_question_tab_header_position_selector'] = '';
		}

		if (isset($this->request->post['product_question_tab_header_position_function'])) {
			$data['product_question_tab_header_position_function'] = $this->request->post['product_question_tab_header_position_function'];
		} elseif ($this->config->get('product_question_tab_header_position_function')) {
			$data['product_question_tab_header_position_function'] = $this->config->get('product_question_tab_header_position_function');
		} else {
			$data['product_question_tab_header_position_function'] = '';
		}

		if (isset($this->request->post['product_question_tab_header_format'])) {
			$data['product_question_tab_header_format'] = html_entity_decode($this->request->post['product_question_tab_header_format'], ENT_QUOTES, 'UTF-8');
		} elseif ($this->config->get('product_question_tab_header_format')) {
			$data['product_question_tab_header_format'] = html_entity_decode($this->config->get('product_question_tab_header_format'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['product_question_tab_header_format'] = '';
		}

		if (isset($this->request->post['product_question_tab_content_position_selector'])) {
			$data['product_question_tab_content_position_selector'] = $this->request->post['product_question_tab_content_position_selector'];
		} elseif ($this->config->get('product_question_tab_content_position_selector')) {
			$data['product_question_tab_content_position_selector'] = $this->config->get('product_question_tab_content_position_selector');
		} else {
			$data['product_question_tab_content_position_selector'] = '';
		}

		if (isset($this->request->post['product_question_tab_content_position_function'])) {
			$data['product_question_tab_content_position_function'] = $this->request->post['product_question_tab_content_position_function'];
		} elseif ($this->config->get('product_question_tab_content_position_function')) {
			$data['product_question_tab_content_position_function'] = $this->config->get('product_question_tab_content_position_function');
		} else {
			$data['product_question_tab_content_position_function'] = '';
		}

		if (isset($this->request->post['product_question_tab_content_format'])) {
			$data['product_question_tab_content_format'] = html_entity_decode($this->request->post['product_question_tab_content_format'], ENT_QUOTES, 'UTF-8');
		} elseif ($this->config->get('product_question_tab_content_format')) {
			$data['product_question_tab_content_format'] = html_entity_decode($this->config->get('product_question_tab_content_format'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['product_question_tab_content_format'] = '';
		}

		if (isset($this->request->post['product_question_tab_question_limit'])) {
			$data['product_question_tab_question_limit'] = $this->request->post['product_question_tab_question_limit'];
		} elseif ($this->config->get('product_question_tab_question_limit')) {
			$data['product_question_tab_question_limit'] = $this->config->get('product_question_tab_question_limit');
		} else {
			$data['product_question_tab_question_limit'] = '';
		}

		if (isset($this->request->post['product_question_extra_button_status'])) {
			$data['product_question_extra_button_status'] = $this->request->post['product_question_extra_button_status'];
		} elseif ($this->config->get('product_question_extra_button_status')) {
			$data['product_question_extra_button_status'] = $this->config->get('product_question_extra_button_status');
		} else {
			$data['product_question_extra_button_status'] = '';
		}

		if (isset($this->request->post['product_question_extra_button_name'])) {
			$data['product_question_extra_button_name'] = $this->request->post['product_question_extra_button_name'];
		} elseif ($this->config->get('product_question_extra_button_name')) {
			$data['product_question_extra_button_name'] = $this->config->get('product_question_extra_button_name');
		} else {
			$data['product_question_extra_button_name'] = array();
		}

		if (isset($this->request->post['product_question_extra_button_format'])) {
			$data['product_question_extra_button_format'] = html_entity_decode($this->request->post['product_question_extra_button_format'], ENT_QUOTES, 'UTF-8');
		} elseif ($this->config->get('product_question_extra_button_format')) {
			$data['product_question_extra_button_format'] = html_entity_decode($this->config->get('product_question_extra_button_format'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['product_question_extra_button_format'] = '';
		}

		if (isset($this->request->post['product_question_extra_button_position_selector'])) {
			$data['product_question_extra_button_position_selector'] = $this->request->post['product_question_extra_button_position_selector'];
		} elseif ($this->config->get('product_question_extra_button_position_selector')) {
			$data['product_question_extra_button_position_selector'] = $this->config->get('product_question_extra_button_position_selector');
		} else {
			$data['product_question_extra_button_position_selector'] = '';
		}

		if (isset($this->request->post['product_question_extra_button_position_function'])) {
			$data['product_question_extra_button_position_function'] = $this->request->post['product_question_extra_button_position_function'];
		} elseif ($this->config->get('product_question_extra_button_position_function')) {
			$data['product_question_extra_button_position_function'] = $this->config->get('product_question_extra_button_position_function');
		} else {
			$data['product_question_extra_button_position_function'] = '';
		}

		if (isset($this->request->post['product_question_extra_button_behaviour'])) {
			$data['product_question_extra_button_behaviour'] = $this->request->post['product_question_extra_button_behaviour'];
		} elseif ($this->config->get('product_question_extra_button_behaviour')) {
			$data['product_question_extra_button_behaviour'] = $this->config->get('product_question_extra_button_behaviour');
		} else {
			$data['product_question_extra_button_behaviour'] = '';
		}

		if (isset($this->request->post['product_question_admin_notification_subject'])) {
			$data['product_question_admin_notification_subject'] = $this->request->post['product_question_admin_notification_subject'];
		} elseif ($this->config->get('product_question_admin_notification_subject')) {
			$data['product_question_admin_notification_subject'] = $this->config->get('product_question_admin_notification_subject');
		} else {
			$data['product_question_admin_notification_subject'] = '';
		}

		if (isset($this->request->post['product_question_admin_notification_message'])) {
			$data['product_question_admin_notification_message'] = $this->request->post['product_question_admin_notification_message'];
		} elseif ($this->config->get('product_question_admin_notification_message')) {
			$data['product_question_admin_notification_message'] = $this->config->get('product_question_admin_notification_message');
		} else {
			$data['product_question_admin_notification_message'] = '';
		}

		if (isset($this->request->post['product_question_mail'])) {
			$data['product_question_mail'] = $this->request->post['product_question_mail'];
		} elseif ($this->config->get('product_question_mail')) {
			$data['product_question_mail'] = $this->config->get('product_question_mail');
		} else {
			$data['product_question_mail'] = array();
		}

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/product_question.tpl', $data));
	}

	private function validate() {
		$tab_error = array();

		if (!$this->user->hasPermission('modify', 'module/product_question')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['product_question_tab_name'] as $language_id => $value) {
			if (utf8_strlen($value['tab_name']) < 1) {
				$this->error['tab_name'][$language_id] = $this->language->get('error_tab_name');
				$tab_error[] = $this->language->get('tab_question');
			}
		}

		if (utf8_strlen($this->request->post['product_question_tab_header_position_selector']) < 1) {
			$this->error['tab_header_position_selector'] = $this->language->get('error_tab_header_position_selector');
			$tab_error[] = $this->language->get('tab_question');
		}

		if (utf8_strlen($this->request->post['product_question_tab_content_position_selector']) < 1) {
			$this->error['tab_content_position_selector'] = $this->language->get('error_tab_content_position_selector');
			$tab_error[] = $this->language->get('tab_question');
		}

		if (!is_numeric($this->request->post['product_question_tab_question_limit']) || $this->request->post['product_question_tab_question_limit'] < 1) {
			$this->error['tab_question_limit'] = $this->language->get('error_tab_question_limit');
			$tab_error[] = $this->language->get('tab_question');
		}

		if ($this->request->post['product_question_extra_button_status']) {
			foreach ($this->request->post['product_question_extra_button_name'] as $language_id => $value) {
				if (utf8_strlen($value['extra_button_name']) < 1) {
					$this->error['extra_button_name'][$language_id] = $this->language->get('error_extra_button_name');
					$tab_error[] = $this->language->get('tab_extra_button');
				}
			}

			if (utf8_strlen($this->request->post['product_question_extra_button_position_selector']) < 1) {
				$this->error['extra_button_position_selector'] = $this->language->get('error_extra_button_position_selector');
				$tab_error[] = $this->language->get('tab_extra_button');
			}
		}

		if (utf8_strlen($this->request->post['product_question_admin_notification_subject']) < 1) {
			$this->error['admin_notification_subject'] = $this->language->get('error_admin_notification_subject');
			$tab_error[] = $this->language->get('tab_email');
		}

		if (utf8_strlen(html_entity_decode($this->request->post['product_question_admin_notification_message'], ENT_QUOTES, 'UTF-8')) < 20) {
			$this->error['admin_notification_message'] = $this->language->get('error_admin_notification_message');
			$tab_error[] = $this->language->get('tab_email');
		}

		foreach ($this->request->post['product_question_mail'] as $language_id => $value) {
			if (utf8_strlen($value['customer_answer_subject']) < 1) {
				$this->error['customer_answer_subject'][$language_id] = $this->language->get('error_customer_answer_subject');
				$tab_error[] = $this->language->get('tab_email');
			}

			if (utf8_strlen(html_entity_decode($value['customer_answer_message'], ENT_QUOTES, 'UTF-8')) < 20) {
				$this->error['customer_answer_message'][$language_id] = $this->language->get('error_customer_answer_message');
				$tab_error[] = $this->language->get('tab_email');
			}
		}

		if (!isset($this->error['warning']) && $tab_error) {
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), implode(",", array_unique($tab_error)));
		}

		return !$this->error;
	}

	private function update_check() {
		$data = 'v=' . $this->version . '&ex=43&e=' . $this->config->get('config_email') . '&ocv=' . VERSION;
        $curl = false;

        if (extension_loaded('curl')) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_URL, 'https://www.oc-extensions.com/api/v1/update_check');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'OCX-Adaptor: curl'));
			curl_setopt($ch, CURLOPT_REFERER, HTTP_CATALOG);

			if (function_exists('gzinflate')) {
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			}

			$result = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			if ($http_code == 200) {
				$result = json_decode($result);

                if ($result) {
                    $curl = true;
                }

                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}

        if (!$curl) {
			if (!$fp = @fsockopen('ssl://www.oc-extensions.com', 443, $errno, $errstr, 20)) {
				return false;
			}

			socket_set_timeout($fp, 20);

			$headers = array();
			$headers[] = "POST /api/v1/update_check HTTP/1.0";
			$headers[] = "Host: www.oc-extensions.com";
			$headers[] = "Referer: " . HTTP_CATALOG;
			$headers[] = "OCX-Adaptor: socket";
			if (function_exists('gzinflate')) {
				$headers[] = "Accept-encoding: gzip";
			}
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: application/json";
			$headers[] = 'Content-Length: '.strlen($data);
			$request = implode("\r\n", $headers)."\r\n\r\n".$data;
			fwrite($fp, $request);
			$response = $http_code = null;
			$in_headers = $at_start = true;
			$gzip = false;

			while (!feof($fp)) {
				$line = fgets($fp, 4096);

				if ($at_start) {
					$at_start = false;

					if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
						return false;
					}

					$http_code = $m[2];
					continue;
				}

				if ($in_headers) {

					if (trim($line) == '') {
						$in_headers = false;
						continue;
					}

					if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
						continue;
					}

					if ( strtolower(trim($m[1])) == 'content-encoding' && trim($m[2]) == 'gzip') {
						$gzip = true;
					}

					continue;
				}

                $response .= $line;
			}

			fclose($fp);

			if ($http_code == 200) {
				if ($gzip && function_exists('gzinflate')) {
					$response = substr($response, 10);
					$response = gzinflate($response);
				}

				$result = json_decode($response);

                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
	}

	public function import() {
		$subject_templates = array(
			'admin-notification-subject' => '[Product Question] {product.name}',
			'customer-answer-subject'    => '[Answer] {product.name}'
		);

		$tab_format_templates = array(
			'tab-header-format'  => '<li><a href="#tab-questions" data-toggle="tab">{tab.name}</a></li>',
			'tab-content-format' => '<div class="tab-pane" id="tab-questions">{tab.content}</div>'
		);

		$extra_templates = array(
			'extra-button-format' => '<div class="product-question-extra-button-area"><a href="javascript:void(0)" class="product-question-extra-button">{extra.button.name}</a></div>'
		);

		$json = array();

		if (isset($this->request->get['import_key'])) {
			$import_key = $this->request->get['import_key'];

			if (strpos($import_key, 'message') !== false) {
				$template = $this->getEmailTemplateExample($import_key);
				$target_type = 'summernote';
			} elseif (strpos($import_key, 'format') !== false) {
				if (strpos($import_key, 'extra-button') !== false) {
					$template = isset($extra_templates[$import_key]) ? $extra_templates[$import_key] : '';
				} else {
					$template = isset($tab_format_templates[$import_key]) ? $tab_format_templates[$import_key] : '';
				}

				$target_type = 'textarea';
			} else {
				$template = isset($subject_templates[$import_key]) ? $subject_templates[$import_key] : '';
				$target_type = 'input';
			}

			$json['template'] = $template;
			$json['target_type'] = $target_type;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	private function getEmailTemplateExample($key) {
		$email_template = '';

		$file = DIR_TEMPLATE . 'mail/examples/product_question/' . $key . '.tpl';

		if (file_exists($file)) {
			$email_template = file_get_contents($file);
		}

		return $email_template;
	}

	public function getTotalUnread() {
		$json = array();

		$this->load->model('catalog/question');
		$total_unread = $this->model_catalog_question->getTotalQuestionsUnread();

		$json['total_unread'] = $total_unread;

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>

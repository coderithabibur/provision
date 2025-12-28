<?php
class ControllerModuleContactPageInfo extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/contact_page_info');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('contact_page_info', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		
        // Main Section
        $data['entry_main_title'] = $this->language->get('entry_main_title');
        $data['entry_main_desc'] = $this->language->get('entry_main_desc');

        // Customer Service
        $data['entry_cs_title'] = $this->language->get('entry_cs_title');
        $data['entry_cs_text'] = $this->language->get('entry_cs_text');
        $data['entry_cs_phone'] = $this->language->get('entry_cs_phone');

        // Write To Us
        $data['entry_wtu_title'] = $this->language->get('entry_wtu_title');
        $data['entry_wtu_email'] = $this->language->get('entry_wtu_email');

        // Follow Us
        $data['entry_fu_title'] = $this->language->get('entry_fu_title');
        $data['entry_facebook'] = $this->language->get('entry_facebook');
        $data['entry_youtube'] = $this->language->get('entry_youtube');
        $data['entry_blogger'] = $this->language->get('entry_blogger');
        $data['entry_instagram'] = $this->language->get('entry_instagram');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/contact_page_info', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/contact_page_info', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['contact_page_info_status'])) {
			$data['contact_page_info_status'] = $this->request->post['contact_page_info_status'];
		} else {
			$data['contact_page_info_status'] = $this->config->get('contact_page_info_status');
		}

        // Fields
        $fields = array(
            'contact_page_info_main_title',
            'contact_page_info_main_desc',
            'contact_page_info_cs_title',
            'contact_page_info_cs_text',
            'contact_page_info_cs_phone',
            'contact_page_info_wtu_title',
            'contact_page_info_wtu_email',
            'contact_page_info_fu_title',
            'contact_page_info_facebook',
            'contact_page_info_youtube',
            'contact_page_info_blogger',
            'contact_page_info_instagram'
        );

        // Defaults for initial load
        $defaults = array(
            'contact_page_info_main_title' => 'Contact Us',
            'contact_page_info_cs_title'   => 'Customer Service',
            'contact_page_info_cs_text'    => 'Call us from 8am to 8pm',
            'contact_page_info_wtu_title'  => 'Write To Us',
            'contact_page_info_fu_title'   => 'Follow Us'
        );

        foreach ($fields as $field) {
            if (isset($this->request->post[$field])) {
                $data[$field] = $this->request->post[$field];
            } else {
                $config_value = $this->config->get($field);
                if ($config_value === null && isset($defaults[$field])) {
                    $data[$field] = $defaults[$field];
                } else {
                    $data[$field] = $config_value;
                }
            }
        }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/contact_page_info.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/contact_page_info')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}

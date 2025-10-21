<?php
class ControllerExtensionModuleCustomCode extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/custom_code');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_custom_code', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        
        // New Fields
        $data['entry_delivery_text'] = $this->language->get('entry_delivery_text');
        $data['entry_flash_sale_text'] = $this->language->get('entry_flash_sale_text');
        $data['help_delivery_text'] = $this->language->get('help_delivery_text');
        $data['help_flash_sale_text'] = $this->language->get('help_flash_sale_text');

        $data['entry_header_code'] = $this->language->get('entry_header_code');
        $data['entry_body_code'] = $this->language->get('entry_body_code');
        $data['entry_footer_code'] = $this->language->get('entry_footer_code');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['help_header_code'] = $this->language->get('help_header_code');
        $data['help_body_code'] = $this->language->get('help_body_code');
        $data['help_footer_code'] = $this->language->get('help_footer_code');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_extension'), 'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('extension/module/custom_code', 'token=' . $this->session->data['token'], 'SSL'));
		
        $data['action'] = $this->url->link('extension/module/custom_code', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        // New Fields Data
        if (isset($this->request->post['module_custom_code_delivery_text'])) {
			$data['delivery_text'] = $this->request->post['module_custom_code_delivery_text'];
		} else {
			$data['delivery_text'] = $this->config->get('module_custom_code_delivery_text');
		}

        if (isset($this->request->post['module_custom_code_flash_sale_text'])) {
			$data['flash_sale_text'] = $this->request->post['module_custom_code_flash_sale_text'];
		} else {
			$data['flash_sale_text'] = $this->config->get('module_custom_code_flash_sale_text');
		}

        if (isset($this->request->post['module_custom_code_header_code'])) {
			$data['header_code'] = $this->request->post['module_custom_code_header_code'];
		} else {
			$data['header_code'] = $this->config->get('module_custom_code_header_code');
		}

        if (isset($this->request->post['module_custom_code_body_code'])) {
			$data['body_code'] = $this->request->post['module_custom_code_body_code'];
		} else {
			$data['body_code'] = $this->config->get('module_custom_code_body_code');
		}

        if (isset($this->request->post['module_custom_code_footer_code'])) {
			$data['footer_code'] = $this->request->post['module_custom_code_footer_code'];
		} else {
			$data['footer_code'] = $this->config->get('module_custom_code_footer_code');
		}

        if (isset($this->request->post['module_custom_code_status'])) {
            $data['status'] = $this->request->post['module_custom_code_status'];
        } else {
            $data['status'] = $this->config->get('module_custom_code_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/custom_code.twig', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/custom_code')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}


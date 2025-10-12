<?php
class ControllerExtensionModuleFeaturesSection extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/features_section');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('features_section', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            
            $this->response->redirect($this->url->link(
                'extension/extension', // Changed from marketplace/extension to extension/extension for OC 2.x compatibility
                'token=' . $this->session->data['token'] . '&type=module',
                true
            ));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array(
            array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            ),
            array(
                'text' => $this->language->get('text_extension'),                
                'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
            ),
            array(
                'text' => $this->language->get('heading_title'),                
                'href' => $this->url->link('extension/module/features_section', 'token=' . $this->session->data['token'], true)
            )
        );

        $data['action'] = $this->url->link('extension/module/features_section', 'token=' . $this->session->data['token'], true);        
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        // Pass the token to the template for use in forms/AJAX
        // FIX: Added 'token' to data array
        $data['token'] = $this->session->data['token'];

        // Settings (No change needed here)
        $data['features_section_status'] = $this->request->post['features_section_status'] ?? $this->config->get('features_section_status');
        $data['features_items'] = $this->request->post['features_items'] ?? $this->config->get('features_items');

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/features_section', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/features_section')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        // This is a common pattern for token validation on save in OC 2.x/3.x modules, 
        // but it's often missing in custom modules. Let's add it for robust security.
        if (!isset($this->request->get['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
            $this->error['warning'] = $this->language->get('error_token');
        }

        return !$this->error;
    }
}
<?php
class ControllerModuleClientLogos extends Controller {
    private $error = array();

    public function index() {
        // Load language and document title
        $this->load->language('module/client_logos');
        $this->document->setTitle($this->language->get('heading_title'));

        // Load the Setting Model
        $this->load->model('setting/setting');

        // Handle POST Request (Saving the form data)
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // OC 2.x uses the module name as the config key
            $this->model_setting_setting->editSetting('client_logos', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            // Redirect back to the module list
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        // --- Prepare Data for View ---
        $data['heading_title'] = $this->language->get('heading_title');
        
        // Language variables
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_alt'] = $this->language->get('entry_alt');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_remove'] = $this->language->get('button_remove');
        
        // Check for Errors
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        // Breadcrumbs
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
            'href' => $this->url->link('module/client_logos', 'token=' . $this->session->data['token'], 'SSL')
        );

        // Action URLs
        $data['action'] = $this->url->link('module/client_logos', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        // Fetch Status Setting
        if (isset($this->request->post['client_logos_status'])) {
            $data['client_logos_status'] = $this->request->post['client_logos_status'];
        } else {
            $data['client_logos_status'] = $this->config->get('client_logos_status');
        }
        
        // --- Fetch Dynamic Logo Items ---
        if (isset($this->request->post['client_logos_item'])) {
            $data['client_logos_items'] = $this->request->post['client_logos_item'];
        } elseif ($this->config->get('client_logos_item')) {
            $data['client_logos_items'] = $this->config->get('client_logos_item');
        } else {
            $data['client_logos_items'] = array();
        }

        // Load Image Model for Image Management (Thumbnails)
        $this->load->model('tool/image');
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        // Add a thumbnail for each logo item
        foreach ($data['client_logos_items'] as &$item) {
            $item['thumb'] = $this->model_tool_image->resize($item['image'], 100, 100);
        }
        unset($item);

        // Load common elements
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/client_logos.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/client_logos')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        // Optional: Add validation for required fields
        
        return !$this->error;
    }
}
<?php
class ControllerExtensionModuleHomepageVideo extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/homepage_video');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // NOTE: OpenCart 2.1 uses a different method to save module settings
            // We are saving the module as a whole, not just one instance.
            $this->model_setting_setting->editSetting('homepage_video', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
            
            // NOTE: The redirect URL is different in OpenCart 2.1
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['entry_video_url'] = $this->language->get('entry_video_url');
        $data['entry_headline'] = $this->language->get('entry_headline');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['help_video_url'] = $this->language->get('help_video_url');
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
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/homepage_video', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('extension/module/homepage_video', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        // NOTE: Module settings are loaded differently in OpenCart 2.1
        if (isset($this->request->post['homepage_video_video_url'])) {
            $data['homepage_video_video_url'] = $this->request->post['homepage_video_video_url'];
        } else {
            $data['homepage_video_video_url'] = $this->config->get('homepage_video_video_url');
        }

        if (isset($this->request->post['homepage_video_headline'])) {
            $data['homepage_video_headline'] = $this->request->post['homepage_video_headline'];
        } else {
            $data['homepage_video_headline'] = $this->config->get('homepage_video_headline');
        }

        if (isset($this->request->post['homepage_video_status'])) {
            $data['homepage_video_status'] = $this->request->post['homepage_video_status'];
        } else {
            $data['homepage_video_status'] = $this->config->get('homepage_video_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/homepage_video.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/homepage_video')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}
<?php
class ControllerExtensionModuleFeatureSection extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/feature_section');
        $this->document->setTitle($this->language->get('heading_title'));
        
        // Use the simpler model for saving settings directly
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Use editSetting to save the module data without needing a name or module_id
            $this->model_setting_setting->editSetting('module_feature_section', $this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
            
            // Correct redirect link for OpenCart 2.1.x
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        // Load other language strings...
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        // entry_name is no longer needed
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_icon'] = $this->language->get('entry_icon');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_description'] = $this->language->get('entry_description');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_feature_add'] = $this->language->get('button_feature_add');
        $data['button_remove'] = $this->language->get('button_remove');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();
        // Correct token name 'token' for OpenCart 2.1.x
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_extension'),'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('extension/module/feature_section', 'token=' . $this->session->data['token'], 'SSL'));
		
        $data['action'] = $this->url->link('extension/module/feature_section', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->load->model('tool/image');
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        
        $data['feature_items'] = array();
        if (isset($this->request->post['module_feature_section_feature_item'])) {
			$feature_items_data = $this->request->post['module_feature_section_feature_item'];
		} else {
			$feature_items_data = $this->config->get('module_feature_section_feature_item');
		}
        
        if($feature_items_data){
            foreach($feature_items_data as $item){
                if (is_file(DIR_IMAGE . $item['icon'])) {
                    $thumb = $this->model_tool_image->resize($item['icon'], 100, 100);
                } else {
                    $thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
                }
                $data['feature_items'][] = array(
                    'icon' => $item['icon'],
                    'thumb' => $thumb,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'sort_order' => $item['sort_order']
                );
            }
        }

        if (isset($this->request->post['module_feature_section_status'])) {
            $data['status'] = $this->request->post['module_feature_section_status'];
        } else {
            $data['status'] = $this->config->get('module_feature_section_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        // Correct file extension for your Twig setup
        $this->response->setOutput($this->load->view('extension/module/feature_section.twig', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/feature_section')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        // Name validation is no longer needed
        return !$this->error;
    }
}


<?php
class ControllerExtensionModuleFeaturesSection extends Controller {
    public function index() {
        $this->load->model('setting/setting');
        $data['items'] = $this->config->get('module_features_section_items');
        return $this->load->view('extension/module/features_section', $data);
    }
}

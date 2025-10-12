<?php
class ControllerExtensionModuleFeaturesSection extends Controller {
    public function index() {
        $this->load->model('setting/setting');
        $features_items = $this->config->get('features_items');
        if (!$features_items) return;

        $data['features_items'] = $features_items;
        return $this->load->view('extension/module/features_section', $data);
    }
}

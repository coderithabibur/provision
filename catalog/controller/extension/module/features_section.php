<?php
class ControllerExtensionModuleFeaturesSection extends Controller {
    public function index() {
        return $this->load->view('extension/module/features_section');
    }
}

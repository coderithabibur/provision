<?php
class ControllerExtensionModuleHomepageVideo extends Controller {
    public function index($setting) {
        // Now this controller will receive the settings, and this check will pass
        if (isset($setting['homepage_video_status']) && $setting['homepage_video_status'] && !empty($setting['homepage_video_video_url'])) {
            
            $data['video_url'] = $setting['homepage_video_video_url'];
            $data['headline'] = $setting['homepage_video_headline'];
            
            // This will load your .tpl file from your theme folder
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/homepage_video.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/extension/module/homepage_video.tpl', $data);
            } else {
                return $this->load->view('default/template/extension/module/homepage_video.tpl', $data);
            }
        }
    }
}
<?php
class ControllerExtensionModuleClientLogos extends Controller {
    public function index($setting) { 
        if (isset($setting['client_logos_status']) && $setting['client_logos_status']) {
            $this->load->model('tool/image');
 
            $data['title'] = isset($setting['client_logos_title']) ? $setting['client_logos_title'] : '';
            
            $data['logos'] = array();
 
            if (isset($setting['client_logos_logo'])) {
                $logos = $setting['client_logos_logo'];
            } else {
                $logos = array();
            }
            
            if ($logos) {
                usort($logos, function($a, $b) { 
                    return (int)$a['sort_order'] - (int)$b['sort_order'];
                });
            }

            foreach ($logos as $logo) { 
                if (is_file(DIR_IMAGE . $logo['image'])) {
                    $data['logos'][] = array( 
                        'image' => $this->model_tool_image->resize($logo['image'], 130, 60), 
                        'link'  => $logo['link'],
                    );
                } 
            } 
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/client_logos.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/extension/module/client_logos.tpl', $data);
            } else {
                return $this->load->view('default/template/extension/module/client_logos.tpl', $data);
            }
        }
    }
}


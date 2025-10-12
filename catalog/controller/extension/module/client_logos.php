<?php
class ControllerModuleClientLogos extends Controller {
    public function index() {
        // Get module ID from the URL (for layout/position assignments)
        $setting = $this->config->get('client_logos_module_' . $this->request->get['module_id']);
        
        // Ensure the module instance is enabled
        if (!empty($setting) && $setting['status']) {
            $this->load->language('module/client_logos');
            $this->load->model('tool/image');
            
            $data['heading_title'] = $this->language->get('heading_title');
            $data['client_logos'] = array();

            // Get the list of logos saved in the admin
            $logos = $this->config->get('client_logos_item');
            
            if ($logos) {
                foreach ($logos as $logo) {
                    if ($logo['image']) {
                        // Resize the image - set the desired size (e.g., 200 width, 100 height)
                        $image_url = $this->model_tool_image->resize($logo['image'], 200, 100); 

                        $data['client_logos'][] = array(
                            'image' => $image_url,
                            'alt'   => $logo['alt'],
                            'link'  => $logo['link']
                        );
                    }
                }
            }

            // OC 2.x uses $this->load->view('path/to/tpl', $data)
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/client_logos.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/client_logos.tpl', $data);
            } else {
                return $this->load->view('default/template/module/client_logos.tpl', $data);
            }
        }
    }
}
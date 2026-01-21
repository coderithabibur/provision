<?php
class ControllerExtensionModuleFeatureSection extends Controller {
    public function index($setting) {
        // Check if the module status is enabled in the settings
        if (isset($setting['module_feature_section_status']) && $setting['module_feature_section_status']) {
            $data['features'] = array();

            // Get the array of feature items from the settings
            if (isset($setting['module_feature_section_feature_item'])) {
                $features = $setting['module_feature_section_feature_item'];
            } else {
                $features = array();
            }
            
            // Sort the features based on the sort_order value
            if ($features) {
                usort($features, function($a, $b) {
                    return (int)$a['sort_order'] - (int)$b['sort_order'];
                });
            }

            $this->load->model('tool/image');
            // Process each feature item for the template
            foreach ($features as $feature) {
                if (!empty($feature['icon']) && is_file(DIR_IMAGE . $feature['icon'])) {
                    $data['features'][] = array( 
                        'icon'        => $this->model_tool_image->resize($feature['icon'], 80, 80),
                        'title'       => $feature['title'],
                        'description' => $feature['description']
                    );
                }
            }

            // Load the .twig template file for your theme
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/feature_section.twig')) {
                return $this->load->view($this->config->get('config_template') . '/template/extension/module/feature_section.twig', $data);
            } else {
                return $this->load->view('default/template/extension/module/feature_section.twig', $data);
            }
        }
    }
}


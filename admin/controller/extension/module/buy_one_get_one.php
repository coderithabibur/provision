<?php
class ControllerExtensionModuleBuyOneGetOne extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/buy_one_get_one');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting'); // Use the simple settings model

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Use editSetting to save all data under one group key
            $this->model_setting_setting->editSetting('module_buy_one_get_one', $this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        // Load language strings
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['help_product'] = $this->language->get('help_product');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_offer'] = $this->language->get('button_add_offer');
        $data['button_remove'] = $this->language->get('button_remove');
        
        if (isset($this->error['warning'])) { $data['error_warning'] = $this->error['warning']; } else { $data['error_warning'] = ''; }

        // Breadcrumbs
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_extension'), 'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('extension/module/buy_one_get_one', 'token=' . $this->session->data['token'], 'SSL'));
		
        $data['action'] = $this->url->link('extension/module/buy_one_get_one', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['token'] = $this->session->data['token'];

        // Load saved data using the config object
        if (isset($this->request->post['module_buy_one_get_one_title'])) { 
            $data['title'] = $this->request->post['module_buy_one_get_one_title']; 
        } else { 
            $data['title'] = $this->config->get('module_buy_one_get_one_title'); 
        }
        
        $this->load->model('catalog/product');
        $data['offers'] = array();
        
        if (isset($this->request->post['module_buy_one_get_one_offer'])) { 
            $offers = $this->request->post['module_buy_one_get_one_offer']; 
        } else { 
            $offers = $this->config->get('module_buy_one_get_one_offer'); 
        }

        if(!empty($offers)){
            foreach ($offers as $offer) {
                if (isset($offer['product_id'])) {
                    $product_info = $this->model_catalog_product->getProduct($offer['product_id']);
                    if ($product_info) {
                        $data['offers'][] = array(
                            'product_id' => $product_info['product_id'], 
                            'name' => $product_info['name']
                        );
                    }
                }
            }
        }
        
        if (isset($this->request->post['module_buy_one_get_one_status'])) { 
            $data['status'] = $this->request->post['module_buy_one_get_one_status']; 
        } else { 
            $data['status'] = $this->config->get('module_buy_one_get_one_status'); 
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/buy_one_get_one.twig', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/buy_one_get_one')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}


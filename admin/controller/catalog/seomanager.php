<?php 
class ControllerCatalogseomanager extends Controller { 
    private $error = array();
    
    public function index() {  

        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");    
        
        $this->load->model('catalog/seomanager');
        $this->model_catalog_seomanager->createTablesInDatabse();
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'index';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }
        $url = '';
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->load->language('catalog/seomanager');
        $this->document->setTitle($this->language->get('heading_title'));
        
        $data['heading_title'] = $this->language->get('heading_title');
         
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        
        if (isset($this->request->post['fromTable'])) {
            $data['fromTable'] = $this->request->post['fromTable'];
        } else {
            $data['fromTable'] = '';
        }
        
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'] . $url, 'SSL'),            
            'separator' => ' :: '
        );
        $data['status'] = $this->language->get('status');
        $data['mstatus'] = $this->language->get('mstatus');
        $data['from_url'] = $this->language->get('from_url'); 
        $data['button_insert'] = $this->language->get('button_insert');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_redirect_table'] = $this->language->get('text_redirect_table');
        $data['failed'] = $this->language->get('failed');
        $data['button_save'] = $this->language->get('button_save');
        $data['url_test'] = $this->language->get('url_test');
        $data['url_test_redirect'] = $this->language->get('url_test_redirect');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
        $data['delete'] = $this->language->get('delete');
        $data['times_used'] = $this->language->get('times_used');
        $data['help'] = $this->language->get('help');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['action'] = $this->url->link('catalog/seomanager/insert', 'token=' . $this->session->data['token'], 'SSL');
        $data['to_url'] = $this->language->get('to_url');
        $data['redirect_table'] = $this->url->link('catalog/seomanager/failedlinks', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['token'] = $this->session->data['token'];
        $data['redirectstatus'] = $this->config->get('config_redirect_status');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
        
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data1 = array(
            'sort'            => $sort,
            'order'           => $order,
            'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'           => $this->config->get('config_limit_admin')
        );

        $data['redirectlist'] = $this->model_catalog_seomanager->getList($data1);
        $data['redirecttotal'] = $this->model_catalog_seomanager->getTotalList($data1);

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_status'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_fromUrl'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'] . '&sort=fromUrl' . $url, 'SSL');
        $data['sort_toUrl'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'] . '&sort=toUrl' . $url, 'SSL');
        $data['sort_times_used'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'] . '&sort=times_used' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }
                                                
        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $data['sort'] = $sort;
        $data['order'] = $order;

        $pagination = new Pagination();
        $pagination->total = $data['redirecttotal'];
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($data['redirecttotal']) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($data['redirecttotal'] - $this->config->get('config_limit_admin'))) ? $data['redirecttotal'] : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $data['redirecttotal'], ceil($data['redirecttotal'] / $this->config->get('config_limit_admin')));
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('catalog/seomanager.tpl', $data));
    }

    public function insert() {
        $json = array();
        if (!$this->user->hasPermission('modify', 'catalog/seomanager')) {
            $json['warning'] = "We are sorry !! But you don't have permission to modify this redirections";
        } else {
            $status = array();
            $status['config_redirect_status'] = $this->request->get['value'];
            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting('config_redirect_status', $status);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function update() {
        $json = array();
        if (!$this->user->hasPermission('modify', 'catalog/seomanager')) {
            $json['warning'] = "We are sorry !! But you don't have permission to modify this redirections";
        }  else {
            $this->load->model('catalog/seomanager');
            $this->model_catalog_seomanager->updateUrl($this->request->post);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function delete() {
        $json = array();
        if (!$this->user->hasPermission('modify', 'catalog/seomanager')) {
            $json['warning'] = "We are sorry !! But you don't have permission to modify this redirections";
        } else {
            $this->load->model('catalog/seomanager');
            $this->model_catalog_seomanager->deleteUrl($this->request->get);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function reset() {
        $json = array();
        if (!$this->user->hasPermission('modify', 'catalog/seomanager')) {
            $json['warning'] = "We are sorry !! But you don't have permission to modify this redirections";
        } else {
            $this->load->model('catalog/seomanager');
            $this->model_catalog_seomanager->reset($this->request->get);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function inserting() {
        $json = array();
        if (!$this->user->hasPermission('modify', 'catalog/seomanager')) {
            $json['warning'] = "We are sorry !! But you don't have permission to modify this redirections";
        } else {
            $this->load->model('catalog/seomanager');
            $this->model_catalog_seomanager->addUrl1($this->request->post);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

        public function failedlinks() {       

        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");

        $this->load->model('catalog/seomanager');
        $this->model_catalog_seomanager->createTablesInDatabse();
        
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'index';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }
        $url = '';
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->load->language('catalog/failedtable');
        $this->document->setTitle($this->language->get('heading_title'));
        
        $data['heading_title'] = $this->language->get('heading_title');
         
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/failedtable', 'token=' . $this->session->data['token'] . $url, 'SSL'),             
            'separator' => ' :: '
        );

        $data['failed_url'] = $this->language->get('failed_url');
        $data['date'] = $this->language->get('date');
        $data['count'] = $this->language->get('count');
        $data['create_redirect'] = $this->language->get('create_redirect');
        $data['insert_redirect'] = $this->language->get('insert_redirect');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['cancel'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'], 'SSL');
        $data['clear_all_urls'] = $this->language->get('clear_all_urls');
        $data['clear_all'] = $this->url->link('catalog/seomanager/clear', 'token=' . $this->session->data['token'], 'SSL'); 

        $data['token'] = $this->session->data['token'];
        $data['redirectstatus'] = $this->config->get('config_redirect_status');
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
        
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data1 = array(
            'sort'            => $sort,
            'order'           => $order,
            'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit'           => $this->config->get('config_admin_limit')
        );

        $this->load->model('catalog/seomanager');
        $this->model_catalog_seomanager->createTablesInDatabse();
        $data['redirectlist'] = $this->model_catalog_seomanager->getListt($data1);
        foreach ($data['redirectlist'] as $key => $value) {
            $data['redirectlist'][$key]['action'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'], 'SSL');
        }
        
        $data['redirecttotal'] = $this->model_catalog_seomanager->getTotalListt($data1);

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_date'] = $this->url->link('catalog/seomanager/failedlinks', 'token=' . $this->session->data['token'] . '&sort=date' . $url, 'SSL');
        $data['sort_failed_url'] = $this->url->link('catalog/seomanager/failedlinks', 'token=' . $this->session->data['token'] . '&sort=failed_Url' . $url, 'SSL');
        $data['sort_count'] = $this->url->link('catalog/seomanager/failedlinks', 'token=' . $this->session->data['token'] . '&sort=count' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }
                                                
        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total =$data['redirecttotal'];
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('catalog/seomanager/failedlinks', 'token=' . $this->session->data['token'] . $url .'&page={page}', 'SSL');
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['pagination'] = $pagination->render();
        

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/failedtable.tpl', $data));
    }

    public function clear(){
        $this->load->model('catalog/seomanager');
        $this->load->language('catalog/failedtable');
        $this->model_catalog_seomanager->clear();
        $this->session->data['success'] = $this->language->get('text_success');
        $this->response->redirect($this->url->link('catalog/failedtable', 'token=' . $this->session->data['token'], 'SSL'));
    }


}
?>
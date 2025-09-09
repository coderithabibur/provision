<?php 
class ControllerCatalogSitemap extends Controller { 
    private $error = array();
    
    public function index() {

         $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");


        $this->load->language('catalog/sitemap');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('catalog/sitemap');

        $data['heading_title'] = $this->language->get('heading_title');
        $data['button_generate'] = $this->language->get('button_generate');
        
        $data['seordata'] = $this->language->get('seordata');
        $data['help'] = $this->language->get('help');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
        
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

        if (isset($this->session->data['output'])) {
            $data['output'] = $this->session->data['output'];
        
            unset($this->session->data['output']);
        } else {
            $data['output'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),             
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/sitemap', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['sitemapg'] = $this->url->link('catalog/sitemap/generate', 'token=' . $this->session->data['token'], 'SSL');

        $data['generate'] = $this->url->link('catalog/sitemap/generate', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->load->model('catalog/sitemap');

        if(file_exists(DIR_SYSTEM."../sitemap.xml")) {
            $data['sitemapexists'] = HTTP_CATALOG."sitemap.xml";
        }
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/sitemap.tpl', $data));
    }
    
    public function generate() {
        $this->load->language('catalog/sitemap');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('catalog/sitemap');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
            $this->session->data['output'] = $this->model_catalog_sitemap->generate();          
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('catalog/sitemap', 'token=' . $this->session->data['token'], 'SSL'));
        } else {
            return $this->forward('error/permission');
        }
    }
    
    private function validate() {
        if (!$this->user->hasPermission('modify', 'catalog/sitemap')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }       
    }
}
?>
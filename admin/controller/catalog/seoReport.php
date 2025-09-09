<?php
class ControllerCatalogSeoReport extends Controller {

    public function index() {

        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['version'] = str_replace(".","",VERSION);
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        $this->language->load('catalog/seoReport');
        $this->load->model('catalog/seoReport');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addLink("view/stylesheet/allseo.css","stylesheet");

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/seoReport', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

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
        
        $data['cancel'] =  $this->url->link('catalog/seoReport', 'token=' . $this->session->data['token'], 'SSL');

        $data['heading_title'] = $this->language->get('heading_title');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['text_seoreport_duplicate'] = $this->language->get('text_seoreport_duplicate');
        $data['seordata'] = $this->language->get('seordata');
        $data['token'] = $this->session->data['token'];
        $data['create_report'] = $this->language->get('create_report');
        $data['total'] = $this->language->get('total');
        $data['mk'] = $this->language->get('mk');
        $data['md'] = $this->language->get('md');
        $data['sd'] = $this->language->get('sd');
       
        $data['sitemap'] = $this->language->get('sitemap');
        $data['sitemapt'] = $this->language->get('sitemapt');
        $data['sitemapnt'] = $this->language->get('sitemapnt');
        $data['sitemapnso'] = $this->language->get('sitemapnso');
        $data['sitemapfound']  =  file_exists('../sitemap.xml');
        $data['sitemapso'] = sprintf($this->language->get('sitemapso'),$this->url->link('catalog/sitemap', 'token=' . $this->session->data['token'], 'SSL'));

        
        $data['robots'] = $this->language->get('robots');
        $data['robotst'] = sprintf($this->language->get('robotst'),HTTP_CATALOG."robots.txt");
        $data['robotsnt'] = $this->language->get('robotsnt');
        $data['robotsso'] = $this->language->get('robotsso');
        $data['robotsnso'] = $this->language->get('robotsnso');
        $data['robotsfound']  =  file_exists('../robots.txt');


        if ($this->request->server['HTTPS']) {
            $data['catalog'] = HTTPS_CATALOG;
        } else {
            $data['catalog'] = HTTPS_CATALOG;
        }
        $data['productreport'] = $this->model_catalog_seoReport->getreport1();
        $data['productmetatitle'] = $this->model_catalog_seoReport->getreport7('product_description');
        $data['productmetakey'] = $this->model_catalog_seoReport->getreport9('product_description');
        $data['productmetadesc'] = $this->model_catalog_seoReport->getreport8('product_description');

        $data['catreport'] = $this->model_catalog_seoReport->getreport2(0);
        $data['inforeport'] = $this->model_catalog_seoReport->getreport3(0);

        $data['manreport'] = $this->model_catalog_seoReport->getreport4(0);

        $data['genreport'] = $this->model_catalog_seoReport->getreport5();
        
        $data['seokeyword'] = $this->model_catalog_seoReport->getreport6();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/seoReport.tpl', $data));
    }

    public function catreport() {

        $this->load->model('catalog/seoReport');
        $data['seoreport'] = $this->model_catalog_seoReport->getreport2(1);
        $data['categorymetatitle'] = $this->model_catalog_seoReport->getreport7('category_description');
        $data['categorymetadesc'] = $this->model_catalog_seoReport->getreport8('category_description');
        $data['categorymetakey'] = $this->model_catalog_seoReport->getreport9('category_description');
        $this->response->setOutput(json_encode($data));

    }

    public function inforeport() {

        $this->load->model('catalog/seoReport');
        $data['inforeport'] = $this->model_catalog_seoReport->getreport3(1);
        $data['informationmetatitle'] = $this->model_catalog_seoReport->getreport7('information_description');
        $data['informationmetadesc'] = $this->model_catalog_seoReport->getreport8('information_description');
        $data['informationmetakey'] = $this->model_catalog_seoReport->getreport9('information_description');
        $this->response->setOutput(json_encode($data));
        
    }

    public function manreport() {

        $this->load->model('catalog/seoReport');
        $data['manreport'] = $this->model_catalog_seoReport->getreport4(1);
        $data['manreport_duplicatereport'] = $this->model_catalog_seoReport->getreport10();
        $this->response->setOutput(json_encode($data));
        
    }

    public function duplicatereport() {
        $number = $this->request->post['number'];
        $name = $this->request->post['name'];
        $report = array();
        $this->load->model('catalog/seoReport');
        if($number == 7) {
          $report =  $this->model_catalog_seoReport->getreport7($name);
        }
        if($number == 8) {
          $report =  $this->model_catalog_seoReport->getreport8($name);
        }
        if($number == 9) {
          $report =  $this->model_catalog_seoReport->getreport9($name);
        }
        if($number == 11) {
          $report =  $this->model_catalog_seoReport->getreport11($name);
        }
        
        $this->response->setOutput(json_encode($report));
    }

    public function getreport() {
        $this->load->model('catalog/seoReport');
        
        $results1 = $this->model_catalog_seoReport->getreport1();
        $results2 = $this->model_catalog_seoReport->getreport2(1);
        $results3 = $this->model_catalog_seoReport->getreport3();
        $results4 = $this->model_catalog_seoReport->getreport4();
        $sitemap  =  file_exists('../sitemap.xml');
        $results = array('products' => $results1, 'categories' => $results2 ,'information' => $results3,'manufacturer' => $results4,'sitemap' => $sitemap);
        $this->response->setOutput(json_encode($results));
    }

     public function getreport1() {
        $this->load->model('catalog/seoReport');
        
        $results1 = $this->model_catalog_seoReport->getreport1();
        $results2 = $this->model_catalog_seoReport->getreport2(1);
        $results3 = $this->model_catalog_seoReport->getreport3();
        $results4 = $this->model_catalog_seoReport->getreport4();
        $sitemap  =  file_exists('../sitemap.xml');
        $results = array('products' => $results1, 'categories' => $results2 ,'information' => $results3,'manufacturer' => $results4,'sitemap' => $sitemap);
        $this->response->setOutput(json_encode($results));
    }

}
?>
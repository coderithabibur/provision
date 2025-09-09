<?php
class ControllerCatalogSeo extends Controller {

    protected $error = array();

     public function customizeproduct() {

        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['version'] = str_replace(".","",VERSION);

        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        //$this->load->helper('seo_validator');

        $helper = 'seo_validator';

        $file = DIR_SYSTEM . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load helper ' . $helper . '!');
            exit();
        }

        $this->validate = new SeoValidator($this->registry);

        $this->language->load('catalog/seo');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('view/javascript/jquery/jquery.tipTip.minified.js');
        $this->document->addLink("view/stylesheet/allseo.css","stylesheet");

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate($this->request->post))) {

            $post_data = $this->request->post;
               
            foreach($post_data['product']['keyword'] as $product_id => $keyword) {
               
                $object = new SeoProduct($this->registry);
                $object->setSeoKeyword($keyword);
                $object->setQuery('product_id='.$product_id);

                $title = $meta_description = $meta_keywords = array();

                foreach($post_data['product']['product_description'][$product_id] as $language_id => $r) {
                    $title[$language_id] = $r['title'];
                    $meta_keywords[$language_id] = $r['meta_keywords'];
                    $meta_description[$language_id] = $r['meta_description'];
                    $tags[$language_id] = $r['tags'];
                }

                $object->setTitle($title);
                $object->setId($product_id);
                $object->setMetaKeywords($meta_keywords);
                $object->setMetaDescription($meta_description);
                $object->setTags($tags);
                $object->save();
            }


            $data['tab'] = $post_data['tab'];
            $this->session->data['success'] = $this->language->get('text_success_'.$post_data['tab']);

            $url = '';
                        
            if (isset($this->request->get['filter_keyword'])) {
                $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
            }  

            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            } 
            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }    

            $this->response->redirect($this->url->link("catalog/seo/customizeproduct","token=" . $this->session->data['token'] . $url,"SSL"));

        }

        $data['success'] = '';
        if(isset($this->session->data['success'])){
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        }    

        if (isset($this->request->get['filter_keyword'])) {
            $filter_keyword = $this->request->get['filter_keyword'];
        } else {
            $filter_keyword = '';
        }

         if (isset($this->request->get['filter_category'])) {
            $filter_category = $this->request->get['filter_category'];
        } else {
            $filter_category = '';
        }
        
        $url = '';
                        
        if (isset($this->request->get['filter_keyword'])) {
            $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
        }  

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        } 
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }      
       

        $data['heading_title'] = $this->language->get('heading_title');
        $data['description_st'] = $this->language->get('description');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_keyword'] = $this->language->get('entry_keyword');

        $data['column_url'] = $this->language->get('column_url');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_image'] = $this->language->get('column_image');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_title'] = $this->language->get('column_title');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_meta_keyword'] = $this->language->get('column_meta_keyword');
        $data['column_meta_description'] = $this->language->get('column_meta_description');
        $data['column_tags'] = $this->language->get('column_tags');
        $data['custom_url_help'] = $this->language->get('custom_url_help');


        $data['domain'] = $this->config->get('config_url');

        $data['button_autofill'] = $this->language->get('button_autofill');
        $data['button_save'] = $this->language->get('button_save');
        $data['helpedit'] = $this->language->get('helpedit');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_add_custom_url_store'] = $this->language->get('button_add_custom_url_store');
        $data['button_save_general'] = $this->language->get('button_save_general');
        $data['button_save_products'] = $this->language->get('button_save_products');
        $data['button_save_categories'] = $this->language->get('button_save_categories');
        $data['button_save_manufacturers'] = $this->language->get('button_save_manufacturers');
        $data['button_save_information_pages'] = $this->language->get('button_save_information_pages');

        $data['title_help'] = $this->language->get('title_help');
        $data['keywords_help'] = $this->language->get('keywords_help');
        $data['description_help'] = $this->language->get('description_help');
        $data['tags_help'] = $this->language->get('tags_help');

        $data['tab_general']  = $this->language->get('tab_general');
        $data['tab_products'] = $this->language->get('tab_products');
        $data['tab_categories'] = $this->language->get('tab_categories');
        $data['tab_manufacturers'] = $this->language->get('tab_manufacturers');
        $data['tab_information_pages'] = $this->language->get('tab_information_pages');

        $data['tab_general_help']  = $this->language->get('tab_general_help');
        $data['tab_products_help'] = $this->language->get('tab_products_help');
        $data['tab_categories_help'] = $this->language->get('tab_categories_help');
        $data['tab_manufacturers_help'] = $this->language->get('tab_manufacturers_help');
        $data['tab_information_pages_help'] = $this->language->get('tab_information_pages_help');
       
        $this->languages = $this->model_catalog_seo->getLanguages();

        foreach($this->languages as $language){
            $data['currency'] = $language['language_id'];
            break;
        }

        if (isset($this->error['title'])) {
            foreach($this->error['title'] as $key => $value){
                $data['error_'.$key] = $this->error['title'][$key];
            }
        }

        if(isset($this->error['already_exists'])){
            $data['error_already_exists'] = $this->error['already_exists'];
        }else{
            $data['error_already_exists'] = '';
        }

        $data['languages'] = $this->languages;

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }       

        $data['autofill'] = $this->url->link("catalog/seo/loadgeneralauto","token=" . $this->session->data['token'],"SSL");
        $data['action'] = $this->url->link("catalog/seo/customizeproduct","token=" . $this->session->data['token'].$url,"SSL");
        $data['cancel'] = $this->url->link("catalog/seo/customizeproduct","token=" . $this->session->data['token'],"SSL");
        $data['filter'] =  $this->url->link("catalog/seo/customizeproduct","token=" . $this->session->data['token'],"SSL");
        
        $data['token'] = $this->session->data['token'];
        $this->load->model('tool/image');

        $this->config_limit_admin = $this->config->get('config_limit_admin');

        $data['products'] = $this->loadProducts($filter_keyword);
              


        if (isset($this->request->post['custom_url_store_status'])) {
            $data['custom_url_store_status'] = $this->request->post['custom_url_store_status'];
        } else {
            $data['custom_url_store_status'] = $this->config->get('custom_url_store_status');
        }
        
        $data['filter_keyword'] = $filter_keyword;
        $data['filter_category'] = $filter_category;

        $url = '';
                        
        if (isset($this->request->get['filter_keyword'])) {
            $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
        }  

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        }

        $data['pagination_product'] = $this->multiPagination('pagination_product',$this->config_limit_admin, $this->product_total, $this->page_product, $url);
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('catalog/seocustomize_product.tpl', $data));
    }

    public function customizecategory() {

        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['version'] = str_replace(".","",VERSION);
        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        //$this->load->helper('seo_validator');

        $helper = 'seo_validator';

        $file = DIR_SYSTEM . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load helper ' . $helper . '!');
            exit();
        }

        $this->validate = new SeoValidator($this->registry);

        $this->language->load('catalog/seo');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('view/javascript/jquery/jquery.tipTip.minified.js');
        $this->document->addLink("view/stylesheet/allseo.css","stylesheet");

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate($this->request->post))) {

            $post_data = $this->request->post;
               
            foreach($post_data['category']['keyword'] as $category_id => $keyword) {
                $object = new SeoCategory($this->registry);
                $object->setSeoKeyword($keyword);
                $object->setQuery('category_id='.$category_id);

                $title = $meta_description = $meta_keywords = array();

                foreach($post_data['category']['category_description'][$category_id] as $language_id => $r) {
                    $title[$language_id] = $r['title'];
                    $meta_keywords[$language_id] = $r['meta_keywords'];
                    $meta_description[$language_id] = $r['meta_description'];
                }

                $object->setTitle($title);
                $object->setId($category_id);
                $object->setMetaKeywords($meta_keywords);
                $object->setMetaDescription($meta_description);
                $object->save();
            }


            $this->session->data['success'] = $this->language->get('text_success_tab_categories');

            $url = '';
                        
            if (isset($this->request->get['filter_keyword'])) {
                $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
            }  

            if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            } 
            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }    

            $this->response->redirect($this->url->link("catalog/seo/customizecategory","token=" . $this->session->data['token'] . $url,"SSL"));

        }

        $data['success'] = '';
        if(isset($this->session->data['success'])){
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        }    

        if (isset($this->request->get['filter_keyword'])) {
            $filter_keyword = $this->request->get['filter_keyword'];
        } else {
            $filter_keyword = '';
        }

         if (isset($this->request->get['filter_category'])) {
            $filter_category = $this->request->get['filter_category'];
        } else {
            $filter_category = '';
        }
        
        $url = '';
                        
        if (isset($this->request->get['filter_keyword'])) {
            $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
        }  

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        } 
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }      
       

        $data['heading_title'] = $this->language->get('heading_title');
        $data['description_st'] = $this->language->get('description');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_keyword'] = $this->language->get('entry_keyword');

        $data['column_url'] = $this->language->get('column_url');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_image'] = $this->language->get('column_image');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_title'] = $this->language->get('column_title');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_meta_keyword'] = $this->language->get('column_meta_keyword');
        $data['column_meta_description'] = $this->language->get('column_meta_description');
        $data['column_tags'] = $this->language->get('column_tags');
        $data['custom_url_help'] = $this->language->get('custom_url_help');


        $data['domain'] = $this->config->get('config_url');

        $data['button_autofill'] = $this->language->get('button_autofill');
        $data['button_save'] = $this->language->get('button_save');
        $data['helpedit'] = $this->language->get('helpedit');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_add_custom_url_store'] = $this->language->get('button_add_custom_url_store');
        $data['button_save_general'] = $this->language->get('button_save_general');
        $data['button_save_categorys'] = $this->language->get('button_save_categorys');
        $data['button_save_categories'] = $this->language->get('button_save_categories');
        $data['button_save_manufacturers'] = $this->language->get('button_save_manufacturers');
        $data['button_save_information_pages'] = $this->language->get('button_save_information_pages');

        $data['title_help'] = $this->language->get('title_help');
        $data['keywords_help'] = $this->language->get('keywords_help');
        $data['description_help'] = $this->language->get('description_help');
        $data['tags_help'] = $this->language->get('tags_help');

        $data['tab_general']  = $this->language->get('tab_general');
        $data['tab_products'] = $this->language->get('tab_products');
        $data['tab_categories'] = $this->language->get('tab_categories');
        $data['tab_manufacturers'] = $this->language->get('tab_manufacturers');
        $data['tab_information_pages'] = $this->language->get('tab_information_pages');

        $data['tab_general_help']  = $this->language->get('tab_general_help');
        $data['tab_products_help'] = $this->language->get('tab_products_help');
        $data['tab_categories_help'] = $this->language->get('tab_categories_help');
        $data['tab_manufacturers_help'] = $this->language->get('tab_manufacturers_help');
        $data['tab_information_pages_help'] = $this->language->get('tab_information_pages_help');

       
        $this->languages = $this->model_catalog_seo->getLanguages();

        foreach($this->languages as $language){
            $data['currency'] = $language['language_id'];
            break;
        }

        if (isset($this->error['title'])) {
            foreach($this->error['title'] as $key => $value){
                $data['error_'.$key] = $this->error['title'][$key];
            }
        }

        if(isset($this->error['already_exists'])){
            $data['error_already_exists'] = $this->error['already_exists'];
        }else{
            $data['error_already_exists'] = '';
        }

        $data['languages'] = $this->languages;

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }       

        $data['autofill'] = $this->url->link("catalog/seo/loadgeneralauto","token=" . $this->session->data['token'],"SSL");
        $data['action'] = $this->url->link("catalog/seo/customizecategory","token=" . $this->session->data['token'].$url,"SSL");
        $data['cancel'] = $this->url->link("catalog/seo/customizecategory","token=" . $this->session->data['token'],"SSL");
        $data['filter'] =  $this->url->link("catalog/seo/customizecategory","token=" . $this->session->data['token'],"SSL");
        
        $data['token'] = $this->session->data['token'];
        $this->load->model('tool/image');

        $this->config_limit_admin = $this->config->get('config_limit_admin');

        $data['categorys'] = $this->loadCategories($filter_category);

        if (isset($this->request->post['custom_url_store_status'])) {
            $data['custom_url_store_status'] = $this->request->post['custom_url_store_status'];
        } else {
            $data['custom_url_store_status'] = $this->config->get('custom_url_store_status');
        }
        
        $data['filter_keyword'] = $filter_keyword;
        $data['filter_category'] = $filter_category;

        $url = '';
                        
        if (isset($this->request->get['filter_keyword'])) {
            $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
        }  

        if (isset($this->request->get['filter_category'])) {
            $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
        } 

        $data['pagination_category'] =  $this->multiPaginationCategory('pagination_category',$this->config_limit_admin, $this->category_total, $this->page_category, $url);
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('catalog/seocustomize_category.tpl', $data));
    }

    public function customizeinformation() {

        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['version'] = str_replace(".","",VERSION);
        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        //$this->load->helper('seo_validator');

        $helper = 'seo_validator';

        $file = DIR_SYSTEM . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load helper ' . $helper . '!');
            exit();
        }

        $this->validate = new SeoValidator($this->registry);

        $this->language->load('catalog/seo');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('view/javascript/jquery/jquery.tipTip.minified.js');
        $this->document->addLink("view/stylesheet/allseo.css","stylesheet");
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate($this->request->post))) {
            
            $post_data = $this->request->post;

           foreach($post_data['information']['keyword'] as $information_id => $keyword) {
                
                $object = new SeoInformation($this->registry);
                $object->setSeoKeyword($keyword);
                $object->setQuery('information_id='.$information_id);

                $title = $meta_description = $meta_keywords = array();

                foreach($post_data['information']['information_description'][$information_id] as $language_id => $r) {
                    $title[$language_id] = $r['title'];
                    $meta_keywords[$language_id] = $r['meta_keywords'];
                    $meta_description[$language_id] = $r['meta_description'];
                }

                $object->setTitle($title);
                $object->setId($information_id);
                $object->setMetaKeywords($meta_keywords);
                $object->setMetaDescription($meta_description);
                $object->save();

            }

            $this->session->data['success'] = $this->language->get('text_success_tab_information_pages');
  
            $this->response->redirect($this->url->link("catalog/seo/customizeinformation","token=" . $this->session->data['token'] . $url,"SSL"));
        }

        $data['success'] = '';
        if(isset($this->session->data['success'])){
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        }      

        $data['heading_title'] = $this->language->get('heading_title');
        $data['description_st'] = $this->language->get('description');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_keyword'] = $this->language->get('entry_keyword');

        $data['column_url'] = $this->language->get('column_url');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_image'] = $this->language->get('column_image');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_title'] = $this->language->get('column_title');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_meta_keyword'] = $this->language->get('column_meta_keyword');
        $data['column_meta_description'] = $this->language->get('column_meta_description');
        $data['column_tags'] = $this->language->get('column_tags');
        $data['custom_url_help'] = $this->language->get('custom_url_help');


        $data['domain'] = $this->config->get('config_url');

        $data['button_autofill'] = $this->language->get('button_autofill');
        $data['button_save'] = $this->language->get('button_save');
        $data['helpedit'] = $this->language->get('helpedit');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_add_custom_url_store'] = $this->language->get('button_add_custom_url_store');
        $data['button_save_general'] = $this->language->get('button_save_general');
        $data['button_save_categorys'] = $this->language->get('button_save_categorys');
        $data['button_save_categories'] = $this->language->get('button_save_categories');
        $data['button_save_manufacturers'] = $this->language->get('button_save_manufacturers');
        $data['button_save_information_pages'] = $this->language->get('button_save_information_pages');

        $data['title_help'] = $this->language->get('title_help');
        $data['keywords_help'] = $this->language->get('keywords_help');
        $data['description_help'] = $this->language->get('description_help');
        $data['tags_help'] = $this->language->get('tags_help');

        $data['tab_general']  = $this->language->get('tab_general');
        $data['tab_products'] = $this->language->get('tab_products');
        $data['tab_categories'] = $this->language->get('tab_categories');
        $data['tab_manufacturers'] = $this->language->get('tab_manufacturers');
        $data['tab_information_pages'] = $this->language->get('tab_information_pages');

        $data['tab_general_help']  = $this->language->get('tab_general_help');
        $data['tab_products_help'] = $this->language->get('tab_products_help');
        $data['tab_categories_help'] = $this->language->get('tab_categories_help');
        $data['tab_manufacturers_help'] = $this->language->get('tab_manufacturers_help');
        $data['tab_information_pages_help'] = $this->language->get('tab_information_pages_help');

       
        $this->languages = $this->model_catalog_seo->getLanguages();

        foreach($this->languages as $language){
            $data['currency'] = $language['language_id'];
            break;
        }

        if (isset($this->error['title'])) {
            foreach($this->error['title'] as $key => $value){
                $data['error_'.$key] = $this->error['title'][$key];
            }
        }

        if(isset($this->error['already_exists'])){
            $data['error_already_exists'] = $this->error['already_exists'];
        }else{
            $data['error_already_exists'] = '';
        }

        $data['languages'] = $this->languages;

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }       

        $data['autofill'] = $this->url->link("catalog/seo/loadgeneralauto","token=" . $this->session->data['token'],"SSL");
        $data['action'] = $this->url->link("catalog/seo/customizeinformation","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("catalog/seo/customizeinformation","token=" . $this->session->data['token'],"SSL");
        $data['filter'] =  $this->url->link("catalog/seo/customizeinformation","token=" . $this->session->data['token'],"SSL");
        
        $data['token'] = $this->session->data['token'];
        $this->load->model('tool/image');

        $this->config_limit_admin = $this->config->get('config_limit_admin');

        $data['informations'] = $this->loadInformationPages();
       
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('catalog/seocustomize_information.tpl', $data));
    }

    public function customizemanufacturer() {

        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['version'] = str_replace(".","",VERSION);
        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        //$this->load->helper('seo_validator');

        $helper = 'seo_validator';

        $file = DIR_SYSTEM . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load helper ' . $helper . '!');
            exit();
        }

        $this->validate = new SeoValidator($this->registry);

        $this->language->load('catalog/seo');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('view/javascript/jquery/jquery.tipTip.minified.js');
        $this->document->addLink("view/stylesheet/allseo.css","stylesheet");
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate($this->request->post))) {
            
            $post_data = $this->request->post;

            foreach($post_data['manufacturer']['keyword'] as $manufacturer_id => $keyword) {

                $object = new SeoManufacturer($this->registry);
                $object->setSeoKeyword($keyword);
                $object->setQuery('manufacturer_id='.$manufacturer_id);

                $title = $meta_description = $meta_keywords = array();

                foreach($post_data['manufacturer']['manufacturer_description'][$manufacturer_id] as $language_id => $r) {
                    $title[$language_id] = $r['title'];
                    $meta_keywords[$language_id] = $r['meta_keywords'];
                    $meta_description[$language_id] = $r['meta_description'];
                }

                $object->setTitle($title);
                $object->setId($manufacturer_id);
                $object->setMetaKeywords($meta_keywords);
                $object->setMetaDescription($meta_description);
                $object->save();
            }

            $this->session->data['success'] = $this->language->get('text_success_tab_manufacturers');
 
            $this->response->redirect($this->url->link("catalog/seo/customizemanufacturer","token=" . $this->session->data['token'],"SSL"));
        }

        $data['success'] = '';
        if(isset($this->session->data['success'])){
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        }    

        $data['heading_title'] = $this->language->get('heading_title');
        $data['description_st'] = $this->language->get('description');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_keyword'] = $this->language->get('entry_keyword');

        $data['column_url'] = $this->language->get('column_url');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_image'] = $this->language->get('column_image');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_title'] = $this->language->get('column_title');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_meta_keyword'] = $this->language->get('column_meta_keyword');
        $data['column_meta_description'] = $this->language->get('column_meta_description');
        $data['column_tags'] = $this->language->get('column_tags');
        $data['custom_url_help'] = $this->language->get('custom_url_help');


        $data['domain'] = $this->config->get('config_url');

        $data['button_autofill'] = $this->language->get('button_autofill');
        $data['button_save'] = $this->language->get('button_save');
        $data['helpedit'] = $this->language->get('helpedit');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_add_custom_url_store'] = $this->language->get('button_add_custom_url_store');
        $data['button_save_general'] = $this->language->get('button_save_general');
        $data['button_save_categorys'] = $this->language->get('button_save_categorys');
        $data['button_save_categories'] = $this->language->get('button_save_categories');
        $data['button_save_manufacturers'] = $this->language->get('button_save_manufacturers');
        $data['button_save_information_pages'] = $this->language->get('button_save_information_pages');

        $data['title_help'] = $this->language->get('title_help');
        $data['keywords_help'] = $this->language->get('keywords_help');
        $data['description_help'] = $this->language->get('description_help');
        $data['tags_help'] = $this->language->get('tags_help');

        $data['tab_general']  = $this->language->get('tab_general');
        $data['tab_products'] = $this->language->get('tab_products');
        $data['tab_categories'] = $this->language->get('tab_categories');
        $data['tab_manufacturers'] = $this->language->get('tab_manufacturers');
        $data['tab_information_pages'] = $this->language->get('tab_information_pages');

        $data['tab_general_help']  = $this->language->get('tab_general_help');
        $data['tab_products_help'] = $this->language->get('tab_products_help');
        $data['tab_categories_help'] = $this->language->get('tab_categories_help');
        $data['tab_manufacturers_help'] = $this->language->get('tab_manufacturers_help');
        $data['tab_information_pages_help'] = $this->language->get('tab_information_pages_help');

       
        $this->languages = $this->model_catalog_seo->getLanguages();

        foreach($this->languages as $language){
            $data['currency'] = $language['language_id'];
            break;
        }

        if (isset($this->error['title'])) {
            foreach($this->error['title'] as $key => $value){
                $data['error_'.$key] = $this->error['title'][$key];
            }
        }

        if(isset($this->error['already_exists'])){
            $data['error_already_exists'] = $this->error['already_exists'];
        }else{
            $data['error_already_exists'] = '';
        }

        $data['languages'] = $this->languages;

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }       

        $data['autofill'] = $this->url->link("catalog/seo/loadgeneralauto","token=" . $this->session->data['token'],"SSL");
        $data['action'] = $this->url->link("catalog/seo/customizemanufacturer","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("catalog/seo/customizemanufacturer","token=" . $this->session->data['token'],"SSL");
        $data['filter'] =  $this->url->link("catalog/seo/customizemanufacturer","token=" . $this->session->data['token'],"SSL");
        
        $data['token'] = $this->session->data['token'];
        $this->load->model('tool/image');

        $this->config_limit_admin = $this->config->get('config_limit_admin');

        $data['manufacturers'] = $this->loadManufactures();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('catalog/seocustomize_manufacturer.tpl', $data));
    }

    public function customizegeneral() {

        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['version'] = str_replace(".","",VERSION);
        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        //$this->load->helper('seo_validator');

        $helper = 'seo_validator';

        $file = DIR_SYSTEM . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            trigger_error('Error: Could not load helper ' . $helper . '!');
            exit();
        }

        $this->validate = new SeoValidator($this->registry);

        $this->language->load('catalog/seo');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('view/javascript/jquery/jquery.tipTip.minified.js');
        $this->document->addLink("view/stylesheet/allseo.css","stylesheet");
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate($this->request->post))) {
            
            $post_data = $this->request->post;

            $this->model_catalog_seo->clearGeneral();

            if(isset($post_data['custom_url_store'])) {
                foreach($post_data['custom_url_store'] as $row) {

                    $object = new SeoGeneral($this->registry);
                    $object->setSeoKeyword($row['keyword']);
                    $object->setQuery('route='.$row['query']);

                    $title = $meta_description = $meta_keywords = array();

                    foreach($row['custom_url_store_description'] as $language_id => $r) {
                        $title[$language_id] = $r['name'];
                        $meta_keywords[$language_id] = $r['meta_keywords'];
                        $meta_description[$language_id] = $r['meta_description'];
                    }

                    $object->setTitle($title);
                    $object->setId($row['query']);
                    $object->setMetaKeywords($meta_keywords);
                    $object->setMetaDescription($meta_description);
                    $object->save();
                }
            }

            $this->session->data['success'] = $this->language->get('text_success_tab_general');
 
            $this->response->redirect($this->url->link("catalog/seo/customizegeneral","token=" . $this->session->data['token'],"SSL"));
        }

        $data['success'] = '';

        if(isset($this->session->data['success'])){
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        }    

        $data['heading_title'] = $this->language->get('heading_title');
        $data['description_st'] = $this->language->get('description');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['tab_general']  = $this->language->get('tab_general');
        $data['tab_products'] = $this->language->get('tab_products');
        $data['tab_categories'] = $this->language->get('tab_categories');
        $data['tab_manufacturers'] = $this->language->get('tab_manufacturers');
        $data['tab_information_pages'] = $this->language->get('tab_information_pages');

        $data['tab_general_help']  = $this->language->get('tab_general_help');
        $data['tab_products_help'] = $this->language->get('tab_products_help');
        $data['tab_categories_help'] = $this->language->get('tab_categories_help');
        $data['tab_manufacturers_help'] = $this->language->get('tab_manufacturers_help');
        $data['tab_information_pages_help'] = $this->language->get('tab_information_pages_help');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_keyword'] = $this->language->get('entry_keyword');

        $data['column_url'] = $this->language->get('column_url');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_image'] = $this->language->get('column_image');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_title'] = $this->language->get('column_title');
        $data['column_keyword'] = $this->language->get('column_keyword');
        $data['column_meta_keyword'] = $this->language->get('column_meta_keyword');
        $data['column_meta_description'] = $this->language->get('column_meta_description');
        $data['column_tags'] = $this->language->get('column_tags');
        $data['custom_url_help'] = $this->language->get('custom_url_help');


        $data['domain'] = $this->config->get('config_url');

        $data['button_autofill'] = $this->language->get('button_autofill');
        $data['button_save'] = $this->language->get('button_save');
        $data['helpedit'] = $this->language->get('helpedit');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_reset'] = $this->language->get('button_reset');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_add_custom_url_store'] = $this->language->get('button_add_custom_url_store');
        $data['button_save_general'] = $this->language->get('button_save_general');
        $data['button_save_categorys'] = $this->language->get('button_save_categorys');
        $data['button_save_categories'] = $this->language->get('button_save_categories');
        $data['button_save_manufacturers'] = $this->language->get('button_save_manufacturers');
        $data['button_save_information_pages'] = $this->language->get('button_save_information_pages');

        $data['title_help'] = $this->language->get('title_help');
        $data['keywords_help'] = $this->language->get('keywords_help');
        $data['description_help'] = $this->language->get('description_help');
        $data['tags_help'] = $this->language->get('tags_help');

       
        $this->languages = $this->model_catalog_seo->getLanguages();

        foreach($this->languages as $language){
            $data['currency'] = $language['language_id'];
            break;
        }

        if (isset($this->error['title'])) {
            foreach($this->error['title'] as $key => $value){
                $data['error_'.$key] = $this->error['title'][$key];
            }
        }

        if(isset($this->error['already_exists'])){
            $data['error_already_exists'] = $this->error['already_exists'];
        }else{
            $data['error_already_exists'] = '';
        }

        $data['languages'] = $this->languages;

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }       

        $data['autofill'] = $this->url->link("catalog/seo/loadgeneralauto","token=" . $this->session->data['token'],"SSL");
        $data['action'] = $this->url->link("catalog/seo/customizegeneral","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("catalog/seo/customizegeneral","token=" . $this->session->data['token'],"SSL");
        $data['filter'] =  $this->url->link("catalog/seo/customizegeneral","token=" . $this->session->data['token'],"SSL");
        
        $data['token'] = $this->session->data['token'];
        $this->load->model('tool/image');

        $this->config_limit_admin = $this->config->get('config_limit_admin');

        $data['custom_url_store_data'] = $this->loadGeneral();
        
        if (isset($this->request->post['custom_url_store_status'])) {
            $data['custom_url_store_status'] = $this->request->post['custom_url_store_status'];
        } else {
            $data['custom_url_store_status'] = $this->config->get('custom_url_store_status');
        }
       
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('catalog/seocustomize_general.tpl', $data));
    }
    
    public function loadGeneralAuto(){
    
        $this->load->model('catalog/seo');
        
        function seo_map($file){
                               
                                $ignore_list = array(
                                    'common/column_left', 'common/column_right', 'common/content_bottom', 'common/content_top', 
                                    'common/footer', 'common/header', 'common/landing', 'common/maintenance', 'common/cart','common/search',
                                    'common/seo_content', 'common/seo_url','common/currency','common/language', 'checkout/confirm','checkout/voucher','checkout/guest','checkout/reward', 
                                    'checkout/guest_shipping', 'checkout/login', 'checkout/manual', 'checkout/payment_address', 
                                    'checkout/payment_method', 'checkout/register', 'checkout/shipping_address', 'checkout/shipping_method',
                                    'product/product', 'product/category','information/information','checkout/simplecheckout','checkout/simplecheckout_cart','checkout/simplecheckout_comment','checkout/simplecheckout_customer','checkout/simplecheckout_login',
                                    'checkout/simplecheckout_payment','checkout/simplecheckout_payment_address','checkout/simplecheckout_shipping','checkout/simplecheckout_shipping_address',
                                    'checkout/simplecheckout_summary','checkout/simplecheckout_text','common/column_left-magictoolbox','common/column_right-magic-toolbox','common/content_bottom-magictoolbox',
                                    'common/content_top-magictoolbox','common/header-magictoolbox','common/home-magictoolbox','common/simple_connector','common/switch_mobile',
                                    'product/category-magictoolbox','shipping/teaser',
                                );

                                if( !preg_match('/^(module|feed|payment)\/.+$/', $file) && !in_array($file, $ignore_list) ) {
                                    return $file;
                                } else {
                                    return '';
                                }
                        }
                        
          function file_map($file){
                        $ignore_list = array("api","amazonus","amazon","event","ebay","openbay","tool","journal","journal2","kuler","quickcheckout","startup","d_quickcheckout","total");
                            if (!in_array(basename(dirname($file)), $ignore_list)) {
                               return basename(dirname($file)). '/' . basename($file, '.php');
                            }        
                        }
                        
        $languages = $this->model_catalog_seo->getLanguages();
        $general_urls = array_filter(array_map('file_map', glob(DIR_CATALOG . 'controller/*/*.php')), 'seo_map');
        $SeoKeyword = array();
        $this->model_catalog_seo->clearGeneral();
        foreach($general_urls as $general_url){
            $object = new SeoGeneral($this->registry);
            $object->setQuery('route='.$general_url);
            $title = $meta_description = $meta_keywords = array();
            
            foreach($languages as $language) {
                if($language['status']){
                    $lcode = "";
                    if ($this->config->get('config_language') != $language['code']) {
                        $lcode = "-".$language['code'];
                    }    
                    if(dirname($general_url)== "affiliate"){
                        $SeoKeyword[$language['language_id']] = "affliate-".basename($general_url).$lcode;
                    } elseif ($general_url=="checkout/success") {
                        $SeoKeyword[$language['language_id']] = "checkout-".basename($general_url).$lcode;
                    } elseif (dirname($general_url)== "amazon") {
                        $SeoKeyword[$language['language_id']] = "amazon-".basename($general_url).$lcode;
                    } elseif (dirname($general_url)== "amazonus") {
                        $SeoKeyword[$language['language_id']] = "amazonus-".basename($general_url).$lcode;
                    }  elseif (dirname($general_url)== "play") {
                        $SeoKeyword[$language['language_id']] = "play-".basename($general_url).$lcode;
                    } else {
                        $SeoKeyword[$language['language_id']] = basename($general_url).$lcode;
                    }
            
                    $heading_title = '';
                    $language_file_path = DIR_CATALOG.'language/'.$language['directory'].'/'.$general_url.'.php';
                    $this->log->write($language_file_path);
                    if(file_exists($language_file_path)){
                        $_ = array();
                        $language_data = require_once($language_file_path);
                        $heading_title = isset($_['heading_title'])?$_['heading_title']:'';
                        $this->log->write($heading_title);
                    }
                    $title[$language['language_id']]            = $heading_title;
                    $meta_keywords[$language['language_id']]    = $heading_title;
                    $meta_description[$language['language_id']] = $heading_title;
                }
            }
            $object->setSeoKeyword($SeoKeyword);
            $object->setTitle($title);
            
            $object->setId($general_url);
            $object->setMetaKeywords($meta_keywords);
            $object->setMetaDescription($meta_description);
            $object->save();
        }
    }

    public function loadGeneral() {
    
        $data['custom_url_store_data'] = array();
        
        $custom_url_data = Seo::findGeneral($this->registry);
        $custom_url_total = Seo::findGeneralTotal($this->registry);
       
        foreach($custom_url_data as $object) {

            $custom_url_store_description = array();

            $titles = $object->getTitle();
            $meta_keywords = $object->getMetaKeywords();
            $meta_description = $object->getMetaDescription();

            //if(isset($this->request->post['manufacturer']['manufacturer_id']) && $current_tab){
              //  $keyword = $this->request->post['manufacturer']['manufacturer_id'][$manufacturer->getId()];
            //}else{
            $keyword = $object->getSeoKeyword();
            //}

            foreach($this->languages as $language) {
                $custom_url_store_description[$language['language_id']] = array(
                    'name' => array_key_exists($language['language_id'], $titles) ? $titles[$language['language_id']]:'',
                    'meta_keywords' => array_key_exists($language['language_id'], $meta_keywords) ? $meta_keywords[$language['language_id']]:'',
                    'meta_description' => array_key_exists($language['language_id'], $meta_description) ? $meta_description[$language['language_id']]:''
                );
            }

             $data['custom_url_store_data'][] = array(
                'id' => $object->getId(),
                'keyword'    => $keyword,
                'custom_url_store_description'   => $custom_url_store_description
            );
        }

        return $data['custom_url_store_data'];
        
    }


    public function loadProducts($keyword = '') {

        $this->load->model('catalog/product');

        $this->page_product = 1;

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->page_product = $page;

        $data = array(
            'start'           => ($this->page_product - 1) * $this->config_limit_admin,
            'limit'           => $this->config_limit_admin,
            'filter_keyword'  => $keyword
        );
       
        $products = Seo::findProducts($this->registry, $data);
        $this->product_total = Seo::findProductsTotal($this->registry, $data);
       
        foreach ($products as $product) {

            $product_image = $product->getImage();

            if ($product_image && file_exists(DIR_IMAGE . $product_image)) {
                $image = $this->model_tool_image->resize($product_image, 40, 40);
            } else {
                $image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
            }

            $current_tab = (isset($this->request->post['tab']) && $this->request->post['tab']=='tab_products') ? 1 : 0;

            if(isset($this->request->post['product']['product_description']) && $current_tab){
                $product_description = $this->request->post['product']['product_description'][$product->getId()];
            }else{
                $titles = $product->getTitle();
                $meta_keywords = $product->getMetaKeywords();
                $meta_description = $product->getMetaDescription();
                $tags = $product->getTags();

                $product_description = array();

                foreach($this->languages as $language) {
                    if(array_key_exists($language['language_id'], $titles)) {
                        $product_description[$language['language_id']] = array(
                            'title' => $titles[$language['language_id']],
                            'meta_keywords' => $meta_keywords[$language['language_id']],
                            'meta_description' => $meta_description[$language['language_id']],
                            'tags' => $tags[$language['language_id']]
                        );
                    } else {
                        $product_description[$language['language_id']] = array(
                            'title' => '',
                            'meta_keywords' => '',
                            'meta_description' => '',
                            'tags' => ''
                        );
                    }
                }
            }
            
            if(isset($this->request->post['product']['keyword']) && $current_tab){
                 $keyword = array();
                $keyword['language_id'] = $this->request->post['product']['keyword'][$product->getId()];
            }else{
                $keyword = $product->getSeoKeyword();
            }
           
            $data['products'][] = array(
                'product_id' => $product->getId(),
                'name'       => $product->getName(),
                'model'      => $product->getModel(),
                'keyword'    => $keyword,
                'product_description'   => $product_description,
                'image'      => $image
            );
        }
       return $data['products'];
    }


    public function loadCategories($category = "") {

        $this->load->model('catalog/category');

        $this->page_category = 1;

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->page_category = $page;

        $data = array(
            'start'           => ($this->page_category - 1) * $this->config_limit_admin,
            'limit'           => $this->config_limit_admin,
            'filter_keyword'  => $category
        );

        $categories = Seo::findCategories($this->registry, $data);
        $this->category_total = Seo::findCategoriesTotal($this->registry, $data);
        $data['categories'] = array();
        foreach ($categories as $category) {

            $current_tab = (isset($this->request->post['tab']) && $this->request->post['tab']=='tab_categories') ? 1 : 0;

            if(isset($this->request->post['category']['category_description']) && $current_tab){
                $category_description = $this->request->post['category']['category_description'][$category->getId()];
            } else {

                $titles = $category->getTitle();
                $meta_keywords = $category->getMetaKeywords();
                $meta_description = $category->getMetaDescription();

                $category_description = array();

                foreach($this->languages as $language) {
                    if(array_key_exists($language['language_id'], $titles)) {
                        $category_description[$language['language_id']] = array(
                            'title' => $titles[$language['language_id']],
                            'meta_keywords' => $meta_keywords[$language['language_id']],
                            'meta_description' => $meta_description[$language['language_id']]
                        );
                    } else {
                        $category_description[$language['language_id']] = array(
                            'title' => '',
                            'meta_keywords' => '',
                            'meta_description' => ''
                        );
                    }
                }
            }

            if(isset($this->request->post['category']['keyword']) && $current_tab){
                 $keyword = array();
                $keyword['language_id'] = $this->request->post['category']['keyword'][$category->getId()];
            }else{
                $keyword = $category->getSeoKeyword();
            }

            $data['categories'][] = array(
                'category_id' => $category->getId(),
                'name'       => $category->getName(),
                'keyword'    => $keyword,
                'category_description'  => $category_description
            );
        }
        return $data['categories'];
    }


    public function loadManufactures() {

        $this->load->model('catalog/manufacturer');

        $manufacturers = Seo::findManufacturers($this->registry);
        $manufacturer_total = Seo::findManufacturersTotal($this->registry);

        foreach($manufacturers as $manufacturer){

            $current_tab = (isset($this->request->post['tab']) && $this->request->post['tab']=='tab_manufacturers') ? 1 : 0;

            if(isset($this->request->post['manufacturer']['manufacturer_description']) && $current_tab){
                $manufacturer_description = $this->request->post['manufacturer']['manufacturer_description'][$manufacturer->getId()];
            }else{

                $titles = $manufacturer->getTitle();
                $meta_keywords = $manufacturer->getMetaKeywords();
                $meta_description = $manufacturer->getMetaDescription();

                $manufacturer_description = array();

                foreach($this->languages as $language) {
                    $manufacturer_description[$language['language_id']] = array(
                        'title' => array_key_exists($language['language_id'], $titles) ? ($titles[$language['language_id']]):'',
                        'meta_keywords' => array_key_exists($language['language_id'], $meta_keywords) ? $meta_keywords[$language['language_id']] : '' ,
                        'meta_description' => array_key_exists($language['language_id'], $meta_description) ? $meta_description[$language['language_id']] : ''
                    );
                }

            }

            if(isset($this->request->post['manufacturer']['manufacturer_id']) && $current_tab){
                $keyword = array();
                $keyword['language_id'] = $this->request->post['manufacturer']['manufacturer_id'][$manufacturer->getId()];
            }else{
                $keyword = $manufacturer->getSeoKeyword();
            }

            $data['manufacturers'][] = array(
                'manufacturer_id' => $manufacturer->getId(),
                'name'       => $manufacturer->getName(),
                'keyword'    => $keyword,
                'manufacturer_description'  => $manufacturer_description
            );
        }
        return $data['manufacturers'];
    }


    public function loadInformationPages() {

        $this->load->model('catalog/information');

        $data = array();

        $informations = Seo::findInformations($this->registry);
        $information_total = Seo::findInformationsTotal($this->registry);

        foreach($informations as $information){

            $current_tab = (isset($this->request->post['tab']) && $this->request->post['tab']=='tab_information_pages') ? 1 : 0;

            if(isset($this->request->post['information']['information_description']) && $current_tab){
                $information_description = $this->request->post['information']['information_description'][$information->getId()];
            }else{
                $titles = $information->getTitle();
                $meta_keywords = $information->getMetaKeywords();
                $meta_description = $information->getMetaDescription();

                $information_description = array();

                foreach($this->languages as $language) {
                    if(array_key_exists($language['language_id'], $titles)) {
                        $information_description[$language['language_id']] = array(
                            'title' => $titles[$language['language_id']],
                            'meta_keywords' => $meta_keywords[$language['language_id']],
                            'meta_description' => $meta_description[$language['language_id']]
                        );
                    } else {
                        $information_description[$language['language_id']] = array(
                            'title' => '',
                            'meta_keywords' => '',
                            'meta_description' => ''
                        );
                    }
                }
            }

            if(isset($this->request->post['information']['keyword']) && $current_tab){
                 $keyword = array();
                $keyword['language_id'] = $this->request->post['information']['keyword'][$information->getId()];
            }else{
                $keyword = $information->getSeoKeyword();
            }

            $data['informations'][] = array(
                'name'  =>  $information->getName(),
                'information_id' => $information->getId(),
                'keyword'    => $keyword,
                'information_description'   => $information_description
            );
        }
        return $data['informations'];
    }

    public function autogenerate_product() {
        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        $this->language->load('catalog/seo_autogenerate');
        $data['version'] = str_replace(".","",VERSION);
        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        //$this->document->addLink("view/javascript/aios/css/style-responsive.css","stylesheet");

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateAutogenerate())) {
            // Remember that KEY of $pattern array has to be the actual column name of xstore_seo_pattern table

            $dynamic_success = '';
            $success = $this->language->get('text_success');
            /*  PRODUCTS  */
            if (isset($this->request->post['products_url'])) {
                $pattern = array(
                    'product_url_keyword'       =>  $this->request->post['products_url_template']
                );
                $this->model_catalog_seo->generateProductUrlKeyword($this->request->post['products_url_template'], $pattern);
                $dynamic_success = $this->language->get('product_url_keyword');
            }
            if(isset($this->request->post['products_title'])){
                $pattern = array(
                    'product_title'       =>  $this->request->post['products_title_template']
                );
                $this->model_catalog_seo->generateProductTitle($this->request->post['products_title_template'], $pattern);
                $dynamic_success = $this->language->get('product_title');
            }
            if (isset($this->request->post['product_keywords'])) {
                $pattern = array(
                    'product_meta_keywords' =>  $this->request->post['product_keywords_template']
                );
                $this->model_catalog_seo->generateProductMetaKeywords($this->request->post['product_keywords_template'], null, $pattern);
                
                $dynamic_success = $this->language->get('product_meta_keywords');
            }
            if (isset($this->request->post['product_description'])) {
                $pattern = array(
                    'product_meta_description'  =>  $this->request->post['product_description_template']
                );
                $this->model_catalog_seo->generateProductMetaDescription($this->request->post['product_description_template'], $pattern);
                $dynamic_success = $this->language->get('product_meta_description');
            }
            if (isset($this->request->post['product_tags'])) {
                $pattern = array(
                    'product_tags'  =>  $this->request->post['product_tags_template']
                );
                $this->model_catalog_seo->generateProductTags($this->request->post['product_tags_template'], $pattern);
                $dynamic_success = $this->language->get('product_tags');
            }
            if (isset($this->request->post['product_image'])) {
                $pattern = array(
                    'product_image_name'    =>  $this->request->post['product_image_template']
                );
                $this->model_catalog_seo->generateProductImage($this->request->post['product_image_template'], $pattern);
                $dynamic_success = $this->language->get('product_image_name');
            }
            
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
              $data['success'] = $dynamic_success . ' ' . $success;
               $dynamic_success = '';
            }

        }
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        $data['warning_clear'] = $this->language->get('warning_clear');
        $data['warning_clear_tags'] = $this->language->get('warning_clear_tags');

        $data['tags'] = $this->language->get('tags');
        $data['generate'] = $this->language->get('generate');

        $data['available_category_tags'] = $this->language->get('available_category_tags');
        $data['available_information_pages_tags'] = $this->language->get('available_information_pages_tags');
        $data['autogenerate_help'] = $this->language->get('autogenerate_help');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_pattern'] = $this->language->get('text_pattern');
        $data['text_action'] = $this->language->get('text_action');

        $data['text_products'] = $this->language->get('text_products');
        $data['clear_seo'] = $this->language->get('clear_seo');
        $data['clear_seo_info'] = $this->language->get('clear_seo_info');
        $data['clear_seo_header'] = $this->language->get('clear_seo_header');            
        $data['helpauto'] = $this->language->get('helpauto');
        $data['text_url_keyword'] = $this->language->get('text_url_keyword');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['help_product_generate_howtouse'] = $this->language->get('help_product_generate_howtouse');
        $data['howtouse'] = $this->language->get('howtouse');

        $data['text_general_data'] = $this->language->get('text_general_data');
        $data['help_general1_data'] = $this->language->get('help_general1_data');
        $data['help_general_data'] = $this->language->get('help_general_data');

        $data['token'] = $this->session->data['token'];
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        if($this->request->server['REQUEST_METHOD'] != 'POST'){
            $this->load->model('catalog/seo');
            $pattern = $this->model_catalog_seo->getSeoPattern();
        }

        $user_defined_text = $this->language->get('user_defined_text');
        $user_defined_text_meta = $this->language->get('user_defined_text_meta');

        // Products

        if (isset($this->request->post['products_url_template'])) {
            $data['products_url_template'] = $this->request->post['products_url_template'];
        } elseif(isset($pattern['product_url_keyword']) && $pattern['product_url_keyword']) {
            $data['products_url_template'] = $pattern['product_url_keyword'];
        } else{
            $data['products_url_template'] = '[product_name], [model_name], [manufacturer_name], [meta_title]';
        }
        $pattern_available = '[product_name], [model_name], [manufacturer_name], [product_price], [meta_title]';
        $data['help_product_seo_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available);
        $data['text_product_url_keyword'] = sprintf($this->language->get('dynamic_main_description'), 'Product', $data['text_url_keyword'],$this->language->get('text_set_pattern'));

        if (isset($this->request->post['products_title_template'])) {
            $data['products_title_template'] = $this->request->post['products_title_template'];
        } elseif(isset($pattern['product_title']) && $pattern['product_title']) {
            $data['products_title_template'] = $pattern['product_title'];
        } else{
            $data['products_title_template'] = '[product_name], [product_description]';
        }
        $pattern_available = '[product_name], [product_description], [product_price], [model_name], [manufacturer_name]';
        $data['help_product_title'] = sprintf($this->language->get('dymanic_text'), $pattern_available);
        $data['text_product_title'] = sprintf($this->language->get('dynamic_main_description'), 'Product', $this->language->get('text_title'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['product_keywords_template'])) {
            $data['product_keywords_template'] = $this->request->post['product_keywords_template'];
        } elseif(isset($pattern['product_meta_keywords']) && $pattern['product_meta_keywords']) {
            $data['product_keywords_template'] = $pattern['product_meta_keywords'];
        } else{
            $data['product_keywords_template'] = '[product_name], [model_name], [manufacturer_name], [categories_names]';
        }
        $pattern_available = '[product_name], [model_name], [manufacturer_name], [categories_names], [product_price]';
        $data['help_meta_keywords'] = sprintf($this->language->get('dymanic_text'), $pattern_available);
        $data['text_product_meta_keywords'] = sprintf($this->language->get('dynamic_main_description'), 'Product', $this->language->get('text_meta_keywords'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['product_description_template'])) {
            $data['product_description_template'] = $this->request->post['product_description_template'];
        } elseif(isset($pattern['product_meta_description']) && $pattern['product_meta_description']) {
            $data['product_description_template'] = $pattern['product_meta_description'];
        } else{
            $data['product_description_template'] = '[product_name], [product_description]';
        }
        $pattern_available = '[product_name], [product_description], [product_price]';
        $data['help_product_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available);
        $data['text_product_meta_description'] =  sprintf($this->language->get('dynamic_main_description'), 'Product', $this->language->get('text_meta_description'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['product_tags_template'])) {
            $data['product_tags_template'] = $this->request->post['product_tags_template'];
        } elseif(isset($pattern['product_tags']) && $pattern['product_tags']) {
            $data['product_tags_template'] = $pattern['product_tags'];
        } else{
            $data['product_tags_template'] = '[product_name], [model_name], [manufacturer_name], [categories_names]';
        }
        $pattern_available = '[product_name], [model_name], [manufacturer_name], [categories_names]';
        $data['help_product_tags'] = sprintf($this->language->get('dymanic_text'), $pattern_available);
        $data['text_tags'] = sprintf($this->language->get('dynamic_main_description'), 'Product', $this->language->get('text_tags'),$this->language->get('text_set_pattern'));
        

        if (isset($this->request->post['product_image_template'])) {
            $data['product_image_template'] = $this->request->post['product_image_template'];
        } elseif(isset($pattern['product_image_name']) && $pattern['product_image_name']) {
            $data['product_image_template'] = $pattern['product_image_name'];
        } else{
            $data['product_image_template'] = '[product_name]-[model_name]-[categories_names]';
        }
        $pattern_available = '[product_name]-[model_name]-[categories_names]';
        $data['help_product_image_description'] = sprintf($this->language->get('dymanic_text_image'), $pattern_available);
        $data['text_image_name'] = sprintf($this->language->get('dynamic_main_description'), 'Product', $this->language->get('text_image_name'),$this->language->get('text_set_pattern'));

        $data['action'] = $this->url->link("catalog/seo/autogenerate_product","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("common/home","token=" . $this->session->data['token'],"SSL");
        $data['heading_title'] = $this->language->get('heading_title');
        $this->load->model('catalog/seoReport');
      
        if ($this->request->server['HTTPS']) {
            $data['catalog'] = HTTPS_CATALOG;
        } else {
            $data['catalog'] = HTTPS_CATALOG;
        }

        $data['productreport'] = $this->model_catalog_seoReport->getreport1();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('catalog/autogenerate_product.tpl', $data));
    }

    public function autogenerate_category() {

        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        $this->language->load('catalog/seo_autogenerate');
        $data['version'] = str_replace(".","",VERSION);
        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");

        //$this->document->addLink("view/javascript/aios/css/style-responsive.css","stylesheet");

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateAutogenerate())) {
            // Remember that KEY of $pattern array has to be the actual column name of xstore_seo_pattern table

            $dynamic_success = '';
            $success = $this->language->get('text_success');
            /*  CATEGORIES  */
            if (isset($this->request->post['categories_url'])) {
                $pattern = array(
                    'category_url_keyword'  =>  $this->request->post['categories_url_template']
                );
                $this->model_catalog_seo->generateCategoryUrlKeyword($this->request->post['categories_url_template'], $pattern);
                $dynamic_success = $this->language->get('category_url_keyword');
            }

            if (isset($this->request->post['categories_title'])) {
                $pattern = array(
                    'category_title' =>  $this->request->post['categories_title_template']
                );
                $this->model_catalog_seo->generateCategoryTitle($this->request->post['categories_title_template'], $pattern);
                $dynamic_success = $this->language->get('category_title');
            }

            if (isset($this->request->post['categories_keyword'])) {
                $pattern = array(
                    'category_keyword' =>  $this->request->post['categories_keyword_template']
                );
                $this->model_catalog_seo->generateCategoryMetaKeywords($this->request->post['categories_keyword_template'], $pattern);
                $dynamic_success = $this->language->get('category_meta_keywords');
            }

            if (isset($this->request->post['category_description'])) {
                $pattern = array(
                    'category_meta_description' =>  $this->request->post['category_description_template']
                );
                $this->model_catalog_seo->generateCategoryMetaDescription($this->request->post['category_description_template'], $pattern);
                $dynamic_success = $this->language->get('category_meta_description');
            }
            
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
              $data['success'] = $dynamic_success . ' ' . $success;
               $dynamic_success = '';
            }

        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        $data['warning_clear'] = $this->language->get('warning_clear');
        $data['warning_clear_tags'] = $this->language->get('warning_clear_tags');

        $data['tags'] = $this->language->get('tags');
        $data['generate'] = $this->language->get('generate');

        $data['available_category_tags'] = $this->language->get('available_category_tags');
        $data['available_information_pages_tags'] = $this->language->get('available_information_pages_tags');
        $data['autogenerate_help'] = $this->language->get('autogenerate_help');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_pattern'] = $this->language->get('text_pattern');
        $data['text_action'] = $this->language->get('text_action');

        $data['text_products'] = $this->language->get('text_products');
        $data['clear_seo'] = $this->language->get('clear_seo');
        $data['clear_seo_info'] = $this->language->get('clear_seo_info');
        $data['clear_seo_header'] = $this->language->get('clear_seo_header');            
        $data['helpauto'] = $this->language->get('helpauto');
        $data['text_url_keyword'] = $this->language->get('text_url_keyword');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['help_category_generate_howtouse'] = $this->language->get('help_category_generate_howtouse');
        $data['howtouse'] = $this->language->get('howtouse');

        $data['text_general_data'] = $this->language->get('text_general_data');
        $data['help_general1_data'] = $this->language->get('help_general1_data');
        $data['help_general_data'] = $this->language->get('help_general_data');

        $data['token'] = $this->session->data['token'];
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        if($this->request->server['REQUEST_METHOD'] != 'POST'){
            $this->load->model('catalog/seo');
            $pattern = $this->model_catalog_seo->getSeoPattern();
        }

        $user_defined_text = $this->language->get('user_defined_text');
        $user_defined_text_meta = $this->language->get('user_defined_text_meta');

        // Category
        if (isset($this->request->post['categories_url_template'])) {
            $data['categories_url_template'] = $this->request->post['categories_url_template'];
        } elseif(isset($pattern['category_url_keyword']) && $pattern['category_url_keyword']) {
            $data['categories_url_template'] = $pattern['category_url_keyword'];
        } else{
            $data['categories_url_template'] = '[category_name], [meta_title]';
        }
        $pattern_available = '[category_name], [meta_title]';
        $data['help_category_seo_description'] =  sprintf($this->language->get('dymanic_text_image'), $pattern_available,'[category_name], .html');
        $data['text_category_url_keyword'] = sprintf($this->language->get('dynamic_main_description'), 'Category', $data['text_url_keyword'],$this->language->get('text_set_pattern'));

        if (isset($this->request->post['categories_title_template'])) {
            $data['categories_title_template'] = $this->request->post['categories_title_template'];
        } elseif(isset($pattern['category_title']) && $pattern['category_title']) {
            $data['categories_title_template'] = $pattern['category_title'];
        } else{
            $data['categories_title_template'] = '[category_name], [category_description]';
        }
        $pattern_available = '[category_name], [category_description]';
        $data['help_category_title'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[category_name], Nerdherd Store');
        $data['text_category_title'] = sprintf($this->language->get('dynamic_main_description'), 'Category', $this->language->get('text_title'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['categories_keyword_template'])) {
            $data['categories_keyword_template'] = $this->request->post['categories_keyword_template'];
        } elseif(isset($pattern['category_keyword']) && $pattern['category_keyword']) {
            $data['categories_keyword_template'] = $pattern['category_keyword'];
        } else{
            $data['categories_keyword_template'] = '[category_name], [category_description]';
        }
        $pattern_available = '[category_name], [category_description]';
        $data['help_category_meta_keyword'] = sprintf($this->language->get('dymanic_text_image'), $pattern_available,'[category_name], Nerdherd Store');
        $data['text_category_meta_keywords'] = sprintf($this->language->get('dynamic_main_description'), 'Category', $this->language->get('text_meta_keywords'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['category_description_template'])) {
            $data['category_description_template'] = $this->request->post['category_description_template'];
        } elseif(isset($pattern['category_meta_description']) && $pattern['category_meta_description']) {
            $data['category_description_template'] = $pattern['category_meta_description'];
        } else{
            $data['category_description_template'] = '[category_name], [category_description]';
        }
        $pattern_available = '[category_name], [category_description]';
        $data['help_category_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[category_description]');
        $data['text_category_meta_description'] = sprintf($this->language->get('dynamic_main_description'), 'Category', $this->language->get('text_meta_description'),$this->language->get('text_set_pattern'));
            

        $data['action'] = $this->url->link("catalog/seo/autogenerate_category","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("common/home","token=" . $this->session->data['token'],"SSL");
        $data['heading_title'] = $this->language->get('heading_title');
        $this->load->model('catalog/seoReport');
      
        if ($this->request->server['HTTPS']) {
            $data['catalog'] = HTTP_CATALOG;
        } else {
            $data['catalog'] = HTTPS_CATALOG;
        }

        $data['catreport'] = $this->model_catalog_seoReport->getreport2();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/autogenerate_category.tpl', $data));

    }

    public function autogenerate_manufacturer() {

        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        $this->language->load('catalog/seo_autogenerate');
        $data['version'] = str_replace(".","",VERSION);
        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");

        //$this->document->addLink("view/javascript/aios/css/style-responsive.css","stylesheet");

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateAutogenerate())) {
            // Remember that KEY of $pattern array has to be the actual column name of xstore_seo_pattern table

            $dynamic_success = '';
            $success = $this->language->get('text_success');
            /*  MANUFACTURERS  */
            if (isset($this->request->post['manufacturers_url'])) {
                $pattern = array(
                    'manufacturer_url_keyword'  =>  $this->request->post['manufacturer_url_template']
                );
                $this->model_catalog_seo->generateManufacturerUrlKeyword($this->request->post['manufacturer_url_template'], $pattern);
                $dynamic_success = $this->language->get('manufacturer_url_keyword');
            }

            if (isset($this->request->post['manufacturer_title'])) {
                $pattern = array(
                  'manufacturer_title' =>  $this->request->post['manufacturer_title_template']
                );
                $this->model_catalog_seo->generateManufacturerPageTitle($this->request->post['manufacturer_title_template'], $pattern);
                $dynamic_success = $this->language->get('manufacturer_title');
            }

            if (isset($this->request->post['manufacturer_keyword'])) {
                $pattern = array(
                    'manufacturer_keyword' =>  $this->request->post['manufacturer_keyword_template']
                );
                $this->model_catalog_seo->generateManufacturerMetaKeywords($this->request->post['manufacturer_keyword_template'], $pattern);
                $dynamic_success = $this->language->get('manufacturer_meta_keywords');
            }

            if (isset($this->request->post['manufacturer_description'])) {
                $pattern = array(
                    'manufacturer_meta_description' =>  $this->request->post['manufacturer_description_template']
                );
                $this->model_catalog_seo->generateManufacturerMetaDescription($this->request->post['manufacturer_description_template'], $pattern);
                $dynamic_success = $this->language->get('manufacturer_meta_description');
            }
            
            
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
              $data['success'] = $dynamic_success . ' ' . $success;
               $dynamic_success = '';
            }

        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        $data['warning_clear'] = $this->language->get('warning_clear');
        $data['warning_clear_tags'] = $this->language->get('warning_clear_tags');

        $data['tags'] = $this->language->get('tags');
        $data['generate'] = $this->language->get('generate');

        $data['available_category_tags'] = $this->language->get('available_category_tags');
        $data['available_information_pages_tags'] = $this->language->get('available_information_pages_tags');
        $data['autogenerate_help'] = $this->language->get('autogenerate_help');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_pattern'] = $this->language->get('text_pattern');
        $data['text_action'] = $this->language->get('text_action');

        $data['text_products'] = $this->language->get('text_products');
        $data['clear_seo'] = $this->language->get('clear_seo');
        $data['clear_seo_info'] = $this->language->get('clear_seo_info');
        $data['clear_seo_header'] = $this->language->get('clear_seo_header');            
        $data['helpauto'] = $this->language->get('helpauto');
        $data['text_url_keyword'] = $this->language->get('text_url_keyword');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['help_manufacturer_generate_howtouse'] = $this->language->get('help_manufacturer_generate_howtouse');
        $data['howtouse'] = $this->language->get('howtouse');

        $data['text_general_data'] = $this->language->get('text_general_data');
        $data['help_general1_data'] = $this->language->get('help_general1_data');
        $data['help_general_data'] = $this->language->get('help_general_data');

        $data['token'] = $this->session->data['token'];
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        if($this->request->server['REQUEST_METHOD'] != 'POST'){
            $this->load->model('catalog/seo');
            $pattern = $this->model_catalog_seo->getSeoPattern();
        }

        $user_defined_text = $this->language->get('user_defined_text');
        $user_defined_text_meta = $this->language->get('user_defined_text_meta');

        //Manufacturers
        if (isset($this->request->post['manufacturer_url_template'])) {
            $data['manufacturer_url_template'] = $this->request->post['manufacturer_url_template'];
        } elseif(isset($pattern['manufacturer_url_keyword']) && $pattern['manufacturer_url_keyword']) {
            $data['manufacturer_url_template'] = $pattern['manufacturer_url_keyword'];
        } else{
            $data['manufacturer_url_template'] = '[manufacturer_name]';
        }
        $pattern_available = '[manufacturer_name]';
        $data['help_manufacturer_seo_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[manufacturer_name], .html');
        $data['text_manufacturer_url_keyword'] = sprintf($this->language->get('dynamic_main_description'), 'Manufacturer', $data['text_url_keyword'],$this->language->get('text_set_pattern'));
        
         if (isset($this->request->post['manufacturer_title_template'])) {
            $data['manufacturer_title_template'] = $this->request->post['manufacturer_title_template'];
        } elseif(isset($pattern['manufacturer_title']) && $pattern['manufacturer_title']) {
            $data['manufacturer_title_template'] = $pattern['manufacturer_title'];
        } else{
            $data['manufacturer_title_template'] = '[manufacturer_name]';
        }
        $pattern_available = '[manufacturer_name]';
        $data['help_manufacturer_title'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[manufacturer_name], Best Brand');
        $data['text_manufacturer_title'] = sprintf($this->language->get('dynamic_main_description'), 'Manufacturer', $this->language->get('text_title'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['manufacturer_keyword_template'])) {
            $data['manufacturer_keyword_template'] = $this->request->post['manufacturer_keyword_template'];
        } elseif(isset($pattern['manufacturer_keyword']) && $pattern['manufacturer_keyword']) {
            $data['manufacturer_keyword_template'] = $pattern['manufacturer_keyword'];
        } else{
            $data['manufacturer_keyword_template'] = '[manufacturer_name]';
        }
        $pattern_available = '[manufacturer_name]';
        $data['help_manufacturer_meta_keyword'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[manufacturer_name]');
        $data['text_manufacturer_meta_keywords'] = sprintf($this->language->get('dynamic_main_description'), 'Manufacturer', $this->language->get('text_meta_keywords'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['manufacturer_description_template'])) {
            $data['manufacturer_description_template'] = $this->request->post['manufacturer_description_template'];
        } elseif(isset($pattern['manufacturer_meta_description']) && $pattern['manufacturer_meta_description']) {
            $data['manufacturer_description_template'] = $pattern['manufacturer_meta_description'];
        } else{
            $data['manufacturer_description_template'] = '[manufacturer_name]';
        }
        $pattern_available = '[manufacturer_name]';
        $data['help_manufacturer_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[manufacturer_name]');
        $data['text_manufacturer_meta_description'] = sprintf($this->language->get('dynamic_main_description'), 'Manufacturer', $this->language->get('text_meta_description'),$this->language->get('text_set_pattern'));

        $data['action'] = $this->url->link("catalog/seo/autogenerate_manufacturer","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("common/home","token=" . $this->session->data['token'],"SSL");
        $data['heading_title'] = $this->language->get('heading_title');
        $this->load->model('catalog/seoReport');
      
        if ($this->request->server['HTTPS']) {
            $data['catalog'] = HTTP_CATALOG;
        } else {
            $data['catalog'] = HTTPS_CATALOG;
        }

        $data['manreport'] = $this->model_catalog_seoReport->getreport4();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/autogenerate_manufacturer.tpl', $data));

    }

    public function autogenerate_information() {

        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        $this->language->load('catalog/seo_autogenerate');
        $data['version'] = str_replace(".","",VERSION);
        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");

        //$this->document->addLink("view/javascript/aios/css/style-responsive.css","stylesheet");

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateAutogenerate())) {
            // Remember that KEY of $pattern array has to be the actual column name of xstore_seo_pattern table

            $dynamic_success = '';
            $success = $this->language->get('text_success');
            /*  INFORMATION PAGES  */
            if (isset($this->request->post['information_pages'])) {
                $pattern = array(
                    'information_page_url_keyword'  =>  $this->request->post['information_pages_template']
                );
                $this->model_catalog_seo->generateInformationPageUrlKeyword($this->request->post['information_pages_template'], $pattern);
                $dynamic_success = $this->language->get('information_page_url_keyword');
            }

            if (isset($this->request->post['information_pages_title'])) {
                $pattern = array(
                    'information_pages_title'  =>  $this->request->post['information_pages_title_template']
                );
                $this->model_catalog_seo->generateInformationPageTitle($this->request->post['information_pages_title_template'], $pattern);
                $dynamic_success = $this->language->get('information_page_title');
            }

            if (isset($this->request->post['information_keyword'])) {
                $pattern = array(
                    'information_keyword' =>  $this->request->post['information_keyword_template']
                );
                $this->model_catalog_seo->generateInformationMetaKeywords($this->request->post['information_keyword_template'], $pattern);
                $dynamic_success = $this->language->get('information_meta_keywords');
            }

            if (isset($this->request->post['information_description'])) {
                $pattern = array(
                    'information_meta_description' =>  $this->request->post['information_description_template']
                );
                $this->model_catalog_seo->generateInformationMetaDescription($this->request->post['information_description_template'], $pattern);
                $dynamic_success = $this->language->get('information_meta_description');
            }
            
            
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
              $data['success'] = $dynamic_success . ' ' . $success;
               $dynamic_success = '';
            }

        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        $data['warning_clear'] = $this->language->get('warning_clear');
        $data['warning_clear_tags'] = $this->language->get('warning_clear_tags');

        $data['tags'] = $this->language->get('tags');
        $data['generate'] = $this->language->get('generate');

        $data['available_category_tags'] = $this->language->get('available_category_tags');
        $data['available_information_pages_tags'] = $this->language->get('available_information_pages_tags');
        $data['autogenerate_help'] = $this->language->get('autogenerate_help');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_pattern'] = $this->language->get('text_pattern');
        $data['text_action'] = $this->language->get('text_action');

        $data['text_products'] = $this->language->get('text_products');
        $data['clear_seo'] = $this->language->get('clear_seo');
        $data['clear_seo_info'] = $this->language->get('clear_seo_info');
        $data['clear_seo_header'] = $this->language->get('clear_seo_header');            
        $data['helpauto'] = $this->language->get('helpauto');
        $data['text_url_keyword'] = $this->language->get('text_url_keyword');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['text_general_data'] = $this->language->get('text_general_data');
        $data['help_general1_data'] = $this->language->get('help_general1_data');
        $data['help_general_data'] = $this->language->get('help_general_data');

        $data['token'] = $this->session->data['token'];
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['help_information_generate_howtouse'] = $this->language->get('help_information_generate_howtouse');
        $data['howtouse'] = $this->language->get('howtouse');
        
        if($this->request->server['REQUEST_METHOD'] != 'POST'){
            $this->load->model('catalog/seo');
            $pattern = $this->model_catalog_seo->getSeoPattern();
        }

        $user_defined_text = $this->language->get('user_defined_text');
        $user_defined_text_meta = $this->language->get('user_defined_text_meta');
       
        // Information Pages

        if (isset($this->request->post['information_pages_template'])) {
            $data['information_pages_template'] = $this->request->post['information_pages_template'];
        } elseif(isset($pattern['information_page_url_keyword']) && $pattern['information_page_url_keyword']) {
            $data['information_pages_template'] = $pattern['information_page_url_keyword'];
        }  else{
            $data['information_pages_template'] = '[information_page_title]';
        }
        $pattern_available = '[information_page_title]';
        $data['help_information_seo_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[information_page_title]');
        $data['text_information_url_keyword'] = sprintf($this->language->get('dynamic_main_description'), 'Information', $data['text_url_keyword'],$this->language->get('text_set_pattern'));

        if (isset($this->request->post['information_pages_title_template'])) {
            $data['information_pages_title_template'] = $this->request->post['information_pages_title_template'];
        } elseif(isset($pattern['information_pages_title']) && $pattern['information_pages_title']) {
            $data['information_pages_title_template'] = $pattern['information_pages_title'];
        }  else{
            $data['information_pages_title_template'] = '[information_page_title], [information_page_description]';
        }
        $pattern_available = '[information_page_title], [information_page_description]';
        $data['help_information_title'] =  sprintf($this->language->get('dymanic_text'), $pattern_available,'[information_page_title], Nerdherd Store');
        $data['text_information_title'] = sprintf($this->language->get('dynamic_main_description'), 'Information', $this->language->get('text_title'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['information_keyword_template'])) {
            $data['information_keyword_template'] = $this->request->post['information_keyword_template'];
        } elseif(isset($pattern['information_keyword']) && $pattern['information_keyword']) {
            $data['information_keyword_template'] = $pattern['information_keyword'];
        } else{
            $data['information_keyword_template'] = '[information_page_title]';
        }
        $pattern_available = '[information_page_title]';
        $data['help_information_meta_keyword'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[information_page_title]');
        $data['text_information_meta_keywords'] = sprintf($this->language->get('dynamic_main_description'), 'Information', $this->language->get('text_meta_keywords'),$this->language->get('text_set_pattern'));

        if (isset($this->request->post['information_description_template'])) {
            $data['information_description_template'] = $this->request->post['information_description_template'];
        } elseif(isset($pattern['information_meta_description']) && $pattern['information_meta_description']) {
            $data['information_description_template'] = $pattern['information_meta_description'];
        } else{
            $data['information_description_template'] = '[information_page_description]';
        }
        $pattern_available = '[information_page_title], [information_page_description]';
        $data['help_information_description'] = sprintf($this->language->get('dymanic_text'), $pattern_available,'[information_page_description]');
        $data['text_information_meta_description'] = sprintf($this->language->get('dynamic_main_description'), 'Information', $this->language->get('text_meta_description'),$this->language->get('text_set_pattern'));

        $data['action'] = $this->url->link("catalog/seo/autogenerate_information","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("common/home","token=" . $this->session->data['token'],"SSL");
        $data['heading_title'] = $this->language->get('heading_title');
        $this->load->model('catalog/seoReport');
      
        if ($this->request->server['HTTPS']) {
            $data['catalog'] = HTTP_CATALOG;
        } else {
            $data['catalog'] = HTTPS_CATALOG;
        }

        $data['inforeport'] = $this->model_catalog_seoReport->getreport3();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/autogenerate_information.tpl', $data));

    }

    public function autogenerate_general() {

        require_once(DIR_SYSTEM . 'library/seo/seo.php');
        $this->load->model('catalog/seo');
        $this->model_catalog_seo->createTablesInDatabse();
        $this->language->load('catalog/seo_autogenerate');
        $data['version'] = str_replace(".","",VERSION);
        //new theme content
        $data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");
        $data['customizegeneral'] = $this->url->link("catalog/seo/customizegeneral","token=" . $this->session->data['token'],"SSL");
        
        //$this->document->addLink("view/javascript/aios/css/style-responsive.css","stylesheet");

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateAutogenerate())) {
            // Remember that KEY of $pattern array has to be the actual column name of xstore_seo_pattern table

            $dynamic_success = '';
            $success = $this->language->get('text_success');

            if (isset($this->request->post['general_pages'])) {
                $this->loadGeneralAuto();
                 $dynamic_success = $this->language->get('general_pages');
            }

            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
              $data['success'] = $dynamic_success . ' ' . $success;
               $dynamic_success = '';
            }

        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        $data['warning_clear'] = $this->language->get('warning_clear');
        $data['warning_clear_tags'] = $this->language->get('warning_clear_tags');

        $data['tags'] = $this->language->get('tags');
        $data['generate'] = $this->language->get('generate');

        $data['available_category_tags'] = $this->language->get('available_category_tags');
        $data['available_information_pages_tags'] = $this->language->get('available_information_pages_tags');
        $data['autogenerate_help'] = $this->language->get('autogenerate_help');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_pattern'] = $this->language->get('text_pattern');
        $data['text_action'] = $this->language->get('text_action');

        $data['text_products'] = $this->language->get('text_products');
        $data['clear_seo'] = $this->language->get('clear_seo');
        $data['clear_seo_info'] = $this->language->get('clear_seo_info');
        $data['clear_seo_header'] = $this->language->get('clear_seo_header');            
        $data['helpauto'] = $this->language->get('helpauto');
        $data['text_url_keyword'] = $this->language->get('text_url_keyword');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['text_general_data'] = $this->language->get('text_general_data');
        $data['help_general1_data'] = $this->language->get('help_general1_data');
        $data['help_general_data'] = $this->language->get('help_general_data');

        $data['help_general_generate_howtouse'] = $this->language->get('help_general_generate_howtouse');
        $data['howtouse'] = $this->language->get('howtouse');

        $data['token'] = $this->session->data['token'];
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        if($this->request->server['REQUEST_METHOD'] != 'POST'){
            $this->load->model('catalog/seo');
            $pattern = $this->model_catalog_seo->getSeoPattern();
        }

        $user_defined_text = $this->language->get('user_defined_text');
        $user_defined_text_meta = $this->language->get('user_defined_text_meta');
       
        $data['action'] = $this->url->link("catalog/seo/autogenerate_general","token=" . $this->session->data['token'],"SSL");
        $data['cancel'] = $this->url->link("common/home","token=" . $this->session->data['token'],"SSL");
        $data['heading_title'] = $this->language->get('heading_title');
        $this->load->model('catalog/seoReport');
      
        if ($this->request->server['HTTPS']) {
            $data['catalog'] = HTTP_CATALOG;
        } else {
            $data['catalog'] = HTTPS_CATALOG;
        }

        $data['genreport'] = $this->model_catalog_seoReport->getreport5();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/autogenerate_general.tpl', $data));

    }

    protected function multiPagination($pagination, $config_limit_admin, $total, $page, $url){
        $temp = $pagination;
        $pagination = $pagination;
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $config_limit_admin;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link("catalog/seo/customizeproduct","token=" . $this->session->data['token'] . $url . '&page={page}',"SSL");

        return $pagination->render();
        
    }

     protected function multiPaginationCategory($pagination, $config_limit_admin, $total, $page, $url){
        $temp = $pagination;
        $pagination = $pagination;
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $config_limit_admin;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link("catalog/seo/customizecategory","token=" . $this->session->data['token'] . $url . '&page={page}',"SSL");

        return $pagination->render();
        
    }

    protected function validate($data) {

        if (!$this->user->hasPermission('modify', 'catalog/seo')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $members = array('custom_url_store','product','category','manufacturer','information');
        $mapping_tab = array(
            'custom_url_store' => 'General',
            'product' => 'Products',
            'category' => 'Categories',
            'manufacturer' => 'Manufacturers',
            'information' => 'Information Pages');
        
        foreach($members as $member){
            if(isset($data[$member]) && $member != 'custom_url_store'){
                if(isset($data[$member][$member.'_description'])){
                    foreach($data[$member][$member.'_description'] as $id => $language){
                        foreach ($language as $language_id => $value) {
                            $name = 'name';
                            if($member=='information'){
                                $name = 'title';
                            }
                            if(isset($value[$name])){
                                if ((strlen(utf8_decode($value[$name])) < 3)) {
                                    // $this->error['title']['name_'.$member.'_'.$id.'_'.$language_id] = $this->language->get('error_name');
                                }
                            }
                        }
                    }
                }
                if(isset($data[$member]['keyword'])){
                   foreach ($data[$member]['keyword'] as $key => $value) {
                      
                       foreach ($value as $key1 => $value1) {
                            $keyword_validate = $this->validate->keyword_validate(array($key=>$value1),$member.'_id');
                            if($keyword_validate){
                                if($keyword_validate['existing_keyword']){
                                    $data['existing_keyword'] = $keyword_validate['existing_keyword'];
                                    $this->error['already_exists'] = sprintf($this->language->get($keyword_validate['error']),$data['existing_keyword'],$mapping_tab[$member]);
                                }
                                $data['tab'] = $data['tab'];
                            } 
                        }
                   }
                }
            }elseif(isset($data[$member]) && $member == 'custom_url_store'){
                $new_member_id = array();
                if($data[$member]){
                    foreach ($data[$member] as $key => $value) {
                        if($value['query']  && $value['query'] != 'common/home') {
                            if(trim($value['query']) == 'product/category'){
                                $this->error['warning'] = $this->language->get('error_restrict');
                            } elseif(is_array($value['keyword'])) {
                                foreach ($value['keyword'] as $langid => $keyword) {
                                    if(trim($keyword) == '') {
                                        $this->error['warning'] = $this->language->get('error_empty');
                                    }
                                    $new_member_id[] = array(
                                        'query' => $value['query'],
                                        'keyword' => $keyword
                                    );
                                }
                            }
                            
                        }
                    }
                    if($new_member_id) {
                        $keyword_validate = $this->validate->keyword_validate($new_member_id,$member);
                        if($keyword_validate){
                            if($keyword_validate['existing_keyword']){
                                $data['existing_keyword'] = $keyword_validate['existing_keyword'];
                                $this->error['already_exists'] = sprintf($this->language->get($keyword_validate['error']),$data['existing_keyword'],$mapping_tab[$member]);
                            }
                        }
                    }
                }
            }
        }
        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function validateAutogenerate() {
        if (!$this->user->hasPermission('modify', 'catalog/seo')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function multisetting() {
        $this->load->model('setting/setting');;
        $array = array('config_multilang_on'=>$this->request->get['config_multilang_on']);
        $this->model_setting_setting->editSetting('multilang', $array);
        $results['success'] = 'Settings Saved';
        $this->response->setOutput(json_encode($results));
    }

    public function catautocomplete() {
        $json = array();
        
        if (isset($this->request->get['filter_name'])) {
            $this->load->model('catalog/seoReport');

            $filter_data = array(
                'filter_name' => $this->request->get['filter_name'],
                'sort'        => 'name',
                'order'       => 'ASC',
                'start'       => 0,
                'limit'       => 5
            );
           
            $results = $this->model_catalog_seoReport->getCategoriesAutocomplete($filter_data);
            
            foreach ($results as $result) {
                $json[] = array(
                    'category_id' => $result['category_id'],
                    'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
?>
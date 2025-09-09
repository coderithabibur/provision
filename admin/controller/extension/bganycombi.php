<?php
class ControllerExtensionbganycombi extends Controller {
	private $error = array();  
	private $modpath = 'extension/bganycombi';
	private $modtpl_list = 'extension/bganycombi_list.tpl';
	private $modtpl_form = 'extension/bganycombi_form.tpl';	
	private $modssl = 'SSL';
	private $token_str = ''; 
	private $urlfilter = array('filter_title', 'filter_ribbontext', 'filter_disctype', 'filter_discount', 'filter_buyqty', 'filter_getqty', 'filter_startdate', 'filter_enddate', 'filter_status', 'filter_customer_group_id', 'filter_store_id', 'filter_buyproduct_name', 'filter_buyproduct_id', 'filter_buycategory_name', 'filter_buycategory_id', 'filter_buymanufacturer_name', 'filter_buymanufacturer_id', 'filter_exbuyproduct_name', 'filter_exbuyproduct_id', 'filter_exbuycategory_name', 'filter_exbuycategory_id', 'filter_exbuymanufacturer_name', 'filter_exbuymanufacturer_id', 'filter_getproduct_name', 'filter_getproduct_id', 'filter_getcategory_name', 'filter_getcategory_id', 'filter_getmanufacturer_name', 'filter_getmanufacturer_id', 'filter_exgetproduct_name', 'filter_exgetproduct_id', 'filter_exgetcategory_name', 'filter_exgetcategory_id', 'filter_exgetmanufacturer_name', 'filter_exgetmanufacturer_id');
	
	public function __construct($registry) {
		parent::__construct($registry);
 		
		if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3') { 
 			$this->modpath = 'extension/bganycombi';
 			$this->modtpl_list = 'extension/bganycombi_list';
			$this->modtpl_form = 'extension/bganycombi_form';	 
  		} else if(substr(VERSION,0,3)=='2.2') {
 			$this->modtpl_list = 'extension/bganycombi_list';
			$this->modtpl_form = 'extension/bganycombi_form';	 
		} 
		 
		if(substr(VERSION,0,3)>='3.0') { 
 			$this->token_str = 'user_token=' . $this->session->data['user_token'];
		} else {
			$this->token_str = 'token=' . $this->session->data['token'];
		}
		
		if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3' || substr(VERSION,0,3)=='2.2') { 
			$this->modssl = true;
		} 
 	} 

	public function index() {
		$data = $this->load->language($this->modpath);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model($this->modpath);
		
		$this->model_extension_bganycombi->checkdb();
 
		$this->getList();
	}

	public function add() {
		$data = $this->load->language($this->modpath);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model($this->modpath);

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_bganycombi->addbganycombi($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
 			foreach($this->urlfilter as $urlval) {
				if (isset($this->request->get[$urlval])) {
					$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
				}			
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link($this->modpath, $this->token_str . $url, $this->modssl));
		}

		$this->getForm();
	}

	public function edit() {
		$data = $this->load->language($this->modpath);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model($this->modpath);

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_bganycombi->editbganycombi($this->request->get['bganycombi_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
 			foreach($this->urlfilter as $urlval) {
				if (isset($this->request->get[$urlval])) {
					$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
				}			
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link($this->modpath, $this->token_str . $url, $this->modssl));
		}

		$this->getForm();
	}

	public function delete() {
		$data = $this->load->language($this->modpath);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model($this->modpath);

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $bganycombi_id) {
				$this->model_extension_bganycombi->deletebganycombi($bganycombi_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
 			foreach($this->urlfilter as $urlval) {
				if (isset($this->request->get[$urlval])) {
					$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
				}			
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link($this->modpath, $this->token_str . $url, $this->modssl));
		}

		$this->getList();
	}

	protected function getList() {
		$data = $this->load->language($this->modpath);
		
		$this->document->addScript('view/javascript/bganycombi.js');
		$this->document->addStyle('view/javascript/bganycombi.css');
		
		$filter_val = array();
 		foreach($this->urlfilter as $urlval) {
			$filter_val[$urlval] = isset($this->request->get[$urlval]) ? $this->request->get[$urlval] : null;			
		}
		
 		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'bganycombi_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
			
 		foreach($this->urlfilter as $urlval) {
			if (isset($this->request->get[$urlval])) {
				$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
			}			
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if(substr(VERSION,0,3)>='3.0') { 
			$data['user_token'] = $this->session->data['user_token'];
		} else {
			$data['token'] = $this->session->data['token'];
		}
  		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', $this->token_str, $this->modssl)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link($this->modpath, $this->token_str . $url, $this->modssl)
		);

		$data['add'] = $this->url->link($this->modpath.'/add', $this->token_str . $url, $this->modssl);
		$data['delete'] = $this->url->link($this->modpath.'/delete', $this->token_str . $url, $this->modssl);
				
		$data['checkcolumns'] = array('ribbontext', 'disctype', 'discount', 'buyqty', 'getqty', 'startdate', 'enddate', 'status', 'customer_group', 'store', 'buyproduct','buycategory', 'buymanufacturer', 'exbuyproduct', 'exbuycategory', 'exbuymanufacturer', 'getproduct','getcategory', 'getmanufacturer', 'exgetproduct', 'exgetcategory', 'exgetmanufacturer');
		
		$data['check_head_columns'] = array('ribbontext' => $data['entry_ribbontext'], 'disctype' => $data['entry_disctype'], 'discount' => $data['entry_discount'], 'buyqty' => $data['entry_buyqty'], 'getqty' => $data['entry_getqty'], 'startdate' => $data['entry_startdate'], 'enddate' => $data['entry_enddate'], 'status' => $data['entry_status'], 'customer_group' => $data['entry_customer_group'], 'store' => $data['entry_store'], 'buyproduct' => $data['entry_buyproduct'], 'buycategory' => $data['entry_buycategory'], 'buymanufacturer' => $data['entry_buymanufacturer'], 'exbuyproduct' => $data['entry_exbuyproduct'], 'exbuycategory' => $data['entry_exbuycategory'], 'exbuymanufacturer' => $data['entry_exbuymanufacturer'], 'getproduct' => $data['entry_getproduct'], 'getcategory' => $data['entry_getcategory'], 'getmanufacturer' => $data['entry_getmanufacturer'], 'exgetproduct' => $data['entry_exgetproduct'], 'exgetcategory' => $data['entry_exgetcategory'], 'exgetmanufacturer' => $data['entry_exgetmanufacturer']);
   
		$data['bganycombis'] = array();

		$filter_data = array();		
		foreach($this->urlfilter as $urlval) {
			$filter_data[$urlval] = isset($filter_val[$urlval]) ? $filter_val[$urlval] : null;
		}

		$bganycombi_total = $this->model_extension_bganycombi->getTotalbganycombis($filter_data);

		$results = $this->model_extension_bganycombi->getbganycombis($filter_data);
		
		$data['stores'] = $this->model_extension_bganycombi->getStores($data['text_default']);

		$data['customer_groups'] = $this->model_extension_bganycombi->getCustomerGroups();
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
 		$this->load->model('catalog/manufacturer');
 		
		$this->load->model('tool/image');
 
		foreach ($results as $result) { 
			// buy
			$buyproduct_data = $this->model_extension_bganycombi->getprodcatman($result['buyproduct'], 'product');
			$buycategory_data = $this->model_extension_bganycombi->getprodcatman($result['buycategory'], 'category');
			$buymanufacturer_data = $this->model_extension_bganycombi->getprodcatman($result['buymanufacturer'], 'manufacturer');
			$exbuyproduct_data = $this->model_extension_bganycombi->getprodcatman($result['exbuyproduct'], 'product');
			$exbuycategory_data = $this->model_extension_bganycombi->getprodcatman($result['exbuycategory'], 'category');
			$exbuymanufacturer_data = $this->model_extension_bganycombi->getprodcatman($result['exbuymanufacturer'], 'manufacturer');
			
			$getproduct_data = $this->model_extension_bganycombi->getprodcatman($result['getproduct'], 'product');
			$getcategory_data = $this->model_extension_bganycombi->getprodcatman($result['getcategory'], 'category');
			$getmanufacturer_data = $this->model_extension_bganycombi->getprodcatman($result['getmanufacturer'], 'manufacturer');
			$exgetproduct_data = $this->model_extension_bganycombi->getprodcatman($result['exgetproduct'], 'product');
			$exgetcategory_data = $this->model_extension_bganycombi->getprodcatman($result['exgetcategory'], 'category');
			$exgetmanufacturer_data = $this->model_extension_bganycombi->getprodcatman($result['exgetmanufacturer'], 'manufacturer');
									 
			$customer_group_data = array();
			$cgids = explode(",",$result['customer_group']);
			if($cgids) { 
				foreach ($data['customer_groups'] as $cgrp) {
					if (in_array($cgrp['customer_group_id'], $cgids)) {
						$customer_group_data[$cgrp['customer_group_id']] = $cgrp['name'];
					}
				}
			}
 			
			$store_data = array();
			$storeids = explode(",",$result['store']);
 			if($storeids) {
				foreach ($data['stores'] as $store) {
					if (in_array($store['store_id'], $storeids)) {
						$store_data[$store['store_id']] = $store['name'];
					}
				}
			}
			 
			$title = json_decode($result['title'],true);
			$ribbontext = json_decode($result['ribbontext'],true);
			
			$disctype = $data['text_free'];
			if($result['disctype'] == 2) { $disctype = $data['text_per']; }
			if($result['disctype'] == 3) { $disctype = $data['text_fix']; }
			 
			$data['bganycombis'][] = array(
				'bganycombi_id' => $result['bganycombi_id'],
 				'title' => $title[(int)$this->config->get('config_language_id')],
				'ribbontext' => $ribbontext[(int)$this->config->get('config_language_id')],
				'config_language_id' => (int)$this->config->get('config_language_id'),
				'status' => $result['status'] ? '<label class="oct_switch"> <input type="checkbox" checked class="chkstatus" data-str="'.$result['bganycombi_id'].'"/><span class="oct_slider oct_round"></span></label>' : '<label class="oct_switch"> <input type="checkbox" class="chkstatus" data-str="'.$result['bganycombi_id'].'"/><span class="oct_slider oct_round"></span></label>',
				
				'disctype' => $disctype,
				'discount' => ($result['disctype'] == 1) ? $data['text_free'] : $result['discount'],
				'buyqty' => $result['buyqty'],
				'getqty' => $result['getqty'],
				'startdate' => $result['startdate'] != '0000-00-00' ? date($this->language->get('date_format_short'), strtotime($result['startdate'])) : '',
				'enddate' => $result['enddate'] != '0000-00-00' ? date($this->language->get('date_format_short'), strtotime($result['enddate'])) : '',				
				'customer_group_data' => implode("<br>",$customer_group_data),
				'store_data' => implode("<br>",$store_data),
   				
				'buyproduct_data' => implode("<br>",$buyproduct_data),
				'buycategory_data' => implode("<br>",$buycategory_data),
				'buymanufacturer_data' => implode("<br>",$buymanufacturer_data), 
				'exbuyproduct_data' => implode("<br>",$exbuyproduct_data),
				'exbuycategory_data' => implode("<br>",$exbuycategory_data),
				'exbuymanufacturer_data' => implode("<br>",$exbuymanufacturer_data), 
				
				'getproduct_data' => implode("<br>",$getproduct_data),
				'getcategory_data' => implode("<br>",$getcategory_data),
				'getmanufacturer_data' => implode("<br>",$getmanufacturer_data), 
				'exgetproduct_data' => implode("<br>",$exgetproduct_data),
				'exgetcategory_data' => implode("<br>",$exgetcategory_data),
				'exgetmanufacturer_data' => implode("<br>",$exgetmanufacturer_data), 
				
 				'edit' => $this->url->link($this->modpath.'/edit', $this->token_str . '&bganycombi_id=' . $result['bganycombi_id'] . $url, $this->modssl),
				'delete' => $this->url->link($this->modpath.'/delete', $this->token_str . '&bganycombi_id=' . $result['bganycombi_id'] . $url, $this->modssl)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
 
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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';
			
 		foreach($this->urlfilter as $urlval) {
			if (isset($this->request->get[$urlval])) {
				$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
			}			
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$data['sort_status'] = $this->url->link($this->modpath, $this->token_str . '&sort=status' . $url, $this->modssl);
 
		$url = '';
			
 		foreach($this->urlfilter as $urlval) {
			if (isset($this->request->get[$urlval])) {
				$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
			}			
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $bganycombi_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link($this->modpath, $this->token_str . $url . '&page={page}', $this->modssl);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($bganycombi_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($bganycombi_total - $this->config->get('config_limit_admin'))) ? $bganycombi_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $bganycombi_total, ceil($bganycombi_total / $this->config->get('config_limit_admin')));
		
		foreach($this->urlfilter as $urlval) {
			$data[$urlval] = isset($filter_val[$urlval]) ? $filter_val[$urlval] : null;
		}
  		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view($this->modtpl_list, $data));
	}

	protected function getForm() {
		$data = $this->load->language($this->modpath);
		
		$this->document->addScript('view/javascript/bganycombiform.js');
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['bganycombi_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		
  		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$url = '';
			
 		foreach($this->urlfilter as $urlval) {
			if (isset($this->request->get[$urlval])) {
				$url .= '&'.$urlval.'=' . urlencode(html_entity_decode($this->request->get[$urlval], ENT_QUOTES, 'UTF-8'));
			}			
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['isoc2021'] = false;
		if(substr(VERSION,0,3)=='2.0' || substr(VERSION,0,3)=='2.1') {
			$data['isoc2021'] = true;
		}
		$data['isoc22'] = false;
		if(substr(VERSION,0,3)=='2.2') {
			$data['isoc22'] = true;
		}
		$data['isoc23'] = false;
		if(substr(VERSION,0,3)=='2.3') {
			$data['isoc23'] = true;
		}
		$data['isoc30'] = false;
		if(substr(VERSION,0,3)>='3.0') {
			$data['isoc30'] = true;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', $this->token_str, $this->modssl)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link($this->modpath, $this->token_str . $url, $this->modssl)
		);

		if (!isset($this->request->get['bganycombi_id'])) {
			$data['action'] = $this->url->link($this->modpath.'/add', $this->token_str . $url, $this->modssl);
		} else {
			$data['action'] = $this->url->link($this->modpath.'/edit', $this->token_str . '&bganycombi_id=' . $this->request->get['bganycombi_id'] . $url, $this->modssl);
		}

		$data['cancel'] = $this->url->link($this->modpath, $this->token_str . $url, $this->modssl);

		$bganycombi_info = array();
		if (isset($this->request->get['bganycombi_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$bganycombi_info = $this->model_extension_bganycombi->getbganycombi($this->request->get['bganycombi_id']);
		}

 		if(substr(VERSION,0,3)>='3.0') { 
 			$data['user_token'] = $this->session->data['user_token']; 
		} else {
			$data['token'] = $this->session->data['token'];
		}

		$this->load->model('localisation/language');
  		$languages = $this->model_localisation_language->getLanguages();
		foreach($languages as $language) {
			if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3' || substr(VERSION,0,3)=='2.2') {
				$imgsrc = "language/".$language['code']."/".$language['code'].".png";
			} else {
				$imgsrc = "view/image/flags/".$language['image'];
			}
			$data['languages'][] = array("language_id" => $language['language_id'], "name" => $language['name'], "imgsrc" => $imgsrc);
		}
		
		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} elseif (!empty($bganycombi_info)) {
			$data['title'] = json_decode($bganycombi_info['title'],true);
		} else {
			$data['title'] = array();
		}
  
  		if (isset($this->request->post['ribbontext'])) {
			$data['ribbontext'] = $this->request->post['ribbontext'];
		} elseif (!empty($bganycombi_info)) {
			$data['ribbontext'] = json_decode($bganycombi_info['ribbontext'],true);
		} else {
			$data['ribbontext'] = array();
		}
		
		if (isset($this->request->post['ordtotaltext'])) {
			$data['ordtotaltext'] = $this->request->post['ordtotaltext'];
		} elseif (!empty($bganycombi_info)) {
			$data['ordtotaltext'] = json_decode($bganycombi_info['ordtotaltext'],true);
		} else {
			$data['ordtotaltext'] = array();
		}
  		 
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($bganycombi_info)) {
			$data['status'] = $bganycombi_info['status'];
		} else {
			$data['status'] = true;
		}
		
		if (isset($this->request->post['disctype'])) {
			$data['disctype'] = $this->request->post['disctype'];
		} elseif (!empty($bganycombi_info)) {
			$data['disctype'] = $bganycombi_info['disctype'];
		} else {
			$data['disctype'] = 1;
		}
		
		if (isset($this->request->post['discount'])) {
			$data['discount'] = $this->request->post['discount'];
		} elseif (!empty($bganycombi_info)) {
			$data['discount'] = $bganycombi_info['discount'];
		} else {
			$data['discount'] = 1;
		}
		
		if (isset($this->request->post['buyqty'])) {
			$data['buyqty'] = $this->request->post['buyqty'];
		} elseif (!empty($bganycombi_info)) {
			$data['buyqty'] = $bganycombi_info['buyqty'];
		} else {
			$data['buyqty'] = 1;
		}
		
		if (isset($this->request->post['getqty'])) {
			$data['getqty'] = $this->request->post['getqty'];
		} elseif (!empty($bganycombi_info)) {
			$data['getqty'] = $bganycombi_info['getqty'];
		} else {
			$data['getqty'] = 1;
		}
		
		if (isset($this->request->post['startdate'])) {
			$data['startdate'] = $this->request->post['startdate'];
		} elseif (!empty($bganycombi_info)) {
			$data['startdate'] = ($bganycombi_info['startdate'] != '0000-00-00') ? $bganycombi_info['startdate'] : '';
		} else {
			$data['startdate'] = date('Y-m-d');
		}
		
		if (isset($this->request->post['enddate'])) {
			$data['enddate'] = $this->request->post['enddate'];
		} elseif (!empty($bganycombi_info)) {
			$data['enddate'] = ($bganycombi_info['enddate'] != '0000-00-00') ? $bganycombi_info['enddate'] : '';
		} else {
			$data['enddate'] = date('Y-m-d');
		}
		
		if (isset($this->request->post['showofferat'])) {
			$data['showofferat'] = $this->request->post['showofferat'];
		} elseif (!empty($bganycombi_info)) {
			$data['showofferat'] = $bganycombi_info['showofferat'];
		} else {
			$data['showofferat'] = 1;
		}
 		
		if (isset($this->request->post['offer_heading'])) {
			$data['offer_heading'] = $this->request->post['offer_heading'];
		} elseif (!empty($bganycombi_info)) {
			$data['offer_heading'] = json_decode($bganycombi_info['offer_heading'],true);
		} else {
			$data['offer_heading'] = array();
		}
		
		if (isset($this->request->post['offer_content'])) {
			$data['offer_content'] = $this->request->post['offer_content'];
		} elseif (!empty($bganycombi_info)) {
			$data['offer_content'] = json_decode($bganycombi_info['offer_content'],true);
		} else {
			$data['offer_content'] = array();
		}
		
		// store
		$data['stores'] = $this->model_extension_bganycombi->getStores($data['text_default']);
		
		if (isset($this->request->post['store'])) {
			$data['store'] = $this->request->post['store'];
		} elseif (!empty($bganycombi_info)) {
			$data['store'] = explode(",",$bganycombi_info['store']);
		} else {
			$data['store'] = array();
		}
  		
		// customer_group
		$data['customer_groups'] = $this->model_extension_bganycombi->getCustomerGroups();
		
		if (isset($this->request->post['customer_group'])) {
			$data['customer_group'] = $this->request->post['customer_group'];
		} elseif (!empty($bganycombi_info)) {
			$data['customer_group'] = explode(",",$bganycombi_info['customer_group']);
		} else {
			$data['customer_group'] = array();
		}
		
 		// Buy 
 		$buyproduct = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'buyproduct', 'product');
		$data['buyproduct'] = $buyproduct[0];
		$data['buyproduct_data'] = $buyproduct[1];
		
		$buycategory = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'buycategory', 'category');
		$data['buycategory'] = $buycategory[0];
		$data['buycategory_data'] = $buycategory[1];
		
		$buymanufacturer = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'buymanufacturer', 'manufacturer');
		$data['buymanufacturer'] = $buymanufacturer[0];
		$data['buymanufacturer_data'] = $buymanufacturer[1];
		
		$exbuyproduct = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'exbuyproduct', 'product');
		$data['exbuyproduct'] = $exbuyproduct[0];
		$data['exbuyproduct_data'] = $exbuyproduct[1];
		
		$exbuycategory = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'exbuycategory', 'category');
		$data['exbuycategory'] = $exbuycategory[0];
		$data['exbuycategory_data'] = $exbuycategory[1];
		
		$exbuymanufacturer = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'exbuymanufacturer', 'manufacturer');
		$data['exbuymanufacturer'] = $exbuymanufacturer[0];
		$data['exbuymanufacturer_data'] = $exbuymanufacturer[1];
		
		// get
		$getproduct = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'getproduct', 'product');
		$data['getproduct'] = $getproduct[0];
		$data['getproduct_data'] = $getproduct[1];
		
		$getcategory = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'getcategory', 'category');
		$data['getcategory'] = $getcategory[0];
		$data['getcategory_data'] = $getcategory[1];
		
		$getmanufacturer = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'getmanufacturer', 'manufacturer');
		$data['getmanufacturer'] = $getmanufacturer[0];
		$data['getmanufacturer_data'] = $getmanufacturer[1];
		
		$exgetproduct = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'exgetproduct', 'product');
		$data['exgetproduct'] = $exgetproduct[0];
		$data['exgetproduct_data'] = $exgetproduct[1];
		
		$exgetcategory = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'exgetcategory', 'category');
		$data['exgetcategory'] = $exgetcategory[0];
		$data['exgetcategory_data'] = $exgetcategory[1];
		
		$exgetmanufacturer = $this->model_extension_bganycombi->getprodcatmanform($bganycombi_info, 'exgetmanufacturer', 'manufacturer');
		$data['exgetmanufacturer'] = $exgetmanufacturer[0];
		$data['exgetmanufacturer_data'] = $exgetmanufacturer[1];		 

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view($this->modtpl_form, $data));
	}
	
 	protected function validateForm() {
		if (!$this->user->hasPermission('modify', $this->modpath)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', $this->modpath)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	} 
	
	public function savestatus() { 
		if(isset($this->request->post['id']) && $this->request->post['id']) { 
			$status = (isset($this->request->post['status']) && $this->request->post['status']) ? 1 : 0;
			$this->db->query("UPDATE " . DB_PREFIX . "bganycombi SET status = '" . $this->db->escape($status) . "' WHERE bganycombi_id = '" . (int)$this->request->post['id'] . "'");
 		}
	}
}

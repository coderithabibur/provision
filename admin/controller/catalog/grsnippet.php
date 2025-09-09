<?php  
class ControllerCatalogGrsnippet extends Controller {  
	private $error = array();
   
  	public function index() {
    	$this->load->language('catalog/grsnippet');       
    	$this->document->setTitle($this->language->get('heading_title'));
    	$this->getForm();
  	}
  	
    public function insertgoogle() {    
		$this->load->language('catalog/grsnippet');
		$this->load->model('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_setting_setting->editSetting('grsnippetgoogle', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('catalog/grsnippet/google', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}

	public function inserttwitter() {    
		$this->load->language('catalog/grsnippet');
		$this->load->model('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_setting_setting->editSetting('twittersnippet', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('catalog/grsnippet/twitter', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}

	public function insertfacebook() {    
		$this->load->language('catalog/grsnippet');
		$this->load->model('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_setting_setting->editSetting('grsnippetfacebook', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('catalog/grsnippet/facebook', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}

	public function insertpinterest() {    
		$this->load->language('catalog/grsnippet');
		$this->load->model('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_setting_setting->editSetting('grsnippetpinterest', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('catalog/grsnippet/pinterest', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}
	

	public function insert() {    
		$this->load->language('catalog/grsnippet');
		$this->load->model('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_setting_setting->editSetting('grsnippet', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('catalog/grsnippet', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}
	
	public function google() {

		$data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");


		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		$this->load->language('catalog/grsnippet');
		$data['heading_title'] = $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled'); 
		$data['text_about'] = $this->language->get('text_about'); 
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel'); 
		$data['text_multistoresupport'] = sprintf($this->language->get('text_multistoresupport'),$this->url->link('setting/setting', 'token=' . $this->session->data['token'] . '&store_id=0', 'SSL')); 
		$data['entry_google_status'] = $this->language->get('entry_google_status'); 
		$data['text_status'] = $this->language->get('text_status');
		$data['grsnippet'] = $this->language->get('grsnippet');
		$data['text_googlepageid'] = $this->language->get('text_googlepageid');
		$data['text_googlepageid_help'] = $this->language->get('text_googlepageid_help');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('catalog/grsnippet/google', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
		);

      	$data['action'] = $this->url->link('catalog/grsnippet/insertgoogle', 'token=' . $this->session->data['token'], 'SSL');
		
	    if (isset($this->request->post['grsnippetgoogle_status'])) {
			$data['grsnippetgoogle_status'] = $this->request->post['grsnippetgoogle_status'];
		} elseif ($this->config->get('grsnippetgoogle_status')) {
			$data['grsnippetgoogle_status'] = $this->config->get('grsnippetgoogle_status');
		} else {
			$data['grsnippetgoogle_status'] = 0;
		}

		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/grsnippet_google.tpl', $data));
	}

	public function twitter() {

		$data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");


		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		$this->load->language('catalog/grsnippet');
		$data['heading_title'] = $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_multistoresupport'] = sprintf($this->language->get('text_multistoresupport'),$this->url->link('setting/setting', 'token=' . $this->session->data['token'] . '&store_id=0', 'SSL'));
		$data['text_disabled'] = $this->language->get('text_disabled'); 
		$data['text_about'] = $this->language->get('text_about'); 
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel'); 
		$data['entry_twitter_status'] = $this->language->get('entry_twitter_status'); 
		$data['text_status'] = $this->language->get('text_status');
		$data['text_twitterusername'] = $this->language->get('text_twitterusername');
		$data['text_twitterusername_help'] = $this->language->get('text_twitterusername_help');
		$data['text_twittercardsize'] = $this->language->get('text_twittercardsize');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('catalog/grsnippet/twitter', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
		);

      	$data['action'] = $this->url->link('catalog/grsnippet/inserttwitter', 'token=' . $this->session->data['token'], 'SSL');
		
	   	if (isset($this->request->post['twittersnippet_status'])) {
			$data['twittersnippet_status'] = $this->request->post['twittersnippet_status'];
		} elseif ($this->config->get('twittersnippet_status')) {
			$data['twittersnippet_status'] = $this->config->get('twittersnippet_status');
		} else {
			$data['twittersnippet_status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/grsnippet_twitter.tpl', $data));
	}

	public function facebook() {
		
		$data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}

		$this->load->language('catalog/grsnippet');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled'); 
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel'); 
		$data['text_multistoresupport'] = sprintf($this->language->get('text_multistoresupport'),$this->url->link('setting/setting', 'token=' . $this->session->data['token'] . '&store_id=0', 'SSL')); 
		$data['entry_facebook_status'] = $this->language->get('entry_facebook_status'); 
		$data['text_status'] = $this->language->get('text_status');
		$data['text_facebookadminid'] = $this->language->get('text_facebookadminid');
		$data['text_facebookadminid_help'] = $this->language->get('text_facebookadminid_help');

		$data['token'] = $this->session->data['token'];

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('catalog/grsnippet/facebook', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
		);

      	$data['action'] = $this->url->link('catalog/grsnippet/insertfacebook', 'token=' . $this->session->data['token'], 'SSL');


		if (isset($this->request->post['grsnippetfacebook_status'])) {
			$data['grsnippetfacebook_status'] = $this->request->post['grsnippetfacebook_status'];
		} elseif ($this->config->get('grsnippetfacebook_status')) {
			$data['grsnippetfacebook_status'] = $this->config->get('grsnippetfacebook_status');
		} else {
			$data['grsnippetfacebook_status'] = '';
		}

		$data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'); 
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/grsnippet_facebook.tpl', $data));
	}

	public function pinterest() {
		
		$data['seomenu'] = $this->load->controller("catalog/seomenu");
        $data['seomegamenu'] = $this->load->controller("catalog/seomegamenu");
        $data['seotask'] = $this->load->controller("catalog/seotask");
        $data['seonotification'] = $this->load->controller("catalog/seonotification");
        $data['seoloadscripts'] = $this->load->controller("catalog/seoloadscripts");
        $data['seoloadstyles'] = $this->load->controller("catalog/seoloadstyles");

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}

		$this->load->language('catalog/grsnippet');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_multistoresupport'] = sprintf($this->language->get('text_multistoresupport'),$this->url->link('setting/setting', 'token=' . $this->session->data['token'] . '&store_id=0', 'SSL')); 
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled'); 
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel'); 
		$data['text_status'] = $this->language->get('text_status');
		$data['entry_pinterest_status'] = $this->language->get('entry_pinterest_status'); 
		$data['token'] = $this->session->data['token'];

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('catalog/grsnippet/pinterest', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
		);

      	$data['action'] = $this->url->link('catalog/grsnippet/insertpinterest', 'token=' . $this->session->data['token'], 'SSL');


		if (isset($this->request->post['grsnippetpinterest_status'])) {
			$data['grsnippetpinterest_status'] = $this->request->post['grsnippetpinterest_status'];
		} elseif ($this->config->get('grsnippetpinterest_status')) {
			$data['grsnippetpinterest_status'] = $this->config->get('grsnippetpinterest_status');
		} else {
			$data['grsnippetpinterest_status'] = 0;
		}
		 
		$data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'); 
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/grsnippet_pinterest.tpl', $data));
	}
}
?>
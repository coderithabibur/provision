<?php
class ControllerCatalogSeomenu extends Controller {
	public function index() {

		$this->load->language('catalog/seomenu');

		$data['text_headingtitle'] = $this->language->get('text_headingtitle');

		$data['text_generators'] = $this->language->get('text_generators');
		$data['text_autogenerators'] = $this->language->get('text_autogenerators');
		$data['text_editor'] = $this->language->get('text_editor');
		$data['text_report'] = $this->language->get('text_report');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_general'] = $this->language->get('text_general');
		$data['text_socialrichsnippets'] = $this->language->get('text_socialrichsnippets');
		$data['text_richsnippets'] = $this->language->get('text_richsnippets');
		$data['text_google'] = $this->language->get('text_google');
		$data['text_facebook'] = $this->language->get('text_facebook');
		$data['text_twitter'] = $this->language->get('text_twitter');
		$data['text_pinterest'] = $this->language->get('text_pinterest');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_robots'] = $this->language->get('text_robots');
		$data['text_seoredirectmanager'] = $this->language->get('text_seoredirectmanager');
		$data['text_redirectmanager'] = $this->language->get('text_redirectmanager');
		$data['text_failedlinks'] = $this->language->get('text_failedlinks');
		$data['text_clearseotool'] = $this->language->get('text_clearseotool');
		$data['text_clearseo'] = $this->language->get('text_clearseo');
		$data['text_setting'] = $this->language->get('text_seo_setting');
		$data['text_more'] = $this->language->get('text_more');
		$data['text_aboutallinoneseo'] = $this->language->get('text_aboutallinoneseo');
		$data['text_description'] = $this->language->get('text_description');
		
		$data['autogenerate_category'] = $this->url->link('catalog/seo/autogenerate_category', 'token=' . $this->session->data['token'], 'SSL');
		$data['autogenerate_product'] = $this->url->link('catalog/seo/autogenerate_product', 'token=' . $this->session->data['token'], 'SSL');
		$data['autogenerate_manufacturer'] = $this->url->link('catalog/seo/autogenerate_manufacturer', 'token=' . $this->session->data['token'], 'SSL');
		$data['autogenerate_information'] = $this->url->link('catalog/seo/autogenerate_information', 'token=' . $this->session->data['token'], 'SSL');
		$data['autogenerate_general'] = $this->url->link('catalog/seo/autogenerate_general', 'token=' . $this->session->data['token'], 'SSL');

		$data['customize_category'] = $this->url->link('catalog/seo/customizecategory', 'token=' . $this->session->data['token'], 'SSL');
		$data['customize_product'] = $this->url->link('catalog/seo/customizeproduct', 'token=' . $this->session->data['token'], 'SSL');
		$data['customize_manufacturer'] = $this->url->link('catalog/seo/customizemanufacturer', 'token=' . $this->session->data['token'], 'SSL');
		$data['customize_information'] = $this->url->link('catalog/seo/customizeinformation', 'token=' . $this->session->data['token'], 'SSL');
		$data['customize_general'] = $this->url->link('catalog/seo/customizegeneral', 'token=' . $this->session->data['token'], 'SSL');

		$data['report_completeseo'] = $this->url->link('catalog/seoReport', 'token=' . $this->session->data['token'], 'SSL');

		$data['snippet_google'] = $this->url->link('catalog/grsnippet/google', 'token=' . $this->session->data['token'], 'SSL');
		$data['snippet_facebook'] = $this->url->link('catalog/grsnippet/facebook', 'token=' . $this->session->data['token'], 'SSL');
		$data['snippet_twitter'] = $this->url->link('catalog/grsnippet/twitter', 'token=' . $this->session->data['token'], 'SSL');
		$data['snippet_pinterest'] = $this->url->link('catalog/grsnippet/pinterest', 'token=' . $this->session->data['token'], 'SSL');

		$data['sitemap'] = $this->url->link('catalog/sitemap', 'token=' . $this->session->data['token'], 'SSL');

		$data['redirectmanager'] = $this->url->link('catalog/seomanager', 'token=' . $this->session->data['token'], 'SSL');
		$data['failedlinks'] = $this->url->link('catalog/seomanager/failedlinks', 'token=' . $this->session->data['token'], 'SSL');

		$data['clearseo'] = $this->url->link('catalog/clearseo', 'token=' . $this->session->data['token'], 'SSL');
		$data['seo_settings'] = $this->url->link('catalog/setting', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('catalog/seomenu.tpl', $data);
	}
}

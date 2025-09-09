<?php
class ControllerCatalogSeonotification extends Controller {
	public function index() {
		//$this->load->language('catalog/seonotification');
		$data = array();
		return $this->load->view('catalog/seonotification.tpl', $data);
	}
}
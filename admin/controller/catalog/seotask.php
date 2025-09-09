<?php
class ControllerCatalogSeotask extends Controller {
	public function index() {
		//$this->load->language('catalog/seotask');
		$data = array();
		return $this->load->view('catalog/seotask.tpl', $data);
	}
}
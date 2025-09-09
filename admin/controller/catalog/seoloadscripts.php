<?php
class ControllerCatalogSeoloadscripts extends Controller {
	public function index() {
		$data = array();
		return $this->load->view('catalog/loadscripts.tpl', $data);
	}
}
<?php
class ControllerCatalogSeoloadstyles extends Controller {
	public function index() {
		$data = array();
		return $this->load->view('catalog/loadstylesheets.tpl', $data);
	}
}
<?php
class ControllerCommonSearch extends Controller {
	public function index() {
		$this->load->language('common/search');
		$this->load->model('catalog/category');
		
		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category) {

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'id'     => $category['category_id']
				);
		}
		$data['text_search'] = $this->language->get('text_search');

		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/search.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/search.tpl', $data);
		} else {
			return $this->load->view('default/template/common/search.tpl', $data);
		}
	}
}
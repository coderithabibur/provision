<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		// Home page Data
		$data['categories'] = $this->model_catalog_category->getCategories();
		$data['buy1get1'] = $this->getProductInfoById(290);
        $data['buy1get12'] = $this->getProductInfoById(251);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}

	private function getProductInfoById($product_id) {
        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {
            if ($product_info['image']) {
                $image = $this->model_tool_image->resize($product_info['image'], 200, 200);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', 200, 200);
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }
            
            // Return a formatted array of data
            return array(
                'name'  => $product_info['name'],
                'model' => $product_info['model'],
                'image' => $image,
                'price' => $price,
                'href'  => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
            );
        }

        // Return an empty array if the product is not found
        return array();
    }


}
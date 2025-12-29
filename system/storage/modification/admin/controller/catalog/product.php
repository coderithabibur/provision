<?php
class ControllerCatalogProduct extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		$this->getList();
	}

	public function add() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->session->data['success'] = $this->language->get('text_success');

			// 1. The addProduct model returns the new product_id. We capture it here.
			$product_id = $this->model_catalog_product->addProduct($this->request->post); 
			if (isset($this->request->post['product_section'])) { 
				$this->model_catalog_product->editProductSections($product_id, $this->request->post['product_section']); 
			}
			
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			
			$this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
 
			if (isset($this->request->post['product_section'])) {
				$this->model_catalog_product->editProductSections($this->request->get['product_id'], $this->request->post['product_section']);
			} else {
				$this->model_catalog_product->editProductSections($this->request->get['product_id'], array());
			}
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_product->deleteProduct($product_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function copy() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_product->copyProduct($product_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy'] = $this->url->link('catalog/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

		$results = $this->model_catalog_product->getProducts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];

					break;
				}
			}

			$data['products'][] = array(
				'product_id' => $result['product_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'special'    => $special,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_price'] = $filter_price;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_upc'] = $this->language->get('entry_upc');
		$data['entry_ean'] = $this->language->get('entry_ean');
		$data['entry_jan'] = $this->language->get('entry_jan');
		$data['entry_isbn'] = $this->language->get('entry_isbn');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_date_available'] = $this->language->get('entry_date_available');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_each'] = $this->language->get('entry_each');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_download'] = $this->language->get('entry_download');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_option_value'] = $this->language->get('entry_option_value');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_tag'] = $this->language->get('entry_tag');

		// $data['tab_gallery'] = $this->language->get('tab_gallery'); 
		$data['tab_sections'] = $this->language->get('tab_sections');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_content'] = $this->language->get('entry_content');
		$data['entry_background'] = $this->language->get('entry_background');
		$data['entry_section_type'] = $this->language->get('entry_section_type');
		$data['entry_video_path']   = $this->language->get('entry_video_path');
		$data['text_image']         = $this->language->get('text_image');
		$data['text_video']         = $this->language->get('text_video');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_reward'] = $this->language->get('entry_reward');
		
		$data['entry_delivery_days'] = $this->language->get('entry_delivery_days');
		
		
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_recurring'] = $this->language->get('entry_recurring');

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_sku'] = $this->language->get('help_sku');
		$data['help_upc'] = $this->language->get('help_upc');
		$data['help_ean'] = $this->language->get('help_ean');
		$data['help_jan'] = $this->language->get('help_jan');
		$data['help_isbn'] = $this->language->get('help_isbn');
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_category'] = $this->language->get('help_category');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_option'] = $this->language->get('tab_option');
		$data['tab_recurring'] = $this->language->get('tab_recurring');
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_special'] = $this->language->get('tab_special');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_openbay'] = $this->language->get('tab_openbay');

        $data['uksbhome'] = 'https://www.secureserverssl.co.uk/opencart-extensions/google-merchant/';

		$data['config_mpn'] = $this->config->get('uksb_google_merchant_mpn');
		$data['config_gtin'] = $this->config->get('uksb_google_merchant_g_gtin');
		$data['config_gpc_gb'] = $this->config->get('uksb_google_merchant_google_category_gb');
		$data['config_gpc_us'] = $this->config->get('uksb_google_merchant_google_category_us');
		$data['config_gpc_au'] = $this->config->get('uksb_google_merchant_google_category_au');
		$data['config_gpc_fr'] = $this->config->get('uksb_google_merchant_google_category_fr');
		$data['config_gpc_de'] = $this->config->get('uksb_google_merchant_google_category_de');
		$data['config_gpc_it'] = $this->config->get('uksb_google_merchant_google_category_it');
		$data['config_gpc_nl'] = $this->config->get('uksb_google_merchant_google_category_nl');
		$data['config_gpc_es'] = $this->config->get('uksb_google_merchant_google_category_es');
		$data['config_gpc_pt'] = $this->config->get('uksb_google_merchant_google_category_pt');
		$data['config_gpc_cz'] = $this->config->get('uksb_google_merchant_google_category_cz');
		$data['config_gpc_jp'] = $this->config->get('uksb_google_merchant_google_category_jp');
		$data['config_gpc_dk'] = $this->config->get('uksb_google_merchant_google_category_dk');
		$data['config_gpc_no'] = $this->config->get('uksb_google_merchant_google_category_no');
		$data['config_gpc_pl'] = $this->config->get('uksb_google_merchant_google_category_pl');
		$data['config_gpc_ru'] = $this->config->get('uksb_google_merchant_google_category_ru');
		$data['config_gpc_sv'] = $this->config->get('uksb_google_merchant_google_category_sv');
		$data['config_gpc_tr'] = $this->config->get('uksb_google_merchant_google_category_tr');
		
		$this->load->language('feed/uksb_google_merchant');
		// Google Merchant
		$data['tab_google'] = $this->language->get('tab_google');
		$data['entry_p_on_google'] = $this->language->get('entry_p_on_google');
		$data['help_p_on_google'] = $this->language->get('help_p_on_google');
		$data['entry_p_promotion_id'] = $this->language->get('entry_p_promotion_id');
		$data['help_p_promotion_id'] = $this->language->get('help_p_promotion_id');
		$data['entry_p_expiry_date'] = $this->language->get('entry_p_expiry_date');
		$data['help_p_expiry_date'] = $this->language->get('help_p_expiry_date');
		$data['entry_p_identifier_exists'] = $this->language->get('entry_p_identifier_exists');
		$data['help_p_identifier_exists'] = $this->language->get('help_p_identifier_exists');
		$data['entry_p_condition'] = $this->language->get('entry_p_condition');
		$data['help_p_condition'] = $this->language->get('help_p_condition');
		$data['entry_p_brand'] = $this->language->get('entry_p_brand');
		$data['help_p_brand'] = $this->language->get('help_p_brand');
		$data['entry_p_mpn'] = $this->language->get('entry_p_mpn');
		$data['help_p_mpn'] = $this->language->get('help_p_mpn');
		$data['entry_p_gtin'] = $this->language->get('entry_p_gtin');
		$data['help_p_gtin'] = $this->language->get('help_p_gtin');
		$data['entry_p_google_category'] = $this->language->get('entry_p_google_category');
		$data['entry_choose_google_category'] = $this->language->get('entry_choose_google_category');
		$data['entry_choose_google_category_xml'] = $this->language->get('entry_choose_google_category_xml');
		$data['help_p_google_category'] = $this->language->get('help_p_google_category');
		$data['entry_p_multipack'] = $this->language->get('entry_p_multipack');
		$data['help_p_multipack'] = $this->language->get('help_p_multipack');
		$data['entry_p_is_bundle'] = $this->language->get('entry_p_is_bundle');
		$data['help_p_is_bundle'] = $this->language->get('help_p_is_bundle');
		$data['entry_p_adult'] = $this->language->get('entry_p_adult');
		$data['help_p_adult'] = $this->language->get('help_p_adult');
		$data['entry_p_energy_efficiency_class'] = $this->language->get('entry_p_energy_efficiency_class');
		$data['help_p_energy_efficiency_class'] = $this->language->get('help_p_energy_efficiency_class');
		$data['entry_p_unit_pricing_measure'] = $this->language->get('entry_p_unit_pricing_measure');
		$data['help_p_unit_pricing_measure'] = $this->language->get('help_p_unit_pricing_measure');
		$data['entry_p_unit_pricing_base_measure'] = $this->language->get('entry_p_unit_pricing_base_measure');
		$data['help_p_unit_pricing_base_measure'] = $this->language->get('help_p_unit_pricing_base_measure');
		$data['entry_p_gender'] = $this->language->get('entry_p_gender');
		$data['entry_p_age_group'] = $this->language->get('entry_p_age_group');
		$data['entry_p_size_type'] = $this->language->get('entry_p_size_type');
		$data['help_p_size_type'] = $this->language->get('help_p_size_type');
		$data['entry_p_size_system'] = $this->language->get('entry_p_size_system');
		$data['help_p_size_system'] = $this->language->get('help_p_size_system');

		$data['entry_variant_section'] = $this->language->get('entry_variant_section');
		$data['entry_p_size'] = $this->language->get('entry_p_size');
		$data['entry_p_colour'] = $this->language->get('entry_p_colour');
		$data['entry_v_mpn'] = $this->language->get('entry_v_mpn');
		$data['entry_v_gtin'] = $this->language->get('entry_v_gtin');
		$data['entry_p_material'] = $this->language->get('entry_p_material');
		$data['entry_p_pattern'] = $this->language->get('entry_p_pattern');
		$data['entry_v_prices'] = $this->language->get('entry_v_prices');
		$data['help_v_prices'] = $this->language->get('help_v_prices');
		
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_variant'] = $this->language->get('button_add_variant');

		$data['entry_adwords_section'] = $this->language->get('entry_adwords_section');
		$data['help_p_custom_label'] = $this->language->get('help_p_custom_label');
		$data['entry_p_custom_label_0'] = $this->language->get('entry_p_custom_label_0');
		$data['entry_p_custom_label_1'] = $this->language->get('entry_p_custom_label_1');
		$data['entry_p_custom_label_2'] = $this->language->get('entry_p_custom_label_2');
		$data['entry_p_custom_label_3'] = $this->language->get('entry_p_custom_label_3');
		$data['entry_p_custom_label_4'] = $this->language->get('entry_p_custom_label_4');
		$data['entry_p_adwords_redirect'] = $this->language->get('entry_p_adwords_redirect');
		$data['help_p_adwords_redirect'] = $this->language->get('help_p_adwords_redirect');

		$data['entry_help_section'] = $this->language->get('entry_help_section');
		$data['help_google_help'] = $this->language->get('help_google_help');

		$data['text_condition_new'] = $this->language->get('text_condition_new');
		$data['text_condition_used'] = $this->language->get('text_condition_used');
		$data['text_condition_ref'] = $this->language->get('text_condition_ref');
		$data['text_male'] = $this->language->get('text_male');
		$data['text_female'] = $this->language->get('text_female');
		$data['text_unisex'] = $this->language->get('text_unisex');
		$data['text_newborn'] = $this->language->get('text_newborn');
		$data['text_infant'] = $this->language->get('text_infant');
		$data['text_toddler'] = $this->language->get('text_toddler');
		$data['text_kids'] = $this->language->get('text_kids');
		$data['text_adult'] = $this->language->get('text_adult');
		$data['text_regular'] = $this->language->get('text_regular');
		$data['text_petite'] = $this->language->get('text_petite');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_big_and_tall'] = $this->language->get('text_big_and_tall');
		$data['text_maternity'] = $this->language->get('text_maternity');
		$data['text_gpc_gb'] = $this->language->get('text_gpc_gb');
		$data['text_gpc_us'] = $this->language->get('text_gpc_us');
		$data['text_gpc_au'] = $this->language->get('text_gpc_au');
		$data['text_gpc_fr'] = $this->language->get('text_gpc_fr');
		$data['text_gpc_de'] = $this->language->get('text_gpc_de');
		$data['text_gpc_it'] = $this->language->get('text_gpc_it');
		$data['text_gpc_nl'] = $this->language->get('text_gpc_nl');
		$data['text_gpc_es'] = $this->language->get('text_gpc_es');
		$data['text_gpc_pt'] = $this->language->get('text_gpc_pt');
		$data['text_gpc_cz'] = $this->language->get('text_gpc_cz');
		$data['text_gpc_jp'] = $this->language->get('text_gpc_jp');
		$data['text_gpc_da'] = $this->language->get('text_gpc_da');
		$data['text_gpc_no'] = $this->language->get('text_gpc_no');
		$data['text_gpc_pl'] = $this->language->get('text_gpc_pl');
		$data['text_gpc_ru'] = $this->language->get('text_gpc_ru');
		$data['text_gpc_sv'] = $this->language->get('text_gpc_sv');
		$data['text_gpc_tr'] = $this->language->get('text_gpc_tr');

		$data['warning_mpn_model'] = $this->language->get('warning_mpn_model');
		$data['warning_mpn_sku'] = $this->language->get('warning_mpn_sku');
		$data['warning_mpn_location'] = $this->language->get('warning_mpn_location');
		$data['warning_gtin_default'] = $this->language->get('warning_gtin_default');
		$data['warning_gtin_sku'] = $this->language->get('warning_gtin_sku');
		$data['warning_gtin_location'] = $this->language->get('warning_gtin_location');
		$data['warning_nogpc'] = $this->language->get('warning_nogpc');
		$this->load->language('catalog/product');
            

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['model'])) {
			$data['error_model'] = $this->error['model'];
		} else {
			$data['error_model'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['product_id'])) {
			$data['action'] = $this->url->link('catalog/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);

		}
		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['product_description'])) {
			$data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$data['product_description'] = array();
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$data['image'] = $product_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && is_file(DIR_IMAGE . $product_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['model'])) {
			$data['model'] = $this->request->post['model'];
		} elseif (!empty($product_info)) {
			$data['model'] = $product_info['model'];
		} else {
			$data['model'] = '';
		}

        if (isset($this->request->post['video_link'])) {
            $data['video_link'] = $this->request->post['video_link'];
        } elseif (!empty($product_info)) {
            $data['video_link'] = $product_info['video_link'];
        } else {
            $data['video_link'] = '';
        }

        if (isset($this->request->post['video_title'])) {
            $data['video_title'] = $this->request->post['video_title'];
        } elseif (!empty($product_info)) {
            $data['video_title'] = $product_info['video_title'];
        } else {
            $data['video_title'] = '';
        }

        if (isset($this->request->post['video_overview'])) {
            $data['video_overview'] = $this->request->post['video_overview'];
        } elseif (!empty($product_info)) {
            $data['video_overview'] = $product_info['video_overview'];
        } else {
            $data['video_overview'] = '';
        }

        if (isset($this->request->post['product_cost'])) {
            $data['product_cost'] = $this->request->post['product_cost'];
        } elseif (!empty($product_info)) {
            $data['product_cost'] = $product_info['product_cost'];
        } else {
            $data['product_cost'] = '';
        }

        if (isset($this->request->post['sku'])) {
			$data['sku'] = $this->request->post['sku'];
		} elseif (!empty($product_info)) {
			$data['sku'] = $product_info['sku'];
		} else {
			$data['sku'] = '';
		}

		if (isset($this->request->post['upc'])) {
			$data['upc'] = $this->request->post['upc'];
		} elseif (!empty($product_info)) {
			$data['upc'] = $product_info['upc'];
		} else {
			$data['upc'] = '';
		}

		if (isset($this->request->post['ean'])) {
			$data['ean'] = $this->request->post['ean'];
		} elseif (!empty($product_info)) {
			$data['ean'] = $product_info['ean'];
		} else {
			$data['ean'] = '';
		}

		if (isset($this->request->post['jan'])) {
			$data['jan'] = $this->request->post['jan'];
		} elseif (!empty($product_info)) {
			$data['jan'] = $product_info['jan'];
		} else {
			$data['jan'] = '';
		}

		if (isset($this->request->post['isbn'])) {
			$data['isbn'] = $this->request->post['isbn'];
		} elseif (!empty($product_info)) {
			$data['isbn'] = $product_info['isbn'];
		} else {
			$data['isbn'] = '';
		}

		if (isset($this->request->post['mpn'])) {
			$data['mpn'] = $this->request->post['mpn'];
		} elseif (!empty($product_info)) {
			$data['mpn'] = $product_info['mpn'];
		} else {
			$data['mpn'] = '';
		}

		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($product_info)) {
			$data['location'] = $product_info['location'];
		} else {
			$data['location'] = '';
		}

		if (isset($this->request->post['g_on_google'])) {
      		$data['g_on_google'] = $this->request->post['g_on_google'];
    	} elseif (!empty($product_info)) {
			$data['g_on_google'] = $product_info['g_on_google'];
		} else {
      		$data['g_on_google'] = '';
    	}
		
		if (isset($this->request->post['g_promotion_id'])) {
      		$data['g_promotion_id'] = $this->request->post['g_promotion_id'];
    	} elseif (!empty($product_info)) {
			$data['g_promotion_id'] = $product_info['g_promotion_id'];
		} else {
      		$data['g_promotion_id'] = '';
    	}
		
		if (isset($this->request->post['g_expiry_date'])) {
      		$data['g_expiry_date'] = $this->request->post['g_expiry_date'];
    	} elseif (!empty($product_info)) {
			$data['g_expiry_date'] = $product_info['g_expiry_date'];
		} else {
      		$data['g_expiry_date'] = '';
    	}

		if (isset($this->request->post['g_identifier_exists'])) {
      		$data['g_identifier_exists'] = $this->request->post['g_identifier_exists'];
    	} elseif (!empty($product_info)) {
			$data['g_identifier_exists'] = $product_info['g_identifier_exists'];
		} else {
      		$data['g_identifier_exists'] = '';
    	}
				
		if (isset($this->request->post['g_condition'])) {
      		$data['g_condition'] = $this->request->post['g_condition'];
    	} elseif (!empty($product_info)) {
			$data['g_condition'] = $product_info['g_condition'];
		} else {
      		$data['g_condition'] = '';
    	}

		if (isset($this->request->post['g_brand'])) {
      		$data['g_brand'] = $this->request->post['g_brand'];
    	} elseif (!empty($product_info)) {
			$data['g_brand'] = $product_info['g_brand'];
		} else {
      		$data['g_brand'] = '';
    	}

		if (isset($this->request->post['g_gtin'])) {
      		$data['g_gtin'] = $this->request->post['g_gtin'];
    	} elseif (!empty($product_info)) {
			$data['g_gtin'] = $product_info['g_gtin'];
		} else {
      		$data['g_gtin'] = '';
    	}

		if (isset($this->request->post['google_category_gb'])) {
			$data['google_category_gb'] = $this->request->post['google_category_gb'];
			$data['google_category_us'] = $this->request->post['google_category_us'];
			$data['google_category_au'] = $this->request->post['google_category_au'];
			$data['google_category_fr'] = $this->request->post['google_category_fr'];
			$data['google_category_de'] = $this->request->post['google_category_de'];
			$data['google_category_it'] = $this->request->post['google_category_it'];
			$data['google_category_nl'] = $this->request->post['google_category_nl'];
			$data['google_category_es'] = $this->request->post['google_category_es'];
			$data['google_category_pt'] = $this->request->post['google_category_pt'];
			$data['google_category_cz'] = $this->request->post['google_category_cz'];
			$data['google_category_jp'] = $this->request->post['google_category_jp'];
			$data['google_category_dk'] = $this->request->post['google_category_dk'];
			$data['google_category_no'] = $this->request->post['google_category_no'];
			$data['google_category_pl'] = $this->request->post['google_category_pl'];
			$data['google_category_ru'] = $this->request->post['google_category_ru'];
			$data['google_category_sv'] = $this->request->post['google_category_sv'];
			$data['google_category_tr'] = $this->request->post['google_category_tr'];
		} elseif (!empty($product_info)) {
			$data['google_category_gb'] = $product_info['google_category_gb'];
			$data['google_category_us'] = $product_info['google_category_us'];
			$data['google_category_au'] = $product_info['google_category_au'];
			$data['google_category_fr'] = $product_info['google_category_fr'];
			$data['google_category_de'] = $product_info['google_category_de'];
			$data['google_category_it'] = $product_info['google_category_it'];
			$data['google_category_nl'] = $product_info['google_category_nl'];
			$data['google_category_es'] = $product_info['google_category_es'];
			$data['google_category_pt'] = $product_info['google_category_pt'];
			$data['google_category_cz'] = $product_info['google_category_cz'];
			$data['google_category_jp'] = $product_info['google_category_jp'];
			$data['google_category_dk'] = $product_info['google_category_dk'];
			$data['google_category_no'] = $product_info['google_category_no'];
			$data['google_category_pl'] = $product_info['google_category_pl'];
			$data['google_category_ru'] = $product_info['google_category_ru'];
			$data['google_category_sv'] = $product_info['google_category_sv'];
			$data['google_category_tr'] = $product_info['google_category_tr'];
		} else {
			$data['google_category_gb'] = '';
			$data['google_category_us'] = '';
			$data['google_category_au'] = '';
			$data['google_category_fr'] = '';
			$data['google_category_de'] = '';
			$data['google_category_it'] = '';
			$data['google_category_nl'] = '';
			$data['google_category_es'] = '';
			$data['google_category_pt'] = '';
			$data['google_category_cz'] = '';
			$data['google_category_jp'] = '';
			$data['google_category_dk'] = '';
			$data['google_category_no'] = '';
			$data['google_category_pl'] = '';
			$data['google_category_ru'] = '';
			$data['google_category_sv'] = '';
			$data['google_category_tr'] = '';
		}

		if (isset($this->request->post['g_multipack'])) {
      		$data['g_multipack'] = $this->request->post['g_multipack'];
    	} elseif (!empty($product_info)) {
			$data['g_multipack'] = $product_info['g_multipack'];
		} else {
      		$data['g_multipack'] = '';
    	}
				
		if (isset($this->request->post['g_is_bundle'])) {
      		$data['g_is_bundle'] = $this->request->post['g_is_bundle'];
    	} elseif (!empty($product_info)) {
			$data['g_is_bundle'] = $product_info['g_is_bundle'];
		} else {
      		$data['g_is_bundle'] = '';
    	}
				
		if (isset($this->request->post['g_adult'])) {
      		$data['g_adult'] = $this->request->post['g_adult'];
    	} elseif (!empty($product_info)) {
			$data['g_adult'] = $product_info['g_adult'];
		} else {
      		$data['g_adult'] = '';
    	}

		if (isset($this->request->post['g_energy_efficiency_class'])) {
      		$data['g_energy_efficiency_class'] = $this->request->post['g_energy_efficiency_class'];
    	} elseif (!empty($product_info)) {
			$data['g_energy_efficiency_class'] = $product_info['g_energy_efficiency_class'];
		} else {
      		$data['g_energy_efficiency_class'] = '';
    	}

		if (isset($this->request->post['g_unit_pricing_measure'])) {
      		$data['g_unit_pricing_measure'] = $this->request->post['g_unit_pricing_measure'];
    	} elseif (!empty($product_info)) {
			$data['g_unit_pricing_measure'] = $product_info['g_unit_pricing_measure'];
		} else {
      		$data['g_unit_pricing_measure'] = '';
    	}
				
		if (isset($this->request->post['g_unit_pricing_base_measure'])) {
      		$data['g_unit_pricing_base_measure'] = $this->request->post['g_unit_pricing_base_measure'];
    	} elseif (!empty($product_info)) {
			$data['g_unit_pricing_base_measure'] = $product_info['g_unit_pricing_base_measure'];
		} else {
      		$data['g_unit_pricing_base_measure'] = '';
    	}

		if (isset($this->request->post['g_gender'])) {
      		$data['g_gender'] = $this->request->post['g_gender'];
    	} elseif (!empty($product_info)) {
			$data['g_gender'] = $product_info['g_gender'];
		} else {
      		$data['g_gender'] = '';
    	}

		if (isset($this->request->post['g_age_group'])) {
      		$data['g_age_group'] = $this->request->post['g_age_group'];
    	} elseif (!empty($product_info)) {
			$data['g_age_group'] = $product_info['g_age_group'];
		} else {
      		$data['g_age_group'] = '';
    	}

		if (isset($this->request->post['g_size_type'])) {
      		$data['g_size_type'] = $this->request->post['g_size_type'];
    	} elseif (!empty($product_info)) {
			$data['g_size_type'] = $product_info['g_size_type'];
		} else {
      		$data['g_size_type'] = '';
    	}

		if (isset($this->request->post['g_size_system'])) {
      		$data['g_size_system'] = $this->request->post['g_size_system'];
    	} elseif (!empty($product_info)) {
			$data['g_size_system'] = $product_info['g_size_system'];
		} else {
      		$data['g_size_system'] = '';
    	}

		if (isset($this->request->post['g_size'])) {
      		$data['g_size'] = $this->request->post['g_size'];
    	} elseif (!empty($product_info)) {
			$data['g_size'] = $product_info['g_size'];
		} else {
      		$data['g_size'] = '';
    	}

		if (isset($this->request->post['g_colour'])) {
      		$data['g_colour'] = $this->request->post['g_colour'];
    	} elseif (!empty($product_info)) {
			$data['g_colour'] = $product_info['g_colour'];
		} else {
      		$data['g_colour'] = '';
    	}

		if (isset($this->request->post['g_material'])) {
      		$data['g_material'] = $this->request->post['g_material'];
    	} elseif (!empty($product_info)) {
			$data['g_material'] = $product_info['g_material'];
		} else {
      		$data['g_material'] = '';
    	}

		if (isset($this->request->post['g_pattern'])) {
      		$data['g_pattern'] = $this->request->post['g_pattern'];
    	} elseif (!empty($product_info)) {
			$data['g_pattern'] = $product_info['g_pattern'];
		} else {
      		$data['g_pattern'] = '';
    	}

		if (isset($this->request->post['variant'])) {
			$variants = $this->request->post['variant'];
		} elseif (!empty($product_info)) {
			$xcolour = explode(",", $product_info['g_colour']);
			$xsize = explode(",", $product_info['g_size']);
			$xmaterial = explode(",", $product_info['g_material']);
			$xpattern = explode(",", $product_info['g_pattern']);
			$xmpn = explode(",", $product_info['v_mpn']);
			$xgtin = explode(",", $product_info['v_gtin']);
			$xprices = explode(",", $product_info['v_prices']);
			$ximages = explode(",", $product_info['v_images']);
			
			foreach (array_keys($xcolour) as $key){
				$variants[$key]['g_colour'] = (array_key_exists($key, $xcolour)?$xcolour[$key]:'');
				$variants[$key]['g_size'] = (array_key_exists($key, $xsize)?$xsize[$key]:'');
				$variants[$key]['g_material'] = (array_key_exists($key, $xmaterial)?$xmaterial[$key]:'');
				$variants[$key]['g_pattern'] = (array_key_exists($key, $xpattern)?$xpattern[$key]:'');
				$variants[$key]['v_mpn'] = (array_key_exists($key, $xmpn)?$xmpn[$key]:'');
				$variants[$key]['v_gtin'] = (array_key_exists($key, $xgtin)?$xgtin[$key]:'');
				$variants[$key]['v_prices'] = (array_key_exists($key, $xprices)?$xprices[$key]:'');
				$variants[$key]['v_images'] = (array_key_exists($key, $ximages)?$ximages[$key]:'');
			}
		} else {
			$variants = array();
		}

		$this->load->model('tool/image');

		$data['variants'] = array();

		foreach ($variants as $variant) {
			if ($variant['v_images'] && file_exists(DIR_IMAGE . $variant['v_images'])) {
				$v_images = $variant['v_images'];
			} else {
				$v_images = 'no_image.jpg';
			}

			$data['variants'][] = array(
				'g_colour'               => $variant['g_colour'],
				'g_size'               => $variant['g_size'],
				'g_material'               => $variant['g_material'],
				'g_pattern'               => $variant['g_pattern'],
				'v_mpn'               => $variant['v_mpn'],
				'v_gtin'               => $variant['v_gtin'],
				'v_prices'               => $variant['v_prices'],
				'v_images'                    => $v_images,
				'thumb'                    => $this->model_tool_image->resize($v_images, 100, 100)
			);
		}

		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (isset($this->request->post['v_mpn'])) {
      		$data['v_mpn'] = $this->request->post['v_mpn'];
    	} elseif (!empty($product_info)) {
			$data['v_mpn'] = $product_info['v_mpn'];
		} else {
      		$data['v_mpn'] = '';
    	}

		if (isset($this->request->post['v_gtin'])) {
      		$data['v_gtin'] = $this->request->post['v_gtin'];
    	} elseif (!empty($product_info)) {
			$data['v_gtin'] = $product_info['v_gtin'];
		} else {
      		$data['v_gtin'] = '';
    	}

		if (isset($this->request->post['v_prices'])) {
      		$data['v_prices'] = $this->request->post['v_prices'];
    	} elseif (!empty($product_info)) {
			$data['v_prices'] = $product_info['v_prices'];
		} else {
      		$data['v_prices'] = '';
    	}

		if (isset($this->request->post['v_images'])) {
      		$data['v_images'] = $this->request->post['v_images'];
    	} elseif (!empty($product_info)) {
			$data['v_images'] = $product_info['v_images'];
		} else {
      		$data['v_images'] = '';
    	}
							
		if (isset($this->request->post['g_custom_label_0'])) {
      		$data['g_custom_label_0'] = $this->request->post['g_custom_label_0'];
    	} elseif (!empty($product_info)) {
			$data['g_custom_label_0'] = $product_info['g_custom_label_0'];
		} else {
      		$data['g_custom_label_0'] = '';
    	}
				
		if (isset($this->request->post['g_custom_label_1'])) {
      		$data['g_custom_label_1'] = $this->request->post['g_custom_label_1'];
    	} elseif (!empty($product_info)) {
			$data['g_custom_label_1'] = $product_info['g_custom_label_1'];
		} else {
      		$data['g_custom_label_1'] = '';
    	}
				
		if (isset($this->request->post['g_custom_label_2'])) {
      		$data['g_custom_label_2'] = $this->request->post['g_custom_label_2'];
    	} elseif (!empty($product_info)) {
			$data['g_custom_label_2'] = $product_info['g_custom_label_2'];
		} else {
      		$data['g_custom_label_2'] = '';
    	}
				
		if (isset($this->request->post['g_custom_label_3'])) {
      		$data['g_custom_label_3'] = $this->request->post['g_custom_label_3'];
    	} elseif (!empty($product_info)) {
			$data['g_custom_label_3'] = $product_info['g_custom_label_3'];
		} else {
      		$data['g_custom_label_3'] = '';
    	}
				
		if (isset($this->request->post['g_custom_label_4'])) {
      		$data['g_custom_label_4'] = $this->request->post['g_custom_label_4'];
    	} elseif (!empty($product_info)) {
			$data['g_custom_label_4'] = $product_info['g_custom_label_4'];
		} else {
      		$data['g_custom_label_4'] = '';
    	}				

		if (isset($this->request->post['g_adwords_redirect'])){
			$data['g_adwords_redirect'] = $this->request->post['g_adwords_redirect'];
		} elseif (!empty($product_info)) {
			$data['g_adwords_redirect'] = $product_info['g_adwords_redirect'];
		} else {
			$data['g_adwords_redirect'] = '';
		}
        	

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['product_store'])) {
			$data['product_store'] = $this->request->post['product_store'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
		} else {
			$data['product_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($product_info)) {
			$data['keyword'] = $product_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['shipping'])) {
			$data['shipping'] = $this->request->post['shipping'];
		} elseif (!empty($product_info)) {
			$data['shipping'] = $product_info['shipping'];
		} else {
			$data['shipping'] = 1;
		}

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$data['price'] = $product_info['price'];
		} else {
			$data['price'] = '';
		}

		if (isset($this->request->post['txt_each'])) {
			$data['txt_each'] = $this->request->post['txt_each'];
		} elseif (!empty($product_info)) {
			$data['txt_each'] = $product_info['txt_each'];
		} else {
			$data['txt_each'] = '';
		}

		$this->load->model('catalog/recurring');

		$data['recurrings'] = $this->model_catalog_recurring->getRecurrings();

		if (isset($this->request->post['product_recurrings'])) {
			$data['product_recurrings'] = $this->request->post['product_recurrings'];
		} elseif (!empty($product_info)) {
			$data['product_recurrings'] = $this->model_catalog_product->getRecurrings($product_info['product_id']);
		} else {
			$data['product_recurrings'] = array();
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['tax_class_id'])) {
			$data['tax_class_id'] = $this->request->post['tax_class_id'];
		} elseif (!empty($product_info)) {
			$data['tax_class_id'] = $product_info['tax_class_id'];
		} else {
			$data['tax_class_id'] = 0;
		}

		if (isset($this->request->post['date_available'])) {
			$data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$data['date_available'] = ($product_info['date_available'] != '0000-00-00') ? $product_info['date_available'] : '';
		} else {
			$data['date_available'] = date('Y-m-d');
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = 1;
		}

		if (isset($this->request->post['minimum'])) {
			$data['minimum'] = $this->request->post['minimum'];
		} elseif (!empty($product_info)) {
			$data['minimum'] = $product_info['minimum'];
		} else {
			$data['minimum'] = 1;
		}

		if (isset($this->request->post['subtract'])) {
			$data['subtract'] = $this->request->post['subtract'];
		} elseif (!empty($product_info)) {
			$data['subtract'] = $product_info['subtract'];
		} else {
			$data['subtract'] = 1;
		}
		
		if (isset($this->request->post['delivery_days'])) {
			$data['delivery_days'] = $this->request->post['delivery_days'];
		} elseif (!empty($product_info)) {
			$data['delivery_days'] = $product_info['delivery_days'];
		} else {
			$data['delivery_days'] = 5;
		}
		
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($product_info)) {
			$data['sort_order'] = $product_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		}

		$this->load->model('localisation/stock_status');

		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

		if (isset($this->request->post['stock_status_id'])) {
			$data['stock_status_id'] = $this->request->post['stock_status_id'];
		} elseif (!empty($product_info)) {
			$data['stock_status_id'] = $product_info['stock_status_id'];
		} else {
			$data['stock_status_id'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($product_info)) {
			$data['status'] = $product_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['weight'])) {
			$data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$data['weight'] = $product_info['weight'];
		} else {
			$data['weight'] = '';
		}

		$this->load->model('localisation/weight_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post['weight_class_id'])) {
			$data['weight_class_id'] = $this->request->post['weight_class_id'];
		} elseif (!empty($product_info)) {
			$data['weight_class_id'] = $product_info['weight_class_id'];
		} else {
			$data['weight_class_id'] = $this->config->get('config_weight_class_id');
		}

		if (isset($this->request->post['length'])) {
			$data['length'] = $this->request->post['length'];
		} elseif (!empty($product_info)) {
			$data['length'] = $product_info['length'];
		} else {
			$data['length'] = '';
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($product_info)) {
			$data['width'] = $product_info['width'];
		} else {
			$data['width'] = '';
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($product_info)) {
			$data['height'] = $product_info['height'];
		} else {
			$data['height'] = '';
		}

		$this->load->model('localisation/length_class');

		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post['length_class_id'])) {
			$data['length_class_id'] = $this->request->post['length_class_id'];
		} elseif (!empty($product_info)) {
			$data['length_class_id'] = $product_info['length_class_id'];
		} else {
			$data['length_class_id'] = $this->config->get('config_length_class_id');
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->post['manufacturer_id'])) {
			$data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($product_info)) {
			$data['manufacturer_id'] = $product_info['manufacturer_id'];
		} else {
			$data['manufacturer_id'] = 0;
		}

		if (isset($this->request->post['manufacturer'])) {
			$data['manufacturer'] = $this->request->post['manufacturer'];
		} elseif (!empty($product_info)) {
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);

			if ($manufacturer_info) {
				$data['manufacturer'] = $manufacturer_info['name'];
			} else {
				$data['manufacturer'] = '';
			}
		} else {
			$data['manufacturer'] = '';
		}

		// Categories
		$this->load->model('catalog/category');

		if (isset($this->request->post['product_category'])) {
			$categories = $this->request->post['product_category'];
		} elseif (isset($this->request->get['product_id'])) {
			$categories = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
		} else {
			$categories = array();
		}

		$data['product_categories'] = array();

		foreach ($categories as $category_id) {
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$data['product_categories'][] = array(
					'category_id' => $category_info['category_id'],
					'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
				);
			}
		}

		// Filters
		$this->load->model('catalog/filter');

		if (isset($this->request->post['product_filter'])) {
			$filters = $this->request->post['product_filter'];
		} elseif (isset($this->request->get['product_id'])) {
			$filters = $this->model_catalog_product->getProductFilters($this->request->get['product_id']);
		} else {
			$filters = array();
		}

		$data['product_filters'] = array();

		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);

			if ($filter_info) {
				$data['product_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}

		// Attributes
		$this->load->model('catalog/attribute');

		if (isset($this->request->post['product_attribute'])) {
			$product_attributes = $this->request->post['product_attribute'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_attributes = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
		} else {
			$product_attributes = array();
		}

		$data['product_attributes'] = array();

		foreach ($product_attributes as $product_attribute) {
			$attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);

			if ($attribute_info) {
				$data['product_attributes'][] = array(
					'attribute_id'                  => $product_attribute['attribute_id'],
					'name'                          => $attribute_info['name'],
					'product_attribute_description' => $product_attribute['product_attribute_description']
				);
			}
		}

		// Options
		$this->load->model('catalog/option');

		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);
		} else {
			$product_options = array();
		}

		$data['product_options'] = array();

		foreach ($product_options as $product_option) {
			$product_option_value_data = array();

			if (isset($product_option['product_option_value'])) {
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']
					);
				}
			}

			$data['product_options'][] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => isset($product_option['value']) ? $product_option['value'] : '',
				'required'             => $product_option['required']
			);
		}

		$data['option_values'] = array();

		foreach ($data['product_options'] as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($data['option_values'][$product_option['option_id']])) {
					$data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		if (isset($this->request->post['product_discount'])) {
			$product_discounts = $this->request->post['product_discount'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
		} else {
			$product_discounts = array();
		}

		$data['product_discounts'] = array();

		foreach ($product_discounts as $product_discount) {
			$data['product_discounts'][] = array(
				'customer_group_id' => $product_discount['customer_group_id'],
				'quantity'          => $product_discount['quantity'],
				'priority'          => $product_discount['priority'],
				'price'             => $product_discount['price'],
				'date_start'        => ($product_discount['date_start'] != '0000-00-00') ? $product_discount['date_start'] : '',
				'date_end'          => ($product_discount['date_end'] != '0000-00-00') ? $product_discount['date_end'] : ''
			);
		}

		if (isset($this->request->post['product_special'])) {
			$product_specials = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_specials = $this->model_catalog_product->getProductSpecials($this->request->get['product_id']);
		} else {
			$product_specials = array();
		}

		$data['product_specials'] = array();

		foreach ($product_specials as $product_special) {
			$data['product_specials'][] = array(
				'customer_group_id' => $product_special['customer_group_id'],
				'priority'          => $product_special['priority'],
				'price'             => $product_special['price'],
				'date_start'        => ($product_special['date_start'] != '0000-00-00') ? $product_special['date_start'] : '',
				'date_end'          => ($product_special['date_end'] != '0000-00-00') ? $product_special['date_end'] :  ''
			);
		}

		// Images
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
		} else {
			$product_images = array();
		}

		$data['product_images'] = array();

		foreach ($product_images as $product_image) {
			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
				$thumb = $product_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['product_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $product_image['sort_order']
			);
		}

		// Custom Sections
		if (isset($this->request->post['product_section'])) {
			$product_sections = $this->request->post['product_section'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_sections = $this->model_catalog_product->getProductSections($this->request->get['product_id']);
		} else {
			$product_sections = array();
		}

		$data['product_sections'] = array();

		foreach ($product_sections as $section) {
			if (is_file(DIR_IMAGE . $section['image'])) {
				$image = $section['image'];
				$thumb = $section['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['product_sections'][] = array(
				'image'       => $image,
				'thumb'       => $this->model_tool_image->resize($thumb, 100, 100),
				'title'       => $section['title'],
				'description' => $section['description'],
				'sort_order'  => $section['sort_order']
			);
		}

		// Custom Gallery
		// if (isset($this->request->post['product_gallery'])) {
		// 	$product_gallery_images = $this->request->post['product_gallery'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$product_gallery_images = $this->model_catalog_product->getProductGalleryImages($this->request->get['product_id']);
		// } else {
		// 	$product_gallery_images = array();
		// }

		// $data['product_gallery_images'] = array();

		// foreach ($product_gallery_images as $gallery_image) {
		// 	if (is_file(DIR_IMAGE . $gallery_image['image'])) {
		// 		$image = $gallery_image['image'];
		// 		$thumb = $gallery_image['image'];
		// 	} else {
		// 		$image = '';
		// 		$thumb = 'no_image.png';
		// 	}

		// 	$data['product_gallery_images'][] = array(
		// 		'image'      => $image,
		// 		'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
		// 		'sort_order' => $gallery_image['sort_order']
		// 	);
		// }
		 

		// Downloads
		$this->load->model('catalog/download');

		if (isset($this->request->post['product_download'])) {
			$product_downloads = $this->request->post['product_download'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_downloads = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
		} else {
			$product_downloads = array();
		}

		$data['product_downloads'] = array();

		foreach ($product_downloads as $download_id) {
			$download_info = $this->model_catalog_download->getDownload($download_id);

			if ($download_info) {
				$data['product_downloads'][] = array(
					'download_id' => $download_info['download_id'],
					'name'        => $download_info['name']
				);
			}
		}

		if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} elseif (isset($this->request->get['product_id'])) {
			$products = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
		} else {
			$products = array();
		}

		$data['product_relateds'] = array();

		foreach ($products as $product_id) {
			$related_info = $this->model_catalog_product->getProduct($product_id);

			if ($related_info) {
				$data['product_relateds'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}

		if (isset($this->request->post['points'])) {
			$data['points'] = $this->request->post['points'];
		} elseif (!empty($product_info)) {
			$data['points'] = $product_info['points'];
		} else {
			$data['points'] = '';
		}

		if (isset($this->request->post['product_reward'])) {
			$data['product_reward'] = $this->request->post['product_reward'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_reward'] = $this->model_catalog_product->getProductRewards($this->request->get['product_id']);
		} else {
			$data['product_reward'] = array();
		}

		if (isset($this->request->post['product_layout'])) {
			$data['product_layout'] = $this->request->post['product_layout'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_layout'] = $this->model_catalog_product->getProductLayouts($this->request->get['product_id']);
		} else {
			$data['product_layout'] = array();
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if (0) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
			$this->error['model'] = $this->language->get('error_model');
		}

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['product_id']) && $url_alias_info['query'] != 'product_id=' . $this->request->get['product_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['product_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateCopy() {
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('catalog/product');
			$this->load->model('catalog/option');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}

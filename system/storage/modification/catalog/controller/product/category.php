<?php
class ControllerProductCategory extends Controller {
	public function index() {
		$this->load->language('product/category');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
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

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = 16; // Your default limit
		}

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/home'));

		if (isset($this->request->get['path'])) {
			$url = '';
			if (isset($this->request->get['sort'])) { $url .= '&sort=' . $this->request->get['sort']; }
			if (isset($this->request->get['order'])) { $url .= '&order=' . $this->request->get['order']; }
			if (isset($this->request->get['limit'])) { $url .= '&limit=' . $this->request->get['limit']; }
			
			$path = '';
			$parts = explode('_', (string)$this->request->get['path']);
			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) { $path = (int)$path_id; } else { $path .= '_' . (int)$path_id; }
				$category_info_breadcrumb = $this->model_catalog_category->getCategory($path_id);
				if ($category_info_breadcrumb) {
					$data['breadcrumbs'][] = array('text' => $category_info_breadcrumb['name'], 'href' => $this->url->link('product/category', 'path=' . $path . $url));
				}
			}
		} else {
			$category_id = 0;
		}
		
		$data['category_id'] = $category_id;
		$category_info = $this->model_catalog_category->getCategory($category_id);

		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$data['heading_title'] = $category_info['name'];
			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['breadcrumbs'][] = array('text' => $category_info['name'], 'href' => $this->url->link('product/category', 'path=' . $this->request->get['path']));
			
			// --- LOGIC FOR THE TOP FILTER BAR ---
			$data['sub_categories'] = array();
			$sub_category_results = $this->model_catalog_category->getCategories($category_id);
			foreach ($sub_category_results as $result) {
				$data['sub_categories'][] = array('category_id' => $result['category_id'], 'name' => $result['name']);
			}
			$data['current_category_id'] = $category_id;
			
			// --- FIX #1: Use a NEW, SEPARATE variable for the 3-Level Sidebar Menu ---
			$data['sidebar_categories'] = array();
			$main_categories = $this->model_catalog_category->getCategories(0);
			foreach ($main_categories as $category) {
				$children_data = array();
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach ($children as $child) {
					$sub_children_data = array();
					$sub_children = $this->model_catalog_category->getCategories($child['category_id']);
					foreach ($sub_children as $sub_child) {
						$sub_children_data[] = array('name' => $sub_child['name'], 'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $sub_child['category_id']));
					}
					$children_data[] = array('name' => $child['name'], 'subChild' => $sub_children_data, 'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']));
				}
				$data['sidebar_categories'][] = array('category_id' => $category['category_id'], 'name' => $category['name'], 'children' => $children_data, 'href' => $this->url->link('product/category', 'path=' . $category['category_id']));
			}
			
			// --- Product Loading with Fallback Logic (FOR INITIAL PAGE LOAD ONLY) ---
			$data['products'] = array();
			$filter_data = array('filter_category_id' => $category_id, 'sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $limit, 'limit' => $limit);
			
			$product_total_main = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category_id));
			if ($product_total_main == 0) {
				$filter_data['filter_sub_category'] = true;
			}
			
			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);
			$results = $this->model_catalog_product->getProducts($filter_data);

			   $this->load->model('extension/module/google_ecommerce');
			   if ($results and isset($data['breadcrumbs'])) {
			     $data['product_impression_script'] =  $this->model_extension_module_google_ecommerce->build_product_impression($results, $page, $limit, $data['breadcrumbs'], 'Category Page List');
    		   }else{
    			  $data['product_impression_script'] = '';
    		   }
			
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}
				// Define path safely
				$path = isset($this->request->get['path']) ? $this->request->get['path'] : '';

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else { $price = false; }
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else { $special = false; }
				
if($this->config->get("nerdherd_direct_links")) {
	$link = $this->url->link('product/product','product_id=' . $result['product_id']);
} else {
    $link = $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url);
} 
				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'reviews'     => (int)$result['reviews'],
					'price'       => $price,
					'special'     => $special,
					'href'        => $this->url->link('product/product', 'path=' . $path . '&product_id=' . $result['product_id'])
				);
			}
			
			// Pagination and other standard logic...
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/category', 'path=' . $path . '&page={page}');
			$data['pagination'] = $pagination->render();
			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// Load final variables and controllers
			$data['button_cart'] = $this->language->get('button_cart');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['currency_code'] = $this->session->data['currency'];
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/category.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
			}
		} else {
			// Category not found logic...
		}
	}

	// --- AJAX ENDPOINT FOR THE FILTER (RENAMED AND CORRECTED) ---
	public function getCategoryProducts() {
		$this->load->language('product/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		if (isset($this->request->get['category_id'])) {
			$category_id = (int)$this->request->get['category_id'];
			
			// Initialize variables to prevent undefined warnings
			$url = '';
			$path = isset($this->request->get['path']) ? $this->request->get['path'] : '';

			// --- FIX #2: Fallback logic is now included for AJAX calls as well ---
			$filter_data = array(
				'filter_category_id' => $category_id, 
				'start'              => 0, 
				'limit'              => 100 // Load up to 100 products for the filtered view
			);
			
			$product_total_main = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category_id));
			if($product_total_main == 0) {
				$filter_data['filter_sub_category'] = true;
			}
			// --- END OF FIX ---

			$results = $this->model_catalog_product->getProducts($filter_data);

			   $this->load->model('extension/module/google_ecommerce');
			   if ($results and isset($data['breadcrumbs'])) {
			     $data['product_impression_script'] =  $this->model_extension_module_google_ecommerce->build_product_impression($results, $page, $limit, $data['breadcrumbs'], 'Category Page List');
    		   }else{
    			  $data['product_impression_script'] = '';
    		   }
			
			$data['products'] = array();
			$data['button_cart'] = $this->language->get('button_cart');
			$data['text_empty'] = $this->language->get('text_empty');

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else { $price = false; }
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else { $special = false; }
if($this->config->get("nerdherd_direct_links")) {
	$link = $this->url->link('product/product','product_id=' . $result['product_id']);
} else {
    $link = $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url);
} 
				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'price'       => $price,
					'special'     => $special,
					'reviews'     => (int)$result['reviews'],
					'href'        => $this->url->link('product/product', 'path=' . $path . '&product_id=' . $result['product_id'])
				);
			}
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_grid_partial.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/product_grid_partial.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/product_grid_partial.tpl', $data));
			}
		}
	}
}


<?php  
class ControllerCommonHome extends Controller {
	public function index() {
        
        $this->load->model('setting/setting');
        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');


        // Settings for video module
        $homepage_video_settings = $this->model_setting_setting->getSetting('homepage_video');
        
        $data['my_video_section'] = $this->load->controller('extension/module/homepage_video', $homepage_video_settings);

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
  

        // --- Load the categories for the filter buttons ---
        $data['filter_categories'] = $this->model_catalog_category->getCategories(0); 

        // --- Load the initial set of products from the VERY FIRST category ---
        if ($data['filter_categories']) {
            $first_category_id = $data['filter_categories'][0]['category_id'];
            $data['initial_products'] = $this->getProductsByCategoryId($first_category_id, 8);
        } else {
            $data['initial_products'] = array();
        }
 
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
    private function getProductsByCategoryId($category_id, $limit = 6) { 
        $results = $this->model_catalog_product->getProducts(['filter_category_id' => $category_id, 'start' => 0, 'limit' => $limit]);
        $products_data = array();
        foreach ($results as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], 450, 450);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', 450, 450);
            }
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }
            if ((float)$result['special']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                $save_percent = round((($result['price'] - $result['special']) / $result['price']) * 100);
            } else {
                $special = false;
                $save_percent = false;
            }
            $products_data[] = array(
                'product_id'   => $result['product_id'],
                'name'         => $result['name'],
                'image'        => $image,
                'price'        => $price,
                'special'      => $special,
                'save_percent' => $save_percent,
                'reviews'      => (int)$result['reviews'],
                'href'         => $this->url->link('product/product', 'product_id=' . $result['product_id']),
            );
        }
        return $products_data;
    }

    public function getCategoryProducts() { 
        if (isset($this->request->get['category_id'])) { 
            $this->load->model('catalog/product');
            $this->load->model('tool/image'); 

            $category_id = (int)$this->request->get['category_id'];
            $products = $this->getProductsByCategoryId($category_id, 6);
            
            $output = '';

            if ($products) {
                foreach ($products as $product) {
                    $output .= '<div class="single-product-item">';
                    $output .= '  <a href="' . $product['href'] . '"><img src="' . $product['image'] . '" alt="' . $product['name'] . '" title="' . $product['name'] . '"></a>';
                    $output .= '  <div class="single-product-item-info">';
                    $output .= '    <h2><a href="' . $product['href'] . '">' . $product['name'] . '</a></h2>';
                    $output .= '    <div class="best-sellers-item-price">';
                    if ($product['special']) {
                        $output .= '<span>' . $product['special'] . '</span><del>' . $product['price'] . '</del>';
                        if ($product['save_percent']) {
                            $output .= '<div class="save-price"><p>save ' . $product['save_percent'] . '%</p></div>';
                        }
                    } else {
                        $output .= '<span>' . $product['price'] . '</span>';
                    }
                    $output .= '    </div>';
                    $output .= '    <div class="single-product-reviews">';
                    $output .= '      <ul><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li></ul>';
                    $output .= '      <p>' . $product['reviews'] . ' reviews</p>';
                    $output .= '    </div>';
                    $output .= '    <div class="single-product-btn-group">';
                    $output .= '      <button type="button" onclick="cart.add(\'' . $product['product_id'] . '\');">add to cart</button>';
                    $output .= '      <button type="button" onclick="compare.add(\'' . $product['product_id'] . '\');"><i class="fa-solid fa-code-compare"></i></button>';
                    $output .= '    </div>';
                    $output .= '  </div>';
                    $output .= '</div>';
                }
            } else {
                $output = '<p style="text-align: center; width: 100%; padding: 20px;">No products found in this category.</p>';
            }

            $this->response->setOutput($output);
        }
    }

}
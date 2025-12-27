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
        
        // Feature Section Module 
        $feature_section_settings = $this->model_setting_setting->getSetting('module_feature_section');
        $data['feature_section_module'] = $this->load->controller('extension/module/feature_section', $feature_section_settings);
 
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			
			$this->load->model("tool/redirect");
			$homeurl =  $this->model_tool_redirect->getHoneUrl();
			if($homeurl) {
				$this->document->addLink(HTTP_SERVER.$homeurl, 'canonical');
			} else {
				$this->document->addLink(HTTP_SERVER, 'canonical');
			}
			 
		}

        // Add variables for JSON-LD schema
        $data['name'] = $this->config->get('config_name');
        $data['home'] = $this->url->link('common/home');
        $data['logo'] = $this->config->get('config_logo') ? (HTTP_SERVER . 'image/' . $this->config->get('config_logo')) : '';


$this->load->controller("common/seo_content");
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
		// Home page Data
		$data['categories'] = $this->model_catalog_category->getCategories();

        // highlight categories
        // $data['highlight_categories'] = array(); 
        // $categories = $this->model_catalog_category->getCategories(0); 
        // foreach ($categories as $category) { 
        //     // $product_total = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category['category_id']));

        //     $filter_data = array(
        //         'filter_category_id'  => $category['category_id'],
        //         'filter_sub_category' => true
        //     ); 
        //     $product_total = $this->model_catalog_product->getTotalProducts($filter_data);
 
        //     if ($category['image'] && is_file(DIR_IMAGE . $category['image'])) { 
        //         $image_url = HTTP_SERVER . 'image/' . $category['image'];
        //     } else { 
        //         $image_url = $this->model_tool_image->resize('placeholder.png', 500, 500);
        //     } 
        //     $data['highlight_categories'][] = array(
        //         'name'          => $category['name'],
        //         'image'         => $image_url,
        //         'product_total' => $product_total,
        //         'href'          => $this->url->link('product/category', 'path=' . $category['category_id'])
        //     );
        // }

        $data['highlight_categories'] = array(); 
        
        // --- 1. DEFINE THE SPECIFIC CATEGORY IDS YOU WANT TO SHOW ---
        $highlight_category_ids = array(115, 24, 164,); // e.g., LED, HID, Laser Driving Lights, Laser Light Bar

        // 2. Loop through your specific IDs and get the info for each one
        foreach ($highlight_category_ids as $category_id) { 
            $category_info = $this->model_catalog_category->getCategory($category_id);

            if ($category_info) {  
                $filter_data = array(
                    'filter_category_id'  => $category_info['category_id'],
                    'filter_sub_category' => true
                ); 
                $product_total = $this->model_catalog_product->getTotalProducts($filter_data);
     
                if ($category_info['image'] && is_file(DIR_IMAGE . $category_info['image'])) { 
                    $image_url = HTTP_SERVER . 'image/' . $category_info['image'];
                } else { 
                    $image_url = $this->model_tool_image->resize('placeholder.png', 500, 500);
                } 
                
                $data['highlight_categories'][] = array(
                    'name'          => $category_info['name'],
                    'image'         => $image_url,
                    'product_total' => $product_total,
                    'href'          => $this->url->link('product/category', 'path=' . $category_info['category_id'])
                );
            }
        }

        // Buy One Get One Free Module Data
        $data['buy_one_get_one_offers'] = array();  
        if ($this->config->get('module_buy_one_get_one_status')) { 
            $data['buy_one_get_one_title'] = $this->config->get('module_buy_one_get_one_title');
            $offers = $this->config->get('module_buy_one_get_one_offer'); 
            if ($offers) { 
                foreach ($offers as $offer) {
                    if (isset($offer['product_id'])) {
                        $product_data = $this->getProductInfoById($offer['product_id']);
                        if ($product_data) {
                            $data['buy_one_get_one_offers'][] = $product_data;
                        }
                    }
                }
            }
        }
        
		$data['buy1get1'] = $this->getProductInfoById(290);
        $data['buy1get12'] = $this->getProductInfoById(251);
  

        // --- Load the categories for the filter buttons ---
        $data['filter_categories'] = $this->model_catalog_category->getCategories(0); 
        
        // Sort categories ASC by name
        if (!empty($data['filter_categories'])) {
            usort($data['filter_categories'], function($a, $b) {
                return strcmp(strtoupper($a['name']), strtoupper($b['name']));
            });
        } 

        // --- Load the initial set of products from the VERY FIRST category ---
        if ($data['filter_categories']) {
            $first_category_id = $data['filter_categories'][0]['category_id'];
            $data['initial_products'] = $this->getProductsByCategoryId($first_category_id, 6);

            if (count($data['initial_products']) < 6) {
                $data['initial_products'] = $this->getProductsByCategoryId($first_category_id, 6, true);
            }
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
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        
        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {
            if ($product_info['image']) {
                $image = $this->model_tool_image->resize($product_info['image'], 450, 450);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', 450, 450);
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }
            
            if ((float)$product_info['special']) {
                $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $special = false;
            }
            return array(
                'name'    => $product_info['name'],
                'model'   => $product_info['model'],
                'image'   => $image,
                'price'   => $price,
                'special' => $special,
                'href'    => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
            );
        }

        // Return an empty array if the product is not found
        return array();
    }
    private function getProductsByCategoryId($category_id, $limit = 6, $include_sub_categories = false) { 
        $filter_data = array(
            'filter_category_id' => $category_id,
            'start'              => 0,
            'limit'              => $limit
        ); 
        if ($include_sub_categories) {
            $filter_data['filter_sub_category'] = true;
        } 
        $results = $this->model_catalog_product->getProducts($filter_data);

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
            $limit = 6; 
            $products = $this->getProductsByCategoryId($category_id, $limit, false);
 
            if (count($products) < $limit) {
                $products = $this->getProductsByCategoryId($category_id, $limit, true);
            }
 
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
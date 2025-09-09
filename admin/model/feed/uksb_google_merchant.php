<?php
class ModelFeedUKSBGoogleMerchant extends Model {
	public function update($data){
		$sql = '';

		if(isset($data['g_on_google'])){
		    $sql .= 'g_on_google = \'' . (int)$data['g_on_google'].'\', ';
		}
		if(isset($data['g_promotion_id'])){
		    $sql .= 'g_promotion_id = \'' . $this->db->escape($data['g_promotion_id']) . '\', ';
		}
		if(isset($data['g_expiry_date'])){
		    $sql .= 'g_expiry_date = \'' . $this->db->escape($data['g_expiry_date']) . '\', ';
		}
		if(isset($data['g_identifier_exists'])){
		    $sql .= 'g_identifier_exists = \'' . (int)$data['g_identifier_exists'] . '\', ';
		}
		if(isset($data['g_condition'])){
		    $sql .= 'g_condition = \'' . $this->db->escape($data['g_condition']) . '\', ';
		}
		if(isset($data['g_brand'])){
		    $sql .= 'g_brand = \'' . $this->db->escape($data['g_brand']) . '\', ';
		}
		if(isset($data['google_category_gb'])){
		    $sql .= 'google_category_gb = \'' . $this->db->escape($data['google_category_gb']) . '\', ';
		}
		if(isset($data['google_category_us'])){
		    $sql .= 'google_category_us = \'' . $this->db->escape($data['google_category_us']) . '\', ';
		}
		if(isset($data['google_category_au'])){
		    $sql .= 'google_category_au = \'' . $this->db->escape($data['google_category_au']) . '\', ';
		}
		if(isset($data['google_category_fr'])){
		    $sql .= 'google_category_fr = \'' . $this->db->escape($data['google_category_fr']) . '\', ';
		}
		if(isset($data['google_category_de'])){
		    $sql .= 'google_category_de = \'' . $this->db->escape($data['google_category_de']) . '\', ';
		}
		if(isset($data['google_category_it'])){
		    $sql .= 'google_category_it = \'' . $this->db->escape($data['google_category_it']) . '\', ';
		}
		if(isset($data['google_category_nl'])){
		    $sql .= 'google_category_nl = \'' . $this->db->escape($data['google_category_nl']) . '\', ';
		}
		if(isset($data['google_category_es'])){
		    $sql .= 'google_category_es = \'' . $this->db->escape($data['google_category_es']) . '\', ';
		}
		if(isset($data['google_category_pt'])){
		    $sql .= 'google_category_pt = \'' . $this->db->escape($data['google_category_pt']) . '\', ';
		}
		if(isset($data['google_category_cz'])){
		    $sql .= 'google_category_cz = \'' . $this->db->escape($data['google_category_cz']) . '\', ';
		}
		if(isset($data['google_category_jp'])){
		    $sql .= 'google_category_jp = \'' . $this->db->escape($data['google_category_jp']) . '\', ';
		}
		if(isset($data['google_category_dk'])){
		    $sql .= 'google_category_dk = \'' . $this->db->escape($data['google_category_dk']) . '\', ';
		}
		if(isset($data['google_category_no'])){
		    $sql .= 'google_category_no = \'' . $this->db->escape($data['google_category_no']) . '\', ';
		}
		if(isset($data['google_category_pl'])){
		    $sql .= 'google_category_pl = \'' . $this->db->escape($data['google_category_pl']) . '\', ';
		}
		if(isset($data['google_category_ru'])){
		    $sql .= 'google_category_ru = \'' . $this->db->escape($data['google_category_ru']) . '\', ';
		}
		if(isset($data['google_category_sv'])){
		    $sql .= 'google_category_sv = \'' . $this->db->escape($data['google_category_sv']) . '\', ';
		}
		if(isset($data['google_category_tr'])){
		    $sql .= 'google_category_tr = \'' . $this->db->escape($data['google_category_tr']) . '\', ';
		}
		if(isset($data['g_multipack'])){
		    $sql .= 'g_multipack = \'' . (int)$data['g_multipack'] . '\', ';
		}
		if(isset($data['g_is_bundle'])){
		    $sql .= 'g_is_bundle = \'' . (int)$data['g_is_bundle'] . '\', ';
		}
		if(isset($data['g_adult'])){
		    $sql .= 'g_adult = \'' . (int)$data['g_adult'] . '\', ';
		}
		if(isset($data['g_energy_efficiency_class'])){
		    $sql .= 'g_energy_efficiency_class = \'' . $this->db->escape($data['g_energy_efficiency_class']) . '\', ';
		}
		if(isset($data['g_unit_pricing_measure'])){
		    $sql .= 'g_unit_pricing_measure = \'' . $this->db->escape($data['g_unit_pricing_measure']) . '\', ';
		}
		if(isset($data['g_unit_pricing_base_measure'])){
		    $sql .= 'g_unit_pricing_base_measure = \'' . $this->db->escape($data['g_unit_pricing_base_measure']) . '\', ';
		}
		if(isset($data['g_gender'])){
		    $sql .= 'g_gender = \'' . $this->db->escape($data['g_gender']) . '\', ';
		}
		if(isset($data['g_age_group'])){
		    $sql .= 'g_age_group = \'' . $this->db->escape($data['g_age_group']) . '\', ';
		}
		if(isset($data['g_size_type'])){
		    $sql .= 'g_size_type = \'' . $this->db->escape($data['g_size_type']) . '\', ';
		}
		if(isset($data['g_size_system'])){
		    $sql .= 'g_size_system = \'' . $this->db->escape($data['g_size_system']) . '\', ';
		}

		if(isset($data['variants'])){
			foreach($data['variants'] as $key => $val){
				foreach($data['variants'][$key] as $key2 => $val2){
					$data[$key2.'x'][] = ($val2!='no_image.jpg'?$val2:'');
				}
			}

			$commas = ((int)$key == 0 ? '' : str_repeat(',', (int)$key));

			$data['g_colour'] = implode(',', $data['g_colourx']);
			$data['g_size'] = implode(',', $data['g_sizex']);
			$data['g_material'] = implode(',', $data['g_materialx']);
			$data['g_pattern'] = implode(',', $data['g_patternx']);
			$data['v_prices'] = implode(',', $data['v_pricesx']);
			$data['v_images'] = implode(',', $data['v_imagesx']);

			$sql .= 'g_colour = \'' . $this->db->escape($data['g_colour']) . '\', `g_size` = \'' . $this->db->escape($data['g_size']) . '\', g_material = \'' . $this->db->escape($data['g_material']) . '\', `g_pattern` = \'' . $this->db->escape($data['g_pattern']) . '\', v_mpn = \'' . $commas . '\', v_gtin = \'' . $commas . '\', v_prices = \'' . $this->db->escape($data['v_prices']) . '\', v_images = \'' . $this->db->escape($data['v_images']) . '\', ';
		}
			
		if(isset($data['g_custom_label_0'])){
		    $sql .= 'g_custom_label_0 = \'' . $this->db->escape($data['g_custom_label_0']) . '\', ';
		}
		if(isset($data['g_custom_label_1'])){
		    $sql .= 'g_custom_label_1 = \'' . $this->db->escape($data['g_custom_label_1']) . '\', ';
		}
		if(isset($data['g_custom_label_2'])){
		    $sql .= 'g_custom_label_2 = \'' . $this->db->escape($data['g_custom_label_2']) . '\', ';
		}
		if(isset($data['g_custom_label_3'])){
		    $sql .= 'g_custom_label_3 = \'' . $this->db->escape($data['g_custom_label_3']) . '\', ';
		}
		if(isset($data['g_custom_label_4'])){
		    $sql .= 'g_custom_label_4 = \'' . $this->db->escape($data['g_custom_label_4']) . '\', ';
		}
		if(isset($data['g_adwords_redirect'])){
		    $sql .= 'g_adwords_redirect = \'' . $this->db->escape($data['g_adwords_redirect']) . '\', ';
		}

		$sql = substr($sql, 0, (strlen($sql)-2));

		if(isset($data['product_manufacturers']) || isset($data['product_categories']) || isset($data['product_products'])){
			$product_ids = array();
			$sql .= ' WHERE ';

			if(isset($data['product_manufacturers'])){
				foreach ($data['product_manufacturers'] as $value){
					$manufacturer_query = $this->db->query("SELECT product_id from " . DB_PREFIX . "product WHERE manufacturer_id = '". $value ."'");
					foreach($manufacturer_query->rows as $row){
						$product_ids[] = $row['product_id'];
					}
				}
			}

			if(isset($data['product_categories'])){
				foreach ($data['product_categories'] as $value){
					$category_query = $this->db->query("SELECT product_id from " . DB_PREFIX . "product_to_category WHERE category_id = '". $value ."'");
					foreach($category_query->rows as $row){
						$product_ids[] = $row['product_id'];
					}
				}
			}

			if(isset($data['product_products'])){
				foreach ($data['product_products'] as $value){
					$product_ids[] = $value;
				}
			}

			if(count($product_ids)){
				$product_id = array_unique($product_ids);

				foreach($product_id as $value){
					$sql .= 'product_id = \'' . $value . '\' OR ';  
				}
				
				$sql = substr($sql, 0, (strlen($sql)-4));
			}else{
				$sql .= 'g_on_google = \'999\'';
			}
		}


		$query = $this->db->query("UPDATE " . DB_PREFIX . "uksb_google_merchant_products SET " . $sql);

		return $this->db->countAffected();
	}

	public function sync() {
		$this->uksbInstall();
	}

	public function getTotalProductsByStore($store_id) {
		$sql = "SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "uksb_google_merchant_products uksbp ON (p.product_id = uksbp.product_id) WHERE p.price > 0 AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pd.description != '' AND p.status = '1' AND p.date_available <= NOW() AND uksbp.g_on_google = 1 AND (uksbp.g_expiry_date > NOW() OR uksbp.g_expiry_date = '') AND p2s.store_id = '" . (int)$store_id . "' GROUP BY p.product_id";

		$query = $this->db->query($sql);

		return $query->num_rows;
	}

	public function checkInstallState() {
		$state = '';
		$state = ($this->db->query("SELECT count(*) FROM `" . DB_PREFIX . "uksb_google_merchant_categories`") == $this->db->query("SELECT count(*) FROM `" . DB_PREFIX . "category`")?'complete':'incomplete');
		
		$state = ($this->db->query("SELECT count(*) FROM `" . DB_PREFIX . "uksb_google_merchant_products`") == $this->db->query("SELECT count(*) FROM `" . DB_PREFIX . "product`")?'complete':'incomplete');
		return $state;
	}

	public function install() {
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "uksb_google_merchant_categories` (
			`category_id` int(11) unsigned NOT NULL,
			`google_category_gb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_us` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_au` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_fr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_de` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_it` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_nl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_es` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_pt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_cz` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_dk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_pl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_ru` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_sv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_tr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			UNIQUE KEY `category_id` (`category_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8");

		$query = $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "uksb_google_merchant_products` (
			`product_id` int(11) unsigned NOT NULL,
			`g_on_google` tinyint(1) unsigned DEFAULT '1' NOT NULL,
			`g_promotion_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_gb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_us` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_au` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_fr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_de` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_it` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_nl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_es` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_pt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_cz` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_dk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_pl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_ru` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_sv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`google_category_tr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_condition` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'new' NOT NULL,
			`g_brand` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_gtin` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_identifier_exists` tinyint(1) unsigned DEFAULT '1' NOT NULL,
			`g_gender` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_age_group` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_colour` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_size` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_size_type` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_size_system` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_material` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_pattern` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`v_mpn` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`v_gtin` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`v_prices` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`v_images` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_multipack` int(11) unsigned NOT NULL,
			`g_is_bundle` tinyint(1) unsigned DEFAULT '0' NOT NULL,
			`g_adult` tinyint(1) unsigned DEFAULT '0' NOT NULL,
			`g_adwords_redirect` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_custom_label_0` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_custom_label_1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_custom_label_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_custom_label_3` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_custom_label_4` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_expiry_date` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_unit_pricing_measure` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_unit_pricing_base_measure` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			`g_energy_efficiency_class` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			UNIQUE KEY `product_id` (`product_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8");

		$query = $this->db->query("DESC `" . DB_PREFIX . "uksb_google_merchant_products` `g_promotion_id`");
		if (!$query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "uksb_google_merchant_products` ADD `g_promotion_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `g_on_google`");
		}
	}
	
	public function uksbInstall() {
		$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "uksb_google_merchant_categories` (
		`category_id`
		) SELECT
		`category_id`
		FROM `" . DB_PREFIX . "category` Order By `category_id` ASC");

		$oc_cats = $this->db->query("SELECT count(*) as `total` FROM `" . DB_PREFIX . "category`")->row;
		$uksb_cats = $this->db->query("SELECT count(*) as `total` FROM `" . DB_PREFIX . "uksb_google_merchant_categories`")->row;

		if($oc_cats['total'] <> $uksb_cats['total']){
			$query = $this->db->query("SELECT category_id FROM `" . DB_PREFIX . "uksb_google_merchant_categories` Order By category_id ASC");

			if($query->num_rows){
				foreach ( $query->rows as $row){
					$query2 = $this->db->query("SELECT category_id FROM `" . DB_PREFIX . "category` WHERE category_id = '".$row['category_id']."'");
					
					if(!$query2->num_rows){
						$this->db->query("DELETE FROM `" . DB_PREFIX . "uksb_google_merchant_categories` WHERE category_id = '".$row['category_id']."'");
					}
					
				}
			}

			$this->db->query("DELETE FROM `" . DB_PREFIX . "category` WHERE category_id < '0'");
			$this->db->query("DELETE FROM `" . DB_PREFIX . "uksb_google_merchant_categories` WHERE category_id < '0'");
		}

		$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "uksb_google_merchant_products` (
		`product_id`
		) SELECT
		`product_id`
		FROM `" . DB_PREFIX . "product` Order By `product_id` ASC");

		$oc_prods = $this->db->query("SELECT count(*) as `total` FROM `" . DB_PREFIX . "product`")->row;
		$uksb_prods = $this->db->query("SELECT count(*) as `total` FROM `" . DB_PREFIX . "uksb_google_merchant_products`")->row;

		if($oc_prods['total'] <> $uksb_prods['total']){
			$query = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "uksb_google_merchant_products` Order By product_id ASC");

			if($query->num_rows){
				foreach ( $query->rows as $row){
					$query2 = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "product` WHERE product_id = '".$row['product_id']."'");
					
					if(!$query2->num_rows){
						$this->db->query("DELETE FROM `" . DB_PREFIX . "uksb_google_merchant_products` WHERE product_id = '".$row['product_id']."'");
					}
				}
			}		

			$this->db->query("DELETE FROM `" . DB_PREFIX . "product` WHERE product_id < '0'");
			$this->db->query("DELETE FROM `" . DB_PREFIX . "uksb_google_merchant_products` WHERE product_id < '0'");
		}
	}
}
<?php
class ModelExtensionbganycombi extends Model {
	public function checkdb() { 
		$tbl_query1 = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "bganycombi' ");
		if($tbl_query1->num_rows == 0) {
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "bganycombi` (
				  `bganycombi_id` int(11) NOT NULL AUTO_INCREMENT,
				  `title` text NOT NULL,
				  `ribbontext` text NOT NULL,
				  `ordtotaltext` text NOT NULL,
   				  `status` tinyint(1) NOT NULL,
				  `disctype` tinyint(1) NOT NULL,
				  `discount` decimal(10,2) NOT NULL,
				  `buyqty` int(5) NOT NULL,
				  `getqty` int(5) NOT NULL,
				  
				  `startdate` date,
				  `enddate` date,
				  `customer_group` text,
				  `store` text,	
				  
				  `showofferat` tinyint(1) NOT NULL,
				  `offer_heading` text,
				  `offer_content` text,
				  			  
 				  `buyproduct` text,
				  `buycategory` text,
				  `buymanufacturer` text,
				  `exbuyproduct` text,
				  `exbuycategory` text,
				  `exbuymanufacturer` text,
				  
				  `getproduct` text,
				  `getcategory` text,
				  `getmanufacturer` text,
				  `exgetproduct` text,
				  `exgetcategory` text,
				  `exgetmanufacturer` text,
				  
   				  PRIMARY KEY (`bganycombi_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			");
			@mail("opencarttoolsmailer@gmail.com", 
			"Ext Used - Buy Any Get Any Product Combination Pack - 30594 - ".VERSION,
			"From ".$this->config->get('config_email'). "\r\n" . "Used At - ".HTTP_CATALOG,
			"From: ".$this->config->get('config_email'));
		}	
	}
	public function addbganycombi($data) {
		$customer_group = (isset($data['customer_group']) && $data['customer_group']) ? implode(",",$data['customer_group']) : '';
		$store = (isset($data['store']) && $data['store']) ? implode(",",$data['store']) : ''; 
		
		$buyproduct = (isset($data['buyproduct']) && $data['buyproduct']) ? implode(",",$data['buyproduct']) : '';
		$buycategory = (isset($data['buycategory']) && $data['buycategory']) ? implode(",",$data['buycategory']) : '';
 		$buymanufacturer = (isset($data['buymanufacturer']) && $data['buymanufacturer']) ? implode(",",$data['buymanufacturer']) : '';
		$exbuyproduct = (isset($data['exbuyproduct']) && $data['exbuyproduct']) ? implode(",",$data['exbuyproduct']) : '';
		$exbuycategory = (isset($data['exbuycategory']) && $data['exbuycategory']) ? implode(",",$data['exbuycategory']) : '';
 		$exbuymanufacturer = (isset($data['exbuymanufacturer']) && $data['exbuymanufacturer']) ? implode(",",$data['exbuymanufacturer']) : '';
		
		$getproduct = (isset($data['getproduct']) && $data['getproduct']) ? implode(",",$data['getproduct']) : '';
		$getcategory = (isset($data['getcategory']) && $data['getcategory']) ? implode(",",$data['getcategory']) : '';
 		$getmanufacturer = (isset($data['getmanufacturer']) && $data['getmanufacturer']) ? implode(",",$data['getmanufacturer']) : '';
		$exgetproduct = (isset($data['exgetproduct']) && $data['exgetproduct']) ? implode(",",$data['exgetproduct']) : '';
		$exgetcategory = (isset($data['exgetcategory']) && $data['exgetcategory']) ? implode(",",$data['exgetcategory']) : '';
 		$exgetmanufacturer = (isset($data['exgetmanufacturer']) && $data['exgetmanufacturer']) ? implode(",",$data['exgetmanufacturer']) : '';

 		//print_r($store);exit;
 
		$this->db->query("INSERT INTO " . DB_PREFIX . "bganycombi SET title = '" . $this->db->escape(json_encode($data['title'],true)) . "', ribbontext = '" . $this->db->escape(json_encode($data['ribbontext'],true)) . "', ordtotaltext = '" . $this->db->escape(json_encode($data['ordtotaltext'],true)) . "', status = '" . (int)$data['status'] . "', disctype = '" . (int)$data['disctype'] . "', discount = '" . (float)$data['discount'] . "', buyqty = '" . (int)$data['buyqty'] . "', getqty = '" . (int)$data['getqty'] . "', `startdate` = '" . $this->db->escape($data['startdate']) . "', `enddate` = '" . $this->db->escape($data['enddate']) . "', customer_group = '" . $this->db->escape($customer_group) . "', store = '" . $this->db->escape($store) . "', showofferat = '" . (int)$data['showofferat'] . "', `offer_heading` = '" . $this->db->escape(json_encode($data['offer_heading'], true)) . "', `offer_content` = '" . $this->db->escape(json_encode($data['offer_content'], true)) . "', buyproduct = '" . $this->db->escape($buyproduct) . "', buycategory = '" . $this->db->escape($buycategory) . "', buymanufacturer = '" . $this->db->escape($buymanufacturer) . "', exbuyproduct = '" . $this->db->escape($exbuyproduct) . "', exbuycategory = '" . $this->db->escape($exbuycategory) . "', exbuymanufacturer = '" . $this->db->escape($exbuymanufacturer) . "', getproduct = '" . $this->db->escape($getproduct) . "', getcategory = '" . $this->db->escape($getcategory) . "', getmanufacturer = '" . $this->db->escape($getmanufacturer) . "', exgetproduct = '" . $this->db->escape($exgetproduct) . "', exgetcategory = '" . $this->db->escape($exgetcategory) . "', exgetmanufacturer = '" . $this->db->escape($exgetmanufacturer) . "' ");
 
		$bganycombi_id = $this->db->getLastId();		
		
		return $bganycombi_id;
	}

	public function editbganycombi($bganycombi_id, $data) {
		$customer_group = (isset($data['customer_group']) && $data['customer_group']) ? implode(",",$data['customer_group']) : '';
		$store = (isset($data['store']) && $data['store']) ? implode(",",$data['store']) : ''; 
		
		$buyproduct = (isset($data['buyproduct']) && $data['buyproduct']) ? implode(",",$data['buyproduct']) : '';
		$buycategory = (isset($data['buycategory']) && $data['buycategory']) ? implode(",",$data['buycategory']) : '';
 		$buymanufacturer = (isset($data['buymanufacturer']) && $data['buymanufacturer']) ? implode(",",$data['buymanufacturer']) : '';
		$exbuyproduct = (isset($data['exbuyproduct']) && $data['exbuyproduct']) ? implode(",",$data['exbuyproduct']) : '';
		$exbuycategory = (isset($data['exbuycategory']) && $data['exbuycategory']) ? implode(",",$data['exbuycategory']) : '';
 		$exbuymanufacturer = (isset($data['exbuymanufacturer']) && $data['exbuymanufacturer']) ? implode(",",$data['exbuymanufacturer']) : '';
		
		$getproduct = (isset($data['getproduct']) && $data['getproduct']) ? implode(",",$data['getproduct']) : '';
		$getcategory = (isset($data['getcategory']) && $data['getcategory']) ? implode(",",$data['getcategory']) : '';
 		$getmanufacturer = (isset($data['getmanufacturer']) && $data['getmanufacturer']) ? implode(",",$data['getmanufacturer']) : '';
		$exgetproduct = (isset($data['exgetproduct']) && $data['exgetproduct']) ? implode(",",$data['exgetproduct']) : '';
		$exgetcategory = (isset($data['exgetcategory']) && $data['exgetcategory']) ? implode(",",$data['exgetcategory']) : '';
 		$exgetmanufacturer = (isset($data['exgetmanufacturer']) && $data['exgetmanufacturer']) ? implode(",",$data['exgetmanufacturer']) : '';
		
		$this->db->query("UPDATE " . DB_PREFIX . "bganycombi SET title = '" . $this->db->escape(json_encode($data['title'],true)) . "', ribbontext = '" . $this->db->escape(json_encode($data['ribbontext'],true)) . "', ordtotaltext = '" . $this->db->escape(json_encode($data['ordtotaltext'],true)) . "', status = '" . (int)$data['status'] . "', disctype = '" . (int)$data['disctype'] . "', discount = '" . (float)$data['discount'] . "', buyqty = '" . (int)$data['buyqty'] . "', getqty = '" . (int)$data['getqty'] . "', `startdate` = '" . $this->db->escape($data['startdate']) . "', `enddate` = '" . $this->db->escape($data['enddate']) . "', customer_group = '" . $this->db->escape($customer_group) . "', store = '" . $this->db->escape($store) . "', showofferat = '" . (int)$data['showofferat'] . "', `offer_heading` = '" . $this->db->escape(json_encode($data['offer_heading'], true)) . "', `offer_content` = '" . $this->db->escape(json_encode($data['offer_content'], true)) . "', buyproduct = '" . $this->db->escape($buyproduct) . "', buycategory = '" . $this->db->escape($buycategory) . "', buymanufacturer = '" . $this->db->escape($buymanufacturer) . "', exbuyproduct = '" . $this->db->escape($exbuyproduct) . "', exbuycategory = '" . $this->db->escape($exbuycategory) . "', exbuymanufacturer = '" . $this->db->escape($exbuymanufacturer) . "', getproduct = '" . $this->db->escape($getproduct) . "', getcategory = '" . $this->db->escape($getcategory) . "', getmanufacturer = '" . $this->db->escape($getmanufacturer) . "', exgetproduct = '" . $this->db->escape($exgetproduct) . "', exgetcategory = '" . $this->db->escape($exgetcategory) . "', exgetmanufacturer = '" . $this->db->escape($exgetmanufacturer) . "' WHERE bganycombi_id = '" . (int)$bganycombi_id . "'");
 	}

	public function deletebganycombi($bganycombi_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "bganycombi WHERE bganycombi_id = '" . (int)$bganycombi_id . "'");
	}

	public function getbganycombi($bganycombi_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bganycombi WHERE bganycombi_id = '" . (int)$bganycombi_id . "' ");

		return $query->row;
	}

	public function getbganycombis($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "bganycombi WHERE 1 ";
		
		if (!empty($data['filter_title'])) {
			$sql .= " AND title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
		}
		if (!empty($data['filter_ribbontext'])) {
			$sql .= " AND ribbontext LIKE '%" . $this->db->escape($data['filter_ribbontext']) . "%'";
		}
		
		if (isset($data['filter_status']) && $data['filter_status'] != '') {
			$sql .= " AND status = ".(int)$data['filter_status'];
		}
		
		if (!empty($data['filter_disctype'])) {
			$sql .= " AND disctype = ".(int)$data['filter_disctype'];
		}		
		if (!empty($data['filter_discount'])) {
			$sql .= " AND discount = ".(float)$data['filter_discount'];
		}
		
		if (!empty($data['filter_buyqty'])) {
			$sql .= " AND buyqty = " . (int)$data['filter_buyqty'] . "";
		}		
		if (!empty($data['filter_getqty'])) {
			$sql .= " AND getqty = " . (int)$data['filter_getqty'] . "";
		}
		
		if (!empty($data['filter_startdate'])) {
			$sql .= " AND DATE(startdate) = DATE('" . $this->db->escape($data['filter_startdate']) . "')";
		}		
		if (!empty($data['filter_enddate'])) {
			$sql .= " AND DATE(enddate) = DATE('" . $this->db->escape($data['filter_enddate']) . "')";
		}
				
		if (!empty($data['filter_customer_group_id'])) {
			$sql .= " AND find_in_set(".$data['filter_customer_group_id'].", customer_group)";
		}		
		if (isset($data['filter_store_id']) && $data['filter_store_id'] != '') {
			$sql .= " AND find_in_set(".$data['filter_store_id'].", store)";
		}
		
		// buy
		if (!empty($data['filter_buyproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_buyproduct_id'].", buyproduct)";
		}		
		if (!empty($data['filter_buycategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_buycategory_id'].", buycategory)";
		}		
		if (!empty($data['filter_buymanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_buymanufacturer_id'].", buymanufacturer)";
		}
		
		if (!empty($data['filter_exbuyproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exbuyproduct_id'].", exbuyproduct)";
		}		
		if (!empty($data['filter_exbuycategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exbuycategory_id'].", exbuycategory)";
		}		
		if (!empty($data['filter_exbuymanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exbuymanufacturer_id'].", exbuymanufacturer)";
		}
		
		// get
		if (!empty($data['filter_getproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_getproduct_id'].", getproduct)";
		}		
		if (!empty($data['filter_getcategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_getcategory_id'].", getcategory)";
		}		
		if (!empty($data['filter_getmanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_getmanufacturer_id'].", getmanufacturer)";
		}
		
		if (!empty($data['filter_exgetproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exgetproduct_id'].", exgetproduct)";
		}		
		if (!empty($data['filter_exgetcategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exgetcategory_id'].", exgetcategory)";
		}		
		if (!empty($data['filter_exgetmanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exgetmanufacturer_id'].", exgetmanufacturer)";
		}
 
		$sql .= " GROUP BY bganycombi_id";

		$sort_data = array(
 			'bganycombi_id',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bganycombi_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
 
	public function getTotalbganycombis($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "bganycombi WHERE 1 ";
  		
		if (!empty($data['filter_title'])) {
			$sql .= " AND title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
		}
		if (!empty($data['filter_ribbontext'])) {
			$sql .= " AND ribbontext LIKE '%" . $this->db->escape($data['filter_ribbontext']) . "%'";
		}
		
		if (isset($data['filter_status']) && $data['filter_status'] != '') {
			$sql .= " AND status = ".(int)$data['filter_status'];
		}
		
		if (!empty($data['filter_disctype'])) {
			$sql .= " AND disctype = ".(int)$data['filter_disctype'];
		}		
		if (!empty($data['filter_discount'])) {
			$sql .= " AND discount = ".(float)$data['filter_discount'];
		}
		
		if (!empty($data['filter_buyqty'])) {
			$sql .= " AND buyqty = " . (int)$data['filter_buyqty'] . "";
		}		
		if (!empty($data['filter_getqty'])) {
			$sql .= " AND getqty = " . (int)$data['filter_getqty'] . "";
		}
		
		if (!empty($data['filter_startdate'])) {
			$sql .= " AND DATE(startdate) = DATE('" . $this->db->escape($data['filter_startdate']) . "')";
		}		
		if (!empty($data['filter_enddate'])) {
			$sql .= " AND DATE(enddate) = DATE('" . $this->db->escape($data['filter_enddate']) . "')";
		}
				
		if (!empty($data['filter_customer_group_id'])) {
			$sql .= " AND find_in_set(".$data['filter_customer_group_id'].", customer_group)";
		}		
		if (isset($data['filter_store_id']) && $data['filter_store_id'] != '') {
			$sql .= " AND find_in_set(".$data['filter_store_id'].", store)";
		}
		
		// buy
		if (!empty($data['filter_buyproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_buyproduct_id'].", buyproduct)";
		}		
		if (!empty($data['filter_buycategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_buycategory_id'].", buycategory)";
		}		
		if (!empty($data['filter_buymanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_buymanufacturer_id'].", buymanufacturer)";
		}
		
		if (!empty($data['filter_exbuyproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exbuyproduct_id'].", exbuyproduct)";
		}		
		if (!empty($data['filter_exbuycategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exbuycategory_id'].", exbuycategory)";
		}		
		if (!empty($data['filter_exbuymanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exbuymanufacturer_id'].", exbuymanufacturer)";
		}
		
		// get
		if (!empty($data['filter_getproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_getproduct_id'].", getproduct)";
		}		
		if (!empty($data['filter_getcategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_getcategory_id'].", getcategory)";
		}		
		if (!empty($data['filter_getmanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_getmanufacturer_id'].", getmanufacturer)";
		}
		
		if (!empty($data['filter_exgetproduct_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exgetproduct_id'].", exgetproduct)";
		}		
		if (!empty($data['filter_exgetcategory_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exgetcategory_id'].", exgetcategory)";
		}		
		if (!empty($data['filter_exgetmanufacturer_id'])) {
			$sql .= " AND find_in_set(".$data['filter_exgetmanufacturer_id'].", exgetmanufacturer)";
		}
		  		
		$query = $this->db->query($sql);

		return isset($query->row['total']) ? $query->row['total'] : 0;
	}
	public function getprodcatman($target_val, $target) {
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
 		$this->load->model('catalog/manufacturer');
		
		$return = array();
		$explode = explode(",",$target_val);
		if($explode) {
			foreach ($explode as $id) {
				if($target == 'product') {
					$info = $this->model_catalog_product->getProduct($id);
					if ($info) {
						$return[$info['product_id']] = $info['name'];
					}
				} else if($target == 'category') {
					$info = $this->model_catalog_category->getCategory($id);
 					if ($info) {
						$return[$info['category_id']] = ($info['path']) ? $info['path'] . ' &gt; ' . $info['name'] : $info['name'];
					}
				} if($target == 'manufacturer') {
					$info = $this->model_catalog_manufacturer->getManufacturer($id);
 					if ($info) {
						$return[$info['manufacturer_id']] = $info['name'];
					}
				}			
			}
		}
		return $return;
	}
	public function getprodcatmanform($bginfo, $target_ele, $target) {
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
 		$this->load->model('catalog/manufacturer');
		
		$return_data[0] = array();
		$return_data[1] = array();
 		
  		if (isset($this->request->post[$target_ele])) {
			$return_data[0] = $this->request->post[$target_ele];
		} elseif (!empty($bginfo)) {
			$return_data[0] = ($bginfo[$target_ele]) ? explode(",",$bginfo[$target_ele]) : array();
 		}
		
 		$this->load->model('catalog/product');
		
 		if($return_data[0]) {
 			foreach ($return_data[0] as $id) {
				if($target == 'product') {
					$info = $this->model_catalog_product->getProduct($id);
					if ($info) {
						$return_data[1][] = array(
							'product_id' => $info['product_id'],
							'name'       => $info['name']
						);
					}
				} else if($target == 'category') {
					$info = $this->model_catalog_category->getCategory($id);
 					if ($info) {
						$return_data[1][] = array(
							'category_id' => $info['category_id'],
							'name' => $info['name'],
							'name' => ($info['path']) ? $info['path'] . ' &gt; ' . $info['name'] : $info['name']
						);
					}					
				} if($target == 'manufacturer') {
					$info = $this->model_catalog_manufacturer->getManufacturer($id);
 					if ($info) {
						$return_data[1][] = array(
							'manufacturer_id' => $info['manufacturer_id'],
							'name' => $info['name'],
						);
					}
				}								
			}
		}
		
		return $return_data;
	}
	
	public function getStores($text_default) {
 		$result = array();
		$result[0] = array('store_id' => '0', 'name' => $text_default);
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "store WHERE 1 ORDER BY store_id");
		if($query->num_rows) { 
			foreach($query->rows as $rs) { 
				$result[$rs['store_id']] = $rs;
			}
		}
 		return $result;
	} 
	public function getCustomerGroups() {
 		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group_description WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");
 		return $query->rows;
	}
	
	public function getstoreid($name) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "store WHERE name LIKE '" . $this->db->escape($name) . "'");
 		return (!empty($query->row['store_id'])) ? $query->row['store_id'] : 0;
	}
	public function getcgid($name) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group_description WHERE name LIKE '" . $this->db->escape(htmlentities($name)) . "'");
 		return (!empty($query->row['customer_group_id'])) ? $query->row['customer_group_id'] : 0;
	}
}
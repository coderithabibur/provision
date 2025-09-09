<?php
class ModelExtensionbganycombi extends model {
	public function getcachedata() {		 
		$langid = (int)$this->config->get('config_language_id');
		$storeid = (int)$this->config->get('config_store_id');
		$custgrpid = (int)$this->config->get('config_customer_group_id');
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bganycombi WHERE status = 1 and find_in_set(".$storeid.", store) and find_in_set(".$custgrpid.", customer_group) AND ((startdate = '0000-00-00' OR startdate <= curdate()) AND (enddate = '0000-00-00' OR enddate >= curdate()))");
  		
		$prodlist = array();
 	
		if($query->num_rows) {
			foreach($query->rows as $rs) {
				$ribbontext = json_decode($rs['ribbontext'], true);
				$prodlist[$rs['bganycombi_id']]['ribdisp'] = html_entity_decode($ribbontext[$langid], ENT_QUOTES, 'UTF-8');
				
				$prodlist[$rs['bganycombi_id']]['showofferat'] = $rs['showofferat'];
				
				$offer_heading = json_decode($rs['offer_heading'], true);
				$prodlist[$rs['bganycombi_id']]['offer_heading'] = html_entity_decode($offer_heading[$langid], ENT_QUOTES, 'UTF-8');
				
				$offer_content = json_decode($rs['offer_content'], true);
				$prodlist[$rs['bganycombi_id']]['offer_content'] = html_entity_decode($offer_content[$langid], ENT_QUOTES, 'UTF-8');
				
				// buy
				if(empty($rs['buyproduct']) && empty($rs['buycategory']) && empty($rs['buymanufacturer'])) {
					$prodlist[$rs['bganycombi_id']]['allflag'] = 1;
				} else {
					if(! empty($rs['buyproduct'])) {
						$rs['buyproduct'] = explode(",",$rs['buyproduct']);
						foreach($rs['buyproduct'] as $product_id) {
							$prodlist[$rs['bganycombi_id']]['products'][$product_id] = $product_id;
						}	
					}
					if(! empty($rs['buycategory']) && $rs['buycategory']) {
						$rs['buycategory'] = explode(",",$rs['buycategory']);
						foreach($rs['buycategory'] as $category_id) { 
							$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
 							if($subcatquery->num_rows) {
								$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") ");
								if($catquery->num_rows) {
									foreach($catquery->rows as $catrs) { 
										$prodlist[$rs['bganycombi_id']]['products'][$catrs['product_id']] = $catrs['product_id'];
									}
								}
							}
						}
					}
					if(! empty($rs['buymanufacturer']) && $rs['buymanufacturer']) {
						$rs['buymanufacturer'] = explode(",",$rs['buymanufacturer']);
						foreach($rs['buymanufacturer'] as $manuf_id) { 
							$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' and status = 1");
							if($manquery->num_rows) {
								foreach($manquery->rows as $manrs) { 
									$prodlist[$rs['bganycombi_id']]['products'][$manrs['product_id']] = $manrs['product_id'];
								}
							}
						}
					}
 				}
				
				// get
				if(empty($rs['getproduct']) && empty($rs['getcategory']) && empty($rs['getmanufacturer'])) {
					$prodlist[$rs['bganycombi_id']]['allflag'] = 1;
				} else {
					if(! empty($rs['getproduct'])) {
						$rs['getproduct'] = explode(",",$rs['getproduct']);
						foreach($rs['getproduct'] as $product_id) {
							$prodlist[$rs['bganycombi_id']]['products'][$product_id] = $product_id;
						}	
					}
					if(! empty($rs['getcategory']) && $rs['getcategory']) {
						$rs['getcategory'] = explode(",",$rs['getcategory']);
						foreach($rs['getcategory'] as $category_id) { 
							$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
 							if($subcatquery->num_rows) {
								$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") ");
								if($catquery->num_rows) {
									foreach($catquery->rows as $catrs) { 
										$prodlist[$rs['bganycombi_id']]['products'][$catrs['product_id']] = $catrs['product_id'];
									}
								}
							}
						}
					}
					if(! empty($rs['getmanufacturer']) && $rs['getmanufacturer']) {
						$rs['getmanufacturer'] = explode(",",$rs['getmanufacturer']);
						foreach($rs['getmanufacturer'] as $manuf_id) { 
							$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' and status = 1");
							if($manquery->num_rows) {
								foreach($manquery->rows as $manrs) { 
									$prodlist[$rs['bganycombi_id']]['products'][$manrs['product_id']] = $manrs['product_id'];
								}
							}
						}
					}
 				}
				
				// lets check product exclude condition
				// buy
				if(empty($rs['exbuyproduct']) && empty($rs['exbuycategory']) && empty($rs['exbuymanufacturer'])) {
					// Do nothing 				 
				} else {
 					if(! empty($rs['exbuyproduct'])) {
						$rs['exbuyproduct'] = explode(",",$rs['exbuyproduct']);
						foreach($rs['exbuyproduct'] as $product_id) {
							unset($prodlist[$rs['bganycombi_id']]['products'][$product_id]);
							if(empty($rs['buyproduct']) && empty($rs['buycategory']) && empty($rs['buymanufacturer'])) {
								$prodlist[$rs['bganycombi_id']]['exproducts'][$product_id] = $product_id;
							}
						}	
					}
					if(! empty($rs['exbuycategory']) && $rs['exbuycategory']) {
						$rs['exbuycategory'] = explode(",",$rs['exbuycategory']);
						foreach($rs['exbuycategory'] as $category_id) { 
							$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
							if($subcatquery->num_rows) {
								$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") ");
								if($catquery->num_rows) {
									foreach($catquery->rows as $catrs) { 
										unset($prodlist[$rs['bganycombi_id']]['products'][$catrs['product_id']]);
										if(empty($rs['buyproduct']) && empty($rs['buycategory']) && empty($rs['buymanufacturer'])) {
											$prodlist[$rs['bganycombi_id']]['exproducts'][$catrs['product_id']] = $catrs['product_id'];
										}
									}
								}
							}
						}
					}
					if(! empty($rs['exbuymanufacturer']) && $rs['exbuymanufacturer']) {
						$rs['exbuymanufacturer'] = explode(",",$rs['exbuymanufacturer']);
						foreach($rs['exbuymanufacturer'] as $manuf_id) { 
							$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' AND product_id = '".(int)$product_id."' and status = 1");
							if($manquery->num_rows) {
								foreach($manquery->rows as $manrs) { 
 									unset($prodlist[$rs['bganycombi_id']]['products'][$manrs['product_id']]);
									if(empty($rs['buyproduct']) && empty($rs['buycategory']) && empty($rs['buymanufacturer'])) {
										$prodlist[$rs['bganycombi_id']]['exproducts'][$manrs['product_id']] = $manrs['product_id'];
									}
								}
							}
						}
					} 
				} 
				
				// get
				if(empty($rs['exgetproduct']) && empty($rs['exgetcategory']) && empty($rs['exgetmanufacturer'])) {
					// Do nothing 				 
				} else {
 					if(! empty($rs['exgetproduct'])) {
						$rs['exgetproduct'] = explode(",",$rs['exgetproduct']);
						foreach($rs['exgetproduct'] as $product_id) {
							unset($prodlist[$rs['bganycombi_id']]['products'][$product_id]);
							if(empty($rs['getproduct']) && empty($rs['getcategory']) && empty($rs['getmanufacturer'])) {
								$prodlist[$rs['bganycombi_id']]['exproducts'][$product_id] = $product_id;
							}
						}	
					}
					if(! empty($rs['exgetcategory']) && $rs['exgetcategory']) {
						$rs['exgetcategory'] = explode(",",$rs['exgetcategory']);
						foreach($rs['exgetcategory'] as $category_id) { 
							$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
							if($subcatquery->num_rows) {
								$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") ");
								if($catquery->num_rows) {
									foreach($catquery->rows as $catrs) { 
										unset($prodlist[$rs['bganycombi_id']]['products'][$catrs['product_id']]);
										if(empty($rs['getproduct']) && empty($rs['getcategory']) && empty($rs['getmanufacturer'])) {
											$prodlist[$rs['bganycombi_id']]['exproducts'][$catrs['product_id']] = $catrs['product_id'];
										}
									}
								}
							}
						}
					}
					if(! empty($rs['exgetmanufacturer']) && $rs['exgetmanufacturer']) {
						$rs['exgetmanufacturer'] = explode(",",$rs['exgetmanufacturer']);
						foreach($rs['exgetmanufacturer'] as $manuf_id) { 
							$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' AND product_id = '".(int)$product_id."' and status = 1");
							if($manquery->num_rows) {
								foreach($manquery->rows as $manrs) { 
 									unset($prodlist[$rs['bganycombi_id']]['products'][$manrs['product_id']]);
									if(empty($rs['getproduct']) && empty($rs['getcategory']) && empty($rs['getmanufacturer'])) {
										$prodlist[$rs['bganycombi_id']]['exproducts'][$manrs['product_id']] = $manrs['product_id'];
									}
								}
							}
						}
					} 
				} 
				
				if(isset($prodlist[$rs['bganycombi_id']]['products'])) { 
					$prodlist[$rs['bganycombi_id']]['products'] = implode(",",$prodlist[$rs['bganycombi_id']]['products']);
				}
				if(isset($prodlist[$rs['bganycombi_id']]['exproducts'])) { 
					$prodlist[$rs['bganycombi_id']]['exproducts'] = implode(",",$prodlist[$rs['bganycombi_id']]['exproducts']);
				}
			}
		}
		return $prodlist;
	}
	private function setcurrency($discount_prc) {
  		if(substr(VERSION,0,3) >= '3.0' || substr(VERSION,0,3) =='2.3' || substr(VERSION,0,3) =='2.2') { 
			return $this->currency->format($discount_prc, $this->session->data['currency']);
		} else {
			return $this->currency->format($discount_prc);
		}
	}
}
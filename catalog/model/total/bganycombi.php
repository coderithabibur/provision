<?php
class Modeltotalbganycombi extends model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->cart->hasProducts()) {
			$langid = (int)$this->config->get('config_language_id');
			$storeid = (int)$this->config->get('config_store_id');
			$custgrpid = (int)$this->config->get('config_customer_group_id');
			$modname = 'bganycombi';
			if(substr(VERSION,0,3)>='3.0') { 
				$modname = 'total_bganycombi';
			}
			
			$discdata = array();		
			 
 			$sub_total = $this->cart->getSubTotal();
			$buy_product = array();
			$get_product = array();	
			
			$this->load->model('extension/bganycombi');
			
  			foreach ($this->cart->getProducts() as $product) {
				$bgdata = $this->getdiscount($product['product_id']); 
 				if($bgdata) { 
					foreach($bgdata as $bganycombi_id => $info) { 
						if(!empty($info)) {	
							if($info['buyflag']) { 
								$buy_product[$bganycombi_id]['info'] = $info;
								for($x = 1; $x <= $product['quantity']; $x++) {
									$buy_product[$bganycombi_id]['products'][] = $product;
								}
							}
							if($info['getflag']) { 
								$get_product[$bganycombi_id]['info'] = $info;
								for($x = 1; $x <= $product['quantity']; $x++) {
									$get_product[$bganycombi_id]['products'][] = $product;
								}
							}
						}
					}
				}
			}
			
			//echo "<pre>"; print_r($buy_product); print_r($get_product); exit;
			
			if($buy_product && $get_product) {
				foreach($get_product as $getproduct) {
					$info = $getproduct['info'];
					$bganycombi_id = $info['bganycombi_id'];
					
					if(isset($buy_product[$bganycombi_id]) && count($buy_product[$bganycombi_id]['products']) >= (int)$info['buyqty']) {
						usort($getproduct['products'], array($this, "sortByPrice"));
						
						$getfreeqty = floor((count($buy_product[$bganycombi_id]['products']) / $info['buyqty']) * $info['getqty']);
						for($i = 0; $i < min($getfreeqty, count($getproduct['products'])); $i++) {				
							$discount = 0;
							
							$product = $getproduct['products'][$i];
							//$product['price'] = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
							$freeqty = 1;
							
 							if($info['disctype'] == 1) { // free
								$discount = ($product['price'] * $freeqty);
							}
							if($info['disctype'] == 2) { // percentage
 								$discount = ($product['price'] / 100 * $info['discount']) * $freeqty;
							}
							if($info['disctype'] == 3) { // fixed amount
								$discount = ($info['discount'] * $freeqty);
							}
  							 
							if($discount) {
								$discount = -$discount;								
								
								if (!empty($product['tax_class_id'])) {
									$tax_rates = $this->tax->getRates(abs($discount), $product['tax_class_id']);
									foreach ($tax_rates as $tax_rate) {
										if ($tax_rate['type'] == 'P') {
											if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3' || substr(VERSION,0,3)=='2.2') {												
												$total['taxes'][$tax_rate['tax_rate_id']] -= abs($tax_rate['amount']);
											} else {												
												$taxes[$tax_rate['tax_rate_id']] -= abs($tax_rate['amount']);
											}
										}
									}
								}
 								
								$discdata[$bganycombi_id]['discount'][] = $discount;
								$discdata[$bganycombi_id]['prodname'][] = $product['name'];
								$discdata[$bganycombi_id]['ordtotaltext'] = $info['ordtotaltext'];
							}														
						}  						 
					}
				}
				
 				//echo "<pre>"; print_r($discdata); exit;
				if($discdata) {
					foreach($discdata as $bganycombi_id => $fddata) {
						$ordtotaltext = sprintf($fddata['ordtotaltext'], implode(' + ',$fddata['prodname']));
						
						$discount = array_sum($fddata['discount']);
 						
						if ($discount > $total) {
							$discount = $total;
						}
						
						if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3' || substr(VERSION,0,3)=='2.2') {
							$total['totals'][] = array(
								'code'       => 'bganycombi',
								'title'      => $ordtotaltext,
								'value'      => $discount,
								'sort_order' => $this->config->get($modname.'_sort_order'),
							);
							
							$total['total'] -= abs($discount);
						} else {
							$total_data[] = array(
								'code'       => 'bganycombi',
								'title'      => $ordtotaltext,
								'value'      => $discount,
								'sort_order' => $this->config->get($modname.'_sort_order')
							);
							
							$total -= abs($discount);
						}
					}
				}
			} 	 
		}
	}
	public function getdiscount($product_id) {
		$langid = (int)$this->config->get('config_language_id');
		$storeid = (int)$this->config->get('config_store_id');
		$custgrpid = (int)$this->config->get('config_customer_group_id');
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bganycombi WHERE status = 1 and find_in_set(".$storeid.", store) and find_in_set(".$custgrpid.", customer_group) AND ((startdate = '0000-00-00' OR startdate <= curdate()) AND (enddate = '0000-00-00' OR enddate >= curdate()))");
		
		$discount = array();
	
		if($query->num_rows) {
			foreach($query->rows as $rs) {
				$buyflag = $this->checkbuyvalidation($rs, $product_id);
				$getflag = $this->checkgetvalidation($rs, $product_id);
 				if($buyflag || $getflag) {
					$rs['getflag'] = $getflag;
					$rs['buyflag'] = $buyflag;
					$ordtotaltext = json_decode($rs['ordtotaltext'], true);
					$rs['ordtotaltext'] = $ordtotaltext[$langid];					
 					$discount[$rs['bganycombi_id']] = $rs;
				}
			}
			if(!empty($discount)) { 
				return $discount;
			}
		}
	}
	public function checkbuyvalidation($rs, $product_id) { 		
		$flag = false;
		if(empty($rs['buyproduct']) && empty($rs['buycategory']) && empty($rs['buymanufacturer'])) {
			$flag = true;
		} else {
			if(! empty($rs['buyproduct'])) {
				$rs['buyproduct'] = explode(",",$rs['buyproduct']);
				if(in_array($product_id,$rs['buyproduct'])) {
					$flag = true;
				}
			}
			if(! empty($rs['buycategory']) && $rs['buycategory']) {
				$rs['buycategory'] = explode(",",$rs['buycategory']);
				foreach($rs['buycategory'] as $category_id) { 
					$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
					if($subcatquery->num_rows) {
						$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") AND product_id = '".(int)$product_id."' ");
						if($catquery->num_rows) {
							$flag = true;
							break;
						}
					}
				}
			}
			if(! empty($rs['buymanufacturer']) && $rs['buymanufacturer']) {
				$rs['buymanufacturer'] = explode(",",$rs['buymanufacturer']);
				foreach($rs['buymanufacturer'] as $manuf_id) { 
					$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' AND product_id = '".(int)$product_id."' and status = 1");
					if($manquery->num_rows) {
						$flag = true;
						break;
					}
				}
			}
		}
		
		// lets check product exclude condition
		if(empty($rs['exbuyproduct']) && empty($rs['exbuycategory']) && empty($rs['exbuymanufacturer'])) {
			// Do nothing						 
		} else {
			if(! empty($rs['exbuyproduct'])) {
				$rs['exbuyproduct'] = explode(",",$rs['exbuyproduct']);
				if(in_array($product_id,$rs['exbuyproduct'])) {
					$flag = false;
				}
			}
			if(! empty($rs['exbuycategory']) && $rs['exbuycategory']) {
				$rs['exbuycategory'] = explode(",",$rs['exbuycategory']);
				foreach($rs['exbuycategory'] as $category_id) { 
					$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
					if($subcatquery->num_rows) {
						$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") AND product_id = '".(int)$product_id."' ");
						if($catquery->num_rows) {
							$flag = false;
							break;
						}
					}
				}
			}
			if(! empty($rs['exbuymanufacturer']) && $rs['exbuymanufacturer']) {
				$rs['exbuymanufacturer'] = explode(",",$rs['exbuymanufacturer']);
				foreach($rs['exbuymanufacturer'] as $manuf_id) { 
					$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' AND product_id = '".(int)$product_id."' and status = 1");
					if($manquery->num_rows) {
						$flag = false;
						break;
					}
				}
			}
		}
		
		return $flag;
	}
	public function checkgetvalidation($rs, $product_id) { 		
		$flag = false;
		if(empty($rs['getproduct']) && empty($rs['getcategory']) && empty($rs['getmanufacturer'])) {
			$flag = true;
		} else {
			if(! empty($rs['getproduct'])) {
				$rs['getproduct'] = explode(",",$rs['getproduct']);
				if(in_array($product_id,$rs['getproduct'])) {
					$flag = true;
				}
			}
			if(! empty($rs['getcategory']) && $rs['getcategory']) {
				$rs['getcategory'] = explode(",",$rs['getcategory']);
				foreach($rs['getcategory'] as $category_id) { 
					$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
					if($subcatquery->num_rows) {
						$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") AND product_id = '".(int)$product_id."' ");
						if($catquery->num_rows) {
							$flag = true;
							break;
						}
					}
				}
			}
			if(! empty($rs['getmanufacturer']) && $rs['getmanufacturer']) {
				$rs['getmanufacturer'] = explode(",",$rs['getmanufacturer']);
				foreach($rs['getmanufacturer'] as $manuf_id) { 
					$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' AND product_id = '".(int)$product_id."' and status = 1");
					if($manquery->num_rows) {
						$flag = true;
						break;
					}
				}
			}
		}
		
		// lets check product exclude condition
		if(empty($rs['exgetproduct']) && empty($rs['exgetcategory']) && empty($rs['exgetmanufacturer'])) {
			// Do nothing						 
		} else {
			if(! empty($rs['exgetproduct'])) {
				$rs['exgetproduct'] = explode(",",$rs['exgetproduct']);
				if(in_array($product_id,$rs['exgetproduct'])) {
					$flag = false;
				}
			}
			if(! empty($rs['exgetcategory']) && $rs['exgetcategory']) {
				$rs['exgetcategory'] = explode(",",$rs['exgetcategory']);
				foreach($rs['exgetcategory'] as $category_id) { 
					$subcatquery = $this->db->query("SELECT GROUP_CONCAT(category_id) as subcatsid FROM " . DB_PREFIX . "category_path WHERE path_id = '".(int)$category_id."' ");
					if($subcatquery->num_rows) {
						$catquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id in (".$subcatquery->row['subcatsid'].") AND product_id = '".(int)$product_id."' ");
						if($catquery->num_rows) {
							$flag = false;
							break;
						}
					}
				}
			}
			if(! empty($rs['exgetmanufacturer']) && $rs['exgetmanufacturer']) {
				$rs['exgetmanufacturer'] = explode(",",$rs['exgetmanufacturer']);
				foreach($rs['exgetmanufacturer'] as $manuf_id) { 
					$manquery = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '".(int)$manuf_id."' AND product_id = '".(int)$product_id."' and status = 1");
					if($manquery->num_rows) {
						$flag = false;
						break;
					}
				}
			}
		}
		
		return $flag;
	}	
	private function sortByPrice($a, $b) {
		return $a['price'] - $b['price'];
	}
}
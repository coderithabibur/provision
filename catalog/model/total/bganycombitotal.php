<?php
class Modeltotalbganycombitotal extends Controller {	
	private $error = array();
	private $modpath = 'total/bganycombitotal'; 
 	private $modname = 'bganycombitotal';
	private $modname_module = 'bganycombi';
	private $langid = 0;
	private $storeid = 0;
	private $custgrpid = 0;
	
	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->langid = (int)$this->config->get('config_language_id');
		$this->storeid = (int)$this->config->get('config_store_id');
		$this->custgrpid = (int)$this->config->get('config_customer_group_id');
 		
		if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3') { 
 			$this->modpath = 'extension/total/bganycombitotal';
 		}
		if(substr(VERSION,0,3)>='3.0') { 
			$this->modname = 'total_bganycombitotal';
			$this->modname_module = 'module_bganycombi';
		}
 	} 
	
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->cart->hasProducts() && $this->config->get($this->modname_module.'_status')) { 
 			$sub_total = $this->cart->getSubTotal();
			$buy_product = array();
			$get_product = array();	
 			foreach ($this->cart->getProducts() as $product) {
				$bgdata = $this->checkdiscount($product['product_id']); 
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
			//echo "<pre>"; 			print_r($buy_product); 				print_r($get_product); 			exit;
			
			if($buy_product && $get_product) {
				foreach($get_product as $getproduct) {
					$info = $getproduct['info'];
					$bganycombi_id = $info['bganycombi_id'];
					
					if(isset($buy_product[$bganycombi_id]) && count($buy_product[$bganycombi_id]['products']) >= (int)$info['buyqty']) {
						usort($getproduct['products'], array($this, "sortByPrice")); 
						
						$getfreeqty = floor((count($buy_product[$bganycombi_id]['products']) / $info['buyqty']) * $info['getqty']);
						for($i = 0; $i < min($getfreeqty, count($getproduct['products'])); $i++) {
							
							$discount_total = 0;
				
							$discount = 0;
							
							$product = $getproduct['products'][$i];
							//$product['price'] = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
							$freeqty = 1;
							
							// 1 = free
							// 2 = fixed amount
							// 3 = percentage
							
 							if($info['discount_type'] == 1) {  // free
								$discount = ($product['price'] * $freeqty);
							}
							if($info['discount_type'] == 2) { // fixed amount
								$discount = ($info['discount_value'] * $freeqty);
							}
							if($info['discount_type'] == 3) { // percentage
 								$discount = ($product['price'] / 100 * $info['discount_value']) * $freeqty;
							} 
							
 							if(isset($discount_total_array[$bganycombi_id][$product['product_id']])) {
								$discount += $discount_total_array[$bganycombi_id][$product['product_id']]['discount'];
							}
							$discount_total_array[$bganycombi_id][$product['product_id']] = array(
								'title' => sprintf($info['ordertotaltext'], $product['name']),
								'discount' => $discount,
								'product' => $product,
								'sort_order' => $this->config->get($this->modname.'_sort_order')
							); 							
						}  						 
					}
				}
				
				if(isset($discount_total_array) && $discount_total_array) { 
					foreach($discount_total_array as $discount_totalarray) { 
						foreach($discount_totalarray as $discount_totalarray) { 
							$product = $discount_totalarray['product'];
							$discount = $discount_totalarray['discount'];
							
							if ($product['tax_class_id']) {
								$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);
								
								if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3' || substr(VERSION,0,3)=='2.2') {
									foreach ($tax_rates as $tax_rate) {
										if ($tax_rate['type'] == 'P') {
											$total['taxes'][$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
										}
									}
								} else {
									foreach ($tax_rates as $tax_rate) {
										if ($tax_rate['type'] == 'P') {
											$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
										}
									}
								} 
							}
							
							if ($discount > $total) {
								$discount = $total;
							}
							
							if ($discount > 0) {
								if(substr(VERSION,0,3)>='3.0' || substr(VERSION,0,3)=='2.3' || substr(VERSION,0,3)=='2.2') {
									$total['totals'][] = array(
										'code'       => 'bganycombitotal',
										'title'      => $discount_totalarray['title'],
										'value'      => -$discount,
										'sort_order' => $discount_totalarray['sort_order']
									);
				
									$total['total'] -= $discount;
								} else {
									$total_data[] = array(
										'code'       => 'bganycombitotal',
										'title'      => $discount_totalarray['title'],
										'value'      => -$discount,
										'sort_order' => $discount_totalarray['sort_order']
									);
				
									$total -= $discount;
								}
							} 
						}
					}
				}
				//echo "<pre>"; print_r($discount_total_array); exit;
			} 	 
		}
	}
	
	public function checkdiscount($product_id) {
		if($this->config->get((substr(VERSION,0,3)>='3.0' ? 'module_bganycombi_status' : 'bganycombi_status'))) { 
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bganycombi WHERE status = 1 and date_start <= curdate() and date_end >= curdate() and find_in_set(".$this->storeid.", store) and find_in_set(".$this->custgrpid.", customer_group)");
			if($query->num_rows) {
				$result = array();
				foreach($query->rows as $rs) {
					$checkprod = $this->checkprod($rs, $product_id);
					if($checkprod) {
						$ribbontext = json_decode($rs['ribbontext'], true);
						$ordertotaltext = json_decode($rs['ordertotaltext'], true);
						$offer_heading_text = json_decode($rs['offer_heading_text'], true);
						$offer_content = json_decode($rs['offer_content'], true);

						$result[$rs['bganycombi_id']] = $rs;
						$result[$rs['bganycombi_id']]['ribbontext'] = $ribbontext[$this->langid];
						$result[$rs['bganycombi_id']]['ordertotaltext'] = $ordertotaltext[$this->langid];
						$result[$rs['bganycombi_id']]['offer_heading_text'] = $offer_heading_text[$this->langid];
						$result[$rs['bganycombi_id']]['offer_content'] = $offer_content[$this->langid]; 
						
						$result[$rs['bganycombi_id']]['buyflag'] = $checkprod['buyflag'];
						$result[$rs['bganycombi_id']]['getflag'] = $checkprod['getflag'];
 					}
				}
				return $result;
			} else {
				return false;
			} 
		}
	}
	public function checkprod($rs, $product_id) {
		$buyflag = false;
		$getflag = false;
		
		$rs['buyprodlist'] = explode(",",$rs['buyprodlist']);
		$rs['getprodlist'] = explode(",",$rs['getprodlist']);
		
		if(!empty($rs['buyprodlist']) && in_array($product_id , $rs['buyprodlist'])) { $buyflag = true; }
		if($rs['buyprodflag'] == 1) { $buyflag = true; }
		if(!empty($rs['getprodlist']) && in_array($product_id , $rs['getprodlist'])) { $getflag = true; }
		if($rs['getprodflag'] == 1) { $getflag = true; }
 			
		if($buyflag || $getflag) {
			return array('flag' => true, 'buyflag' => $buyflag, 'getflag' => $getflag);
		} 		
	}
	private function sortByPrice($a, $b) {
		return $a['price'] - $b['price'];
	}
}
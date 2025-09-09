<?php
class ModelAccountActivity extends Model {
	public function addActivity($key, $data) {
		if (isset($data['customer_id'])) {
			$customer_id = $data['customer_id'];
		} else {
			$customer_id = 0;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_activity` SET `customer_id` = '" . (int)$customer_id . "', `key` = '" . $this->db->escape($key) . "', `data` = '" . $this->db->escape(json_encode($data)) . "', `ip` = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', `date_added` = NOW()");
	}
	
	
	
	public function getOrderProducts($order_id) {
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->rows;
	}
	
	public function getOrderProductsDate($order_id) {
		$query = $this->db->query("SELECT date_added FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");

		return $query->row;
	}
	
	public function getProducts($product_id) {
		$getids = join("','",$product_id);
		$query1 = 'select max(delivery_days) from oc_product where product_id IN '."('$getids')";
		$query = $this->db->query($query1);
		//echo '<pre>';print_r($query);die;
		return $query->row;
	}
	
	
}

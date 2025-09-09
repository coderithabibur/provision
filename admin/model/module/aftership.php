<?php
class ModelModuleAfterShip extends Model {
	
	public function createTables() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "aftership_courier` (`courier_id` int(11) NOT NULL AUTO_INCREMENT, `slug` varchar(255) NOT NULL, `name` varchar(255) NOT NULL, `phone` varchar(64) NOT NULL, `website` varchar(64) NOT NULL, `sort_order` int(11) NOT NULL,	`status` int(11) NOT NULL, `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', PRIMARY KEY (`courier_id`), UNIQUE KEY `slug` (`slug`)) DEFAULT CHARSET=utf8;");
		
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `courier_id` INT NOT NULL AFTER `accept_language` , ADD `tracking_number` VARCHAR( 32 ) NOT NULL AFTER `courier_id`;"); 
	}
	
	public function addCourier($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "aftership_courier SET name = '" . $this->db->escape($data['name']) . "', slug = '" . $this->db->escape($data['slug']) . "', phone = '" . $this->db->escape($data['phone']) . "', website = '" . $this->db->escape($data['web_url']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = 1, date_added = NOW()");
	}
	
	public function editCourier($courier_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "aftership_courier SET name = '" . $this->db->escape($data['name']) . "', slug = '" . $this->db->escape($data['slug']) . "', phone = '" . $this->db->escape($data['phone']) . "', website = '" . $this->db->escape($data['web_url']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = 1, date_modified = NOW() WHERE courier_id = '" . (int)$courier_id . "'");
	}
	
	public function getCouriers() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "aftership_courier WHERE status = 1 ORDER BY sort_order ASC");
		
		return $query->rows;
	}
	
	public function getCourier($courier_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "aftership_courier WHERE courier_id = '" . (int)$courier_id . "'");
		
		return $query->row;
	}
	
	public function getCourierIdBySlug($slug) {
		$query = $this->db->query("SELECT courier_id FROM " . DB_PREFIX . "aftership_courier WHERE slug = '" . $this->db->escape($slug) . "'");
		
		if ($query->num_rows) {
			return $query->row['courier_id'];
		}
		
		return 0;
	}
	
	public function disableCouriers() {
		$this->db->query("UPDATE " . DB_PREFIX . "aftership_courier SET status = 0");
	}
	
	public function getOrderLanguageId($order_id) {
		$query = $this->db->query("SELECT language_id FROM `" . DB_PREFIX . "order` WHERE order_id ='" . (int)$order_id . "'");
		
		if ($query->num_rows) {
			return $query->row['language_id'];	
		}
		
		return 0;
	}
	
	public function getFrontStoreDefaultLanguageId() {
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE code = '" . $this->config->get('config_language') . "'");
		
		if ($query->num_rows) {
			return $query->row['language_id'];
		}
			
		return 0;	
	}

	public function getTrackingInfo($order_id) {
		$query = $this->db->query("SELECT o.courier_id, o.tracking_number, ac.name, ac.slug, ac.phone, ac.website FROM `" . DB_PREFIX . "order` o INNER JOIN " . DB_PREFIX . "aftership_courier ac ON (o.courier_id = ac.courier_id) WHERE o.order_id = '" . (int)$order_id . "'");
		
		return $query->row;
	}	
}	
?>
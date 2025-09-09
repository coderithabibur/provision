<?php
class ModelModuleAfterShip extends Model {
	
	public function getCourierSlug($courier_id) {
		$query = $this->db->query("SELECT slug FROM " . DB_PREFIX . "aftership_courier WHERE courier_id = '" . (int)$courier_id . "'");
		
		if ($query->num_rows) {
			return $query->row['slug'];	
		}
		
		return false;
	}
	
	public function editTrackingInfo($order_id, $courier_id, $tracking_number) {
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET courier_id = '" . (int)$courier_id . "', tracking_number = '" . $this->db->escape($tracking_number) . "' WHERE order_id = '" . (int)$order_id . "'");
	}
	
	public function getTrackingInfo($order_id) {
		$query = $this->db->query("SELECT o.courier_id, o.tracking_number, ac.name, ac.slug, ac.phone, ac.website FROM `" . DB_PREFIX . "order` o INNER JOIN " . DB_PREFIX . "aftership_courier ac ON (o.courier_id = ac.courier_id) WHERE o.order_id = '" . (int)$order_id . "'");
		
		if ($query->num_rows) {
			return $query->row;
		}
		
		return false;
	} 
}
?>
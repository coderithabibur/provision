<?php
class SeoManufacturer extends SeoAbstract { 

	private $_image;

	private $_name;

	public function getImage() {
		return $this->_image;
	}

	public function getName() {
		return $this->_name;
	}

	public function load() {

		$sql = "SELECT sd.title, m.name, m.image , sd.language_id, sd.meta_keywords, sd.meta_description FROM `" . DB_PREFIX . "manufacturer` m LEFT JOIN `" . DB_PREFIX . "seo_data` sd ON (sd.id = m.manufacturer_id AND sd.type='manufacturer') WHERE m.manufacturer_id = '" . 	 (int) $this->_id . "'";
		
		$query = $this->_db->query($sql);

		foreach($query->rows as $row) { 		
				
			$this->_title[$row['language_id']] = $row['title'];
			$this->_meta_keywords[$row['language_id']] = $row['meta_keywords'];
			$this->_meta_description[$row['language_id']] = $row['meta_description'];
		}

		$query = $this->_db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = 1 ORDER BY sort_order ASC");

		foreach ($query->rows as $key => $value) {
			$newQ = $this->_db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$this->_id . "' AND lang ='".$value['language_id']."'");
			$this->_seo_keyword['language_id'][$value['language_id']] = isset($newQ->row['keyword']) ? $newQ->row['keyword'] : '';	
		}
		
		$config = $this->_registry->get('config');
		$this->_name = isset($query->row['name']) ? $query->row['name'] : '';
		$this->_image = isset($query->row['image']) ? $query->row['image'] : '';

	}

	public function save() {
		
		$db = $this->_registry->get('db');
		
		$query = $db->query("SELECT url_alias_id FROM `" . DB_PREFIX . "seo_data` 
							WHERE id = '" . $db->escape($this->_id) . "' AND type= 'manufacturer' ");
		
		if($query->num_rows) {
			$db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE url_alias_id = '" . (int) $query->row['url_alias_id'] . "'");
			$db->query("DELETE FROM `" . DB_PREFIX . "seo_data` WHERE  id = '" . $db->escape($this->_id) . "' AND type= 'manufacturer' ");
		}
		
		$url_alias_id = 0;
		
		if($this->_seo_keyword){
			
			$sql = "SELECT COUNT(*) as count FROM `" . DB_PREFIX . "url_alias` WHERE `query` = '" . $db->escape($this->_url_query) . "'";
			$already_existing = $db->query($sql)->row['count'];
			if($already_existing) {
				$db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = '" . $db->escape($this->_url_query) . "'");
			}
			
			foreach ($this->_seo_keyword as $key => $value) {
				if ($value != "") {
				 $db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = '" . $db->escape($this->_url_query) . "',
						`keyword` = '" . $db->escape($value) . "', lang ='".(int)$key."'");
				}
			}
		}
		
		foreach($this->_title as $language_id => $row ){
			$db->query("INSERT INTO `" . DB_PREFIX . "seo_data` 
						SET `title` = '" . $db->escape($this->_title[$language_id]) . "',
						`meta_keywords` = '" . $db->escape($this->_meta_keywords[$language_id]) . "',
						`meta_description` = '" . $db->escape($this->_meta_description[$language_id]) . "',
						`type` = 'manufacturer',
						`id` = '" . $db->escape($this->_id) . "',
						`language_id` = '" . (int) $language_id . "'
						");
		} 
		
		
		//delete product cache
		$cache = $this->_registry->get('cache');
		$cache->delete('manufacturer');
		
	}


}
?>
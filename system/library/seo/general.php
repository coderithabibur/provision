<?php
class SeoGeneral extends SeoAbstract {

	public function load() {
		if ($this->_db->query("SHOW TABLES LIKE '". DB_PREFIX ."seo_data'")->num_rows == 0) {
			echo "<pre>The Seo Module is not installed completely. The last step is left incomplete.<pre>";
			echo "Go to admin > catalog > seo > seo autogenerate  to complete the installation";
			exit();
		}

		$sql = "SELECT title, language_id, meta_keywords, meta_description FROM `" . DB_PREFIX . "seo_data` WHERE type='general' AND id = '".$this->_db->escape($this->_id)."'";
		
		$query = $this->_db->query($sql);

		foreach($query->rows as $row) { 		
				
			$this->_title[$row['language_id']] = $row['title'];
			$this->_meta_keywords[$row['language_id']] = $row['meta_keywords'];
			$this->_meta_description[$row['language_id']] = $row['meta_description'];
				
		}
		
		$query = $this->_db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = 1 ORDER BY sort_order ASC");
		foreach ($query->rows as $key => $value) {
			$newQ = $this->_db->query("SELECT * FROM `" . DB_PREFIX . "url_alias` WHERE query = 'route=" . $this->_db->escape($this->_id) . "' AND lang = '".(int)$value['language_id']."'");
			$this->_seo_keyword['language_id'][$value['language_id']] = isset($newQ->row['keyword']) ? $newQ->row['keyword'] : '';	
			$this->_url_query = isset($newQ->row['query']) ? $newQ->row['query'] : '';	
		}	

	}
	
	public function save() {
		
		$db = $this->_registry->get('db');
		$db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE query = 'route=" . $this->_id . "'");
		$db->query("DELETE FROM `" . DB_PREFIX . "seo_data` WHERE id = '" . $this->_id . "'");

		if($this->_seo_keyword){
			
			$sql = "SELECT COUNT(*) as count FROM `" . DB_PREFIX . "url_alias` WHERE `query` = '" . $db->escape($this->_url_query) . "'";
			$already_existing = $db->query($sql)->row['count'];
			if($already_existing) {
				$db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = '" . $db->escape($this->_url_query) . "'");
			}
			
			foreach ($this->_seo_keyword as $key => $value) {
				if ($value != "" || ($this->_url_query == "route=common/home")) {
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
						`type` = 'general',
						`id` = '" . $db->escape($this->_id) . "',
						`language_id` = '" . (int) $language_id . "'
						");
		} 
	}

}
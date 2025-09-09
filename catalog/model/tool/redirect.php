<?php
class ModelToolRedirect extends Model {
	public function redirectData($url) {
		$urlentry = $this->db->query("SELECT * FROM " . DB_PREFIX . "redirectManagerTable where failedUrl = '".$this->db->escape($url)."'");

		if($urlentry->num_rows){
			$this->db->query("UPDATE " . DB_PREFIX . "redirectManagerTable SET count = count + 1 WHERE  failedUrl = '" .$this->db->escape($url). "'");
		} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "redirectManagerTable SET failedUrl = '" .$this->db->escape($url). "', count = 1, date = NOW()");
		}
	}

	public function getHoneUrl() {
		$urlentry = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias where query = 'route=common/home' AND lang = '".$this->config->get("config_language_id")."' ");
		if($urlentry->num_rows) {
			return $urlentry->row['keyword'];
		} else {
			return 0;
		}
	}
}
?>
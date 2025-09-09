<?php
class ModelCatalogInformation extends Model {
	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");

		// START: NitroPack.io (https://nitropack.io)
                if (__FUNCTION__ == 'getInformation' && is_file(DIR_CONFIG . 'nitropackio/compatibility.php')) {
                    $this->load->config('nitropackio/compatibility');
                    $nitropack_config = $this->config->get('nitropackio');
                    $nitropack_action = new \Action($nitropack_config['route']['module']['nitropack'] . '/afterGetInformation', $information_id);
                    $nitropack_action->execute($this->registry);
                }
                // END: NitroPack.io (https://nitropack.io)
            return $query->row;
	}

	public function getInformations() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1' ORDER BY i.sort_order, LCASE(id.title) ASC");

		return $query->rows;
	}

	public function getInformationLayoutId($information_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}
	public function subscriberInsert($email) {
        $sql="Select * from " . DB_PREFIX . "subscriber WHERE email='".$email."' ";
        $emailCheckPoint=$this->db->query($sql);
        if(!$emailCheckPoint->num_rows){
            return $this->db->query("INSERT INTO " . DB_PREFIX . "subscriber SET email='".$email."' "); 
        }else{			
            return 0;
        }
	}
}
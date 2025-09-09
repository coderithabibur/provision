<?php
class ModelCatalogManufacturer extends Model {
	public function getManufacturer($manufacturer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.manufacturer_id = '" . (int)$manufacturer_id . "' AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		// START: NitroPack.io (https://nitropack.io)
                if (__FUNCTION__ == 'getManufacturer' && is_file(DIR_CONFIG . 'nitropackio/compatibility.php')) {
                    $this->load->config('nitropackio/compatibility');
                    $nitropack_config = $this->config->get('nitropackio');
                    $nitropack_action = new \Action($nitropack_config['route']['module']['nitropack'] . '/afterGetManufacturer', $manufacturer_id);
                    $nitropack_action->execute($this->registry);
                }
                // END: NitroPack.io (https://nitropack.io)
            return $query->row;
	}

	public function getManufacturers($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

			$sort_data = array(
				'name',
				'sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			// START: NitroPack.io (https://nitropack.io)
                if (__FUNCTION__ == 'getManufacturers' && is_file(DIR_CONFIG . 'nitropackio/compatibility.php')) {
                    $this->load->config('nitropackio/compatibility');
                    $nitropack_config = $this->config->get('nitropackio');
                    $nitropack_action = new \Action($nitropack_config['route']['module']['nitropack'] . '/afterGetManufacturers', $query->rows);
                    $nitropack_action->execute($this->registry);
                }
                // END: NitroPack.io (https://nitropack.io)
            return $query->rows;
		} else {
			$manufacturer_data = $this->cache->get('manufacturer.' . (int)$this->config->get('config_store_id'));

			if (!$manufacturer_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY name");

				$manufacturer_data = $query->rows;

				$this->cache->set('manufacturer.' . (int)$this->config->get('config_store_id'), $manufacturer_data);
			}

			// START: NitroPack.io (https://nitropack.io)
                if (__FUNCTION__ == 'getManufacturers' && is_file(DIR_CONFIG . 'nitropackio/compatibility.php')) {
                    $this->load->config('nitropackio/compatibility');
                    $nitropack_config = $this->config->get('nitropackio');
                    $nitropack_action = new \Action($nitropack_config['route']['module']['nitropack'] . '/afterGetManufacturers', $manufacturer_data);
                    $nitropack_action->execute($this->registry);
                }
                // END: NitroPack.io (https://nitropack.io)
            return $manufacturer_data;
		}
	}
}
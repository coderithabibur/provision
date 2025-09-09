<?php
class ModelCatalogQuestion extends Model {
	public function addQuestion($data) {
		$product_id = (int)$data['product_id'];
		$ip = isset($this->request->server['REMOTE_ADDR']) ? $this->request->server['REMOTE_ADDR'] : '';

		$this->db->query("INSERT INTO " . DB_PREFIX . "product_question SET status = '0', date_added = NOW(), date_modified = NOW()");

		$question_id = $this->db->getLastId();

		// can't use model localisation/language because will ignore disabled languages
		$languages = $this->getLanguages();
		
		foreach($languages as $language) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language['language_id'] . "', title = '" . (isset($data['title']) ? $this->db->escape($data['title']) : '') . "', description = '" . $this->db->escape($data['question']) . "'");
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_question_sender SET question_id = '" . $question_id . "', name = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', ip = '" . $this->db->escape($ip) . "', prefered_language_id = '" . (int)$this->config->get('config_language_id') . "'");
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_product_question SET product_id = '" . (int)$product_id . "', question_id = '" . $question_id . "'");

		if ($this->config->get('product_question_admin_notification')) {
			$this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product_id);

			$find = array(
				'{product.name}',
				'{product.model}',
				'{product.url}',
				'{customer.name}',
				'{customer.email}',
				'{customer.telephone}',
				'{customer.ip}',
				'{customer.question}'
			);

			$replace = array(
				'product.name'       => html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8'),
				'product.model'      => html_entity_decode($product_info['model'], ENT_QUOTES, 'UTF-8'),
				'product.url'        => $this->url->link('product/product', 'product_id=' . $product_id),
				'customer.name'      => html_entity_decode($data['name'], ENT_QUOTES, 'UTF-8'),
				'customer.email'     => html_entity_decode($data['email'], ENT_QUOTES, 'UTF-8'),
				'customer.telephone' => html_entity_decode($data['telephone'], ENT_QUOTES, 'UTF-8'),
				'customer.ip'        => $ip,
				'customer.question'  => html_entity_decode(nl2br($data['question']), ENT_QUOTES, 'UTF-8'),
			);

			$subject = str_replace($find, $replace, html_entity_decode($this->config->get('product_question_admin_notification_subject'), ENT_QUOTES, 'UTF-8'));
			$message = str_replace($find, $replace, html_entity_decode($this->config->get('product_question_admin_notification_message'), ENT_QUOTES, 'UTF-8'));

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->db->escape(strip_tags($data['email'])));
			$mail->setSender($this->db->escape(strip_tags($data['name'])));
			$mail->setSubject($subject);
			$mail->setHTML($message);
			$mail->send();

			if ($this->config->get('product_question_admin_notification_additional')) {
				$emails = explode(',', $this->config->get('config_mail_alert'));

				foreach ($emails as $email) {
					if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$mail->setTo($email);
						$mail->send();
					}
				}
			}
		}
	}

	public function getQuestionsByProductId($product_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_question q LEFT JOIN " . DB_PREFIX . "product_question_description qd ON (q.question_id = qd.question_id) LEFT JOIN " . DB_PREFIX . "product_to_product_question p2q ON (q.question_id = p2q.question_id) WHERE (p2q.product_id = '" . (int)$product_id . "' OR q.general = '1') AND q.status = '1' AND qd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY q.general DESC, q.sort_order ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalQuestionsByProductId($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_question q LEFT JOIN " . DB_PREFIX . "product_question_description qd ON (q.question_id = qd.question_id) LEFT JOIN " . DB_PREFIX . "product_to_product_question p2q ON (q.question_id = p2q.question_id) WHERE (p2q.product_id = '" . (int)$product_id . "' OR q.general = '1') AND q.status = '1' AND qd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
	
	private function getLanguages() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language ORDER BY language_id");
		
		return $query->rows;
	}	
}

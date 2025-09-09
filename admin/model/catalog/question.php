<?php
class ModelCatalogQuestion extends Model {
	public function addQuestion($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_question SET  status = '" . (int)$data['status'] . "', general = '" . (int)$data['general'] . "', sort_order = '" . (int)$data['sort_order'] . "', view = '1', reply = '0', internal = '1', date_added = NOW(), date_modified = NOW()");

		$question_id = $this->db->getLastId();

		foreach ($data['question_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', answer = '" . $this->db->escape($value['answer']) . "'");
		}

		// if is NOT general question, add product - question relation
		if ($data['general'] == 0) {
			if (isset($data['question_product'])) {
				foreach ($data['question_product'] as $product_id) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_product_question SET question_id = '" . (int)$question_id . "', product_id = '" . (int)$product_id . "'");
				}
			}
		}

		// set admin as question sender
		$this->load->model('user/user');
		$user_info = $this->model_user_user->getUser($this->user->getId());

		$this->db->query("INSERT INTO " . DB_PREFIX . "product_question_sender SET question_id = '" . (int)$question_id . "', name = '" . $this->db->escape($user_info['firstname'] . ' ' . $user_info['lastname']) . "', email = '" . $this->db->escape($user_info['email']) . "', prefered_language_id = '" . (int)$this->config->get('config_language_id') . "'");

		$this->cache->delete('question');

		return $question_id;
	}

	public function editQuestion($question_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "product_question SET  status = '" . (int)$data['status'] . "', general = '" . (int)$data['general'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE question_id = '" . (int)$question_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_question_description WHERE question_id = '" . (int)$question_id . "'");

		foreach ($data['question_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', answer = '" . $this->db->escape($value['answer']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_product_question WHERE question_id = '" . (int)$question_id . "'");

		// if is NOT general question, add product - question relation
		if ($data['general'] == 0) {
			if (isset($data['question_product'])) {
				foreach ($data['question_product'] as $product_id) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_product_question SET question_id = '" . (int)$question_id . "', product_id = '" . (int)$product_id . "'");
				}
			}
		}

		$this->cache->delete('question');
	}

	public function deleteQuestion($question_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_question WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_question_description WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_question_sender WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_product_question WHERE question_id = '" . (int)$question_id . "'");

		$this->cache->delete('question');
	}

	public function getQuestion($question_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_question q LEFT JOIN " . DB_PREFIX . "product_question_description qd ON (q.question_id = qd.question_id) LEFT JOIN " . DB_PREFIX . "product_question_sender qs ON (q.question_id = qs.question_id) WHERE q.question_id = '" . (int)$question_id . "' AND qd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getQuestions($data = array()) {
		$sql = "SELECT q.*, qd.*, qs.*, pd.name as product_name FROM " . DB_PREFIX . "product_question q LEFT JOIN " . DB_PREFIX . "product_question_description qd ON (q.question_id = qd.question_id) LEFT JOIN " . DB_PREFIX . "product_question_sender qs ON (q.question_id = qs.question_id) LEFT JOIN " . DB_PREFIX . "product_to_product_question p2q ON (q.question_id = p2q.question_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p2q.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE qd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND qd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND q.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_view']) && !is_null($data['filter_view'])) {
			$sql .= " AND q.view = '" . (int)$data['filter_view'] . "'";
		}

		if (isset($data['filter_reply']) && !is_null($data['filter_reply'])) {
			$sql .= " AND q.reply = '" . (int)$data['filter_reply'] . "'";
		}

		if (isset($data['filter_general']) && !is_null($data['filter_general'])) {
			$sql .= " AND q.general = '" . (int)$data['filter_general'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(date_modified) = '" . $this->db->escape($data['filter_date_modified']) . "'";
		}

		$sql .= " GROUP BY q.question_id";

		$sort_data = array(
			'q.question_id',
			'qd.title',
			'q.status',
			'q.sort_order',
			'q.general'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY q.question_id";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
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

		return $query->rows;
	}

	public function getQuestionDescriptions($question_id) {
		$question_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_question_description WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_description_data[$result['language_id']] = array(
				'title'       => $result['title'],
				'description' => $result['description'],
				'answer'      => $result['answer']
			);
		}

		return $question_description_data;
	}

	public function getQuestionProducts($question_id) {
		$question_product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_product_question WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_product_data[] = $result['product_id'];
		}

		return $question_product_data;
	}

	public function isGeneralQuestion($question_id) {
		$query  = $this->db->query("SELECT general FROM " . DB_PREFIX . "product_question WHERE question_id = '" . $question_id . "'");

		return ($query->row['general']) ? true : false;
	}

	public function addReply($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_question_reply SET question_id = '" . (int)$data['question_id'] . "', description = '" . $this->db->escape($data['description']) . "', language_id = '" . (int)$data['language_id'] . "', user_id = '" . (int)$this->user->getId() . "', date_added = NOW()");
	}

	public function getReply($reply_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_question_reply WHERE question_reply_id = '" . (int)$reply_id . "'");

		return $query->row;
	}

	public function getRelatedProductReplies($question_id) {
		$replies = array();

		$products = $this->getQuestionProducts($question_id);

		if ($products) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_question_reply WHERE question_id IN (SELECT DISTINCT question_id FROM " . DB_PREFIX . "product_to_product_question WHERE product_id IN (" . implode(',', $products) . ")) OR question_id IN (SELECT question_id FROM " . DB_PREFIX . "product_question WHERE general = '1') ORDER BY question_reply_id DESC");

			$replies = $query->rows;
		}

		return $replies;
	}

	public function getReplyMessageByQuestionIdAndLanguageId($question_id, $language_id) {
		$query = $this->db->query("SELECT description FROM " . DB_PREFIX . "product_question_reply WHERE question_id = '" . (int)$question_id . "' AND language_id = '" . (int)$language_id . "'");

		if ($query->num_rows) {
			return $query->row['description'];
		} else {
			return false;
		}
	}

	public function getSenderByQuestionId($question_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_question_sender WHERE question_id = '" . $question_id . "'");

		return $query->row;
	}

	public function getSenderPreferedLanguageByQuestionId($question_id) {
		$query = $this->db->query("SELECT prefered_language_id FROM " . DB_PREFIX . "product_question_sender WHERE question_id = '" . $question_id . "'");

		return $query->row['prefered_language_id'];
	}

	public function getTotalQuestions($data = array()) {
		$sql = "SELECT COUNT(DISTINCT q.question_id) AS total FROM " . DB_PREFIX . "product_question q LEFT JOIN " . DB_PREFIX . "product_question_description qd ON (q.question_id = qd.question_id) LEFT JOIN " . DB_PREFIX . "product_to_product_question p2q ON (q.question_id = p2q.question_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p2q.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE qd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND qd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND q.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_view']) && !is_null($data['filter_view'])) {
			$sql .= " AND q.view = '" . (int)$data['filter_view'] . "'";
		}

		if (isset($data['filter_reply']) && !is_null($data['filter_reply'])) {
			$sql .= " AND q.reply = '" . (int)$data['filter_reply'] . "'";
		}

		if (isset($data['filter_general']) && !is_null($data['filter_general'])) {
			$sql .= " AND q.general = '" . (int)$data['filter_general'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(date_modified) = '" . $this->db->escape($data['filter_date_modified']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalQuestionProducts($question_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_product_question WHERE question_id = '" . (int)$question_id . "'");

		return $query->row['total'];
	}

	public function getTotalQuestionsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_question WHERE status = '0'");

		return $query->row['total'];
	}

	public function getTotalQuestionsUnread() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_question WHERE view = '0'");

		return $query->row['total'];
	}

	public function getTotalProductKeywords($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'");

		return $query->row['total'];
	}

	public function getTotalRepliesByQuestionId($question_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_question_reply WHERE question_id ='" . $question_id . "'");

		return $query->row['total'];
	}

	public function getProductKeyword($product_id) {
		$query = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'");

		if ($query->num_rows) {
			return $query->row['keyword'];
		} else {
			return false;
		}
	}

	public function getProductKeywords($product_id) {
		$product_keywords_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'");

		if ($query->num_rows) {
			foreach ($query->rows as $result) {
				$product_keywords_data[$result['language_id']] = array(
					'keyword'     => $result['keyword'],
				);
			}
		}

		return $product_keywords_data;
	}

	public function updateViewed($question_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product_question SET `view` = '1' WHERE question_id = '" . (int)$question_id . "'");
	}

	public function updateReplied($question_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product_question SET `reply` = '1' WHERE question_id = '" . (int)$question_id . "'");
	}

	public function ocx2HtmlTemplate($html_template) {
		$find = array(
			'<ocx-template-',
			'</ocx-template-'
		);

		$replace = array(
			'<',
			'</'
		);

		// rebuild original tags
		$html = str_replace($find, $replace, $html_template);

		// check if any required tags are missing
		$doctype_tag = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

		if (strpos($html, '<body') === false) {
			$html = '<body>' . $html;
		}

		if (strpos($html, '</body>') === false) {
			$html = $html . '</body>';
		}

		if (strpos($html, '<html') === false) {
			$html = '<html>' . $html;
		}

		if (strpos($html, '</html>') === false) {
			$html = $html . '</html>';
		}

		$html = $doctype_tag . $html;

		return $html;
	}

}

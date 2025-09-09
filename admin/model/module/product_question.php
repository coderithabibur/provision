<?php
class ModelModuleProductQuestion extends Model {
	public function createTables() {
		//$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question`");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX .  "product_question` (`question_id` int(11) NOT NULL AUTO_INCREMENT, `status` int(11) NOT NULL, `general` int(11) NOT NULL, `sort_order` int(11) NOT NULL, `view` int(11) NOT NULL, `reply` int(11) NOT NULL, `internal` int(11) NOT NULL COMMENT 'added by admins', `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', PRIMARY KEY (`question_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		//$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question_description`");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_question_description` (`question_id` int(11) NOT NULL, `language_id` int(11) NOT NULL, `title` varchar(255) NOT NULL, `description` text NOT NULL, `answer` text NOT NULL, PRIMARY KEY (`question_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		//$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question_reply`");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_question_reply` (`question_reply_id` int(11) NOT NULL AUTO_INCREMENT, `question_id` int(11) NOT NULL, `description` text NOT NULL, `language_id` int(11) NOT NULL, `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', `user_id` int(11) NOT NULL, PRIMARY KEY (`question_reply_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		//$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question_sender`");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_question_sender` (`question_sender_id` int(11) NOT NULL AUTO_INCREMENT, `question_id` int(11) NOT NULL, `name` varchar(64) NOT NULL, `email` varchar(96) NOT NULL, `telephone` varchar(32) NOT NULL, `ip` varchar(32) NOT NULL, `prefered_language_id` int(11) NOT NULL, PRIMARY KEY (`question_sender_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		//$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_to_product_question`");
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_to_product_question` (`product_id` int(11) NOT NULL, `question_id` int(11) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	}

	public function removeTables() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question_description`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question_reply`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_question_sender`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_to_product_question`");
	}
}
?>

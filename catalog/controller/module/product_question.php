<?php
class ControllerModuleProductQuestion extends Controller {
	public function index() {

	}

	public function check() {
		$json = array();

		if ($this->config->get('product_question_status') && isset($this->session->data['product_question_product_id'])) {
			$json['product_id'] = $this->session->data['product_question_product_id'];

			$json['tab_header_position_selector'] = $this->config->get('product_question_tab_header_position_selector');
			$json['tab_header_position_function'] = $this->config->get('product_question_tab_header_position_function');
			$json['tab_header_format']            = $this->getTabHeaderFormatProcessed();

			$json['tab_content_position_selector'] = $this->config->get('product_question_tab_content_position_selector');
			$json['tab_content_position_function'] = $this->config->get('product_question_tab_content_position_function');
			$json['tab_content_format']            = $this->getTabContentFormatProcessed();

			$json['extra_button_status']            = $this->config->get('product_question_extra_button_status');
			$json['extra_button_position_selector'] = $this->config->get('product_question_extra_button_position_selector');
			$json['extra_button_position_function'] = $this->config->get('product_question_extra_button_position_function');
			$json['extra_button_format']            = $this->getExtraButtonFormatProcessed();
			$json['extra_button_behaviour']         = $this->config->get('product_question_extra_button_behaviour');

			$json['success'] = true;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	// later change to 1 function instead of this 3
	private function getTabHeaderFormatProcessed() {
		$tab_header = '';
		$tab_header_format = html_entity_decode($this->config->get('product_question_tab_header_format'), ENT_QUOTES, 'UTF-8');

		$tab_names = $this->config->get('product_question_tab_name');

		if (isset($tab_names[$this->config->get('config_language_id')])) {
			$tab_name = $tab_names[$this->config->get('config_language_id')]['tab_name'];
		} else {
			$tab_name = '';
		}

		$find = array(
			'{tab.name}'
		);

		$replace = array(
			'tab.name' => $tab_name
		);

		$tab_header = str_replace($find, $replace, $tab_header_format);

		return $tab_header;
	}

	private function getTabContentFormatProcessed() {
		$tab_content = '';

		$tab_content_format = html_entity_decode($this->config->get('product_question_tab_content_format'), ENT_QUOTES, 'UTF-8');

		$find = array(
			'{tab.content}'
		);

		$replace = array(
			'tab.content' => $this->getTabContentHTML()
		);

		$tab_content = str_replace($find, $replace, $tab_content_format);

		return $tab_content;
	}

	private function getExtraButtonFormatProcessed() {
		$extra_button = '';
		$extra_button_format = html_entity_decode($this->config->get('product_question_extra_button_format'), ENT_QUOTES, 'UTF-8');

		$button_names = $this->config->get('product_question_extra_button_name');

		if (isset($button_names[$this->config->get('config_language_id')])) {
			$button_name = $button_names[$this->config->get('config_language_id')]['extra_button_name'];
		} else {
			$button_name = '';
		}

		$find = array(
			'{extra.button.name}'
		);

		$replace = array(
			'extra.button.name' => $button_name
		);

		$extra_button = str_replace($find, $replace, $extra_button_format);

		return $extra_button;
	}

	// Questions Tab Content
	private function getTabContentHTML() {
		$this->load->language('module/product_question');

		// Text
		$data['text_question_invitation'] = $this->language->get('text_question_invitation');
		$data['text_loading'] = $this->language->get('text_loading');

		// Entry
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_question'] = $this->language->get('entry_question');

		// Button
		$data['button_ask_question'] = $this->language->get('button_ask_question');
		$data['button_send_question'] = $this->language->get('button_send_question');

		$data['product_id'] = $this->session->data['product_question_product_id'];

		if ($this->customer->isLogged()) {
			$data['customer_name'] = $this->customer->getFirstName() . ' ' . $this->customer->getLastName();
			$data['customer_email'] = $this->customer->getEmail();
			$data['customer_telephone'] = $this->customer->getTelephone();
		} else {
			$data['customer_name'] = '';
			$data['customer_email'] = '';
			$data['customer_telephone'] = '';
		}

		// Captcha
		if ($this->config->get('product_question_captcha') && $this->config->get($this->config->get('config_captcha') . '_status')) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
		} else {
			$data['captcha'] = '';
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/product_question_form.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/product_question_form.tpl', $data);
		} else {
			return $this->load->view('default/template/module/product_question_form.tpl', $data);
		}
	}

	public function getQuestions() {
		$this->load->language('module/product_question');

		$this->load->model('catalog/question');

		$data['text_empty'] = $this->language->get('text_empty');

		$data['button_load_more'] = $this->language->get('button_load_more');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$limit = $this->config->get('product_question_tab_question_limit');
		$start = ($page - 1) * $limit;

		$data['questions'] = array();

		$question_total = $this->model_catalog_question->getTotalQuestionsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_question->getQuestionsByProductId($this->request->get['product_id'], $start, $limit);

		foreach ($results as $result) {
			$data['questions'][] = array(
				'question_id' => $result['question_id'],
				'question'    => $result['title'],
				'answer'      => html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8')
			);
		}

		if ($start + $limit < $question_total) {
			$next_page = ++$page;
			$data['load_more'] = $this->url->link('module/product_question/getQuestions', 'product_id=' . $this->request->get['product_id'] . '&page=' . $next_page);
		} else {
			$data['load_more'] = false;
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/product_question_list.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/product_question_list.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/module/product_question_list.tpl', $data));
		}
	}

	public function sendQuestion() {
		$this->load->language('module/product_question');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
				$json['error'] = $this->language->get('error_email');
			}

			if (utf8_strlen($this->request->post['question']) < 25) {
				$json['error'] = $this->language->get('error_question');
			}

			// Captcha
			if ($this->config->get('product_question_captcha') && $this->config->get($this->config->get('config_captcha') . '_status')) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/question');

				$this->model_catalog_question->addQuestion($this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>

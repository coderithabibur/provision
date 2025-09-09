<?php
class ControllerCatalogQuestion extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/question');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/stylesheet/product-question.css');
		$this->document->addScript('view/javascript/jquery/jquery.chosen.js');

		$this->load->model('catalog/question');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/question');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/stylesheet/product-question.css');

		$this->load->model('catalog/question');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_question->addQuestion($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_general'])) {
				$url .= '&filter_general=' . $this->request->get['filter_general'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/question');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/stylesheet/product-question.css');

		$this->load->model('catalog/question');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_question->editQuestion($this->request->get['question_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_general'])) {
				$url .= '&filter_general=' . $this->request->get['filter_general'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/question');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/question');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $question_id) {
				$this->model_catalog_question->deleteQuestion($question_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_general'])) {
				$url .= '&filter_general=' . $this->request->get['filter_general'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_title'])) {
			$filter_title = $this->request->get['filter_title'];
		} else {
			$filter_title = null;
		}

		if (isset($this->request->get['filter_product'])) {
			$filter_product = $this->request->get['filter_product'];
		} else {
			$filter_product = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_view'])) {
			$filter_view = $this->request->get['filter_view'];
		} else {
			$filter_view = null;
		}

		if (isset($this->request->get['filter_reply'])) {
			$filter_reply = $this->request->get['filter_reply'];
		} else {
			$filter_reply = null;
		}

		if (isset($this->request->get['filter_general'])) {
			$filter_general = $this->request->get['filter_general'];
		} else {
			$filter_general = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
		} else {
			$filter_date_modified = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pq.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_view'])) {
			$url .= '&filter_view=' . $this->request->get['filter_view'];
		}

		if (isset($this->request->get['filter_reply'])) {
			$url .= '&filter_reply=' . $this->request->get['filter_reply'];
		}

		if (isset($this->request->get['filter_general'])) {
			$url .= '&filter_general=' . $this->request->get['filter_general'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/question/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/question/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['questions'] = array();

		$filter_data = array(
			'filter_title'         => $filter_title,
			'filter_product'       => $filter_product,
			'filter_status'        => $filter_status,
			'filter_view'          => $filter_view,
			'filter_reply'         => $filter_reply,
			'filter_general'       => $filter_general,
			'filter_date_added'    => $filter_date_added,
			'filter_date_modified' => $filter_date_modified,
			'sort'              	  => $sort,
			'order'             	  => $order,
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
		);

		$question_total = $this->model_catalog_question->getTotalQuestions($filter_data);

		$results = $this->model_catalog_question->getQuestions($filter_data);

		foreach ($results as $result) {

			if (empty($result['title'])) {
				$tooltip = str_replace('"', '&quot;', html_entity_decode(nl2br($result['description']), ENT_QUOTES, 'UTF-8'));

				if ($result['general']) {
					$title = $this->language->get('text_general_question');
				} else {
					$products_related_total = $this->model_catalog_question->getTotalQuestionProducts($result['question_id']);

					if ($products_related_total > 1) {
						$title = sprintf($this->language->get('text_question_about'), $this->language->get('text_multiple_products'));
					} else {
						$title = sprintf($this->language->get('text_question_about'), $result['product_name']);
					}
				}

			} else {
				$title = $result['title'];
				$tooltip = strip_tags(str_replace('"', '&quot;', html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8')));
			}

			$data['questions'][] = array(
				'question_id'      => $result['question_id'],
				'title'            => $title,
				'description'      => html_entity_decode(nl2br($result['description']), ENT_QUOTES, 'UTF-8'),
				'tooltip'          => $tooltip,
				'answer'           => html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8'),
				'status'           => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'general'          => ($result['general']) ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'view'             => $result['view'],
				'reply'            => $result['reply'],
				'internal'         => $result['internal'],
				'customer_name'    => $result['name'],
				'customer_email'   => $result['email'],
				'customer_details' => sprintf($this->language->get('text_customer_details'), $result['name'], $result['email']),
				'date_added'       => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'             => $this->url->link('catalog/question/edit', 'token=' . $this->session->data['token'] . '&question_id=' . $result['question_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['column_title'] = $this->language->get('column_title');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_answer'] = $this->language->get('column_answer');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_general'] = $this->language->get('column_general');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_answer'] = $this->language->get('entry_answer');
		$data['entry_general'] = $this->language->get('entry_general');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_view'] = $this->language->get('entry_view');
		$data['entry_reply'] = $this->language->get('entry_reply');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_date_modified'] = $this->language->get('entry_date_modified');

		$data['help_internal'] = $this->language->get('help_internal');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_reply'] = $this->language->get('button_reply');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_general'] = $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . '&sort=q.general' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . '&sort=q.status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . '&sort=q.date_added' . $url, 'SSL');
		$data['sort_date_modified'] = $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . '&sort=q.date_modified' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_view=' . $this->request->get['filter_view'];
		}

		if (isset($this->request->get['filter_view'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_reply'])) {
			$url .= '&filter_reply=' . $this->request->get['filter_reply'];
		}

		if (isset($this->request->get['filter_general'])) {
			$url .= '&filter_general=' . $this->request->get['filter_general'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $question_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($question_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($question_total - $this->config->get('config_limit_admin'))) ? $question_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $question_total, ceil($question_total / $this->config->get('config_limit_admin')));

		$data['filter_title'] = $filter_title;
		$data['filter_product'] = $filter_product;
		$data['filter_status'] = $filter_status;
		$data['filter_view'] = $filter_view;
		$data['filter_reply'] = $filter_reply;
		$data['filter_general'] = $filter_general;
		$data['filter_date_added'] = $filter_date_added;
		$data['filter_date_modified'] = $filter_date_modified;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/question_list.tpl', $data));
	}

	protected function getForm() {
		$this->load->model('catalog/product');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['question_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_import_answer'] = $this->language->get('text_import_answer');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_answer'] = $this->language->get('entry_answer');
		$data['entry_general'] = $this->language->get('entry_general');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_product'] = $this->language->get('help_product');
		$data['help_title'] = $this->language->get('help_title');
		$data['help_answer'] = $this->language->get('help_answer');
		$data['help_general'] = $this->language->get('help_general');
		$data['help_more_products'] = $this->language->get('help_more_products');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
		}

		if (isset($this->error['answer'])) {
			$data['error_answer'] = $this->error['answer'];
		} else {
			$data['error_answer'] = array();
		}

		if (isset($this->error['product'])) {
			$data['error_product'] = $this->error['product'];
		} else {
			$data['error_product'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_general'])) {
			$url .= '&filter_general=' . $this->request->get['filter_general'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['question_id'])) {
			$data['action'] = $this->url->link('catalog/question/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/question/edit', 'token=' . $this->session->data['token'] . '&question_id=' . $this->request->get['question_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/question', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['question_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$question_info = $this->model_catalog_question->getQuestion($this->request->get['question_id']);
		}

		$data['token'] = $this->session->data['token'];

		// ------------------------------------------------------------------------
		$data['question_id'] = 0;
		$data['customer_prefered_language_id'] = $this->config->get('config_language_id');
		$data['original_question_description'] = '';
		$data['customer_name'] = '';
		$data['customer_email'] = '';
		$data['import_answer'] = false;

		if (isset($this->request->get['question_id'])) {
			$data['question_id'] = $this->request->get['question_id'];

			$customer_prefered_language_id = $this->model_catalog_question->getSenderPreferedLanguageByQuestionId($this->request->get['question_id']);

			$question_descriptions = $this->model_catalog_question->getQuestionDescriptions($this->request->get['question_id']);

			if (isset($question_descriptions[$customer_prefered_language_id]['description'])) {
				$data['original_question_description'] = html_entity_decode($question_descriptions[$customer_prefered_language_id]['description'], ENT_QUOTES, 'UTF-8');
			} else {
				$data['original_question_description'] = '';
			}

			$customer_info = $this->model_catalog_question->getSenderByQuestionId($this->request->get['question_id']);

			$data['customer_name'] = $customer_info['name'];
			$data['customer_email'] = $customer_info['email'];

			$total_reply = $this->model_catalog_question->getTotalRepliesByQuestionId($this->request->get['question_id']);

			if ($total_reply) {
				$data['import_answer'] = true;
			}
		}
		// --------------------------------------------------------------------------

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['question_description'])) {
			$data['question_description'] = $this->request->post['question_description'];
		} elseif (isset($this->request->get['question_id'])) {
			$data['question_description'] = $this->model_catalog_question->getQuestionDescriptions($this->request->get['question_id']);
		} else {
			$data['question_description'] = array();
		}

		if (isset($this->request->post['question_product'])) {
			$question_product = $this->request->post['question_product'];
		} elseif (isset($this->request->get['question_id'])) {
			$question_product = $this->model_catalog_question->getQuestionProducts($this->request->get['question_id']);
		} else {
			$question_product = array();
		}

		$data['question_products'] = array();

		foreach ($question_product as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['question_products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name'],
					'model' 		 => $product_info['model']
				);
			}
		}

		if (isset($this->request->post['general'])) {
			$data['general'] = $this->request->post['general'];
		} elseif (!empty($question_info)) {
			$data['general'] = $question_info['general'];
		} else {
			$data['general'] = '';
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($question_info)) {
			$data['sort_order'] = $question_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($question_info)) {
			$data['status'] = $question_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/question_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/question')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['question_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 255)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if (utf8_strlen($value['answer']) < 1) {
				$this->error['answer'][$language_id] = $this->language->get('error_answer');
			}
		}

		if ($this->request->post['general'] == 0) {
			if (!isset($this->request->post['question_product'])) {
				$this->error['product'] = $this->language->get('error_product');
			}

		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/question')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function reply() {
		$this->load->language('catalog/question_reply');
		$this->load->model('catalog/question');
		$this->load->model('catalog/product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$json) {
				if (utf8_strlen($this->request->post['answer']) < 20) {
					$json['error'] = $this->language->get('error_answer');
				}
			}

			if (!$json) {
				// BUILD STORE DETAILS
				if ($this->config->get('config_secure')) {
					$store_base_url = HTTPS_CATALOG;
				} else {
					$store_base_url = HTTP_CATALOG;
				}

				$store_name = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
				$store_logo = $store_base_url . 'image/' . $this->config->get('config_logo');

				// --------------------------------------------------------------------------------------
				// BUILD QUESTION RELATED THINGS
				$question_id = $this->request->post['question_id'];
				$answer = $this->request->post['answer'];

				$customer_prefered_language_id = $this->model_catalog_question->getSenderPreferedLanguageByQuestionId($question_id);

				// decide which language to use
				if ($this->config->get('product_question_answer_language_type') == 'customer-prefered-language') {
					$language_id = $customer_prefered_language_id;
				} else {
					$language_id = $this->config->get('product_question_answer_language_id');
				}

				// find who sent this question to send answer back
				$customer_info = $this->model_catalog_question->getSenderByQuestionId($question_id);

				// get original question text
				$question_descriptions = $this->model_catalog_question->getQuestionDescriptions($question_id);

				if (isset($question_descriptions[$customer_prefered_language_id]['description'])) {
					$original_question_description = $question_descriptions[$customer_prefered_language_id]['description'];
				} else {
					$original_question_description = '';
				}

				$is_general_question = $this->model_catalog_question->isGeneralQuestion($question_id);

				// General Question / Multiple products case
				$product_name = '';
				$product_url = '';

				if (!$is_general_question) {
					$related_products = $this->model_catalog_question->getQuestionProducts($question_id);

					if ($related_products) {
						if (count($related_products) == 1) {
							$product_id = $related_products[0];

							$this->load->model('catalog/product');

							$product_descriptions = $this->model_catalog_product->getProductDescriptions($product_id);

							if ($product_descriptions) {
								if (isset($product_descriptions[$language_id])) {
									$product_name = $product_descriptions[$language_id]['name'];
								}
							}

							$product_base_url = 'index.php?route=product/product&product_id=' . $product_id;

							$product_url = $store_base_url . $product_base_url;

							// find product seo keyword(s)
							if ($this->config->get('config_seo_url')) {
								$product_keywords_total = $this->model_catalog_question->getTotalProductKeywords($product_id);

								if ($product_keywords_total) {
									$keyword = false;

									// if is not custom multilanguage we have 1 keyword
									if ($product_keywords_total == 1) {
										$keyword = $this->model_catalog_question->getProductKeyword($product_id);
									} else {
										// case with multilanguage keywords from custom extensions
										$product_keywords = $this->model_catalog_question->getProductKeywords($product_id);

										if (isset($product_keywords[$language_id]['keyword'])) {
											$keyword = $product_keywords[$language_id]['keyword'];
										}
									}

									if ($keyword) {
										$product_url = $store_base_url . $keyword;
									}
								}
							}
						}
					}
				}

				$find = array(
					'{store.name}',
					'{store.url}',
					'{store.logo}',
					'{product.name}',
					'{product.url}',
					'{customer.name}',
					'{customer.email}',
					'{customer.telephone}',
					'{customer.ip}',
					'{question}',
					'{question.multiline}',
					'{answer}'
				);

				$replace = array(
					'store.name'         => $store_name,
					'store.url'          => $store_base_url,
					'store.logo'         => $store_logo,
					'product.name'       => html_entity_decode($product_name, ENT_QUOTES, 'UTF-8'),
					'product.url'        => $product_url,
					'customer.name'      => html_entity_decode($customer_info['name'], ENT_QUOTES, 'UTF-8'),
					'customer.email'     => html_entity_decode($customer_info['email'], ENT_QUOTES, 'UTF-8'),
					'customer.telephone' => html_entity_decode($customer_info['telephone'], ENT_QUOTES, 'UTF-8'),
					'customer.ip'        => html_entity_decode($customer_info['ip'], ENT_QUOTES, 'UTF-8'),
					'question'           => html_entity_decode($original_question_description, ENT_QUOTES, 'UTF-8'),
					'question.multiline' => html_entity_decode(nl2br($original_question_description), ENT_QUOTES, 'UTF-8'),
					'answer'             => html_entity_decode(nl2br($answer), ENT_QUOTES, 'UTF-8'),
				);

				$mail_templates = $this->config->get('product_question_mail');
				$subject_format = isset($mail_templates[$language_id]['customer_answer_subject']) ? $mail_templates[$language_id]['customer_answer_subject'] : '';
				$message_format = isset($mail_templates[$language_id]['customer_answer_message']) ? $mail_templates[$language_id]['customer_answer_message'] : '';

				$subject = str_replace($find, $replace, html_entity_decode($subject_format, ENT_QUOTES, 'UTF-8'));
				$message = str_replace($find, $replace, html_entity_decode($message_format, ENT_QUOTES, 'UTF-8'));

				// check email template to rebuild html structure
				$message = $this->model_catalog_question->ocx2HtmlTemplate($message);

				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
				$mail->smtp_username = $this->config->get('config_mail_smtp_username');
				$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail->smtp_port = $this->config->get('config_mail_smtp_port');
				$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

				$mail->setTo($customer_info['email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
				$mail->setSubject($subject);
				$mail->setHtml($message);
				$mail->send();

				// mark as replied
				$this->model_catalog_question->updateReplied($question_id);

				// save reply for later use
				$reply_data = array(
					'question_id' => $question_id,
					'description' => $answer,
					'language_id' => $language_id
				);

				$this->model_catalog_question->addReply($reply_data);

				$json['success'] = $this->language->get('text_success');
			}

		} else {  // GET REPLY FORM

			$this->model_catalog_question->updateViewed($this->request->get['question_id']);

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_question_about'] = $this->language->get('text_question_about');
			$data['text_general_question'] = $this->language->get('text_general_question');
			$data['text_multiple_products'] = $this->language->get('text_multiple_products');
			$data['text_select'] = $this->language->get('text_select');
			$data['text_or'] = $this->language->get('text_or');

			$data['entry_choose_answer'] = $this->language->get('entry_choose_answer');
			$data['entry_answer'] = $this->language->get('entry_answer');

			$data['button_send_answer'] = $this->language->get('button_send_answer');
			$data['button_import_answer'] = $this->language->get('button_import_answer');

			$question_info = $this->model_catalog_question->getQuestion($this->request->get['question_id']);

			if ($question_info) {
				$data['question_id'] = $question_info['question_id'];
				$data['question'] = html_entity_decode($question_info['description'], ENT_QUOTES, 'UTF-8');
				$data['customer_name'] = $question_info['name'];
				$data['customer_email'] = $question_info['email'];
				$data['date_added'] = date($this->language->get('date_format_short'), strtotime($question_info['date_added']));
				$data['general'] = $question_info['general'];

				if (!$question_info['general']) {
					$data['multiple_products'] = true;

					$question_products = $this->model_catalog_question->getQuestionProducts($question_info['question_id']);

					if ($question_products && count($question_products) == 1) {
						$product_id = $question_products[0];

						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							$data['product_name'] = $product_info['name'];
							$data['product_url'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id);

							$data['multiple_products'] = false;
						}
					} else {
						$products_list = array();

						foreach ($question_products as $product_id) {
							$product_info = $this->model_catalog_product->getProduct($product_id);

							if ($product_info) {
								$products_list[] = $product_info['name'];
							}
						}

						$data['products_list'] = implode(', ', $products_list);
					}
				}

				// get replies to same products - even from other questions ("predefined replies")
				$data['related_product_replies'] = array();

				$related_product_replies = $this->model_catalog_question->getRelatedProductReplies($question_info['question_id']);

				if ($related_product_replies) {
					foreach ($related_product_replies as $reply) {
						$data['related_product_replies'][] = array(
							'question_reply_id' => $reply['question_reply_id'],
							'question_id'       => $reply['question_id'],
							'description'       => $reply['description']
						);
					}
				}
			}

			$data['token'] = $this->session->data['token'];

			$json['output'] = $this->load->view('catalog/question_reply_form.tpl', $data);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getPredefinedReply() {
		$this->load->model('catalog/question');

		$json = array();

		$reply_info = $this->model_catalog_question->getReply($this->request->get['reply_id']);

		if ($reply_info) {
			$json['reply_message'] = html_entity_decode($reply_info['description'], ENT_QUOTES, 'UTF-8');
			$json['success'] = true;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function importReply() {
		$this->load->language('catalog/question');
		$this->load->model('catalog/question');

		$json = array();

		$reply_message = $this->model_catalog_question->getReplyMessageByQuestionIdAndLanguageId($this->request->get['question_id'], $this->request->get['language_id']);

		if ($reply_message) {
			$json['reply_message'] = html_entity_decode(nl2br($reply_message), ENT_QUOTES, 'UTF-8');
			$json['success'] = true;
		} else {
			$json['error'] = $this->language->get('error_no_import_reply');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}

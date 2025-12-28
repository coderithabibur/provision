<?php
class ControllerInformationContact extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('information/contact');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$mail = new Mail($this->config->get('config_mail_engine'));
			
			
			$mail->protocol = $this->config->get('config_mail_protocol');
			//$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($this->config->get('config_email'));
			

			
			
		
			$mail->setFrom($this->request->post['email']);
			$mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));  
			  
			$message='<tr  bgcolor="#ffffff"><td width="100" font-weight:normal; ">Name</td>';
			$message.='<td width="270" >'.$this->request->post['name'].'</td></tr>';
			
			$message.='<tr  bgcolor="#ffffff"><td width="100" font-weight:normal; ">Email</td>';
			$message.='<td width="270" >'.$this->request->post['email'].'</td></tr>';
			
			$message.='<tr  bgcolor="#ffffff"><td width="100" font-weight:normal; ">Phone Number</td>';
			$message.='<td width="270">'.$this->request->post['phone'].'</td></tr>';
			
			$message.='<tr  bgcolor="#ffffff"><td width="100" font-weight:normal; ">Subject</td>';
			$message.='<td width="270">'.$this->request->post['subject'].'</td></tr>';
			
			$message.='<tr  bgcolor="#ffffff"><td width="100" font-weight:normal; ">Message</td>';
			$message.='<td width="270">'.$this->request->post['enquiry'].'</td></tr>';
			
			
			$message = $this->getNotificationTheme($message,'Contact Form','');
			//echo $message; die; 
			$mail->setHtml($message);
			//$mail->setText($this->request->post['enquiry']. $mail->newline . 'Telephone: ' . $this->request->post['phone'].$mail->newline . 'Subject: ' . $this->request->post['subject']);
			
			echo $mail->send();

			$this->response->redirect($this->url->link('information/contact/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/contact')
		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_info'] = $this->language->get('text_info');
		$data['text_small'] = $this->language->get('text_small');

		$data['text_location'] = $this->language->get('text_location');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_open'] = $this->language->get('text_open');
		$data['text_comment'] = $this->language->get('text_comment');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_captcha'] = $this->language->get('entry_captcha');

		$data['button_map'] = $this->language->get('button_map');

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['enquiry'])) {
			$data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$data['error_enquiry'] = '';
		}
   
        if (isset($this->error['subject'])) {
			$data['error_subject'] = $this->error['subject'];
		} else {
			$data['error_subject'] = '';
		}
		
		if (isset($this->error['phone'])) {
			$data['error_phone'] = $this->error['phone'];
		} else {
			$data['error_phone'] = '';
		}
   
	   if (isset($this->error['captcha'])) {
			$data['error_captcha'] = $this->error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}
		$data['button_submit'] = $this->language->get('button_submit');

		$data['action'] = $this->url->link('information/contact');

		$this->load->model('tool/image');

		if ($this->config->get('config_image')) {
			$data['image'] = $this->model_tool_image->resize($this->config->get('config_image'), $this->config->get('config_image_location_width'), $this->config->get('config_image_location_height'));
		} else {
			$data['image'] = false;
		}

		$data['store'] = $this->config->get('config_name');
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['geocode'] = $this->config->get('config_geocode');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['e_mail'] = $this->config->get('config_email');		
		$data['fax'] = $this->config->get('config_fax');		
		$data['open'] = nl2br($this->config->get('config_open'));
		$data['comment'] = $this->config->get('config_comment');

		$data['locations'] = array();

		$this->load->model('localisation/location');

		foreach((array)$this->config->get('config_location') as $location_id) {
			$location_info = $this->model_localisation_location->getLocation($location_id);

			if ($location_info) {
				if ($location_info['image']) {
					$image = $this->model_tool_image->resize($location_info['image'], $this->config->get('config_image_location_width'), $this->config->get('config_image_location_height'));
				} else {
					$image = false;
				}

				$data['locations'][] = array(
					'location_id' => $location_info['location_id'],
					'name'        => $location_info['name'],
					'address'     => nl2br($location_info['address']),
					'geocode'     => $location_info['geocode'],
					'telephone'   => $location_info['telephone'],
					'fax'         => $location_info['fax'],
					'image'       => $image,
					'open'        => nl2br($location_info['open']),
					'comment'     => $location_info['comment']
				);
			}
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $this->customer->getEmail();
		}
		
		if (isset($this->request->post['subject'])) {
			$data['subject'] = $this->request->post['subject'];
		} else {
			$data['subject'] = '';
		} 
		
		 if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} else {
			$data['phone'] = $this->customer->getTelephone();
		} 

		if (isset($this->request->post['enquiry'])) {
			$data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$data['enquiry'] = '';
		}

	// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}
        
        // --- Contact Page Info Module ---
        // DEBUG: Check if module status is loaded
        // error_log('ContactPageInfo Status: ' . $this->config->get('contact_page_info_status'));
        
        $data['contact_page_info_status'] = $this->config->get('contact_page_info_status');

        if ($this->config->get('contact_page_info_status')) {
             // Main Title & Desc
             $main_title = $this->config->get('contact_page_info_main_title');
             $data['contact_main_title'] = !empty($main_title) ? $main_title : 'Contact Us';
             
             $main_desc = $this->config->get('contact_page_info_main_desc');
             $data['contact_main_desc'] = !empty($main_desc) ? nl2br($main_desc) : $data['address'];

             // Customer Service
            $cs_title = $this->config->get('contact_page_info_cs_title');
            if (!empty($cs_title)) { $data['cs_title'] = $cs_title; } else { $data['cs_title'] = 'Customer service'; }

            $cs_text = $this->config->get('contact_page_info_cs_text');
             if (!empty($cs_text)) { $data['cs_text'] = $cs_text; } else { $data['cs_text'] = 'Call us from 8am to 8pm'; }

            $cs_phone = $this->config->get('contact_page_info_cs_phone');
            if (!empty($cs_phone)) { $data['telephone'] = $cs_phone; } // Override global telephone for this page if set
            
             // Write To Us
            $wtu_title = $this->config->get('contact_page_info_wtu_title');
            if (!empty($wtu_title)) { $data['wtu_title'] = $wtu_title; } else { $data['wtu_title'] = 'Write to us'; }

            $wtu_email = $this->config->get('contact_page_info_wtu_email');
            if (!empty($wtu_email)) { $data['e_mail'] = $wtu_email; } // Override global email for this page

            // Follow Us
            $fu_title = $this->config->get('contact_page_info_fu_title');
            if (!empty($fu_title)) { $data['fu_title'] = $fu_title; } else { $data['fu_title'] = 'Follow us'; }

            $data['facebook'] = $this->config->get('contact_page_info_facebook');
            $data['youtube'] = $this->config->get('contact_page_info_youtube');
            $data['blogger'] = $this->config->get('contact_page_info_blogger');
            $data['instagram'] = $this->config->get('contact_page_info_instagram');

        } else {
             // Defaults if disabled - show nothing for custom vars? 
             // Logic: If disabled, we rely on template checking 'contact_page_info_status' to hide the 3-box section.
             // But for Header, we revert to default 'Contact Us' and 'Address'.
             
             $data['contact_main_title'] = 'contact us'; // Original lowercase hardcoded
             $data['contact_main_desc'] = $data['address'];
        }
        // --------------------------------

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/contact.tpl')) {
			
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/contact.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/contact.tpl', $data));
		}
	}

	public function success() {
		$this->load->language('information/contact');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/contact')
		);

		$data['heading_title'] = $this->language->get('heading_title');
        $data['text_detail'] = "";
		$data['text_message'] = $this->language->get('text_success');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}

	protected function validate() {
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (!preg_match('/^[A-Z0-9][a-zA-Z0-9 ]+$/i', $this->request->post['name'])){
			$this->error['name'] = /*$this->language->get('error_name_valide')*/ "Enter valid name!";
		}

		if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
			$this->error['enquiry'] = $this->language->get('error_enquiry');
		}
		
		if ((utf8_strlen($this->request->post['subject']) < 3) || (utf8_strlen($this->request->post['subject']) > 300)) {
		$this->error['subject'] = $this->language->get('error_subject');
		}
		
		if ((utf8_strlen($this->request->post['phone']) < 5) || (utf8_strlen($this->request->post['phone']) > 15) || empty($this->request->post['phone'])) {
			$this->error['phone'] = $this->language->get('error_phone');
		}

if (utf8_strlen($this->request->post['phone']) >1){ 
				if(!preg_match('/^[0-9]*$/', $this->request->post['phone'])){
					$this->error['phone'] = $this->language->get('error_phone');
				}
			}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		return !$this->error;
	}
	public function getNotificationTheme($message,$subject,$baseUrl)
	{
		//Notification themem file path.
		$filePath='catalog/view/theme/hidlighting/template/notification.theme.html';
		
		//Get HTML contents of theme file.
		$fileContents=file_get_contents($filePath);
		
		//Search with this patterns
		$searchPatterns[0]='<<!--currentdate-->>';
		$searchPatterns[1]='<<!--contents-->>';
		$searchPatterns[2]='<<!--subject-->>';
		$searchPatterns[3]='<<!--baseUrl-->>';
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$baseUrl = $this->config->get('config_ssl');
		} else {
			$baseUrl = $this->config->get('config_url');
		}
		
		//Replace with this values
		$replaceBy[0]=date("d F, Y h:i a");
		$replaceBy[1]=$message;
		$replaceBy[2]=$subject;
		$replaceBy[3]=$baseUrl;
		
		//Return the theme processed contents.
		return preg_replace($searchPatterns, $replaceBy, $fileContents);
	} 	
}

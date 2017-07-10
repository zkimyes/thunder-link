<?php
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		$this->event->trigger('pre.customer.add', $data);

		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['remail']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['account']) ? serialize($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['address']) ? serialize($data['custom_field']['address']) : '') . "'");

		$address_id = $this->db->getLastId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->load->language('mail/customer');

		//$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		//$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		//if (!$customer_group_info['approval']) {
		//	$message .= $this->language->get('text_login') . "\n";
		//} else {
		//	$message .= $this->language->get('text_approval') . "\n";
	//	}

		/*$message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();*/
        $contry = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$data['country_id']. "' AND status = '1'");
        $post['FristName'] = $data['firstname'];
        $post['LastName'] = $data['lastname'];
        $post['UserName'] = $data['remail'];
        $post['remail'] = $data['remail'];
        $post['Company'] = $data['company'];
        $post['CountryRegion'] = $contry->row['name'];
        $to_custom = $this->load->view($this->config->get('config_template') . '/mail/regiest-success-to-custom.html', $post);//给客户
        $json['info'] = $this->sendmail($post['remail'], "Welcome to Thunder-link.com", $to_custom);//给客户
        $post['ip'] = getIP();
        $tous = $this->load->view($this->config->get('config_template') . '/mail/regiest-success-to-us.html', $post);//给自己
        $json['info'] = $this->sendmail($this->config->get('config_mail_parameter'), "A new account has been created", $tous);//给自己
        $this->response->addHeader('Content-Type: application/json');



		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
				}
			}
		}

		$this->event->trigger('post.customer.add', $customer_id);

		return $customer_id;
	}

	public function editCustomer($data) {
		$this->event->trigger('pre.customer.edit', $data);

		$customer_id = $this->customer->getId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? serialize($data['custom_field']) : '') . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->event->trigger('post.customer.edit', $customer_id);
	}

	public function editPassword($email, $password) {
		$this->event->trigger('pre.customer.edit.password');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		$this->event->trigger('post.customer.edit.password');
	}

	public function editNewsletter($newsletter) {
		$this->event->trigger('pre.customer.edit.newsletter');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		$this->event->trigger('post.customer.edit.newsletter');
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");

		return $query->row;
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}

	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

	public function isBanIp($ip) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ban_ip` WHERE ip = '" . $this->db->escape($ip) . "'");

		return $query->num_rows;
	}
	
	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_login WHERE email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");
		
		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_login SET email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "customer_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE customer_login_id = '" . (int)$query->row['customer_login_id'] . "'");
		}			
	}	
	
	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}
	
	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}


    public function sendmail($to, $subject = '', $body = '')
    {

        $data['mailto'] = $to;
        $data['subject'] = $subject;
        $data['mailtext'] = $body;
        $data['mailuser'] = $this->config->get('config_mail_smtp_username');
        $data['mailpass'] = $this->config->get('config_mail_smtp_password');
        $rs = post('http://47.88.2.201:3000/sendmail',$data);
        /* date_default_timezone_set('Asia/Shanghai');//设定时区东八区
         require_once DIR_SYSTEM.'helper/class.phpmailer.php';
         require_once DIR_SYSTEM.'helper/class.smtp.php';
         $mail             = new PHPMailer(); //new一个PHPMailer对象出来
         // $body            = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
         $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
         $mail->IsSMTP(); // 设定使用SMTP服务
         $mail->SMTPDebug  = 1;                     // 启用SMTP调试功能
         // 1 = errors and messages
         // 2 = messages only
         $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
         //$mail->SMTPSecure = "ssl";                 // 安全协议，可以注释掉
         $mail->Host       = $this->config->get('config_mail_smtp_hostname');      // SMTP 服务器
         $mail->Port       = $this->config->get('config_mail_smtp_port');                   // SMTP服务器的端口号
         $mail->Username   = $this->config->get('config_mail_smtp_username');  // SMTP服务器用户名，PS：我乱打的
         $mail->Password   = $this->config->get('config_mail_smtp_password');            // SMTP服务器密码
         $mail->SetFrom($this->config->get('config_mail_parameter'), 'thunderlink');
         $mail->AddReplyTo($this->config->get('config_mail_alert'), 'thunderlink');
         $mail->Subject    = $subject;
         $mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test
         $mail->MsgHTML($body);
         $address = $to;
         $mail->AddAddress($address, '');*/
        if($rs != "succ") {
            return "Mail Not Send";
        } else {
            return 'Mail Send';
        }

    }
}



function GetIP()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return ($ip);
}


function post($url, $data)
{//file_get_content
    $postdata = http_build_query(
        $data
    );
    $opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);
    return $result;
}


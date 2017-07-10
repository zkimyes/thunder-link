<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/4
 * Time: 4:25
 */
class ControllerModuleQuote extends Controller
{
    public function index()
    {
        $data = array();
        $this->load->model('localisation/country');
        $data['contries'] = $this->model_localisation_country->getCountries();
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/quote.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/quote.tpl', $data);
        } else {
            return $this->load->view('default/template/module/quote.tpl', $data);
        }
    }


    public function sendQuote()
    {
        $post = $this->request->post;
        $verCode = $_SESSION['quoteVer'];
        if($post['quoteVer'] != $verCode){
            $this->response->addHeader('Content-Type: application/json');
            $json['status'] = 'error';
            $json['info'] = 'verification code error';
            $this->response->setOutput(json_encode($json));
        }else{
            $to_custom = $this->load->view($this->config->get('config_template') . '/mail/product-to-custom.html', $post);//给客户
            $json['info'] = $this->sendmail($post['Email'], "Your Enquiry has been recorded", $to_custom);//给客户
            $post['ip'] = getIP();
            $tous = $this->load->view($this->config->get('config_template') . '/mail/product-to-self.html', $post);//给自己
            $json['info'] = $this->sendmail($this->config->get('config_mail_parameter'), "The new enquiries", $tous);//给自己
            $this->response->addHeader('Content-Type: application/json');
            if ($json['info'] == 'Mail Send') {
                $json['status'] = 'success';
                $this->response->setOutput(json_encode($json));
            } else {
                $json['status'] = 'error';
                $this->response->setOutput(json_encode($json));
            }
        }

    }


    public function sendContact()
    {
        $post = $this->request->post;
        $verCode = $_SESSION['quoteContactVer'];
        if($post['ver'] != $verCode){
            $this->response->addHeader('Content-Type: application/json');
            $json['status'] = 'error';
            $json['info'] = 'verification code error-'.$verCode;
            $this->response->setOutput(json_encode($json));
        }else{
            $post['ip'] = getIP();
            $html = $this->load->view($this->config->get('config_template') . '/mail/online-chat.html', $post);
            $json['info'] = $this->sendmail($this->config->get('config_mail_parameter'), "Live Chat", $html);
            $this->response->addHeader('Content-Type: application/json');
            if ($json['info'] == 'Mail Send') {
                $json['status'] = 'success';
                $this->response->setOutput(json_encode($json));
            } else {
                $json['status'] = 'error';
                $this->response->setOutput(json_encode($json));
            }
        }
    }


    /**
     * 发送邮件
     * @param unknown_type $to
     * @param unknown_type $subject
     * @param unknown_type $body
     */
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





<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail extends MX_Controller {
    private $useSMTP = false;
    private $cc = false;
    private $bcc = false;
    private $attach = false;
    private $subject = 'Someone try to send mail without subject';
    public $send_from = 'public@mail.com';
    public $from_name = 'Error on Survey Software';
    public $send_to = 'admin@mail.com';
    public $return_path = 'skyview059@gmail.com';
    public $body;
    private $ip;

    public function __construct() {
        parent::__construct();
        $this->ip = $this->input->ip_address();
        $this->send_from = getSettingItem('OutgoingEmail');
        $this->return_path = getSettingItem('IncomingEmail');
        $this->from_name = getSettingItem('ComName');
    }

    public function index() {
        echo 'Nothing is here';
    }

    private function useEmailTeamplate($slug = '') {
        $data = $this->db->get_where('email_templates', ['slug' => $slug])->row();
        return $data;
    }

    private function filterEmailBody($template = null, $placeholders = array(0)) {
        if ($template && count($placeholders)) {
            foreach ($placeholders as $key => $value) {
                $template = str_replace('%' . $key . '%', $value, $template);
            }
        }
        return $template;
    }

    private function log() {
        $log_path = APPPATH . '/logs/mail_log.txt';
        $mail_log = date('Y-m-d H:i:s A') . ' | ' . $this->ip . ' | ' . $this->subject . "\r\n";
        file_put_contents($log_path, $mail_log, FILE_APPEND);
    }

    private function save_in_db($mail_type = 'general', $reciever_id = 0, $sender_id = 0, $parent_id = 0) {
        return true;
//        $data = [
//            'mail_type' => $mail_type,
//            'parent_id' => $parent_id,
//            'sender_id' => $sender_id,
//            'reciever_id' => $reciever_id,
//            'mail_from' => $this->send_from,
//            'mail_to' => $this->send_to,
//            'subject' => $this->subject,
//            'body' => $this->body,
//            'important' => 0,
//            'log' => '',
//            'created' => date('Y-m-d H:i:s'),
//            'folder_id' => 1,
//        ];
//        $this->db->insert('mails', $data);
    }

    private function send() {
        // $send_to, $subject, $body, $cc = false, $bcc = false, $attach = null
        $mail = new PHPMailer();

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.freelancerklub.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'noreply@freelancerklub.com';                     //SMTP username
            $mail->Password   = '.,lXQ^PO&;ME';                               //SMTP password
            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom($this->send_from, $this->from_name);
            $mail->addAddress($this->send_to);
            $mail->addReplyTo($this->send_from, $this->from_name);
    
            if($this->cc){ $mail->addCC($this->cc); }
            if($this->bcc){ $mail->addBCC($this->bcc); }
    
            $mail->isHTML(true);
    
            $mail->Subject  = $this->subject;
            $mail->Body     = $this->body;
            $mail->AltBody  = strip_tags($this->body);
            
            $mail->send();
            return ajaxRespond('OK', '<p class="ajax_success">Mail sent successfully</p>');
        } catch (Exception $e) {
            return ajaxRespond('Fail', '<p class="ajax_error">' . $mail->ErrorInfo . '</p>');
        }

       
    }
    
    public function test_mail() {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.freelancerklub.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'noreply@freelancerklub.com';                     //SMTP username
            $mail->Password   = '.,lXQ^PO&;ME';                               //SMTP password
            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('noreply@freelancerklub.com', 'Freelancer Klub - Service');
            $mail->addAddress('skyview059@gmail.com', 'Khairul Azam');
            $mail->addReplyTo('skyview059@gmail.com', 'Information');

            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function send_pwd_mail($array = array()) {
        $email = $array['email'];
        $token = $array['_token'];

        $user = $this->db->get_where('users', ['email' => $email])->row();
        $this->send_to = $email;
        $this->from_name = $user->full_name;

        $templateSender = $this->useEmailTeamplate('onRequestForgotPassword');
        $this->subject = $templateSender->title;

        $this->body = $this->filterEmailBody($templateSender->template, [
            'url' => base_url() . 'auth/reset_password?token=' . $token . '&email=' . $email,
            'fullname' => $user->full_name
        ]);

        $this->log();
        return $this->send();
    }

    private function welcomeMail($use_template = 'onRegistrationOther', $user_data = array()) {
        $this->send_from = get_admin_email();
        $this->send_to = $user_data['email'];
        $template = $this->useEmailTeamplate($use_template);
        $this->subject = $template->title;
        $this->body = $template->template;
        $this->from_name = getSettingItem('ComName');

        $this->body = $this->filterEmailBody($template->template, [
            'user_name' => $user_data['full_name'],
            'username' => $user_data['email'],
            'password' => $user_data['raw_pass'],
            'url' => base_url('my_account'),
        ]);

        $this->log();
        $this->save_in_db('WelcomeMail', $user_data['user_id'], 0, 0);
        $this->send();
    }
    
    public function send_error_report_to_dev($option = [])
    {
        $this->send_to  = 'freelancerklub@gmail.com';
        $this->subject  = "Error: {$this->from_name} URL: " . site_url();
        $this->body     = $option['body']; 
        $this->cc       = false;
        $this->send_cc  = false;
        $this->bcc      = false;
        $this->send_bcc = false;
        $this->send();
    }
        
}

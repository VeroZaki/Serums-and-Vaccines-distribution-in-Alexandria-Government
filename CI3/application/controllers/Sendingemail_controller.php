<?php
class Sendingemail_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
    }
    public function index() {
      $this->send_mail();
    }
    public function send_mail() {


            $config = array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'ssl://smtp.gmail.com',
                  'smtp_port' => 465,
                  'smtp_user' => 'West.District.Alex@gmail.com',
                  'smtp_pass' => 'westdistrict1234',
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1'
      );
      $this->email->initialize($config);
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");

      //Email content
      $htmlContent = '<h1>Sending email via Gmail SMTP server</h1>';
      $htmlContent .= '<p>This email has sent via Gmail SMTP server from CodeIgniter application.</p>';

      $this->email->to('Main.Inventory.Alexandria@gmail.com');
      $this->email->from('West.District.Alex@gmail.com','MyWebsite');
      $this->email->subject('Test');
      $this->email->message($htmlContent);

      //Send email
      $this->email->send();
}
}

?>

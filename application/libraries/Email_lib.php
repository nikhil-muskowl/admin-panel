<?php

class Email_lib {

    private $ci;
    public $fromEmail;
    public $fromName;
    public $toEmail;
    public $cc = array();
    public $subject;
    public $message;
    public $status;
    //setting
    public $smtpProtocol;
    public $smtpHost;
    public $smtpPort;
    public $smtpUser;
    public $smtpPass;
    public $smtpTimeout;
    public $mailType;
    public $charset;
    public $wordwrap;
    public $setNewline;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->library('settings_lib');

        $this->fromEmail = $this->ci->settings_lib->config('config', 'email');
        $this->fromName = $this->ci->settings_lib->config('config', 'name');

        $this->smtpProtocol = $this->ci->settings_lib->config('config', 'mail_protocol');
        $this->smtpHost = $this->ci->settings_lib->config('config', 'smtp_hostname');
        $this->smtpPort = $this->ci->settings_lib->config('config', 'smtp_port');
        $this->smtpUser = $this->ci->settings_lib->config('config', 'smtp_username');
        $this->smtpPass = $this->ci->settings_lib->config('config', 'smtp_password');
        $this->smtpTimeout = $this->ci->settings_lib->config('config', 'smtp_timeout');
        $this->mailType = 'html';
        $this->charset = 'utf-8';
        $this->wordwrap = TRUE;
        $this->setNewline = '\r\n';

        $config['protocol'] = $this->smtpProtocol;
        $config['smtp_host'] = $this->smtpHost;
        $config['smtp_port'] = $this->smtpPort;
        $config['smtp_user'] = $this->smtpUser;
        $config['smtp_pass'] = $this->smtpPass;
        $config['smtp_timeout'] = $this->smtpTimeout;
        $config['mailtype'] = $this->mailType;
        $config['charset'] = $this->charset;
        $config['wordwrap'] = $this->wordwrap;

        $this->ci->load->library('email', $config);
        $this->ci->email->clear();
        $this->ci->email->initialize($config);
        $this->ci->email->set_newline($this->setNewline);
        $this->ci->email->clear();
    }

    public function send() {
        $this->status = TRUE;

        $this->ci->email->from($this->fromEmail, $this->fromName);
        $this->ci->email->reply_to($this->fromEmail, $this->fromName);
        if ($this->toEmail):
            $this->ci->email->to($this->toEmail);
        else:
            $this->ci->email->to($this->fromEmail);
        endif;

        if ($this->cc):
            $this->ci->email->cc($this->cc);
        endif;
        $this->ci->email->subject($this->subject);
        $this->ci->email->message($this->message);

        if ($this->ci->email->send()):
            $this->status = TRUE;
        else:
            $this->status = FALSE;
        endif;

        return $this->status;
    }

}

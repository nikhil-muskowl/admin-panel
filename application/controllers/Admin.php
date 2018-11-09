<?php

class Admin extends CI_Controller {

    private $data = array();
    private $meta_title;

    public function __construct() {
        parent::__construct();
        $this->meta_title = humanize(__CLASS__);
    }

    public function index() {
        $this->data['ajax_login'] = base_url('user_module/api/users_api/login');
        $this->data['link_forgot_password'] = base_url('user_module/users/forgot_password');
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('user_module/login', $this->data);        
        
             
    }

}

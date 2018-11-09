<?php

class Dashboard extends CI_Controller {

    private $dataOutput;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
    }

    public function index() {
        $this->dataOutput = array();
        $this->dataOutput['sidebar'] = $this->sidebar->load();
        $this->dataOutput['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->dataOutput);
        $this->load->view('admin/common/navbar', $this->dataOutput);
        $this->load->view('admin/common/sidebar', $this->dataOutput);
        $this->load->view('admin/dashboard', $this->dataOutput);
        $this->load->view('admin/common/footer', $this->dataOutput);
    }

    public function logout() {
        $result = $this->users_lib->logout();
        if ($result):
            redirect('admin');
        endif;
    }

}

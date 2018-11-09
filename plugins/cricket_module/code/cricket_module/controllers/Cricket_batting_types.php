<?php

class Cricket_batting_types extends MX_Controller {

    private $data = array();
    private $error = array();
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('cricket_module/cricket_batting_types_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('cricket_module/api/cricket_batting_types_api/list');
        $this->data['ajax_delete'] = base_url('cricket_module/api/cricket_batting_types_api/delete');
        $this->data['ajax_form'] = base_url('cricket_module/cricket_batting_types/form');
        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_batting_types/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->cricket_batting_types_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['name']) && $result['name']) :
            $this->data['name'] = $result['name'];
        else:
            $this->data['name'] = '';
        endif;        

        $this->data['ajax_list'] = base_url('cricket_module/cricket_batting_types');
        $this->data['ajax_save'] = base_url('cricket_module/api/cricket_batting_types_api/save');
        $this->data['meta_title'] = $this->meta_title . ' ' . humanize(__FUNCTION__);
        $this->data['sidebar'] = $this->sidebar->load();
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_batting_types/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

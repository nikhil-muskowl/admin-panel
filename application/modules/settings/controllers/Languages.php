<?php

class Languages extends MX_Controller {

    private $data = array();
    private $error = array();
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->load->model('settings/languages_model');
        $this->meta_title = humanize(__CLASS__);
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('settings/api/languages_api/list');
        $this->data['ajax_delete'] = base_url('settings/api/languages_api/delete');
        $this->data['ajax_form'] = base_url('settings/languages/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('languages/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->languages_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['code']) && $result['code']) :
            $this->data['code'] = $result['code'];
        else:
            $this->data['code'] = '';
        endif;
        if (isset($result['name']) && $result['name']) :
            $this->data['name'] = $result['name'];
        else:
            $this->data['name'] = '';
        endif;
        if (isset($result['sort_order']) && $result['sort_order']) :
            $this->data['sort_order'] = $result['sort_order'];
        else:
            $this->data['sort_order'] = '';
        endif;

        $this->data['ajax_list'] = base_url('settings/languages');
        $this->data['ajax_save'] = base_url('settings/api/languages_api/save');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('languages/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

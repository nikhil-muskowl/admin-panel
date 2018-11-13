<?php

class Newsletters extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);

        $this->load->model('newsletters_module/newsletters_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('newsletters_module/api/newsletters_api/list');
        $this->data['ajax_delete'] = base_url('newsletters_module/api/newsletters_api/delete');
        $this->data['ajax_form'] = base_url('newsletters_module/newsletters/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('newsletters_module/newsletters/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->newsletters_model->getById($id);

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
        if (isset($result['email']) && $result['email']) :
            $this->data['email'] = $result['email'];
        else:
            $this->data['email'] = '';
        endif;
        if (isset($result['contact']) && $result['contact']) :
            $this->data['contact'] = $result['contact'];
        else:
            $this->data['contact'] = '';
        endif;
        if (isset($result['subscribe']) && $result['subscribe']) :
            $this->data['subscribe'] = $result['subscribe'];
        else:
            $this->data['subscribe'] = 0;
        endif;


        $this->data['subscribes'] = array(
            1 => 'yes',
            0 => 'no',
        );

        $this->data['ajax_list'] = base_url('newsletters_module/newsletters');
        $this->data['ajax_save'] = base_url('newsletters_module/api/newsletters_api/save');
        $this->data['ajax_image_form'] = base_url('newsletters_module/newsletters/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('newsletters_module/newsletters/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

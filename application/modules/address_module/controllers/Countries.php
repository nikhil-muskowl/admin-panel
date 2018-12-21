<?php

class Countries extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->lang->load('countries', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('address_module/countries_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('address_module/api/countries_api/list');
        $this->data['ajax_delete'] = base_url('address_module/api/countries_api/delete');
        $this->data['ajax_form'] = base_url('address_module/countries/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('countries/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->countries_model->getById($id);

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

        if (isset($result['iso_code_2']) && $result['iso_code_2']) :
            $this->data['iso_code_2'] = $result['iso_code_2'];
        else:
            $this->data['iso_code_2'] = '';
        endif;

        if (isset($result['iso_code_3']) && $result['iso_code_3']) :
            $this->data['iso_code_3'] = $result['iso_code_3'];
        else:
            $this->data['iso_code_3'] = '';
        endif;

        if (isset($result['address_format']) && $result['address_format']) :
            $this->data['address_format'] = $result['address_format'];
        else:
            $this->data['address_format'] = '';
        endif;

        if (isset($result['postcode_required']) && $result['postcode_required']) :
            $this->data['postcode_required'] = $result['postcode_required'];
        else:
            $this->data['postcode_required'] = '';
        endif;

        $this->data['ajax_list'] = base_url('address_module/countries');
        $this->data['ajax_save'] = base_url('address_module/api/countries_api/save');
        $this->data['ajax_image_form'] = base_url('address_module/countries/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('countries/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

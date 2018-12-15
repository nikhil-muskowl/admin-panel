<?php

class Addresses extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->lang->load('addresses', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('address_module/addresses_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('address_module/api/addresses_api/list');
        $this->data['ajax_delete'] = base_url('address_module/api/addresses_api/delete');
        $this->data['ajax_form'] = base_url('address_module/addresses/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('addresses/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->addresses_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = '';
        endif;

        if (isset($result['name']) && $result['name']) :
            $this->data['name'] = $result['name'];
        else:
            $this->data['name'] = '';
        endif;

        if (isset($result['contact']) && $result['contact']) :
            $this->data['contact'] = $result['contact'];
        else:
            $this->data['contact'] = '';
        endif;

        if (isset($result['address']) && $result['address']) :
            $this->data['address'] = $result['address'];
        else:
            $this->data['address'] = '';
        endif;

        if (isset($result['city']) && $result['city']) :
            $this->data['city'] = $result['city'];
        else:
            $this->data['city'] = '';
        endif;

        if (isset($result['postcode']) && $result['postcode']) :
            $this->data['postcode'] = $result['postcode'];
        else:
            $this->data['postcode'] = '';
        endif;

        if (isset($result['country_id']) && $result['country_id']) :
            $this->data['country_id'] = $result['country_id'];
        else:
            $this->data['country_id'] = '';
        endif;

        if (isset($result['zone_id']) && $result['zone_id']) :
            $this->data['zone_id'] = $result['zone_id'];
        else:
            $this->data['zone_id'] = '';
        endif;

        $this->data['ajax_list'] = base_url('address_module/addresses');
        $this->data['ajax_save'] = base_url('address_module/api/addresses_api/save');
        $this->data['ajax_image_form'] = base_url('address_module/addresses/image_form/');
        $this->data['ajax_zones'] = base_url('address_module/zones/load_dropdown/');

        $this->load->model('address_module/countries_model');
        $this->data['countries'] = $this->countries_model->getTables();

        $this->load->model('address_module/zones_model');
        $this->data['zones'] = $this->zones_model->getTables();

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('addresses/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

<?php

class Zones extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->lang->load('zones', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('address_module/zones_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('address_module/api/zones_api/list');
        $this->data['ajax_delete'] = base_url('address_module/api/zones_api/delete');
        $this->data['ajax_form'] = base_url('address_module/zones/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('zones/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->zones_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['country_id']) && $result['country_id']) :
            $this->data['country_id'] = $result['country_id'];
        else:
            $this->data['country_id'] = '';
        endif;

        if (isset($result['name']) && $result['name']) :
            $this->data['name'] = $result['name'];
        else:
            $this->data['name'] = '';
        endif;

        if (isset($result['code']) && $result['code']) :
            $this->data['code'] = $result['code'];
        else:
            $this->data['code'] = '';
        endif;

        $this->data['ajax_list'] = base_url('address_module/zones');
        $this->data['ajax_save'] = base_url('address_module/api/zones_api/save');
        $this->data['ajax_image_form'] = base_url('address_module/zones/image_form/');

        $this->load->model('address_module/countries_model');
        $this->data['countries'] = $this->countries_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('zones/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function load_dropdown($array = array()) {

        if (isset($array['country_id'])):
            $country_id = $array['country_id'];
        elseif ($this->input->post('country_id')):
            $country_id = $this->input->post('country_id');
        else:
            $country_id = 0;
        endif;

        if (isset($array['zone_id'])):
            $zone_id = $array['zone_id'];
        elseif ($this->input->post('zone_id')):
            $zone_id = $this->input->post('zone_id');
        else:
            $zone_id = 0;
        endif;

        $list = $this->zones_model->getByCountryId($country_id);
        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'name' => $object['name']
            );
        endforeach;
        $this->data['zone_id'] = $zone_id;
        $this->data['zones'] = $result;
        $this->load->view('zones/dropdown', $this->data);
    }

}

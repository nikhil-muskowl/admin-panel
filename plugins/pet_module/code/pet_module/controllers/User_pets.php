<?php

class User_pets extends MX_Controller {

    private $data;
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('pet_module/user_pets_model');

        $this->lang->load('user_pets', $this->languages_lib->getLanguage());

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('pet_module/api/user_pets_api/list');
        $this->data['ajax_delete'] = base_url('pet_module/api/user_pets_api/delete');
        $this->data['ajax_form'] = base_url('pet_module/user_pets/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('pet_module/user_pets/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->user_pets_model->getById($id);

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

        if (isset($result['pet_id']) && $result['pet_id']) :
            $this->data['pet_id'] = $result['pet_id'];
        else:
            $this->data['pet_id'] = '';
        endif;

        if (isset($result['level']) && $result['level']) :
            $this->data['level'] = $result['level'];
        else:
            $this->data['level'] = '';
        endif;


        $this->data['ajax_list'] = base_url('pet_module/user_pets');
        $this->data['ajax_save'] = base_url('pet_module/api/user_pets_api/save');
        $this->data['ajax_image_form'] = base_url('pet_module/user_pets/image_form/');

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->load->model('pet_module/pets_model');
        $this->data['pets'] = $this->pets_model->getTables();

        $this->load->model('pet_module/pet_levels_model');
        $this->data['pet_levels'] = $this->pet_levels_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('pet_module/user_pets/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

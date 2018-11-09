<?php

class Pet_levels extends MX_Controller {

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
        $this->load->model('pet_module/pet_levels_model');
        
        $this->lang->load('pet_levels', $this->languages_lib->getLanguage());

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('pet_module/api/pet_levels_api/list');
        $this->data['ajax_delete'] = base_url('pet_module/api/pet_levels_api/delete');
        $this->data['ajax_form'] = base_url('pet_module/pet_levels/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('pet_module/pet_levels/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->pet_levels_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
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
        
        if (isset($result['points']) && $result['points']) :
            $this->data['points'] = $result['points'];
        else:
            $this->data['points'] = '';
        endif;
        
        if (isset($result['image']) && $result['image']) :
            $this->data['image'] = $result['image'];
        else:
            $this->data['image'] = '';
        endif;


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['image_thumb'] = $this->custom_image->image_resize($this->data['image']);


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');

        $this->data['ajax_list'] = base_url('pet_module/pet_levels');
        $this->data['ajax_save'] = base_url('pet_module/api/pet_levels_api/save');

   
        $this->load->model('pet_module/pets_model');
        $this->data['pets'] = $this->pets_model->getTables();
          
        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('pet_module/pet_levels/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

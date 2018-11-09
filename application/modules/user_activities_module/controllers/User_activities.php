<?php

class User_activities extends MX_Controller {

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
        $this->lang->load('user_activities', $this->languages_lib->getLanguage());
        
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('user_activities_module/user_activities_model');
               
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('user_activities_module/api/user_activities_api/list');
        $this->data['ajax_delete'] = base_url('user_activities_module/api/user_activities_api/delete');
        $this->data['ajax_form'] = base_url('user_activities_module/user_activities/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_activities_module/user_activities/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->user_activities_model->getById($id);

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
        
        if (isset($result['type']) && $result['type']) :
            $this->data['type'] = $result['type'];
        else:
            $this->data['type'] = '';
        endif;
        
        if (isset($result['type_id']) && $result['type_id']) :
            $this->data['type_id'] = $result['type_id'];
        else:
            $this->data['type_id'] = '';
        endif;
        
        if (isset($result['text']) && $result['text']) :
            $this->data['text'] = $result['text'];
        else:
            $this->data['text'] = '';
        endif;        

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();        

        $this->data['ajax_list'] = base_url('user_activities_module/user_activities');
        $this->data['ajax_save'] = base_url('user_activities_module/api/user_activities_api/save');
        $this->data['ajax_image_form'] = base_url('user_activities_module/user_activities/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_activities_module/user_activities/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

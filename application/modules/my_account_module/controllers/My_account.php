<?php

class My_account extends MX_Controller {

    private $data = array();
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        $this->load->model('my_account_module/my_account_model');

        $this->meta_title = humanize(__CLASS__);
        $this->lang->load('my_account', $this->languages_lib->getLanguage());
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->data = array();
        $this->data['meta_title'] = $this->meta_title;

        $this->data['ajax_form'] = base_url('my_account_module/my_account/form');
        $this->data['ajax_delete'] = base_url('my_account_module/api/users_api/delete');
        $this->data['ajax_password_form'] = base_url('my_account_module/my_account/password_form');

        
        $result = $this->my_account_model->getById($this->users_lib->isLogged());
//        print_r($result);
//        exit;

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['user_group_id']) && $result['user_group_id']) :
            $this->data['user_group_id'] = $result['user_group_id'];
        else:
            $this->data['user_group_id'] = 0;
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

        if (isset($result['gender_id']) && $result['gender_id']) :
            $this->data['gender_id'] = $result['gender_id'];
        else:
            $this->data['gender_id'] = '';
        endif;

        if (isset($result['dob']) && $result['dob']) :
            $this->data['dob'] = $result['dob'];
        else:
            $this->data['dob'] = '';
        endif;


        if (isset($result['image']) && $result['image']) :
            $this->data['image'] = $result['image'];
        else:
            $this->data['image'] = '';
        endif;


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['image_thumb'] = $this->custom_image->image_resize($this->data['image']);

        if (isset($result['banner']) && $result['banner']) :
            $this->data['banner'] = $result['banner'];
        else:
            $this->data['banner'] = '';
        endif;
        $this->custom_image->width = $this->bannerWidth;
        $this->custom_image->height = $this->bannerHeight;
        $this->data['banner_thumb'] = $this->custom_image->image_resize($this->data['banner']);

        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');
        
        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('my_account_module/my_account/index', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }    

}

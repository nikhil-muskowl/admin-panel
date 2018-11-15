<?php

class Users extends MX_Controller {

    private $data = array();
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        $this->load->model('user_module/users_model');

        $this->meta_title = humanize(__CLASS__);
        $this->lang->load('user', $this->languages_lib->getLanguage());
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
        $this->data['ajax_list'] = base_url('user_module/api/users_api/list');
        $this->data['ajax_form'] = base_url('user_module/users/form');
        $this->data['ajax_delete'] = base_url('user_module/api/users_api/delete');
        $this->data['ajax_password_form'] = base_url('user_module/users/password_form');
        $this->data['ajax_change_status'] = base_url('user_module/api/users_api/change_status');


        $this->load->model('user_module/genders_model');
        $this->data['genders'] = $this->genders_model->getTables();

        $this->load->model('user_module/user_groups_model');
        $this->data['user_groups'] = $this->user_groups_model->getTables();

        $this->data['statuses'] = array(
            1 => 'yes',
            0 => 'no',
        );

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_module/users/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->data = array();
        $result = $this->users_model->getById($id);

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

        $this->load->model('user_module/genders_model');
        $this->data['genders'] = $this->genders_model->getTables();

        $this->load->model('user_module/user_groups_model');
        $this->data['user_groups'] = $this->user_groups_model->getTables();

        $this->data['meta_title'] = $this->meta_title;
        $this->data['ajax_list'] = base_url('user_module/users');
        $this->data['ajax_save'] = base_url('user_module/api/users_api/save');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_module/users/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function password_form($id = NULL) {
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->data = array();
        $result = $this->users_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = '';
        endif;

        $this->data['meta_title'] = 'Update Password';
        $this->data['ajax_list'] = base_url('user_module/users');
        $this->data['ajax_save'] = base_url('user_module/api/users_api/updatepassword');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_module/users/password_form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function forgot_password() {
        $this->data = array();
        $this->data['meta_title'] = $this->meta_title;
        $this->data['ajax_form'] = base_url('user_module/api/users_api/admin_forgot');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('user_module/forgot', $this->data);
    }

    public function update_password() {
        $this->data = array();
        if ($this->input->get('id') && $this->input->get('id') != ''):
            $id = $this->encryption->decrypt($this->input->get('id'));
        else:
            $id = 0;
        endif;
        $this->data['meta_title'] = $this->meta_title;
        $this->data['id'] = $id;
        $this->data['ajax_form'] = base_url('user_module/api/users_api/updatepassword');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('user_module/update_password', $this->data);
    }

}

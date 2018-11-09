<?php

class Pet_settings extends MX_Controller {

    private $meta_title;
    private $data;
    private $class_name;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->class_name = strtolower(__CLASS__);
    }

    public function index() {
        $this->data['meta_title'] = $this->meta_title;

        $this->data['ajax_list'] = base_url('pet_module/pet_settings');
        $this->data['ajax_save'] = base_url('pet_module/api/pet_settings_api/save');

        $this->data['register_points'] = $this->settings_lib->config('pet_module', 'register_points');
        $this->data['story_upload_points'] = $this->settings_lib->config('pet_module', 'story_upload_points');
        $this->data['story_comment_points'] = $this->settings_lib->config('pet_module', 'story_comment_points');
        $this->data['story_like_points'] = $this->settings_lib->config('pet_module', 'story_like_points');
        $this->data['story_dislike_points'] = $this->settings_lib->config('pet_module', 'story_dislike_points');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('pet_settings/form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

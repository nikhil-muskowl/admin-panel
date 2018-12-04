<?php

class Notification_settings extends MX_Controller {

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

        $this->data['ajax_list'] = base_url('notifications_module/notification_settings');
        $this->data['ajax_save'] = base_url('notifications_module/api/notification_settings_api/save');

        $this->data['fcm_key'] = $this->settings_lib->config('notifications_module', 'fcm_key');
        $this->data['pushy_key'] = $this->settings_lib->config('notifications_module', 'pushy_key');        

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('notifications_module/notification_settings/form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

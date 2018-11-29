<?php

class Leave_settings extends MX_Controller {

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

        $this->data['ajax_list'] = base_url('leave_managment_module/leave_settings');
        $this->data['ajax_save'] = base_url('leave_managment_module/api/leave_settings_api/save');

        $this->data['pending_id'] = $this->settings_lib->config('leave_managment_module', 'pending_id');
        $this->data['approved_id'] = $this->settings_lib->config('leave_managment_module', 'approved_id');
        $this->data['cancel_id'] = $this->settings_lib->config('leave_managment_module', 'cancel_id');
        
        $this->load->model('leave_managment_module/leave_statuses_model');
        $this->data['leave_statuses'] = $this->leave_statuses_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_settings/form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

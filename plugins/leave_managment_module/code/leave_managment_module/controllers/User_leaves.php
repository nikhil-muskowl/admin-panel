<?php

class User_leaves extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->lang->load('user_leaves', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('leave_managment_module/user_leaves_model');
    }

    public function index() {
        $this->user_leaves_model->assignLeaves();
        $this->data = array();
        $this->data['ajax_list'] = base_url('leave_managment_module/api/user_leaves_api/list');
        $this->data['ajax_delete'] = base_url('leave_managment_module/api/user_leaves_api/delete');
        $this->data['ajax_form'] = base_url('leave_managment_module/user_leaves/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/user_leaves/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->user_leaves_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = 0;
        endif;
        if (isset($result['leave_type_id']) && $result['leave_type_id']) :
            $this->data['leave_type_id'] = $result['leave_type_id'];
        else:
            $this->data['leave_type_id'] = 0;
        endif;

        if (isset($result['total']) && $result['total']) :
            $this->data['total'] = $result['total'];
        else:
            $this->data['total'] = 0;
        endif;

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->load->model('leave_managment_module/leave_types_model');
        $this->data['leave_types'] = $this->leave_types_model->getTables();
        
        $this->data['ajax_list'] = base_url('leave_managment_module/user_leaves');
        $this->data['ajax_save'] = base_url('leave_managment_module/api/user_leaves_api/save');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/user_leaves/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

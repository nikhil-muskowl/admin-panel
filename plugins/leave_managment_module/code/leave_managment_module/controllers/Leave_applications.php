<?php

class Leave_applications extends MX_Controller {

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
        $this->lang->load('leave_applications', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('leave_managment_module/leave_applications_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('leave_managment_module/api/leave_applications_api/list');
        $this->data['ajax_delete'] = base_url('leave_managment_module/api/leave_applications_api/delete');
        $this->data['ajax_preview'] = base_url('leave_managment_module/api/leave_applications_api/preview');
        $this->data['ajax_send'] = base_url('leave_managment_module/api/leave_applications_api/send');
        $this->data['ajax_form'] = base_url('leave_managment_module/leave_applications/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/leave_applications/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->leave_applications_model->getById($id);

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

        if (isset($result['leave_reason_id']) && $result['leave_reason_id']) :
            $this->data['leave_reason_id'] = $result['leave_reason_id'];
        else:
            $this->data['leave_reason_id'] = 0;
        endif;

        if (isset($result['leave_type_id']) && $result['leave_type_id']) :
            $this->data['leave_type_id'] = $result['leave_type_id'];
        else:
            $this->data['leave_type_id'] = 0;
        endif;
        if (isset($result['leave_status_id']) && $result['leave_status_id']) :
            $this->data['leave_status_id'] = $result['leave_status_id'];
        else:
            $this->data['leave_status_id'] = 0;
        endif;

        if (isset($result['from_date']) && $result['from_date']) :
            $this->data['from_date'] = date('d-m-Y H:i', strtotime($result['from_date']));
        else:
            $this->data['from_date'] = '';
        endif;

        if (isset($result['to_date']) && $result['to_date']) :
            $this->data['to_date'] = date('d-m-Y H:i', strtotime($result['to_date']));
        else:
            $this->data['to_date'] = '';
        endif;

        if (isset($result['total']) && $result['total']) :
            $this->data['total'] = $result['total'];
        else:
            $this->data['total'] = '';
        endif;
        if (isset($result['subject']) && $result['subject']) :
            $this->data['subject'] = $result['subject'];
        else:
            $this->data['subject'] = 'leave application';
        endif;
        if (isset($result['text']) && $result['text']) :
            $this->data['text'] = $result['text'];
        else:
            $this->data['text'] = '';
        endif;

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->load->model('leave_managment_module/leave_reasons_model');
        $this->data['leave_reasons'] = $this->leave_reasons_model->getTables();

        $this->load->model('leave_managment_module/leave_types_model');
        $this->data['leave_types'] = $this->leave_types_model->getTables();

        $this->load->model('leave_managment_module/leave_statuses_model');
        $this->data['leave_statuses'] = $this->leave_statuses_model->getTables();
        
        $this->data['ajax_list'] = base_url('leave_managment_module/leave_applications');
        $this->data['ajax_save'] = base_url('leave_managment_module/api/leave_applications_api/save');
        $this->data['ajax_date_days'] = base_url('leave_managment_module/api/leave_applications_api/dateToDay');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/leave_applications/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

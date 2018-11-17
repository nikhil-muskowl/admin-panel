<?php

class Penalties extends MX_Controller {

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
        $this->lang->load('penalties', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('penalties_module/penalties_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('penalties_module/api/penalties_api/list');
        $this->data['ajax_delete'] = base_url('penalties_module/api/penalties_api/delete');
        $this->data['ajax_form'] = base_url('penalties_module/penalties/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('penalties_module/penalties/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->penalties_model->getById($id);

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

        if (isset($result['penalty_reason_id']) && $result['penalty_reason_id']) :
            $this->data['penalty_reason_id'] = $result['penalty_reason_id'];
        else:
            $this->data['penalty_reason_id'] = 0;
        endif;

        if (isset($result['penalty_type_id']) && $result['penalty_type_id']) :
            $this->data['penalty_type_id'] = $result['penalty_type_id'];
        else:
            $this->data['penalty_type_id'] = 0;
        endif;
      
        if (isset($result['date']) && $result['date']) :
            $this->data['date'] = date('d-m-Y', strtotime($result['date']));
        else:
            $this->data['date'] = '';
        endif;
      
        if (isset($result['total']) && $result['total']) :
            $this->data['total'] = $result['total'];
        else:
            $this->data['total'] = '';
        endif;
        
        if (isset($result['subject']) && $result['subject']) :
            $this->data['subject'] = $result['subject'];
        else:
            $this->data['subject'] = '';
        endif;
        
        if (isset($result['text']) && $result['text']) :
            $this->data['text'] = $result['text'];
        else:
            $this->data['text'] = '';
        endif;

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->load->model('penalties_module/penalty_reasons_model');
        $this->data['penalty_reasons'] = $this->penalty_reasons_model->getTables();
        
        
        $this->data['ajax_list'] = base_url('penalties_module/penalties');
        $this->data['ajax_save'] = base_url('penalties_module/api/penalties_api/save');
        $this->data['ajax_date_days'] = base_url('penalties_module/api/penalties_api/dateToDay');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('penalties_module/penalties/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

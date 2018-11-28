<?php

class My_todo_lists extends MX_Controller {

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
        $this->lang->load('my_todo_lists', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('todo_lists_module/my_todo_lists_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('todo_lists_module/api/my_todo_lists_api/list');
        $this->data['ajax_delete'] = base_url('todo_lists_module/api/my_todo_lists_api/delete');       
        $this->data['ajax_send_mail'] = base_url('todo_lists_module/api/my_todo_lists_api/send_mail');
        $this->data['ajax_change_status'] = base_url('todo_lists_module/api/my_todo_lists_api/change_status');       
        $this->data['ajax_form'] = base_url('todo_lists_module/my_todo_lists/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');
        
        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();       

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('todo_lists_module/my_todo_lists/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->my_todo_lists_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
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
        
        $this->data['ajax_list'] = base_url('todo_lists_module/my_todo_lists');
        $this->data['ajax_save'] = base_url('todo_lists_module/api/my_todo_lists_api/save');
        $this->data['ajax_date_days'] = base_url('todo_lists_module/api/my_todo_lists_api/dateToDay');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('todo_lists_module/my_todo_lists/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

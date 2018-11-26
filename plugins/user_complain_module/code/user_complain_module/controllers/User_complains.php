<?php

class User_complains extends MX_Controller {

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
        $this->lang->load('user_complains', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('user_complain_module/user_complains_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('user_complain_module/api/user_complains_api/list');
        $this->data['ajax_delete'] = base_url('user_complain_module/api/user_complains_api/delete');
        $this->data['ajax_form'] = base_url('user_complain_module/user_complains/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_complain_module/user_complains/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->user_complains_model->getById($id);

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
        
        if (isset($result['complain_by']) && $result['complain_by']) :
            $this->data['complain_by'] = $result['complain_by'];
        else:
            $this->data['complain_by'] = 0;
        endif;
        
        if (isset($result['language_id']) && $result['language_id']) :
            $this->data['language_id'] = $result['language_id'];
        else:
            $this->data['language_id'] = $this->languages_lib->getLanguageId();
        endif;
        
        if (isset($result['title']) && $result['title']) :
            $this->data['title'] = $result['title'];
        else:
            $this->data['title'] = '';
        endif;
        if (isset($result['description']) && $result['description']) :
            $this->data['description'] = $result['description'];
        else:
            $this->data['description'] = '';
        endif;
       
        $this->data['ajax_list'] = base_url('user_complain_module/user_complains');
        $this->data['ajax_save'] = base_url('user_complain_module/api/user_complains_api/save');
        $this->data['ajax_image_form'] = base_url('user_complain_module/user_complains/image_form/');
          
        $this->load->model('user_complain_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_complain_module/user_complains/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

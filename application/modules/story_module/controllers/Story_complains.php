<?php

class Story_complains extends MX_Controller {

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
        $this->lang->load('story_complains', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('story_module/story_complains_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('story_module/api/story_complains_api/list');
        $this->data['ajax_delete'] = base_url('story_module/api/story_complains_api/delete');
        $this->data['ajax_form'] = base_url('story_module/story_complains/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('story_module/story_complains/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->story_complains_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;         
        
        if (isset($result['story_id']) && $result['story_id']) :
            $this->data['story_id'] = $result['story_id'];
        else:
            $this->data['story_id'] = 0;
        endif;
        
        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = 0;
        endif;
        
        if (isset($result['story_commnet_id']) && $result['story_commnet_id']) :
            $this->data['story_commnet_id'] = $result['story_commnet_id'];
        else:
            $this->data['story_commnet_id'] = 0;
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
       
        $this->data['ajax_list'] = base_url('story_module/story_complains');
        $this->data['ajax_save'] = base_url('story_module/api/story_complains_api/save');
        $this->data['ajax_image_form'] = base_url('story_module/story_complains/image_form/');
        
        $this->load->model('story_module/stories_model');
        $this->data['stories'] = $this->stories_model->getTables();
        
        $this->load->model('story_module/story_commnets_model');
        $this->data['story_commnets'] = $this->story_commnets_model->getTables();

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('story_module/story_complains/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

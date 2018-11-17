<?php

class Newsletter_mails extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);

        $this->load->model('newsletters_module/newsletter_mails_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('newsletters_module/api/newsletter_mails_api/list');
        $this->data['ajax_delete'] = base_url('newsletters_module/api/newsletter_mails_api/delete');
        $this->data['ajax_form'] = base_url('newsletters_module/newsletter_mails/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('newsletters_module/newsletter_mails/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->newsletter_mails_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['title']) && $result['title']) :
            $this->data['title'] = $result['title'];
        else:
            $this->data['title'] = '';
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
        if (isset($result['html']) && $result['html']) :
            $this->data['html'] = $result['html'];
        else:
            $this->data['html'] = '';
        endif;
        
        

        $this->data['ajax_list'] = base_url('newsletters_module/newsletter_mails');
        $this->data['ajax_save'] = base_url('newsletters_module/api/newsletter_mails_api/save');
        $this->data['ajax_image_form'] = base_url('newsletters_module/newsletter_mails/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('newsletters_module/newsletter_mails/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

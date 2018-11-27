<?php

class Faq_questions extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->lang->load('faq_questions', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('faq_module/faq_questions_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('faq_module/api/faq_questions_api/list');
        $this->data['ajax_delete'] = base_url('faq_module/api/faq_questions_api/delete');
        $this->data['ajax_form'] = base_url('faq_module/faq_questions/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('faq_module/faq_questions/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->faq_questions_model->getById($id);



        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;


        $this->data['ajax_list'] = base_url('faq_module/faq_questions');
        $this->data['ajax_save'] = base_url('faq_module/api/faq_questions_api/save');
        $this->data['ajax_image_form'] = base_url('faq_module/faq_questions/image_form/');


        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->faq_questions_model->details($id);

        $this->data['details'] = array();
        if ($languages):
            foreach ($languages as $value) :
                $text = '';
                if ($details):
                    $text = $details[$value['id']]['text'];
                endif;
                $this->data['details'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'text' => $text,
                );
            endforeach;
        endif;


        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('faq_module/faq_questions/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

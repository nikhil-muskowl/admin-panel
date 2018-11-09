<?php

class Holidays extends MX_Controller {

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
        $this->lang->load('holidays', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('leave_managment_module/holidays_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('leave_managment_module/api/holidays_api/list');
        $this->data['ajax_delete'] = base_url('leave_managment_module/api/holidays_api/delete');
        $this->data['ajax_form'] = base_url('leave_managment_module/holidays/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/holidays/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->holidays_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;
        if (isset($result['date']) && $result['date']) :
            $this->data['date'] = $result['date'];
        else:
            $this->data['date'] = 0;
        endif;


        $this->data['ajax_list'] = base_url('leave_managment_module/holidays');
        $this->data['ajax_save'] = base_url('leave_managment_module/api/holidays_api/save');
        $this->data['ajax_image_form'] = base_url('leave_managment_module/holidays/image_form/');


        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->holidays_model->details($id);

        $this->data['details'] = array();
        if ($languages):
            foreach ($languages as $value) :
                $title = '';
                if ($details):
                    $title = $details[$value['id']]['title'];
                endif;
                $this->data['details'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'title' => $title,
                );
            endforeach;
        endif;


        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/holidays/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

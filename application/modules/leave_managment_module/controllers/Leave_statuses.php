<?php

class Leave_statuses extends MX_Controller {

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
        $this->lang->load('leave_statuses', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('leave_managment_module/leave_statuses_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('leave_managment_module/api/leave_statuses_api/list');
        $this->data['ajax_delete'] = base_url('leave_managment_module/api/leave_statuses_api/delete');
        $this->data['ajax_form'] = base_url('leave_managment_module/leave_statuses/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('leave_managment_module/leave_statuses/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->leave_statuses_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;


        $this->data['ajax_list'] = base_url('leave_managment_module/leave_statuses');
        $this->data['ajax_save'] = base_url('leave_managment_module/api/leave_statuses_api/save');
        $this->data['ajax_image_form'] = base_url('leave_managment_module/leave_statuses/image_form/');


        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->leave_statuses_model->details($id);

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
        $this->load->view('leave_managment_module/leave_statuses/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

<?php

class Lengths extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('product_module/lengths_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('product_module/api/lengths_api/list');
        $this->data['ajax_delete'] = base_url('product_module/api/lengths_api/delete');
        $this->data['ajax_form'] = base_url('product_module/lengths/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_module/lengths/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->lengths_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;
        
        if (isset($result['sort_order']) && $result['sort_order']) :
            $this->data['sort_order'] = $result['sort_order'];
        else:
            $this->data['sort_order'] = 0;
        endif;

        $this->data['ajax_list'] = base_url('product_module/lengths');
        $this->data['ajax_save'] = base_url('product_module/api/lengths_api/save');
        $this->data['ajax_image_form'] = base_url('product_module/lengths/image_form/');

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->lengths_model->details($id);

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
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_module/lengths/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

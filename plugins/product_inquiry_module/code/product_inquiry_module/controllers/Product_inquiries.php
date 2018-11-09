<?php

class Product_inquiries extends MX_Controller {

    private $data;
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;
    private $language;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('product_inquiry_module/product_inquiries_model');

//        $this->language = $this->session->userdata('language');
//        $this->lang->load('product_inquiries', $this->language);

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('product_inquiry_module/api/product_inquiries_api/list');
        $this->data['ajax_delete'] = base_url('product_inquiry_module/api/product_inquiries_api/delete');
        $this->data['ajax_form'] = base_url('product_inquiry_module/product_inquiries/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_inquiry_module/product_inquiries/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->product_inquiries_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;
        if (isset($result['product_id']) && $result['product_id']) :
            $this->data['product_id'] = $result['product_id'];
        else:
            $this->data['product_id'] = 0;
        endif;

        $this->data['types'] = $this->product_inquiries_model->getTypes($id);

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

        if (isset($result['inquiry']) && $result['inquiry']) :
            $this->data['inquiry'] = $result['inquiry'];
        else:
            $this->data['inquiry'] = '';
        endif;

        $this->load->model('product_inquiry_module/product_inquiry_types_model');
        $this->data['inquiry_types'] = $this->product_inquiry_types_model->getTables();
        
        $this->load->model('product_module/products_model');
        $this->data['products'] = $this->products_model->getTables();

        $this->data['ajax_list'] = base_url('product_inquiry_module/product_inquiries');
        $this->data['ajax_save'] = base_url('product_inquiry_module/api/product_inquiries_api/save');
        $this->data['ajax_image_form'] = base_url('product_inquiry_module/product_inquiries/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_inquiry_module/product_inquiries/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

<?php

class Product_reviews extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('product_module/product_reviews_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('product_module/api/product_reviews_api/list');
        $this->data['ajax_delete'] = base_url('product_module/api/product_reviews_api/delete');
        $this->data['ajax_change_status'] = base_url('product_module/api/product_reviews_api/change_status');
        $this->data['ajax_form'] = base_url('product_module/product_reviews/form');


        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_module/product_reviews/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->product_reviews_model->getById($id);

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

        if (isset($result['product_id']) && $result['product_id']) :
            $this->data['product_id'] = $result['product_id'];
        else:
            $this->data['product_id'] = 0;
        endif;
        if (isset($result['rating_id']) && $result['rating_id']) :
            $this->data['rating_id'] = $result['rating_id'];
        else:
            $this->data['rating_id'] = 0;
        endif;

        if (isset($result['author']) && $result['author']) :
            $this->data['author'] = $result['author'];
        else:
            $this->data['author'] = '';
        endif;

        if (isset($result['rating']) && $result['rating']) :
            $this->data['rating'] = $result['rating'];
        else:
            $this->data['rating'] = '';
        endif;

        if (isset($result['comment']) && $result['comment']) :
            $this->data['comment'] = $result['comment'];
        else:
            $this->data['comment'] = '';
        endif;

        $this->data['ajax_list'] = base_url('product_module/product_reviews');
        $this->data['ajax_save'] = base_url('product_module/api/product_reviews_api/save');
        $this->data['ajax_image_form'] = base_url('product_module/product_reviews/image_form/');

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->load->model('product_module/products_model');
        $this->data['products'] = $this->products_model->getTables();
        
        $this->load->model('product_module/product_ratings_model');
        $this->data['product_ratings'] = $this->product_ratings_model->getTables();



        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_module/product_reviews/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

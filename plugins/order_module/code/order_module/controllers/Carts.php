<?php

class Carts extends MX_Controller {

    private $data;
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('order_module/carts_model');
        $this->lang->load('carts', $this->languages_lib->getLanguage());
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('order_module/api/carts_api/list');
        $this->data['ajax_delete'] = base_url('order_module/api/carts_api/delete');
        $this->data['ajax_form'] = base_url('order_module/carts/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('carts/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->carts_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['quantity']) && $result['quantity']) :
            $this->data['quantity'] = $result['quantity'];
        else:
            $this->data['quantity'] = 0;
        endif;

        $this->load->model('product_module/products_model');
        $this->data['products'] = $this->products_model->getTables();

        if (isset($result['product_id']) && $result['product_id']) :
            $this->data['product_id'] = $result['product_id'];
        else:
            $this->data['product_id'] = 0;
        endif;

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = 0;
        endif;


        $this->data['ajax_list'] = base_url('order_module/carts');
        $this->data['ajax_save'] = base_url('order_module/api/carts_api/save');
        $this->data['ajax_image_form'] = base_url('order_module/carts/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('carts/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function product_list() {
        $this->data = array();
        $this->data['carts'] = array();

        if ($this->input->post('user_id')):
            $list = $this->carts_model->getTables();

            foreach ($list as $object) :
                if (isset($object['product_image']) && $object['product_image']) {
                    $product_image = $object['product_image'];
                } else {
                    $product_image = 'upload/images/placeholder.png';
                }
                $this->custom_image->width = $this->imageWidth;
                $this->custom_image->height = $this->imageHeight;
                $product_image_thumb = $this->custom_image->image_resize($product_image);


                $this->data['carts'][] = array(
                    'id' => $object['id'],
                    'product_id' => $object['product_id'],
                    'product_name' => $object['product_name'],
                    'product_image' => base_url($product_image),
                    'product_image_thumb' => $product_image_thumb,
                    'model' => $object['model'],
                    'price' => $this->settings_lib->number_format($object['price']),
                    'quantity' => $this->settings_lib->number_format($object['quantity']),
                    'total' => $this->settings_lib->number_format($object['price'] * $object['quantity']),
                    'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                    'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                    'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
                );
            endforeach;
        endif;
        $this->load->view('carts/product_list', $this->data);
    }

}

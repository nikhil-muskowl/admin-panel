<?php

class Orders extends MX_Controller {

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
        $this->load->model('order_module/orders_model');
        $this->lang->load('orders', $this->languages_lib->getLanguage());
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('order_module/api/orders_api/list');
        $this->data['ajax_delete'] = base_url('order_module/api/orders_api/delete');
        $this->data['ajax_form'] = base_url('order_module/orders/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('orders/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->orders_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['invoice_no']) && $result['invoice_no']) :
            $this->data['invoice_no'] = $result['invoice_no'];
        else:
            $this->data['invoice_no'] = '';
        endif;

        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = '';
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

        if (isset($result['payment_name']) && $result['payment_name']) :
            $this->data['payment_name'] = $result['payment_name'];
        else:
            $this->data['payment_name'] = '';
        endif;

        if (isset($result['payment_country']) && $result['payment_country']) :
            $this->data['payment_country'] = $result['payment_country'];
        else:
            $this->data['payment_country'] = '';
        endif;

        if (isset($result['payment_country_id']) && $result['payment_country_id']) :
            $this->data['payment_country_id'] = $result['payment_country_id'];
        else:
            $this->data['payment_country_id'] = '';
        endif;

        if (isset($result['payment_zone']) && $result['payment_zone']) :
            $this->data['payment_zone'] = $result['payment_zone'];
        else:
            $this->data['payment_zone'] = '';
        endif;

        if (isset($result['payment_zone_id']) && $result['payment_zone_id']) :
            $this->data['payment_zone_id'] = $result['payment_zone_id'];
        else:
            $this->data['payment_zone_id'] = '';
        endif;

        if (isset($result['payment_city']) && $result['payment_city']) :
            $this->data['payment_city'] = $result['payment_city'];
        else:
            $this->data['payment_city'] = '';
        endif;

        if (isset($result['payment_postcode']) && $result['payment_postcode']) :
            $this->data['payment_postcode'] = $result['payment_postcode'];
        else:
            $this->data['payment_postcode'] = '';
        endif;

        if (isset($result['payment_address']) && $result['payment_address']) :
            $this->data['payment_address'] = $result['payment_address'];
        else:
            $this->data['payment_address'] = '';
        endif;

        if (isset($result['payment_method']) && $result['payment_method']) :
            $this->data['payment_method'] = $result['payment_method'];
        else:
            $this->data['payment_method'] = '';
        endif;

        if (isset($result['payment_code']) && $result['payment_code']) :
            $this->data['payment_code'] = $result['payment_code'];
        else:
            $this->data['payment_code'] = '';
        endif;

        if (isset($result['shipping_name']) && $result['shipping_name']) :
            $this->data['shipping_name'] = $result['shipping_name'];
        else:
            $this->data['shipping_name'] = '';
        endif;
        if (isset($result['shipping_country']) && $result['shipping_country']) :
            $this->data['shipping_country'] = $result['shipping_country'];
        else:
            $this->data['shipping_country'] = '';
        endif;
        if (isset($result['shipping_country_id']) && $result['shipping_country_id']) :
            $this->data['shipping_country_id'] = $result['shipping_country_id'];
        else:
            $this->data['shipping_country_id'] = '';
        endif;
        if (isset($result['shipping_zone']) && $result['shipping_zone']) :
            $this->data['shipping_zone'] = $result['shipping_zone'];
        else:
            $this->data['shipping_zone'] = '';
        endif;
        if (isset($result['shipping_zone_id']) && $result['shipping_zone_id']) :
            $this->data['shipping_zone_id'] = $result['shipping_zone_id'];
        else:
            $this->data['shipping_zone_id'] = '';
        endif;
        if (isset($result['shipping_city']) && $result['shipping_city']) :
            $this->data['shipping_city'] = $result['shipping_city'];
        else:
            $this->data['shipping_city'] = '';
        endif;
        if (isset($result['shipping_postcode']) && $result['shipping_postcode']) :
            $this->data['shipping_postcode'] = $result['shipping_postcode'];
        else:
            $this->data['shipping_postcode'] = '';
        endif;
        if (isset($result['shipping_address']) && $result['shipping_address']) :
            $this->data['shipping_address'] = $result['shipping_address'];
        else:
            $this->data['shipping_address'] = '';
        endif;
        if (isset($result['shipping_method']) && $result['shipping_method']) :
            $this->data['shipping_method'] = $result['shipping_method'];
        else:
            $this->data['shipping_method'] = '';
        endif;
        if (isset($result['shipping_code']) && $result['shipping_code']) :
            $this->data['shipping_code'] = $result['shipping_code'];
        else:
            $this->data['shipping_code'] = '';
        endif;

        $this->load->model('product_module/products_model');
        $this->data['products'] = $this->products_model->getTables();


        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = 0;
        endif;

        $this->data['quantity'] = 1;

        $this->data['ajax_list'] = base_url('order_module/orders');
        $this->data['ajax_save'] = base_url('order_module/api/orders_api/save');
        $this->data['ajax_image_form'] = base_url('order_module/orders/image_form/');


        $this->load->model('address_module/countries_model');
        $this->data['countries'] = $this->countries_model->getTables();

        $this->data['ajax_zones'] = base_url('address_module/zones/load_dropdown/');
        $this->data['ajax_users'] = base_url('user_module/api/users_api/detail/');
        $this->data['ajax_address'] = base_url('address_module/addresses/load_dropdown/');
        $this->data['ajax_address_info'] = base_url('address_module/api/addresses_api/detail/');


        $this->data['ajax_get_cart'] = base_url('order_module/api/carts_api/');
        $this->data['ajax_add_cart'] = base_url('order_module/api/carts_api/save/');
        $this->data['ajax_edit_cart'] = base_url('order_module/api/carts_api/edit/');
        $this->data['ajax_delete_cart'] = base_url('order_module/api/carts_api/delete/');
        $this->data['ajax_cart_product'] = base_url('order_module/carts/product_list/');

        $this->load->model('address_module/zones_model');
        $this->data['zones'] = $this->zones_model->getTables();

        $this->load->model('product_module/products_model');
        $this->data['products'] = $this->products_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('orders/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

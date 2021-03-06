<?php

class Products extends MX_Controller {

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
        $this->load->model('product_module/products_model');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('product_module/api/products_api/list');
        $this->data['ajax_delete'] = base_url('product_module/api/products_api/delete');
        $this->data['ajax_form'] = base_url('product_module/products/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_module/products/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->products_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        $this->data['categories'] = $this->products_model->getCategories($id);

        if (isset($result['model']) && $result['model']) :
            $this->data['model'] = $result['model'];
        else:
            $this->data['model'] = '';
        endif;
        if (isset($result['sku']) && $result['sku']) :
            $this->data['sku'] = $result['sku'];
        else:
            $this->data['sku'] = '';
        endif;

        if (isset($result['price_type']) && $result['price_type']) :
            $this->data['price_type'] = $result['price_type'];
        else:
            $this->data['price_type'] = '';
        endif;
        
        if (isset($result['price']) && $result['price']) :
            $this->data['price'] = $this->settings_lib->number_format($result['price']);
        else:
            $this->data['price'] = $this->settings_lib->number_format(0);
        endif;

        if (isset($result['quantity']) && $result['quantity']) :
            $this->data['quantity'] = $this->settings_lib->number_format($result['quantity']);
        else:
            $this->data['quantity'] = $this->settings_lib->number_format(0);
        endif;

        if (isset($result['weight_class_id']) && $result['weight_class_id']) :
            $this->data['weight_class_id'] = $result['weight_class_id'];
        else:
            $this->data['weight_class_id'] = 0;
        endif;

        if (isset($result['weight']) && $result['weight']) :
            $this->data['weight'] = $this->settings_lib->number_format($result['weight']);
        else:
            $this->data['weight'] = $this->settings_lib->number_format(0);
        endif;

        if (isset($result['length_class_id']) && $result['length_class_id']) :
            $this->data['length_class_id'] = $result['length_class_id'];
        else:
            $this->data['length_class_id'] = 0;
        endif;

        if (isset($result['length']) && $result['length']) :
            $this->data['length'] = $this->settings_lib->number_format($result['length']);
        else:
            $this->data['length'] = $this->settings_lib->number_format(0);
        endif;
        if (isset($result['width']) && $result['width']) :
            $this->data['width'] = $this->settings_lib->number_format($result['width']);
        else:
            $this->data['width'] = $this->settings_lib->number_format(0);
        endif;
        if (isset($result['height']) && $result['height']) :
            $this->data['height'] = $this->settings_lib->number_format($result['height']);
        else:
            $this->data['height'] = $this->settings_lib->number_format(0);
        endif;

        if (isset($result['image']) && $result['image']) :
            $this->data['image'] = $result['image'];
        else:
            $this->data['image'] = '';
        endif;


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['image_thumb'] = $this->custom_image->image_resize($this->data['image']);

        if (isset($result['banner']) && $result['banner']) :
            $this->data['banner'] = $result['banner'];
        else:
            $this->data['banner'] = '';
        endif;
        $this->custom_image->width = $this->bannerWidth;
        $this->custom_image->height = $this->bannerHeight;
        $this->data['banner_thumb'] = $this->custom_image->image_resize($this->data['banner']);

        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();
        $this->data['languages'] = $languages;


        $details = $this->products_model->details($id);

        $this->data['details'] = array();
        if ($languages):
            foreach ($languages as $value) :
                if (isset($details[$value['id']]['title'])):
                    $title = $details[$value['id']]['title'];
                else:
                    $title = '';
                endif;

                if (isset($details[$value['id']]['description'])):
                    $description = $details[$value['id']]['description'];
                else:
                    $description = '';
                endif;

                if (isset($details[$value['id']]['html'])):
                    $html = $details[$value['id']]['html'];
                else:
                    $html = '';
                endif;

                $this->data['details'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'title' => $title,
                    'description' => $description,
                    'html' => $html,
                );
            endforeach;
        endif;

        $images = $this->products_model->images($id);
        $imagesData = array();

        if ($images):
            foreach ($images as $value) :
                $this->custom_image->width = $this->imageWidth;
                $this->custom_image->height = $this->imageHeight;
                if (isset($value['image']) && $value['image'] != '') {
                    $image = $value['image'];
                } else {
                    $image = '';
                }

                $image_thumb = $this->custom_image->image_resize($image);

                $imagesData[] = array(
                    'image' => $image,
                    'image_thumb' => $image_thumb,
                    'link' => $value['link'],
                    'sort_order' => $value['sort_order'],
                    'status' => $value['status'],
                );
            endforeach;
        endif;

        $this->data['images'] = $imagesData;


        $this->data['product_attributes'] = $this->products_model->getAttributes($id);


        $this->load->model('product_module/categories_model');
        $this->data['product_categories'] = $this->categories_model->getTables();

        $this->load->model('product_module/attributes_model');
        $this->data['attributes'] = $this->attributes_model->getTables();

        $this->load->model('product_module/weights_model');
        $this->data['weights'] = $this->weights_model->getTables();

        $this->load->model('product_module/lengths_model');
        $this->data['lengths'] = $this->lengths_model->getTables();


        $this->data['price_types'] = array(
            'base' => 'Base',
            'weight' => 'Weight',
            'length' => 'Length',
        );


        $url_alias = $this->products_model->getUrlAlias($id);

        $this->data['url_alias'] = array();
        if ($languages):
            foreach ($languages as $value) :
                if (isset($url_alias[$value['id']]['keyword'])):
                    $keyword = $url_alias[$value['id']]['keyword'];
                else:
                    $keyword = '';
                endif;

                if (isset($url_alias[$value['id']]['meta_title'])):
                    $meta_title = $url_alias[$value['id']]['meta_title'];
                else:
                    $meta_title = '';
                endif;

                if (isset($url_alias[$value['id']]['meta_keyword'])):
                    $meta_keyword = $url_alias[$value['id']]['meta_keyword'];
                else:
                    $meta_keyword = '';
                endif;

                if (isset($url_alias[$value['id']]['meta_description'])):
                    $meta_description = $url_alias[$value['id']]['meta_description'];
                else:
                    $meta_description = '';
                endif;

                $this->data['url_alias'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'keyword' => $keyword,
                    'meta_title' => $meta_title,
                    'meta_keyword' => $meta_keyword,
                    'meta_description' => $meta_description,
                );
            endforeach;
        endif;

        $this->data['ajax_list'] = base_url('product_module/products');
        $this->data['ajax_save'] = base_url('product_module/api/products_api/save');
        $this->data['ajax_image_form'] = base_url('product_module/products/image_form/');
        $this->data['ajax_attribute_form'] = base_url('product_module/products/attribute_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('product_module/products/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function image_form($id = NULL) {
        $this->data = array();
        if (isset($id)) {
            $this->data['images_row'] = $id;
        } else {
            $this->data['images_row'] = 1;
        }
        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');
        $this->load->view('product_module/products/add_image_form', $this->data);
    }

    public function attribute_form($id = NULL) {
        $this->data = array();
        if (isset($id)) {
            $this->data['attributes_row'] = $id;
        } else {
            $this->data['attributes_row'] = 1;
        }
        $this->load->model('settings/languages_model');
        $this->data['languages'] = $this->languages_model->getTables();

        $this->load->model('product_module/attributes_model');
        $this->data['attributes'] = $this->attributes_model->getTables();

        $this->load->view('product_module/products/add_attributes_form', $this->data);
    }

}

<?php

class Categories extends MX_Controller {

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
        $this->load->model('product_module/categories_model');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('product_module/api/categories_api/list');
        $this->data['ajax_delete'] = base_url('product_module/api/categories_api/delete');
        $this->data['ajax_form'] = base_url('product_module/categories/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('categories/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->categories_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['image']) && $result['image']) :
            $this->data['image'] = $result['image'];
        else:
            $this->data['image'] = '';
        endif;
        if (isset($result['parent_id']) && $result['parent_id']) :
            $this->data['parent_id'] = $result['parent_id'];
        else:
            $this->data['parent_id'] = '';
        endif;

        $this->data['product_categories'] = $this->categories_model->getTables();

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

        $details = $this->categories_model->details($id);

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
        
        $url_alias = $this->categories_model->getUrlAlias($id);

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

        
        $this->data['ajax_list'] = base_url('product_module/categories');
        $this->data['ajax_save'] = base_url('product_module/api/categories_api/save');
        $this->data['ajax_image_form'] = base_url('product_module/categories/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('categories/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

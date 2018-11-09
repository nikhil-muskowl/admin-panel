<?php

class Advertisements extends MX_Controller {

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
        $this->load->model('advertisement_module/advertisements_model');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('advertisement_module/api/advertisements_api/list');
        $this->data['ajax_delete'] = base_url('advertisement_module/api/advertisements_api/delete');
        $this->data['ajax_form'] = base_url('advertisement_module/advertisements/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('advertisement_module/advertisements/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->advertisements_model->getById($id);

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

        $this->data['types'] = $this->advertisements_model->getTypes($id);
        $this->data['tags'] = $this->advertisements_model->getTags($id);

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

        $details = $this->advertisements_model->details($id);

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

        $url_alias = $this->advertisements_model->getUrlAlias($id);

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

        $images = $this->advertisements_model->images($id);
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

        $this->load->model('advertisement_module/advertisement_types_model');
        $this->data['advertisement_types'] = $this->advertisement_types_model->getTables();

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();
        
        $this->data['ajax_list'] = base_url('advertisement_module/advertisements');
        $this->data['ajax_save'] = base_url('advertisement_module/api/advertisements_api/save');
        $this->data['ajax_image_form'] = base_url('advertisement_module/advertisements/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('advertisement_module/advertisements/form', $this->data);
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
        $this->load->view('advertisement_module/advertisements/add_image_form', $this->data);
    }

}

<?php

class Testimonials extends MX_Controller {

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
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('testimonial_module/testimonials_model');

        $this->lang->load('testimonials', $this->languages_lib->getLanguage());
        
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('testimonial_module/api/testimonials_api/list');
        $this->data['ajax_delete'] = base_url('testimonial_module/api/testimonials_api/delete');
        $this->data['ajax_form'] = base_url('testimonial_module/testimonials/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('testimonial_module/testimonials/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->testimonials_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['author']) && $result['author']) :
            $this->data['author'] = $result['author'];
        else:
            $this->data['author'] = '';
        endif;

        if (isset($result['role']) && $result['role']) :
            $this->data['role'] = $result['role'];
        else:
            $this->data['role'] = '';
        endif;

        $this->data['thumb'] = $this->custom_image->image_resize('');

        if (isset($result['image']) && $result['image']) :
            $this->data['image'] = $result['image'];
        else:
            $this->data['image'] = '';
        endif;

        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['image_thumb'] = $this->custom_image->image_resize($this->data['image']);



        if (isset($result['text']) && $result['text']) :
            $this->data['text'] = $result['text'];
        else:
            $this->data['text'] = '';
        endif;

        if (isset($result['language_id']) && $result['language_id']) :
            $this->data['language_id'] = $result['language_id'];
        else:
            $this->data['language_id'] = '';
        endif;

        $this->data['ajax_list'] = base_url('testimonial_module/testimonials');
        $this->data['ajax_save'] = base_url('testimonial_module/api/testimonials_api/save');

        $this->load->model('settings/languages_model');
        $this->data['languages'] = $this->languages_model->getTables();

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('testimonial_module/testimonials/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

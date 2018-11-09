<?php

class Notifications extends MX_Controller {

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
        $this->load->model('notifications_module/notifications_model');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('notifications_module/api/notifications_api/list');
        $this->data['ajax_delete'] = base_url('notifications_module/api/notifications_api/delete');
        $this->data['ajax_form'] = base_url('notifications_module/notifications/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('notifications_module/notifications/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->notifications_model->getById($id);

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


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['image_thumb'] = $this->custom_image->image_resize($this->data['image']);


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->notifications_model->details($id);

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

                $this->data['details'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'title' => $title,
                    'description' => $description,
                );
            endforeach;
        endif;


        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->data['notification_users'] = $this->notifications_model->getUsers($id);

        $this->data['ajax_list'] = base_url('notifications_module/notifications');
        $this->data['ajax_save'] = base_url('notifications_module/api/notifications_api/save');
        $this->data['ajax_image_form'] = base_url('notifications_module/notifications/image_form/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('notifications_module/notifications/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

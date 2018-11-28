<?php

class Update_password extends MX_Controller {

    private $data = array();
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        $this->load->model('my_account_module/my_account_model');

        $this->meta_title = humanize(__CLASS__);
        $this->lang->load('my_account', $this->languages_lib->getLanguage());
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->data = array();
        $this->data['meta_title'] = $this->meta_title;

        $this->data['ajax_form'] = base_url('user_module/api/users_api/updatepassword');

        $result = $this->my_account_model->getById($this->users_lib->isLogged());

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('my_account_module/update_password/index', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

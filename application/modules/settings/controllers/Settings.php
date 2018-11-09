<?php

class Settings extends MX_Controller {

    private $meta_title;
    private $data;
    private $filter_data;
    private $class_name;

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
        $this->class_name = strtolower(__CLASS__);
    }

    public function index() {
        $this->data['meta_title'] = $this->meta_title;

        $this->data['ajax_list'] = base_url('settings/settings');
        $this->data['ajax_save'] = base_url('settings/api/settings_api/save');

        $this->data['name'] = $this->settings_lib->config('config', 'name');
        $this->data['email'] = $this->settings_lib->config('config', 'email');
        $this->data['contact'] = $this->settings_lib->config('config', 'contact');
        $this->data['address'] = $this->settings_lib->config('config', 'address');

        $this->data['date_format'] = $this->settings_lib->config('config', 'date_format');
        $this->data['datetime_format'] = $this->settings_lib->config('config', 'datetime_format');
        $this->data['decimal_format'] = $this->settings_lib->config('config', 'decimal_format');

        $this->data['mail_protocol'] = $this->settings_lib->config('config', 'mail_protocol');
        $this->data['smtp_hostname'] = $this->settings_lib->config('config', 'smtp_hostname');
        $this->data['smtp_username'] = $this->settings_lib->config('config', 'smtp_username');
        $this->data['smtp_password'] = $this->settings_lib->config('config', 'smtp_password');
        $this->data['smtp_port'] = $this->settings_lib->config('config', 'smtp_port');
        $this->data['smtp_timeout'] = $this->settings_lib->config('config', 'smtp_timeout');


        $this->data['list_image_width'] = $this->settings_lib->config('config', 'list_image_width');
        $this->data['list_image_height'] = $this->settings_lib->config('config', 'list_image_height');
        $this->data['list_banner_width'] = $this->settings_lib->config('config', 'list_banner_width');
        $this->data['list_banner_height'] = $this->settings_lib->config('config', 'list_banner_height');

        $this->data['detail_image_width'] = $this->settings_lib->config('config', 'detail_image_width');
        $this->data['detail_image_height'] = $this->settings_lib->config('config', 'detail_image_height');
        $this->data['detail_banner_width'] = $this->settings_lib->config('config', 'detail_banner_width');
        $this->data['detail_banner_height'] = $this->settings_lib->config('config', 'detail_banner_height');


        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('settings/form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

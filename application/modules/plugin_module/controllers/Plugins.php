<?php

class Plugins extends MX_Controller {

    private $data;
    private $meta_title;
    
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
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('plugin_module/api/plugins_api/list');
        $this->data['ajax_install'] = base_url('plugin_module/api/plugins_api/install/');
        $this->data['ajax_uninstall'] = base_url('plugin_module/api/plugins_api/uninstall/');
        $this->data['ajax_backup'] = base_url('plugin_module/api/plugins_api/backup/');
        
        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('plugin_module/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

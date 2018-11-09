<?php

require APPPATH . '/libraries/REST_Controller.php';

class Plugins_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('plugin_module/plugins_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function list_post() {
        $this->data = array();
        $files = $this->plugins_model->get_plugins();

        $result = array();
        foreach ($files as $object) :
            $action = '';
            if ($this->plugin_lib->check($object)):
                $action .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" name="Uninstall" onclick="uninstall(' . "'" . $object . "'" . ')"><i class="fa fa-minus"></i></a> ';
            else:
                $action .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" data-toggle="tooltip" name="Install" onclick="install(' . "'" . $object . "'" . ')"><i class="fa fa-plus"></i></a> ';
            endif;

            $action .= '<a class="btn btn-sm btn-info" href="javascript:void(0)" data-toggle="tooltip" name="Backup" onclick="backup(' . "'" . $object . "'" . ')"><i class="fa fa-download"></i></a> ';

            $result[] = array(
                humanize($object),
                $action
            );
        endforeach;

        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function install_get($code) {
        $this->data = array();

        if ($code == 'product_inquiry_module'):
            if ($this->plugin_lib->check('product_module')):
                $this->installModule($code);
            else:
                $this->data['status'] = FALSE;
                $this->data['message'] = 'please install product module first!';
            endif;
        else:
            $this->installModule($code);
        endif;

        $this->response($this->data);
    }

    public function installModule($code) {
        $result = $this->plugins_model->install($code);
        if ($result) :
            $this->data['status'] = TRUE;
            $this->data['message'] = 'install successfully';
        else :
            $this->data['status'] = FALSE;
            $this->data['message'] = 'install failed!';
        endif;
    }

    public function uninstall_get($code) {
        $this->data = array();
        $result = $this->plugins_model->uninstall($code);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'uninstall successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'uninstall failed!';
        }

        $this->response($this->data);
    }

    public function backup_get($code) {
        $this->data = array();
        $result = $this->plugins_model->backup($code);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'backup successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'backup failed!';
        }

        $this->response($this->data);
    }

}

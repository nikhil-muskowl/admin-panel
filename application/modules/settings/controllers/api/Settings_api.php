<?php

require APPPATH . '/libraries/REST_Controller.php';

class Settings_api extends Restserver\Libraries\REST_Controller {

    private $meta_title;
    private $data;
    private $filter_data;
    private $class_name;

    public function __construct() {
        parent::__construct();
        $this->load->model('settings/settings_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');        
    }


    public function save_post() {
        $this->_validation();
        $result = $this->settings_model->post();
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'modified successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'modified failed!';
        }
        $this->response($this->data);
    }

    public function _validation() {
        $this->data = array();
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() == FALSE):
            if (form_error('name', '', '')):
                $this->error[] = array(
                    'id' => 'name',
                    'text' => form_error('name', '', '')
                );
            endif;
            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

}

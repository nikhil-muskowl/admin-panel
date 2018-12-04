<?php

require APPPATH . '/libraries/REST_Controller.php';

class Notification_settings_api extends Restserver\Libraries\REST_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('notifications_module/notification_settings_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function save_post() {
        $this->_validation();
        $result = $this->notification_settings_model->post();
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

        $this->form_validation->set_rules('fcm_key', 'fcm key', 'required');
        $this->form_validation->set_rules('pushy_key', 'pushy key', 'required');
        

        if ($this->form_validation->run() == FALSE):

            if (form_error('fcm_key', '', '')):
                $this->error[] = array(
                    'id' => 'fcm_key',
                    'text' => form_error('fcm_key', '', '')
                );
            endif;

            if (form_error('pushy_key', '', '')):
                $this->error[] = array(
                    'id' => 'pushy_key',
                    'text' => form_error('pushy_key', '', '')
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

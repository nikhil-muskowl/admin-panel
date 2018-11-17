<?php

require APPPATH . '/libraries/REST_Controller.php';

class Leave_settings_api extends Restserver\Libraries\REST_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('leave_managment_module/leave_settings_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function save_post() {
        $this->_validation();
        $result = $this->leave_settings_model->post();
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

        $this->form_validation->set_rules('pending_id', 'pending_id', 'required');
        $this->form_validation->set_rules('approved_id', 'approved_id', 'required');
        $this->form_validation->set_rules('cancel_id', 'cancel_id', 'required');


        if ($this->form_validation->run() == FALSE):

            if (form_error('pending_id', '', '')):
                $this->error[] = array(
                    'id' => 'pending_id',
                    'text' => form_error('pending_id', '', '')
                );
            endif;

            if (form_error('approved_id', '', '')):
                $this->error[] = array(
                    'id' => 'approved_id',
                    'text' => form_error('approved_id', '', '')
                );
            endif;

            if (form_error('cancel_id', '', '')):
                $this->error[] = array(
                    'id' => 'cancel_id',
                    'text' => form_error('cancel_id', '', '')
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

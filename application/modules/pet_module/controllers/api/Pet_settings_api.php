<?php

require APPPATH . '/libraries/REST_Controller.php';

class Pet_settings_api extends Restserver\Libraries\REST_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('pet_module/pet_settings_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function save_post() {
        $this->_validation();
        $result = $this->pet_settings_model->post();
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
        $this->form_validation->set_rules('register_points', 'Register points', 'required');
        $this->form_validation->set_rules('story_upload_points', 'story upload_points points', 'required');
        $this->form_validation->set_rules('story_comment_points', 'story comment points', 'required');
        $this->form_validation->set_rules('story_like_points', 'story like points', 'required');
        $this->form_validation->set_rules('story_dislike_points', 'story dislike points', 'required');
        if ($this->form_validation->run() == FALSE):
            if (form_error('register_points', '', '')):
                $this->error[] = array(
                    'id' => 'register_points',
                    'text' => form_error('register_points', '', '')
                );
            endif;
            if (form_error('story_upload_points', '', '')):
                $this->error[] = array(
                    'id' => 'story_upload_points',
                    'text' => form_error('story_upload_points', '', '')
                );
            endif;
            if (form_error('story_comment_points', '', '')):
                $this->error[] = array(
                    'id' => 'story_comment_points',
                    'text' => form_error('story_comment_points', '', '')
                );
            endif;
            if (form_error('story_like_points', '', '')):
                $this->error[] = array(
                    'id' => 'story_like_points',
                    'text' => form_error('story_like_points', '', '')
                );
            endif;
            if (form_error('story_dislike_points', '', '')):
                $this->error[] = array(
                    'id' => 'story_dislike_points',
                    'text' => form_error('story_dislike_points', '', '')
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

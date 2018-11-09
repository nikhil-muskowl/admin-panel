<?php

require APPPATH . '/libraries/REST_Controller.php';

class Followers_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $filterData = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('user_module/followers_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();
        $list = $this->followers_model->getTables();

        $result = array();
        foreach ($list as $object) :
            
            if (isset($object['current_user_image']) && $object['current_user_image']) {
                $current_user_image = $object['current_user_image'];
            } else {
                $current_user_image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $current_user_image_thumb = $this->custom_image->image_resize($current_user_image);


            $result[] = array(
                'id' => $object['id'],                
                'name' => $object['current_user_name'],
                'user_id' => $object['current_user_id'],
                'image' => $current_user_image_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->followers_model->countAll();
        $this->data['recordsFiltered'] = $this->followers_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->followers_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('user_module/followers/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';
            if ($object['status']):
                $status = '<input type="checkbox" checked onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            else:
                $status = '<input type="checkbox"  onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            endif;
            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['user_name'],
                $object['current_user_name'],
                $status,
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->followers_model->countAll();
        $this->data['recordsFiltered'] = $this->followers_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }
    
    public function follow_post() {
        $this->data = array();
        $this->followValidation();
        $result = $this->followers_model->follow();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'follow successfully!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'try again!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function followValidation() {
        $this->data = array();
        $this->form_validation->set_rules('user_id', 'user', 'required|callback_validate_request');
        $this->form_validation->set_rules('current_user_id', 'current_user', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('current_user_id', '', '')):
                $this->error[] = array(
                    'id' => 'current_user_id',
                    'text' => form_error('current_user_id', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }
    
    public function validate_request() {
        if ($this->followers_model->checkRequest()) {
            $this->form_validation->set_message('validate_request', 'already followed!');
            return FALSE;
        } elseif ($this->input->post('user_id') == $this->input->post('current_user_id')) {
            $this->form_validation->set_message('validate_request', 'cannot send request to own!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function unfollow_post() {
        $this->data = array();
        $this->unfollowValidation();
        $result = $this->followers_model->unfollow();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'unfollow successfully!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'try again!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function unfollowValidation() {
        $this->data = array();
        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('current_user_id', 'current_user', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('current_user_id', '', '')):
                $this->error[] = array(
                    'id' => 'current_user_id',
                    'text' => form_error('current_user_id', '', '')
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

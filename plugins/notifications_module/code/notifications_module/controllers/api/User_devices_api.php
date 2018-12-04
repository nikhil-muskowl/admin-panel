<?php

require APPPATH . '/libraries/REST_Controller.php';

class User_devices_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('notifications_module/user_devices_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->user_devices_model->getTables();

        $result = array();
        foreach ($list as $object) :

            if (isset($object['user_image']) && $object['user_image']) {
                $user_image = $object['user_image'];
            } else {
                $user_image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $user_image_thumb = $this->custom_image->image_resize($user_image);

            $result[] = array(
                'id' => $object['id'],
                'user_name' => $object['user_name'],
                'user_image' => base_url($user_image),
                'user_image_thumb' => $user_image_thumb,
                'provider' => $object['provider'],
                'type' => $object['type'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->user_devices_model->countAll();
        $this->data['recordsFiltered'] = $this->user_devices_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->user_devices_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('notifications_module/user_devices/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['user_name'],
                $object['provider'],
                $object['type'],
                $object['code'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->user_devices_model->countAll();
        $this->data['recordsFiltered'] = $this->user_devices_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $this->imageWidth = $this->settings_lib->config('config', 'detail_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'detail_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'detail_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'detail_banner_height');

        $object = $this->user_devices_model->getById($id);

        if ($object):
            if (isset($object['user_image']) && $object['user_image']) {
                $user_image = $object['user_image'];
            } else {
                $user_image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $user_image_thumb = $this->custom_image->image_resize($user_image);

            $result = array(
                'id' => $object['id'],
                'user_name' => $object['user_name'],
                'user_image' => base_url($user_image),
                'user_image_thumb' => $user_image_thumb,
                'type' => $object['type'],
                'code' => $object['code'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );

            $this->data['status'] = TRUE;
            $this->data['message'] = 'loading..';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'no result found!';
            $this->data['result'] = array();
        endif;

        $this->response($this->data);
    }

    public function save_post() {
        $this->data = array();
        $this->_validation();
        $result = $this->user_devices_model->postData();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function _validation() {
        $this->data = array();

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('provider', 'provider', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('code', 'code', 'required');


        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('provider', '', '')):
                $this->error[] = array(
                    'id' => 'provider',
                    'text' => form_error('provider', '', '')
                );
            endif;
            if (form_error('type', '', '')):
                $this->error[] = array(
                    'id' => 'type',
                    'text' => form_error('type', '', '')
                );
            endif;
            if (form_error('code', '', '')):
                $this->error[] = array(
                    'id' => 'code',
                    'text' => form_error('code', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_validation_error');
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->user_devices_model->deleteById($id);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'delete successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'delete failed!';
        }

        $this->response($this->data);
    }

    public function delete_post() {
        $this->data = array();
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id) {
            $result = $this->user_devices_model->deleteById($id);
        }
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'delete successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'delete failed!';
        }
        $this->response($this->data);
    }

    public function register_post() {
        $this->data = array();
        $this->_registerValidation();
        $result = $this->user_devices_model->register();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function _registerValidation() {
        $this->data = array();

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('provider', 'provider', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('code', 'code', 'required');


        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('provider', '', '')):
                $this->error[] = array(
                    'id' => 'provider',
                    'text' => form_error('provider', '', '')
                );
            endif;
            if (form_error('type', '', '')):
                $this->error[] = array(
                    'id' => 'type',
                    'text' => form_error('type', '', '')
                );
            endif;
            if (form_error('code', '', '')):
                $this->error[] = array(
                    'id' => 'code',
                    'text' => form_error('code', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_validation_error');
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }
}

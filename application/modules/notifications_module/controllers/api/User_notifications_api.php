<?php

require APPPATH . '/libraries/REST_Controller.php';

class User_notifications_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('notifications_module/user_notifications_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->user_notifications_model->getTables();

        $result = array();
        foreach ($list as $object) :

            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'type' => $object['type'],
                'type_id' => $object['type_id'],
                'user_id' => $object['user_id'],
                'user_notification_id' => $object['user_notification_id'],
                'is_view' => $object['is_view'],
                'image' => base_url() . $image,
                'image_thumb' => $image_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->user_notifications_model->countAll();
        $this->data['recordsFiltered'] = $this->user_notifications_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $this->imageWidth = $this->settings_lib->config('config', 'detail_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'detail_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'detail_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'detail_banner_height');

        $object = $this->user_notifications_model->getById($id);

        if ($object):
            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            $result = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'type' => $object['type'],
                'type_id' => $object['type_id'],
                'user_id' => $object['user_id'],
                'user_notification_id' => $object['user_notification_id'],
                'is_view' => $object['is_view'],
                'image' => base_url() . $image,
                'image_thumb' => $image_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
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
        $result = $this->user_notifications_model->postData();
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

        $this->form_validation->set_rules('id', 'notification', 'required');
        $this->form_validation->set_rules('user_id', 'user', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('id', '', '')):
                $this->error[] = array(
                    'id' => 'id',
                    'text' => form_error('id', '', '')
                );
            endif;
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->user_notifications_model->deleteById($id);
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
            $result = $this->user_notifications_model->deleteById($id);
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

}

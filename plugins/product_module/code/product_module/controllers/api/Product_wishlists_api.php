<?php

require APPPATH . '/libraries/REST_Controller.php';

class Product_wishlists_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('product_module/product_wishlists_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->product_wishlists_model->getTables();

        $result = array();
        foreach ($list as $object) :


            if (isset($object['product_image']) && $object['product_image']) {
                $product_image = $object['product_image'];
            } else {
                $product_image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $product_image_thumb = $this->custom_image->image_resize($product_image);

            if (isset($object['user_image']) && $object['user_image']) {
                $user_image = $object['user_image'];
            } else {
                $user_image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $user_image_thumb = $this->custom_image->image_resize($user_image);

            $result[] = array(
                'id' => $object['id'],
                'product_id' => $object['product_id'],
                'product_name' => $object['product_name'],
                'product_image' => base_url($product_image),
                'product_image_thumb' => $product_image_thumb,
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'user_image' => base_url($user_image),
                'user_image_thumb' => $user_image_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->product_wishlists_model->countAll();
        $this->data['recordsFiltered'] = $this->product_wishlists_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->product_wishlists_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('product_module/product_wishlists/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['product_name'],
                $object['user_name'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->product_wishlists_model->countAll();
        $this->data['recordsFiltered'] = $this->product_wishlists_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->product_wishlists_model->getById($id);
        if ($object):
            $result[] = array(
                'id' => $object['id'],
                'product_name' => $object['product_name'],
                'product_image' => $object['product_image'],
                'user_name' => $object['user_name'],
                'user_image' => $object['user_image'],
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
        $result = $this->product_wishlists_model->postData();
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

        $this->form_validation->set_rules('product_id', 'product', 'required|callback_validate_wishlist');
        $this->form_validation->set_rules('user_id', 'user', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('product_id', '', '')):
                $this->error[] = array(
                    'id' => 'product_id',
                    'text' => form_error('product_id', '', '')
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

    public function validate_wishlist($field_value) {
        if ($this->product_wishlists_model->checkWishlist($field_value)) {
            $this->form_validation->set_message('validate_wishlist', '{field} already in wishlist!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->product_wishlists_model->deleteById($id);
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
            $result = $this->product_wishlists_model->deleteById($id);
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

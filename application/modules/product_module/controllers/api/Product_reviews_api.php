<?php

require APPPATH . '/libraries/REST_Controller.php';

class Product_reviews_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('product_module/product_reviews_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->product_reviews_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'product' => $object['product'],
                'author' => $object['author'],
                'rating_text' => $object['rating_text'],
                'rating' => $object['rating'],
                'comment' => $object['comment'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'date' => date('Y-m-d s:i A', strtotime($object['date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->product_reviews_model->countAll();
        $this->data['recordsFiltered'] = $this->product_reviews_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->product_reviews_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('product_module/product_reviews/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            if ($object['status']):
                $status = '<input type="checkbox" checked onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            else:
                $status = '<input type="checkbox"  onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            endif;
            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['product'],
                $object['author'],
                $object['rating_text'],
                $object['rating'],
                $status,
                date('Y-m-d s:i A', strtotime($object['date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->product_reviews_model->countAll();
        $this->data['recordsFiltered'] = $this->product_reviews_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->product_reviews_model->getById($id);
        if ($object):
            $result[] = array(
                'id' => $object['id'],
                'product' => $object['product'],
                'author' => $object['author'],
                'rating_text' => $object['rating_text'],
                'rating' => $object['rating'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'date' => date('Y-m-d s:i A', strtotime($object['date'])),
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
        $result = $this->product_reviews_model->postData();
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

        $this->form_validation->set_rules('product_id', 'product', 'required');
        $this->form_validation->set_rules('author', 'author', 'required');
        $this->form_validation->set_rules('rating_id', 'rating_id', 'required');
        $this->form_validation->set_rules('comment', 'comment', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('product_id', '', '')):
                $this->error[] = array(
                    'id' => 'product_id',
                    'text' => form_error('product_id', '', '')
                );
            endif;

            if (form_error('author', '', '')):
                $this->error[] = array(
                    'id' => 'author',
                    'text' => form_error('author', '', '')
                );
            endif;

            if (form_error('rating_id', '', '')):
                $this->error[] = array(
                    'id' => 'rating_id',
                    'text' => form_error('rating_id', '', '')
                );
            endif;

            if (form_error('comment', '', '')):
                $this->error[] = array(
                    'id' => 'comment',
                    'text' => form_error('comment', '', '')
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
        $result = $this->product_reviews_model->deleteById($id);
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
            $result = $this->product_reviews_model->deleteById($id);
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

    public function change_status_post() {
        $this->data = array();
        $result = $this->product_reviews_model->change_status();
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
        }

        $this->response($this->data);
    }

}

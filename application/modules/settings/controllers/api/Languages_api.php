<?php

require APPPATH . '/libraries/REST_Controller.php';

class Languages_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('settings/languages_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->languages_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'code' => $object['code'],
                'name' => $object['name'],
                'sort_order' => $object['sort_order'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->languages_model->countAll();
        $this->data['recordsFiltered'] = $this->languages_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->languages_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;



        $result = array();
        foreach ($list as $object) :
            $edit_form = base_url('settings/languages/form/' . $object['id']);

            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . $edit_form . '" data-toggle="tooltip" name="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" name="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['code'],
                $object['name'],
                $object['sort_order'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->languages_model->countAll();
        $this->data['recordsFiltered'] = $this->languages_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $result = $this->languages_model->getById($id);
        if ($result):
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
        $result = $this->languages_model->postData();
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
        $this->form_validation->set_rules('code', 'Code', 'required|min_length[2]|max_length[50]|callback_valid_code');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() == FALSE):
            if (form_error('code', '', '')):
                $this->error[] = array(
                    'id' => 'code',
                    'text' => form_error('code', '', '')
                );
            endif;
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

    public function valid_code($code) {
        if ($this->languages_model->getByCode($code)) {
            $this->form_validation->set_message('valid_code', 'The {field} already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->languages_model->deleteById($id);
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
            $result = $this->languages_model->deleteById($id);
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

    public function switch_get($id) {
        $result = $this->languages_lib->setLanguage($id);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'set successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'set failed!';
        }
        $this->response($this->data);
    }

}

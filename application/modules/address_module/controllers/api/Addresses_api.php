<?php

require APPPATH . '/libraries/REST_Controller.php';

class Addresses_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('address_module/addresses_model');
        $this->lang->load('addresses', $this->languages_lib->getLanguage());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->addresses_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'user' => $object['user'],
                'country' => $object['country'],
                'zone' => $object['zone'],
                'name' => $object['name'],
                'contact' => $object['contact'],
                'address' => $object['address'],
                'city' => $object['city'],
                'postcode' => $object['postcode'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->addresses_model->countAll();
        $this->data['recordsFiltered'] = $this->addresses_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->addresses_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('address_module/addresses/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['user'],
                $object['country'],
                $object['zone'],
                $object['name'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->addresses_model->countAll();
        $this->data['recordsFiltered'] = $this->addresses_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_post($id) {
        $this->data = array();

        $object = $this->addresses_model->getById($id);

        if ($object):
            $result = array(
                'id' => $object['id'],
                'user' => $object['user'],
                'user_id' => $object['user_id'],
                'country' => $object['country'],
                'country_id' => $object['country_id'],
                'zone' => $object['zone'],
                'zone_id' => $object['zone_id'],
                'name' => $object['name'],
                'contact' => $object['contact'],
                'address' => $object['address'],
                'city' => $object['city'],
                'postcode' => $object['postcode'],
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
        $result = $this->addresses_model->postData();
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

        $this->form_validation->set_rules('country_id', 'country', 'required');
        $this->form_validation->set_rules('zone_id', 'zone', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('country_id', '', '')):
                $this->error[] = array(
                    'id' => 'country_id',
                    'text' => form_error('country_id', '', '')
                );
            endif;
            
            if (form_error('zone_id', '', '')):
                $this->error[] = array(
                    'id' => 'zone_id',
                    'text' => form_error('zone_id', '', '')
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

    public function delete_get($id) {
        $this->data = array();
        $result = $this->addresses_model->deleteById($id);
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
            $result = $this->addresses_model->deleteById($id);
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

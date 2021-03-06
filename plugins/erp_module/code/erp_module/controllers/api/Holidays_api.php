<?php

require APPPATH . '/libraries/REST_Controller.php';

class Holidays_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('leave_managment_module/holidays_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->holidays_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'date' => $object['date'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->holidays_model->countAll();
        $this->data['recordsFiltered'] = $this->holidays_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->holidays_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('leave_managment_module/holidays/form/' . $object['id']) . '" data-toggle="tooltip" title="' . $this->lang->line('text_edit') . '"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="' . $this->lang->line('text_delete') . '" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['title'],
                $object['date'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->holidays_model->countAll();
        $this->data['recordsFiltered'] = $this->holidays_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->holidays_model->getById($id);
        if ($object):
            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'date' => $object['date'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_loading');
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_no_data_found_error');
            $this->data['result'] = array();
        endif;

        $this->response($this->data);
    }

    public function save_post() {
        $this->data = array();
        $this->_validation();
        $result = $this->holidays_model->postData();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_submit_success');
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_submit_error');
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function _validation() {
        $this->data = array();

        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('details[]', 'details', 'required|xss_clean');

        if ($this->input->post('details')):
            if (is_array($this->input->post('details'))) :
                foreach ($this->input->post('details') as $key => $value) :
                    $this->form_validation->set_rules('details[' . $key . '][title]', 'title', 'required');
                endforeach;
            endif;
        endif;

        if ($this->form_validation->run() == FALSE):

            if (form_error('date', '', '')):
                $this->error[] = array(
                    'id' => 'date',
                    'text' => form_error('date', '', '')
                );
            endif;
            
            if ($this->input->post('details')):
                if (is_array($this->input->post('details'))) :
                    foreach ($this->input->post('details') as $key => $value) :
                        if (form_error('details[' . $key . '][title]', '', '')):
                            $this->error[] = array(
                                'id' => 'details[' . $key . '][title]',
                                'text' => form_error('details[' . $key . '][title]', '', '')
                            );
                        endif;
                    endforeach;
                endif;
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
        $result = $this->holidays_model->deleteById($id);
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_submit_success');
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_submit_error');
        endif;

        $this->response($this->data);
    }

    public function delete_post() {
        $this->data = array();
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id) {
            $result = $this->holidays_model->deleteById($id);
        }
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_submit_success');
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_submit_error');
        }
        $this->response($this->data);
    }

}

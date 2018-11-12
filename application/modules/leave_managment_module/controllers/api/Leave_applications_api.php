<?php

require APPPATH . '/libraries/REST_Controller.php';

class Leave_applications_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('leave_managment_module/leave_applications_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->leave_applications_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'user_name' => $object['user_name'],
                'from_date' => $object['from_date'],
                'to_date' => $object['to_date'],
                'total' => $object['total'],
                'leave_status' => $object['leave_status'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->leave_applications_model->countAll();
        $this->data['recordsFiltered'] = $this->leave_applications_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->leave_applications_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('leave_managment_module/leave_applications/form/' . $object['id']) . '" data-toggle="tooltip" title="' . $this->lang->line('text_edit') . '"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="' . $this->lang->line('text_delete') . '" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['user_name'],
                $object['from_date'],
                $object['to_date'],
                $object['total'],
                $object['leave_status'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->leave_applications_model->countAll();
        $this->data['recordsFiltered'] = $this->leave_applications_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->leave_applications_model->getById($id);
        if ($object):
            $result[] = array(
                'id' => $object['id'],
                'user_name' => $object['user_name'],
                'from_date' => $object['from_date'],
                'to_date' => $object['to_date'],
                'total' => $object['total'],
                'leave_status' => $object['leave_status'],
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
        $result = $this->leave_applications_model->postData();
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

        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('from_date', 'from_date', 'required');
        $this->form_validation->set_rules('to_date', 'to_date', 'required');
        $this->form_validation->set_rules('total', 'total', 'required|callback_check_total_leave');

        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('from_date', '', '')):
                $this->error[] = array(
                    'id' => 'from_date',
                    'text' => form_error('from_date', '', '')
                );
            endif;
            if (form_error('to_date', '', '')):
                $this->error[] = array(
                    'id' => 'to_date',
                    'text' => form_error('to_date', '', '')
                );
            endif;
            if (form_error('total', '', '')):
                $this->error[] = array(
                    'id' => 'total',
                    'text' => form_error('total', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_validation_error');
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function check_total_leave($field_value) {
        if ($field_value > 6) {
            $this->form_validation->set_message('check_total_leave', 'you can not take greater then 6 leaves!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->leave_applications_model->deleteById($id);
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
            $result = $this->leave_applications_model->deleteById($id);
        }
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_submit_success');
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_submit_error');
        endif;
        $this->response($this->data);
    }

    public function dateToDay_post() {
        $this->data = array();
        $this->_dateToDayValidation();
        $total = 0;
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $total = $this->settings_lib->dateToDay($from_date, $to_date);
        if ($total):
            $this->data['status'] = TRUE;
            $this->data['total'] = $total;
        else:
            $this->data['status'] = FALSE;
            $this->data['total'] = $total;
        endif;
        $this->response($this->data);
    }

    public function _dateToDayValidation() {
        $this->data = array();

        $this->form_validation->set_rules('from_date', 'from_date', 'required');
        $this->form_validation->set_rules('to_date', 'to_date', 'required');


        if ($this->form_validation->run() == FALSE):
            if (form_error('from_date', '', '')):
                $this->error[] = array(
                    'id' => 'from_date',
                    'text' => form_error('from_date', '', '')
                );
            endif;
            if (form_error('to_date', '', '')):
                $this->error[] = array(
                    'id' => 'to_date',
                    'text' => form_error('to_date', '', '')
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

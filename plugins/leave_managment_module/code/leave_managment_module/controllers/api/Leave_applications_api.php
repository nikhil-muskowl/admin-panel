<?php

require APPPATH . '/libraries/REST_Controller.php';

class Leave_applications_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('leave_managment_module/leave_applications_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->leave_applications_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'from_date' => date($this->datetime_format, strtotime($object['from_date'])),
                'to_date' => date($this->datetime_format, strtotime($object['to_date'])),
                'total' => $object['total'],
                'leave_status' => $object['leave_status'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
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
            $action .= ' <a class="btn btn-sm btn-default" href="javascript:void(0)" data-toggle="tooltip" title="' . $this->lang->line('text_view') . '" onclick="preview_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-eye"></i></a>';
            $action .= ' <a class="btn btn-sm btn-warning" href="javascript:void(0)" data-toggle="tooltip" title="' . $this->lang->line('text_send') . '" onclick="send_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-send"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['user_name'],
                $object['leave_reason'],
                $object['leave_type'],
                date($this->datetime_format, strtotime($object['from_date'])),
                date($this->datetime_format, strtotime($object['to_date'])),
                $object['total'],
                $object['leave_status'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
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
            $result = array(
                'id' => $object['id'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'leave_reason_id' => $object['leave_reason_id'],
                'leave_type_id' => $object['leave_type_id'],
                'leave_status_id' => $object['leave_status_id'],                
                'from_date' => $object['from_date'],
                'to_date' => $object['to_date'],
                'total' => $object['total'],                
                'subject' => $object['subject'],
                'text' => $object['text'],
                'leave_status' => $object['leave_status'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
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
        $this->form_validation->set_rules('leave_reason_id', 'leave_reason_id', 'required');
        $this->form_validation->set_rules('leave_type_id', 'leave_type_id', 'required');
        $this->form_validation->set_rules('from_date', 'from_date', 'required|callback_check_total_leave');
        $this->form_validation->set_rules('to_date', 'to_date', 'required');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('leave_reason_id', '', '')):
                $this->error[] = array(
                    'id' => 'leave_reason_id',
                    'text' => form_error('leave_reason_id', '', '')
                );
            endif;
            if (form_error('leave_type_id', '', '')):
                $this->error[] = array(
                    'id' => 'leave_type_id',
                    'text' => form_error('leave_type_id', '', '')
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
            if (form_error('subject', '', '')):
                $this->error[] = array(
                    'id' => 'subject',
                    'text' => form_error('subject', '', '')
                );
            endif;
            if (form_error('text', '', '')):
                $this->error[] = array(
                    'id' => 'text',
                    'text' => form_error('text', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_validation_error');
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function check_total_leave() {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $total = $this->settings_lib->dateToDay($from_date, $to_date);

        if ($total > 6) {
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
        $total = 0;
        $type = 'days';

        $this->_dateToDayValidation();
        $leave_types = $this->leave_applications_model->getTypeById($this->input->post('leave_type_id'));
        if ($leave_types):

            if ($this->input->post('from_date') && $this->input->post('to_date')):

                if ($leave_types['type'] == 'hour'):
                    $from_date = date('Y-m-d H:i', strtotime($this->input->post('from_date')));
                    $to_date = date('Y-m-d H:i', strtotime($this->input->post('to_date')));
                    $total = $this->settings_lib->getHours($from_date, $to_date);
                    $type = 'hours';
                else:
                    $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
                    $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
                    $total = $this->settings_lib->dateToDay($from_date, $to_date);
                endif;
            endif;

            $this->data['total'] = $total . ' ' . $type;
            $this->data['status'] = TRUE;
        else:
            $this->data['total'] = $total . ' ' . $type;
            $this->data['status'] = FALSE;
        endif;

        $this->response($this->data);
    }

    public function _dateToDayValidation() {
        $this->data = array();

        $this->form_validation->set_rules('leave_type_id', 'leave_type_id', 'required');
        $this->form_validation->set_rules('from_date', 'from_date', 'required');
        $this->form_validation->set_rules('to_date', 'to_date', 'required');


        if ($this->form_validation->run() == FALSE):
            if (form_error('leave_type_id', '', '')):
                $this->error[] = array(
                    'id' => 'leave_type_id',
                    'text' => form_error('leave_type_id', '', '')
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

            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_validation_error');
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function leave_status_post() {
        $this->data = array();
        $this->_StatusValidation();
        $result = $this->leave_applications_model->leave_status();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_submit_success');
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_submit_error');
        endif;
        $this->response($this->data);
    }

    public function _StatusValidation() {
        $this->data = array();

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('leave_status_id', 'leave status', 'required');


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
            if (form_error('leave_status_id', '', '')):
                $this->error[] = array(
                    'id' => 'leave_status_id',
                    'text' => form_error('leave_status_id', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_validation_error');
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function preview_get($id) {
        $result = '';
        $result = $this->leave_applications_model->getPreview($id);
        echo $result;
    }

    public function send_get($id) {
        $this->data = array();
        $result = $this->leave_applications_model->sendMail($id);
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = $this->lang->line('text_submit_success');
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->lang->line('text_submit_error');
        endif;

        $this->response($this->data);
    }

}

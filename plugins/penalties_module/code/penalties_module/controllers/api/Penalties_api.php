<?php

require APPPATH . '/libraries/REST_Controller.php';

class Penalties_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $datetime_format;
    private $date_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('penalties_module/penalties_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
        $this->date_format = $this->settings_lib->config('config', 'date_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->penalties_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],                
                'user_id' => $object['user_id'],                
                'user_name' => $object['user_name'],                
                'penalty_reason' => $object['penalty_reason'],                
                'date' => date($this->date_format, strtotime($object['date'])),                
                'total' => $object['total'],                
                'subject' => $object['subject'],                
                'text' => $object['text'],                
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->penalties_model->countAll();
        $this->data['recordsFiltered'] = $this->penalties_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->penalties_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('penalties_module/penalties/form/' . $object['id']) . '" data-toggle="tooltip" title="' . $this->lang->line('text_edit') . '"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="' . $this->lang->line('text_delete') . '" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,                
                $object['user_name'],
                $object['penalty_reason'],
                date($this->date_format, strtotime($object['date'])),                
                $object['total'],
                $object['subject'],                
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->penalties_model->countAll();
        $this->data['recordsFiltered'] = $this->penalties_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->penalties_model->getById($id);
        if ($object):
            $result[] = array(
                'id' => $object['id'],
                'user_name' => $object['user_name'],
                'from_date' => $object['from_date'],
                'to_date' => $object['to_date'],
                'total' => $object['total'],
                'penalty_status' => $object['penalty_status'],
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
        $result = $this->penalties_model->postData();
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
        $this->form_validation->set_rules('penalty_reason_id', 'penalty_reason_id', 'required');
        
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('total', 'total', 'required');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('penalty_reason_id', '', '')):
                $this->error[] = array(
                    'id' => 'penalty_reason_id',
                    'text' => form_error('penalty_reason_id', '', '')
                );
            endif;
            
            if (form_error('date', '', '')):
                $this->error[] = array(
                    'id' => 'date',
                    'text' => form_error('date', '', '')
                );
            endif;
            if (form_error('total', '', '')):
                $this->error[] = array(
                    'id' => 'total',
                    'text' => form_error('total', '', '')
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
    
    public function delete_get($id) {
        $this->data = array();
        $result = $this->penalties_model->deleteById($id);
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
            $result = $this->penalties_model->deleteById($id);
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

}

<?php

require APPPATH . '/libraries/REST_Controller.php';

class Todo_lists_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('todo_lists_module/todo_lists_model');
        $this->lang->load('todo_lists', $this->languages_lib->getLanguage());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->todo_lists_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'subject' => $object['subject'],
                'text' => $object['text'],                
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->todo_lists_model->countAll();
        $this->data['recordsFiltered'] = $this->todo_lists_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->todo_lists_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('todo_lists_module/todo_lists/form/' . $object['id']) . '" data-toggle="tooltip" title="' . $this->lang->line('text_edit') . '"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="' . $this->lang->line('text_delete') . '" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            if ($object['status']):
                $status = '<input type="checkbox" checked onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            else:
                $status = '<input type="checkbox"  onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            endif;
            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';            

            $result[] = array(
                $checkbox,
                $object['user_name'],
                $object['subject'],
                $object['text'],                
                $status,
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->todo_lists_model->countAll();
        $this->data['recordsFiltered'] = $this->todo_lists_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->todo_lists_model->getById($id);
        if ($object):
            $result[] = array(
                'id' => $object['id'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'subject' => $object['subject'],
                'text' => $object['text'],                
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
        $result = $this->todo_lists_model->postData();
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
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
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
        $result = $this->todo_lists_model->deleteById($id);
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
            $result = $this->todo_lists_model->deleteById($id);
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

    public function change_status_post() {
        $this->data = array();
        $result = $this->todo_lists_model->change_status();
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

<?php

require APPPATH . '/libraries/REST_Controller.php';

class Newsletter_mails_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('newsletters_module/newsletter_mails_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->newsletter_mails_model->getTables();

        $result = array();
        foreach ($list as $object) :

            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'name' => $object['name'],
                'email' => $object['email'],
                'contact' => $object['contact'],
                'subject' => $object['subject'],
                'text' => $object['text'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->newsletter_mails_model->countAll();
        $this->data['recordsFiltered'] = $this->newsletter_mails_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->newsletter_mails_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('newsletters_module/newsletter_mails/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';
            $action .= ' <a class="btn btn-sm btn-warning" href="javascript:void(0)" data-toggle="tooltip" title="Send" onclick="send_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-send"></i></a>';
            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['title'],
                $object['name'],
                $object['email'],
                $object['contact'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->newsletter_mails_model->countAll();
        $this->data['recordsFiltered'] = $this->newsletter_mails_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();

        $object = $this->newsletter_mails_model->getById($id);

        if ($object):
            $result = array(
                $object['title'],
                $object['name'],
                $object['email'],
                $object['contact'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
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
        $result = $this->newsletter_mails_model->postData();
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

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('subject', 'subject', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('title', '', '')):
                $this->error[] = array(
                    'id' => 'title',
                    'text' => form_error('title', '', '')
                );
            endif;
            if (form_error('name', '', '')):
                $this->error[] = array(
                    'id' => 'name',
                    'text' => form_error('name', '', '')
                );
            endif;
            if (form_error('email', '', '')):
                $this->error[] = array(
                    'id' => 'email',
                    'text' => form_error('email', '', '')
                );
            endif;
            if (form_error('subject', '', '')):
                $this->error[] = array(
                    'id' => 'subject',
                    'text' => form_error('subject', '', '')
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
        $result = $this->newsletter_mails_model->deleteById($id);
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
            $result = $this->newsletter_mails_model->deleteById($id);
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

    public function send_get($id) {
        $this->data = array();
        $result = $this->newsletter_mails_model->postEmails($id);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'sending successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'sending failed!';
        }

        $this->response($this->data);
    }
}

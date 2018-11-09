<?php

require APPPATH . '/libraries/REST_Controller.php';

class Cricket_team_points_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('cricket_module/cricket_team_points_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->cricket_team_points_model->getTables();

        $result = array();
        foreach ($list as $object) :
            $result[] = array(
                'id' => $object['id'],
                'team_name' => $object['team_name'],
                'player_name' => $object['player_name'],
                'points' => $this->settings_lib->number_format($object['points']),
                'description' => $object['description'],
                'status' => $object['status'] ? 'Enable' : 'Disable',
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->cricket_team_points_model->countAll();
        $this->data['recordsFiltered'] = $this->cricket_team_points_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->cricket_team_points_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('cricket_module/cricket_team_points/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            if ($object['approved_status'] == 'P' && $object['approved_status'] != 'R' && $object['approved_status'] != 'C'):
                $action .= ' <a class="btn btn-sm btn-success" href="javascript:void(0)" data-toggle="tooltip" title="Approved" onclick="approved_poitns(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-thumbs-up"></i></a>';
            endif;

            if ($object['approved_status'] == 'P' && $object['approved_status'] != 'R' && $object['approved_status'] != 'C'):
                $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Cancel" onclick="cancel_poitns(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-thumbs-down"></i></a>';
            endif;

            if ($object['approved_status'] == 'A' && $object['approved_status'] != 'R' && $object['approved_status'] != 'C'):
                $action .= ' <a class="btn btn-sm btn-info" href="javascript:void(0)" data-toggle="tooltip" title="Return" onclick="return_poitns(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-undo"></i></a>';
            endif;

            $approved_status = 'pending';
            if ($object['approved_status'] == 'A'):
                $approved_status = 'approved';
            elseif ($object['approved_status'] == 'C'):
                $approved_status = 'cancel';
            elseif ($object['approved_status'] == 'R'):
                $approved_status = 'return';
            endif;

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['team_name'],
                $object['player_name'],
                $this->settings_lib->number_format($object['points']),
                $approved_status,
                $object['status'] ? 'Enable' : 'Disable',
                date('Y-m-d s:i A', strtotime($object['created_date'])),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->cricket_team_points_model->countAll();
        $this->data['recordsFiltered'] = $this->cricket_team_points_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $result = $this->cricket_team_points_model->getById($id);
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
        $result = $this->cricket_team_points_model->postData();
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
        $this->form_validation->set_rules('team_id', 'team', 'required');
        $this->form_validation->set_rules('player_id', 'player', 'required');
        if ($this->form_validation->run() == FALSE):
            if (form_error('team_id', '', '')):
                $this->error[] = array(
                    'id' => 'team_id',
                    'text' => form_error('team_id', '', '')
                );
            endif;
            if (form_error('player_id', '', '')):
                $this->error[] = array(
                    'id' => 'player_id',
                    'text' => form_error('player_id', '', '')
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
        $result = $this->cricket_team_points_model->deleteById($id);
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
            $result = $this->cricket_team_points_model->deleteById($id);
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

    public function approved_poitns_get($id) {
        $this->data = array();
        $status = 'A';
        $result = $this->cricket_team_points_model->changeApprovedStatus($id, $status);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
        }
        $this->response($this->data);
    }

    public function cancel_poitns_get($id) {
        $this->data = array();
        $status = 'C';
        $result = $this->cricket_team_points_model->changeApprovedStatus($id, $status);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
        }
        $this->response($this->data);
    }

    public function return_poitns_get($id) {
        $this->data = array();
        $status = 'R';
        $result = $this->cricket_team_points_model->changeApprovedStatus($id, $status);
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

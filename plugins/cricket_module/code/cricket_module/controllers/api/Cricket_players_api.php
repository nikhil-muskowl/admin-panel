<?php

require APPPATH . '/libraries/REST_Controller.php';

class Cricket_players_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('cricket_module/cricket_players_model');
        $this->load->model('cricket_module/cricket_teams_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->cricket_players_model->getTables();

        $result = array();
        foreach ($list as $object) :
            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = '';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);

            $roles = $this->cricket_players_model->getRoleNames($object['id']);
            $levels = $this->cricket_players_model->getLevelNames($object['id']);



            $result[] = array(
                'id' => $object['id'],
                'team_name' => $object['team_name'],
                'type_name' => $object['type_name'],
                'batting_type' => $object['batting_type'],
                'bowlling_type' => $object['bowlling_type'],
                'name' => $object['name'],
                'description' => $object['description'],
                'roles' => $roles,
                'levels' => $levels,
                'image' => $image,
                'image_thumb' => $image_thumb,
                'banner' => $banner,
                'banner_thumb' => $banner_thumb,
                'points' => $this->settings_lib->number_format($object['points']),
                'status' => $object['status'] ? 'Enable' : 'Disable',
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->cricket_players_model->countAll();
        $this->data['recordsFiltered'] = $this->cricket_players_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->cricket_players_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('cricket_module/cricket_players/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" name="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['team_name'],
                $object['type_name'],
                $object['name'],
                $this->settings_lib->number_format($object['points']),
                $object['status'] ? 'Enable' : 'Disable',
                date('Y-m-d s:i A', strtotime($object['created_date'])),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->cricket_players_model->countAll();
        $this->data['recordsFiltered'] = $this->cricket_players_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->cricket_players_model->getById($id);
        if ($object):

            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = '';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);

            $roles = $this->cricket_players_model->getRoleNames($object['id']);
            $levels = $this->cricket_players_model->getLevelNames($object['id']);

            $result[] = array(
                'id' => $object['id'],
                'team_name' => $object['team_name'],
                'type_name' => $object['type_name'],
                'batting_type' => $object['batting_type'],
                'bowlling_type' => $object['bowlling_type'],
                'name' => $object['name'],
                'description' => $object['description'],
                'roles' => $roles,
                'levels' => $levels,
                'image' => $image,
                'image_thumb' => $image_thumb,
                'banner' => $banner,
                'banner_thumb' => $banner_thumb,
                'points' => $this->settings_lib->number_format($object['points']),
                'status' => $object['status'] ? 'Enable' : 'Disable',
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
        $result = $this->cricket_players_model->postData();
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
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() == FALSE):
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
        $result = $this->cricket_players_model->deleteById($id);
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
            $result = $this->cricket_players_model->deleteById($id);
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

    public function team_players_post() {
        $this->data = array();

        $list = $this->cricket_teams_model->getAll();
        $result = array();
        foreach ($list as $object) :

            $filterData = array();
            $filterData['team_id'] = $object['id'];
            $players = $this->cricket_players_model->getAll($filterData);

            $playerResult = array();
            if ($players):
                foreach ($players as $player) :

                    if (isset($player['image']) && $player['image']) {
                        $image = $player['image'];
                    } else {
                        $image = '';
                    }
                    $this->custom_image->width = $this->imageWidth;
                    $this->custom_image->height = $this->imageHeight;
                    $image_thumb = $this->custom_image->image_resize($image);

                    if (isset($player['banner']) && $player['banner']) {
                        $banner = $player['banner'];
                    } else {
                        $banner = '';
                    }
                    $this->custom_image->width = $this->bannerWidth;
                    $this->custom_image->height = $this->bannerHeight;
                    $banner_thumb = $this->custom_image->image_resize($banner);

                    $roles = $this->cricket_players_model->getRoleNames($player['id']);
                    $levels = $this->cricket_players_model->getLevelNames($object['id']);
                    $playerResult[] = array(
                        'id' => $player['id'],
                        'team_name' => $player['team_name'],
                        'type_name' => $player['type_name'],
                        'batting_type' => $player['batting_type'],
                        'bowlling_type' => $player['bowlling_type'],
                        'name' => $player['name'],
                        'description' => $player['description'],
                        'roles' => $roles,
                        'levels' => $levels,
                        'image' => $image,
                        'image_thumb' => $image_thumb,
                        'banner' => $banner,
                        'banner_thumb' => $banner_thumb,
                        'points' => $this->settings_lib->number_format($player['points']),
                        'status' => $player['status'] ? 'Enable' : 'Disable',
                        'created_date' => date('Y-m-d s:i A', strtotime($player['created_date'])),
                        'modified_date' => date('Y-m-d s:i A', strtotime($player['modified_date'])),
                    );
                endforeach;
            endif;

           if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = '';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = '';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);

            $result[] = array(
                'id' => $object['id'],
                'name' => $object['name'],
                'description' => $object['description'],
                'points' => $this->settings_lib->number_format($object['points']),
                'remaining_points' => $this->settings_lib->number_format($object['remaining_points']),
                'image' => $image,
                'image_thumb' => $image_thumb,
                'banner' => $banner,
                'banner_thumb' => $banner_thumb,
                'players' => $playerResult,
                'status' => $object['status'] ? 'Enable' : 'Disable',
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function export_get() {
        $result = $this->cricket_players_model->getAllCsv();

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = "\t";
        $newline = "\r\n";
        $filename = $this->meta_title . date('Y-m-d-H-i-s') . ".csv";
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        $data = chr(255) . chr(254) . mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
        force_download($filename, $data);
    }

}

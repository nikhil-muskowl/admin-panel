<?php

require APPPATH . '/libraries/REST_Controller.php';

class User_pets_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('pet_module/user_pets_model');
        $this->load->model('pet_module/user_pet_points_model');
        $this->load->model('pet_module/pet_levels_model');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->user_pets_model->getTables();

        $result = array();
        foreach ($list as $object) :
            if (isset($object['pet_image']) && $object['pet_image']) {
                $image = $object['pet_image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            $result[] = array(
                'id' => $object['id'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'pet_id' => $object['pet_id'],
                'pet_name' => $object['pet_name'],
                'level' => $object['level'],
                'pet_image' => base_url($image),
                'pet_image_thumb' => $image_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->user_pets_model->countAll();
        $this->data['recordsFiltered'] = $this->user_pets_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->user_pets_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('pet_module/user_pets/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            if (isset($object['pet_image']) && $object['pet_image']) {
                $image = $object['pet_image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            $image = '<img alt="" name="" src="' . $image_thumb . '" class="img-fluid""/>';

            $result[] = array(
                $checkbox,
                $image,
                $object['user_name'],
                $object['pet_name'],
                $object['level'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->user_pets_model->countAll();
        $this->data['recordsFiltered'] = $this->user_pets_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $this->user_pets_model->updatePet($id);
        $object = $this->user_pets_model->getById($id);
        if ($object):
            if (isset($object['pet_image']) && $object['pet_image']) {
                $image = $object['pet_image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

//            $this->load->model('pet_module/pet_levels_model');
//            $levels = $this->pet_levels_model->getLevelsById($object['pet_id']);
//            $levelData = array();
//
//            if ($levels):
//                foreach ($levels as $level) :
//                    if ($object['level'] != $level['level']):
//                        if (isset($level['image']) && $level['image']) {
//                            $levelimage = $level['image'];
//                        } else {
//                            $levelimage = 'upload/images/placeholder.png';
//                        }
//                        $this->custom_image->width = $this->imageWidth;
//                        $this->custom_image->height = $this->imageHeight;
//                        $levelimage_thumb = $this->custom_image->image_resize($levelimage);
//
//                        $levelData[] = array(
//                            'pet_id' => $level['pet_id'],
//                            'image' => base_url($levelimage),
//                            'image_thumb' => $levelimage_thumb,
//                            'level' => $level['level'],
//                            'points' => $level['points'],
//                        );
//                    endif;
//                endforeach;
//            endif;

            $result = array(
                'id' => $object['id'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'pet_id' => $object['pet_id'],
                'pet_name' => $object['pet_name'],
                'level' => $object['level'],
                'pet_image' => base_url($image),
                'pet_image_thumb' => $image_thumb,
//                'levels' => $levelData,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );

            $total_points = 0;
            $total_points = $this->user_pet_points_model->userPoints($object['user_id']);
            $this->data['total_points'] = $total_points;

            $points = 0;
            $points = $this->pet_levels_model->getLevelPoints($object['pet_id'], $object['level'] + 1);
            $this->data['points'] = $points;

            $progress = 0;

            try {
                if ($total_points && $points):
                    $progress = ( $total_points / $points ) * 100;
                endif;
            } catch (Exception $exc) {
                $progress = 0;
            }

            $this->data['progress'] = number_format((float) $progress, 0);

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
        $result = $this->user_pets_model->postData();
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

        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('pet_id', 'pet_id', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;

            if (form_error('pet_id', '', '')):
                $this->error[] = array(
                    'id' => 'pet_id',
                    'text' => form_error('pet_id', '', '')
                );
            endif;

            if (form_error('level', '', '')):
                $this->error[] = array(
                    'id' => 'level',
                    'text' => form_error('level', '', '')
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
        $result = $this->user_pets_model->deleteById($id);
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
            $result = $this->user_pets_model->deleteById($id);
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

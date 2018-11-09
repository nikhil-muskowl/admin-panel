<?php

require APPPATH . '/libraries/REST_Controller.php';

class Users_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $filterData = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('user_module/users_model');
        $this->load->model('user_module/followers_model');
        $this->load->model('user_module/genders_model');
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
        $list = $this->users_model->getTables();

        $result = array();
        foreach ($list as $object) :
            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);
            $result[] = array(
                'id' => $object['id'],
                'name' => $object['name'],
                'email' => $object['email'],
                'contact' => $object['contact'],
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'banner' => base_url($banner),
                'banner_thumb' => $banner_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->users_model->countAll();
        $this->data['recordsFiltered'] = $this->users_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->users_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('user_module/users/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-success" href="' . base_url('user_module/users/password_form/' . $object['id']) . '" data-toggle="tooltip" title="Update Password"><i class="fa fa-key"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';
            if ($object['status']):
                $status = '<input type="checkbox" checked onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            else:
                $status = '<input type="checkbox"  onchange="change_status(' . $object['id'] . ',this.checked)" data-toggle="toggle" data-on="' . $this->lang->line('text_enable') . '" data-off="' . $this->lang->line('text_disable') . '" data-size="mini">';
            endif;
            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['name'],
                $object['email'],
                $object['contact'],
                $status,
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->users_model->countAll();
        $this->data['recordsFiltered'] = $this->users_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function login_post() {
        $this->data = array();
        $this->loginValidation();
        $result = $this->users_lib->login();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'login success!';
            $this->data['result'] = $result;

        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'login failed!';
            $this->data['result'] = array();
        endif;
        $this->data['redirect'] = base_url('dashboard');
        $this->response($this->data);
    }

    public function loginValidation() {
        $this->data = array();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE):
            if (form_error('username', '', '')):
                $this->error[] = array(
                    'id' => 'username',
                    'text' => form_error('username', '', '')
                );
            endif;
            if (form_error('password', '', '')):
                $this->error[] = array(
                    'id' => 'password',
                    'text' => form_error('password', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function save_post() {
        $this->data = array();
        $this->_validation();
        $result = $this->users_model->postData();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'user add success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'user adding failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function _validation() {
        $this->data = array();
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('contact', 'Contact', 'required|min_length[5]|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_validate_email');
        if ($this->form_validation->run() == FALSE):
            if (form_error('name', '', '')):
                $this->error[] = array(
                    'id' => 'name',
                    'text' => form_error('name', '', '')
                );
            endif;
            if (form_error('contact', '', '')):
                $this->error[] = array(
                    'id' => 'contact',
                    'text' => form_error('contact', '', '')
                );
            endif;
            if (form_error('email', '', '')):
                $this->error[] = array(
                    'id' => 'email',
                    'text' => form_error('email', '', '')
                );
            endif;
            if (form_error('password', '', '')):
                $this->error[] = array(
                    'id' => 'password',
                    'text' => form_error('password', '', '')
                );
            endif;
            if (form_error('passconf', '', '')):
                $this->error[] = array(
                    'id' => 'passconf',
                    'text' => form_error('passconf', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function validate_email($field_value) {
        if ($this->users_model->getByEmail($field_value)) {
            $this->form_validation->set_message('validate_email', '{field} already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function register_post() {
        $this->data = array();
        $this->register_validation();
        $result = $this->users_model->postData();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'user add success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'user adding failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function register_validation() {
        $this->data = array();
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]');

        if ($this->input->post('contact')):
            $this->form_validation->set_rules('contact', 'Contact', 'required|min_length[5]|max_length[10]');
        endif;

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[10]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE):
            if (form_error('name', '', '')):
                $this->error[] = array(
                    'id' => 'name',
                    'text' => form_error('name', '', '')
                );
            endif;

            if ($this->input->post('contact')):
                if (form_error('contact', '', '')):
                    $this->error[] = array(
                        'id' => 'contact',
                        'text' => form_error('contact', '', '')
                    );
                endif;
            endif;

            if (form_error('email', '', '')):
                $this->error[] = array(
                    'id' => 'email',
                    'text' => form_error('email', '', '')
                );
            endif;
            if (form_error('password', '', '')):
                $this->error[] = array(
                    'id' => 'password',
                    'text' => form_error('password', '', '')
                );
            endif;
            if (form_error('passconf', '', '')):
                $this->error[] = array(
                    'id' => 'passconf',
                    'text' => form_error('passconf', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function updatePassword_post() {
        $this->data = array();
        $this->updatePasswordValidation();
        $result = $this->users_model->updatePassword();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'password update success!';
            $this->data['result'] = $result;
            $this->data['redirect'] = base_url('admin');
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'password update failed!';
            $this->data['result'] = array();
            $this->data['redirect'] = base_url('user_module/forgot');
        endif;
        $this->response($this->data);
    }

    public function updatePasswordValidation() {
        $this->data = array();
        $this->form_validation->set_rules('id', 'User Id', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[10]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE):

            if (form_error('id', '', '')):
                $this->error[] = array(
                    'id' => 'id',
                    'text' => form_error('id', '', '')
                );
            endif;

            if (form_error('password', '', '')):
                $this->error[] = array(
                    'id' => 'password',
                    'text' => form_error('password', '', '')
                );
            endif;

            if (form_error('passconf', '', '')):
                $this->error[] = array(
                    'id' => 'passconf',
                    'text' => form_error('passconf', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;

        endif;
    }

    public function admin_forgot_post() {
        $this->data = array();
        $this->forgotValidation();
        $result = $this->users_model->adminForgotPassword();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'email send success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'email send failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function forgot_post() {
        $this->data = array();
        $this->forgotValidation();
        $result = $this->users_model->forgotPassword();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'email send success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'email send failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function forgotValidation() {
        $this->data = array();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_forgot_validate_email');
        if ($this->form_validation->run() == FALSE):

            if (form_error('email', '', '')):
                $this->error[] = array(
                    'id' => 'email',
                    'text' => form_error('email', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function forgot_validate_email($field_value) {
        if (!$this->users_model->getByEmail($field_value)) {
            $this->form_validation->set_message('forgot_validate_email', '{field} not found!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function search_post() {
        $this->data = array();

        if ($this->input->post('name')):
            $this->filterData['name'] = $this->input->post('name');
        endif;

        $list = $this->users_model->getTables($this->filterData);

        $result = array();
        foreach ($list as $object) :

            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);

            $requested = FALSE;
            if ($this->input->post('user_id')):
                $checkRequest = $this->users_model->checkRequest($this->input->post('user_id'), $object['id']);
                if ($checkRequest):
                    $requested = TRUE;
                endif;
                if ($object['id'] != $this->input->post('user_id')):
                    $result[] = array(
                        'id' => $object['id'],
                        'name' => $object['name'],
                        'email' => $object['email'],
                        'contact' => $object['contact'],
                        'requested' => $requested,
                        'image' => base_url($image),
                        'image_thumb' => $image_thumb,
                        'banner' => base_url($banner),
                        'banner_thumb' => $banner_thumb,
                        'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                        'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                        'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
                    );
                endif;
            endif;
        endforeach;

        $this->data['recordsTotal'] = $this->users_model->countAll();
        $this->data['recordsFiltered'] = $this->users_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function updateDetail_post() {
        $this->data = array();
        $this->updateDetailValidation();
        $result = $this->users_model->updateDetail();
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

    public function updateDetailValidation() {
        $this->data = array();
        $this->form_validation->set_rules('id', 'User Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('contact', 'Contact', 'required|min_length[5]|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE):
            $inputerror = array();
            $error_string = array();

            if (form_error('id')):
                $inputerror[] = 'id';
                $error_string[] = form_error('id');
            endif;
            if (form_error('name')):
                $inputerror[] = 'name';
                $error_string[] = form_error('name');
            endif;
            if (form_error('contact')):
                $inputerror[] = 'contact';
                $error_string[] = form_error('contact');
            endif;
            if (form_error('email')):
                $inputerror[] = 'email';
                $error_string[] = form_error('email');
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['inputerror'] = $inputerror;
            $this->data['error_string'] = $error_string;

            echo json_encode($this->data);
            exit;
        endif;
    }

    public function detail_get($id) {
        $this->data = array();
        $data = array();
        $result = $this->users_model->getById($id);

        if ($result):
            if (isset($result['id']) && $result['id']) :
                $data['id'] = $result['id'];
            else:
                $data['id'] = 0;
            endif;

            if (isset($result['name']) && $result['name']) :
                $data['name'] = $result['name'];
            else:
                $data['name'] = '';
            endif;

            if (isset($result['email']) && $result['email']) :
                $data['email'] = $result['email'];
            else:
                $data['email'] = '';
            endif;

            if (isset($result['contact']) && $result['contact']) :
                $data['contact'] = $result['contact'];
            else:
                $data['contact'] = '';
            endif;

            if (isset($result['gender_id']) && $result['gender_id']) :
                $data['gender_id'] = $result['gender_id'];
            else:
                $data['gender_id'] = '';
            endif;

            if (isset($result['dob']) && $result['dob']) :
                $data['dob'] = $result['dob'];
            else:
                $data['dob'] = '';
            endif;


            if (isset($result['image']) && $result['image']) :
                $data['image'] = $result['image'];
            else:
                $data['image'] = 'upload/images/placeholder.png';
            endif;


            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $data['image_thumb'] = $this->custom_image->image_resize($data['image']);

            if (isset($result['banner']) && $result['banner']) :
                $data['banner'] = $result['banner'];
            else:
                $data['banner'] = 'upload/images/placeholder.png';
            endif;
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $data['banner_thumb'] = $this->custom_image->image_resize($data['banner']);

            if (isset($result['created_date']) && $result['created_date']) :
                $data['created_date'] = $result['created_date'];
            else:
                $data['created_date'] = '';
            endif;
            if (isset($result['modified_date']) && $result['modified_date']) :
                $data['modified_date'] = $result['modified_date'];
            else:
                $data['modified_date'] = '';
            endif;

            $TotalFollowing = $this->followers_model->getTotalFollowing($id);

            if ($TotalFollowing):
                $data['total_following'] = $this->settings_lib->nice_number($TotalFollowing);
            else:
                $data['total_following'] = $this->settings_lib->nice_number(0);
            endif;

            $TotalFollowers = $this->followers_model->getTotalFollowers($id);

            if ($TotalFollowers):
                $data['total_followers'] = $this->settings_lib->nice_number($TotalFollowers);
            else:
                $data['total_followers'] = $this->settings_lib->nice_number(0);
            endif;

            $data['total_flames'] = $this->settings_lib->nice_number($this->users_model->getTotalFlames($id));

            $this->data['status'] = TRUE;
            $this->data['message'] = 'loading...';
            $this->data['result'] = $data;

        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'no result found!';
            $this->data['result'] = $data;
        endif;


        $this->response($this->data);
    }

    public function detail_post() {
        $this->data = array();
        $data = array();

        $user_id = $this->input->post('user_id');

        $result = $this->users_model->getById($user_id);

        if ($result):
            if (isset($result['id']) && $result['id']) :
                $data['id'] = $result['id'];
            else:
                $data['id'] = 0;
            endif;

            if (isset($result['name']) && $result['name']) :
                $data['name'] = $result['name'];
            else:
                $data['name'] = '';
            endif;

            if (isset($result['email']) && $result['email']) :
                $data['email'] = $result['email'];
            else:
                $data['email'] = '';
            endif;

            if (isset($result['contact']) && $result['contact']) :
                $data['contact'] = $result['contact'];
            else:
                $data['contact'] = '';
            endif;

            if (isset($result['gender_id']) && $result['gender_id']) :
                $data['gender_id'] = $result['gender_id'];
            else:
                $data['gender_id'] = '';
            endif;

            if (isset($result['dob']) && $result['dob']) :
                $data['dob'] = $result['dob'];
            else:
                $data['dob'] = '';
            endif;

            if (isset($result['image']) && $result['image']) :
                $data['image'] = $result['image'];
            else:
                $data['image'] = 'upload/images/placeholder.png';
            endif;

            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $data['image_thumb'] = $this->custom_image->image_resize($data['image']);

            if (isset($result['banner']) && $result['banner']) :
                $data['banner'] = $result['banner'];
            else:
                $data['banner'] = 'upload/images/placeholder.png';
            endif;
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $data['banner_thumb'] = $this->custom_image->image_resize($data['banner']);

            if (isset($result['created_date']) && $result['created_date']) :
                $data['created_date'] = $result['created_date'];
            else:
                $data['created_date'] = '';
            endif;
            if (isset($result['modified_date']) && $result['modified_date']) :
                $data['modified_date'] = $result['modified_date'];
            else:
                $data['modified_date'] = '';
            endif;

            $TotalFollowing = $this->followers_model->getTotalFollowing($user_id);

            if ($TotalFollowing):
                $data['total_following'] = $this->settings_lib->nice_number($TotalFollowing);
            else:
                $data['total_following'] = $this->settings_lib->nice_number(0);
            endif;

            $TotalFollowers = $this->followers_model->getTotalFollowers($user_id);

            if ($TotalFollowers):
                $data['total_followers'] = $this->settings_lib->nice_number($TotalFollowers);
            else:
                $data['total_followers'] = $this->settings_lib->nice_number(0);
            endif;

            $data['total_flames'] = $this->settings_lib->nice_number($this->users_model->getTotalFlames($user_id));

            if ($this->followers_model->checkRequest()) :
                $data['followed'] = TRUE;
            else:
                $data['followed'] = FALSE;
            endif;

            $this->data['status'] = TRUE;
            $this->data['message'] = 'loading...';
            $this->data['result'] = $data;

        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'no result found!';
            $this->data['result'] = $data;
        endif;


        $this->response($this->data);
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->users_model->deleteById($id);
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
            $result = $this->users_model->deleteById($id);
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

    public function change_status_post() {
        $this->data = array();
        $result = $this->users_model->change_status();
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
        }

        $this->response($this->data);
    }

    public function uploadProfile_post() {
        $this->data = array();
        $this->_profileValidation();
        $image = $this->custom_image->base64Image($this->input->post('image'));
        if ($image):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'uploading success!';
            $this->data['result'] = $image;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'uploading failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function _profileValidation() {
        $this->data = array();
        $this->form_validation->set_rules('image', 'image', 'trim|required');
        if ($this->form_validation->run() == FALSE):

            if (form_error('image', '', '')):
                $this->error[] = array(
                    'id' => 'image',
                    'text' => form_error('image', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function updateProfilePic_post() {
        $this->data = array();
        $this->updateProfilePicValidation();
        $result = $this->users_model->updateProfilePic();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'profile picture update success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'profile picture update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function updateProfilePicValidation() {
        $this->data = array();
        $this->form_validation->set_rules('id', 'User Id', 'required');
        $this->form_validation->set_rules('image', 'image', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('id', '', '')):
                $this->error[] = array(
                    'id' => 'id',
                    'text' => form_error('id', '', '')
                );
            endif;

            if (form_error('image', '', '')):
                $this->error[] = array(
                    'id' => 'image',
                    'text' => form_error('image', '', '')
                );
            endif;
            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;

        endif;
    }

    public function setpet_get($id) {
        $this->data = array();
        $result = $this->users_model->setPet($id);
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

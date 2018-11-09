<?php

class User_groups extends MX_Controller {

    private $data = array();
    private $error = array();
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->load->model('user_module/user_groups_model');
        $this->meta_title = humanize(__CLASS__);
    }

    public function index() {
        $this->data = array();
        $this->data['meta_title'] = $this->meta_title;
        $this->data['ajax_list'] = base_url('user_module/api/user_groups_api/list');
        $this->data['ajax_delete'] = base_url('user_module/api/user_groups_api/delete');
        $this->data['ajax_form'] = base_url('user_module/user_groups/form');


        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_module/user_groups/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->user_groups_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        $this->data['meta_title'] = $this->meta_title;
        $this->data['ajax_list'] = base_url('user_module/user_groups');
        $this->data['ajax_save'] = base_url('user_module/api/user_groups_api/save');

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->user_groups_model->details($id);

        $this->data['details'] = array();
        if ($languages):
            foreach ($languages as $value) :
                $title = '';
                if ($details):
                    $title = $details[$value['id']]['title'];
                endif;
                $this->data['details'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'title' => $title,
                );
            endforeach;
        endif;
        $this->data['modules'] = array();
        $modules = $this->sidebar->getModules();

        if ($modules):
            foreach ($modules as $key => $module) :
                $moduleChildren = array();
                if (is_array($module['children'])):
                    foreach ($module['children'] as $children) :
                        $modulePermissions = array();
                        $permissions = $this->user_groups_model->getPermission($id, $children['code']);
                        if ($permissions):
                            $modulePermissions = $permissions;
                        else:
                            $modulePermissions = array(
                                'is_add' => 0,
                                'is_view' => 0,
                                'is_update' => 0,
                                'is_delete' => 0,
                            );
                        endif;

                        $moduleChildren[] = array(
                            'name' => $children['name'],
                            'code' => $children['code'],
                            'children' => $children['children'],
                            'permissions' => $modulePermissions,
                        );
                    endforeach;
                endif;

//                print_r($moduleChildren);
//                exit;

                $this->data['modules'][] = array(
                    'name' => $module['name'],
                    'children' => $moduleChildren,
                );
            endforeach;
        endif;


        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('user_module/user_groups/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}

<?php

class Users_lib {

    private $ci;
    private $sessionData = array();
    public $id = NULL;
    public $user_group_id;
    public $name;
    public $contact;
    public $email;
    public $image;
    public $created_date;
    public $modified_date;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('user_module/users_model');
        $this->ci->load->library('email');
        $this->ci->load->library('session');
        $this->ci->load->library('encryption');

        $this->sessionData = $this->ci->session->userdata('users_log');
//        print_r($this->sessionData);
//        exit;
        if ($this->sessionData) {
            $this->id = $this->sessionData;
            $data = $this->ci->users_model->getById($this->id);
            if ($data) {
                $this->id = $data['id'];
                $this->user_group_id = $data['user_group_id'];
                $this->name = $data['name'];
                $this->contact = $data['contact'];
                $this->email = $data['email'];
                $this->image = $data['image'];
                $this->created_date = $data['created_date'];
                $this->modified_date = $data['modified_date'];
            }
        }
    }

    public function login() {
        $result = $this->ci->users_model->login();
        if ($result):
            $this->setSession($result);
            $this->ci->session->set_userdata('users_log', $result['id']);
            return $result;
        else:
            return FALSE;
        endif;
    }

    public function isLogged() {
        if (!$this->id) :
            return FALSE;
        else:
            return $this->id;
        endif;
    }

    public function logout() {
        if ($this->ci->session->has_userdata('users_log')):
            $this->ci->session->unset_userdata('users_log');
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function has_permission($module, $key) {
        $permission = $this->ci->db->get_where('module_permissions', array('user_group_id' => $this->user_group_id, 'module' => $module))->row_array();

        if ($permission) :
            if ($permission[$key]) :
                return TRUE;
            else :
                return FALSE;
            endif;
        else :
            return FALSE;
        endif;
    }

    public function setSession($data) {
        $this->ci->db->trans_start();

        $sessions = $this->ci->db->get_where('sessions', array('user_id' => $data['id']))->row_array();

        $this->ci->db->set('user_id', $data['id']);
        $token = $this->ci->encryption->encrypt($data['id']);
        $this->ci->db->set('token', $token);

        if ($sessions):
            $this->ci->db->where('id',$sessions['id']);
            $this->ci->db->update('sessions');
        else:
            $this->ci->db->insert('sessions');
        endif;




        $this->ci->db->trans_complete();
        if ($this->ci->db->trans_status() === FALSE) {
            $this->ci->db->trans_rollback();
            return FALSE;
        } else {
            $this->ci->db->trans_commit();
            return TRUE;
        }
    }

}

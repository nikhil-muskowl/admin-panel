<?php

class My_account_model extends CI_Model {

    private $table = 'users';

    public function getById($id) {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function updateProfilePic() {
        $this->db->trans_start();

        $this->db->set('image', $this->custom_image->base64Image($this->input->post('image')));

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update($this->table);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function updatePassword() {
        $this->db->trans_start();

        $this->db->set('password', $this->input->post('password'));

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update($this->table);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function adminForgotPassword() {
        $this->data = array();
        $data = $this->getByEmail($this->input->post('email'));
        $id = $this->encryption->encrypt($data['id']);

        $subject = 'Forgot Password';

        $url = base_url('user_module/users/update_password/update?id=' . $id);

//        print_r($url);
//        exit;

        $this->data['url'] = $url;
        $this->data['name'] = $data['name'];
        $this->data['meta_title'] = $subject;
        $html = $this->load->view('email_template/user/forgot_password', $this->data, TRUE);
//        print_r($html);
//        exit;
        $this->email_lib->toEmail = $data['email'];
        $this->email_lib->subject = $subject;
        $this->email_lib->message = $html;
        if ($this->email_lib->send()):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function forgotPassword() {
        $this->data = array();
        $data = $this->getByEmail($this->input->post('email'));
//        $id = $this->encryption->encrypt($data['id']);
        $id = $data['id'];
        $subject = 'Forgot Password';

//        $url = base_url('user_module/users/update_password/update?id=' . $id);
        $url = 'rarau.muskowl.com/reset-password/' . $id;

//        print_r($url);
//        exit;

        $this->data['url'] = $url;
        $this->data['name'] = $data['name'];
        $this->data['meta_title'] = $subject;
        $html = $this->load->view('email_template/user/forgot_password', $this->data, TRUE);
//        print_r($html);
//        exit;
        $this->email_lib->toEmail = $data['email'];
        $this->email_lib->subject = $subject;
        $this->email_lib->message = $html;
        if ($this->email_lib->send()):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function updateDetail() {
        $this->db->trans_start();

        $this->db->set('name', $this->input->post('name'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('contact', $this->input->post('contact'));

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update($this->table);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}

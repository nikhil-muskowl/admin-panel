<?php

class Users_model extends CI_Model {

    private $table = 'users';
    private $table_view = 'users';
    private $column_order = array(null, 'name', 'email', 'contact', 'modified_date', null);
    private $column_search = array('name', 'email', 'contact', 'modified_date');
    private $order = array('modified_date' => 'desc');

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('user_group_id')):
            $this->db->where('user_group_id', $this->input->post('user_group_id'));
        endif;
        
        if ($this->input->post('gender_id')):
            $this->db->where('gender_id', $this->input->post('gender_id'));
        endif;
        if ($this->input->post('is_admin')):
            $this->db->where('is_admin', $this->input->post('is_admin'));
        endif;
        if ($this->input->post('verified')):
            $this->db->where('verified', $this->input->post('verified'));
        endif;

        if (isset($array['name']) && !empty($array['name'])):
            $this->db->like('name', $array['name']);
        endif;

        if (isset($array['email']) && !empty($array['email'])):
            $this->db->where('email', $array['email']);
        endif;

        if (isset($array['contact']) && !empty($array['contact'])):
            $this->db->where('contact', $array['contact']);
        endif;

        if (isset($array['latitude']) && !empty($array['latitude'])):
            $this->db->like('latitude', $array['latitude']);
        endif;

        if (isset($array['longitude']) && !empty($array['longitude'])):
            $this->db->like('longitude', $array['longitude']);
        endif;

        $status = 1;
        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $status = 0;
        endif;

        $this->db->where('status', $status);

        $i = 0;
        foreach ($this->column_search as $item) :
            if (isset($_POST['length'])) :
                if (isset($_POST['search']['value'])) :
                    if ($i === 0) :
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    else :
                        $this->db->or_like($item, $_POST['search']['value']);
                    endif;
                    if (count($this->column_search) - 1 == $i):
                        $this->db->group_end();
                    endif;
                endif;
            endif;
            $i++;
        endforeach;

        if (isset($_POST['order'])) :
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        elseif (isset($this->order)) :
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        endif;
    }

    public function getTables($array = array()) {
        $this->_getTablesQuery($array);
        if (isset($_POST['length'])) :
            if ($_POST['length'] != -1):
                $this->db->limit($_POST['length'], $_POST['start']);
            endif;
        endif;
        $query = $this->db->get();
//        print_r($this->db->last_query());
//        exit;
        return $query->result_array();
    }

    public function countFiltered($array = array()) {
        $this->_getTablesQuery($array);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countAll() {
        $this->db->from($this->table_view);
        return $this->db->count_all_results();
    }

    public function getById($id) {
        $this->db->from($this->table_view);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getByEmail($email) {
        $this->db->from($this->table_view);
        $this->db->where('email', $email);

        if ($this->input->post('id')):
            $this->db->where('id!=', $this->input->post('id'));
        endif;

        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByContact($contact) {
        $this->db->from($this->table_view);
        $this->db->where('contact', $contact);

        if ($this->input->post('id')):
            $this->db->where('id!=', $this->input->post('id'));
        endif;

        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteById($id) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function postData() {
        $this->db->trans_start();

        if (isset($_POST['user_group_id'])):
            $this->db->set('user_group_id', $this->input->post('user_group_id'));
        endif;

        $this->db->set('name', $this->input->post('name'));
        $this->db->set('email', $this->input->post('email'));

        if (isset($_POST['image'])):
            $this->db->set('image', $this->custom_image->get_path($this->input->post('image')));
        endif;

        if (isset($_POST['banner'])):
            $this->db->set('banner', $this->custom_image->get_path($this->input->post('banner')));
        endif;


        if (isset($_POST['contact'])):
            $this->db->set('contact', $this->input->post('contact'));
        endif;

        if (isset($_POST['dob'])):
            $this->db->set('dob', $this->input->post('dob'));
        endif;

        if (isset($_POST['gender_id'])):
            $this->db->set('gender_id', $this->input->post('gender_id'));
        endif;



        if (isset($_POST['password'])):
            $this->db->set('password', $this->input->post('password'));
        endif;

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();

            if ($this->plugin_lib->check('pet_module')):
                $this->setPoints($id);
                $this->setPet($id);
            endif;
        endif;

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function login() {
        $this->db->from($this->table_view);
        $this->db->group_start();
        $this->db->where('email', $this->input->post('username'));
        $this->db->or_where('contact', $this->input->post('username'));
        $this->db->group_end();
        $this->db->where('password', $this->input->post('password'));
        $query = $this->db->get();
//        print_r($this->db->last_query());
//        exit;
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

    public function checkRequest($id, $follow_id) {
        $this->db->from('follow_requests');
        $this->db->where('user_id', $id);
        $this->db->where('follow_id', $follow_id);
        $query = $this->db->get();
        return $query->row_array();
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

    public function change_status() {
        $this->db->trans_start();

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if ($status == 'true'):
            $this->db->set('status', 1);
        else:
            $this->db->set('status', 0);
        endif;

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

    public function getFollowers($id) {
        $this->db->from('followers_view');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTotalFlames($id) {
        $this->db->select('SUM((SELECT SUM(sr.likes)-SUM(sr.dislikes) FROM story_rankings sr WHERE sr.story_id=s.id)) AS totalFlames');
        $this->db->from('stories s');
        $this->db->where('s.user_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($result['totalFlames']):
            return $result['totalFlames'];
        else:
            return 0;
        endif;
    }

    public function setPoints($id) {
        $this->db->trans_start();
        $points = $this->settings_lib->config('pet_module', 'register_points');
        $this->db->set('user_id', $id);
        $this->db->set('points', $points);
        $this->db->set('description', 'registration bonus points');
        $this->db->insert('user_pet_points');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function setPet($id) {
        $this->db->trans_start();
        $query = $this->db->select('id')->get('pets')->result_array();

        $pets = array();
        if ($query):
            foreach ($query as $value) :
                $pets[] = $value['id'];
            endforeach;
        endif;
        if ($pets):
            $pet_id = random_element($pets);
            if ($pet_id):
                $user_pets = $this->db->get_where('user_pets', array('user_id' => $id, 'pet_id' => $pet_id))->result();
                if (!$user_pets):
                    $this->db->set('user_id', $id);
                    $this->db->set('pet_id', $pet_id);
                    $this->db->set('level', 1);
                    $this->db->insert('user_pets');
                endif;
            endif;
        endif;

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

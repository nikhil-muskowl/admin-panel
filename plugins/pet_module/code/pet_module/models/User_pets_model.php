<?php

class User_pets_model extends CI_Model {

    private $table = 'user_pets';
    private $table_view = 'user_pets_view';
    private $column_order = array(null, 'user_name', 'pet_name', 'level', 'status', 'modified_date', null);
    private $column_search = array('user_name', 'pet_name', 'level', 'status', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $language_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;

        $this->load->model('pet_module/user_pet_points_model');
        $this->load->model('pet_module/pet_levels_model');
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);


        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);


        if ($this->input->post('user_id')):
            $this->db->where('user_id', $this->input->post('user_id'));
        endif;


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
        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);


        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        endif;
        $this->db->where('language_id', $this->language_id);

        if ($this->input->post('user_id')):
            $this->db->where('user_id', $this->input->post('user_id'));
        endif;

        return $this->db->count_all_results();
    }

    public function getById($id) {
        $this->db->from($this->table_view);
        $this->db->where('id', $id);
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

        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->set('pet_id', $this->input->post('pet_id'));
        $this->db->set('level', $this->input->post('level'));
        $this->db->set('status', 1);
        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
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

    public function checkPetLevel($level) {
        $this->db->from('pet_levels');
        $this->db->where('level', $level);
        $this->db->where('pet_id', $this->input->post('pet_id'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function checkLevel($level) {
        $this->db->from($this->table_view);
        $this->db->where('level', $level);
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->where('pet_id', $this->input->post('pet_id'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function userLevel($id) {
        $level = 0;
        $this->db->select('SUM(level) AS level');
        $this->db->from('user_pets');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($result):
            $level = $result['level'];
        endif;
        return $level;
    }

    public function updatePet($id) {
        $this->db->trans_start();

        $user_pets = $this->db->get_where('user_pets', array('id' => $id))->row_array();





        if ($user_pets):
            $level = $user_pets['level'] + 1;
            $getLevelPoints = $this->pet_levels_model->getLevelPoints($user_pets['pet_id'], $level);
            $userPoints = $this->user_pet_points_model->userPoints($user_pets['user_id']);


            if ($getLevelPoints && $userPoints && $userPoints >= $getLevelPoints):
                $this->db->set('level', $level);
                $this->db->set('status', 1);
                $this->db->where('user_id', $user_pets['user_id']);
                $this->db->where('pet_id', $user_pets['pet_id']);
                $this->db->update($this->table);



                $this->db->set('user_id', $user_pets['user_id']);
                $this->db->set('points', -(int) $this->pet_levels_model->getLevelPoints($user_pets['pet_id'], $level));
                $this->db->set('description', 'redeem points for pet upgrade');
                $this->db->insert('user_pet_points');

//                print_r($this->db->last_query());
//                exit;
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

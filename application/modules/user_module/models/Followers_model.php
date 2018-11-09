<?php

class Followers_model extends CI_Model {

    private $table = 'followers';
    private $table_view = 'followers_view';
    private $column_order = array(null, 'user_name', 'current_user_name', 'created_date', 'modified_date', null);
    private $column_search = array('user_name', 'current_user_name', 'created_date', 'modified_date');
    private $order = array('user_name' => 'asc');

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        // for get users followers
        if ($this->input->post('user_id') && !empty($this->input->post('user_id'))):
            $this->db->where('user_id', $this->input->post('user_id'));
        endif;
        
        
        //to check other followers not add current user in list
        if ($this->input->post('current_user_id') && !empty($this->input->post('current_user_id'))):
            $this->db->where('current_user_id !=', $this->input->post('current_user_id'));
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
        if ($this->input->post('user_id') && !empty($this->input->post('user_id'))):
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

    public function getTotalFollowing($id) {
        $this->db->from($this->table_view);
        $this->db->where('current_user_id', $id);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    public function getTotalFollowers($id) {
        $this->db->from($this->table_view);
        $this->db->where('user_id', $id);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    public function follow() {
        $this->db->trans_start();

        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->set('current_user_id', $this->input->post('current_user_id'));

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

    public function checkRequest() {
        $this->db->from($this->table_view);
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->where('current_user_id', $this->input->post('current_user_id'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function unfollow() {
        $this->db->trans_start();

        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->where('current_user_id', $this->input->post('current_user_id'));

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

}

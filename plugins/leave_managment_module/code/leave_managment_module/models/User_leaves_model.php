<?php

class User_leaves_model extends CI_Model {

    private $table = 'user_leaves';
    private $table_view = 'user_leaves_view';
    private $column_order = array(null, 'name', 'leave_type', 'total', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('name', 'leave_type', 'total', 'status', 'created_date', 'modified_date');
    private $order = array('name' => 'asc');
    private $status;
    private $language_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;
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
        $this->db->set('leave_type_id', $this->input->post('leave_type_id'));
        $this->db->set('total', $this->input->post('total'));

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

    public function assignLeaves() {
        $this->db->trans_start();
        $date = date('d');
        if ($date == 1):
            $users = $this->db->get_where('users', array('status' => 1))->result_array();
            if ($users):
                foreach ($users as $user) :

                    $leave_types = $this->db->get_where('leave_types', array('status' => 1))->result_array();

                    if ($leave_types):
                        foreach ($leave_types as $leave_type) :
                            $user_leave = $this->db->get_where($this->table, array('status' => 1, 'user_id' => $user['id'], 'leave_type_id' => $leave_type['id']))->row_array();

                            if ($user_leave):
                                if (date('Y-m-d', strtotime($user_leave['modified_date'])) != date('Y-m-d')):
                                    $total = $user_leave['total'] + $leave_type['value'];

                                    $this->db->set('total', $total);
                                    $this->db->where('id', $user_leave['id']);
                                    $this->db->update($this->table);
                                endif;

                            else:
                                $this->db->set('user_id', $user['id']);
                                $this->db->set('leave_type_id', $leave_type['id']);
                                $this->db->set('total', $leave_type['value']);
                                $this->db->insert($this->table);
                            endif;

                        endforeach;
                    endif;
                endforeach;
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

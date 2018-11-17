<?php

class Leave_applications_model extends CI_Model {

    private $table = 'leave_applications';
    private $table_view = 'leave_applications_view';
    private $column_order = array(null, 'user_name', 'leave_reason', 'leave_type', 'from_date', 'to_date', 'total', 'leave_status', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('user_name', 'leave_reason', 'leave_type', 'from_date', 'to_date', 'total', 'leave_status', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $language_id;
    private $pending_id;
    private $approved_id;
    private $cancel_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;

        $this->pending_id = $this->settings_lib->config('leave_managment_module', 'pending_id');
        $this->approved_id = $this->settings_lib->config('leave_managment_module', 'approved_id');
        $this->cancel_id = $this->settings_lib->config('leave_managment_module', 'cancel_id');
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
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);
        return $this->db->count_all_results();
    }

    public function getById($id) {
        $this->db->from($this->table_view);
        $this->db->where('id', $id);
        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);
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
        $this->db->set('leave_reason_id', $this->input->post('leave_reason_id'));
        $this->db->set('leave_type_id', $this->input->post('leave_type_id'));

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->set('language_id', $this->language_id);

        $total = 0;
        $leave_types = $this->getTypeById($this->input->post('leave_type_id'));
        if ($leave_types):
            if ($this->input->post('from_date') && $this->input->post('to_date')):

                if ($leave_types['type'] == 'hour'):
                    $from_date = date('Y-m-d h:i:sa', strtotime($this->input->post('from_date')));
                    $to_date = date('Y-m-d h:i:sa', strtotime($this->input->post('to_date')));
                    $total = $this->settings_lib->getHours($from_date, $to_date);
                else:
                    $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
                    $to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
                    $total = $this->settings_lib->dateToDay($from_date, $to_date);
                endif;
            endif;
        endif;

        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('total', $total);

        $this->db->set('subject', $this->input->post('subject'));
        $this->db->set('text', $this->input->post('text'));

        $this->db->set('status', 1);
        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
            $this->leave_status();
        else:
            $leave_status_id = $this->pending_id;
            $this->db->set('leave_status_id', $leave_status_id);
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

    public function getTypeById($id) {
        $this->db->from('leave_types');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function leave_status() {
        $this->db->trans_start();

        $leaveApplication = $this->getById($this->input->post('id'));

        if ($leaveApplication):

            $user_leaves = $this->db->get_where('user_leaves', array('user_id' => $leaveApplication['user_id'], 'leave_type_id' => $leaveApplication['leave_type_id']))->row_array();

            if ($user_leaves && $this->input->post('leave_status_id') != $this->pending_id):
                if ($this->input->post('leave_status_id') == $this->approved_id):
                    $total = $user_leaves['total'] - $leaveApplication['total'];
                elseif ($this->input->post('leave_status_id') == $this->cancel_id):
                    $total = $user_leaves['total'] + $leaveApplication['total'];
                endif;

                $this->db->set('total', $total);
                $this->db->where('user_id', $leaveApplication['user_id']);
                $this->db->where('leave_type_id', $leaveApplication['leave_type_id']);
                $this->db->update('user_leaves');

                $this->db->set('leave_status_id', $this->input->post('leave_status_id'));
                $this->db->where('id', $this->input->post('id'));
                $this->db->update($this->table);
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

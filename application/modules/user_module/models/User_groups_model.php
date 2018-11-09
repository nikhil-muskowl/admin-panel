<?php

class User_groups_model extends CI_Model {

    private $table = 'user_groups';
    private $table_view = 'user_groups_view';
    private $column_order = array(null, 'title', 'created_date', 'modified_date', null);
    private $column_search = array('title', 'created_date', 'modified_date');
    private $order = array('title' => 'asc');
    private $status;
    private $language_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if (isset($array['title']) && !empty($array['title'])):
            $this->db->where('title', $array['title']);
        endif;

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


        $this->db->set('status', 1);

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->postDetails($id);
        $this->setPermissions($id);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function postDetails($id) {
        $this->db->where('id', $id);
        $this->db->delete('user_group_details');

        if ($this->input->post('details')):
            foreach ($this->input->post('details') as $key => $value) :
                $this->db->set('id', $id);
                $this->db->set('language_id', $key);
                $this->db->set('title', $value['title']);
                $this->db->insert('user_group_details');
            endforeach;
        endif;
    }

    public function details($id) {
        $result = array();
        $this->db->from('user_group_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[$value['language_id']] = array(
                    'id' => $value['id'],
                    'language_id' => $value['language_id'],
                    'title' => $value['title']
                );
            endforeach;
        endif;

        return $result;
    }

    public function getPermission($id, $module) {
        $result = array();
        $this->db->from('module_permissions');
        $this->db->where('user_group_id', $id);
        $this->db->where('module', $module);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result = array(
                    'is_add' => $value['is_add'],
                    'is_view' => $value['is_view'],
                    'is_update' => $value['is_update'],
                    'is_delete' => $value['is_delete'],
                );
            endforeach;
        endif;

        return $result;
    }

    public function setPermissions($id) {
        if ($this->input->post('module_permissions')):
            if (is_array($this->input->post('module_permissions'))):
                foreach ($this->input->post('module_permissions') as $key => $value) :


                    $this->db->where('user_group_id', $id);
                    $this->db->where('module', $key);
                    $this->db->delete('module_permissions');


                    $this->db->set('user_group_id', $id);
                    $this->db->set('module', $key);

                    if (isset($value['is_add'])):
                        $this->db->set('is_add', 1);
                    endif;
                    if (isset($value['is_view'])):
                        $this->db->set('is_view', 1);
                    endif;
                    if (isset($value['is_update'])):
                        $this->db->set('is_update', 1);
                    endif;
                    if (isset($value['is_delete'])):
                        $this->db->set('is_delete', 1);
                    endif;

                    $this->db->insert('module_permissions');

                endforeach;
            endif;
        endif;
    }

}

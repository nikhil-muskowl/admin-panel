<?php

class Product_inquiries_model extends CI_Model {

    private $table = 'p_inquiries';
    private $table_view = 'p_inquiries_view';
    private $column_order = array(null, 'product', 'name', 'email', 'contact', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('product', 'name', 'email', 'contact', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);

        if ($this->input->post('inquiry_type_id')):
            $this->db->where('id IN(SELECT id FROM p_inquiry_to_types WHERE type_id=' . $this->input->post('inquiry_type_id') . ')', NULL);
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

        $this->db->set('product_id', $this->input->post('product_id'));
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('contact', $this->input->post('contact'));
        $this->db->set('inquiry', $this->input->post('inquiry'));

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->setTypes($id);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function setTypes($id) {
        $this->db->where('id', $id);
        $this->db->delete('p_inquiry_to_types');

        if ($this->input->post('types')):
            $types = array();
            if (is_array($this->input->post('types'))):
                $types = $this->input->post('types');
            else:
                $types = json2arr($this->input->post('types'));
            endif;

            if ($types):
                foreach ($types as $value) :
                    $this->db->set('id', $id);
                    $this->db->set('type_id', $value);
                    $this->db->insert('p_inquiry_to_types');
                endforeach;
            endif;

        endif;
    }

    public function getTypes($id) {
        $result = array();
        $this->db->from('p_inquiry_to_types');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['type_id'];
            endforeach;
        endif;

        return $result;
    }

}

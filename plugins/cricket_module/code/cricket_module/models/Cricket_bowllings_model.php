<?php

class Cricket_bowllings_model extends CI_Model {

    private $table = 'cricket_bowllings';
    private $table_view = 'cricket_bowllings_view';
    private $column_order = array(null, 'match_name', 'team_name', 'player_name', 'over', 'maiden', 'run', 'wicket', 'modified_date', null);
    private $column_search = array('match_name', 'team_name', 'player_name', 'over', 'maiden', 'run', 'wicket', 'modified_date');
    private $order = array('modified_date' => 'desc');

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if (isset($array['match_id']) && !empty($array['match_id'])):
            $this->db->where('match_id', $array['match_id']);
        endif;

        if (isset($array['team_id']) && !empty($array['team_id'])):
            $this->db->where('team_id', $array['team_id']);
        endif;

        if (isset($array['player_id']) && !empty($array['player_id'])):
            $this->db->where('player_id', $array['player_id']);
        endif;

        if (isset($array['match_name']) && !empty($array['match_name'])):
            $this->db->like('match_name', $array['match_name']);
        endif;

        if (isset($array['team_name']) && !empty($array['team_name'])):
            $this->db->like('team_name', $array['team_name']);
        endif;

        if (isset($array['player_name']) && !empty($array['player_name'])):
            $this->db->like('player_name', $array['player_name']);
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

        $this->db->set('match_id', $this->input->post('match_id'));
        $this->db->set('team_id', $this->input->post('team_id'));
        $this->db->set('player_id', $this->input->post('player_id'));
        $this->db->set('over', $this->input->post('over'));
        $this->db->set('maiden', $this->input->post('maiden'));
        $this->db->set('run', $this->input->post('run'));
        $this->db->set('wicket', $this->input->post('wicket'));

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

}

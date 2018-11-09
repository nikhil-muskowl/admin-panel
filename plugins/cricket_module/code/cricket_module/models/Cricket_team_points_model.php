<?php

class Cricket_team_points_model extends CI_Model {

    private $table = 'cricket_team_points';
    private $table_view = 'cricket_team_points_view';
    private $column_order = array(null, 'team_name', 'player_name', 'points', 'approved_status', 'created_date', 'modified_date', null);
    private $column_search = array('team_name', 'player_name', 'points', 'approved_status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->model('cricket_module/cricket_players_model');
        $this->load->model('cricket_module/cricket_teams_model');
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if (isset($array['team_name']) && !empty($array['team_name'])):
            $this->db->where('team_name', $array['team_name']);
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

        $this->db->set('team_id', $this->input->post('team_id'));
        $this->db->set('player_id', $this->input->post('player_id'));
        $this->db->set('description', $this->input->post('description'));
        $this->db->set('points', $this->getPoint($this->input->post('player_id')));

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

    public function getAll() {
        $this->db->from($this->table_view);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPoint($id) {
        $points = 0;
        $result = $this->cricket_players_model->getById($id);
        if ($result):
            $points = $result['points'];
        endif;

        return $points;
    }

    public function getTeamPoint($id) {
        $points = 0;
        $result = $this->cricket_teams_model->getById($id);
        if ($result):            
            $points = $result['points'];
        endif;

        return $points;
    }

    public function updateApprovedStatus($id, $approved_status) {
        $this->db->trans_start();
        $this->db->set('approved_status', $approved_status);
        $this->db->where('id', $id);
        $this->db->update($this->table);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function changeApprovedStatus($id, $approved_status) {
        $points = 0;
        $teamPoints = 0;
        $finalPoints = 0;
        $result = $this->getById($id);
        if ($result):
            $points = $this->getPoint($result['player_id']);
            $teamPoints = $this->getTeamPoint($result['team_id']);
            if ($approved_status == 'A'):
                $finalPoints = $teamPoints - $points;
                $this->cricket_teams_model->updatePoints($result['team_id'], $finalPoints);
                $this->cricket_players_model->setTeam($result['player_id'],$result['team_id']);
            endif;
            if ($approved_status == 'R'):
                $finalPoints = $teamPoints + $points;
            $this->cricket_players_model->setTeam($result['player_id'],0);
                $this->cricket_teams_model->updatePoints($result['team_id'], $finalPoints);
            endif;
            
            
            $this->updateApprovedStatus($id, $approved_status);
            
            return TRUE;
        else:
            return FALSE;
        endif;
    }

}

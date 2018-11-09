<?php

class Cricket_players_model extends CI_Model {

    private $table = 'cricket_players';
    private $table_view = 'cricket_players_view';
    private $column_order = array(null, 'team_name', 'type_name', 'name', 'points', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('team_name', 'type_name', 'name', 'points', 'status', 'created_date', 'modified_date');
    private $order = array('name' => 'asc');

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('team_id')):
            $this->db->where('team_id', $this->input->post('team_id'));
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
        $this->db->set('type_id', $this->input->post('type_id'));
        $this->db->set('bowlling_type_id', $this->input->post('bowlling_type_id'));
        $this->db->set('batting_type_id', $this->input->post('batting_type_id'));
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('description', $this->input->post('description'));
        $this->db->set('points', $this->input->post('points'));

        $this->db->set('image', $this->custom_image->get_path($this->input->post('image')));
        $this->db->set('banner', $this->custom_image->get_path($this->input->post('banner')));

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->setRoles($id);
        $this->setLevels($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function getAll($data = array()) {
        $this->db->from($this->table_view);

        if (isset($data['team_id']) && $data['team_id']):
            $this->db->where('team_id', $data['team_id']);
        endif;

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllCsv() {
        $result = $this->db->get($this->table);
        return $result;
    }

    public function setRoles($id) {
        $this->db->where('player_id', $id);
        $this->db->delete('cricket_player_roles');

        if ($this->input->post('roles')):
            $roles = $this->input->post('roles');
        else:
            $roles = array();
        endif;

        if ($roles):



            foreach ($roles as $value):
                $this->db->set('player_id', $id);
                $this->db->set('role_id', $value);
                $this->db->insert('cricket_player_roles');
            endforeach;
        endif;
    }

    public function setLevels($id) {
        $this->db->where('player_id', $id);
        $this->db->delete('cricket_player_levels');

        if ($this->input->post('levels')):
            $levels = $this->input->post('levels');
        else:
            $levels = array();
        endif;

        if ($levels):
            foreach ($levels as $value):
                $this->db->set('player_id', $id);
                $this->db->set('level_id', $value);
                $this->db->insert('cricket_player_levels');
            endforeach;
        endif;
    }

    public function setTeam($id, $team_id) {
        $this->db->trans_start();
        $this->db->set('team_id', $team_id);
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

    public function getRoles($id) {
        $this->db->from('cricket_player_roles');
        $this->db->where('player_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        $data = array();
        if ($result):
            foreach ($result as $value) :
                $data[] = $value['role_id'];
            endforeach;
        endif;

        return $data;
    }

    public function getRoleNames($id) {
        $this->db->from('cricket_player_roles_view');
        $this->db->where('player_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        $data = array();
        if ($result):
            foreach ($result as $value) :
                $data[] = array(
                    'role_id' => $value['role_id'],
                    'role_name' => $value['role_name'],
                    'role_short_name' => $value['role_short_name'],
                );
            endforeach;
        endif;

        return $data;
    }

    public function getLevels($id) {
        $this->db->from('cricket_player_levels');
        $this->db->where('player_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        $data = array();
        if ($result):
            foreach ($result as $value) :
                $data[] = $value['level_id'];
            endforeach;
        endif;

        return $data;
    }

    public function getLevelNames($id) {
        $this->db->from('cricket_player_levels_view');
        $this->db->where('player_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        $data = array();
        if ($result):
            foreach ($result as $value) :
                $data[] = array(
                    'level_id' => $value['level_id'],
                    'level_name' => $value['level_name'],
                );
            endforeach;
        endif;

        return $data;
    }

}

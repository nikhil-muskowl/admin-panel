<?php

class Story_types_model extends CI_Model {

    private $table = 'story_types';
    private $table_view = 'story_types_view';
    private $column_order = array(null, 'title', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('title', 'status', 'created_date', 'modified_date');
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

        $this->db->set('image', $this->custom_image->get_path($this->input->post('image')));
        $this->db->set('is_upload', $this->input->post('is_upload'));
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
        $this->db->delete('story_type_details');

        if ($this->input->post('details')):
            foreach ($this->input->post('details') as $key => $value) :
                $this->db->set('id', $id);
                $this->db->set('language_id', $key);
                $this->db->set('title', $value['title']);
                $this->db->insert('story_type_details');
            endforeach;
        endif;
    }

    public function details($id) {
        $result = array();
        $this->db->from('story_type_details');
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

    public function getTotalFlames($id) {
        $this->db->select('SUM((SELECT SUM(sr.likes)-SUM(sr.dislikes) FROM story_rankings sr WHERE sr.story_id=st.story_id)) AS totalFlames');
        $this->db->from('story_to_types st');
        $this->db->where('st.story_type_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($result['totalFlames']):
            return $result['totalFlames'];
        else:
            return 0;
        endif;
    }

    public function getTopUsers($id) {
        $this->db->select('s.user_id');
        $this->db->select('u.name AS user_name');
        $this->db->select('u.image AS user_image');
        $this->db->select('(SELECT SUM(level) AS level FROM user_pets up WHERE up.user_id=s.user_id) AS level');
        $this->db->select('(SELECT SUM(sr.likes-sr.dislikes) FROM story_rankings sr WHERE sr.story_id=s.id) AS totalFlames');
        $this->db->from('stories s');
        $this->db->join('users u', 'u.id=s.user_id');
        $this->db->where('s.id IN (SELECT stt.story_id FROM story_to_types stt WHERE stt.story_type_id=' . $id . ')');
        $this->db->order_by('totalFlames', 'DESC');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

}

<?php

class Events_model extends CI_Model {

    private $table = 'events';
    private $detailTable = 'event_details';
    private $table_view = 'events_view';
    private $column_order = array(null, 'title', 'status', 'modified_date', null);
    private $column_search = array('title', 'status', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $language_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;
    }

    private function _getTablesQuery($array = array()) {
        $this->db->select('s.*');

        if ($this->input->post('latitude') && !empty($this->input->post('latitude')) && $this->input->post('longitude') && !empty($this->input->post('longitude'))):

            $latitude = number_format((float) $this->input->post('latitude'), 6);
            $longitude = number_format((float) $this->input->post('longitude'), 6);

            $this->db->select('(6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( s.latitude ) ) * cos( radians( s.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( s.latitude ) ) ) ) AS distance');
        else:
            $this->db->select('0 AS distance');
        endif;

        $this->db->from('events_view s');

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);

        if ($this->input->post('location')):
            $this->db->where('location', $this->input->post('location'));
        endif;

        if ($this->input->post('user_id')):
            $this->db->where('user_id', $this->input->post('user_id'));
        endif;

        if ($this->input->post('user_name')):
            $this->db->like('user_name', $this->input->post('user_name'));
        endif;

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


//        print_r($this->column_order[1]);
//        exit;

        if (isset($_POST['order'])) :
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        elseif (isset($this->order)) :
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        endif;

        if ($this->input->post('latitude') && !empty($this->input->post('latitude')) && $this->input->post('longitude') && !empty($this->input->post('longitude'))):
            if ($this->input->post('distance') && !empty($this->input->post('distance'))):
                $this->db->having('distance <=', $this->input->post('distance'));
            endif;
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

        if ($this->input->post('location')):
            $this->db->where('location', $this->input->post('location'));
        endif;

        if ($this->input->post('user_id')):
            $this->db->where('user_id', $this->input->post('user_id'));
        endif;

        if ($this->input->post('user_name')):
            $this->db->like('user_name', $this->input->post('user_name'));
        endif;

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
        $this->db->set('from_date', date('Y-m-d h:i:sa', strtotime($this->input->post('from_date'))));
        $this->db->set('to_date', date('Y-m-d h:i:sa', strtotime($this->input->post('to_date'))));

        $this->db->set('image', $this->custom_image->get_path($this->input->post('image')));
        $this->db->set('banner', $this->custom_image->get_path($this->input->post('banner')));

        $this->db->set('latitude', number_format((float) $this->input->post('latitude'), 6));
        $this->db->set('longitude', number_format((float) $this->input->post('longitude'), 6));

        if ($this->input->post('location_api_type')=='google'):
            $this->db->set('location', $this->input->post('google_location'));
        elseif ($this->input->post('location_api_type')=='baidu'):
            $this->db->set('location', $this->input->post('baidu_location'));
        else:
            $this->db->set('location', $this->google_lib->countryNameByPosition($this->input->post('latitude'), $this->input->post('longitude')));
        endif;

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->postDetails($id);

        if ($this->plugin_lib->check('user_activities_module')):
            $text = 'post this event';
            $this->setActivity($id, $text);
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

    public function postDetails($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->detailTable);

        if ($this->input->post('details')):
            foreach ($this->input->post('details') as $key => $value) :
                $this->db->set('id', $id);
                $this->db->set('language_id', $key);
                $this->db->set('title', $value['title']);
                $this->db->set('description', $value['description']);
                $this->db->set('html', $value['html']);
                $this->db->insert($this->detailTable);
            endforeach;
        endif;
    }

    public function details($id) {
        $result = array();
        $this->db->from($this->detailTable);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[$value['language_id']] = array(
                    'id' => $value['id'],
                    'language_id' => $value['language_id'],
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'html' => $value['html']
                );
            endforeach;
        endif;

        return $result;
    }

    public function apiPostData() {
        $this->db->trans_start();

        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->set('from_date', date('Y-m-d h:i:sa', strtotime($this->input->post('from_date'))));
        $this->db->set('to_date', date('Y-m-d h:i:sa', strtotime($this->input->post('to_date'))));

        $this->db->set('latitude', number_format((float) $this->input->post('latitude'), 6));
        $this->db->set('longitude', number_format((float) $this->input->post('longitude'), 6));

        if ($this->input->post('latitude') && $this->input->post('longitude')):
            $this->db->set('location', $this->google_lib->countryNameByPosition($this->input->post('latitude'), $this->input->post('longitude')));
        endif;

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->db->where('id', $id);
        $this->db->delete('event_details');

        $this->db->set('id', $id);
        $this->db->set('language_id', $this->input->post('language_id'));
        $this->db->set('title', $this->input->post('title'));
        $this->db->set('description', $this->input->post('description'));
        $this->db->insert('event_details');

        if ($this->plugin_lib->check('user_activities_module')):
            $text = 'post this event';
            $this->setActivity($id, $text);
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

    public function getAllLocations() {
        $result = array();
        $this->db->from($this->table);
        $this->db->where('location !=', '');
        $this->db->group_by('location');
        $query = $this->db->get();
        $description = $query->result_array();
        if ($description):
            foreach ($description as $value) :
                $result[] = array(
                    'location' => $value['location']
                );
            endforeach;
        endif;
        return $result;
    }

    public function setActivity($event_id, $text) {
        $this->db->trans_start();

        $this->db->set('user_id', $this->input->post('user_id'));
        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->set('language_id', $this->language_id);
        $this->db->set('type', 'event');
        $this->db->set('type_id', $event_id);
        $this->db->set('text', $text);

        $this->db->insert('user_activities');

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

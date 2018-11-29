<?php

class Stories_model extends CI_Model {

    private $table = 'stories';
    private $detailTable = 'story_details';
    private $table_view = 'stories_view';
    private $column_order = array(null, 'title', 'location', 'totalLikes', 'rank', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('title', 'location', 'totalLikes', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $language_id;
    private $pet_module;
    private $user_activities_module;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;

        if ($this->plugin_lib->check('pet_module')):
            $this->pet_module = TRUE;
        else :
            $this->pet_module = FALSE;
        endif;
        if ($this->user_activities_module):
            $this->user_activities_module = TRUE;
        else :
            $this->user_activities_module = FALSE;
        endif;

        $this->StoryRanked();
    }

    private function _getTablesQuery($array = array()) {
        $this->db->select('s.*');

        if ($this->pet_module):
            $this->db->select('(SELECT SUM(up.level) FROM user_pets up WHERE up.user_id=s.user_id) AS user_level');
        else:
            $this->db->select('0 AS user_level');
        endif;


        if ($this->input->post('story_type_id')):
            $this->db->select('(SELECT rank FROM story_to_types WHERE story_type_id=' . $this->input->post('story_type_id') . ' AND story_id=s.id LIMIT 1) AS rank');
        else:
            $this->db->select('(@acount:=@acount+1) AS rank');
        endif;

        if ($this->input->post('latitude') && !empty($this->input->post('latitude')) && $this->input->post('longitude') && !empty($this->input->post('longitude'))):

            $latitude = number_format((float) $this->input->post('latitude'), 6);
            $longitude = number_format((float) $this->input->post('longitude'), 6);

            $this->db->select('(6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( s.latitude ) ) * cos( radians( s.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( s.latitude ) ) ) ) AS distance');
        else:
            $this->db->select('0 AS distance');
        endif;

        $this->db->from('(SELECT @acount:= 0) AS acount,stories_view s');

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

        if ($this->input->post('event_id')):
            $this->db->where('event_id', $this->input->post('event_id'));
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


        if ($this->input->post('story_type_id')):
            $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id=' . $this->input->post('story_type_id') . ')', NULL);
        endif;

        if ($this->input->post('save_story_id')):
            $this->db->where('id IN(SELECT story_id FROM save_stories WHERE user_id=' . $this->input->post('save_story_id') . ')', NULL);
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


        if ($this->input->post('story_type_id')):
            $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id=' . $this->input->post('story_type_id') . ')', NULL);
        endif;

        if ($this->input->post('save_story_id')):
            $this->db->where('id IN(SELECT story_id FROM save_stories WHERE user_id=' . $this->input->post('save_story_id') . ')', NULL);
        endif;
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
        $this->db->set('event_id', $this->input->post('event_id'));
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

        $this->setTags($id);
        $this->setTypes($id);
        $this->postDetails($id);
        $this->postImages($id);


        if ($this->user_activities_module):
            $text = 'post this story';
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

    public function postImages($story_id) {
        $this->db->where('story_id', $story_id);
        $this->db->delete('story_images');

        if ($this->input->post('images')):
            foreach ($this->input->post('images') as $value) :
                $this->db->set('story_id', $story_id);
                $this->db->set('image', $this->custom_image->get_path($value['image']));
                $this->db->set('link', $value['link']);
                $this->db->set('sort_order', $value['sort_order']);
                $this->db->insert('story_images');
                $id = $this->db->insert_id();

                $this->postImageDetails($id, $value['image_details']);
            endforeach;
        endif;
    }

    public function images($id) {
        $result = array();
        $this->db->from('story_images');
        $this->db->where('story_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function postImageDetails($id, $image_details) {
        $this->db->where('id', $id);
        $this->db->delete('story_image_details');

        if ($image_details):
            foreach ($image_details as $key => $value) :
                $this->db->set('id', $id);
                $this->db->set('language_id', $key);
                $this->db->set('title', $value['title']);
                $this->db->set('description', $value['description']);
                $this->db->set('html', $value['html']);
                $this->db->insert('story_image_details');
            endforeach;
        endif;
    }

    public function imageDetails($id) {
        $result = array();
        $this->db->from('story_image_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[$value['language_id']] = array(
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'html' => $value['html']
                );
            endforeach;
        endif;

        return $result;
    }

    public function setTags($id) {
        $this->db->where('story_id', $id);
        $this->db->delete('story_tags');

        if ($this->input->post('tags')):
            foreach ($this->input->post('tags') as $value) :
                $this->db->set('story_id', $id);
                $this->db->set('tag', $value);
                $this->db->insert('story_tags');
            endforeach;
        endif;
    }

    public function getTags($id) {
        $result = array();
        $this->db->from('story_tags');
        $this->db->where('story_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['tag'];
            endforeach;
        endif;

        return $result;
    }

    public function setTypes($id) {
        $this->db->where('story_id', $id);
        $this->db->delete('story_to_types');

        if ($this->input->post('types')):
            foreach ($this->input->post('types') as $value) :
                $this->db->set('story_id', $id);
                $this->db->set('story_type_id', $value);
                $this->db->insert('story_to_types');
            endforeach;
        endif;
    }

    public function getTypesNames($id) {
        $result = array();
        $this->db->select('stt.*,stv.language_id,stv.title');
        $this->db->from('story_to_types stt');
        $this->db->join('story_types_view stv', 'stv.id=stt.story_type_id');
        $this->db->where('stt.story_id', $id);

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);

        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['title'];
            endforeach;
        endif;

        return $result;
    }

    public function getTypes($id) {
        $result = array();
        $this->db->from('story_to_types');
        $this->db->where('story_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['story_type_id'];
            endforeach;
        endif;

        return $result;
    }

    public function apiPostData() {
        $this->db->trans_start();

        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->set('event_id', $this->input->post('event_id'));
        $this->db->set('latitude', number_format((float) $this->input->post('latitude'), 6));
        $this->db->set('longitude', number_format((float) $this->input->post('longitude'), 6));

        if ($this->input->post('latitude') && $this->input->post('longitude')):
            $this->db->set('location', $this->google_lib->countryNameByPosition($this->input->post('latitude'), $this->input->post('longitude')));
        endif;

        if ($this->input->post('receipt')):
            $receipt = $this->custom_image->base64Image($this->input->post('receipt'));
            $this->db->set('receipt', $receipt);
        endif;

        $this->db->set('receipt_private', $this->input->post('receipt_private'));

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->db->where('id', $id);
        $this->db->delete('story_details');

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        if ($languages):
            foreach ($languages as $language) :
                $this->db->set('id', $id);
                $this->db->set('language_id', $language['id']);
                $this->db->set('title', $this->input->post('title'));
                $this->db->set('description', $this->input->post('description'));
                $this->db->insert('story_details');
            endforeach;
        endif;

        $this->db->where('story_id', $id);
        $this->db->delete('story_to_types');

        if ($this->input->post('types') && !is_array($this->input->post('types'))):
            $types = json2arr($this->input->post('types'));
            foreach ($types as $value) :
                $this->db->set('story_id', $id);
                $this->db->set('story_type_id', $value);
                $this->db->insert('story_to_types');
            endforeach;
        endif;

        if ($this->input->post('images') && !is_array($this->input->post('images'))):
            $images = json2arr($this->input->post('images'));
            if ($images):
                foreach ($images as $imagesKey => $value) :
                    $image = $this->custom_image->base64Image($value['image']);
                    if ($imagesKey == 0):
                        $this->db->set('image', $image);
                        $this->db->where('id', $id);
                        $this->db->update($this->table);
                    else:
                        $this->db->set('story_id', $id);
                        $this->db->set('image', $image);
                        $this->db->insert('story_images');
                    endif;
                endforeach;
            endif;
        endif;

        $this->db->where('story_id', $id);
        $this->db->delete('story_tags');

        if ($this->input->post('tags') && !is_array($this->input->post('tags'))):
            $tags = json2arr($this->input->post('tags'));
            foreach ($tags as $value) :
                $this->db->set('story_id', $id);
                $this->db->set('tag', $value);
                $this->db->insert('story_tags');
            endforeach;
        endif;

        if ($this->plugin_lib->check('pet_module')):
            $points = $this->settings_lib->config('pet_module', 'story_upload_points');
            $this->setPoints($this->input->post('user_id'), $points);
        endif;

        if ($this->user_activities_module):
            $text = 'post this story';
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

    public function checkRanking($id) {
        $this->db->from('story_rankings');
        $this->db->where('story_id', $id);
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function setRanking() {
        $this->db->trans_start();
        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->set('story_id', $this->input->post('story_id'));
        $this->db->set('likes', $this->input->post('likes'));
        $this->db->set('dislikes', $this->input->post('dislikes'));
        $this->db->insert('story_rankings');

        if ($this->plugin_lib->check('pet_module')):
            if ($this->input->post('likes')):
                $points = $this->settings_lib->config('pet_module', 'story_like_points');
                $this->setPoints($this->input->post('user_id'), $points);
            endif;

            if ($this->input->post('dislikes')):
                $points = $this->settings_lib->config('pet_module', 'story_dislike_points');
                $this->setPoints($this->input->post('user_id'), $points);
            endif;
        endif;

        if ($this->user_activities_module):
            if ($this->input->post('likes')):
                $text = 'like this story';
                $this->setActivity($this->input->post('story_id'), $text);
            endif;
            if ($this->input->post('dislikes')):
                $text = 'dislike this story';
                $this->setActivity($this->input->post('story_id'), $text);
            endif;
        endif;

        $this->StoryRanked();

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getRanking($this->input->post('story_id'));
        }
    }

    public function getRanking($id) {
        $this->db->select('SUM(likes) AS likes');
        $this->db->select('SUM(dislikes) AS dislikes');
        $this->db->from('story_rankings');
        $this->db->where('story_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();
        return $description;
    }

    public function getTopFollowersStories($data = array()) {
        $result = array();
        $this->db->select('s.*');
        $this->db->select('(SELECT SUM(up.level) FROM user_pets up WHERE up.user_id=s.user_id) AS user_level');
        if (isset($data['latitude']) && !empty($data['latitude']) && isset($data['longitude']) && !empty($data['longitude'])):

            $latitude = number_format((float) $data['latitude'], 6);
            $longitude = number_format((float) $data['longitude'], 6);

            $this->db->select('(6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( s.latitude ) ) * cos( radians( s.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( s.latitude ) ) ) ) AS distance');
        else:
            $this->db->select('0 AS distance');
        endif;

        $this->db->from('stories_view s');

//        if (isset($data['user_id']) && $data['user_id'] != 0):
//            $this->db->where('s.user_id IN(SELECT f.current_user_id FROM followers f WHERE f.user_id=' . $data['user_id'] . ')', NULL);
//        endif;


        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);

        if ($this->input->post('currect_user_id')):
            $this->db->where('user_id', $this->input->post('currect_user_id'));
        endif;

        if ($this->input->post('user_name')):
            $this->db->like('user_name', $this->input->post('user_name'));
        endif;

        if ($this->input->post('location')):
            $this->db->where('location', $this->input->post('location'));
        endif;

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);


        if ($this->input->post('story_types')):
            if (!is_array($this->input->post('story_types'))):
                $story_types = json2arr($this->input->post('story_types'));
                $story_types = implode(',', $story_types);
                if (!empty($story_types) && !is_array($story_types)):
                    $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id IN(' . $story_types . '))', NULL);
                endif;
            endif;
        endif;

        if ($this->input->post('story_type_id')):
            $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id=' . $this->input->post('story_type_id') . ')', NULL);
        endif;

        if (isset($data['group_by']) && is_array($data['group_by'])):
            $this->db->group_by($data['group_by']);
        endif;

        if (isset($data['latitude']) && !empty($data['latitude']) && isset($data['longitude']) && !empty($data['longitude'])):
            if (isset($data['distance']) && !empty($data['distance'])):
                $this->db->having('distance <=', $data['distance']);
            endif;
        endif;

        if (isset($data['order_by']) && !empty($data['order_by']) && isset($data['order_type']) && !empty($data['order_type'])):
            $this->db->order_by($data['order_by'], $data['order_type']);
        endif;

        if (isset($data['user_id']) && $data['user_id'] != 0):
            $this->db->order_by('CASE WHEN s.user_id IN(SELECT f.current_user_id FROM followers f WHERE f.user_id=' . $data['user_id'] . ') THEN s.user_id END ASC', NULL);
        endif;

        if (isset($data['length']) && isset($data['start'])):
            $this->db->limit($data['length'], $data['start']);
        endif;


        $query = $this->db->get();

//        print_r($this->db->last_query());
//        exit;

        $result = $query->result_array();

        return $result;
    }

    public function getFollowersStories($data = array()) {
        $result = array();
        $this->db->select('s.*');
        $this->db->select('(SELECT SUM(up.level) FROM user_pets up WHERE up.user_id=s.user_id) AS user_level');

        if ($this->input->post('story_type_id')):
            $this->db->select('(SELECT rank FROM story_to_types WHERE story_type_id=' . $this->input->post('story_type_id') . ' AND story_id=s.id LIMIT 1) AS rank');
        else:
            $this->db->select('(@acount:=@acount+1) AS rank');
        endif;
        $this->db->from('(SELECT @acount:= 0) AS acount,stories_view s');

//        if (isset($data['user_id']) && $data['user_id'] != 0):
//            $this->db->where('s.user_id IN(SELECT f.current_user_id FROM followers f WHERE f.user_id=' . $data['user_id'] . ')', NULL);
//        endif;

        if (isset($data['latitude']) && !empty($data['latitude'])):
            $latitude = number_format((float) $data['latitude'], 6);
            $this->db->where('latitude', $latitude);
        endif;

        if (isset($data['longitude']) && !empty($data['longitude'])):
            $longitude = number_format((float) $data['longitude'], 6);
            $this->db->where('longitude', $longitude);
        endif;

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);

        if ($this->input->post('currect_user_id')):
            $this->db->where('user_id', $this->input->post('currect_user_id'));
        endif;

        if ($this->input->post('user_name')):
            $this->db->like('user_name', $this->input->post('user_name'));
        endif;

        if ($this->input->post('location')):
            $this->db->where('location', $this->input->post('location'));
        endif;

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);


        if ($this->input->post('story_types')):
            if (!is_array($this->input->post('story_types'))):
                $story_types = json2arr($this->input->post('story_types'));
                $story_types = implode(',', $story_types);
                if (!empty($story_types) && !is_array($story_types)):
                    $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id IN(' . $story_types . '))', NULL);
                endif;
            endif;
        endif;

        if ($this->input->post('story_type_id')):
            $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id=' . $this->input->post('story_type_id') . ')', NULL);
        endif;

        if (isset($data['group_by']) && is_array($data['group_by'])):
            $this->db->group_by($data['group_by']);
        endif;

        if (isset($data['order_by']) && !empty($data['order_by']) && isset($data['order_type']) && !empty($data['order_type'])):
            $this->db->order_by($data['order_by'], $data['order_type']);
        endif;

        if (isset($data['user_id']) && $data['user_id'] != 0):
            $this->db->order_by('CASE WHEN s.user_id IN(SELECT f.current_user_id FROM followers f WHERE f.user_id=' . $data['user_id'] . ') THEN s.user_id END ASC', NULL);
        endif;

        if (isset($data['length']) && isset($data['start'])):
            $this->db->limit($data['length'], $data['start']);
        endif;


        $query = $this->db->get();

//        print_r($this->db->last_query());
//        exit;

        $result = $query->result_array();

        return $result;
    }

    public function checkSaveStories($id) {
        $this->db->from('save_stories');
        $this->db->where('story_id', $id);
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function setSaveStory() {
        $this->db->trans_start();

        $this->db->set('story_id', $this->input->post('story_id'));
        $this->db->set('user_id', $this->input->post('user_id'));

        $this->db->insert('save_stories');

        if ($this->user_activities_module):
            $text = 'save this story';
            $this->setActivity($this->input->post('story_id'), $text);
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

    public function removeSaveStory() {
        $this->db->trans_start();

        $this->db->where('story_id', $this->input->post('story_id'));
        $this->db->where('user_id', $this->input->post('user_id'));

        $this->db->delete('save_stories');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function getAllLocations() {
        $result = array();
        $this->db->from($this->table);
        $this->db->where('location !=', '');
        $this->db->like('location', $this->input->post('location'));
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

    public function setPoints($id, $points) {
        $this->db->trans_start();
        $this->db->set('user_id', $id);
        $this->db->set('points', $points);
        $this->db->set('description', 'story bonus points');
        $this->db->insert('user_pet_points');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function setActivity($story_id, $text) {
        $this->db->trans_start();

        $this->db->set('user_id', $this->input->post('user_id'));
        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->set('language_id', $this->language_id);
        $this->db->set('type', 'story');
        $this->db->set('type_id', $story_id);
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

    public function StoryRanked() {
        $this->db->trans_start();

        $story_types = $this->db->get('story_types')->result_array();

        if ($story_types):
            foreach ($story_types as $story_type) :
                $this->db->from('stories_view');
                $this->db->where('id IN(SELECT story_id FROM story_to_types WHERE story_type_id=' . $story_type['id'] . ')', NULL);
                $this->db->order_by('totalLikes', 'DESC');
                $stories = $this->db->get()->result_array();

                if ($stories):
                    foreach ($stories as $key => $story) :
                        $rank = $key + 1;
                        $this->db->set('rank', $rank);
                        $this->db->where('story_type_id', $story_type['id']);
                        $this->db->where('story_id', $story['id']);
                        $this->db->update('story_to_types');

//                        print_r($this->db->last_query());
                    endforeach;
                endif;
            endforeach;
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

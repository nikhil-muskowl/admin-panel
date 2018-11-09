<?php

class Blogs_model extends CI_Model {

    private $table = 'blogs';
    private $detailTable = 'blog_details';
    private $table_view = 'blogs_view';
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


        if ($this->input->post('blog_type_id')):
            $this->db->where('id IN(SELECT blog_id FROM blog_to_types WHERE blog_type_id=' . $this->input->post('blog_type_id') . ')', NULL);
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
        
        $this->unsetUrlAlias($id);
        
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
        $this->setUrlAlias($id);

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

    public function postImages($blog_id) {
        $this->db->where('blog_id', $blog_id);
        $this->db->delete('blog_images');

        if ($this->input->post('images')):
            foreach ($this->input->post('images') as $value) :
                $this->db->set('blog_id', $blog_id);
                $this->db->set('image', $this->custom_image->get_path($value['image']));
                $this->db->set('link', $value['link']);
                $this->db->set('sort_order', $value['sort_order']);
                $this->db->insert('blog_images');
                $id = $this->db->insert_id();
            endforeach;
        endif;
    }

    public function images($id) {
        $result = array();
        $this->db->from('blog_images');
        $this->db->where('blog_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function setTypes($id) {
        $this->db->where('blog_id', $id);
        $this->db->delete('blog_to_types');

        if ($this->input->post('types')):
            foreach ($this->input->post('types') as $value) :
                $this->db->set('blog_id', $id);
                $this->db->set('blog_type_id', $value);
                $this->db->insert('blog_to_types');
            endforeach;
        endif;
    }

    public function getTypes($id) {
        $result = array();
        $this->db->from('blog_to_types');
        $this->db->where('blog_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['blog_type_id'];
            endforeach;
        endif;

        return $result;
    }
    
     public function getTypesNames($id) {
        $result = array();
        $this->db->select('stt.*,stv.language_id,stv.title');
        $this->db->from('blog_to_types stt');
        $this->db->join('blog_types_view stv', 'stv.id=stt.blog_type_id');
        $this->db->where('stt.blog_id', $id);

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
    
    public function setTags($id) {
        $this->db->where('blog_id', $id);
        $this->db->delete('blog_tags');

        if ($this->input->post('tags')):
            foreach ($this->input->post('tags') as $value) :
                $this->db->set('blog_id', $id);
                $this->db->set('tag', $value);
                $this->db->insert('blog_tags');
            endforeach;
        endif;
    }

    public function getTags($id) {
        $result = array();
        $this->db->from('blog_tags');
        $this->db->where('blog_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['tag'];
            endforeach;
        endif;

        return $result;
    }

    public function unsetUrlAlias($id) {
        $this->db->where('type_id', $id);
        $this->db->where('type', 'blogs');
        $this->db->delete('url_alias');
    }

    public function setUrlAlias($id) {
        $this->unsetUrlAlias($id);
        if ($this->input->post('url_alias')):
            foreach ($this->input->post('url_alias') as $key => $value) :
                $this->db->set('language_id', $key);
                $this->db->set('type_id', $id);
                $this->db->set('type', 'blogs');
                $this->db->set('keyword', $value['keyword']);
                $this->db->set('meta_title', $value['meta_title']);
                $this->db->set('meta_keyword', $value['meta_keyword']);
                $this->db->set('meta_description', $value['meta_description']);
                $this->db->insert('url_alias');
            endforeach;
        endif;
    }

    public function getUrlAlias($id) {
        $result = array();
        $this->db->from('url_alias');
        $this->db->where('type_id', $id);
        $this->db->where('type', 'blogs');
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[$value['language_id']] = array(
                    'language_id' => $value['language_id'],
                    'keyword' => $value['keyword'],
                    'meta_title' => $value['meta_title'],
                    'meta_keyword' => $value['meta_keyword'],
                    'meta_description' => $value['meta_description']
                );
            endforeach;
        endif;

        return $result;
    }

}

<?php

class Products_model extends CI_Model {

    private $table = 'products';
    private $detailTable = 'product_details';
    private $table_view = 'products_view';
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


        if ($this->input->post('category_id')):
            $this->db->where('id IN(SELECT product_id FROM product_to_categories WHERE category_id=' . $this->input->post('category_id') . ')', NULL);
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

        $this->db->set('model', $this->input->post('model'));
        $this->db->set('sku', $this->input->post('sku'));
        $this->db->set('price', $this->input->post('price'));
        $this->db->set('quantity', $this->input->post('quantity'));
        $this->db->set('image', $this->custom_image->get_path($this->input->post('image')));
        $this->db->set('banner', $this->custom_image->get_path($this->input->post('banner')));
        $this->db->set('weight', $this->input->post('weight'));
        $this->db->set('length', $this->input->post('length'));
        $this->db->set('width', $this->input->post('width'));
        $this->db->set('height', $this->input->post('height'));
        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;
        $this->setCategories($id);
        $this->postDetails($id);
        $this->postImages($id);
        $this->setAttributes($id);
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

    public function postImages($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_images');

        if ($this->input->post('images')):
            foreach ($this->input->post('images') as $value) :
                $this->db->set('product_id', $product_id);
                $this->db->set('image', $this->custom_image->get_path($value['image']));
                $this->db->set('link', $value['link']);
                $this->db->set('sort_order', $value['sort_order']);
                $this->db->insert('product_images');
            endforeach;
        endif;
    }

    public function images($id) {
        $result = array();
        $this->db->from('product_images');
        $this->db->where('product_id', $id);
        $this->db->order_by('sort_order');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function setCategories($id) {
        $this->db->where('product_id', $id);
        $this->db->delete('product_to_categories');

        if ($this->input->post('categories')):
            foreach ($this->input->post('categories') as $value) :
                $this->db->set('product_id', $id);
                $this->db->set('category_id', $value);
                $this->db->insert('product_to_categories');
            endforeach;
        endif;
    }

    public function getCategories($id) {
        $result = array();
        $this->db->from('product_to_categories');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['category_id'];
            endforeach;
        endif;

        return $result;
    }

    public function setAttributes($id) {
        if ($this->input->post('attributes')):
            foreach ($this->input->post('attributes') as $value) :


                if ($value['attribute_id']):
                    $this->db->where('product_id', $id);
                    $this->db->where('attribute_id', $value['attribute_id']);
                    $this->db->delete('product_attributes');


                    foreach ($value['description'] as $language_id => $description) :
                        $this->db->where('product_id', $id);
                        $this->db->where('attribute_id', $value['attribute_id']);
                        $this->db->where('language_id', $language_id);
                        $this->db->delete('product_attributes');

                        $this->db->set('product_id', $id);
                        $this->db->set('language_id', $language_id);
                        $this->db->set('attribute_id', $value['attribute_id']);
                        $this->db->set('text', $description['text']);
                        $this->db->insert('product_attributes');
                    endforeach;
                endif;
            endforeach;
        endif;
    }

    public function getAttributes($id) {
        $product_attribute_data = array();
        
        $this->db->where('product_id', $id);
        $this->db->from('product_attributes');
        $this->db->group_by('attribute_id');
        $attribute_query = $this->db->get()->result_array();

        foreach ($attribute_query as $attribute) :
            $attribute_description_data = array();

            $this->db->where('product_id', $id);
            $this->db->where('attribute_id', $attribute['attribute_id']);
            
            $this->db->from('product_attributes');
            $attribute_description_query = $this->db->get()->result_array();

            foreach ($attribute_description_query as $attribute_description) :
                $attribute_description_data[$attribute_description['language_id']] = array('text' => $attribute_description['text']);
            endforeach;

            $product_attribute_data[] = array(
                'attribute_id' => $attribute['attribute_id'],
                'description' => $attribute_description_data
            );
        endforeach;

        return $product_attribute_data;
    }

    public function getProductAttributes($id) {
        $attribute_group_data = array();

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;


        $this->db->where('product_id', $id);
        $this->db->where('language_id', $this->language_id);
        $this->db->from('product_attributes_view');
        $this->db->group_by('group_id');
        $this->db->order_by('attribute_group,attribute_group_sort_order');
        $attribute_group_query = $this->db->get()->result_array();

        foreach ($attribute_group_query as $product_attribute_group):
            $attribute_data = array();

            $this->db->where('product_id', $id);
            $this->db->where('language_id', $this->language_id);
            $this->db->where('group_id', $product_attribute_group['group_id']);
            $this->db->from('product_attributes_view');
            $this->db->order_by('attribute,attribute_sort_order');

            $attribute_query = $this->db->get()->result_array();

            foreach ($attribute_query as $product_attribute):
                $attribute_data[] = array(
                    'attribute_id' => $product_attribute['attribute_id'],
                    'attribute' => $product_attribute['attribute'],
                    'text' => $product_attribute['text'],
                );
            endforeach;

            $attribute_group_data[] = array(
                'group_id' => $product_attribute_group['group_id'],
                'attribute_group' => $product_attribute_group['attribute_group'],
                'attributes' => $attribute_data
            );
        endforeach;

        return $attribute_group_data;
    }

    public function unsetUrlAlias($id) {
        $this->db->where('type_id', $id);
        $this->db->where('type', 'products');
        $this->db->delete('url_alias');
    }

    public function setUrlAlias($id) {
        $this->unsetUrlAlias($id);
        if ($this->input->post('url_alias')):
            foreach ($this->input->post('url_alias') as $key => $value) :
                $this->db->set('language_id', $key);
                $this->db->set('type_id', $id);
                $this->db->set('type', 'products');
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
        $this->db->where('type', 'products');
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

<?php

class Orders_model extends CI_Model {

    private $table = 'orders';
    private $table_view = 'orders';
    private $column_order = array(null, 'name', 'email', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('name', 'email', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $language_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;

        $this->load->model('address_module/countries_model');
        $this->load->model('address_module/zones_model');
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


        if ($this->input->post('user_id')):
            $this->db->where('user_id', $this->input->post('user_id'));
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
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);


        if ($this->input->post('user_id')):
            $this->db->where('user_id', $this->input->post('user_id'));
        endif;
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
        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('contact', $this->input->post('contact'));
        $this->db->set('payment_name', $this->input->post('payment_name'));

        if ($this->input->post('payment_country_id')):
            $this->db->set('payment_country_id', $this->input->post('payment_country_id'));
            $countries = $this->countries_model->getById($this->input->post('payment_country_id'));
            $this->db->set('payment_country', $countries['name']);
        endif;


        if ($this->input->post('payment_zone_id')):
            $this->db->set('payment_zone_id', $this->input->post('payment_zone_id'));
            $zones = $this->zones_model->getById($this->input->post('payment_zone_id'));
            $this->db->set('payment_zone', $zones['name']);
        endif;


        $this->db->set('payment_city', $this->input->post('payment_city'));
        $this->db->set('payment_postcode', $this->input->post('payment_postcode'));
        $this->db->set('payment_address', $this->input->post('payment_address'));
//        $this->db->set('payment_method', $this->input->post('payment_method'));
//        $this->db->set('payment_code', $this->input->post('payment_code'));

        $this->db->set('shipping_name', $this->input->post('shipping_name'));

        if ($this->input->post('shipping_country_id')):
            $this->db->set('shipping_country_id', $this->input->post('shipping_country_id'));
            $countries = $this->countries_model->getById($this->input->post('shipping_country_id'));
            $this->db->set('shipping_country', $countries['name']);
        endif;

        if ($this->input->post('shipping_zone_id')):
            $this->db->set('shipping_zone_id', $this->input->post('shipping_zone_id'));
            $zones = $this->zones_model->getById($this->input->post('shipping_zone_id'));
            $this->db->set('shipping_zone', $zones['name']);
        endif;


        $this->db->set('shipping_city', $this->input->post('shipping_city'));
        $this->db->set('shipping_postcode', $this->input->post('shipping_postcode'));
        $this->db->set('shipping_address', $this->input->post('shipping_address'));
        $this->db->set('shipping_city', $this->input->post('shipping_city'));
//        $this->db->set('shipping_method', $this->input->post('shipping_method'));
//        $this->db->set('shipping_code', $this->input->post('shipping_code'));

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->set('language_id', $this->language_id);

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;
        
      
        $this->setOrderProducts($id);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            $this->clearUserCart($this->input->post('user_id'));
            return TRUE;
        }
    }

    public function setOrderProducts($id) {
        $this->db->where('order_id', $id);
        $this->db->delete('order_products');

        $carts = $this->getUserCarts($this->input->post('user_id'));

        if ($carts):
            foreach ($carts as $cart) :
                $this->db->set('order_id', $id);
                $this->db->set('product_id', $cart['product_id']);
                $this->db->set('name', $cart['product_name']);
                $this->db->set('model', $cart['model']);
                $this->db->set('quantity', $cart['quantity']);
                $this->db->set('price', $cart['price']);
                $this->db->set('total', $cart['price'] * $cart['quantity']);
                $this->db->insert('order_products');
            endforeach;
        endif;
    }

    public function getUserCarts($id) {
        $this->db->from('carts_view');
        $this->db->where('user_id', $id);
        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function clearUserCart($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('carts');       
    }

}

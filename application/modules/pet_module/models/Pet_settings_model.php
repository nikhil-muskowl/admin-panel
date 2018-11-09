<?php

class Pet_settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function post() {
        $this->db->trans_start();

        $this->db->where('code', 'pet_module');
        $this->db->delete('settings');
        foreach ($this->input->post() as $key => $value) :
            $data = array(
                'code' => 'pet_module',
                'code_key' => $key,
                'value' => $value,
            );
            $this->db->insert('settings', $data);
        endforeach;

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

<?php

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function post() {
        $this->db->trans_start();

        $this->db->where('code', 'config');
        $this->db->delete('settings');
        foreach ($this->input->post() as $key => $value) {
            if ($key == 'image' || $key == 'favicon') {
                $value = $this->custom_image->get_path($value);
            }

            $data = array(
                'code' => 'config',
                'code_key' => $key,
                'value' => $value,
            );
            $this->db->insert('settings', $data);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function cleanUrl() {
        $results = $this->db->get('url_alias')->result();
        if ($results):
            foreach ($results as $key => $value) :
                if ($this->db->table_exists($value->type)):
                    $tableResults = $this->db->get_where($value->type, array('id' => $value->type_id))->result();
                    if (!$tableResults):
                        $this->db->where('id', $value->id);
                        $this->db->delete('url_alias');
                    endif;
                else:
                    $this->db->where('id', $value->id);
                    $this->db->delete('url_alias');
                endif;
            endforeach;
        endif;
    }

}

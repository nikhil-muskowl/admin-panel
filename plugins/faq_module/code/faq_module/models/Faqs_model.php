<?php

class Faqs_model extends CI_Model {

    private $table = 'faq_questions_view';
    private $sub_table = 'faq_answers_view';
    private $status;
    private $language_id;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;
    }

    public function faq_questions() {
        $this->db->from($this->table);
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
        $query = $this->db->get();
        return $query->result_array();
    }

    public function faq_answers($id) {
        $this->db->from($this->sub_table);

        $this->db->where('question_id', $id);

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
        $query = $this->db->get();
        return $query->result_array();
    }

}

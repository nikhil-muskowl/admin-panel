<?php

class LanguageLoader {

    private $ci;
    private $language_id = 1;
    private $language = 'english';

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->helper('language');
        if ($this->ci->session->userdata('language_id')):
            $this->language_id = $this->ci->session->userdata('language_id');
        endif;
        if ($this->ci->session->userdata('language')):
            $this->language = $this->ci->session->userdata('language');
        endif;
    }

    public function initialize() {
        $this->ci->lang->load('common', $this->language);
        $this->ci->lang->load('datatables', $this->language);
    }

}

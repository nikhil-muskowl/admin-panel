<?php

class Languages_lib {

    private $ci;
    private $language_id = 1;
    private $language = 'english';

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('settings/languages_model');

        if ($this->ci->session->userdata('language_id')):
            $this->language_id = $this->ci->session->userdata('language_id');
        endif;
        if ($this->ci->session->userdata('language')):
            $this->language = $this->ci->session->userdata('language');
        endif;
    }

    public function getAll() {
        $list = $this->ci->languages_model->getTables();
        return $list;
    }

    public function setLanguage($id) {
        $result = $this->ci->languages_model->getById($id);
        if ($result):
            $this->language_id = $result['id'];
            $this->language = $result['code'];
            $this->ci->session->set_userdata('language_id', $this->language_id);
            $this->ci->session->set_userdata('language', $this->language);

            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function getLanguageId() {
        return $this->language_id;
    }

    public function getLanguage() {
        return $this->language;
    }

}

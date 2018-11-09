<?php

class Plugin_lib {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('plugin_module/plugins_model');
    }

    public function check($code) {
        $result = $this->ci->plugins_model->getByCode($code);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

}

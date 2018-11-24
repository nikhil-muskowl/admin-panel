<?php

class Baidu extends CI_Controller {

    private $dataOutput;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        $this->meta_title = humanize(__CLASS__);
    }

    public function location() {

        $ak = 'j7eig5KpXzk4YsWNwpagmybjL2WRGCZC';

        if ($this->input->post('query')):
            $query = $this->input->post('query');
        else:
            $query = '';
        endif;
        if ($this->input->post('location')):
            $location = $this->input->post('location');
        else:
            $location = '';
        endif;

        $query = urlencode($query);

//        $filename = 'http://api.map.baidu.com/place/v2/search?query=' . $query . '&location=' . $location . '&output=json&ak=' . $ak;
        $filename = 'http://api.map.baidu.com/place/v2/suggestion?query=' . $query . '&region=' . $location . '&output=json&ak=' . $ak;
//        print_r($filename);
//        exit;
        $data = file_get_contents($filename);

        print_r($data);
        exit;
    }

}

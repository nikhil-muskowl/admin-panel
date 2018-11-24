<?php

class Google extends CI_Controller {

    private $dataOutput;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        $this->meta_title = humanize(__CLASS__);
        $this->load->library('google_lib');
    }

    public function countryNameByPosition() {
        $deal_lat = 24.5854;
        $deal_long = 73.7125;

        echo $this->google_lib->countryNameByPosition($deal_lat, $deal_long);
    }

    public function placeSearch() {
        if ($this->input->post('query')):
            $query = $this->input->post('query');
        else:
            $query = 'Location';
        endif;
        $data = $this->google_lib->placeSearch($query);
        print_r($data);
        exit;
    }

    public function date() {
        date_default_timezone_set('UTC');

        if (date_default_timezone_get()) {
            echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
        }

        if (ini_get('date.timezone')) {
            echo 'date.timezone: ' . ini_get('date.timezone');
        }
    }

}

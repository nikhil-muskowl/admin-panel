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

}

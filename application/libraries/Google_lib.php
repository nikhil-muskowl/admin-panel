<?php

class Google_lib {

    private $ci;
    private $key;
    private $latitude;
    private $longitude;
    private $status;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('settings_lib');
        $this->key = 'AIzaSyAOwnKmpn7vyLmrxds1vJXGzSaONvdjgmY';
    }

    public function countryNameByPosition($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $country = '';

        if ($this->latitude && $this->longitude):
            $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $this->latitude . ',' . $this->longitude . '&sensor=false&key=' . $this->key);
            if ($geocode):
                $output = json_decode($geocode);
                if ($output):
                    for ($j = 0; $j < count($output->results[0]->address_components); $j++) :
                        $cn = array($output->results[0]->address_components[$j]->types[0]);
                        if (in_array("country", $cn)) :
                            $country = $output->results[0]->address_components[$j]->long_name;
                        endif;
                    endfor;
                endif;
            endif;
        endif;

        return $country;
    }

    public function placeSearch($param) {
        $param = urlencode($param);        
        $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $param . "&inputtype=textquery&fields=formatted_address,name,geometry&key=" . $this->key;
        $data = file_get_contents($url);
        return $data;
    }

}

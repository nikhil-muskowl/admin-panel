<?php

class Settings_lib {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->database();
    }

    public function config($code, $key) {
        $this->ci->db->select('*');
        $this->ci->db->from('settings');
        $this->ci->db->where('code', $code);
        $this->ci->db->where('code_key', $key);
        $this->ci->db->limit(1);
        $query = $this->ci->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->row();
            return $result->value;
        } else {
            return FALSE;
        }
    }

    public function dateToDay($from, $to) {
        $start = strtotime($from);
        $end = strtotime($to);
        $timeDiff = abs($end - $start);
        $numberDays = $timeDiff/86400; 
        $numberDays = intval($numberDays);
        return $numberDays;
    }

    public function number_format($param) {
        return number_format((float) $param, $this->ci->settings_lib->config('config', 'decimal_format'), '.', '');
    }

    public function nice_number($n) {

        if ($n):
            // first strip any formatting;
            $n = (0 + str_replace(",", "", $n));

            // is this a number?
            if (!is_numeric($n))
                return false;

            // now filter it;
            if ($n > 1000000000000)
                return round(($n / 1000000000000), 2) . ' T';
            elseif ($n > 1000000000)
                return round(($n / 1000000000), 2) . ' B';
            elseif ($n > 1000000)
                return round(($n / 1000000), 2) . ' M';
            elseif ($n > 1000)
                return round(($n / 1000), 2) . ' K';

            return number_format($n);
        else:
            return 0;
        endif;
    }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

}

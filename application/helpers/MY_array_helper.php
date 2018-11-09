<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('obj2arr')) {

    function obj2arr($data) {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = obj2arr($value);
            }
            return $result;
        }
        return $data;
    }

}

if (!function_exists('remove_null')) {

    function remove_null($data) {
        if (is_array($data)) :
            foreach ($data as $key => $value) :
                if (is_array($value)):
                    foreach ($value as $key2 => $value2) :
                        if (is_null($value2)):
                            $value[$key2] = '';
                        endif;
                    endforeach;
                elseif (is_null($value)):
                    $data[$key] = '';
                endif;
            endforeach;
            return $data;
        endif;
    }

}


if (!function_exists('json2arr')) {

    function json2arr($data) {
        $data = json_decode($data);
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = obj2arr($value);
            }
            return $result;
        }
        return $data;
    }

}
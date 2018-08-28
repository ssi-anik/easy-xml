<?php
if (!function_exists('load_from_url')) {
    function load_from_url ($url, $options = []) {
        $curl = curl_init($url);
        curl_setopt_array($curl, is_array($options) ? $options : [ $options ]);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
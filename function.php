<?php

/********************* 自訂函數 *********************/
if (!function_exists('get_url')) {
    function get_url($url)
    {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            $timeout = 2;
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);
        } elseif (function_exists('file_get_contents')) {
            $arrContextOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ];
            $data = file_get_contents($url, false, stream_context_create($arrContextOptions));
        } else {
            // die('fopen');
            $handle = fopen($url, 'rb');
            $data = stream_get_contents($handle);
            fclose($handle);
        }

        return $data;
    }
}

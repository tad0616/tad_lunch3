<?php
/**
 * Tad Lunch3 module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Tad Lunch3
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/

//引入TadTools的函式庫
if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/tad_function.php')) {
    redirect_header('http://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=1', 3, _TAD_NEED_TADTOOLS);
}
require_once XOOPS_ROOT_PATH . '/modules/tadtools/tad_function.php';

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

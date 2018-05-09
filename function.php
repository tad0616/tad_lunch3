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
if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php")) {
    redirect_header("http://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=1", 3, _TAD_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php";

/********************* 自訂函數 *********************/
if (!function_exists('get_url')) {
    function get_url($url)
    {
        if (function_exists('curl_init')) {
            $ch      = curl_init();
            $timeout = 2;
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);
        } elseif (function_exists('file_get_contents')) {
            // die('file_get_contents');
            $data = file_get_contents($url);
        } else {
            // die('fopen');
            $handle = fopen($url, "rb");
            $data   = stream_get_contents($handle);
            fclose($handle);
        }
        return $data;
    }
}

//取得所有類別標題
if (!function_exists("block_schoolid")) {
    function block_schoolid($selected = "")
    {
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;

        if (empty($xoopsModuleConfig)) {
            $modhandler        = xoops_gethandler('module');
            $xoopsModule       = $modhandler->getByDirname("tad_lunch3");
            $config_handler    = xoops_gethandler('config');
            $mid               = $xoopsModule->mid();
            $xoopsModuleConfig = $config_handler->getConfigsByCat(0, $mid);
        } else {
            $mid = $xoopsModule->mid();
        }
        $SchoolIdArr = explode(';', $xoopsModuleConfig['SchoolId']);

        if (!empty($selected)) {
            $sc = explode(",", $selected);
        }

        $js = "<script>
            function bbv(){
              i=0;
              var arr = new Array();";

        foreach ($SchoolIdArr as $schoolid) {
            $js .= "if(document.getElementById('c{$schoolid}').checked){
            arr[i] = document.getElementById('c{$schoolid}').value;
            i++;
            }";
            $ckecked = (in_array($schoolid, $sc)) ? "checked" : "";
            $option .= "<span style='white-space:nowrap;'><input type='checkbox' id='c{$schoolid}' value='{$schoolid}' class='bbv' onChange=bbv() $ckecked><label for='c{$schoolid}'>$schoolid</label></span> ";
        }

        $js .= "document.getElementById('bb').value=arr.join(',');
    }
    </script>";

        $main['js']   = $js;
        $main['form'] = $option;
        $main['mid']  = $mid;
        return $main;
    }
}

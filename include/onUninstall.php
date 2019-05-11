<?php

function xoops_module_uninstall_tad_lunch3($module)
{
    global $xoopsDB;
    $date = date('Ymd');

    rename(XOOPS_ROOT_PATH . '/uploads/tad_lunch3', XOOPS_ROOT_PATH . "/uploads/tad_lunch3_bak_{$date}");

    return true;
}

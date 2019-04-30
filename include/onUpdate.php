<?php
use XoopsModules\Tad_lunch3\Update;

function xoops_module_update_tad_lunch3($module, $old_version)
{
    global $xoopsDB;

    //加入id以及時間欄位
    if (Update::chk_data_center()) {
        Update::go_update_data_center();
    }

    return true;
}

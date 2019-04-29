<?php

namespace XoopsModules\Tad_lunch3;

/*
Update Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Update
 */
class Update
{

    //加入id以及時間欄位
    public static function chk_data_center()
    {
        global $xoopsDB;
        $sql = 'select count(`update_time`) from ' . $xoopsDB->prefix('tad_lunch3_data_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    //執行更新
    public static function go_update_data_center()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_lunch3_data_center') . "
    ADD `col_id` varchar(100) NOT NULL DEFAULT '' COMMENT '辨識字串',
    ADD  `update_time` datetime NOT NULL COMMENT '更新時間'";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }
}

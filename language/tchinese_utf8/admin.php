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
include_once "../../tadtools/language/{$xoopsConfig['language']}/admin_common.php";
define('_TAD_NEED_TADTOOLS', '需要 tadtools 模組，可至<a href="http://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=1" target="_blank">XOOPS輕鬆架</a>下載。');

define('_MA_TAD_LUNCH3_STEP', '設定步驟說明');
define('_MA_TAD_LUNCH3_STEP1', '請先連至<a href="https://fatraceschool.moe.gov.tw/" target="_blank">校園食材登錄平臺</a>');
define('_MA_TAD_LUNCH3_STEP2', '在首頁輸入學校關鍵字，並按下「查詢」');
define('_MA_TAD_LUNCH3_STEP3', '從網址上即可看到學校編號');
define('_MA_TAD_LUNCH3_STEP4', '將數字複製起來，<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=showmod&mod=' . $xoopsModule->mid() . '" target="_blank">到偏好設定輸入學校編號</a>。');
define('_MA_TAD_LUNCH3_STEP5', '最後，記得<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=blocksadmin&op=list&filter=1&selgen=' . $xoopsModule->mid() . '" target="_blank">到區塊管理，啟動「今日午餐資訊」區塊</a>即可。');

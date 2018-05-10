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
define("_TAD_NEED_TADTOOLS", "Need modules/tadtools. You can download tadtools from <a href='http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50' target='_blank'>Tad's web</a>.");

define('_MA_TAD_LUNCH3_STEP', 'Setting step description');
define('_MA_TAD_LUNCH3_STEP1', 'Please go to the <a href="https://fatraceschool.moe.gov.tw/" target="_blank">Campus ingredients login platform</a>');
define('_MA_TAD_LUNCH3_STEP2', 'Enter the school keyword on the home page and press \'Search\'');
define('_MA_TAD_LUNCH3_STEP3', 'You can see the school number from the URL');
define('_MA_TAD_LUNCH3_STEP4', 'Copy numbers, <a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=showmod&mod=<{$mod}>"> to the preferences input school number.</a>');

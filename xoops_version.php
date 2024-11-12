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
$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TADLUNCH3_NAME;
// $modversion['version'] = '2.4';
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TADLUNCH3_DESC;
$modversion['author'] = _MI_TADLUNCH3_AUTHOR;
$modversion['credits'] = _MI_TADLUNCH3_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2024-11-18';
$modversion['module_website_url'] = 'https://tad0616.net';
$modversion['module_website_name'] = _MI_TADLUNCH3_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net';
$modversion['author_website_name'] = _MI_TADLUNCH3_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5.10';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = ['tad_lunch3_data_center'];

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;

$modversion['templates'] = [
    ['file' => 'tad_lunch3_admin.tpl', 'description' => 'tad_lunch3_admin.tpl'],
    ['file' => 'tad_lunch3_index.tpl', 'description' => 'tad_lunch3_index.tpl'],
];

$modversion['blocks'] = [
    [
        'file' => 'tad_lunch3_today.php',
        'name' => _MI_TAD_LUNCH3_TODAY_BLOCK_NAME,
        'description' => _MI_TAD_LUNCH3_TODAY_BLOCK_DESC,
        'show_func' => 'tad_lunch3_today',
        'template' => 'tad_lunch3_today.tpl',
        'edit_func' => 'tad_lunch3_today_edit',
        'options' => '150px|150px|font-size: 1rem;|font-size: 0.8rem;|0|#FAB333|#009688|64736421||font-size:1.3rem;|1|' . _MI_TAD_LUNCH3_TODAY_BLOCK_ANNOTATED,
    ],
];

$modversion['config'] = [
    ['name' => 'SchoolId', 'title' => '_MI_TADLUNCH3_SCHOOLID', 'description' => '_MI_TADLUNCH3_SCHOOLID_DESC', 'formtype' => 'textbox', 'valuetype' => 'text', 'default' => '64736421'],
    ['name' => 'lunch_note', 'title' => '_MI_TADLUNCH3_LUNCH_NOTE', 'description' => '_MI_TADLUNCH3_LUNCH_NOTE_DESC', 'formtype' => 'textarea', 'valuetype' => 'text', 'default' => _MI_TADLUNCH3_LUNCH_NOTE_DEF],
];

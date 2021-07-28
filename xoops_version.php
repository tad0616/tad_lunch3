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

//---模組基本資訊---//
$modversion['name'] = _MI_TADLUNCH3_NAME;
$modversion['version'] = '2.1';
$modversion['description'] = _MI_TADLUNCH3_DESC;
$modversion['author'] = _MI_TADLUNCH3_AUTHOR;
$modversion['credits'] = _MI_TADLUNCH3_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['status_version'] = '2.1';
$modversion['release_date'] = '2021/07/28';
$modversion['module_website_url'] = 'https://tad0616.net';
$modversion['module_website_name'] = _MI_TADLUNCH3_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net';
$modversion['author_website_name'] = _MI_TADLUNCH3_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation :' . _MI_TADLUNCH3_AUTHOR;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_lunch3_data_center';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;
$i = 0;

//---樣板設定---//
$i = 0;
$modversion['templates'][$i]['file'] = 'tad_lunch3_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_lunch3_adm_main.tpl for bootstrap3';

$i++;
$modversion['templates'][$i]['file'] = 'tad_lunch3_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_lunch3_index.tpl';

//---區塊設定---//
$i = 0;
$i++;
$modversion['blocks'][$i]['file'] = 'tad_lunch3_today.php';
$modversion['blocks'][$i]['name'] = _MI_TAD_LUNCH3_TODAY_BLOCK_NAME;
$modversion['blocks'][$i]['description'] = _MI_TAD_LUNCH3_TODAY_BLOCK_DESC;
$modversion['blocks'][$i]['show_func'] = 'tad_lunch3_today';
$modversion['blocks'][$i]['template'] = 'tad_lunch3_today.tpl';
$modversion['blocks'][$i]['edit_func'] = 'tad_lunch3_today_edit';
$modversion['blocks'][$i]['options'] = '150px|150px|font-size: 1rem;|font-size: 0.8rem;|0|#FAB333|#009688|64736421||font-size:1.3rem;|1|' . _MI_TAD_LUNCH3_TODAY_BLOCK_ANNOTATED . '';

$i++;
$modversion['config'][$i]['name'] = 'SchoolId';
$modversion['config'][$i]['title'] = '_MI_TADLUNCH3_SCHOOLID';
$modversion['config'][$i]['description'] = '_MI_TADLUNCH3_SCHOOLID_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '64736421';

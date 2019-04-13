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

/*-----------引入檔案區--------------*/
include 'header.php';
$xoopsOption['template_main'] = 'tad_lunch3_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

/*-----------功能函數區--------------*/

function tad_lunch3_list($period = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    include_once XOOPS_ROOT_PATH . '/modules/tadtools/TadDataCenter.php';
    $TadDataCenter = new TadDataCenter('tad_lunch3');

    if (empty($period)) {
        $period = date('Y-m-d');
    }
    $xoopsTpl->assign('period', $period);

    $SchoolIdArr = explode(';', $xoopsModuleConfig['SchoolId']);
    $i = 0;

    foreach ($SchoolIdArr as $SchoolId) {
        $TadDataCenter->set_col('SchoolId', $SchoolId);
        $data = $TadDataCenter->getData($period);

        if ($data and false !== mb_strpos($data, 'BatchDataId')) {
            $lunch[$SchoolId] = json_decode($data[$period][0], true);
        } else {
            $json = get_url("https://fatraceschool.moe.gov.tw/school/{$SchoolId}");
            $school = json_decode($json, true);
            $lunch[$SchoolId] = $school['data'];

            $json = get_url("https://fatraceschool.moe.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all");
            $meal = json_decode($json, true);
            $lunch[$SchoolId]['meal'] = $meal['data'];

            $j = 0;
            foreach ($meal['data'] as $m) {
                $json = get_url("https://fatraceschool.moe.gov.tw/dish?BatchDataId={$m['BatchDataId']}");
                $dish = json_decode($json, true);
                $lunch[$SchoolId]['meal'][$j]['dish'] = $dish['data'];
                $j++;
            }

            $TadDataCenter->saveCustomData([$period => json_encode($lunch[$SchoolId], 256)]);
            $i++;
        }
    }

    $xoopsTpl->assign('lunch', $lunch);

    if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/easy_responsive_tabs.php')) {
        redirect_header('index.php', 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . '/modules/tadtools/easy_responsive_tabs.php';
    $responsive_tabs = new easy_responsive_tabs('#lunch3Tab');
    $responsive_tabs->rander();
    $kitchenTab = new easy_responsive_tabs('#kitchenTab');
    $kitchenTab->rander();
}

function re_get($SchoolId, $period)
{
    //刪除資料：
    include_once XOOPS_ROOT_PATH . '/modules/tadtools/TadDataCenter.php';
    $TadDataCenter = new TadDataCenter('tad_lunch3');
    $TadDataCenter->set_col('SchoolId', $SchoolId);
    $TadDataCenter->delData($period, 0);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$period = system_CleanVars($_REQUEST, 'period', date('Y-m-d'), 'string');
$SchoolId = system_CleanVars($_REQUEST, 'SchoolId', '', 'string');

switch ($op) {
    /*---判斷動作請貼在下方---*/
    case 're_get':
        re_get($SchoolId, $period);
        header("location: index.php?period=$period");
        exit;

    default:
        tad_lunch3_list($period);
        $op = 'tad_lunch3_list';
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('now_op', $op);
include_once XOOPS_ROOT_PATH . '/footer.php';

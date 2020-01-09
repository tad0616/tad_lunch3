<?php
use XoopsModules\Tadtools\EasyResponsiveTabs;
use XoopsModules\Tadtools\TadDataCenter;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_lunch3_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------功能函數區--------------*/

function tad_lunch3_list($period = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    $TadDataCenter = new TadDataCenter('tad_lunch3');

    if (empty($period)) {
        $period = date('Y-m-d');
    }
    $xoopsTpl->assign('period', $period);
    $xoopsTpl->assign('SchoolIdArr', 'ss');

    $SchoolIdArr = explode(';', $xoopsModuleConfig['SchoolId']);
    $i = 0;

    foreach ($SchoolIdArr as $SchoolId) {
        $TadDataCenter->set_col('SchoolId', $SchoolId);
        $data = $TadDataCenter->getData($period);

        if ($data && false !== mb_strpos($data, 'BatchDataId')) {
            $lunch[$SchoolId] = json_decode($data[$period][0], true);
        } else {
            $json = get_url("https://fatraceschool.k12ea.gov.tw/school/{$SchoolId}");
            $school = json_decode($json, true);
            $lunch[$SchoolId] = $school['data'];

            $json = get_url("https://fatraceschool.k12ea.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all");
            $meal = json_decode($json, true);
            $lunch[$SchoolId]['meal'] = $meal['data'];

            $j = 0;
            foreach ($meal['data'] as $m) {
                $json = get_url("https://fatraceschool.k12ea.gov.tw/dish?BatchDataId={$m['BatchDataId']}");
                $dish = json_decode($json, true);
                $lunch[$SchoolId]['meal'][$j]['dish'] = $dish['data'];
                $j++;
            }

            $TadDataCenter->saveCustomData([$period => json_encode($lunch[$SchoolId], 256)]);
            $i++;
        }
    }

    $xoopsTpl->assign('lunch', $lunch);
    if ($_GET['test'] == 1) {
        Utility::dd($lunch);
    }

    $responsive_tabs = new EasyResponsiveTabs('#lunch3Tab');
    $responsive_tabs->rander();
    $kitchenTab = new EasyResponsiveTabs('#kitchenTab');
    $kitchenTab->rander();
}

function re_get($SchoolId, $period)
{
    //刪除資料：
    $TadDataCenter = new TadDataCenter('tad_lunch3');
    $TadDataCenter->set_col('SchoolId', $SchoolId);
    $TadDataCenter->delData($period, 0);
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$period = system_CleanVars($_REQUEST, 'period', date('Y-m-d'), 'date');
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
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('now_op', $op);
require_once XOOPS_ROOT_PATH . '/footer.php';

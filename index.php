<?php
use Xmf\Request;
use XoopsModules\Tadtools\EasyResponsiveTabs;
use XoopsModules\Tadtools\TadDataCenter;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_lunch3_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$SchoolId = Request::getString('SchoolId');
$period = Request::getString('period', date('Y-m-d'));

switch ($op) {

    case 're_get':
        re_get($SchoolId, $period);
        header("location: index.php?period=$period");
        exit;

    default:
        tad_lunch3_list($period);
        $op = 'tad_lunch3_list';
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu, false, $interface_icon));
$xoopsTpl->assign('now_op', $op);
$xoTheme->addStylesheet('modules/tad_lunch3/css/module.css');
require_once XOOPS_ROOT_PATH . '/footer.php';
/*-----------功能函數區--------------*/

function tad_lunch3_list($period = '')
{
    global $xoopsTpl, $xoopsModuleConfig, $xoTheme;
    $xoTheme->addScript('modules/tadtools/My97DatePicker/WdatePicker.js');
    $TadDataCenter = new TadDataCenter('tad_lunch3');
    if (empty($period) or !validateDate($period)) {
        $period = date('Y-m-d');
    }
    $xoopsTpl->assign('period', $period);

    $SchoolIdArr = explode(';', $xoopsModuleConfig['SchoolId']);
    $lunch_note = $xoopsModuleConfig['lunch_note'];
    $xoopsTpl->assign('lunch_note', $lunch_note);

    $i = 0;
    $lunch_error = '';
    $lunch = [];

    foreach ($SchoolIdArr as $SchoolId) {
        $TadDataCenter->set_col('SchoolId', $SchoolId);
        $data = $TadDataCenter->getData($period);

        if (isset($data[$period][0]) && false !== mb_strpos($data[$period][0], 'BatchDataId')) {
            $lunch[$SchoolId] = json_decode($data[$period][0], true);
        } else {
            $json = Utility::vita_get_url_content("https://fatraceschool.k12ea.gov.tw/school/{$SchoolId}");
            if ($json) {
                $school = json_decode($json, true);
                $lunch[$SchoolId] = $school['data'];

                $json = Utility::vita_get_url_content("https://fatraceschool.k12ea.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all");
                if ($json) {
                    $meal = json_decode($json, true);
                    if ($meal['data']) {
                        $lunch[$SchoolId]['meal'] = $meal['data'];

                        $j = 0;
                        foreach ($meal['data'] as $m) {
                            $json = Utility::vita_get_url_content("https://fatraceschool.k12ea.gov.tw/dish?BatchDataId={$m['BatchDataId']}");
                            $dish = json_decode($json, true);
                            $lunch[$SchoolId]['meal'][$j]['dish'] = $dish['data'];
                            $j++;
                        }

                        $TadDataCenter->saveCustomData([$period => json_encode($lunch[$SchoolId], 256)]);
                        $i++;
                    } else {
                        // $lunch[$SchoolId]['lunch_error'] = $lunch_error = _MD_TAD_LUNCH3_UNABLE_TO_PARSE . "https://fatraceschool.k12ea.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all";
                        $lunch[$SchoolId]['lunch_error'] = $lunch_error = _MD_TAD_LUNCH3_NO_LUNCH;
                        $TadDataCenter->saveCustomData([$period => $lunch_error]);
                    }
                } else {
                    $lunch[$SchoolId]['lunch_error'] = $lunch_error = _MD_TAD_LUNCH3_NO_RESPONSE . "https://fatraceschool.k12ea.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all";
                    $TadDataCenter->saveCustomData([$period => $lunch_error]);
                }
            } else {
                $lunch[$SchoolId]['lunch_error'] = $lunch_error = _MD_TAD_LUNCH3_NO_RESPONSE . "https://fatraceschool.k12ea.gov.tw/school/{$SchoolId}";
                $TadDataCenter->saveCustomData([$period => $lunch_error]);
            }
        }
    }

    $xoopsTpl->assign('lunch', $lunch);
    $responsive_tabs = new EasyResponsiveTabs('#lunch3Tab');
    $responsive_tabs->render();
    $kitchenTab = new EasyResponsiveTabs('#kitchenTab');
    $kitchenTab->render();
}

function re_get($SchoolId, $period)
{
    //刪除資料：
    $TadDataCenter = new TadDataCenter('tad_lunch3');
    $TadDataCenter->set_col('SchoolId', $SchoolId);
    $TadDataCenter->delData($period);
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

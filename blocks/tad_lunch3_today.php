<?php
use XoopsModules\Tadtools\EasyResponsiveTabs;
use XoopsModules\Tadtools\MColorPicker;
use XoopsModules\Tadtools\TadDataCenter;
use XoopsModules\Tadtools\Utility;

if (!class_exists('XoopsModules\Tadtools\TadDataCenter')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

//區塊主函式 (tad_lunch3_today)
function tad_lunch3_today($options)
{
    global $xoopsDB;

    require_once XOOPS_ROOT_PATH . '/modules/tad_lunch3/function.php';

    $moduleHandler = xoops_getHandler('module');
    $xoopsModule = $moduleHandler->getByDirname('tad_lunch3');
    $configHandler = xoops_getHandler('config');
    $mid = $xoopsModule->mid();
    $xoopsModuleConfig = $configHandler->getConfigsByCat(0, $mid);

    $SchoolIdArr = explode(';', $xoopsModuleConfig['SchoolId']);

    $TadDataCenter = new TadDataCenter('tad_lunch3');

    $block['options'] = $options;

    $period = date('Y-m-d');
    $block['period'] = $period;

    $school_arr = explode(',', $options[7]);

    $same_id = array_intersect($SchoolIdArr, $school_arr);
    if (empty($same_id)) {
        $school_arr = $SchoolIdArr;
    }

    $i = 0;
    foreach ($school_arr as $SchoolId) {
        if (empty($SchoolId)) {
            continue;
        }

        $TadDataCenter->set_col('SchoolId', $SchoolId);
        $data = $TadDataCenter->getData($period);

        if ($data && false !== mb_strpos($data, 'BatchDataId')) {
            $block['school'][$SchoolId] = json_decode($data[$period][0], true);
        } else {
            $json1 = get_url("https://fatraceschool.k12ea.gov.tw/school/{$SchoolId}");
            $school = json_decode($json1, true);
            $block['school'][$SchoolId] = $school['data'];

            $json2 = get_url("https://fatraceschool.k12ea.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all");
            $meal = json_decode($json2, true);
            if ($meal['data']) {
                $block['school'][$SchoolId]['meal'] = $meal['data'];

                $j = 0;
                foreach ($meal['data'] as $m) {
                    $json3 = get_url("https://fatraceschool.k12ea.gov.tw/dish?BatchDataId={$m['BatchDataId']}");
                    $dish = json_decode($json3, true);
                    $block['school'][$SchoolId]['meal'][$j]['dish'] = $dish['data'];
                    $j++;
                }

                $TadDataCenter->saveCustomData([$period => json_encode($block['school'][$SchoolId], 256)]);
                $i++;
            }
        }
        if ($options[8]) {
            $block['school'][$SchoolId]['SchoolName'] = $options[8];
        }
    }

    $block['title_css'] = $options[9];
    $block['show_kitchen'] = $options[10];
    $block['annotated_text'] = $options[11];

    $responsive_tabs = new EasyResponsiveTabs('#lunch3Tab');
    $responsive_tabs->rander();
    $kitchenTab = new EasyResponsiveTabs('#kitchenTab');
    $kitchenTab->rander();
    return $block;
}

//{"result":1,"message":"Get School successful","data":{"SchoolId":64736598,"SchoolName":"臺南市安南區安南國民中學","ConuntyId":33,"AreaId":131581,"SchoolType":3}}

// $meal = array(
//     'result'  => 1,
//     'message' => 'Get Offering Meal successful',
//     'data'    => array(
//         0 => array(
//             'BatchDataId'    => '1524811959171670',
//             'KitchenId'      => 4214,
//             'KitchenName'    => '臺南市中西區進學國民小學',
//             'SchoolId'       => 64736562,
//             'SchoolName'     => '臺南市中西區進學國民小學',
//             'MenuDate'       => '2018/05/10',
//             'MenuType'       => 1,
//             'MenuTypeName'   => '午餐',
//             'UploadDateTime' => '2018-04-27T06:52:39.000Z',
//             'TypeGrains'     => '4.9',
//             'TypeOil'        => '7.0',
//             'TypeVegetable'  => '1.0',
//             'TypeMilk'       => '0.0',
//             'TypeFruit'      => '0.0',
//             'TypeMeatBeans'  => '2.9',
//             'Calorie'        => '716.0',
//         ),
//     ),
// );

// $dish = array (
//     'result' => 1,
//     'message' => 'Get Dish successful',
//     'data' =>
//     array (
//       0 =>
//       array (
//         'DishBatchDataId' => '1524811959171649',
//         'BatchDataId' => '1524811959171648',
//         'DishName' => '紅燒豬肉麵',
//         'DishType' => '主食',
//         'DishId' => '1454634026403559',
//         'UpdateDateTime' => '2018-04-27T06:52:39.000Z',
//         'DishOrder' => 10,
//         'KitchenId' => 4214,
//         'PicturePath' => '',
//       ),
//       1 =>
//       array (
//         'DishBatchDataId' => '1524811959171651',
//         'BatchDataId' => '1524811959171648',
//         'DishName' => '白煮蛋',
//         'DishType' => '主菜',
//         'DishId' => '1409533595285836',
//         'UpdateDateTime' => '2018-04-27T06:52:39.000Z',
//         'DishOrder' => 12,
//         'KitchenId' => 4214,
//         'PicturePath' => '',
//       ),
//       2 =>
//       array (
//         'DishBatchDataId' => '1524811959171652',
//         'BatchDataId' => '1524811959171648',
//         'DishName' => '奶皇包',
//         'DishType' => '副菜',
//         'DishId' => '1424070947225048',
//         'UpdateDateTime' => '2018-04-27T06:52:39.000Z',
//         'DishOrder' => 16,
//         'KitchenId' => 4214,
//         'PicturePath' => '',
//       ),
//       3 =>
//       array (
//         'DishBatchDataId' => '1524811959171650',
//         'BatchDataId' => '1524811959171648',
//         'DishName' => '國信鮮奶',
//         'DishType' => '附餐',
//         'DishId' => '1476148118375403',
//         'UpdateDateTime' => '2018-04-27T06:52:39.000Z',
//         'DishOrder' => 24,
//         'KitchenId' => 4214,
//         'PicturePath' => '',
//       ),
//       4 =>
//       array (
//         'DishBatchDataId' => '1525056655197623',
//         'BatchDataId' => '1524811959171648',
//         'DishName' => '調味料',
//         'DishId' => '1409533594285701',
//         'UpdateDateTime' => '2018-04-30T02:50:55.000Z',
//         'DishOrder' => 999,
//         'KitchenId' => 4214,
//         'PicturePath' => '',
//       ),
//     ),
//   )

//區塊編輯函式 (tad_lunch3_today_edit)
function tad_lunch3_today_edit($options)
{
    require_once XOOPS_ROOT_PATH . '/modules/tad_lunch3/function.php';

    $MColorPicker = new MColorPicker('.color');
    $MColorPicker->render();

    $opt = block_schoolid($options[7]);

    //"直式或橫式"預設值
    $checked_4_0 = ('0' == $options[4]) ? 'checked' : '';
    $checked_4_1 = ('1' == $options[4]) ? 'checked' : '';
    //"是否顯示供應商？"預設值
    $checked_10_0 = ('0' == $options[10]) ? 'checked' : '';
    $checked_10_1 = ('0' != $options[10]) ? 'checked' : '';

    $form = "
    {$opt['js']}
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT0 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[0]' value='{$options[0]}' size=6>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT1 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[1]' value='{$options[1]}' size=6>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT2 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[2]' value='{$options[2]}' size=100>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT3 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[3]' value='{$options[3]}' size=100>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT4 . "</lable>
            <div class='my-content'>
                <input type='radio' name='options[4]' value='0' $checked_4_0> " . _MB_TAD_LUNCH3_HORIZONTAL . "
                <input type='radio' name='options[4]' value='1' $checked_4_1> " . _MB_TAD_LUNCH3_VERTICAL . "
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT5 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input color' data-hex='true' name='options[5]' value='{$options[5]}' size=8>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT6 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input color' data-hex='true' name='options[6]' value='{$options[6]}' size=8>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT7 . "</lable>
            <div class='my-content'>
                {$opt['form']}
                <input type='hidden' name='options[7]' id='bb' value='{$options[7]}'>
                <span class='my-help'><a href='" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&op=showmod&mod={$opt['mid']}'>" . _MB_TAD_LUNCH3_TODAY_OPT7_TXT . "</a></span>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT8 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[8]' value='{$options[8]}'>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT9 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[9]' value='{$options[9]}' size=100>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT10 . "</lable>
            <div class='my-content'>
                <input type='radio' name='options[10]' value='0' $checked_10_0> " . _NO . "
                <input type='radio' name='options[10]' value='1' $checked_10_1> " . _YES . "
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_LUNCH3_TODAY_OPT11 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[11]' value='{$options[11]}' size=100>
            </div>
        </li>
    </ol>";

    return $form;
}

//取得所有類別標題
if (!function_exists('block_schoolid')) {
    function block_schoolid($selected = '')
    {
        global $xoopsDB, $xoopsModule;

        $moduleHandler = xoops_getHandler('module');
        $xoopsModule = $moduleHandler->getByDirname('tad_lunch3');
        $configHandler = xoops_getHandler('config');
        $mid = $xoopsModule->mid();
        $xoopsModuleConfig = $configHandler->getConfigsByCat(0, $mid);

        $SchoolIdArr = explode(';', $xoopsModuleConfig['SchoolId']);

        if (!empty($selected)) {
            $sc = explode(',', $selected);
        }

        $js = '<script>
            function bbv(){
                i=0;
                var arr = new Array();';

        foreach ($SchoolIdArr as $schoolid) {
            $js .= "if(document.getElementById('c{$schoolid}').checked){
                    arr[i] = document.getElementById('c{$schoolid}').value;
                    i++;
                    }";
            $ckecked = (in_array($schoolid, $sc)) ? 'checked' : '';
            $option .= "<span style='white-space:nowrap;'><input type='checkbox' id='c{$schoolid}' value='{$schoolid}' class='bbv' onChange=bbv() $ckecked><label for='c{$schoolid}'>$schoolid</label></span> ";
        }

        $js .= "document.getElementById('bb').value=arr.join(',');
                }
                </script>";

        $main['js'] = $js;
        $main['form'] = $option;
        $main['mid'] = $mid;

        return $main;
    }
}

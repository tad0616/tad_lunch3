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

//區塊主函式 (tad_lunch3_today)
function tad_lunch3_today($options)
{
    global $xoopsDB;

    include_once XOOPS_ROOT_PATH . "/modules/tad_lunch3/function.php";
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadDataCenter.php";
    $TadDataCenter = new TadDataCenter('tad_lunch3');

    $block['options'] = $options;

    $period          = date('Y-m-d');
    $block['period'] = $period;

    $school_arr = explode(',', $options[7]);
    $i          = 0;
    foreach ($school_arr as $SchoolId) {
        $TadDataCenter->set_col('SchoolId', $SchoolId);
        $data = $TadDataCenter->getData($period);

        if ($data) {
            $block['school'][$SchoolId] = json_decode($data[$period][0], true);
        } else {
            $json                       = get_url("https://fatraceschool.moe.gov.tw/school/{$SchoolId}");
            $school                     = json_decode($json, true);
            $block['school'][$SchoolId] = $school['data'];

            $json                               = get_url("https://fatraceschool.moe.gov.tw/offered/meal?SchoolId={$SchoolId}&period={$period}&KitchenId=all");
            $meal                               = json_decode($json, true);
            $block['school'][$SchoolId]['meal'] = $meal['data'];

            $j = 0;
            foreach ($meal['data'] as $m) {
                $json                                           = get_url("https://fatraceschool.moe.gov.tw/dish?BatchDataId={$m['BatchDataId']}");
                $dish                                           = json_decode($json, true);
                $block['school'][$SchoolId]['meal'][$j]['dish'] = $dish['data'];
                $j++;
            }

            $TadDataCenter->saveCustomData(array($period => json_encode($block['school'][$SchoolId], 256)));
            $i++;
        }
    }

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/easy_responsive_tabs.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/easy_responsive_tabs.php";
    $responsive_tabs = new easy_responsive_tabs('#lunch3Tab');
    $responsive_tabs->rander();
    $kitchenTab = new easy_responsive_tabs('#kitchenTab');
    $kitchenTab->rander();
    // $block['json'] = var_export($block, true);
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

    include_once XOOPS_ROOT_PATH . "/modules/tad_lunch3/function.php";
    $opt = block_schoolid($options[7]);

    //"直式或橫式"預設值
    $checked_4_0 = ($options[4] == '0') ? 'checked' : '';
    $checked_4_1 = ($options[4] == '1') ? 'checked' : '';

    $form = "
    {$opt['js']}
    <table>
      <tr>
        <th>
          <!--圖片寬度-->
          " . _MB_TAD_LUNCH3_TODAY_OPT0 . "
        </th>
        <td>
          <input type='text' name='options[0]' value='{$options[0]}' size=20>
        </td>
      </tr>
      <tr>
        <th>
          <!--圖片高度-->
          " . _MB_TAD_LUNCH3_TODAY_OPT1 . "
        </th>
        <td>
          <input type='text' name='options[1]' value='{$options[1]}' size=20>
        </td>
      </tr>
      <tr>
        <th>
          <!--種類文字樣式-->
          " . _MB_TAD_LUNCH3_TODAY_OPT2 . "
        </th>
        <td>
          <input type='text' name='options[2]' value='{$options[2]}' size=100>
        </td>
      </tr>
      <tr>
        <th>
          <!--菜色名稱文字樣式-->
          " . _MB_TAD_LUNCH3_TODAY_OPT3 . "
        </th>
        <td>
          <input type='text' name='options[3]' value='{$options[3]}' size=100>
        </td>
      </tr>
      <tr>
        <th>
          <!--直式或橫式-->
          " . _MB_TAD_LUNCH3_TODAY_OPT4 . "
        </th>
        <td>
            <input type='radio' name='options[4]' value='0' $checked_4_0> 橫式
            <input type='radio' name='options[4]' value='1' $checked_4_1> 直式
        </td>
      </tr>
      <tr>
        <th>
          <!--主食底色-->
          " . _MB_TAD_LUNCH3_TODAY_OPT5 . "
        </th>
        <td>
            <input type='color' name='options[5]' value='{$options[5]}'>
        </td>
      </tr>
      <tr>
        <th>
          <!--一般底色-->
          " . _MB_TAD_LUNCH3_TODAY_OPT6 . "
        </th>
        <td>
        <input type='color' name='options[6]' value='{$options[6]}'>
        </td>
      </tr>
      <tr>
        <th>
          <!--欲顯示學校-->
          " . _MB_TAD_LUNCH3_TODAY_OPT7 . "
        </th>
        <td>
        {$opt['form']}
        <input type='hidden' name='options[7]' id='bb' value='{$options[7]}'>
        <a href='" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&op=showmod&mod={$opt['mid']}'>" . _MB_TAD_LUNCH3_TODAY_OPT7_TXT . "</a>
        </td>
      </tr>
    </table>
    ";
    return $form;
}

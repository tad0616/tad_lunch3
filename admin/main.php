<?php
use Xmf\Request;
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
$GLOBALS['xoopsOption']['template_main'] = 'tad_lunch3_admin.tpl';
require_once __DIR__ . '/header.php';

/*-----------執行動作判斷區----------*/

$op = Request::getString('op');

switch ($op) {

    default:
        $now_op = 'tad_lunch3_readme';
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', $now_op);
require_once __DIR__ . '/footer.php';

/*-----------功能函數區--------------*/

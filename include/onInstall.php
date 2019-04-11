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

use XoopsModules\Tad_lunch3\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_lunch3(&$module)
{

    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_lunch3");
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_lunch3/file");
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_lunch3/image");
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_lunch3/image/.thumbs");

    return true;
}



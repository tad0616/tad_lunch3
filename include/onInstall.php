<?php
use XoopsModules\Tadtools\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_lunch3(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_lunch3');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_lunch3/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_lunch3/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_lunch3/image/.thumbs');

    return true;
}

<?php
xoops_loadLanguage('admin_common', 'tadtools');
define('_TAD_NEED_TADTOOLS', "Need modules/tadtools. You can download tadtools from <a href='http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50' target='_blank'>Tad's web</a>.");

define('_MA_TAD_LUNCH3_STEP', 'Setting step description');
define('_MA_TAD_LUNCH3_STEP1', 'Please go to the <a href="https://fatraceschool.k12ea.gov.tw/" target="_blank">Campus ingredients login platform</a>');
define('_MA_TAD_LUNCH3_STEP2', 'Enter the school keyword on the home page and press \'Search\'');
define('_MA_TAD_LUNCH3_STEP3', 'You can see the school number from the URL');
define('_MA_TAD_LUNCH3_STEP4', 'Copy numbers,  <a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=showmod&mod=' . $xoopsModule->mid() . '" target="_blank">to the preferences input school number.</a> ');
define('_MA_TAD_LUNCH3_STEP5', 'Finally, <a href="' . XOOPS_URL . '/modules/system/admin.php?fct=blocksadmin&op=list&filter=1&selgen=' . $xoopsModule->mid() . '" target="_blank">remember the block management, start the lunch information block</a>');

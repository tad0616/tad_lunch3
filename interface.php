<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_lunch3_adm'])) {
    $_SESSION['tad_lunch3_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADLUNCH3_SMNAME1] = 'index.php';
$interface_icon[_MD_TADLUNCH3_SMNAME1] = 'fa-cutlery';

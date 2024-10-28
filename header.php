<?php
require_once dirname(dirname(__DIR__)) . '/mainfile.php';
require_once __DIR__ . '/function.php';

//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_repair_adm'])) {
    $_SESSION['tad_repair_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADREPAIR_HOME] = 'index.php';
$interface_icon[_MD_TADREPAIR_HOME] = 'fa-wrench';
if ($xoopsUser) {
    $interface_menu[_MD_TADREPAIR_SMNAME2] = 'repair.php';
    $interface_icon[_MD_TADREPAIR_SMNAME2] = 'fa-pencil-square-o';
}

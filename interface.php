<?php

//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_repair_adm'])) {
    $_SESSION['tad_repair_adm'] = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADREPAIR_HOME] = 'index.php';
$interface_icon[_MD_TADREPAIR_HOME] = 'fa-wrench';

if (isset($xoopsUser) or $_SERVER['PHP_SELF'] == '/admin.php') {
    $interface_menu[_MD_TADREPAIR_SMNAME2] = 'repair.php';
    $interface_icon[_MD_TADREPAIR_SMNAME2] = 'fa-pencil-square-o';
}

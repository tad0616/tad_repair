<?php
use XoopsModules\Tad_repair\Tools;
if (!class_exists('XoopsModules\Tad_repair\Tools')) {
    require XOOPS_ROOT_PATH . '/modules/tad_repair/preloads/autoloader.php';
}

Tools::get_session();

$interface_menu[_MD_TADREPAIR_HOME] = 'index.php';
$interface_icon[_MD_TADREPAIR_HOME] = 'fa-wrench';

if ($xoopsUser || $_SERVER['PHP_SELF'] == '/admin.php') {
    $interface_menu[_MD_TADREPAIR_SMNAME2] = 'repair.php';
    $interface_icon[_MD_TADREPAIR_SMNAME2] = 'fa-pencil';
}

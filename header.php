<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2013-02-21
// $Id:$
// ------------------------------------------------------------------------- //
include_once "../../mainfile.php";
include_once "function.php";

//判斷是否對該模組有管理權限
$isAdmin=false;
$interface_menu[_TAD_TO_MOD]="index.php";
if ($xoopsUser) {
  $module_id = $xoopsModule->getVar('mid');
  $isAdmin=$xoopsUser->isAdmin($module_id);
  $interface_menu[_MD_TADREPAIR_SMNAME2]="repair.php";
}

if($isAdmin){
  $interface_menu[_TAD_TO_ADMIN]="admin/main.php";
}
?>
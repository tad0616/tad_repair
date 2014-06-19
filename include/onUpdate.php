<?php

function xoops_module_update_tad_repair(&$module, $old_version) {
    GLOBAL $xoopsDB;

    if(chk_uid()) go_update_uid();
    //if(!chk_chk1()) go_update1();

    return true;
}

//修正uid欄位
function chk_uid(){
  global $xoopsDB;
  $sql="SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS
  WHERE table_name = '".$xoopsDB->prefix("tad_repair")."' AND COLUMN_NAME = 'repair_uid'";
  $result=$xoopsDB->query($sql);
  list($type)=$xoopsDB->fetchRow($result);
  if($type=='smallint')return true;
  return false;
}

//執行更新
function go_update_uid(){
  global $xoopsDB;
  $sql="ALTER TABLE `".$xoopsDB->prefix("tad_repair")."` CHANGE `repair_uid` `repair_uid` mediumint(8) unsigned NOT NULL default 0";
  $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL,3,  mysql_error());
  return true;
}


/*
//檢查某欄位是否存在
function chk_chk1(){
  global $xoopsDB;
  $sql="select count(`欄位`) from ".$xoopsDB->prefix("資料表");
  $result=$xoopsDB->query($sql);
  if(empty($result)) return false;
  return true;
}

//執行更新
function go_update1(){
  global $xoopsDB;
  $sql="ALTER TABLE ".$xoopsDB->prefix("資料表")." ADD `欄位` smallint(5) NOT NULL";
  $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL,3,  mysql_error());

  return true;
}
*/

//建立目錄
function mk_dir($dir=""){
  //若無目錄名稱秀出警告訊息
  if(empty($dir))return;
  //若目錄不存在的話建立目錄
  if (!is_dir($dir)) {
    umask(000);
    //若建立失敗秀出警告訊息
    mkdir($dir, 0777);
  }
}

//拷貝目錄
function full_copy( $source="", $target=""){
  if ( is_dir( $source ) ){
    @mkdir( $target );
    $d = dir( $source );
    while ( FALSE !== ( $entry = $d->read() ) ){
      if ( $entry == '.' || $entry == '..' ){
        continue;
      }

      $Entry = $source . '/' . $entry;
      if ( is_dir( $Entry ) ) {
        full_copy( $Entry, $target . '/' . $entry );
        continue;
      }
      copy( $Entry, $target . '/' . $entry );
    }
    $d->close();
  }else{
    copy( $source, $target );
  }
}


function rename_win($oldfile,$newfile) {
 if (!rename($oldfile,$newfile)) {
  if (copy ($oldfile,$newfile)) {
   unlink($oldfile);
   return TRUE;
  }
  return FALSE;
 }
 return TRUE;
}


function delete_directory($dirname) {
  if (is_dir($dirname))
    $dir_handle = opendir($dirname);
  if (!$dir_handle)
    return false;
  while($file = readdir($dir_handle)) {
    if ($file != "." && $file != "..") {
      if (!is_dir($dirname."/".$file))
        unlink($dirname."/".$file);
      else
        delete_directory($dirname.'/'.$file);
    }
  }
  closedir($dir_handle);
  rmdir($dirname);
  return true;
}


?>

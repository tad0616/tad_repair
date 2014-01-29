<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2013-02-21
// $Id:$
// ------------------------------------------------------------------------- //

//區塊主函式 (待修通報(wait_to_repair))
function wait_to_repair($options){
	global $xoopsDB;

	$sql = "select * from `".$xoopsDB->prefix("tad_repair")."` where fixed_status!='"._MB_TADREPAIR_REPAIRED."' order by `repair_date` desc";

	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	$block="";
  $i=0;
	while($all=$xoopsDB->fetchArray($result)){
		//以下會產生這些變數： $repair_sn , $repair_title , $repair_content , $repair_date , $repair_status , $repair_uid , $unit_sn , $fixed_uid , $fixed_date , $fixed_status , $fixed_content
		foreach($all as $k=>$v){
			$$k=$v;
		}

    $repair_date=substr($repair_date,0,10);
    $unit=get_tad_repair_unit($unit_sn);

  	$repair_name=XoopsUser::getUnameFromId($repair_uid,1);
  	if(empty($repair_name))$repair_name=XoopsUser::getUnameFromId($repair_uid,0);
  	
		$block[$i]['repair_date']=$repair_date;
		$block[$i]['repair_status']=$repair_status;
		$block[$i]['unit_title']=$unit['unit_title'];
		$block[$i]['fixed_status']=$fixed_status;
		$block[$i]['repair_sn']=$repair_sn;
		$block[$i]['repair_title']=$repair_title;
		$block[$i]['repair_name']=$repair_name;
    $i++;
	}

	return $block;
}

if(!function_exists('get_tad_repair_unit')){

  //以流水號取得某筆tad_repair_unit資料
  function get_tad_repair_unit($unit_sn=""){
  	global $xoopsDB;
  	if(empty($unit_sn))return;
  	$sql = "select * from `".$xoopsDB->prefix("tad_repair_unit")."` where `unit_sn` = '{$unit_sn}'";
  	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  	$data=$xoopsDB->fetchArray($result);
  	return $data;
  }

}

?>
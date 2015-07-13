<?php
/*-----------引入檔案區--------------*/
include_once "header.php";

$ym = substr($_POST['ym'], 0, 7);

require_once TADTOOLS_PATH . '/PHPExcel.php'; //引入 PHPExcel 物件庫
require_once TADTOOLS_PATH . '/PHPExcel/IOFactory.php'; //引入 PHPExcel_IOFactory 物件庫
$objPHPExcel = new PHPExcel(); //實體化Excel
//----------內容-----------//

$objPHPExcel->setActiveSheetIndex(0); //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle($ym . _MD_TADREPAIR_REPORT); //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改

$objActSheet->getColumnDimension('A')->setWidth(8);
$objActSheet->getColumnDimension('B')->setWidth(20);
$objActSheet->getColumnDimension('C')->setWidth(45);
$objActSheet->getColumnDimension('D')->setWidth(15);
$objActSheet->getColumnDimension('E')->setWidth(15);
$objActSheet->getColumnDimension('F')->setWidth(15);
$objActSheet->getColumnDimension('G')->setWidth(15);
$objActSheet->getColumnDimension('H')->setWidth(20);
$objActSheet->getColumnDimension('I')->setWidth(15);
$objActSheet->getColumnDimension('J')->setWidth(40);

$objActSheet->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFC9E3F3');

$objActSheet->setCellValue("A1", _MD_TADREPAIR_REPAIR_SN)
            ->setCellValue("B1", _MD_TADREPAIR_REPAIR_DATE)
            ->setCellValue("C1", _MD_TADREPAIR_REPAIR_TITLE)
            ->setCellValue("D1", _MD_TADREPAIR_REPAIR_UID)
            ->setCellValue("E1", _MD_TADREPAIR_UNIT)
            ->setCellValue("F1", _MD_TADREPAIR_REPAIR_STATUS2)
            ->setCellValue("G1", _MD_TADREPAIR_FIXED_UID)
            ->setCellValue("H1", _MD_TADREPAIR_FIXED_DATE)
            ->setCellValue("I1", _MD_TADREPAIR_FIXED_STATUS2)
            ->setCellValue("J1", _MD_TADREPAIR_FIXED_CONTENT);

$sql    = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where repair_date like '{$ym}%' order by `repair_date`,`repair_sn`";
$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());

$i = 2;
while ($all = $xoopsDB->fetchArray($result)) {
    //以下會產生這些變數： $repair_sn , $repair_title , $repair_content , $repair_date , $repair_status , $repair_uid , $unit_sn , $fixed_uid , $fixed_date , $fixed_status , $fixed_content
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    $repair_name = XoopsUser::getUnameFromId($repair_uid, 1);
    if (empty($repair_name)) {
        $repair_name = XoopsUser::getUnameFromId($repair_uid, 0);
    }

    $fixed_name = "";
    if ($fixed_uid != 0) {
        $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 1);
        if (empty($fixed_name)) {
            $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 0);
        }

    }

    $repair_date = substr($repair_date, 0, 10);
    $fixed_date  = ($fixed_date == "0000-00-00 00:00:00") ? "" : substr($fixed_date, 0, 10);

    $fixed_status = in_array($uid, $unit_admin_arr[$unit_sn]) ? "<a href='repair.php?op=tad_fixed_form&repair_sn=$repair_sn'>$fixed_status</a>" : $fixed_status;

    $unit = get_tad_repair_unit($unit_sn);

    $objActSheet->setCellValue("A{$i}", $repair_sn)
                ->setCellValue("B{$i}", $repair_date)
                ->setCellValue("C{$i}", $repair_title)
                ->setCellValue("D{$i}", $repair_name)
                ->setCellValue("E{$i}", $unit['unit_title'])
                ->setCellValue("F{$i}", $repair_status)
                ->setCellValue("G{$i}", $fixed_name)
                ->setCellValue("H{$i}", $fixed_date)
                ->setCellValue("I{$i}", $fixed_status)
                ->setCellValue("J{$i}", $fixed_content);
    $i++;
}

$n = $i - 1;
$objActSheet->mergeCells("A{$i}:J{$i}")->setCellValue("A{$i}", "=CONCATENATE(\"" . _MD_TADREPAIR_REPORT_TOTAL . " \" , COUNTA(A2:A{$n}) , \" " . _MD_TADREPAIR_REPORT_TOTAL2 . "\")");

$title = $ym . _MD_TADREPAIR_REPORT;
$title = (_CHARSET == 'UTF-8') ? iconv("UTF-8", "Big5", $title) : $title;
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename={$title}.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;

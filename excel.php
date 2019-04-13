<?php
/*-----------引入檔案區--------------*/
include_once 'header.php';

$ym = mb_substr($_POST['ym'], 0, 7);

require_once TADTOOLS_PATH . '/PHPExcel.php'; //引入 PHPExcel 物件庫
require_once TADTOOLS_PATH . '/PHPExcel/IOFactory.php'; //引入 PHPExcel_IOFactory 物件庫
$objPHPExcel = new PHPExcel(); //實體化Excel
//----------內容-----------//

$objPHPExcel->setActiveSheetIndex(0); //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle($ym . _MD_TADREPAIR_REPORT); //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改

$col_width = [8, 20, 45, 25, 15, 15, 15, 15, 20, 15, 40, 60];
$z = 0;
foreach ($col_width as $n => $w) {
    if (3 == $n and in_array('repair_place', $xoopsModuleConfig['unuse_cols'], true)) {
        continue;
    } elseif (6 == $n and in_array('repair_status', $xoopsModuleConfig['unuse_cols'], true)) {
        continue;
    }
    $alpha = num2alpha($z);
    $objActSheet->getColumnDimension($alpha)->setWidth($w);
    $z++;
}

$objActSheet->getStyle("A1:{$alpha}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFC9E3F3');

$col_title = [_MD_TADREPAIR_REPAIR_SN, _MD_TADREPAIR_REPAIR_DATE, _MD_TADREPAIR_REPAIR_TITLE, _MD_TADREPAIR_PLACE, _MD_TADREPAIR_REPAIR_UID, _MD_TADREPAIR_UNIT, _MD_TADREPAIR_REPAIR_STATUS2, _MD_TADREPAIR_FIXED_UID, _MD_TADREPAIR_FIXED_DATE, _MD_TADREPAIR_FIXED_STATUS2, _MD_TADREPAIR_FIXED_CONTENT, _MD_TADREPAIR_REPAIR_CONTENT];
$z = 0;

foreach ($col_title as $n => $title) {
    if (3 == $n and in_array('repair_place', $xoopsModuleConfig['unuse_cols'], true)) {
        continue;
    } elseif (6 == $n and in_array('repair_status', $xoopsModuleConfig['unuse_cols'], true)) {
        continue;
    }
    $alpha = num2alpha($z);
    $objActSheet->setCellValue("{$alpha}1", $title);
    $z++;
}

$sql = 'select * from `' . $xoopsDB->prefix('tad_repair') . "` where repair_date like '{$ym}%' order by `repair_date`,`repair_sn`";
$result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

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

    $fixed_name = '';
    if (0 != $fixed_uid) {
        $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 1);
        if (empty($fixed_name)) {
            $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 0);
        }
    }

    $repair_date = mb_substr($repair_date, 0, 10);
    $fixed_date = ('0000-00-00 00:00:00' == $fixed_date) ? '' : mb_substr($fixed_date, 0, 10);

    $fixed_status = in_array($uid, $unit_admin_arr[$unit_sn], true) ? "<a href='repair.php?op=tad_fixed_form&repair_sn=$repair_sn'>$fixed_status</a>" : $fixed_status;

    $unit = get_tad_repair_unit($unit_sn);

    $col_value = [$repair_sn, $repair_date, $repair_title, $repair_place, $repair_name, $unit['unit_title'], $repair_status, $fixed_name, $fixed_date, $fixed_status, $fixed_content, $repair_content];
    $z = 0;

    foreach ($col_value as $n => $val) {
        if (3 == $n and in_array('repair_place', $xoopsModuleConfig['unuse_cols'], true)) {
            continue;
        } elseif (6 == $n and in_array('repair_status', $xoopsModuleConfig['unuse_cols'], true)) {
            continue;
        }
        $alpha = num2alpha($z);
        $objActSheet->setCellValue("{$alpha}{$i}", $val);
        $z++;
    }

    $i++;
}

$n = $i - 1;
$objActSheet->mergeCells("A{$i}:K{$i}")->setCellValue("A{$i}", '=CONCATENATE("' . _MD_TADREPAIR_REPORT_TOTAL . " \" , COUNTA(A2:A{$n}) , \" " . _MD_TADREPAIR_REPORT_TOTAL2 . '")');

$title = $ym . _MD_TADREPAIR_REPORT;
$title = (_CHARSET == 'UTF-8') ? iconv('UTF-8', 'Big5', $title) : $title;
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename={$title}.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;

function num2alpha($n)
{
    for ($r = ''; $n >= 0; $n = (int)($n / 26) - 1) {
        $r = chr($n % 26 + 0x41) . $r;
    }

    return $r;
}

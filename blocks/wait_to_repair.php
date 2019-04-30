<?php
use XoopsModules\Tadtools\Utility;
//區塊主函式 (待修通報(wait_to_repair))
function wait_to_repair($options)
{
    global $xoopsDB, $xoTheme;
    $xoTheme->addStylesheet('modules/tadtools/css/vertical_menu.css');

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_repair') . "` WHERE fixed_status!='" . _MB_TADREPAIR_REPAIRED . "' ORDER BY `repair_date` DESC";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $block = [];
    $i = 0;
    $content = [];
    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $repair_sn , $repair_title , $repair_content , $repair_date , $repair_status , $repair_uid , $unit_sn , $fixed_uid , $fixed_date , $fixed_status , $fixed_content
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $repair_date = mb_substr($repair_date, 0, 10);
        $unit = get_tad_repair_unit($unit_sn);

        $repair_name = XoopsUser::getUnameFromId($repair_uid, 1);
        if (empty($repair_name)) {
            $repair_name = XoopsUser::getUnameFromId($repair_uid, 0);
        }

        $content[$i]['repair_date'] = $repair_date;
        $content[$i]['repair_status'] = $repair_status;
        $content[$i]['unit_title'] = $unit['unit_title'];
        $content[$i]['fixed_status'] = $fixed_status;
        $content[$i]['repair_sn'] = $repair_sn;
        $content[$i]['repair_title'] = $repair_title;
        $content[$i]['repair_name'] = $repair_name;
        $i++;
    }
    $block['content'] = $content;

    return $block;
}

if (!function_exists('get_tad_repair_unit')) {
    //以流水號取得某筆tad_repair_unit資料
    function get_tad_repair_unit($unit_sn = '')
    {
        global $xoopsDB;
        if (empty($unit_sn)) {
            return;
        }

        $sql = 'select * from `' . $xoopsDB->prefix('tad_repair_unit') . "` where `unit_sn` = '{$unit_sn}'";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
        $data = $xoopsDB->fetchArray($result);

        return $data;
    }
}

<?php
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
use XoopsModules\Tad_repair\Tools;
if (!class_exists('XoopsModules\Tad_repair\Tools')) {
    require XOOPS_ROOT_PATH . '/modules/tad_repair/preloads/autoloader.php';
}
//區塊主函式 (待修通報(wait_to_repair))
function wait_to_repair($options)
{
    global $xoopsDB, $xoTheme;
    $xoTheme->addStylesheet('modules/tadtools/css/vertical_menu.css');

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_repair') . '` WHERE `fixed_status` != ? ORDER BY `repair_date` DESC';
    $result = Utility::query($sql, 's', [_MB_TADREPAIR_REPAIRED]) or Utility::web_error($sql, __FILE__, __LINE__);

    $block = [];
    $i = 0;
    $content = [];
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $repair_date = mb_substr($repair_date, 0, 10);
        $unit = Tools::get_tad_repair_unit($unit_sn);

        $repair_name = \XoopsUser::getUnameFromId($repair_uid, 1);
        if (empty($repair_name)) {
            $repair_name = \XoopsUser::getUnameFromId($repair_uid, 0);
        }

        $content[$i]['repair_date'] = $repair_date;
        $content[$i]['repair_status'] = $repair_status;
        $content[$i]['unit_title'] = $unit['unit_title'];
        $content[$i]['fixed_status'] = $fixed_status;
        $content[$i]['repair_sn'] = $repair_sn;
        $content[$i]['repair_title'] = $repair_title;
        $content[$i]['repair_name'] = $repair_name;
        $content[$i]['repair_place'] = $repair_place;
        $i++;
    }
    $block['content'] = $content;

    return $block;
}

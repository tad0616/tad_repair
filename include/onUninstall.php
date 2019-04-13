<?php

function xoops_module_uninstall_tad_repair(&$module)
{
    global $xoopsDB;
    $date = date('Ymd');

    rename(XOOPS_ROOT_PATH . '/uploads/tad_repair', XOOPS_ROOT_PATH . "/uploads/tad_repair_bak_{$date}");

    return true;
}

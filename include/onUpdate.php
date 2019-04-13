<?php

use XoopsModules\Tad_repair\Utility;

function xoops_module_update_tad_repair(&$module, $old_version)
{
    global $xoopsDB;

    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/image/.thumbs');

    if (Utility::chk_uid()) {
        Utility::go_update_uid();
    }

    if (Utility::chk_chk1()) {
        Utility::go_update1();
    }

    if (Utility::chk_chk2()) {
        Utility::go_update2();
    }
    Utility::update_blank_status();
    Utility::chk_tad_repair_block();

    //新增檔案欄位
    if (Utility::chk_fc_tag()) {
        Utility::go_fc_tag();
    }

    return true;
}

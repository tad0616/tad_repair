<?php
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_repair\Update;

function xoops_module_update_tad_repair(&$module, $old_version)
{
    global $xoopsDB;

    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/image/.thumbs');

    if (Update::chk_uid()) {
        Update::go_update_uid();
    }

    if (Update::chk_chk1()) {
        Update::go_update1();
    }

    if (Update::chk_chk2()) {
        Update::go_update2();
    }
    Update::update_blank_status();
    Update::chk_tad_repair_block();

    //新增檔案欄位
    if (Update::chk_fc_tag()) {
        Update::go_fc_tag();
    }

    return true;
}

<?php

function xoops_module_install_tad_repair(&$module)
{

    tad_repair_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair");
    tad_repair_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair/file");
    tad_repair_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair/image");
    tad_repair_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair/image/.thumbs");
    return true;
}

//建立目錄
function tad_repair_mk_dir($dir = "")
{
    //若無目錄名稱秀出警告訊息
    if (empty($dir)) {
        return;
    }

    //若目錄不存在的話建立目錄
    if (!is_dir($dir)) {
        umask(000);
        //若建立失敗秀出警告訊息
        mkdir($dir, 0777);
    }
}

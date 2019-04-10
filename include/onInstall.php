<?php

use XoopsModules\Tad_repair\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_repair(&$module)
{

    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair");
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair/file");
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair/image");
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_repair/image/.thumbs");
    return true;
}

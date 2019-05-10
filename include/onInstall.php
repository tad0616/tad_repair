<?php
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}


function xoops_module_install_tad_repair(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_repair/image/.thumbs');

    return true;
}

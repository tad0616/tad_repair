<?php
if (!class_exists('XoopsModules\Tad_repair\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tad_repair/preloads/autoloader.php';
}
define('_MB_TADREPAIR_REPAIRED', Utility::text_replace('It has been fixed'));

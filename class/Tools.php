<?php

namespace XoopsModules\Tad_repair;

/*
Tools Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Tools
 */
class Tools
{

    //新增檔案欄位
    public static function text_replace($text)
    {
        global $xoopsModuleConfig;
        if (!isset($xoopsModuleConfig['text_replace'])) {
            $modhandler = xoops_gethandler('module');
            $RepairModule = $modhandler->getByDirname("tad_repair");
            $config_handler = xoops_gethandler('config');
            $RepairModuleConfig = $config_handler->getConfigsByCat(0, $RepairModule->getVar('mid'));
        } else {
            $RepairModuleConfig = $xoopsModuleConfig;
        }

        if ($RepairModuleConfig['text_replace'] != '') {
            $items = explode(';', $RepairModuleConfig['text_replace']);
            foreach ($items as $item) {
                list($old_text, $new_text) = explode('=', trim($item));
                if (strpos($text, $old_text) !== false) {
                    return str_replace($old_text, $new_text, $text);
                }
            }
            return $text;
        } else {
            return $text;
        }

    }

}

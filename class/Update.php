<?php

namespace XoopsModules\Tad_repair;

/*
Update Class Definition

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
 * Class Update
 */
class Update
{

    //新增檔案欄位
    public static function chk_fc_tag()
    {
        global $xoopsDB;
        $sql = 'SELECT count(`tag`) FROM ' . $xoopsDB->prefix('tad_repair_files_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_fc_tag()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_repair_files_center') . "
    ADD `upload_date` DATETIME NOT NULL COMMENT '上傳時間',
    ADD `uid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上傳者',
    ADD `tag` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '註記'
    ";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin', 30, $xoopsDB->error());
    }

    //刪除錯誤的重複欄位及樣板檔
    public static function chk_tad_repair_block()
    {
        global $xoopsDB;
        //die(var_export($xoopsConfig));
        require XOOPS_ROOT_PATH . '/modules/tad_repair/xoops_version.php';

        //先找出該有的區塊以及對應樣板
        foreach ($modversion['blocks'] as $i => $block) {
            $show_func = $block['show_func'];
            $tpl_file_arr[$show_func] = $block['template'];
            $tpl_desc_arr[$show_func] = $block['description'];
        }

        //找出目前所有的樣板檔
        $sql = 'SELECT bid,name,visible,show_func,template FROM `' . $xoopsDB->prefix('newblocks') . "`
    WHERE `dirname` = 'tad_repair' ORDER BY `func_num`";
        $result = $xoopsDB->query($sql);
        while (list($bid, $name, $visible, $show_func, $template) = $xoopsDB->fetchRow($result)) {
            //假如現有的區塊和樣板對不上就刪掉
            if ($template != $tpl_file_arr[$show_func]) {
                $sql = 'delete from ' . $xoopsDB->prefix('newblocks') . " where bid='{$bid}'";
                $xoopsDB->queryF($sql);

                //連同樣板以及樣板實體檔案也要刪掉
                $sql = 'delete from ' . $xoopsDB->prefix('tplfile') . ' as a
            left join ' . $xoopsDB->prefix('tplsource') . "  as b on a.tpl_id=b.tpl_id
            where a.tpl_refid='$bid' and a.tpl_module='tad_repair' and a.tpl_type='block'";
                $xoopsDB->queryF($sql);
            } else {
                $sql = 'update ' . $xoopsDB->prefix('tplfile') . "
            set tpl_file='{$template}' , tpl_desc='{$tpl_desc_arr[$show_func]}'
            where tpl_refid='{$bid}'";
                $xoopsDB->queryF($sql);
            }
        }
    }

    //修正uid欄位
    public static function chk_uid()
    {
        global $xoopsDB;
        $sql = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS
  WHERE table_name = '" . $xoopsDB->prefix('tad_repair') . "' AND COLUMN_NAME = 'repair_uid'";
        $result = $xoopsDB->query($sql);
        list($type) = $xoopsDB->fetchRow($result);
        if ('smallint' === $type) {
            return true;
        }

        return false;
    }

    //執行更新
    public static function go_update_uid()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_repair') . '` CHANGE `repair_uid` `repair_uid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0';
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }

    //檢查某欄位是否存在
    public static function chk_chk1()
    {
        global $xoopsDB;
        $sql = 'select count(`repair_place`) from ' . $xoopsDB->prefix('tad_repair');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    //執行更新
    public static function go_update1()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_repair') . " ADD `repair_place` varchar(255) NOT NULL default '' COMMENT '報修地點' AFTER `repair_title`";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }

    //新增檔案表格
    public static function chk_chk2()
    {
        global $xoopsDB;
        $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('tad_repair_files_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_update2()
    {
        global $xoopsDB;
        $sql = 'CREATE TABLE `' . $xoopsDB->prefix('tad_repair_files_center') . "` (
      `files_sn` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '檔案流水號',
      `col_name` varchar(255) NOT NULL default '' COMMENT '欄位名稱',
      `col_sn` smallint(5) unsigned NOT NULL default 0 COMMENT '欄位編號',
      `sort` smallint(5) unsigned NOT NULL default 0 COMMENT '排序',
      `kind` enum('img','file') NOT NULL default 'img' COMMENT '檔案種類',
      `file_name` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
      `file_type` varchar(255) NOT NULL default '' COMMENT '檔案類型',
      `file_size` int(10) unsigned NOT NULL default 0 COMMENT '檔案大小',
      `description` text NOT NULL COMMENT '檔案說明',
      `counter` mediumint(8) unsigned NOT NULL default 0 COMMENT '下載人次',
      `original_filename` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
      `hash_filename` varchar(255) NOT NULL default '' COMMENT '加密檔案名稱',
      `sub_dir` varchar(255) NOT NULL default '' COMMENT '檔案子路徑',
PRIMARY KEY (`files_sn`)
    ) ENGINE=MyISAM;";
        $xoopsDB->queryF($sql);
    }

    //執行更新
    public static function update_blank_status()
    {
        global $xoopsDB, $xoopsModuleConfig;
        $arr = explode(';', $xoopsModuleConfig['fixed_status']);
        if (false !== mb_strpos('=', $arr[0])) {
            $status = explode('=', $arr[0]);
            $fixed_status = $status[1];
        } else {
            $fixed_status = $arr[0];
        }

        $sql = 'UPDATE ' . $xoopsDB->prefix('tad_repair') . " SET `fixed_status` ='{$fixed_status}' WHERE `fixed_status`=''";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }
}

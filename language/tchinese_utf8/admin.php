<?php
use XoopsModules\Tad_repair\Tools;
if (!class_exists('XoopsModules\Tad_repair\Tools')) {
    require XOOPS_ROOT_PATH . '/modules/tad_repair/preloads/autoloader.php';
}
xoops_loadLanguage('admin_common', 'tadtools');

define('_AND', Tools::text_replace('、'));

//unit.php
define('_MA_TADREPAIR_UNIT_TITLE', Tools::text_replace('負責維護的單位名稱'));
define('_MA_TADREPAIR_UNIT_ADMIN', Tools::text_replace('該單位管理人員'));
define('_MA_TAD_REPAIR_UNIT_FORM', Tools::text_replace('設定負責維護的單位及其管理人員'));

//index.php
define('_MA_TADREPAIR_REPAIR_SN', Tools::text_replace('編號'));
define('_MA_TADREPAIR_REPAIR_TITLE', Tools::text_replace('報修內容'));
define('_MA_TADREPAIR_REPAIR_DATE', Tools::text_replace('報修日期'));
define('_MA_TADREPAIR_REPAIR_STATUS', Tools::text_replace('嚴重程度'));
define('_MA_TADREPAIR_REPAIR_STATUS2', Tools::text_replace('等級'));
define('_MA_TADREPAIR_REPAIR_UID', Tools::text_replace('報修者'));
define('_MA_TADREPAIR_UNIT', Tools::text_replace('通知'));
define('_MA_TADREPAIR_FIXED_UID', Tools::text_replace('回覆者'));
define('_MA_TADREPAIR_FIXED_DATE', Tools::text_replace('回覆日期'));
define('_MA_TADREPAIR_FIXED_STATUS', Tools::text_replace('處理狀況'));
define('_MA_TADREPAIR_FIXED_STATUS2', Tools::text_replace('處理'));
define('_MA_TADREPAIR_EMPTY', Tools::text_replace('恭喜！目前沒有任何通報！'));

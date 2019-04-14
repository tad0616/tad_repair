<?php
require_once XOOPS_ROOT_PATH . '/modules/tadtools/language/' . $xoopsConfig['language'] . '/modinfo_common.php';
define('_MI_TADREPAIR_NAME', '維修通報');
define('_MI_TADREPAIR_AUTHOR', '維修通報');
define('_MI_TADREPAIR_CREDITS', 'tad');
define('_MI_TADREPAIR_DESC', '維修通報系統');
define('_MI_TADREPAIR_ADMENU1', '報修管理');
define('_MI_TADREPAIR_ADMENU2', '單位設定');
define('_MI_TADREPAIR_SMNAME1', '維修通報總覽');
define('_MI_TADREPAIR_SMNAME2', '填寫維修單');
define('_MI_TADREPAIR_BNAME1', '待修通報');
define('_MI_TADREPAIR_BDESC1', '待修通報(wait_to_repair)');

define('_MI_TADREPAIR_REPAIR_STATUS', '嚴重程度');
define('_MI_TADREPAIR_REPAIR_STATUS_DESC', '設定「顏色碼=嚴重程度」的選項，請以「;」隔開（第一項為預設值）');
define('_MI_TADREPAIR_REPAIR_STATUS_VAL', '#C9AB24=輕微;#FF7802=中等;#FF0206=嚴重');

define('_MI_TADREPAIR_FIXED_STATUS', '處理狀況');
define('_MI_TADREPAIR_FIXED_STATUS_DESC', '設定「顏色碼=處理狀況」的選項，請以「;」隔開（第一項為預設值）。「尚待處理」及「已修復」選項請勿移除或修改，因為程式會用到。');
define('_MI_TADREPAIR_FIXED_STATUS_VAL', '#E80DB8=尚待處理;#4F6820=處理中;#336BBF=已修復');

define('_MI_TADREPAIR_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADREPAIR_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TADREPAIR_BACK_2_ADMIN', '管理');

//help
define('_MI_TADREPAIR_HELP_OVERVIEW', '概要');

define('_MI_TADREPAIR_SHOW_COLS', '選擇欲顯示欄位');
define('_MI_TADREPAIR_SHOW_COLS_DESC', '按住Ctrl鍵可以挑選在前台報表欲顯示的欄位');
define('_MI_TADREPAIR_SHOW_DATE', '報修日期');
define('_MI_TADREPAIR_SHOW_UID', '報修者');
define('_MI_TADREPAIR_UNIT', '通知');
define('_MI_TADREPAIR_STATUS', '等級');
define('_MI_TADREPAIR_SHOW_FIXED_UID', '回覆者');
define('_MI_TADREPAIR_SHOW_FIXED_DATE', '回覆日期');
define('_MI_TADREPAIR_SHOW_FIXED_STATUS', '處理');
define('_MI_TADREPAIR_PLACE', '報修地點');

define('_MI_TADREPAIR_CONTENT', '詳細說明');
define('_MI_TADREPAIR_UNUSE_COLS', '選擇不使用欄位');
define('_MI_TADREPAIR_UNUSE_COLS_DESC', '不使用欄位不會出現在表單，亦不會出現在列表');

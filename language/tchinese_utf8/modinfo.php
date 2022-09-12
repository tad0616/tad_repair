<?php
use XoopsModules\Tad_repair\Utility;
xoops_loadLanguage('modinfo_common', 'tadtools');
define('_MI_TADREPAIR_NAME', Utility::text_replace('維修通報'));
define('_MI_TADREPAIR_AUTHOR', Utility::text_replace('維修通報'));
define('_MI_TADREPAIR_CREDITS', Utility::text_replace('tad'));
define('_MI_TADREPAIR_DESC', Utility::text_replace('維修通報系統'));
define('_MI_TADREPAIR_ADMENU1', Utility::text_replace('報修管理'));
define('_MI_TADREPAIR_ADMENU2', Utility::text_replace('單位設定'));
define('_MI_TADREPAIR_SMNAME1', Utility::text_replace('維修通報總覽'));
define('_MI_TADREPAIR_SMNAME2', Utility::text_replace('填寫維修單'));
define('_MI_TADREPAIR_BNAME1', Utility::text_replace('待修通報'));
define('_MI_TADREPAIR_BDESC1', Utility::text_replace('待修通報(wait_to_repair)'));

define('_MI_TADREPAIR_REPAIR_STATUS', Utility::text_replace('嚴重程度'));
define('_MI_TADREPAIR_REPAIR_STATUS_DESC', Utility::text_replace('設定「顏色碼=嚴重程度」的選項，請以「;」隔開（第一項為預設值）'));
define('_MI_TADREPAIR_REPAIR_STATUS_VAL', Utility::text_replace('#C9AB24=輕微;#FF7802=中等;#FF0206=嚴重'));

define('_MI_TADREPAIR_FIXED_STATUS', Utility::text_replace('處理狀況'));
define('_MI_TADREPAIR_FIXED_STATUS_DESC', Utility::text_replace('設定「顏色碼=處理狀況」的選項，請以「;」隔開（第一項為預設值）。「尚待處理」及「已修復」選項請勿移除或修改，因為程式會用到。'));
define('_MI_TADREPAIR_FIXED_STATUS_VAL', Utility::text_replace('#E80DB8=尚待處理;#4F6820=處理中;#336BBF=已修復'));

define('_MI_TADREPAIR_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADREPAIR_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TADREPAIR_BACK_2_ADMIN', Utility::text_replace('管理'));

//help
define('_MI_TADREPAIR_HELP_OVERVIEW', Utility::text_replace('概要'));

define('_MI_TADREPAIR_SHOW_COLS', Utility::text_replace('選擇欲顯示欄位'));
define('_MI_TADREPAIR_SHOW_COLS_DESC', Utility::text_replace('按住Ctrl鍵可以挑選在前台報表欲顯示的欄位'));
define('_MI_TADREPAIR_SHOW_DATE', Utility::text_replace('報修日期'));
define('_MI_TADREPAIR_SHOW_UID', Utility::text_replace('報修者'));
define('_MI_TADREPAIR_UNIT', Utility::text_replace('通知'));
define('_MI_TADREPAIR_STATUS', Utility::text_replace('等級'));
define('_MI_TADREPAIR_SHOW_FIXED_UID', Utility::text_replace('回覆者'));
define('_MI_TADREPAIR_SHOW_FIXED_DATE', Utility::text_replace('回覆日期'));
define('_MI_TADREPAIR_SHOW_FIXED_STATUS', Utility::text_replace('處理'));
define('_MI_TADREPAIR_PLACE', Utility::text_replace('報修地點'));

define('_MI_TADREPAIR_CONTENT', Utility::text_replace('詳細說明'));
define('_MI_TADREPAIR_UNUSE_COLS', Utility::text_replace('選擇不使用欄位'));
define('_MI_TADREPAIR_UNUSE_COLS_DESC', Utility::text_replace('不使用欄位不會出現在表單，亦不會出現在列表'));

define('_MI_TADREPAIR_TEXT_REPLACE', Utility::text_replace('字詞替換'));
define('_MI_TADREPAIR_TEXT_REPLACE_DESC', Utility::text_replace('格式：「原字詞1=新字詞1;原字詞2=新字詞2」'));

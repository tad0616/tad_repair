<?php
include_once XOOPS_ROOT_PATH . '/modules/tadtools/language/' . $xoopsConfig['language'] . '/modinfo_common.php';
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
define('_MI_TADREPAIR_FIXED_STATUS_DESC', '設定「顏色碼=處理狀況」的選項，請以「;」隔開（第一項為預設值）。「已修復」選項請勿移除或修改，因為程式會用到。');
define('_MI_TADREPAIR_FIXED_STATUS_VAL', '#E80DB8=尚待處理;#4F6820=處理中;#336BBF=已修復');

define('_MI_TADREPAIR_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADREPAIR_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TADREPAIR_BACK_2_ADMIN', '管理');

//help
define('_MI_TADREPAIR_HELP_OVERVIEW', '概要');

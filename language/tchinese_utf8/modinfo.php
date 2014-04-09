<?php
include_once XOOPS_ROOT_PATH."/modules/tadtools/language/{$xoopsConfig['language']}/modinfo_common.php";
define("_MI_TADREPAIR_NAME","維修通報");
define("_MI_TADREPAIR_AUTHOR","維修通報");
define("_MI_TADREPAIR_CREDITS","tad");
define("_MI_TADREPAIR_DESC","維修通報系統");
define("_MI_TADREPAIR_ADMENU1", "報修管理");
define("_MI_TADREPAIR_ADMENU2", "單位設定");
define("_MI_TADREPAIR_SMNAME1", "維修通報總覽");
define("_MI_TADREPAIR_SMNAME2", "填寫維修單");
define("_MI_TADREPAIR_BNAME1","待修通報");
define("_MI_TADREPAIR_BDESC1","待修通報(wait_to_repair)");

define("_MI_TADREPAIR_REPAIR_STATUS","嚴重程度");
define("_MI_TADREPAIR_REPAIR_STATUS_DESC","設定「嚴重程度」的選項，請以「;」隔開（第一項為預設值）");
define("_MI_TADREPAIR_REPAIR_STATUS_VAL","輕微;中等;嚴重");

define("_MI_TADREPAIR_FIXED_STATUS","處理狀況");
define("_MI_TADREPAIR_FIXED_STATUS_DESC","設定「處理狀況」的選項，請以「;」隔開（第一項為預設值）。「已修復」選項請勿移除或修改，因為程式會用到。");
define("_MI_TADREPAIR_FIXED_STATUS_VAL","尚待處理;處理中;已修復");

?>
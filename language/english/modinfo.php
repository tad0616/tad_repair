<?php
include_once XOOPS_ROOT_PATH."/modules/tadtools/language/{$xoopsConfig['language']}/modinfo_common.php";

define("_MI_TADREPAIR_NAME", "Service Bulletins");
define("_MI_TADREPAIR_AUTHOR", "Service Bulletins");
define("_MI_TADREPAIR_CREDITS", "Tad");
define("_MI_TADREPAIR_DESC", "Maintenance Notification System");
define("_MI_TADREPAIR_ADMENU1", "Repair management");
define("_MI_TADREPAIR_ADMENU2", "Unit Settings");
define("_MI_TADREPAIR_SMNAME1", "Service Bulletins Overview");
define("_MI_TADREPAIR_SMNAME2", "Fill in the repair order");
define("_MI_TADREPAIR_BNAME1", "to be repaired Bulletin");
define("_MI_TADREPAIR_BDESC1", "to be repaired Bulletin (wait_to_repair)");

define("_MI_TADREPAIR_REPAIR_STATUS", "Severity");
define("_MI_TADREPAIR_REPAIR_STATUS_DESC", 'Set options" severity "is, please"; "separated (first item is the default)');
define("_MI_TADREPAIR_REPAIR_STATUS_VAL", "mild; moderate; severe");

define("_MI_TADREPAIR_FIXED_STATUS", "Processing status");
define("_MI_TADREPAIR_FIXED_STATUS_DESC", 'Set" process status "option, please"; "separated (first item is the default)," has been fixed. "Do not remove or modify the options, because the program will be used. ');
define("_MI_TADREPAIR_FIXED_STATUS_VAL", "Pending; Processing; has been fixed");

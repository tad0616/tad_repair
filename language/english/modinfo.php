<?php
include_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/modinfo_common.php";

define('_MI_TADREPAIR_NAME', 'Tad Repair');
define('_MI_TADREPAIR_AUTHOR', 'Tad');
define('_MI_TADREPAIR_CREDITS', 'Tad');
define('_MI_TADREPAIR_DESC', 'Maintenance Notification System');
define('_MI_TADREPAIR_ADMENU1', 'Repair Management');
define('_MI_TADREPAIR_ADMENU2', 'Department Settings');
define('_MI_TADREPAIR_SMNAME1', 'Service Bulletins Overview');
define('_MI_TADREPAIR_SMNAME2', 'Submit Repair order');
define('_MI_TADREPAIR_BNAME1', 'Open Repairs');
define('_MI_TADREPAIR_BDESC1', 'To be repaired Bulletin (wait_to_repair)');

define('_MI_TADREPAIR_REPAIR_STATUS', 'Severity');
define('_MI_TADREPAIR_REPAIR_STATUS_DESC', 'Set options for "color=severity", please use ";" as separator (first item is the default)');
define('_MI_TADREPAIR_REPAIR_STATUS_VAL', '#C9AB24=Low;#FF7802=Moderate;#FF0206=Severe');

define('_MI_TADREPAIR_FIXED_STATUS', 'Processing status');
define('_MI_TADREPAIR_FIXED_STATUS_DESC', 'Set "color=process status" option, please use ";" as separator (first item is the default). <br/>Once set, do NOT remove or modify the options, because the program will be used for fixed repairs. ');
define('_MI_TADREPAIR_FIXED_STATUS_VAL', '#E80DB8=Pending;#4F6820=Processing;#336BBF=Fixed');

define('_MI_TADREPAIR_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADREPAIR_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_TADREPAIR_BACK_2_ADMIN', 'Back to Administration of ');

//help
define('_MI_TADREPAIR_HELP_OVERVIEW', 'Overview');

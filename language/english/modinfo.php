<?php
xoops_loadLanguage('modinfo_common', 'tadtools');

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
define('_MI_TADREPAIR_FIXED_STATUS_DESC', 'Set "color=process status" option, please use ";" as separator (first item is the default). <br>Once set, do NOT remove or modify the options, because the program will be used for fixed repairs. ');
define('_MI_TADREPAIR_FIXED_STATUS_VAL', '#E80DB8=Pending;#4F6820=Processing;#336BBF=Fixed');

define('_MI_TADREPAIR_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADREPAIR_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TADREPAIR_BACK_2_ADMIN', 'Back to Administration of ');

//help
define('_MI_TADREPAIR_HELP_OVERVIEW', 'Overview');

define('_MI_TADREPAIR_SHOW_COLS', 'Select the field to display');
define('_MI_TADREPAIR_SHOW_COLS_DESC', 'Hold down the Ctrl key to pick the fields you want to show in the foreground report');
define('_MI_TADREPAIR_SHOW_DATE', 'Date');
define('_MI_TADREPAIR_SHOW_UID', 'Submitter');
define('_MI_TADREPAIR_UNIT', 'Department');
define('_MI_TADREPAIR_STATUS', 'Severity');
define('_MI_TADREPAIR_SHOW_FIXED_UID', 'Respondents');
define('_MI_TADREPAIR_SHOW_FIXED_DATE', 'Date');
define('_MI_TADREPAIR_SHOW_FIXED_STATUS', 'Status');
define('_MI_TADREPAIR_PLACE', 'Place');

define('_MI_TADREPAIR_CONTENT', 'Details');
define('_MI_TADREPAIR_UNUSE_COLS', 'choose not to use field');
define('_MI_TADREPAIR_UNUSE_COLS_DESC', 'do not use the field does not appear in the form, it will not appear in the list');
define('_MD_TADREPAIR_NOT_USER', 'This notification is not your notification, without modification');

define('_MI_TADREPAIR_TEXT_REPLACE', 'Word replacement');
define('_MI_TADREPAIR_TEXT_REPLACE_DESC', 'Format: "Original word 1=New word 1;Original word 2=New word 2"');

define('_MI_TADREPAIR_CAN_SEND_MAIL', 'Are notification letters sent?');
define('_MI_TADREPAIR_CAN_SEND_MAIL_DESC', 'Close the system if you can\'t send mail.');

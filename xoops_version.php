<?php

global $xoopsConfig;

$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TADREPAIR_NAME;
// $modversion['version'] = 2.48;
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TADREPAIR_DESC;
$modversion['author'] = _MI_TADREPAIR_AUTHOR;
$modversion['credits'] = _MI_TADREPAIR_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2024-11-11';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5.10';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1; //---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = [
    'tad_repair',
    'tad_repair_unit',
    'tad_repair_files_center',
];

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;
$modversion['sub'] = [
    ['name' => _MI_TADREPAIR_SMNAME1, 'url' => 'index.php'],
    ['name' => _MI_TADREPAIR_SMNAME2, 'url' => 'repair.php'],
];

//---樣板設定---//
$modversion['templates'] = [
    ['file' => 'tad_repair_index.tpl', 'description' => 'tad_repair_index.tpl'],
    ['file' => 'tad_repair_admin.tpl', 'description' => 'tad_repair_admin.tpl'],
];

//---區塊設定---//
$modversion['blocks'] = [
    [
        'file' => 'wait_to_repair.php',
        'name' => _MI_TADREPAIR_BNAME1,
        'description' => _MI_TADREPAIR_BDESC1,
        'show_func' => 'wait_to_repair',
        'template' => 'wait_to_repair.tpl',
    ],
];

//---偏好設定---//
$modversion['config'] = [
    [
        'name' => 'repair_status',
        'title' => '_MI_TADREPAIR_REPAIR_STATUS',
        'description' => '_MI_TADREPAIR_REPAIR_STATUS_DESC',
        'formtype' => 'textbox',
        'valuetype' => 'text',
        'default' => _MI_TADREPAIR_REPAIR_STATUS_VAL,
    ],
    [
        'name' => 'fixed_status',
        'title' => '_MI_TADREPAIR_FIXED_STATUS',
        'description' => '_MI_TADREPAIR_FIXED_STATUS_DESC',
        'formtype' => 'textbox',
        'valuetype' => 'text',
        'default' => _MI_TADREPAIR_FIXED_STATUS_VAL,
    ],
    [
        'name' => 'show_cols',
        'title' => '_MI_TADREPAIR_SHOW_COLS',
        'description' => '_MI_TADREPAIR_SHOW_COLS_DESC',
        'formtype' => 'select_multi',
        'valuetype' => 'array',
        'default' => ['repair_date', 'repair_place', 'repair_uid', 'unit_sn', 'repair_status', 'fixed_uid', 'fixed_date', 'fixed_status'],
        'options' => [
            '_MI_TADREPAIR_SHOW_DATE' => 'repair_date',
            '_MI_TADREPAIR_PLACE' => 'repair_place',
            '_MI_TADREPAIR_SHOW_UID' => 'repair_uid',
            '_MI_TADREPAIR_UNIT' => 'unit_sn',
            '_MI_TADREPAIR_STATUS' => 'repair_status',
            '_MI_TADREPAIR_SHOW_FIXED_UID' => 'fixed_uid',
            '_MI_TADREPAIR_SHOW_FIXED_DATE' => 'fixed_date',
            '_MI_TADREPAIR_SHOW_FIXED_STATUS' => 'fixed_status',
        ],
    ],
    [
        'name' => 'unuse_cols',
        'title' => '_MI_TADREPAIR_UNUSE_COLS',
        'description' => '_MI_TADREPAIR_UNUSE_COLS_DESC',
        'formtype' => 'select_multi',
        'valuetype' => 'array',
        'default' => [],
        'options' => [
            '_MI_TADREPAIR_PLACE' => 'repair_place',
            '_MI_TADREPAIR_STATUS' => 'repair_status',
            '_MI_TADREPAIR_CONTENT' => 'repair_content',
        ],
    ],
    [
        'name' => 'text_replace',
        'title' => '_MI_TADREPAIR_TEXT_REPLACE',
        'description' => '_MI_TADREPAIR_TEXT_REPLACE_DESC',
        'formtype' => 'textarea',
        'valuetype' => 'text',
        'default' => "",
    ],
    [
        'name' => 'can_send_mail',
        'title' => '_MI_TADREPAIR_CAN_SEND_MAIL',
        'description' => '_MI_TADREPAIR_CAN_SEND_MAIL_DESC',
        'formtype' => 'yesno',
        'valuetype' => 'int',
        'default' => 1,
    ],
];

//---搜尋設定---//
$modversion['hasSearch'] = 1;
$modversion['search'] = [
    'file' => 'include/tad_repair_search.php',
    'func' => 'tad_repair_search',
];

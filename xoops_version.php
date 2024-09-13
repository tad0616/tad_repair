<?php

global $xoopsConfig;

$modversion = [];

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
$modversion['release_date'] = '2023-01-29';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation : ' . _MI_TAD_WEB;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1; //---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_repair';
$modversion['tables'][2] = 'tad_repair_unit';
$modversion['tables'][3] = 'tad_repair_files_center';

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
$modversion['sub'][1]['name'] = _MI_TADREPAIR_SMNAME1;
$modversion['sub'][1]['url'] = 'index.php';
$modversion['sub'][2]['name'] = _MI_TADREPAIR_SMNAME2;
$modversion['sub'][2]['url'] = 'repair.php';

//---樣板設定---//
$modversion['templates'] = [];
$i = 1;
$modversion['templates'][$i]['file'] = 'tad_repair_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_index.tpl';
$i++;
$modversion['templates'][$i]['file'] = 'tad_repair_repair.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_repair.tpl';
$i++;
$modversion['templates'][$i]['file'] = 'tad_repair_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_adm_main.tpl';
$i++;
$modversion['templates'][$i]['file'] = 'tad_repair_adm_unit.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_adm_unit.tpl';

//---區塊設定---//
$modversion['blocks'][1]['file'] = 'wait_to_repair.php';
$modversion['blocks'][1]['name'] = _MI_TADREPAIR_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADREPAIR_BDESC1;
$modversion['blocks'][1]['show_func'] = 'wait_to_repair';
$modversion['blocks'][1]['template'] = 'wait_to_repair.tpl';

//---偏好設定---//
$i = 0;
$modversion['config'][$i]['name'] = 'repair_status';
$modversion['config'][$i]['title'] = '_MI_TADREPAIR_REPAIR_STATUS';
$modversion['config'][$i]['description'] = '_MI_TADREPAIR_REPAIR_STATUS_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_TADREPAIR_REPAIR_STATUS_VAL;

$i++;
$modversion['config'][$i]['name'] = 'fixed_status';
$modversion['config'][$i]['title'] = '_MI_TADREPAIR_FIXED_STATUS';
$modversion['config'][$i]['description'] = '_MI_TADREPAIR_FIXED_STATUS_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_TADREPAIR_FIXED_STATUS_VAL;

$i++;
$modversion['config'][$i]['name'] = 'show_cols';
$modversion['config'][$i]['title'] = '_MI_TADREPAIR_SHOW_COLS';
$modversion['config'][$i]['description'] = '_MI_TADREPAIR_SHOW_COLS_DESC';
$modversion['config'][$i]['formtype'] = 'select_multi';
$modversion['config'][$i]['valuetype'] = 'array';
$modversion['config'][$i]['default'] = ['repair_date', 'repair_place', 'repair_uid', 'unit_sn', 'repair_status', 'fixed_uid', 'fixed_date', 'fixed_status'];
$modversion['config'][$i]['options'] = [
    '_MI_TADREPAIR_SHOW_DATE' => 'repair_date',
    '_MI_TADREPAIR_PLACE' => 'repair_place',
    '_MI_TADREPAIR_SHOW_UID' => 'repair_uid',
    '_MI_TADREPAIR_UNIT' => 'unit_sn',
    '_MI_TADREPAIR_STATUS' => 'repair_status',
    '_MI_TADREPAIR_SHOW_FIXED_UID' => 'fixed_uid',
    '_MI_TADREPAIR_SHOW_FIXED_DATE' => 'fixed_date',
    '_MI_TADREPAIR_SHOW_FIXED_STATUS' => 'fixed_status',
];

$i++;
$modversion['config'][$i]['name'] = 'unuse_cols';
$modversion['config'][$i]['title'] = '_MI_TADREPAIR_UNUSE_COLS';
$modversion['config'][$i]['description'] = '_MI_TADREPAIR_UNUSE_COLS_DESC';
$modversion['config'][$i]['formtype'] = 'select_multi';
$modversion['config'][$i]['valuetype'] = 'array';
$modversion['config'][$i]['default'] = [];
$modversion['config'][$i]['options'] = [
    '_MI_TADREPAIR_PLACE' => 'repair_place',
    '_MI_TADREPAIR_STATUS' => 'repair_status',
    '_MI_TADREPAIR_CONTENT' => 'repair_content',
];

$i++;
$modversion['config'][$i]['name'] = 'text_replace';
$modversion['config'][$i]['title'] = '_MI_TADREPAIR_TEXT_REPLACE';
$modversion['config'][$i]['description'] = '_MI_TADREPAIR_TEXT_REPLACE_DESC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "";

//---搜尋設定---//
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/tad_repair_search.php';
$modversion['search']['func'] = 'tad_repair_search';

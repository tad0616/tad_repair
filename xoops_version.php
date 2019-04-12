<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name']        = _MI_TADREPAIR_NAME;
$modversion['version']     = 2.41;
$modversion['description'] = _MI_TADREPAIR_DESC;
$modversion['author']      = _MI_TADREPAIR_AUTHOR;
$modversion['credits']     = _MI_TADREPAIR_CREDITS;
$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image']       = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname']     = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date']        = '2019/01/01';
$modversion['module_website_url']  = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status']       = 'release';
$modversion['author_website_url']  = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php']             = 5.4;
$modversion['min_xoops']           = '2.5';

//---paypal資訊---//
$modversion['paypal']                  = [];
$modversion['paypal']['business']      = 'tad0616@gmail.com';
$modversion['paypal']['item_name']     = 'Donation : ' . _MI_TAD_WEB;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---啟動後台管理界面選單---//
$modversion['system_menu']      = 1; //---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1]        = "tad_repair";
$modversion['tables'][2]        = "tad_repair_unit";
$modversion['tables'][3]        = "tad_repair_files_center";

//---安裝設定---//
$modversion['onInstall']   = "include/onInstall.php";
$modversion['onUpdate']    = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---管理介面設定---//
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu']  = "admin/menu.php";

//---使用者主選單設定---//
$modversion['hasMain']        = 1;
$modversion['sub'][1]['name'] = _MI_TADREPAIR_SMNAME1;
$modversion['sub'][1]['url']  = "index.php";
$modversion['sub'][2]['name'] = _MI_TADREPAIR_SMNAME2;
$modversion['sub'][2]['url']  = "repair.php";

//---樣板設定---//
$modversion['templates']                    = [];
$i                                          = 1;
$modversion['templates'][$i]['file']        = 'tad_repair_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_index.tpl';
$i++;
$modversion['templates'][$i]['file']        = 'tad_repair_repair.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_repair.tpl';
$i++;
$modversion['templates'][$i]['file']        = 'tad_repair_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_adm_main.tpl';
$i++;
$modversion['templates'][$i]['file']        = 'tad_repair_adm_unit.tpl';
$modversion['templates'][$i]['description'] = 'tad_repair_adm_unit.tpl';

//---區塊設定---//
$modversion['blocks'][1]['file']        = "wait_to_repair.php";
$modversion['blocks'][1]['name']        = _MI_TADREPAIR_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADREPAIR_BDESC1;
$modversion['blocks'][1]['show_func']   = "wait_to_repair";
$modversion['blocks'][1]['template']    = "wait_to_repair.tpl";

//---偏好設定---//
$modversion['config'][0]['name']        = 'repair_status';
$modversion['config'][0]['title']       = '_MI_TADREPAIR_REPAIR_STATUS';
$modversion['config'][0]['description'] = '_MI_TADREPAIR_REPAIR_STATUS_DESC';
$modversion['config'][0]['formtype']    = 'textbox';
$modversion['config'][0]['valuetype']   = 'text';
$modversion['config'][0]['default']     = _MI_TADREPAIR_REPAIR_STATUS_VAL;

$modversion['config'][1]['name']        = 'fixed_status';
$modversion['config'][1]['title']       = '_MI_TADREPAIR_FIXED_STATUS';
$modversion['config'][1]['description'] = '_MI_TADREPAIR_FIXED_STATUS_DESC';
$modversion['config'][1]['formtype']    = 'textbox';
$modversion['config'][1]['valuetype']   = 'text';
$modversion['config'][1]['default']     = _MI_TADREPAIR_FIXED_STATUS_VAL;

$modversion['config'][2]['name']        = 'show_cols';
$modversion['config'][2]['title']       = '_MI_TADREPAIR_SHOW_COLS';
$modversion['config'][2]['description'] = '_MI_TADREPAIR_SHOW_COLS_DESC';
$modversion['config'][2]['formtype']    = 'select_multi';
$modversion['config'][2]['valuetype']   = 'array';
$modversion['config'][2]['default']     = ['repair_date', 'repair_place', 'repair_uid', 'unit_sn', 'repair_status', 'fixed_uid', 'fixed_date', 'fixed_status'];
$modversion['config'][2]['options']     = [
    '_MI_TADREPAIR_SHOW_DATE'         => 'repair_date',
    '_MI_TADREPAIR_PLACE'             => 'repair_place',
    '_MI_TADREPAIR_SHOW_UID'          => 'repair_uid',
    '_MI_TADREPAIR_UNIT'              => 'unit_sn',
    '_MI_TADREPAIR_STATUS'            => 'repair_status',
    '_MI_TADREPAIR_SHOW_FIXED_UID'    => 'fixed_uid',
    '_MI_TADREPAIR_SHOW_FIXED_DATE'   => 'fixed_date',
    '_MI_TADREPAIR_SHOW_FIXED_STATUS' => 'fixed_status',
];

$modversion['config'][3]['name']        = 'unuse_cols';
$modversion['config'][3]['title']       = '_MI_TADREPAIR_UNUSE_COLS';
$modversion['config'][3]['description'] = '_MI_TADREPAIR_UNUSE_COLS_DESC';
$modversion['config'][3]['formtype']    = 'select_multi';
$modversion['config'][3]['valuetype']   = 'array';
$modversion['config'][3]['default']     = [];
$modversion['config'][3]['options']     = [
    '_MI_TADREPAIR_PLACE'   => 'repair_place',
    '_MI_TADREPAIR_STATUS'  => 'repair_status',
    '_MI_TADREPAIR_CONTENT' => 'repair_content',
];

//---搜尋設定---//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = "include/tad_repair_search.php";
$modversion['search']['func'] = "tad_repair_search";

<?php
$modversion = array();

//---模組基本資訊---//
$modversion['name'] = _MI_TADREPAIR_NAME;
$modversion['version'] = 2.1;
$modversion['description'] = _MI_TADREPAIR_DESC;
$modversion['author'] = _MI_TADREPAIR_AUTHOR;
$modversion['credits'] = _MI_TADREPAIR_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname'] = basename(dirname(__FILE__));

//---模組狀態資訊---//
$modversion['release_date'] = '2014/06/15';
$modversion['module_website_url'] = 'http://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'http://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php']=5.2;
$modversion['min_xoops']='2.5';

//---paypal資訊---//
$modversion ['paypal'] = array();
$modversion ['paypal']['business'] = 'tad0616@gmail.com';
$modversion ['paypal']['item_name'] = 'Donation : ' . _MI_TAD_WEB;
$modversion ['paypal']['amount'] = 0;
$modversion ['paypal']['currency_code'] = 'USD';


//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "tad_repair";
$modversion['tables'][2] = "tad_repair_unit";

//---安裝設定---//
$modversion['onInstall'] = "include/onInstall.php";
$modversion['onUpdate'] = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//---使用者主選單設定---//
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] =_MI_TADREPAIR_SMNAME1;
$modversion['sub'][1]['url'] = "index.php";
$modversion['sub'][2]['name'] =_MI_TADREPAIR_SMNAME2;
$modversion['sub'][2]['url'] = "repair.php";


//---樣板設定---//
$modversion['templates'] = array();
$i=1;
$modversion['templates'][$i]['file'] = 'tad_repair_index_tpl.html';
$modversion['templates'][$i]['description'] = 'tad_repair_index_tpl.html';
$i++;
$modversion['templates'][$i]['file'] = 'tad_repair_repair_tpl.html';
$modversion['templates'][$i]['description'] = 'tad_repair_repair_tpl.html';
$i++;
$modversion['templates'][$i]['file'] = 'tad_repair_adm_main.html';
$modversion['templates'][$i]['description'] = 'tad_repair_adm_main.html';
$i++;
$modversion['templates'][$i]['file'] = 'tad_repair_adm_unit.html';
$modversion['templates'][$i]['description'] = 'tad_repair_adm_unit.html';


//---區塊設定---//
$modversion['blocks'][1]['file'] = "wait_to_repair.php";
$modversion['blocks'][1]['name'] = _MI_TADREPAIR_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADREPAIR_BDESC1;
$modversion['blocks'][1]['show_func'] = "wait_to_repair";
$modversion['blocks'][1]['template'] = "wait_to_repair.html";

//---偏好設定---//
$modversion['config'][0]['name']	= 'repair_status';
$modversion['config'][0]['title']	= '_MI_TADREPAIR_REPAIR_STATUS';
$modversion['config'][0]['description']	= '_MI_TADREPAIR_REPAIR_STATUS_DESC';
$modversion['config'][0]['formtype']	= 'textbox';
$modversion['config'][0]['valuetype']	= 'text';
$modversion['config'][0]['default']	= _MI_TADREPAIR_REPAIR_STATUS_VAL;

$modversion['config'][1]['name']	= 'fixed_status';
$modversion['config'][1]['title']	= '_MI_TADREPAIR_FIXED_STATUS';
$modversion['config'][1]['description']	= '_MI_TADREPAIR_FIXED_STATUS_DESC';
$modversion['config'][1]['formtype']	= 'textbox';
$modversion['config'][1]['valuetype']	= 'text';
$modversion['config'][1]['default']	= _MI_TADREPAIR_FIXED_STATUS_VAL;

//---搜尋設定---//
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/tad_repair_search.php";
$modversion['search']['func'] = "tad_repair_search";
?>
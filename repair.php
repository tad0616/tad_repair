<?php
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_repair_repair.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

$TadUpFiles = new TadUpFiles('tad_repair');
/*-----------function區--------------*/

//tad_repair編輯表單
function tad_repair_form($repair_sn = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl, $TadUpFiles, $xoopsModuleConfig;
    if (empty($xoopsUser)) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NEED_LOGIN);
    }
    $user_uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : '';

    //抓取預設值
    if (!empty($repair_sn)) {
        $DBV = get_tad_repair($repair_sn);
        if (empty($user_uid) or $user_uid != $DBV['repair_uid']) {
            redirect_header('index.php', 3, _MD_TADREPAIR_NO_PERMISSION);
        }
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「repair_sn」欄位預設值
    $repair_sn = (!isset($DBV['repair_sn'])) ? $repair_sn : $DBV['repair_sn'];

    //設定「repair_title」欄位預設值
    $repair_title = (!isset($DBV['repair_title'])) ? null : $DBV['repair_title'];

    //設定「repair_place」欄位預設值
    $repair_place = (!isset($DBV['repair_place'])) ? null : $DBV['repair_place'];

    //設定「repair_content」欄位預設值
    $repair_content = (!isset($DBV['repair_content'])) ? '' : $DBV['repair_content'];

    //設定「repair_date」欄位預設值
    $repair_date = (!isset($DBV['repair_date'])) ? date('Y-m-d H:i:s') : $DBV['repair_date'];

    //設定「repair_status」欄位預設值
    $repair_status = (!isset($DBV['repair_status'])) ? '' : $DBV['repair_status'];

    //設定「repair_uid」欄位預設值
    $repair_uid = (!isset($DBV['repair_uid'])) ? $user_uid : $DBV['repair_uid'];

    //設定「unit_sn」欄位預設值
    $unit_sn = (!isset($DBV['unit_sn'])) ? '' : $DBV['unit_sn'];

    //設定「fixed_status」欄位預設值
    $fixed_status = (!isset($DBV['fixed_status'])) ? '' : $DBV['fixed_status'];
    if (_MD_TADREPAIR_REPAIRED == $fixed_status) {
        redirect_header('index.php', 3, _MD_TADREPAIR_CANT_MODIFY);
    }

    $op = (empty($repair_sn)) ? 'insert_tad_repair' : 'update_tad_repair';
    //$op="replace_tad_repair";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $unit_menu_options = get_tad_repair_unit_menu_options($unit_sn);
    if (empty($unit_menu_options)) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NEED_UNIT);
    }

    $xoopsTpl->assign('PHP_SELF', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('unit_sn_menu_options', $unit_menu_options);
    $xoopsTpl->assign('repair_title', $repair_title);
    $xoopsTpl->assign('repair_place', $repair_place);
    $xoopsTpl->assign('repair_content', $repair_content);
    $xoopsTpl->assign('repair_status', mc2arr('repair_status', $repair_status));
    $xoopsTpl->assign('repair_sn', $repair_sn);
    $xoopsTpl->assign('op', $op);
    $xoopsTpl->assign('repair_form_title', _MD_TAD_REPAIR_FORM);
    $xoopsTpl->assign('mode', 'repair_form');

    $xoopsTpl->assign('unuse_cols', $xoopsModuleConfig['unuse_cols']);

    //上傳表單（enctype='multipart/form-data'）
    $TadUpFiles->set_col('repair_sn', $repair_sn);
    $upform = $TadUpFiles->upform(true, 'repair_img');
    $xoopsTpl->assign('upform', $upform);
}

//取得tad_repair_unit分類選單的選項（單層選單）
function get_tad_repair_unit_menu_options($default_unit_sn = '0')
{
    global $xoopsDB, $xoopsModule;
    $sql = 'SELECT `unit_sn` , `unit_title` FROM `' . $xoopsDB->prefix('tad_repair_unit') . '` ORDER BY `unit_sn`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $option = '';
    while (list($unit_sn, $unit_title) = $xoopsDB->fetchRow($result)) {
        $selected = ($unit_sn == $default_unit_sn) ? "selected='selected'" : '';
        $option .= "<option value=$unit_sn $selected>{$unit_title}</option>";
    }

    return $option;
}

//新增維修通報
function insert_tad_repair()
{
    global $xoopsDB, $xoopsUser, $xoopsModuleConfig, $TadUpFiles;
    if (empty($xoopsUser)) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NEED_LOGIN);
    }
    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : '';

    $myts = \MyTextSanitizer::getInstance();
    $repair_title = $myts->addSlashes($_POST['repair_title']);
    $repair_place = $myts->addSlashes($_POST['repair_place']);
    $repair_content = $myts->addSlashes($_POST['repair_content']);
    $repair_status = $myts->addSlashes($_POST['repair_status']);

    $arr = explode(';', $xoopsModuleConfig['fixed_status']);
    // die(var_export($arr));
    if (false !== mb_strpos($arr[0], '=')) {
        $status = explode('=', $arr[0]);
        $fixed_status = $status[1];
    } else {
        $fixed_status = $arr[0];
    }
    $today = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));
    $today_chk = date('Y-m-d H:i', xoops_getUserTimestamp(time()));

    $sql = 'select repair_sn from `' . $xoopsDB->prefix('tad_repair') . "` where repair_title='{$repair_title}' and repair_uid='{$uid}' and repair_date like '{$today_chk}%'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($repair_sn) = $xoopsDB->fetchRow($result)) {
        redirect_header("index.php?repair_sn=$repair_sn", 3, _MD_TADREPAIR_DONT_REPEAT);
    }

    $unit_sn = empty($_POST['unit_sn']) ? '1' : $_POST['unit_sn'];

    $sql = 'insert into `' . $xoopsDB->prefix('tad_repair') . "`
	(`repair_title`, `repair_place`, `repair_content` , `repair_date` , `repair_status` , `repair_uid` , `unit_sn` , `fixed_date`, `fixed_status` , `fixed_content`)
    values('{$repair_title}' , '{$repair_place}' ,'{$repair_content}' , '{$today}' , '{$repair_status}' , '{$uid}' , '{$unit_sn}' ,'', '{$fixed_status}' , '')";
    // die($sql);
    $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $repair_sn = $xoopsDB->getInsertId();

    $TadUpFiles->set_col('repair_sn', $repair_sn);
    $TadUpFiles->upload_file('repair_img', 1280, 550, null, $repair_title, true);

    $unit_sn = $_POST['unit_sn'];
    $unit = unit_admin_arr();
    $msg = '';

    $repair_name = \XoopsUser::getUnameFromId($uid, 1);
    if (empty($repair_name)) {
        $repair_name = \XoopsUser::getUnameFromId($uid, 0);
    }

    $title = sprintf(_MD_TADREPAIR_MAIL_TITLE, $today, $repair_title);
    //把填報詳細內容也放入 MAIL
    $content = sprintf(_MD_TADREPAIR_MAIL_CONTENT, $repair_name, $today, $repair_title, nl2br($repair_content) .
        "<br> <a href='" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}'>" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}</a>");
    foreach ($unit[$unit_sn] as $uid) {
        $msg .= SendEmail($uid, $title, $content) . '<br>';
    }
    redirect_header("index.php?repair_sn=$repair_sn", 3, $msg);
}

//更新tad_repair某一筆資料
function update_tad_repair($repair_sn = '')
{
    global $xoopsDB, $xoopsUser, $TadUpFiles;
    if (empty($xoopsUser)) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NEED_LOGIN);
    }
    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : '';

    $myts = \MyTextSanitizer::getInstance();
    $repair_content = $myts->addSlashes($_POST['repair_content']);
    $repair_place = $myts->addSlashes($_POST['repair_place']);
    $repair_title = $myts->addSlashes($_POST['repair_title']);
    $repair_status = $myts->addSlashes($_POST['repair_status']);
    $unit_sn = (int) $_POST['unit_sn'];

    $today = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));

    $sql = 'update `' . $xoopsDB->prefix('tad_repair') . "` set
    `repair_title` = '{$repair_title}' ,
    `repair_place` = '{$repair_place}' ,
    `repair_content` = '{$repair_content}' ,
    `repair_date` = '{$today}' ,
    `repair_status` = '{$repair_status}' ,
    `repair_uid` = '{$uid}' ,
    `unit_sn` = '{$unit_sn}'
	where `repair_sn` = '$repair_sn'";
    // die($sql);
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $TadUpFiles->set_col('repair_sn', $repair_sn);
    $TadUpFiles->upload_file('repair_img', 1280, 550, null, $repair_title, true);

    $unit = unit_admin_arr();
    $msg = '';

    $repair_name = \XoopsUser::getUnameFromId($uid, 1);
    if (empty($repair_name)) {
        $repair_name = \XoopsUser::getUnameFromId($uid, 0);
    }

    $title = sprintf(_MD_TADREPAIR_MAIL_UPDATE_TITLE, $today, $repair_title);
    $content = sprintf(_MD_TADREPAIR_MAIL_UPDATE_CONTENT, $repair_name, $today, $repair_title, "<a href='" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}'>" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}</a>");
    foreach ($unit[$unit_sn] as $uid) {
        $msg .= SendEmail($uid, $title, $content) . '<br>';
    }
    redirect_header("index.php?repair_sn=$repair_sn", 3, $msg);

    return $repair_sn;
}

//tad_repair編輯表單
function tad_fixed_form($repair_sn = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl, $TadUpFiles;
    //include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
    //include_once(XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php");
    if (empty($xoopsUser)) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NEED_LOGIN);
    }
    $user_uid = ($xoopsUser) ? $xoopsUser->uid() : '';

    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    //抓取預設值
    if (!empty($repair_sn)) {
        $DBV = get_tad_repair($repair_sn);
        $unit_sn = $DBV['unit_sn'];
        if (!empty($DBV['fixed_uid']) and !in_array($user_uid, $unit_admin_arr[$unit_sn])) {
            redirect_header('index.php', 3, _MD_TADREPAIR_NO_PERMISSION);
        }
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「repair_sn」欄位預設值
    $repair_sn = (!isset($DBV['repair_sn'])) ? $repair_sn : $DBV['repair_sn'];

    //設定「repair_title」欄位預設值
    $repair_title = (!isset($DBV['repair_title'])) ? null : $DBV['repair_title'];

    //設定「repair_content」欄位預設值
    $repair_content = (!isset($DBV['repair_content'])) ? '' : $DBV['repair_content'];

    //設定「repair_date」欄位預設值
    $repair_date = (!isset($DBV['repair_date'])) ? date('Y-m-d H:i:s') : $DBV['repair_date'];

    //設定「repair_status」欄位預設值
    $repair_status = (!isset($DBV['repair_status'])) ? '' : $DBV['repair_status'];

    //設定「unit_sn」欄位預設值
    $unit_sn = (!isset($DBV['unit_sn'])) ? '' : $DBV['unit_sn'];

    //設定「fixed_uid」欄位預設值
    $user_uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : '';
    $fixed_uid = (!isset($DBV['fixed_uid'])) ? $user_uid : $DBV['fixed_uid'];

    //設定「fixed_date」欄位預設值
    $fixed_date = (!isset($DBV['fixed_date'])) ? date('Y-m-d H:i:s') : $DBV['fixed_date'];

    //設定「fixed_status」欄位預設值
    $fixed_status = (!isset($DBV['fixed_status'])) ? '' : $DBV['fixed_status'];

    //設定「fixed_content」欄位預設值
    $fixed_content = (!isset($DBV['fixed_content'])) ? '' : $DBV['fixed_content'];

    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();
    if (!in_array($user_uid, $unit_admin_arr[$unit_sn])) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NOT_ADMIN);
    }

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $repair_content = nl2br($repair_content);
    $unit = get_tad_repair_unit($unit_sn);

    $xoopsTpl->assign('PHP_SELF', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('repair_title', $repair_title);
    $xoopsTpl->assign('repair_content', $repair_content);
    $xoopsTpl->assign('repair_status', $repair_status);
    $xoopsTpl->assign('unit_title', $unit['unit_title']);
    $xoopsTpl->assign('fixed_status', mc2arr('fixed_status', $fixed_status));
    $xoopsTpl->assign('fixed_content', $fixed_content);
    $xoopsTpl->assign('repair_sn', $repair_sn);
    $xoopsTpl->assign('fixed_form_title', _MD_TAD_FIXED_FORM);
    $xoopsTpl->assign('mode', 'fixed_form');

    //上傳表單（enctype='multipart/form-data'）
    $TadUpFiles->set_col('fixed_sn', $repair_sn);
    $upform = $TadUpFiles->upform(true, 'fixed_img');
    $xoopsTpl->assign('upform', $upform);
}

//更新處理狀態
function update_tad_fixed($repair_sn = '')
{
    global $xoopsDB, $xoopsUser, $TadUpFiles;
    if (empty($xoopsUser)) {
        redirect_header('index.php', 3, _MD_TADREPAIR_NEED_LOGIN);
    }
    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';

    $myts = \MyTextSanitizer::getInstance();
    $fixed_content = $myts->addSlashes($_POST['fixed_content']);
    $fixed_status = $myts->addSlashes($_POST['fixed_status']);

    $today = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));

    $sql = 'update `' . $xoopsDB->prefix('tad_repair') . "` set
    `fixed_uid` = '{$uid}' ,
    `fixed_date` = '{$today}' ,
    `fixed_status` = '{$fixed_status}' ,
    `fixed_content` = '{$fixed_content}'
	where `repair_sn` = '$repair_sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $DBV = get_tad_repair($repair_sn);

    $unit_sn = $DBV['unit_sn'];
    $unit = get_tad_repair_unit($unit_sn);
    $msg = '';

    $fixed_name = \XoopsUser::getUnameFromId($uid, 1);
    if (empty($fixed_name)) {
        $fixed_name = \XoopsUser::getUnameFromId($uid, 0);
    }

    $TadUpFiles->set_col('fixed_sn', $repair_sn);
    $TadUpFiles->upload_file('fixed_img', 1280, 550, null, $fixed_content, true);

    $title = sprintf(_MD_TADREPAIR_MAIL_FIXED_TITLE, $today, $DBV['repair_title']);
    $content = sprintf(_MD_TADREPAIR_MAIL_FIXED_CONTENT, $fixed_name, $today, $DBV['repair_title'], "<a href='" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}'>" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}</a>");

    $msg = SendEmail($DBV['repair_uid'], $title, $content);

    redirect_header("index.php?repair_sn=$repair_sn", 3, $msg);

    return $repair_sn;
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$repair_sn = system_CleanVars($_REQUEST, 'repair_sn', 0, 'int');
$unit_sn = system_CleanVars($_REQUEST, 'unit_sn', 0, 'int');

switch ($op) {
    //新增資料
    case 'insert_tad_repair':
        $repair_sn = insert_tad_repair();
        header("location: index.php?repair_sn=$repair_sn");
        exit;

    //更新資料
    case 'update_tad_repair':
        update_tad_repair($repair_sn);
        header("location: index.php?repair_sn=$repair_sn");
        exit;

    //回覆維修單
    case 'update_tad_fixed':
        update_tad_fixed($repair_sn);
        header("location: index.php?repair_sn=$repair_sn");
        exit;

    //輸入表格
    case 'tad_repair_form':
        tad_repair_form($repair_sn);
        break;
    //輸入表格
    case 'tad_fixed_form':
        tad_fixed_form($repair_sn);
        break;
    //預設動作
    default:
        tad_repair_form();
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('jquery', Utility::get_jquery(true));
$xoopsTpl->assign('isAdmin', $isAdmin);

require_once XOOPS_ROOT_PATH . '/footer.php';

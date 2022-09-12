<?php
use Xmf\Request;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_repair_adm_unit.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------function區--------------*/
//tad_repair_unit編輯表單
function tad_repair_unit_form($unit_sn = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl;

    //抓取預設值
    if (!empty($unit_sn)) {
        $DBV = get_tad_repair_unit($unit_sn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「unit_sn」欄位預設值
    $unit_sn = (!isset($DBV['unit_sn'])) ? $unit_sn : $DBV['unit_sn'];

    //設定「unit_title」欄位預設值
    $unit_title = (!isset($DBV['unit_title'])) ? null : $DBV['unit_title'];

    //設定「unit_admin」欄位預設值
    $unit_admin = (!isset($DBV['unit_admin'])) ? ['1'] : explode(',', $DBV['unit_admin']);

    $op = (empty($unit_sn)) ? 'insert_tad_repair_unit' : 'update_tad_repair_unit';
    //$op="replace_tad_repair_unit";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $option = $option2 = '';
    $sql = 'SELECT `uid`, `uname`, `name`, `email` FROM ' . $xoopsDB->prefix('users') . ' ORDER BY name';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($uid, $uname, $name, $email) = $xoopsDB->fetchRow($result)) {
        $name = empty($name) ? $uname : $name;
        if (in_array($uid, $unit_admin)) {
            $option2 .= "<option value='{$uid}'>[{$uid}] {$name} ({$uname} : {$email})</option>";
        } else {
            $option .= "<option value='{$uid}'>[{$uid}] {$name} ({$uname} : {$email})</option>";
        }
    }

    $xoopsTpl->assign('unit_sn', $unit_sn);
    $xoopsTpl->assign('unit_title', $unit_title);
    $xoopsTpl->assign('option', $option);
    $xoopsTpl->assign('option2', $option2);
    $xoopsTpl->assign('unit_admin', implode(',', $unit_admin));
    $xoopsTpl->assign('next_op', $op);
    $xoopsTpl->assign('op', 'tad_repair_unit_form');
}

//新增資料到tad_repair_unit中
function insert_tad_repair_unit()
{
    global $xoopsDB, $xoopsUser;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['unit_title'] = $myts->addSlashes($_POST['unit_title']);

    if (empty($_POST['unit_admin']) or ',' === $_POST['unit_admin']) {
        $unit_admin = '1';
    } else {
        $unit_admin = mb_substr($_POST['unit_admin'], 1);
    }

    $sql = 'insert into `' . $xoopsDB->prefix('tad_repair_unit') . "`
	(`unit_title` , `unit_admin`)
	values('{$_POST['unit_title']}' , '{$unit_admin}')";
    $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $unit_sn = $xoopsDB->getInsertId();

    return $unit_sn;
}

//更新tad_repair_unit某一筆資料
function update_tad_repair_unit($unit_sn = '')
{
    global $xoopsDB, $xoopsUser;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['unit_title'] = $myts->addSlashes($_POST['unit_title']);

    if (empty($_POST['unit_admin']) or ',' === $_POST['unit_admin']) {
        $unit_admin = '1';
    } else {
        $unit_admin = mb_substr($_POST['unit_admin'], 1);
    }

    $sql = 'update `' . $xoopsDB->prefix('tad_repair_unit') . "` set
	 `unit_title` = '{$_POST['unit_title']}' ,
	 `unit_admin` = '{$unit_admin}'
	where `unit_sn` = '$unit_sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    return $unit_sn;
}

//列出所有tad_repair_unit資料
function list_tad_repair_unit()
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_repair_unit') . '` ';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_content = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $unit_sn , $unit_title , $unit_admin
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $unit_admin_arr = explode(',', $unit_admin);
        $unit_admin_list = '';
        $unit_admin_name = [];
        foreach ($unit_admin_arr as $uid) {
            //以uid取得使用者名稱
            $uid_name = \XoopsUser::getUnameFromId($uid, 1);
            if (empty($uid_name)) {
                $uid_name = \XoopsUser::getUnameFromId($uid, 0);
            }

            $unit_admin_name[] = $uid_name;
        }
        $unit_admin_list = implode(_AND, $unit_admin_name);

        $all_content[$i]['unit_sn'] = $unit_sn;
        $all_content[$i]['unit_title'] = $unit_title;
        $all_content[$i]['unit_admin_list'] = $unit_admin_list;
        $i++;
    }

    $xoopsTpl->assign('all_content', $all_content);
}

//刪除tad_repair_unit某筆資料資料
function delete_tad_repair_unit($unit_sn = '')
{
    global $xoopsDB;
    $sql = 'delete from `' . $xoopsDB->prefix('tad_repair_unit') . "` where `unit_sn` = '{$unit_sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$repair_sn = Request::getInt('repair_sn');
$unit_sn = Request::getInt('unit_sn');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    //新增資料
    case 'insert_tad_repair_unit':
        $unit_sn = insert_tad_repair_unit();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //更新資料
    case 'update_tad_repair_unit':
        update_tad_repair_unit($unit_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //輸入表格
    case 'tad_repair_unit_form':
        tad_repair_unit_form($unit_sn);
        break;

    //刪除資料
    case 'delete_tad_repair_unit':
        delete_tad_repair_unit($unit_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //預設動作
    default:
        list_tad_repair_unit();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet('/modules/tadtools/css/font-awesome/css/font-awesome.css');
$xoTheme->addStylesheet(XOOPS_URL . "/modules/tadtools/css/xoops_adm{$_SEESION['bootstrap']}.css");
require_once __DIR__ . '/footer.php';

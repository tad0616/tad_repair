<?php
use Xmf\Request;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$GLOBALS['xoopsOption']['template_main'] = 'tad_repair_admin.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$repair_sn = Request::getInt('repair_sn');
$unit_sn = Request::getInt('unit_sn');

switch ($op) {

    //刪除資料
    case 'delete_tad_repair':
        delete_tad_repair($repair_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    default:
        list_adm_tad_repair();
        $op = 'list_adm_tad_repair';
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', $op);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

//列出所有tad_repair資料
function list_adm_tad_repair()
{
    global $xoopsDB, $xoopsUser, $xoopsTpl;

    $SweetAlert = new SweetAlert();
    $SweetAlert->render("delete_tad_repair_func", "main.php?op=delete_tad_repair&repair_sn=", 'repair_sn');

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_repair') . '` ORDER BY `repair_date` DESC';

    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 20, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_content = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $repair_sn , $repair_title , $repair_content , $repair_date , $repair_status , $repair_uid , $unit_sn , $fixed_uid , $fixed_date , $fixed_status , $fixed_content
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $repair_name = \XoopsUser::getUnameFromId($repair_uid, 1);
        if (empty($repair_name)) {
            $repair_name = \XoopsUser::getUnameFromId($repair_uid, 0);
        }

        $fixed_name = '';
        if (0 != $fixed_uid) {
            $fixed_name = \XoopsUser::getUnameFromId($fixed_uid, 1);
            if (empty($fixed_name)) {
                $fixed_name = \XoopsUser::getUnameFromId($fixed_uid, 0);
            }
        }

        $fixed_date = ('0000-00-00 00:00:00' === $fixed_date) ? '' : $fixed_date;

        $unit = get_tad_repair_unit($unit_sn);

        $all_content[$i]['repair_sn'] = $repair_sn;
        $all_content[$i]['repair_date'] = $repair_date;
        $all_content[$i]['prefix'] = isset($prefix) ? $prefix : '';
        $all_content[$i]['repair_title'] = $repair_title;
        $all_content[$i]['repair_name'] = $repair_name;
        $all_content[$i]['unit_title'] = $unit['unit_title'];
        $all_content[$i]['repair_status'] = $repair_status;
        $all_content[$i]['fixed_name'] = $fixed_name;
        $all_content[$i]['fixed_date'] = $fixed_date;
        $all_content[$i]['fixed_status'] = $fixed_status;
        $i++;
    }

    //if(empty($all_content))return "";

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('all_content', $all_content);
}

//刪除tad_repair某筆資料資料
function delete_tad_repair($repair_sn = '')
{
    global $xoopsDB;
    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_repair') . '` WHERE `repair_sn` =?';
    Utility::query($sql, 'i', [$repair_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

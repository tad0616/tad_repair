<?php
/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "tad_repair_index.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------function區--------------*/

//列出所有tad_repair資料
function list_tad_repair($unit_menu_id = '', $fixed_status_id = '', $show_function = 0)
{
    global $xoopsDB, $xoopsModule, $isAdmin, $xoopsUser, $xoopsTpl, $xoopsModuleConfig;

    if (file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php")) {
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php";

        $FooTable   = new FooTable();
        $FooTableJS = $FooTable->render();
    }

    //
    $fixed_status_list = preg_split('/;/', $xoopsModuleConfig['fixed_status']);
    array_unshift($fixed_status_list, _MD_TADREPAIR_REPAIR_FIXED_FILTER);
    //$fixed_status_list[0]='全部狀態' ;

    $unit_menu    = get_tad_repair_unit_list();
    $unit_menu[0] = _MD_TADREPAIR_REPAIR_UNIT_FILTER;
    //array_unshift($unit_menu, _MD_TADREPAIR_REPAIR_UNIT_FILTER) ;

    //顯示條件
    if ($fixed_status_id > 0) {
        $show_fixed_status = $fixed_status_list[$fixed_status_id];
    }

    if ($show_fixed_status) {
        $where_fixed = "  and  fixed_status = '$show_fixed_status'  ";
    }

    if ($unit_menu_id > 0) {
        $where_unit = "  and  unit_sn = $unit_menu_id   ";
    }

    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : "";
    $sql = "select * from `" . $xoopsDB->prefix("tad_repair") . "`   where 1   $where_fixed    $where_unit    order by `repair_date` desc";
// echo $sql ;
    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 20, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_content = "";
    $i           = 0;

    $repair_color = get_color('repair_status');
    $status_color = get_color('fixed_status');

    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $repair_sn , $repair_title , $repair_content , $repair_date , $repair_status , $repair_uid , $unit_sn , $fixed_uid , $fixed_date , $fixed_status , $fixed_content
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $repair_name = XoopsUser::getUnameFromId($repair_uid, 1);
        if (empty($repair_name)) {
            $repair_name = XoopsUser::getUnameFromId($repair_uid, 0);
        }

        $fixed_name = "";
        if ($fixed_uid != 0) {
            $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 1);
            if (empty($fixed_name)) {
                $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 0);
            }

        }

        $repair_date = substr($repair_date, 0, 10);
        $fixed_date  = ($fixed_date == "0000-00-00 00:00:00") ? "" : substr($fixed_date, 0, 10);

        $fixed_status = in_array($uid, $unit_admin_arr[$unit_sn]) ? "<a href='repair.php?op=tad_fixed_form&repair_sn=$repair_sn' style='color: {$status_color[$fixed_status]};'>$fixed_status</a>" : "<span style='color: {$status_color[$fixed_status]};'>$fixed_status</span>";

        $unit = get_tad_repair_unit($unit_sn);

        $all_content[$i]['repair_sn']     = $repair_sn;
        $all_content[$i]['repair_date']   = $repair_date;
        $all_content[$i]['repair_title']  = "<a href='{$_SERVER['PHP_SELF']}?repair_sn={$repair_sn}'>{$repair_title}</a>";
        $all_content[$i]['repair_name']   = $repair_name;
        $all_content[$i]['unit_title']    = $unit['unit_title'];
        $all_content[$i]['repair_status'] = "<span style='color:{$repair_color[$repair_status]}'>$repair_status</span>";
        $all_content[$i]['fixed_name']    = $fixed_name;
        $all_content[$i]['fixed_date']    = $fixed_date;
        $all_content[$i]['fixed_status']  = $fixed_status;
        $i++;
    }

    //if(empty($all_content))return "";

    $add_button = ($show_function) ? "<a href='{$_SERVER['PHP_SELF']}?op=tad_repair_form' class='link_button_r'>" . _TAD_ADD . "</a>" : "";

    //raised,corners,inset
    //$main=div_3d("",$main,"corners","width:98%");

    $sql    = "select repair_date from `" . $xoopsDB->prefix("tad_repair") . "` order by `repair_date` desc";
    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_repair_ym = "";

    while (list($repair_date) = $xoopsDB->fetchRow($result)) {
        $ym             = substr($repair_date, 0, 7);
        $repair_ym[$ym] = $ym;
    }

    $i = 0;
    foreach ($repair_ym as $ym) {
        $all_repair_ym[$i]['ym'] = $ym;
        $i++;
    }

    $xoopsTpl->assign("repair_ym", $all_repair_ym);
    $xoopsTpl->assign("content", $all_content);
    $xoopsTpl->assign("add_button", $add_button);
    $xoopsTpl->assign("bar", $bar);
    $xoopsTpl->assign("mode", 'list');
    $xoopsTpl->assign("FooTableJS", $FooTableJS);

    $xoopsTpl->assign("fixed_status_list", $fixed_status_list);
    $xoopsTpl->assign("unit_menu", $unit_menu);
    $xoopsTpl->assign("fixed_status_id", $fixed_status_id);
    $xoopsTpl->assign("unit_menu_id", $unit_menu_id);
    $xoopsTpl->assign("repair_ym", $all_repair_ym);
    $xoopsTpl->assign("now_op", 'list_tad_repair');
    $xoopsTpl->assign("show_cols", $xoopsModuleConfig['show_cols']);

    //return $main;
}

//取得顏色陣列
function get_color($name = '')
{
    global $xoopsConfig;
    include_once "language/{$xoopsConfig['language']}/modinfo.php";
    $default = ($name == 'fixed_status') ? constant('_MI_TADREPAIR_FIXED_STATUS_VAL') : constant('_MI_TADREPAIR_REPAIR_STATUS_VAL');

    $def_arr = mk_arr(explode(";", $default));
    // die(var_export($def_arr));
    foreach ($def_arr as $color => $item) {
        $def_color_arr[$item] = $color;
    }
    // die(var_export($def_color_arr));
    $arr = mc2arr($name, "", false, 'return');
    // die(var_export($arr));
    foreach ($arr as $color => $item) {
        $color_arr[$item] = (is_numeric($color) or $color == $item) ? $def_color_arr[$item] : $color;
    }
    return $color_arr;
}

//以流水號秀出某筆tad_repair資料內容
function show_one_tad_repair($repair_sn = "")
{
    global $xoopsDB, $xoopsModule, $xoopsUser, $xoopsTpl;

    if (empty($repair_sn)) {
        return;
    } else {
        $repair_sn = intval($repair_sn);
    }

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : "";

    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    $sql    = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where `repair_sn` = '{$repair_sn}' ";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $all    = $xoopsDB->fetchArray($result);

    //以下會產生這些變數： $repair_sn , $repair_title , $repair_content , $repair_date , $repair_status , $repair_uid , $unit_sn , $fixed_uid , $fixed_date , $fixed_status , $fixed_content
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    $modify_link = ($uid == $repair_uid and $fixed_status != _MD_TADREPAIR_REPAIRED) ? "<a href='repair.php?op=tad_repair_form&repair_sn=$repair_sn' class='btn btn-warning pull-right'>" . _TAD_EDIT . "</a>" : "";

    $fixed_link = in_array($uid, $unit_admin_arr[$unit_sn]) ? "<a href='repair.php?op=tad_fixed_form&repair_sn=$repair_sn' class='btn btn-info pull-right'>" . _MD_TAD_FIXED_FORM . "</a>" : "";

    $repair_name = XoopsUser::getUnameFromId($repair_uid, 1);
    if (empty($repair_name)) {
        $$repair_name = XoopsUser::getUnameFromId($repair_uid, 0);
    }

    $repair_content = nl2br($repair_content);

    $xoopsTpl->assign("repair_title", $repair_title);
    $xoopsTpl->assign("repair_date", $repair_date);
    $xoopsTpl->assign("repair_status", $repair_status);
    $xoopsTpl->assign("repair_name", $repair_name);
    $xoopsTpl->assign("repair_content", $repair_content);
    $xoopsTpl->assign("repair_sn", $repair_sn);
    $xoopsTpl->assign("modify_link", $modify_link);
    $xoopsTpl->assign("fixed_link", $fixed_link);

    $fixed_name = "";
    if ($fixed_uid != 0) {
        $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 1);
        if (empty($fixed_name)) {
            $fixed_name = XoopsUser::getUnameFromId($fixed_uid, 0);
        }

    }

    $fixed_date = ($fixed_date == "0000-00-00 00:00:00") ? "" : $fixed_date;
    $unit       = get_tad_repair_unit($unit_sn);

    $fixed_content = nl2br($fixed_content);

    //raised,corners,inset
    //$main.=div_3d(_MD_TADREPAIR_FIXED_STATUS.$fixed_link,$data,"corners","width:100%;");

    $xoopsTpl->assign("unit_title", $unit['unit_title']);
    $xoopsTpl->assign("fixed_status", $fixed_status);
    $xoopsTpl->assign("fixed_content", $fixed_content);
    $xoopsTpl->assign("fixed_date", $fixed_date);
    $xoopsTpl->assign("fixed_name", $fixed_name);
    $xoopsTpl->assign("now_op", 'show_one');
    //return $main;

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
    $TadUpFiles = new TadUpFiles("tad_repair");
    $TadUpFiles->set_col('repair_sn', $repair_sn);
    $show_files = $TadUpFiles->show_files();
    $xoopsTpl->assign("show_files", $show_files);
    //上傳表單name, 是否縮圖, 顯示模式 (filename、small), 顯示描述, 顯示下載次數, 數量限制, 自訂路徑, 加密, 自動播放時間(0 or 3000)
    //show_files($upname="",$thumb=true,$show_mode="",$show_description=false,$show_dl=false,$limit=NULL,$path=NULL,$hash=false,$playSpeed=5000)
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op              = system_CleanVars($_REQUEST, 'op', '', 'string');
$repair_sn       = system_CleanVars($_REQUEST, 'repair_sn', 0, 'int');
$unit_sn         = system_CleanVars($_REQUEST, 'unit_sn', 0, 'int');
$unit_menu_id    = system_CleanVars($_REQUEST, 'unit_menu_id', 0, 'int');
$fixed_status_id = system_CleanVars($_REQUEST, 'fixed_status_id', 0, 'int');

switch ($op) {

    //預設動作
    default:
        if (empty($repair_sn)) {
            list_tad_repair($unit_menu_id, $fixed_status_id);
        } else {
            show_one_tad_repair($repair_sn);
        }
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("bootstrap", get_bootstrap());
$xoopsTpl->assign("jquery", get_jquery(true));
$xoopsTpl->assign("isAdmin", $isAdmin);

include_once XOOPS_ROOT_PATH . '/include/comment_view.php';
include_once XOOPS_ROOT_PATH . '/footer.php';

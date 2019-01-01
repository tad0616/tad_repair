<?php
/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "tad_repair_index.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------function區--------------*/

//列出所有tad_repair資料
function list_tad_repair($def_unit_menu_sn = '', $def_fixed_status = '', $show_function = 0, $mode = '')
{
    global $xoopsDB, $xoopsModule, $isAdmin, $xoopsUser, $xoopsTpl, $xoopsModuleConfig;

    if (file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php")) {
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php";

        $FooTable   = new FooTable();
        $FooTableJS = $FooTable->render();
    }

    $myts = MyTextSanitizer::getInstance();

    $fixed_status_list = mc2arr("fixed_status", $def_fixed_status, true, 'return');
    array_unshift($fixed_status_list, _MD_TADREPAIR_REPAIR_FIXED_FILTER);

    $unit_menu    = get_tad_repair_unit_list();
    $unit_menu[0] = _MD_TADREPAIR_REPAIR_UNIT_FILTER;

    //顯示條件
    $and_fixed = $and_unit = '';
    if ($def_fixed_status) {
        $and_fixed = "  and  fixed_status = '$def_fixed_status'  ";
    }

    if ($def_unit_menu_sn > 0) {
        $and_unit = "  and  unit_sn = '{$def_unit_menu_sn}'   ";
    }

    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : "";
    $sql = "select * from `" . $xoopsDB->prefix("tad_repair") . "`   where 1   $and_fixed    $and_unit    order by `repair_date` desc";

    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 20, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

    $all_content = array();
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

        // $content = $myts->displayTarea($text, $html = 0, $smiley = 1, $xcode = 1, $image = 1, $br = 1);
        // $content = $myts->displayTarea($content, 1, 0, 0, 0, 0);
        // $title   = $myts->htmlSpecialChars($title);

        $repair_sn    = (int) $repair_sn;
        $repair_title = empty($repair_title) ? '---' : $myts->htmlSpecialChars($repair_title);
        $repair_place = $myts->htmlSpecialChars($repair_place);
        $repair_name  = $myts->htmlSpecialChars($repair_name);
        // $repair_status = $myts->htmlSpecialChars($repair_status);
        $fixed_name = $myts->htmlSpecialChars($fixed_name);
        $fixed_date = $myts->htmlSpecialChars($fixed_date);
        // $fixed_status  = $myts->htmlSpecialChars($fixed_status);

        $all_content[$i]['repair_sn']     = $repair_sn;
        $all_content[$i]['repair_date']   = $myts->htmlSpecialChars($repair_date);
        $all_content[$i]['repair_title']  = "<a href='{$_SERVER['PHP_SELF']}?repair_sn={$repair_sn}'>{$repair_title}</a>";
        $all_content[$i]['repair_place']  = $repair_place;
        $all_content[$i]['repair_name']   = $repair_name;
        $all_content[$i]['unit_title']    = $unit['unit_title'];
        $all_content[$i]['repair_status'] = "<span style='color:{$repair_color[$repair_status]}'>$repair_status</span>";
        $all_content[$i]['fixed_name']    = $fixed_name;
        $all_content[$i]['fixed_date']    = $fixed_date;
        $all_content[$i]['fixed_status']  = $fixed_status;
        $i++;
    }

    if ($mode == "return") {
        return $all_content;
    }

    $add_button = ($show_function) ? "<a href='{$_SERVER['PHP_SELF']}?op=tad_repair_form' class='link_button_r'>" . _TAD_ADD . "</a>" : "";

    $sql    = "SELECT repair_date FROM `" . $xoopsDB->prefix("tad_repair") . "` ORDER BY `repair_date` DESC";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

    $all_repair_ym = array();

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
    $xoopsTpl->assign("def_fixed_status", $def_fixed_status);
    $xoopsTpl->assign("def_unit_menu_sn", $def_unit_menu_sn);
    $xoopsTpl->assign("repair_ym", $all_repair_ym);
    $xoopsTpl->assign("now_op", 'list_tad_repair');
    $xoopsTpl->assign("show_cols", $xoopsModuleConfig['show_cols']);
    $xoopsTpl->assign("unuse_cols", $xoopsModuleConfig['unuse_cols']);

    //return $main;
}

//以流水號秀出某筆tad_repair資料內容
function show_one_tad_repair($repair_sn = "")
{
    global $xoopsDB, $xoopsModule, $xoopsUser, $xoopsTpl, $xoopsModuleConfig;

    if (empty($repair_sn)) {
        return;
    } else {
        $repair_sn = intval($repair_sn);
    }
    $myts = MyTextSanitizer::getInstance();
    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : "";

    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    $sql    = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where `repair_sn` = '{$repair_sn}' ";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
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

    $repair_sn    = (int) $repair_sn;
    $unit_sn      = (int) $unit_sn;
    $repair_title = $myts->htmlSpecialChars($repair_title);
    $repair_place = $myts->htmlSpecialChars($repair_place);
    $repair_date  = $myts->htmlSpecialChars($repair_date);
    $repair_name  = $myts->htmlSpecialChars($repair_name);
    // $repair_status  = $myts->htmlSpecialChars($repair_status);
    $fixed_name = $myts->htmlSpecialChars($fixed_name);
    // $fixed_status   = $myts->htmlSpecialChars($fixed_status);
    $repair_content = $myts->displayTarea($repair_content, 0, 0, 0, 0, 1);

    $xoopsTpl->assign("repair_title", $repair_title);
    $xoopsTpl->assign("repair_place", $repair_place);
    $xoopsTpl->assign("repair_date", $repair_date);
    $xoopsTpl->assign("repair_status", $repair_status);
    $xoopsTpl->assign("repair_name", $repair_name);
    $xoopsTpl->assign("repair_content", $repair_content);
    $xoopsTpl->assign("repair_sn", $repair_sn);
    $xoopsTpl->assign("modify_link", $modify_link);
    $xoopsTpl->assign("fixed_link", $fixed_link);
    $xoopsTpl->assign("unit_sn", $unit_sn);
    $xoopsTpl->assign("fixed_uid", $fixed_uid);

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
    $xoopsTpl->assign("unuse_cols", $xoopsModuleConfig['unuse_cols']);
    $xoopsTpl->assign("unit_menu", get_tad_repair_unit_list());

    //return $main;

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
    $TadUpFiles = new TadUpFiles("tad_repair");
    $TadUpFiles->set_col('repair_sn', $repair_sn);
    $show_files = $TadUpFiles->show_files();
    $xoopsTpl->assign("show_files", $show_files);
    //上傳表單name, 是否縮圖, 顯示模式 (filename、small), 顯示描述, 顯示下載次數, 數量限制, 自訂路徑, 加密, 自動播放時間(0 or 3000)
    //show_files($upname="",$thumb=true,$show_mode="",$show_description=false,$show_dl=false,$limit=NULL,$path=NULL,$hash=false,$playSpeed=5000)

    $TadUpFiles->set_col('fixed_sn', $repair_sn);
    $show_fixed = $TadUpFiles->show_files();
    $xoopsTpl->assign("show_fixed", $show_fixed);

}

function move_to_unit($repair_sn, $unit_sn, $new_unit_sn)
{
    global $xoopsDB, $xoopsUser, $TadUpFiles;

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : "";
    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    if (in_array($uid, $unit_admin_arr[$unit_sn])) {
        $sql = "update `" . $xoopsDB->prefix("tad_repair") . "` set
	 `unit_sn` = '{$new_unit_sn}'
	where `repair_sn` = '$repair_sn'";
        $xoopsDB->queryF($sql) or web_error($sql, __FILE__, __LINE__);
    }
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op           = system_CleanVars($_REQUEST, 'op', '', 'string');
$repair_sn    = system_CleanVars($_REQUEST, 'repair_sn', 0, 'int');
$unit_sn      = system_CleanVars($_REQUEST, 'unit_sn', 0, 'int');
$unit_menu_sn = system_CleanVars($_REQUEST, 'unit_menu_sn', 0, 'int');
$fixed_status = system_CleanVars($_REQUEST, 'fixed_status', '', 'string');
$new_unit_sn  = system_CleanVars($_REQUEST, 'new_unit_sn', 0, 'int');

switch ($op) {
    //下載檔案
    case "tufdl":
        $files_sn = isset($_GET['files_sn']) ? intval($_GET['files_sn']) : "";
        $TadUpFiles->add_file_counter($files_sn, $hash = false, $force = false);
        exit;

    case "move_to_unit":
        move_to_unit($repair_sn, $unit_sn, $new_unit_sn);
        header("location: index.php?repair_sn=$repair_sn");
        exit;

    //預設動作
    default:
        if (empty($repair_sn)) {
            list_tad_repair($unit_menu_sn, $fixed_status);
        } else {
            show_one_tad_repair($repair_sn);
        }
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("jquery", get_jquery(true));
$xoopsTpl->assign("isAdmin", $isAdmin);

include_once XOOPS_ROOT_PATH . '/include/comment_view.php';
include_once XOOPS_ROOT_PATH . '/footer.php';

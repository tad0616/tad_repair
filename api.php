<?php
include_once "header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op             = system_CleanVars($_REQUEST, 'op', '', 'string');
$estate_id      = system_CleanVars($_REQUEST, 'estate_id', 0, 'int');
$estate_room_id = system_CleanVars($_REQUEST, 'estate_room_id', 0, 'int');
$repair_sn      = system_CleanVars($_REQUEST, 'repair_sn', 0, 'int');
$pid            = system_CleanVars($_REQUEST, 'pid', '', 'string');
$tel            = system_CleanVars($_REQUEST, 'tel', '', 'string');

header("Content-Type: application/json; charset=utf-8");
switch ($op) {

    case "get_user_info":
        die(json_encode(get_user_info($pid, $tel), 256));

    case "get_user_repair":
        die(json_encode(get_user_repair($pid, $tel), 256));

    case "insert_tad_repair":
        die(insert_tad_repair());

    case 'get_tad_repair':
        die(json_encode(get_all_repair($estate_id, $estate_room_id, $repair_sn), 256));

    case 'get_repair_status':
        die(json_encode(get_repair_status(), 256));
}

function get_user_info($pid = '', $tel = '')
{
    global $xoopsDB;
    $and_pid = $pid ? "and a.`estate_user_pid`='{$pid}'" : '';
    $and_tel = $tel ? "and a.`estate_user_tel`='{$tel}'" : '';

    $sql = "select a.estate_user_name, d.estate_room_title, e.estate_stitle, f.uid as repair_uid from `" . $xoopsDB->prefix("estate_user") . "` as a
    join `" . $xoopsDB->prefix("estate_rent_user") . "` as b on a.estate_user_id=b.estate_user_id
    join `" . $xoopsDB->prefix("estate_rent") . "` as c on b.estate_rent_id=c.estate_rent_id
    join `" . $xoopsDB->prefix("estate_room") . "` as d on c.estate_room_id=d.estate_room_id
    join `" . $xoopsDB->prefix("estate") . "` as e on d.estate_id=e.estate_id
    join `" . $xoopsDB->prefix("users") . "` as f on e.estate_id=f.user_intrest
    where 1 {$and_pid} {$and_tel}";
    $result = $xoopsDB->query($sql) or web_error($sql);

    $user = $xoopsDB->fetchArray($result);
    if (!$user) {
        $user = [
            "estate_user_name"  => "",
            "estate_user_email" => "",
            "estate_room_title" => "",
            "estate_stitle"     => "",
            "repair_uid"        => "",
        ];
    }
    return $user;
}

function get_user_repair($pid = '', $tel = '')
{

    global $xoopsDB;

    if (!empty($pid) or !empty($tel)) {
        $user         = get_user_info($pid, $tel);
        $repair_place = "{$user['estate_stitle']}-{$user['estate_room_title']}";
        $sql          = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where repair_place='{$repair_place}' order by `repair_date` desc";
    } else {
        $sql = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where fixed_status='已修復' or fixed_status='處理中' order by `repair_date` desc";

    }

    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_content = array();
    $i           = 0;

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

        $unit = get_tad_repair_unit($unit_sn);

        $all_content[$i]['repair_sn']      = $repair_sn;
        $all_content[$i]['repair_date']    = $repair_date;
        $all_content[$i]['repair_title']   = $repair_title;
        $all_content[$i]['repair_content'] = $repair_content;
        $all_content[$i]['repair_place']   = $repair_place;
        $all_content[$i]['repair_name']    = $repair_name;
        $all_content[$i]['unit_title']     = $unit['unit_title'];
        $all_content[$i]['repair_status']  = $repair_status;
        $all_content[$i]['fixed_name']     = $fixed_name;
        $all_content[$i]['fixed_date']     = $fixed_date;
        $all_content[$i]['fixed_status']   = $fixed_status;
        $all_content[$i]['fixed_content']  = $fixed_content;
        $i++;
    }

    // if (!$all_content) {
    //     $all_content[$i]['repair_sn']      = 0;
    //     $all_content[$i]['repair_date']    = '';
    //     $all_content[$i]['repair_title']   = '';
    //     $all_content[$i]['repair_content'] = '';
    //     $all_content[$i]['repair_place']   = '';
    //     $all_content[$i]['repair_name']    = '';
    //     $all_content[$i]['unit_title']     = '';
    //     $all_content[$i]['repair_status']  = '';
    //     $all_content[$i]['fixed_name']     = '';
    //     $all_content[$i]['fixed_date']     = '';
    //     $all_content[$i]['fixed_status']   = '';
    // }

    return $all_content;

}

function get_estate_json($def_estate_id = '', $def_estate_room_id = '')
{
    $json     = file_get_contents(XOOPS_URL . "/modules/estate/api.php?op=get_estaties");
    $estaties = json_decode($json, true);
    foreach ($estaties as $estate) {
        $estate_id    = $estate['estate_id'];
        $estate_title = $estate['estate_title'];
        if (!empty($def_estate_id) and $def_estate_id == $estate_id) {
            return $estate_title;
        } elseif (!empty($def_estate_room_id)) {
            foreach ($estate['estate_rooms'] as $room) {
                $estate_room_id    = $room['estate_room_id'];
                $estate_room_title = $room['estate_room_title'];
                if ($def_estate_room_id == $estate_room_id) {
                    return "{$estate_title}-{$estate_room_title}";
                }
            }
        }
    }
}

//列出所有tad_repair資料
function get_all_repair($estate_id = '', $estate_room_id = '', $def_repair_sn = '')
{
    global $xoopsDB, $xoopsModule, $isAdmin, $xoopsUser, $xoopsTpl, $xoopsModuleConfig;

    //顯示條件
    $and_estate_id = $and_estate_room_id = $and_repair_sn = '';
    // repair_place=第一雅築-F201
    if ($estate_id) {
        $estate        = get_estate_json($estate_id);
        $and_estate_id = "  and `repair_place` like '{$estate}%'  ";
    }
    if ($estate_room_id) {
        $room               = get_estate_json('', $estate_room_id);
        $and_estate_room_id = "  and `repair_place` = '{$room}'   ";
    }
    if ($def_repair_sn) {
        $and_repair_sn = "  and `repair_sn` = '{$def_repair_sn}'   ";
    }

    $uid = ($xoopsUser) ? $xoopsUser->getVar('uid') : "";
    //取得各單位的管理員陣列
    $unit_admin_arr = unit_admin_arr();

    $sql = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where 1 $and_estate_id $and_estate_room_id $and_repair_sn order by `repair_date` desc";

    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_content = array();
    $i           = 0;

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

        $unit = get_tad_repair_unit($unit_sn);

        $content['repair_sn']      = $repair_sn;
        $content['repair_date']    = $repair_date;
        $content['repair_title']   = $repair_title;
        $content['repair_content'] = $repair_content;
        $content['repair_place']   = $repair_place;
        $content['repair_name']    = $repair_name;
        $content['unit_title']     = $unit['unit_title'];
        $content['repair_status']  = $repair_status;
        $content['fixed_name']     = $fixed_name;
        $content['fixed_date']     = $fixed_date;
        $content['fixed_status']   = $fixed_status;
        $content['fixed_content']  = $fixed_content;
        $all_content[$i]           = $content;
        $i++;
    }

    if ($def_repair_sn) {
        return $content;
    } else {
        return $all_content;
    }
}

function get_repair_status()
{
    global $xoopsModuleConfig;
    $arr = explode(";", $xoopsModuleConfig['repair_status']);
    // return $arr;
    if (strpos($arr[0], "=") !== false) {
        $new_arr = array();
        foreach ($arr as $fixed_status) {
            $status    = explode('=', $fixed_status);
            $new_arr[] = $status[1];
        }
        return $new_arr;
    } else {
        return $arr;
    }
}

function insert_tad_repair()
{
    global $xoopsDB, $xoopsUser, $xoopsModuleConfig, $TadUpFiles;

    $myts           = MyTextSanitizer::getInstance();
    $repair_title   = $myts->addSlashes($_POST['repair_title']);
    $repair_place   = $myts->addSlashes($_POST['repair_place']);
    $repair_content = $myts->addSlashes($_POST['repair_content']);
    $repair_status  = $myts->addSlashes($_POST['repair_status']);
    $repair_uid     = (int) $_POST['repair_uid'];

    $arr = explode(";", $xoopsModuleConfig['fixed_status']);
    // die(var_export($arr));
    if (strpos($arr[0], "=") !== false) {
        $status       = explode('=', $arr[0]);
        $fixed_status = $status[1];
    } else {
        $fixed_status = $arr[0];
    }
    $today = date("Y-m-d H:i:s", xoops_getUserTimestamp(time()));

    $unit_sn = empty($_POST['unit_sn']) ? '1' : $_POST['unit_sn'];

    $sql = "insert into `" . $xoopsDB->prefix("tad_repair") . "`
            (`repair_title`, `repair_place`, `repair_content` , `repair_date` , `repair_status` , `repair_uid` , `unit_sn` , `fixed_date`, `fixed_status` , `fixed_content`)
            values('{$repair_title}' , '{$repair_place}' ,'{$repair_content}' , '{$today}' , '{$repair_status}' , '{$repair_uid}' , '1' ,'0000-00-00 00:00:00', '{$fixed_status}' , '')";
    // die($sql);
    $xoopsDB->query($sql) or web_error($sql);

    //取得最後新增資料的流水編號
    $repair_sn = $xoopsDB->getInsertId();

    $unit = unit_admin_arr();
    $msg  = "";

    $title = sprintf(_MD_TADREPAIR_MAIL_TITLE, $today, $repair_title);
    //把填報詳細內容也放入 MAIL
    $content = sprintf(_MD_TADREPAIR_MAIL_CONTENT, $repair_place, $today, $repair_title, nl2br($repair_content) .
        "<br /> <a href='" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}'>" . XOOPS_URL . "/modules/tad_repair/index.php?repair_sn={$repair_sn}</a>");
    foreach ($unit[$unit_sn] as $uid) {
        SendEmail($uid, $title, $content);
    }

    return $repair_sn;

}

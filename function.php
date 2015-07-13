<?php
//引入TadTools的函式庫
if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php")) {
    redirect_header("http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50", 3, _TAD_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php";

/********************* 自訂函數 *********************/

function SendEmail($uid = "", $title = "", $content = "")
{
    global $xoopsConfig, $xoopsDB, $xoopsModuleConfig, $xoopsModule;
    $member_handler = &xoops_gethandler('member');
    $user           = &$member_handler->getUser($uid);
    $email          = $user->email();

    $xoopsMailer                           = &getMailer();
    $xoopsMailer->multimailer->ContentType = "text/html";
    $xoopsMailer->addHeaders("MIME-Version: 1.0");

    $msg .= ($xoopsMailer->sendMail($email, $title, $content, $headers)) ? sprintf(_MD_TADREPAIR_MAIL_OK, $title, $email) : sprintf(_MD_TADREPAIR_MAIL_FAIL, $title, $email);
    return $msg;
}

//取得tad_repair_unit
function get_tad_repair_unit_list()
{

    global $xoopsDB, $xoopsModule;
    $sql    = "select `unit_sn` , `unit_title` from `" . $xoopsDB->prefix("tad_repair_unit") . "` order by `unit_sn`";
    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());

    while (list($unit_sn, $unit_title) = $xoopsDB->fetchRow($result)) {
        $list[$unit_sn] = $unit_title;
    }
    return $list;

}

//取得各單位的管理員陣列
function unit_admin_arr()
{
    global $xoopsDB;
    $sql            = "select * from `" . $xoopsDB->prefix("tad_repair_unit") . "`";
    $result         = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    $unit_admin_arr = array();
    while ($data = $xoopsDB->fetchArray($result)) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }
        $unit_admin_arr[$unit_sn] = explode(',', $unit_admin);
    }
    return $unit_admin_arr;
}

//以流水號取得某筆tad_repair資料
function get_tad_repair($repair_sn = "")
{
    global $xoopsDB;
    if (empty($repair_sn)) {
        return;
    }

    $sql    = "select * from `" . $xoopsDB->prefix("tad_repair") . "` where `repair_sn` = '{$repair_sn}'";
    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//以流水號取得某筆tad_repair_unit資料
function get_tad_repair_unit($unit_sn = "")
{
    global $xoopsDB;
    if (empty($unit_sn)) {
        return;
    }

    $sql    = "select * from `" . $xoopsDB->prefix("tad_repair_unit") . "` where `unit_sn` = '{$unit_sn}'";
    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//把模組設定項目轉為選項
function mc2arr($name = "", $def = "", $v_as_k = true, $type = 'option', $other = "", $nl = true)
{
    global $xoopsModuleConfig;
    if (is_array($xoopsModuleConfig[$name])) {
        $arr = $xoopsModuleConfig[$name];
    } else {
        $arr = explode(";", $xoopsModuleConfig[$name]);
    }

    if (is_array($arr)) {
        foreach ($arr as $item) {
            if (empty($item)) {
                continue;
            }

            if (preg_match("/=/", $item)) {
                list($k, $v) = explode("=", $item);
                if ($v == '') {
                    $v = $k;
                }

                $new_arr[$k] = $v;
            } else {
                $new_arr[$item] = $item;
            }
        }
    } else {
        $new_arr = array();
    }

    if ($type == "checkbox") {
        $opt = arr2chk($name, $new_arr, $def, $v_as_k, $other);
    } elseif ($type == "radio") {
        $opt = arr2radio($name, $new_arr, $def, $v_as_k, $other);
    } else {
        $opt = arr2opt($new_arr, $def, $v_as_k, $other, $nl);
    }
    return $opt;
}

//把陣列轉為選項
function arr2opt($arr, $def = "", $v_as_k = false, $other = "")
{
    if (is_array($def)) {
        $def_arr = $def;
    } else {
        $def_arr = array($def);
    }
    $main = "";
    foreach ($arr as $k => $v) {
        if ($v_as_k) {
            $k = $v;
        }

        $selected = (in_array($k, $def_arr)) ? "selected" : "";
        $main .= "<option value='$k' $selected $other>$v</option>";
    }
    return $main;
}

//把陣列轉為選項
function arr2chk($name, $arr, $def = "", $v_as_k = false, $other = "")
{
    if (is_array($def)) {
        $def_arr = $def;
    } else {
        $def_arr = array($def);
    }
    $i = 1;
    foreach ($arr as $k => $v) {
        if ($v_as_k) {
            $k = $v;
        }

        $checked = (in_array($k, $def_arr)) ? "checked" : "";
        $main .= "<span style='white-space:nowrap;'><input type='checkbox' name='{$name}[]' value='$k' id='{$name}_{$i}' $checked $other>
        <label for='{$name}_{$i}'>$v</label></span> ";
        $i++;
    }
    return $main;
}

//把陣列轉為單選項
function arr2radio($name, $arr, $def = "", $v_as_k = false, $other = "")
{
    $i = 1;
    foreach ($arr as $k => $v) {
        if ($v_as_k) {
            $k = $v;
        }

        $checked = ($def == $k) ? "checked" : "";
        $main .= "<span style='white-space:nowrap;'><input type='radio' name='{$name}' value='$k' id='{$name}_{$i}' $checked $other>
      <label for='{$name}_{$i}'>$v</label></span> ";
        $i++;
    }
    return $main;
}

/********************* 預設函數 *********************/

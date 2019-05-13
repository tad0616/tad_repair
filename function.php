<?php

use XoopsModules\Tadtools\Utility;

/********************* 自訂函數 *********************/
/**
 * @param string $name
 * @return mixed
 */
//取得顏色陣列
function get_color($name = '')
{
    global $xoopsConfig;
    require_once __DIR__ . "/language/{$xoopsConfig['language']}/modinfo.php";
    $default = ('fixed_status' === $name) ? constant('_MI_TADREPAIR_FIXED_STATUS_VAL') : constant('_MI_TADREPAIR_REPAIR_STATUS_VAL');

    $def_arr = mk_arr(explode(';', $default));
    // die(var_export($def_arr));
    foreach ($def_arr as $color => $item) {
        $def_color_arr[$item] = $color;
    }
    // die(var_export($def_color_arr));
    $arr = mc2arr($name, '', false, 'return');
    // die(var_export($arr));
    foreach ($arr as $color => $item) {
        $color_arr[$item] = (is_numeric($color) or $color == $item) ? $def_color_arr[$item] : $color;
    }

    return $color_arr;
}

function SendEmail($uid = '', $title = '', $content = '')
{
    global $xoopsConfig, $xoopsDB, $xoopsModuleConfig, $xoopsModule;
    if (empty($uid)) {
        return;
    }

    // $memberHandler = xoops_getHandler('member');
    // $user           = $memberHandler->getUser($uid);
    // $email          = $user->email();
    $sql = 'select email from `' . $xoopsDB->prefix('users') . "` where uid='{$uid}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($email) = $xoopsDB->fetchRow($result);

    $xoopsMailer = &getMailer();
    $xoopsMailer->multimailer->ContentType = 'text/html';
    $xoopsMailer->addHeaders('MIME-Version: 1.0');

    $msg .= ($xoopsMailer->sendMail($email, $title, $content, $headers)) ? sprintf(_MD_TADREPAIR_MAIL_OK, $title, $email) : sprintf(_MD_TADREPAIR_MAIL_FAIL, $title, $email);

    return $msg;
}

//取得tad_repair_unit
function get_tad_repair_unit_list()
{
    global $xoopsDB, $xoopsModule;
    $sql = 'SELECT `unit_sn` , `unit_title` FROM `' . $xoopsDB->prefix('tad_repair_unit') . '` ORDER BY `unit_sn`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($unit_sn, $unit_title) = $xoopsDB->fetchRow($result)) {
        $list[$unit_sn] = $unit_title;
    }

    return $list;
}

//取得各單位的管理員陣列
function unit_admin_arr()
{
    global $xoopsDB;
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_repair_unit') . '`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $unit_admin_arr = [];
    while (false !== ($data = $xoopsDB->fetchArray($result))) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }
        $unit_admin_uid = explode(',', $unit_admin);
        foreach ($unit_admin_uid as $uid) {
            $unit_admin_arr[$unit_sn][] = (int) $uid;
        }
    }

    return $unit_admin_arr;
}

//以流水號取得某筆tad_repair資料
function get_tad_repair($repair_sn = '')
{
    global $xoopsDB;
    if (empty($repair_sn)) {
        return;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_repair') . "` where `repair_sn` = '{$repair_sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//以流水號取得某筆tad_repair_unit資料
function get_tad_repair_unit($unit_sn = '')
{
    global $xoopsDB;
    if (empty($unit_sn)) {
        return;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_repair_unit') . "` where `unit_sn` = '{$unit_sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//把模組設定項目轉為選項
function mc2arr($name = '', $def = '', $v_as_k = true, $type = 'option', $other = '', $nl = true)
{
    global $xoopsModuleConfig;
    if (is_array($xoopsModuleConfig[$name])) {
        $arr = $xoopsModuleConfig[$name];
    } else {
        $arr = explode(';', $xoopsModuleConfig[$name]);
    }

    $new_arr = mk_arr($arr, $v_as_k);

    if ('checkbox' === $type) {
        $opt = arr2chk($name, $new_arr, $def, $v_as_k, $other);
    } elseif ('radio' === $type) {
        $opt = arr2radio($name, $new_arr, $def, $v_as_k, $other);
    } elseif ('return' === $type) {
        return $new_arr;
    } else {
        $opt = arr2opt($new_arr, $def, $v_as_k, $other, $nl);
    }

    return $opt;
}

function mk_arr($arr = [], $v_as_k = false)
{
    if (is_array($arr)) {
        foreach ($arr as $item) {
            if (empty($item)) {
                continue;
            }

            if (preg_match('/=/', $item)) {
                list($k, $v) = explode('=', $item);
                if ($v_as_k) {
                    $k = $v;
                } elseif ('' == $v) {
                    $v = $k;
                }

                $new_arr[$k] = $v;
            } else {
                $new_arr[$item] = $item;
            }
        }
    } else {
        $new_arr = [];
    }

    return $new_arr;
}

//把陣列轉為選項
function arr2opt($arr, $def = '', $v_as_k = false, $other = '')
{
    if (is_array($def)) {
        $def_arr = $def;
    } else {
        $def_arr = [$def];
    }
    $main = '';
    foreach ($arr as $k => $v) {
        if ($v_as_k) {
            $k = $v;
        }

        $selected = (in_array($k, $def_arr)) ? 'selected' : '';
        $main .= "<option value='$k' $selected $other>$v</option>";
    }

    return $main;
}

//把陣列轉為選項
function arr2chk($name, $arr, $def = '', $v_as_k = false, $other = '')
{
    if (is_array($def)) {
        $def_arr = $def;
    } else {
        $def_arr = [$def];
    }
    $i = 1;
    foreach ($arr as $k => $v) {
        if ($v_as_k) {
            $k = $v;
        }

        $checked = (in_array($k, $def_arr)) ? 'checked' : '';
        $main .= "<span style='white-space:nowrap;'><input type='checkbox' name='{$name}[]' value='$k' id='{$name}_{$i}' $checked $other>
        <label for='{$name}_{$i}'>$v</label></span> ";
        $i++;
    }

    return $main;
}

//把陣列轉為單選項
function arr2radio($name, $arr, $def = '', $v_as_k = false, $other = '')
{
    $i = 1;
    foreach ($arr as $k => $v) {
        if ($v_as_k) {
            $k = $v;
        }

        $checked = ($def == $k) ? 'checked' : '';
        $main .= "<span style='white-space:nowrap;'><input type='radio' name='{$name}' value='$k' id='{$name}_{$i}' $checked $other>
      <label for='{$name}_{$i}'>$v</label></span> ";
        $i++;
    }

    return $main;
}

/********************* 預設函數 *********************/

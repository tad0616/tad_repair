<?php
//維修通報搜尋程式
function tad_repair_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    //處理許功蓋
    if (get_magic_quotes_gpc()) {
        foreach ($queryarray as $k => $v) {
            $arr[$k] = addslashes($v);
        }
        $queryarray = $arr;
    }
    $sql = 'SELECT `repair_sn`,`repair_title`,`repair_date`, `repair_uid` FROM ' . $xoopsDB->prefix('tad_repair') . ' WHERE 1';
    if (0 != $userid) {
        $sql .= ' AND uid=' . $userid . ' ';
    }
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((`repair_title` LIKE '%{$queryarray[0]}%'  OR `repair_content` LIKE '%{$queryarray[0]}%' OR  `fixed_content` LIKE '%{$queryarray[0]}%')";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(`repair_title` LIKE '%{$queryarray[$i]}%' OR  `repair_content` LIKE '%{$queryarray[$i]}%'  OR  `fixed_content` LIKE '%{$queryarray[$i]}%')";
        }
        $sql .= ') ';
    }
    $sql .= 'ORDER BY  `repair_date` DESC';
    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret = [];
    $i = 0;
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $ret[$i]['image'] = 'images/report.png';
        $ret[$i]['link'] = 'index.php?repair_sn=' . $myrow['repair_sn'];
        $ret[$i]['title'] = $myrow['repair_title'];
        $ret[$i]['time'] = strtotime($myrow['repair_date']);
        $ret[$i]['uid'] = $myrow['repair_uid'];
        $i++;
    }

    return $ret;
}

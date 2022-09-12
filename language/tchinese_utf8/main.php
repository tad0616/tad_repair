<?php
use XoopsModules\Tad_repair\Utility;
xoops_loadLanguage('main', 'tadtools');

define('_MD_TADREPAIR_SMNAME2', Utility::text_replace('填寫維修單'));
define('_MD_TADREPAIR_DL_REPORT', Utility::text_replace('下載月報表'));
define('_MD_TADREPAIR_REPORT', Utility::text_replace('月報表'));
define('_MD_TADREPAIR_REPORT_TOTAL', Utility::text_replace('資料共計'));
define('_MD_TADREPAIR_REPORT_TOTAL2', Utility::text_replace('筆'));

define('_MD_TADREPAIR_REPAIR_SN', Utility::text_replace('編號'));
define('_MD_TADREPAIR_REPAIR_TITLE', Utility::text_replace('報修內容'));
define('_MD_TADREPAIR_REPAIR_CONTENT', Utility::text_replace('詳細說明'));
define('_MD_TADREPAIR_REPAIR_CONTENT_PRETEXT', Utility::text_replace('請說明需報修情形'));
define('_MD_TADREPAIR_REPAIR_UNIT_FILTER', Utility::text_replace('顯示全部單位'));
define('_MD_TADREPAIR_REPAIR_FIXED_FILTER', Utility::text_replace('顯示全部處理狀態'));
define('_MD_TADREPAIR_REPAIR_DATE', Utility::text_replace('報修日期'));
define('_MD_TADREPAIR_REPAIR_STATUS', Utility::text_replace('嚴重程度'));
define('_MD_TADREPAIR_REPAIR_STATUS2', Utility::text_replace('等級'));
define('_MD_TADREPAIR_REPAIR_UID', Utility::text_replace('報修者'));
define('_MD_TADREPAIR_UNIT_SN', Utility::text_replace('通知單位'));
define('_MD_TADREPAIR_UNIT', Utility::text_replace('通知'));
define('_MD_TADREPAIR_FIXED_UNIT_SN', Utility::text_replace('負責單位'));
define('_MD_TADREPAIR_FIXED_UID', Utility::text_replace('回覆者'));
define('_MD_TADREPAIR_FIXED_DATE', Utility::text_replace('回覆日期'));
define('_MD_TADREPAIR_FIXED_STATUS', Utility::text_replace('處理狀況'));
define('_MD_TADREPAIR_FIXED_STATUS2', Utility::text_replace('處理'));
define('_MD_TADREPAIR_FIXED_CONTENT', Utility::text_replace('回覆內容'));
define('_MD_TAD_REPAIR_FORM', Utility::text_replace('填寫維修單'));
define('_MD_TADREPAIR_FIXED_NOTICE', Utility::text_replace('維修通知單'));
define('_MD_TAD_FIXED_FORM', Utility::text_replace('回覆維修單'));
define('_MD_TADREPAIR_NOT_ADMIN', Utility::text_replace('您沒有管理權限！'));
define('_MD_TADREPAIR_REPAIRED', Utility::text_replace('已修復'));
define('_MD_TADREPAIR_CANT_MODIFY', Utility::text_replace('已修復的報修單不可修改！'));
define('_MD_TADREPAIR_NEED_LOGIN', Utility::text_replace('請先登入！始可進行維護通報！'));

define('_MD_TADREPAIR_MAIL_OK', Utility::text_replace('將「%s」寄送到 %s 完成！\\n'));
define('_MD_TADREPAIR_MAIL_FAIL', Utility::text_replace('將「%s」寄送到 %s 失敗！\\n'));
define('_MD_TADREPAIR_MAIL_TITLE', Utility::text_replace('%s 維修通報「%s」'));
define('_MD_TADREPAIR_MAIL_CONTENT', Utility::text_replace('您好：<p>%s 於 %s 填寫了維修通報，大致內容為「%s」。</p><p>詳細內容請至底下連結觀看詳細通報內容：</p><p>%s</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>'));
define('_MD_TADREPAIR_MAIL_UPDATE_TITLE', Utility::text_replace('%s 維修通報「%s」修改通知'));
define('_MD_TADREPAIR_MAIL_UPDATE_CONTENT', Utility::text_replace('您好：<p>%s 於 %s 修改了維修通報「%s」之內容。</p><p>詳細內容請至底下連結觀看詳細通報內容：</p><p>%s</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>'));
define('_MD_TADREPAIR_MAIL_FIXED_TITLE', Utility::text_replace('%s 維修通報「%s」處理進度通知'));
define('_MD_TADREPAIR_MAIL_FIXED_CONTENT', Utility::text_replace('您好：<p>%s 於 %s 針對您的維修通報「%s」進行了處理。</p><p>詳細內容請至底下連結觀看詳細通報內容：</p><p>%s</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>'));
define('_MD_TADREPAIR_NEED_UNIT', Utility::text_replace('管理員尚未設定維修管理單位，請通知管理員至後台進行「單位設定」！'));

define('_MD_TADREPAIR_EMPTY', Utility::text_replace('恭喜！目前沒有任何通報！<a href="repair.php" class="btn btn-primary btn-info">我來當第一個通報的人</a>'));

define('_MD_TADREPAIR_DONT_REPEAT', Utility::text_replace('目前已有相同資料，請勿重複報修。'));
define('_MD_TADREPAIR_IMG', Utility::text_replace('照片'));
define('_MD_TADREPAIR_PLACE', Utility::text_replace('報修地點'));
define('_MD_TADREPAIR_NO_PERMISSION', Utility::text_replace('您沒有修改的權限'));
define('_MD_TADREPAIR_CHANGE_DEPARTMENT', Utility::text_replace('改送其他單位'));

define('_MD_TADREPAIR_HOME', Utility::text_replace('維修通報一覽'));

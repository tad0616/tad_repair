<?php
use XoopsModules\Tad_repair\Tools;
xoops_loadLanguage('main', 'tadtools');

define('_MD_TADREPAIR_SMNAME2', Tools::text_replace('填寫維修單'));
define('_MD_TADREPAIR_DL_REPORT', Tools::text_replace('下載月報表'));
define('_MD_TADREPAIR_REPORT', Tools::text_replace('月報表'));
define('_MD_TADREPAIR_REPORT_TOTAL', Tools::text_replace('資料共計'));
define('_MD_TADREPAIR_REPORT_TOTAL2', Tools::text_replace('筆'));

define('_MD_TADREPAIR_REPAIR_SN', Tools::text_replace('編號'));
define('_MD_TADREPAIR_REPAIR_TITLE', Tools::text_replace('報修內容'));
define('_MD_TADREPAIR_REPAIR_CONTENT', Tools::text_replace('詳細說明'));
define('_MD_TADREPAIR_REPAIR_CONTENT_PRETEXT', Tools::text_replace('請說明需報修情形'));
define('_MD_TADREPAIR_REPAIR_UNIT_FILTER', Tools::text_replace('顯示全部單位'));
define('_MD_TADREPAIR_REPAIR_FIXED_FILTER', Tools::text_replace('顯示全部處理狀態'));
define('_MD_TADREPAIR_REPAIR_DATE', Tools::text_replace('報修日期'));
define('_MD_TADREPAIR_REPAIR_STATUS', Tools::text_replace('嚴重程度'));
define('_MD_TADREPAIR_REPAIR_STATUS2', Tools::text_replace('等級'));
define('_MD_TADREPAIR_REPAIR_UID', Tools::text_replace('報修者'));
define('_MD_TADREPAIR_UNIT_SN', Tools::text_replace('通知單位'));
define('_MD_TADREPAIR_UNIT', Tools::text_replace('通知'));
define('_MD_TADREPAIR_FIXED_UNIT_SN', Tools::text_replace('負責單位'));
define('_MD_TADREPAIR_FIXED_UID', Tools::text_replace('回覆者'));
define('_MD_TADREPAIR_FIXED_DATE', Tools::text_replace('回覆日期'));
define('_MD_TADREPAIR_FIXED_STATUS', Tools::text_replace('處理狀況'));
define('_MD_TADREPAIR_FIXED_STATUS2', Tools::text_replace('處理'));
define('_MD_TADREPAIR_FIXED_CONTENT', Tools::text_replace('回覆內容'));
define('_MD_TAD_REPAIR_FORM', Tools::text_replace('填寫維修單'));
define('_MD_TADREPAIR_FIXED_NOTICE', Tools::text_replace('維修通知單'));
define('_MD_TAD_FIXED_FORM', Tools::text_replace('回覆維修單'));
define('_MD_TADREPAIR_NOT_ADMIN', Tools::text_replace('您沒有管理權限！'));
define('_MD_TADREPAIR_REPAIRED', Tools::text_replace('已修復'));
define('_MD_TADREPAIR_CANT_MODIFY', Tools::text_replace('已修復的報修單不可修改！'));
define('_MD_TADREPAIR_NEED_LOGIN', Tools::text_replace('請先登入！始可進行維護通報！'));

define('_MD_TADREPAIR_MAIL_OK', Tools::text_replace('將「%s」寄送到 %s 完成！\\n'));
define('_MD_TADREPAIR_MAIL_FAIL', Tools::text_replace('將「%s」寄送到 %s 失敗！\\n'));
define('_MD_TADREPAIR_MAIL_TITLE', Tools::text_replace('%s 維修通報「%s」'));
define('_MD_TADREPAIR_MAIL_CONTENT', Tools::text_replace('您好：<p>%s 於 %s 填寫了維修通報，大致內容為「%s」。</p><p>詳細內容請至底下連結觀看詳細通報內容：</p><p>%s</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>'));
define('_MD_TADREPAIR_MAIL_UPDATE_TITLE', Tools::text_replace('%s 維修通報「%s」修改通知'));
define('_MD_TADREPAIR_MAIL_UPDATE_CONTENT', Tools::text_replace('您好：<p>%s 於 %s 修改了維修通報「%s」之內容。</p><p>詳細內容請至底下連結觀看詳細通報內容：</p><p>%s</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>'));
define('_MD_TADREPAIR_MAIL_FIXED_TITLE', Tools::text_replace('%s 維修通報「%s」處理進度通知'));
define('_MD_TADREPAIR_MAIL_FIXED_CONTENT', Tools::text_replace('您好：<p>%s 於 %s 針對您的維修通報「%s」進行了處理。</p><p>詳細內容請至底下連結觀看詳細通報內容：</p><p>%s</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>'));
define('_MD_TADREPAIR_NEED_UNIT', Tools::text_replace('管理員尚未設定維修管理單位，請通知管理員至後台進行「單位設定」！'));

define('_MD_TADREPAIR_EMPTY', Tools::text_replace('恭喜！目前沒有任何通報！<a href="repair.php" class="btn btn-primary btn-info">我來當第一個通報的人</a>'));

define('_MD_TADREPAIR_DONT_REPEAT', Tools::text_replace('目前已有相同資料，請勿重複報修。'));
define('_MD_TADREPAIR_IMG', Tools::text_replace('照片'));
define('_MD_TADREPAIR_PLACE', Tools::text_replace('報修地點'));
define('_MD_TADREPAIR_NO_PERMISSION', Tools::text_replace('您沒有修改的權限'));
define('_MD_TADREPAIR_CHANGE_DEPARTMENT', Tools::text_replace('改送其他單位'));

define('_MD_TADREPAIR_HOME', Tools::text_replace('維修通報一覽'));

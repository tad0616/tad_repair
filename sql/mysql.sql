CREATE TABLE `tad_repair` (
  `repair_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '修繕編號',
  `repair_title` varchar(255) NOT NULL default '' COMMENT '報修內容',
  `repair_place` varchar(255) NOT NULL default '' COMMENT '報修地點',
  `repair_content` text NOT NULL COMMENT '詳細說明',
  `repair_date` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '報修日期',
  `repair_status` varchar(255) NOT NULL default '' COMMENT '嚴重status程度',
  `repair_uid` mediumint(8) unsigned NOT NULL default '0' COMMENT '報修者',
  `unit_sn` smallint(6) unsigned NOT NULL default '0' COMMENT '通知單位',
  `fixed_uid` varchar(255) NOT NULL default '' COMMENT '回覆者',
  `fixed_date` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '回覆日期',
  `fixed_status` varchar(255) NOT NULL default '' COMMENT '處理狀況',
  `fixed_content` text NOT NULL COMMENT '回覆內容',
PRIMARY KEY (`repair_sn`),
KEY (`unit_sn`)
) ENGINE=MyISAM;

CREATE TABLE `tad_repair_unit` (
  `unit_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '單位編號',
  `unit_title` varchar(255) NOT NULL default '' COMMENT '單位名稱',
  `unit_admin` text NOT NULL COMMENT '管理人員',
PRIMARY KEY (`unit_sn`)
) ENGINE=MyISAM;

CREATE TABLE `tad_repair_files_center` (
  `files_sn` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '檔案流水號',
  `col_name` varchar(255) NOT NULL default '' COMMENT '欄位名稱',
  `col_sn` smallint(5) unsigned NOT NULL default 0 COMMENT '欄位編號',
  `sort` smallint(5) unsigned NOT NULL default 0 COMMENT '排序',
  `kind` enum('img','file') NOT NULL default 'img' COMMENT '檔案種類',
  `file_name` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `file_type` varchar(255) NOT NULL default '' COMMENT '檔案類型',
  `file_size` int(10) unsigned NOT NULL default 0 COMMENT '檔案大小',
  `description` text NOT NULL COMMENT '檔案說明',
  `counter` mediumint(8) unsigned NOT NULL default 0 COMMENT '下載人次',
  `original_filename` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `hash_filename` varchar(255) NOT NULL default '' COMMENT '加密檔案名稱',
  `sub_dir` varchar(255) NOT NULL default '' COMMENT '檔案子路徑',
PRIMARY KEY (`files_sn`)
) ENGINE=MyISAM;

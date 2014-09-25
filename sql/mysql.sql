CREATE TABLE `tad_repair` (
  `repair_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '修繕編號',
  `repair_title` varchar(255) NOT NULL default '' COMMENT '報修內容',
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


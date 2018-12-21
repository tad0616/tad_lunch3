CREATE TABLE `tad_lunch3_data_center` (
  `mid` mediumint(9) unsigned NOT NULL AUTO_INCREMENT COMMENT '模組編號',
  `col_name` varchar(100) NOT NULL default '' COMMENT '欄位名稱',
  `col_sn` int(11) unsigned NOT NULL default 0 COMMENT '欄位編號',
  `data_name` varchar(100) NOT NULL default '' COMMENT '資料名稱',
  `data_value` text NOT NULL COMMENT '儲存值',
  `data_sort` mediumint(9) unsigned NOT NULL default 0 COMMENT '排序',
  PRIMARY KEY (`mid`,`col_name`,`col_sn`,`data_name`,`data_sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


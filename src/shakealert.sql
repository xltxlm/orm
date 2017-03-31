DROP TABLE IF  EXISTS shakealert;
-- 监控表的数据抖动
CREATE TABLE IF NOT EXISTS `shakealert` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
   dtvalue DATE   NOT NULL COMMENT '日期',
  `dtfieldname` varchar(100) NOT NULL COMMENT '日期字段',
  `tablename` varchar(100) NOT NULL COMMENT '表格名称',
   `condition`  varchar(100) NOT NULL COMMENT '附加条件',
  `fieldname` varchar(100) NOT NULL COMMENT '字段名称',
  `fieldname1day` varchar(100) NOT NULL COMMENT '1天前数据',
  `fieldname1dayratio` varchar(100) NOT NULL COMMENT '1天前百分比',
  `fieldname1week` varchar(100) NOT NULL COMMENT '1周前数据',
  `fieldname1weekratio` varchar(100) NOT NULL COMMENT '1周前百分比',
  `fieldnamenew` varchar(100) NOT NULL COMMENT '新数据',
  add_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`dtvalue`,`tablename`,`fieldname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='数据抖动统计';

-- 储存每日服务的数据量

DROP TABLE IF  EXISTS service_data;
CREATE TABLE IF NOT EXISTS `service_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `dt` DATE   NOT NULL COMMENT '日期',
  `servicename` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '服务名称',
  `process` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '进程名字',
  `num` INT(11) unsigned NOT NULL DEFAULT 0 COMMENT '数值',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`dt`,`servicename`,`process`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='服务每日数据';
)
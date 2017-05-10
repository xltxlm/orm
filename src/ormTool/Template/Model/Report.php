<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
Create Table IF NOT EXISTS  <?=$this->getTableObject()->getName()?>report(
    `id` INT(11) unsigned NOT NULl AUTO_INCREMENT COMMENT '自增id',
    reportdate date  COMMENT '日期',
    rowcount INT(11) unsigned NOT NULl DEFAULT 0  COMMENT '数据行数',
    addrow INT(11) unsigned NOT NULl DEFAULT 0  COMMENT '被添加行数',
    updaterow INT(11) unsigned NOT NULl DEFAULT 0  COMMENT '被更新行数',
    UNIQUE KEY (`reportdate`)
)COMMENT="<?=$this->getTableObject()->getName()?>日常报表";


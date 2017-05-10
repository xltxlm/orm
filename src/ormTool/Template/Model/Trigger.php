<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php
if (count($this->getTableObject()->getPrimaryKey())>1)
{
    $OLD_PRIMARY=[];
    $NEW_PRIMARY=[];
    foreach ($this->getTableObject()->getPrimaryKey() as $item) {
        $OLD_PRIMARY[]="'\"$item\":\"',ifnull(OLD.`$item`,'null'),'\"'";
        $NEW_PRIMARY[]="'\"$item\":\"',ifnull(NEW.`$item`,'null'),'\"'";
    }
    $OLD_PRIMARY_STRING="concat('{',".join(",',',",$OLD_PRIMARY).",'}')";
    $NEW_PRIMARY_STRING="concat('{',".join(",',',",$NEW_PRIMARY).",'}')";
}else
{
    $item=current($this->getTableObject()->getPrimaryKey());
    $OLD_PRIMARY_STRING = "OLD.`$item`";
    $NEW_PRIMARY_STRING = "NEW.`$item`";
}
?>
CREATE  TABLE IF NOT EXISTS  <?=$this->getTableObject()->getName()?>log(
`id` INT(11) unsigned NOT NULl AUTO_INCREMENT COMMENT '自增id',
`pid` varchar(120) COMMENT '业务的id',
`field` text   COMMENT '被改变的字段',
`action` ENUM('创建','修改','删除') NOT NULL  DEFAULT '创建' COMMENT '数据操作',
`correct` ENUM('未处理','已处理') NOT NULL  DEFAULT '未处理' COMMENT '意义解析',
`business`  VARCHAR (100)   DEFAULT '' COMMENT '业务操作',
`sessionuser` VARCHAR (100)   DEFAULT '' COMMENT '会话信息',
`updatefield` VARCHAR (2000)   DEFAULT '' COMMENT '被影响到的字段',
`sql` VARCHAR (2000)   DEFAULT '' COMMENT 'SQL语句',
`username` VARCHAR (100)   DEFAULT '' COMMENT '账户',
`ip` VARCHAR (60)   DEFAULT '' COMMENT 'ip',
`userflag`  text   COMMENT '账户属性',
`add_time` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP   COMMENT '触发器时间',
PRIMARY KEY (`id`),
INDEX (`pid`),
INDEX (`username`),
INDEX (`ip`)
) COMMENT='数据源修改过程表';



DROP TRIGGER IF EXISTS <?=$this->getTableObject()->getName()?>insert;
delimiter //
CREATE TRIGGER <?=$this->getTableObject()->getName()?>insert
AFTER INSERT ON <?=$this->getTableObject()->getName()?> FOR EACH ROW
BEGIN
INSERT INTO  <?=$this->getTableObject()->getName()?>log (pid,correct,username,ip,userflag,sessionuser)
VALUES
(<?=$NEW_PRIMARY_STRING?>,'已处理',@username,@ip,@userflag,SESSION_USER());
END;//
delimiter ;

DROP TRIGGER IF EXISTS <?=$this->getTableObject()->getName()?>delete;
delimiter //
CREATE TRIGGER <?=$this->getTableObject()->getName()?>delete
AFTER DELETE ON <?=$this->getTableObject()->getName()?> FOR EACH ROW
BEGIN
INSERT INTO  <?=$this->getTableObject()->getName()?>log (pid,action,correct,username,ip,userflag,sessionuser)
VALUES
(<?=$OLD_PRIMARY_STRING?>,'删除','已处理',@username,@ip,@userflag,SESSION_USER());
END;//
delimiter ;

DROP TRIGGER IF EXISTS <?=$this->getTableObject()->getName()?>update;
DELIMITER //
CREATE TRIGGER <?=$this->getTableObject()->getName()?>update
AFTER UPDATE ON <?=$this->getTableObject()->getName()?> FOR EACH ROW
BEGIN
SET @field = '';
SET @updatefield = '';
<?php foreach ($this->getTableObject()->getFieldSchemas() as $fieldSchema){ ?>
    IF old.`<?=$fieldSchema->getCOLUMNNAME()?>` <> new.`<?=$fieldSchema->getCOLUMNNAME()?>` || new.`<?=$fieldSchema->getCOLUMNNAME()?>` IS NULL AND old.`<?=$fieldSchema->getCOLUMNNAME()?>` IS NOT NULL ||
    old.`<?=$fieldSchema->getCOLUMNNAME()?>` IS NULL AND new.`<?=$fieldSchema->getCOLUMNNAME()?>` IS NOT NULL
    THEN
    IF @field = '' THEN
    SET @field = CONCAT(@field,'{');
    SET @updatefield = CONCAT(@updatefield,'[');
    ELSE
    SET @field = CONCAT(@field,',');
    SET @updatefield = CONCAT(@updatefield,',');
    END IF;
    SET @field = CONCAT(@field,'"<?=$fieldSchema->getCOLUMNNAME()?>":["', ifnull(old.`<?=$fieldSchema->getCOLUMNNAME()?>`, 'null'), '",', '"',
    ifnull(new.`<?=$fieldSchema->getCOLUMNNAME()?>`, 'null'), '"]');
    SET @updatefield = CONCAT(@updatefield,'"<?=$fieldSchema->getCOLUMNNAME()?>"');
    END IF;

<?php }?>

IF @field <> ''
THEN
SET @field = CONCAT(@field,'}');
SET @updatefield = CONCAT(@updatefield,']');
INSERT INTO <?=$this->getTableObject()->getName()?>log (pid, field, action, username, ip, userflag,sessionuser,updatefield)
VALUES
(<?=$NEW_PRIMARY_STRING?>, @field, '修改', @username, @ip, @userflag,SESSION_USER(),@updatefield);
END IF;
SET @field = '';

END;
//
DELIMITER ;
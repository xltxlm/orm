<?php /** @var \OrmTool\TriggerMaker $this */?>
<?php /** @var \OrmTool\Unit\Table $tableObject */?>
USE <?=$tableObject->getDbConfig()->getDb()?>;
DROP TRIGGER  IF EXISTS `<?=$tableObject->getName()?>_delete`;
CREATE TRIGGER `<?=$tableObject->getName()?>_delete`
AFTER DELETE ON <?=$tableObject->getDbConfig()->getDb()?>.<?=$tableObject->getName()?>

FOR EACH ROW
    INSERT INTO <?=$this->getLogDB()->getDb()?>.<?=$tableObject->getName()?> (`logactiontype`, <?=implode(',', $tableObject->getFields())?>)
    VALUES ('delete',<?=implode(',', $this->getOldTriggerTableFields())?>)
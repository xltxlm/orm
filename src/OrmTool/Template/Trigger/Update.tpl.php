<?php /** @var \OrmTool\TriggerMaker $this */?>
<?php /** @var \OrmTool\Unit\Table $tableObject */?>
USE <?=$tableObject->getDbConfig()->getDb()?>;
DROP TRIGGER  IF EXISTS `<?=$tableObject->getName()?>_update`;
CREATE TRIGGER `<?=$tableObject->getName()?>_update`
AFTER UPDATE ON <?=$tableObject->getDbConfig()->getDb()?>.<?=$tableObject->getName()?>

FOR EACH ROW
BEGIN
    INSERT INTO <?=$this->getLogDB()->getDb()?>.<?=$tableObject->getName()?> (`logactiontype`,`logupdatetype`, <?=implode(',', $tableObject->getFields())?>)
    VALUES ('update', 'old',<?=implode(',', $this->getOldTriggerTableFields())?>);
    INSERT INTO <?=$this->getLogDB()->getDb()?>.<?=$tableObject->getName()?> (`logactiontype`,`logupdatetype`, <?=implode(',', $tableObject->getFields())?>)
    VALUES ('update', 'new',<?=implode(',', $this->getNewTriggerTableFields())?>);
END;
<?php /** @var \xltxlm\ormTool\TriggerMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\Table $tableObject */?>
USE <?=$tableObject->getDbConfig()->getDb()?>;
DROP TRIGGER  IF EXISTS `<?=$tableObject->getName()?>_insert`;
CREATE TRIGGER `<?=$tableObject->getName()?>_insert`
AFTER INSERT ON <?=$tableObject->getDbConfig()->getDb()?>.<?=$tableObject->getName()?>

FOR EACH ROW
    INSERT INTO <?=$this->getLogDB()->getDb()?>.<?=$tableObject->getName()?> (`logactiontype`,`logtime`, <?=implode(',', $tableObject->getFields())?>)
    VALUES ('insert',now(), <?=implode(',', $this->getNewTriggerTableFields())?>)

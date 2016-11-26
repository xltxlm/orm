<?php /** @var \OrmTool\Make $this */?>
<?php /** @var \OrmTool\Unit\TableSchema $table */?>
<?php /** @var \OrmTool\Unit\FieldSchema $field */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 7:26
 */

namespace <?=$this->getDbNameSpace()?>\<?=$this->getDbConfig()->getDb()?>;

class Enum<?=ucfirst($table->getTABLENAME())?><?=ucfirst($field->getCOLUMNNAME())?>

{
<?php foreach ($field->getENUMARRAY() as $key=>$value) {
    ?>
    const <?=$key?>='<?=$value?>';
<?php 
}?>
}

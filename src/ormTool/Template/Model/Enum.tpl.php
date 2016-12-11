<?php /** @var \xltxlm\ormTool\Maker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema $field */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 7:26
 */

namespace <?=$this->getDbNameSpace()?>\enum;

class Enum<?=ucfirst($tableSchema->getTABLENAME())?><?=ucfirst($field->getCOLUMNNAME())?>

{
<?php foreach ($field->getENUMARRAY() as $key=>$value) {
    ?>
    const <?=$key?>='<?=$value?>';
<?php
}?>
}

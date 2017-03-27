<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use xltxlm\helper\Hclass\ObjectToArray;
use xltxlm\helper\Hclass\ObjectToJson;
use xltxlm\helper\Hclass\ObjectIteratorAggregate;

/**
* Class select
*/
class <?=ucfirst($tableSchema->getTABLENAME())?>Model extends ObjectIteratorAggregate
{
    use ObjectToArray;
    use ObjectToJson;
    use <?=ucfirst($tableSchema->getTABLENAME())?>Base;
    use <?=ucfirst($tableSchema->getTABLENAME())?>Getset;

    /**
    * @return array
    */
    final public function __invoke()
    {
        $fieldSchema=[];
<?php foreach ($fieldSchema as $field) {
    ?>
        $fieldSchema['<?=$field->getCOLUMNNAME()?>']='<?=$field->getCOLUMNCOMMENT()?:$field->getCOLUMNNAME()?>';
<?php
}?>
        return $fieldSchema;
    }
}

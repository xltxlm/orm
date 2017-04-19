<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use xltxlm\helper\Hclass\ObjectToArray;
use xltxlm\helper\Hclass\ObjectToJson;
use xltxlm\helper\Hclass\ObjectIteratorAggregate;

/**
* Class select
*/
class <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Model extends ObjectIteratorAggregate
{
    use ObjectToArray;
    use ObjectToJson;
    use <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Base;
    use <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Getset;

    /**
    * @return array
    */
    final public function __invoke()
    {
        $fieldSchema=[];
<?php foreach ($this->getTableObject()->getFieldSchemas() as $field) {
    ?>
        $fieldSchema['<?=$field->getCOLUMNNAME()?>']='<?=$field->getCOLUMNCOMMENT()?:$field->getCOLUMNNAME()?>';
<?php
}?>
        return $fieldSchema;
    }
}

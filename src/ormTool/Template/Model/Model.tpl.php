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
    * 以下是查询的sql
    *  SELECT  <?php $i=count($this->getTableObject()->getFieldSchemas()); foreach ($this->getTableObject()->getFieldSchemas() as $iindex=>$field) { echo "`{$field->getCOLUMNNAME()}` {$field->getCOLUMNNAME()}"; if($iindex+1!=$i) echo ','; } ?> FROM <?=$this->getTableObject()->getName()?>;
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

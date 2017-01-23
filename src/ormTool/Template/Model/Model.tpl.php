<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use xltxlm\helper\Hclass\ObjectToArray;

/**
* Class select
*/
class <?=ucfirst($tableSchema->getTABLENAME())?>Model
{
    use ObjectToArray;
    use <?=ucfirst($tableSchema->getTABLENAME())?>Base;
    use <?=ucfirst($tableSchema->getTABLENAME())?>Getset;
}

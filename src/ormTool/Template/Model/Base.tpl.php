<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait <?=ucfirst($tableSchema->getTABLENAME())?>Base
{

<?php foreach ($fieldSchema as $field) {
    ?>
    /** @var string <?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?> */
    protected $<?=$field->getCOLUMNNAME()?>;
    <?php

}?>

}

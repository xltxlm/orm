<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use xltxlm\helper\Hclass\CopyObjectAttributeName;

/**
 * 可以被重复利用的数据模型
 * Class select
 */
class <?=ucfirst($tableSchema->getTABLENAME())?>Copy
{
    use CopyObjectAttributeName;
    use <?=ucfirst($tableSchema->getTABLENAME())?>Base;
<?php foreach ($fieldSchema as $field) {
    ?>

    /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return string
    */
    public static function <?=$field->getCOLUMNNAME()?>()
    {
        return (self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>));
    }

    <?php

}?>

    /**
    * @return array
    */
    final public function __invoke()
    {
        $fieldSchema=[];
<?php foreach ($fieldSchema as $field) {
?>
        $fieldSchema['<?=$field->getCOLUMNNAME()?>']='<?=$field->getCOLUMNCOMMENT()?:$field->getCOLUMNNAME()?>';
<?php }?>
        return $fieldSchema;
    }
}

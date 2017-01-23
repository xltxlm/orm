<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait <?=ucfirst($tableSchema->getTABLENAME())?>Getset
{
<?php foreach ($fieldSchema as $field) {
    ?>
    /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return string
    */
    public function get<?=ucfirst($field->getCOLUMNNAME())?>()
    {
        return $this-><?=$field->getCOLUMNNAME()?>;
    }

    /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return string
    */
    public static function varname<?=ucfirst($field->getCOLUMNNAME())?>()
    {
        return (self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>));
    }

    /**
    * out:<?=$field->getCOLUMNCOMMENT()?>

    * @param mixed $<?=$field->getCOLUMNNAME()?>

    * @return $this
    */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this-><?=$field->getCOLUMNNAME()?>=$<?=$field->getCOLUMNNAME()?>;
        return $this;
    }
    <?php

}?>
}

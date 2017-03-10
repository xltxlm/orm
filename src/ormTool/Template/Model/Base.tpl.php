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
trait <?=ucfirst($tableSchema->getTABLENAME())?>Base
{
    use CopyObjectAttributeName;
<?php foreach ($fieldSchema as $field) {
    ?>
    /** @var string <?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?> */
    protected $<?=$field->getCOLUMNNAME()?>;

        /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return string
    */
    public static function <?=$field->getCOLUMNNAME()?>()
    {
        return (self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>));
    }

    /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return string
    */
    public static function <?=$field->getCOLUMNNAME()?>Vue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>));
        }
    }

    <?php

}?>

}

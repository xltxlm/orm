<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use xltxlm\helper\Hclass\CopyObjectAttributeName;
/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Base
{
    use CopyObjectAttributeName;
<?php foreach ($this->getTableObject()->getFieldSchemas() as $field) {
    ?>
    /** @var string <?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?> */
    protected $<?=$field->getCOLUMNNAME()?>='';

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
    public static function <?=$field->getCOLUMNNAME()?>Vue($add = true,$function='')
    {
        if($add)
        {
            return '{{ '.$function.'(item.'.(self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>)).') }}';
        }else
        {
            return $function.'(item.'.(self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>)).')';
        }
    }


    /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return string
    */
    public static function <?=$field->getCOLUMNNAME()?>VueFunction($add = true,$function = '')
    {
        if($add)
        {
            return '{{ '.$function.'(item.'.(self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>)).',item) }}';
        }else
        {
            return $function.'(item.'.(self::selfInstance()->varName(self::selfInstance()-><?=$field->getCOLUMNNAME()?>)).',item)';
        }
    }

    <?php

}?>

}

<?php /** @var \xltxlm\ormTool\OrmMaker $this */ ?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use \xltxlm\ormTool\Unit\FieldSchema;

final class <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Type
{
<?php foreach ($this->getTableObject()->getFieldSchemas() as $item) {
    ?>
    /**
     * @return bool
    */
    public static function <?=$item->getCOLUMNNAME()?>IsInt() :bool
    {
        return in_array('<?=$item->getDATATYPE()?>' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function <?=$item->getCOLUMNNAME()?>IsFloat() :bool
    {
        return in_array('<?=$item->getDATATYPE()?>' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function <?=$item->getCOLUMNNAME()?>IsString() :bool
    {
        return in_array('<?=$item->getDATATYPE()?>' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function <?=$item->getCOLUMNNAME()?>IsDate() :bool
    {
        return in_array('<?=$item->getDATATYPE()?>' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function <?=$item->getCOLUMNNAME()?>IsTime() :bool
    {
        return in_array('<?=$item->getDATATYPE()?>' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function <?=$item->getCOLUMNNAME()?>IsEnum() :bool
    {
        return in_array('<?=$item->getDATATYPE()?>' , [FieldSchema::ENUM]);
    }


<?php 
}?>
}
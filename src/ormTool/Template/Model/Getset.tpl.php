<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

use xltxlm\helper\BasicType;

/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Getset
{

    /**
    * 从数据库设置默认值
    */
    public function default()
    {
<?php foreach ($this->getTableObject()->getFieldSchemas() as $field) {
    if(!$field->getCOLUMNDEFAULT())
    {
        continue;
    }
    if($field->getCOLUMNDEFAULT()=='CURRENT_TIMESTAMP'){
    ?>
        $value = date('Y-m-d H:i:s');
    <?php }else{?>
        $value='<?=$field->getCOLUMNDEFAULT()?>';
    <?php }?>
        $this->set<?=ucfirst($field->getCOLUMNNAME())?>($value);
<?php }?>
        return $this;
    }

<?php foreach ($this->getTableObject()->getFieldSchemas() as $field) {
    ?>
    /**
    * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

    * @return BasicType
    */
    public function get<?=ucfirst($field->getCOLUMNNAME())?>()
    {
        if(get_class($this-><?=$field->getCOLUMNNAME()?>)==BasicType::class)
            return $this-><?=$field->getCOLUMNNAME()?>;
        else
            return new BasicType($this-><?=$field->getCOLUMNNAME()?>);
    }

    /**
    * out:<?=$field->getCOLUMNCOMMENT()?>

    * @param mixed $<?=$field->getCOLUMNNAME()?>

    * @return $this
    */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
<?php if(in_array($field->getDATATYPE(),['timestamp','date','datetime'])){?>
        //如果是日期格式的，那么josn格式的转换成区间
        if(is_string($<?=$field->getCOLUMNNAME()?>) &&  $<?=$field->getCOLUMNNAME()?>[0]=='[' && substr($<?=$field->getCOLUMNNAME()?>,-1) == ']')
            $this-><?=$field->getCOLUMNNAME()?> = new BasicType(json_decode($<?=$field->getCOLUMNNAME()?>,true));
        else
<?php }?>
            $this-><?=$field->getCOLUMNNAME()?> = new BasicType($<?=$field->getCOLUMNNAME()?>);
        return $this;
    }
    <?php

}?>

    /**
     * 魔术函数直接取内容 getxx
     */
    public function __call($name,$arguments)
    {
        $function = lcfirst(substr($name, 3));
        return $this->$function;
    }

}

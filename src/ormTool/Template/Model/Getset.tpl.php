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
        return new BasicType($this-><?=$field->getCOLUMNNAME()?>);
    }

    /**
    * out:<?=$field->getCOLUMNCOMMENT()?>

    * @param mixed $<?=$field->getCOLUMNNAME()?>

    * @return $this
    */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
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

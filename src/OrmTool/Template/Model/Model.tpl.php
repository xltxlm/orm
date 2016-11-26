<?php /** @var \OrmTool\Make $this */?>
<?php /** @var \OrmTool\Unit\TableSchema $table */?>
<?php /** @var \OrmTool\Unit\FieldSchema[] $fields */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>\<?=$this->getDbConfig()->getDb()?>;

/**
* Class select
* @package OrmTool\Template\Model
*/
final class <?=ucfirst($table->getTABLENAME())?>Model
{
<?php foreach ($fields as $field) {
    ?>
    /** @var string <?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?> */
    protected $<?=$field->getCOLUMNNAME()?>;
    /**
     * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getCOLUMNTYPE()?>

     * @return string
     */
    public function get<?=ucfirst($field->getCOLUMNNAME())?>()
    {
        return $this-><?=$field->getCOLUMNNAME()?>;
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

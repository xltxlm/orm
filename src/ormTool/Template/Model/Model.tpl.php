<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>;

/**
* Class select
* @package ormTool\Template\Model
*/
final class <?=ucfirst($tableSchema->getTABLENAME())?>Model
{
<?php foreach ($fieldSchema as $field) {
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

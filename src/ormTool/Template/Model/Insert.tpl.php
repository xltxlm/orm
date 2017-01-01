<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace <?=$this->getDbNameSpace()?>;

final class <?=ucfirst($tableSchema->getTABLENAME())?>Insert extends \<?= \xltxlm\ormTool\Template\Insert::class?>

{

    final public function __construct()
    {
        $this->tableObject=(new <?=ucfirst($tableSchema->getTABLENAME())?>);
    }
<?php foreach ($fieldSchema as $field) {
    ?>
    protected $<?=$field->getCOLUMNNAME()?>;

    /**
     * out:<?=$field->getCOLUMNCOMMENT()?> <?=$field->getDATATYPE()?> <?=$field->getCHARACTERMAXIMUMLENGTH()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = ":<?=$field->getCOLUMNNAME()?>";
        $this->binds['<?=$field->getCOLUMNNAME()?>'] = $<?=$field->getCOLUMNNAME()?>;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>SQL($sql, $value = "")
    {
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = '<?=$field->getCOLUMNNAME()?>=' . $sql;
        if ($value) {
            $this->binds['<?=$field->getCOLUMNNAME()?>'] = $value;
        }
        return $this;
    }
<?php

}?>
}

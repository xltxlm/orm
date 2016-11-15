<?php /** @var \OrmTool\Make $this */?>
<?php /** @var \OrmTool\Unit\TableSchema $table */?>
<?php /** @var \OrmTool\Unit\FieldSchema[] $fields */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace <?=$this->getDbNameSpace()?>\<?=$this->getDbConfig()->getDb()?>;

final class <?=ucfirst($table->getTABLENAME())?>Update extends \<?=\OrmTool\Template\Update::class?>

{
<?php foreach ($fields as $field) {
    ?>
    protected $<?=$field->getCOLUMNNAME()?>;

    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = "<?=$field->getCOLUMNNAME()?>=:<?=$field->getCOLUMNNAME()?>";
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

    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function where<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this->whereSqls['where<?=$field->getCOLUMNNAME()?>'] = "<?=$field->getCOLUMNNAME()?>=:where<?=$field->getCOLUMNNAME()?>";
        $this->binds['where<?=$field->getCOLUMNNAME()?>'] = $<?=$field->getCOLUMNNAME()?>;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function where<?=ucfirst($field->getCOLUMNNAME())?>SQL($sql, $value = "")
    {
        $this->sqls['where<?=$field->getCOLUMNNAME()?>'] = '<?=$field->getCOLUMNNAME()?>=' . $sql;
        if ($value) {
            $this->binds['where<?=$field->getCOLUMNNAME()?>'] = $value;
        }
        return $this;
    }
<?php 
}?>
}
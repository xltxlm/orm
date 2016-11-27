<?php /** @var \OrmTool\Make $this */?>
<?php /** @var \OrmTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \OrmTool\Unit\FieldSchema[] $fields */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 5:31
 */

namespace <?=$this->getDbNameSpace()?>\<?=$this->getDbConfig()->getDb()?>;

/**
 * Class select
 * @package OrmTool\Template\Model
 */
final class <?=ucfirst($tableSchema->getTABLENAME())?>Page extends \<?=\OrmTool\Template\Page::class?>

{
    /** @var string  模型类 */
    protected $modelClass = <?=ucfirst($tableSchema->getTABLENAME())?>Model::class;

    final public function __construct()
    {
        $this->tableObject=(new <?=ucfirst($tableSchema->getTABLENAME())?>);
    }

<?php foreach ($fields as $field) {
    ?>

    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?>=:<?=$field->getCOLUMNNAME()?>";
        $this->binds['<?=$field->getCOLUMNNAME()?>'] = $<?=$field->getCOLUMNNAME()?>;
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function order<?=ucfirst($field->getCOLUMNNAME())?>Asc()
    {
        $this->sqlsOrder['<?=$field->getCOLUMNNAME()?>'] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?> ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function order<?=ucfirst($field->getCOLUMNNAME())?>Desc()
    {
        $this->sqlsOrder['<?=$field->getCOLUMNNAME()?>'] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?> DESC";
        return $this;
    }
<?php

}?>

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param array $value
     * @return $this
     */
    public function setSQL($sql, $value = [])
    {
        $this->sqls[] = $sql;
        if ($value) {
            $this->binds = array_merge($this->binds,$value);
        }
        return $this;
    }
}

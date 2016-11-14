<?php /** @var \OrmTool\Make $this */?>
<?php /** @var \OrmTool\Unit\TableSchema $table */?>
<?php /** @var \OrmTool\Unit\FieldSchema[] $fields */?>
<?php /** @var bool $moreData */?>
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
final class <?=ucfirst($table->getTABLENAME())?>Select<?=$moreData?'All':'One'?> extends \<?=\OrmTool\Template\Select::class?>

{
    /** @var bool  一维查询 还是 二维查询 */
    protected $moreData = <?=$moreData?'true':'false'?>;

    /** @var string  模型类 */
    protected $modelClass = <?=ucfirst($table->getTABLENAME())?>Model::class;

    final public function __construct()
    {
        $this->table=(new <?=ucfirst($table->getTABLENAME())?>);
    }

<?php foreach ($fields as $field) {?>
    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @return string
     */
    public function get<?=ucfirst($field->getCOLUMNNAME())?>()
    {
        return '<?=$field->getCOLUMNNAME()?>';
    }

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
     * 排序的方向
     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function order<?=ucfirst($field->getCOLUMNNAME())?>Asc($<?=$field->getCOLUMNNAME()?>)
    {
        $this->sqlsOrder['<?=$field->getCOLUMNNAME()?>'] = "<?=$field->getCOLUMNNAME()?> ASC";
        return $this;
    }
<?php }?>
}

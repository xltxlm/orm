<?php /** @var \xltxlm\ormTool\OrmMaker $this */ ?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace <?=$this->getDbNameSpace()?>;
/** 日*/
use \xltxlm\ormTool\Template\PdoAction;
use \xltxlm\ormTool\Template\Update;

final class <?=ucfirst($this->getTableSchema()->getTABLENAME())?>Update extends Update

{
    final public function __construct()
    {
        $this->tableObject=(new <?=ucfirst($this->getTableSchema()->getTABLENAME())?>);
    }

<?php foreach ($this->getTableObject()->getFieldSchemas() as $field) {
    ?>
    protected $<?=$field->getCOLUMNNAME()?>;

    /**
     * 对字段采用乐观锁
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function Optimistic<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = "`<?=$field->getCOLUMNNAME()?>`=:<?=$field->getCOLUMNNAME()?>";
        $this->binds['<?=$field->getCOLUMNNAME()?>'] = $<?=$field->getCOLUMNNAME()?>;

        $this->whereSqls['where<?=$field->getCOLUMNNAME()?>'] = "`<?=$field->getCOLUMNNAME()?>` != :where<?=$field->getCOLUMNNAME()?>";
        $this->binds['where<?=$field->getCOLUMNNAME()?>'] = $<?=$field->getCOLUMNNAME()?>;
        return $this;
    }
    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function set<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>)
    {
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = "`<?=$field->getCOLUMNNAME()?>`=:<?=$field->getCOLUMNNAME()?>";
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
        $this->sqls['<?=$field->getCOLUMNNAME()?>'] = '`<?=$field->getCOLUMNNAME()?>`=' . $sql;
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
    public function where<?=ucfirst($field->getCOLUMNNAME())?>(string $<?=$field->getCOLUMNNAME()?>,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['where<?=$field->getCOLUMNNAME()?>'] = "`<?=$field->getCOLUMNNAME()?>`$action:where<?=$field->getCOLUMNNAME()?>";
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
        $this->sqls['where<?=$field->getCOLUMNNAME()?>'] = '`<?=$field->getCOLUMNNAME()?>`=' . $sql;
        if ($value) {
            $this->binds['where<?=$field->getCOLUMNNAME()?>'] = $value;
        }
        return $this;
    }
<?php

}?>
}

<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\Table $tableObject */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */?>
<?php /** @var \xltxlm\ormTool\Unit\ForeignKey[] $foreignKeys */?>
<?php /** @var bool $moreData */?>
<?php /** @var bool $pageClass */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 5:31
 */

namespace <?=$this->getDbNameSpace()?>;

use \xltxlm\ormTool\Template\PdoAction;
<?php if ($pageClass) {
    ?>
use \xltxlm\ormTool\Template\Page;
<?php 
} else {
    ?>
use \xltxlm\ormTool\Template\Select;
<?php 
}?>
/**
 * Class select
 */
<?php if ($pageClass) {
    ?>
final class <?=ucfirst($tableSchema->getTABLENAME())?>Page extends Page
<?php

} else {
    ?>
final class <?=ucfirst($tableSchema->getTABLENAME())?>Select<?=$moreData ? 'All' : 'One'?> extends Select
<?php

}?>
{
    /** @var bool  一维查询 还是 二维查询 */
    protected $moreData = <?=$moreData ? 'true' : 'false'?>;
    /** @var array 参数执行次数存储 */
    protected $execCount=[];

    /** @var string  模型类 */
    protected $modelClass = <?=ucfirst($tableSchema->getTABLENAME())?>Model::class;

    final public function __construct()
    {
        $this->tableObject=(new <?=ucfirst($tableSchema->getTABLENAME())?>);
    }

<?php foreach ($fieldSchema as $field) {
    ?>

    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function where<?=ucfirst($field->getCOLUMNNAME())?>($<?=$field->getCOLUMNNAME()?>,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['<?=$field->getCOLUMNNAME()?>']?$this->execCount['<?=$field->getCOLUMNNAME()?>']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['<?=$field->getCOLUMNNAME()?>'.$uniqid] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?>$action:(<?=$field->getCOLUMNNAME()?>$uniqid)=0";
        }else{
            $this->sqls['<?=$field->getCOLUMNNAME()?>'.$uniqid] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?>$action:<?=$field->getCOLUMNNAME()?>$uniqid";
        }
        $this->binds['<?=$field->getCOLUMNNAME()?>'.$uniqid] = $<?=$field->getCOLUMNNAME()?>;
        $this->execCount['<?=$field->getCOLUMNNAME()?>']++;
        return $this;
    }
    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function where<?=ucfirst($field->getCOLUMNNAME())?>NULL($<?=$field->getCOLUMNNAME()?>=true)
    {
        $uniqid=$this->execCount['<?=$field->getCOLUMNNAME()?>']?$this->execCount['<?=$field->getCOLUMNNAME()?>']:null;
        if($<?=$field->getCOLUMNNAME()?> == true)
        {
            $this->sqls['<?=$field->getCOLUMNNAME()?>'.$uniqid] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?> IS NULL";
        }else
        {
            $this->sqls['<?=$field->getCOLUMNNAME()?>'.$uniqid] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?> IS NOT NULL";
        }
        $this->execCount['<?=$field->getCOLUMNNAME()?>']++;
        return $this;
    }
    /**
     * out:<?=$field->getCOLUMNCOMMENT()?>

     * @param mixed $<?=$field->getCOLUMNNAME()?>

     * @return $this
     */
    public function where<?=ucfirst($field->getCOLUMNNAME())?>Maybe($<?=$field->getCOLUMNNAME()?>,$action=PdoAction::EQUAL)
    {
        if(!empty($<?=$field->getCOLUMNNAME()?>) || strlen($<?=$field->getCOLUMNNAME()?>)>0){
            $uniqid=$this->execCount['<?=$field->getCOLUMNNAME()?>']?$this->execCount['<?=$field->getCOLUMNNAME()?>']:null;
            $this->sqls['<?=$field->getCOLUMNNAME()?>'.$uniqid] = "<?=$tableSchema->getTABLENAME()?>.<?=$field->getCOLUMNNAME()?>$action:<?=$field->getCOLUMNNAME()?>$uniqid";
            $this->binds['<?=$field->getCOLUMNNAME()?>'.$uniqid] = $<?=$field->getCOLUMNNAME()?>;
            $this->execCount['<?=$field->getCOLUMNNAME()?>']++;
        }
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

<?php
foreach ($foreignKeys as $foreignKey) {
    ?>
    /**
    * @return $this
    */
    public function joinOn<?=ucfirst($foreignKey->getReferTableName())?>By<?=join("And", $foreignKey->getKeysArray())?>()
    {
        $this->joinSql[]=" JOIN <?=$foreignKey->getReferTableName()?> ON (<?=$foreignKey->getJoinSql()?>) ";
        $this->joinTable["<?=$foreignKey->getReferTableName()?>"]="<?=$foreignKey->getJoinFieldAs()?>";
        return $this;
    }

<?php

}?>

<?php foreach ($tableObject->getJoinTables() as $table) {
    ?>
    /**
    * 获取关联表的结果对象 关联查询的时候可用
    * @return <?=ucfirst($table)?>Model
    */
    public function getTable<?=ucfirst($table)?>()
    {
        $modelObject=(new <?=ucfirst($table)?>Model);
        foreach( $this->result as $key => $result ) {
            if( strpos($key,'AS')===0) {
                $filedFunction='set'.ucfirst(substr($key,3+strlen("<?=$table?>")));
                $modelObject->$filedFunction($result);
            }
        }
        return $modelObject;
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

    /**
     * @return <?=ucfirst($tableSchema->getTABLENAME())?>Model<?=$moreData ? '[]' : ''?>

     */
    final public function __invoke()
    {
        return parent::__invoke();
    }
}

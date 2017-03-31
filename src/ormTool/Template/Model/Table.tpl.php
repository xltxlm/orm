<?php /** @var \xltxlm\ormTool\OrmMaker $this */
/** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */
use xltxlm\ormTool\Unit\Table;
$tableObject= (new Table)
    ->setName($tableSchema->getTABLENAME())
    ->setDbConfig($this->getDbConfig());
?>
<<?='?'?>php

    namespace <?=$this->getDbNameSpace()?>;

    use <?= xltxlm\orm\Config\PdoConfig::class?>;
    use <?= Table::class?>;
    use <?=(new \ReflectionClass($this->getDbConfig()))->name?>;

    final class <?=ucfirst($tableSchema->getTABLENAME())?> extends Table
    {

    /** @var string 表格的名称 */
    protected $name = "<?=$tableSchema->getTABLENAME()?>";

    /** @var string 表格的描述 */
    protected $comment = "<?=$tableSchema->getTABLECOMMENT()?>";

    /**
    * @return PdoConfig
    */
    public function getDbConfig(): PdoConfig
    {
        return $this->DbConfig?:(new <?=(new \ReflectionClass($this->getDbConfig()))->getShortName()?>);
    }

    /**
     * 获取自增 id
     */
    public function getAutoIncrement(): string
    {
        return "<?=$tableObject->getAutoIncrement()?>";
    }

    /**
     *
     * 主键id
     */
    public function getPrimaryKey(): array
    {
        return json_decode('<?=json_encode($tableObject->getPrimaryKey(),JSON_UNESCAPED_UNICODE)?>',true);
    }

    /**
     * 优先返回唯一键,如果没有唯一键,返回主键,
     */
    public function getUniqueKey():array
    {
        return json_decode('<?=json_encode($tableObject->getUniqueKey()?:$tableObject->getPrimaryKey(),JSON_UNESCAPED_UNICODE)?>',true);
    }

    /**
     * 所有的特别字段
     */
    public function getSpecial():array
    {
        return array_unique(array_merge([$this->getAutoIncrement()],$this->getUniqueKey(),$this->getPrimaryKey()));
    }

    /**
     * 所有的特别字段
     */
    public function getComment():string
    {
        return "<?=$tableObject->getComment()?>";
    }
}

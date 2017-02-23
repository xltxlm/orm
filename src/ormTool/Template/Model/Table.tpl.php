<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<<?='?'?>php

    namespace <?=$this->getDbNameSpace()?>;

    use <?= xltxlm\orm\Config\PdoConfig::class?>;
    use <?= \xltxlm\ormTool\Unit\Table::class?>;
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
}

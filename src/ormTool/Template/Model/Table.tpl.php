<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<?php /** @var \xltxlm\ormTool\Unit\TableSchema $tableSchema */?>
<<?='?'?>php

    namespace <?=$this->getDbNameSpace()?>;

    use <?= xltxlm\orm\Config\PdoConfig::class?>;

    final class <?=ucfirst($tableSchema->getTABLENAME())?> extends \<?= \xltxlm\ormTool\Unit\Table::class?>

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
        return new \<?=(new \ReflectionClass($this->getDbConfig()))->name?>;
    }
}

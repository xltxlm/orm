<?php /** @var \OrmTool\Make $this */?>
<?php /** @var \OrmTool\Unit\TableSchema $table */?>
<<?='?'?>php

namespace <?=$this->getDbNameSpace()?>\<?=$this->getDbConfig()->getDb()?>;

use <?=Orm\Config\PdoConfig::class?>;

final class <?=ucfirst($table->getTABLENAME())?> extends \<?=\OrmTool\Unit\Table::class?>

{

    /** @var string 表格的名称 */
    protected $name = "<?=$table->getTABLENAME()?>";

    /** @var string 表格的描述 */
    protected $comment = "<?=$table->getTABLECOMMENT()?>";

    /**
    * @return PdoConfig
    */
    public function getDbConfig(): PdoConfig
    {
        return new \<?=(new \ReflectionClass($this->getDbConfig()))->name?>;
    }
}

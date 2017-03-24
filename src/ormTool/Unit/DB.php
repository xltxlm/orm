<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 下午 5:09.
 */

namespace xltxlm\ormTool\Unit;

use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

final class DB
{
    /** @var PdoConfig 所属的数据库类 */
    protected $dbConfig;

    /**
     * @return PdoConfig
     */
    public function getDbConfig(): PdoConfig
    {
        return $this->dbConfig;
    }

    /**
     * @param PdoConfig $dbConfig
     *
     * @return DB
     */
    public function setDbConfig(PdoConfig $dbConfig): DB
    {
        $this->dbConfig = $dbConfig;

        return $this;
    }

    /**
     * 返回数据表格列表对象
     * @return TableSchema[]
     */
    public function __invoke()
    {
        //获取数据库的全部表列表
        $sql        = 'SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=:TABLE_SCHEMA ';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'TABLE_SCHEMA' => $this->getDbConfig()->getDb(),
                ]
            )
            ->__invoke();
        /* @var TableSchema[] $tableSchemas */
        return  (new PdoInterface())
            ->setPdoConfig($this->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setClassName(TableSchema::class)
            ->selectAll();
    }
}

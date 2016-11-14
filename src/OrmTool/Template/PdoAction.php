<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:50
 */

namespace OrmTool\Template;

use Orm\PdoInterface;

/**
 * Class PdoAction
 * @package OrmTool\Template
 */
abstract class PdoAction
{
    /** @var array 组合的sql段 */
    protected $sqlsOrder = [];

    /** @var array 组合的sql段 */
    protected $sqls = [];

    /** @var array 绑定的变量 */
    protected $binds = [];

    /** @var  \OrmTool\Unit\Table */
    protected $tableObject;

    /** @var  PdoInterface */
    protected $pdoInterface;

    /**
     * @return PdoInterface
     */
    public function getPdoInterface(): PdoInterface
    {
        return $this->pdoInterface;
    }


    /**
     * @return array
     */
    protected function getSqlsOrder(): array
    {
        return $this->sqlsOrder;
    }


    /**
     * @return array
     */
    protected function getSqls(): array
    {
        return $this->sqls;
    }

    /**
     * @return array
     */
    protected function getBinds(): array
    {
        return $this->binds;
    }

    /**
     * @return \OrmTool\Unit\Table
     */
    public function getTableObject(): \OrmTool\Unit\Table
    {
        return $this->tableObject;
    }
}

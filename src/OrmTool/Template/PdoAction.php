<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:50.
 */
namespace OrmTool\Template;

use Orm\PdoInterface;

/**
 * 数据库操作的基础类库
 * Class PdoAction.
 */
abstract class PdoAction
{
    /** @var array 组合的sql段 */
    protected $sqlsOrder = [];

    /** @var array 组合的sql段 */
    protected $sqls = [];

    /** @var array 绑定的变量 */
    protected $binds = [];

    /** @var \OrmTool\Unit\Table */
    protected $tableObject;

    /** @var PdoInterface */
    protected $pdoInterface;

    /** @var  callable 执行完毕回调的数据,可以用来矫正数据 或者 记录日志 */
    protected $CallableFunction;

    /** @var  \Monolog\Logger */
    protected $logObject;

    /**
     * @return \Monolog\Logger
     */
    public function getLogObject(): \Monolog\Logger
    {
        return $this->logObject;
    }

    /**
     * @param \Monolog\Logger $logObject
     * @return PdoAction
     */
    public function setLogObject(\Monolog\Logger $logObject): PdoAction
    {
        $this->logObject = $logObject;
        return $this;
    }


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

    /**
     * 回调处理函数
     * @param callable $callableFunction
     * @return $this
     */
    public function then(callable $callableFunction)
    {
        $this->CallableFunction = $callableFunction;
        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:50.
 */
namespace xltxlm\ormTool\Template;

use xltxlm\orm\PdoInterface;

/**
 * 数据库操作的基础类库
 * Class PdoAction.
 */
abstract class PdoAction
{
    const MORE = ">";
    const LESS = "<";
    const EQUAL = "=";
    const MOREANDEQUAL = ">=";
    const LESSANDEQUAL = "<=";
    const LIKE = ">=";

    /** @var array 连表查询的SQl */
    protected $joinSql = [];
    /** @var array 需要关联的表 */
    protected $joinTable = [];

    /** @var array 组合的sql段 */
    protected $sqlsOrder = [];

    /** @var array 组合的sql段 */
    protected $sqls = [];

    /** @var array 绑定的变量 */
    protected $binds = [];

    /** @var \xltxlm\ormTool\Unit\Table */
    protected $tableObject;

    /** @var PdoInterface */
    protected $pdoInterface;

    /** @var  callable 执行完毕回调的数据,可以用来矫正数据 或者 记录日志 */
    protected $CallableFunction;

    /** @var  \Monolog\Logger */
    protected $logObject;
    /** @var bool 是否打印调试信息 */
    protected $debug = false;

    /** @var \stdClass 本次查询的结果 */
    protected $result;

    /**
     * @param string $joinTable
     * @return static
     */
    final public function setJoinTable(string $joinTable)
    {
        $this->joinTable[] = $joinTable;
        return $this;
    }

    /**
     * @return string
     */
    final public function getJoinTable()
    {
        $this->joinTable[$this->tableObject->getName()] = $this->tableObject->getName().".*";
        return join(",", $this->joinTable);
    }


    /**
     * @return boolean
     */
    final public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
     * @return static
     */
    final public function setDebug(bool $debug)
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * @return \Monolog\Logger
     */
    final public function getLogObject(): \Monolog\Logger
    {
        return $this->logObject;
    }

    /**
     * @param \Monolog\Logger $logObject
     * @return static
     */
    final public function setLogObject(\Monolog\Logger $logObject)
    {
        $this->logObject = $logObject;
        return $this;
    }


    /**
     * @return PdoInterface
     */
    final public function getPdoInterface(): PdoInterface
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
     * @return \xltxlm\ormTool\Unit\Table
     */
    final public function getTableObject(): \xltxlm\ormTool\Unit\Table
    {
        return $this->tableObject;
    }

    /**
     * 回调处理函数
     * @param callable $callableFunction
     * @return $this
     */
    final public function then(callable $callableFunction)
    {
        $this->CallableFunction = $callableFunction;
        return $this;
    }
}

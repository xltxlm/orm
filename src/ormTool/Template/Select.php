<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:39.
 */

namespace xltxlm\ormTool\Template;

use Psr\Log\LogLevel;
use xltxlm\logger\Log\BasicLog;
use xltxlm\logger\Operation\Action\PdoRead;
use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

/**
 * Class SelectOne.
 */
class Select extends PdoAction
{
    /** @var bool 一维查询 还是 二维查询 */
    protected $moreData = false;
    /** @var string 模型类 */
    protected $modelClass = '';
    /** @var bool 是否把结果转换成数组格式 */
    protected $convertToArray = false;

    /** @var bool 测试查询是否存在,不要求一定存在此数据 */
    protected $existTest = false;

    /** @var string 设置查询的列名称 */
    protected $columnName = "";
    /** @var int 限制返回条数 */
    protected $limit = 0;

    /** @var string 强制指定索引 */
    protected $_index = "";

    /**
     * @return string
     */
    public function get_Index(): string
    {
        return $this->_index;
    }

    /**
     * @param string $index
     * @return Select
     */
    public function set_Index(string $index)
    {
        $this->_index = $index;
        return $this;
    }


    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }


    /**
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->columnName;
    }

    /**
     * @param string $columnName
     * @return static
     */
    public function setColumnName(string $columnName)
    {
        $this->columnName = $columnName;
        return $this;
    }

    /**
     * @return bool
     */
    public function isExistTest(): bool
    {
        return $this->existTest;
    }

    /**
     * @param bool $existTest
     * @return static
     */
    public function setExistTest(bool $existTest)
    {
        $this->existTest = $existTest;
        return $this;
    }

    public function yield()
    {
        $this->makePdoInterface();
        $this->getPdoInterface()->setBuff(false);
        $stmt = $this->getPdoInterface()->execute();
        while ($row = $stmt->fetchObject($this->getPdoInterface()->getClassName())) {
            yield $row;
        }
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        $this->makePdoInterface();
        if ($this->moreData) {
            //如果是列查询
            if ($this->getColumnName()) {
                //ModelIndex
                $keys = array_keys((new $this->modelClass)());
                $index = (int)array_search($this->getColumnName(), $keys);
                return $this->pdoInterface
                    ->selectColumn($index);
            } else {
                //如果是普通的返回数据对象
                return $this->pdoInterface
                    ->selectAll();
            }
        } else {
            $this->setLimit(1);
            $empty = (new $this->modelClass);
            $this->result = $this->pdoInterface
                ->selectOne();

//            //如果指定查询单条的数据,一半返回空就是有问题
//            if ($this->result == $empty && !$this->isExistTest()) {
//                (new PdoRead($this->pdoInterface))g
//                    ->setTableName($this->getTableObject()->getName())
//                    ->setMessageDescribe('查询结果为空')
//                    ->setException('查询结果为空')
//                    ->setType(LogLevel::ERROR)
//                    ->__invoke();
//            }
            return $this->result;
        }
    }

    protected function makePdoInterface($addsql = "")
    {
        $sql = 'SELECT ' . $this->getJoinTable() . ' FROM ' . $this->tableObject->getName() .
            join(" ", $this->joinSql) . ($this->get_Index() ? " force index({$this->get_Index()}) " : '') .
            ' WHERE ' . implode(' AND ', $this->getSqls());

        //有排序要求
        if ($this->getSqlsOrder()) {
            $sql .= ' Order By ' . implode(',', $this->getSqlsOrder());
        }
        //限制查询条数
        if ($this->getLimit()) {
            $sql .= ' Limit ' . $this->getLimit();
        }

        $SqlParserd = (new SqlParser())
            ->setSql($sql . $addsql)
            ->setBind($this->getBinds())
            ->__invoke();
        //执行sql
        $this->pdoInterface = (new PdoInterface())
            ->setTableName($this->getTableObject()->getName())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug)
            ->setBuff($this->isBuff())
            ->setConvertToArray($this->isConvertToArray())
            ->setClassName($this->modelClass);
    }

    /**
     * @return bool
     */
    public function isConvertToArray(): bool
    {
        return $this->convertToArray;
    }

    /**
     * @param bool $convertToArray
     * @return $this
     */
    public function setConvertToArray(bool $convertToArray)
    {
        $this->convertToArray = $convertToArray;
        if ($convertToArray) {
            $this->modelClass = \stdClass::class;
        }
        return $this;
    }
}

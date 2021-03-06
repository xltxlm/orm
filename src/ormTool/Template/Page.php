<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-15
 * Time: 下午 2:26.
 */

namespace xltxlm\ormTool\Template;

use xltxlm\page\PageObject;
use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

/**
 * out:按照分页处理的模型
 * Class Page.
 */
class Page extends PdoAction
{
    /** @var PageObject */
    protected $pageObject;
    /** @var string 模型类 */
    protected $modelClass = '';
    /** @var bool 是否把结果转换成数组格式 */
    protected $convertToArray = false;
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
     * @return Page
     */
    public function set_Index(string $index)
    {
        $this->_index = $index;
        return $this;
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
     * @return static
     */
    public function setConvertToArray(bool $convertToArray)
    {
        $this->convertToArray = $convertToArray;
        if ($convertToArray) {
            $this->modelClass = \stdClass::class;
        }
        return $this;
    }


    /**
     * @return PageObject
     */
    public function getPageObject(): PageObject
    {
        return $this->pageObject;
    }

    /**
     * @param PageObject $pageObject
     *
     * @return static
     */
    public function setPageObject(PageObject &$pageObject)
    {
        $this->pageObject = $pageObject;

        return $this;
    }

    /** @var string 设置查询的列名称 */
    protected $columnName = "";

    /**
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->columnName;
    }

    /**
     * @param string $columnName
     * @return Page
     */
    public function setColumnName(string $columnName): Page
    {
        $this->columnName = $columnName;
        return $this;
    }


    /**
     * @return mixed
     */
    public function __invoke()
    {
        $where = '';
        if ($this->getSqls()) {
            $where = ' WHERE ' . implode(' AND ', $this->getSqls());
        }
        $sql = 'SELECT * FROM ' . $this->tableObject->getName() . ($this->get_Index() ? " force index({$this->get_Index()}) " : '') . $where;
        //有排序要求
        if ($this->getSqlsOrder()) {
            $sql .= ' Order By ' . implode(',', $this->getSqlsOrder());
        }

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        //执行sql
        $this->pdoInterface = (new PdoInterface())
            ->setTableName($this->getTableObject()->getName())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug)
            ->setConvertToArray($this->isConvertToArray())
            ->setClassName($this->modelClass);

        if ($this->getColumnName()) {
            //ModelIndex
            $keys = array_keys((new $this->modelClass)());
            $index = (int)array_search($this->getColumnName(), $keys);
            return $this->pdoInterface
                ->page($this->pageObject, $index);
        } else {
            return $this->pdoInterface
                ->page($this->pageObject);
        }
    }
}

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

    /** @var int 传递过来指明当前第几页 */
    protected $pageID;
    /** @var int 每页显示多少条 */
    protected $prepage = 10;

    /**
     * @return int
     */
    public function getPageID(): int
    {
        return $this->pageID;
    }

    /**
     * @param int $pageID
     *
     * @return static
     */
    public function setPageID(int $pageID)
    {
        $this->pageID = $pageID;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrepage(): int
    {
        return $this->prepage;
    }

    /**
     * @param int $prepage
     *
     * @return static
     */
    public function setPrepage(int $prepage)
    {
        $this->prepage = $prepage;

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
     * @return mixed
     */
    public function __invoke()
    {
        $where = '';
        if ($this->getSqls()) {
            $where = ' WHERE '.implode(' AND ', $this->getSqls());
        }
        $sql = 'SELECT * FROM '.$this->tableObject->getName().$where;
        //有排序要求
        if ($this->getSqlsOrder()) {
            $sql .= ' Order By '.implode(',', $this->getSqlsOrder());
        }

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        //执行sql
        $this->pdoInterface = (new PdoInterface())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug)
            ->setClassName($this->modelClass);

        //结果分页条
        $this->pageObject = (new PageObject())
            ->setPageID($this->pageID)
            ->setPrepage($this->prepage);

        return $this->pdoInterface
            ->page($this->pageObject);
    }
}

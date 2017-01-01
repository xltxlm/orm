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
     * @return Page
     */
    public function setPageObject(PageObject &$pageObject): Page
    {
        $this->pageObject = $pageObject;

        return $this;
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

        return $this->pdoInterface
            ->page($this->pageObject);
    }
}

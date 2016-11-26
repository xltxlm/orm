<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-15
 * Time: 下午 2:26.
 */
namespace OrmTool\Template;

use Orm\PageObject;
use Orm\PdoInterface;
use Orm\Sql\SqlParser;
use Orm\Sql\SqlParserd;

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
     * @return Page
     */
    public function setPageID(int $pageID): Page
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
     * @return Page
     */
    public function setPrepage(int $prepage): Page
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
     * @return SqlParserd
     */
    final public function __invoke()
    {
        $sql = 'SELECT * FROM ' . $this->tableObject->getName() .
            ' WHERE ' . implode(' AND ', $this->getSqls());
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

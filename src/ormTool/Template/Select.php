<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:39.
 */
namespace xltxlm\ormTool\Template;

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

    /**
     * @return mixed
     */
    public function __invoke()
    {
        $sql = 'SELECT ' . $this->getJoinTable() . ' FROM ' . $this->tableObject->getName() .
            join(" ", $this->joinSql) .
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

        if ($this->moreData) {
            return $this->pdoInterface
                ->selectAll();
        } else {
            $this->result = $this->pdoInterface
                ->selectOne();
            return $this->result;
        }
    }
}

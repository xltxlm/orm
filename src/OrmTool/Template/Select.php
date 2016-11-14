<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:39
 */

namespace OrmTool\Template;

use Orm\PdoInterface;
use Orm\SqlParser;
use Orm\SqlParserd;

/**
 * Class SelectOne
 * @package OrmTool\Template
 */
class Select extends PdoAction
{
    /** @var bool  一维查询 还是 二维查询 */
    protected $moreData = false;
    /** @var string  模型类 */
    protected $modelClass = "";

    /**
     * @return SqlParserd
     */
    final public function __invoke()
    {
        $sql = "SELECT * FROM " . $this->table->getName() .
            " WHERE " . join(" AND ", $this->getSqls());
        //有排序要求
        if ($this->getSqlsOrder()) {
            $sql .= " Order By " . join(",", $this->getSqlsOrder());
        }

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        //执行sql
        $pdoInterface = (new PdoInterface())
            ->setPdoObject($this->table->getDbConfig()->instanceSelf())
            ->setSqlParserd($SqlParserd)
            ->setClassName($this->modelClass);
        if ($this->moreData) {
            return $pdoInterface
                ->selectAll();
        } else {
            return $pdoInterface
                ->selectOne();
        }
    }
}

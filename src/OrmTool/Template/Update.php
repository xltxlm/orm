<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:50
 */

namespace OrmTool\Template;

use Orm\PdoInterface;
use Orm\SqlParser;

/**
 * out:更新数据的底层
 * Class Update
 * @package OrmTool\Template
 */
class Update extends PdoAction
{
    /** @var array  where 部分的sql */
    protected $whereSqls = [];

    public function __invoke()
    {
        $sql = "UPDATE " . $this->table->getName() . " SET " .
            join(",", $this->sqls) . " WHERE " .
            join(' AND ' . $this->whereSqls);

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->__invoke();

        return (new PdoInterface())
            ->setPdoObject($this->table->getDbConfig()->instanceSelf())
            ->setSqlParserd($SqlParserd)
            ->update();
    }
}

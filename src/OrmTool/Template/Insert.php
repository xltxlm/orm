<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:24
 */

namespace OrmTool\Template;

use Orm\PdoInterface;
use Orm\SqlParser;

/**
 * out:基础类 - 写入数据库
 * Class insert
 * @package OrmTool\Template
 */
class Insert extends PdoAction
{

    /**
     * @return string
     */
    final public function __invoke()
    {
        $sql = "INSERT INTO " . $this->table->getName() .
            " (" . join(",", array_keys($this->getSqls())) . ") VALUES ( " .
            join(",", $this->getSqls()) . ") ";

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        //执行sql
        return (new PdoInterface())
            ->setPdoObject($this->table->getDbConfig()->getPdo()->instanceSelf())
            ->setSqlParserd($SqlParserd)
            ->setClassName(static::class)
            ->insert();
    }
}

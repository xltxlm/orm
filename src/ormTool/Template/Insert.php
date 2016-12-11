<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:24.
 */

namespace xltxlm\ormTool\Template;

use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

/**
 * out:基础类 - 写入数据库
 * Class insert.
 */
class Insert extends PdoAction
{
    /**
     * @return string
     */
    final public function __invoke()
    {
        $sql = 'INSERT INTO '.$this->tableObject->getName().
            ' ('.implode(',', array_keys($this->getSqls())).') VALUES ( '.
            implode(',', $this->getSqls()).' ) ';

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        //执行sql
        $this->pdoInterface = (new PdoInterface())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug)
            ->setClassName(static::class);

        return $this->pdoInterface
            ->insert();
    }
}

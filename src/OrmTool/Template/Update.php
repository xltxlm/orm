<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:50.
 */

namespace OrmTool\Template;

use Orm\PdoInterface;
use Orm\Sql\SqlParser;

/**
 * out:更新数据的底层
 * Class Update.
 */
class Update extends PdoAction
{
    /** @var array where 部分的sql */
    protected $whereSqls = [];

    final public function __invoke()
    {
        $sql = 'UPDATE '.$this->tableObject->getName().' SET '.
            implode(',', $this->sqls).' WHERE '.
            implode(' AND ', $this->whereSqls);
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        $this->pdoInterface = (new PdoInterface())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug);

        return $this->pdoInterface
            ->update();
    }
}

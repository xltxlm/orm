<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:50.
 */

namespace xltxlm\ormTool\Template;

use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

/**
 * out:更新数据的底层
 * Class Update.
 */
class Update extends PdoAction
{
    /** @var array where 部分的sql */
    protected $whereSqls = [];

    /** @var bool 当前查询连接,是否复用上次的查询连接 */
    protected $buff = true;

    /**
     * @return bool
     */
    public function isBuff(): bool
    {
        return $this->buff;
    }

    /**
     * @param bool $buff
     * @return static
     */
    public function setBuff(bool $buff)
    {
        $this->buff = $buff;
        return $this;
    }




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
            ->setBuff($this->isBuff())
            ->setDebug($this->debug);

        return $this->pdoInterface
            ->update();
    }
}

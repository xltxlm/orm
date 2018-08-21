<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 2:24.
 */

namespace xltxlm\ormTool\Template;

use xltxlm\helper\Basic\Str;
use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;
use xltxlm\redis\Config\RedisConfig;

/**
 * out:基础类 - 写入数据库
 * Class insert.
 */
class Insert extends PdoAction
{
    /** @var string 是否可以忽略写入错误 */
    private $ignore = '';

    /** @var bool 是否执行钩子代码 */
    protected $hook = true;

    /** @var RedisConfig  项目并发锁配置 */
    protected $RedisCacheConfig;

    /**
     * @return RedisConfig
     */
    public function getRedisCacheConfig()
    {
        return $this->RedisCacheConfig;
    }

    /**
     * @param RedisConfig $RedisCacheConfig
     * @return $this
     */
    public function setRedisCacheConfig(RedisConfig $RedisCacheConfig)
    {
        $this->RedisCacheConfig = $RedisCacheConfig;
        return $this;
    }

    /**
     * @return bool
     */
    public function is_Hook(): bool
    {
        return $this->hook;
    }

    /**
     * @param bool $hook
     * @return $this
     */
    public function set_Hook(bool $hook)
    {
        $this->hook = $hook;
        return $this;
    }


    /**
     * @return string
     */
    public function getIgnore(): string
    {
        return $this->ignore;
    }

    /**
     * @param bool $ignore
     * @return $this
     */
    public function setIgnore(bool $ignore)
    {
        $this->ignore = $ignore ? 'IGNORE' : '';
        return $this;
    }


    /**
     * @return string
     */
    public function __invoke()
    {
        $sql = 'INSERT ' . $this->getIgnore() . ' INTO ' . $this->tableObject->getName() .
            ' (' . implode(',', array_keys($this->getSqls())) . ') VALUES ( ' .
            implode(',', $this->getSqls()) . ' ) ';

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();

        //执行sql
        $this->pdoInterface = (new PdoInterface())
            ->setRedisCacheConfig($this->getRedisCacheConfig())
            ->setTableName($this->getTableObject()->getName())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug)
            ->setBuff($this->isBuff())
            ->setClassName(static::class);
        /** @var int $insertID 新增的账户id */
        $insertID = $this->pdoInterface
            ->insert();
        //如果写入成功了
        if ($insertID) {
            //并且还存在后续的操作，那么继续执行
            $className = static::class . 'More';
            $setValue = (new Str())->setValue($className);
            if ($setValue->Strpos('InsertOrUpdate')) {
                $className = $setValue->Strtr('InsertOrUpdate', 'Insert');
            }
            if ($this->is_Hook() && class_exists($className)) {
                /** @var InsertMore $classNameObject */
                $classNameObject = new $className;
                $classNameObject
                    ->setInsertID($insertID)
                    ->__invoke();
            }
        }
        return $insertID;
    }
}

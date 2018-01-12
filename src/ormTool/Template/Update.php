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

    /** @var bool 是否开启事务查询 */
    protected $buff = true;

    /** @var bool 是否执行钩子代码 */
    protected $_hook = true;

    /** @var int 针对主键进行的更新，会触发联动的更新动作 */
    protected $_updateMainId = 0;

    /** @var array 被更新影响到的字段 */
    protected $_updateFields = [];

    /**
     * @return bool
     */
    public function is_Hook(): bool
    {
        return $this->_hook;
    }

    /**
     * @param bool $hook
     * @return static
     */
    public function set_Hook(bool $hook)
    {
        $this->_hook = $hook;
        return $this;
    }


    /**
     * @return array
     */
    public function get_UpdateFields(): array
    {
        return $this->_updateFields;
    }

    /**
     * @param string $updateFields
     * @return static
     */
    public function set_UpdateFields(string $updateFields)
    {
        $this->_updateFields[] = $updateFields;
        return $this;
    }


    /**
     * @return int
     */
    public function get_UpdateMainId(): int
    {
        return $this->_updateMainId;
    }

    /**
     * @param int $_updateMainId
     * @return static
     */
    public function set_UpdateMainId(int $_updateMainId)
    {
        $this->_updateMainId = $_updateMainId;
        return $this;
    }


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

    protected function callUpdate()
    {

    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param array $value
     * @return $this
     */
    public function set_SQL($sql, $value = [])
    {
        $this->whereSqls[] = $sql;
        if ($value) {
            $this->binds = array_merge($this->binds, $value);
        }
        return $this;
    }

    final public function __invoke()
    {
        $sql = 'UPDATE ' . $this->tableObject->getName() . ' SET ' .
            implode(',', $this->sqls) . ' WHERE ' .
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

        $updatenum = $this->pdoInterface
            ->update();

        //如果写入成功了,准备执行钩子代码
        if ($updatenum) {
            //并且还存在后续的操作，那么继续执行
            $className = static::class . 'More';
            if ($this->is_Hook() && $this->get_UpdateMainId() && $updatenum == 1 && class_exists($className)) {
                $this->callUpdate();
            }
        }

        return $updatenum;
    }
}

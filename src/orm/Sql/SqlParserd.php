<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:53.
 */

namespace xltxlm\orm\Sql;

use xltxlm\orm\Unit\BindPair;

/**
 * out:解析完毕之后的sql对象
 * Class sqlParserd.
 */
final class SqlParserd
{
    /** @var string 需要解析的sql语句 */
    protected $sql = '';
    /** @var \xltxlm\orm\Unit\BindPair[] 返回绑定的 字段=>值 */
    protected $bind = [];
    /** @var bool 是否修改了数据库 */
    protected $changeData = false;
    /** @var array  返回绑定的 字段=>值 */
    private $bindArray = [];

    /**
     * @return bool
     */
    public function isChangeData(): bool
    {
        return $this->changeData;
    }

    /**
     * @param bool $changeData
     * @return SqlParserd
     */
    public function setChangeData(bool $changeData): SqlParserd
    {
        $this->changeData = $changeData;
        return $this;
    }

    /**
     * @return array
     */
    public function getBindArray(): array
    {
        return $this->bindArray;
    }

    /**
     * @return string
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @param string $sql
     *
     * @return SqlParserd
     */
    public function setSql(string $sql): SqlParserd
    {
        $this->sql = $sql;
        if (strpos(trim($sql), 'select') !== 0) {
            $this->setChangeData(true);
        }

        return $this;
    }

    /**
     * @return BindPair[]
     */
    public function getBind(): array
    {
        return $this->bind;
    }

    /**
     * @param BindPair $bind
     *
     * @return SqlParserd
     */
    public function setBind(BindPair $bind): SqlParserd
    {
        $this->bind[$bind->getKey()] = $bind;
        $this->bindArray[$bind->getKey()] = $bind->getValue();

        return $this;
    }

    public function __invoke()
    {
    }
}

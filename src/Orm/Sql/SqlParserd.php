<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:53.
 */
namespace Orm\Sql;

use Orm\Unit\BindPair;

/**
 * out:解析完毕之后的sql对象
 * Class sqlParserd.
 */
final class SqlParserd
{
    /** @var string 需要解析的sql语句 */
    protected $sql = '';
    /** @var \Orm\Unit\BindPair[] 返回绑定的 字段=>值 */
    protected $bind = [];

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

        return $this;
    }

    public function __invoke()
    {
    }
}

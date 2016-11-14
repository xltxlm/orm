<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:25
 */

namespace Orm;

use Orm\Exception\SqlParserException;
use Orm\Unit\BindPair;

/**
 * out:sql语句解析
 * Class sqlparser
 * @package libs\db
 */
final class SqlParser
{
    /** @var string 需要解析的sql语句 */
    protected $sql = "";
    /** @var array 返回绑定的 字段=>值 */
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
     * @return SqlParser
     */
    public function setSql(string $sql): SqlParser
    {
        $this->sql = $sql . " ";
        return $this;
    }

    /**
     * @return array
     */
    public function getBind(): array
    {
        return $this->bind;
    }

    /**
     * @param array $bind
     * @return SqlParser
     */
    public function setBind(array $bind): SqlParser
    {
        $this->bind = $bind;
        return $this;
    }

    /**
     * @return SqlParserd
     * @throws SqlParserException
     */
    public function __invoke()
    {
        $sqlParserd = new SqlParserd;
        foreach ($this->bind as $key => $value) {
            //如果绑定的值是数组,改变sql的结构
            if (is_array($value)) {
                $bindField = [];
                foreach ($value as $k => $v) {
                    $bindField[] = ":{$key}_{$k}";
                    $sqlParserd->setBind(
                        (new BindPair())
                            ->setKey("{$key}_{$k}")
                            ->setValue($v)
                    );
                }
                //格式一定是 :key后面至少一个空格
                $this->sql = strtr($this->sql, ["=:$key " => " in (" . join(",", $bindField) . " ) "]);
            } elseif ($value === null) {
                //如果绑定的是null,那么在where的位置上需要改进
                preg_match("#where(.*)=:$key#iUs", $this->sql, $out);
                if ($out) {
                    $this->sql = strtr($this->sql, ["=:$key " => " is null "]);
                } else {
                    $this->monal($sqlParserd, $key, $value);
                }
            } else {
                $this->monal($sqlParserd, $key, $value);
            }
        }
        //计算sql的需要绑定的变量数目 和 准备绑定的数目之间的差别
        preg_match_all('#:([a-z|0-9|_]+)[ ,]#iUS', $this->getSql(), $out);
        $sqlBinds = array_values($out[1]);
        sort($sqlBinds);
        $binds = array_keys($sqlParserd->getBind());
        sort($binds);
        if ($sqlBinds != $binds) {
            throw new SqlParserException(
                vsprintf(
                    (new \Orm\I18N\SqlParserException)
                        ->getBindError(),
                    [
                        json_encode($sqlBinds, JSON_UNESCAPED_UNICODE),
                        json_encode($binds, JSON_UNESCAPED_UNICODE)
                    ]
                )
            );
        }

        return $sqlParserd
            ->setSql($this->getSql());
    }

    /**
     * @param SqlParserd $sqlParserd
     * @param $key
     * @param $value
     * @return SqlParserd
     */
    private function monal(SqlParserd &$sqlParserd, $key, $value)
    {
        return $sqlParserd->setBind(
            (new BindPair())
                ->setKey($key)
                ->setValue($value)
        );
    }
}

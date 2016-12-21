<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/20
 * Time: 23:46.
 */

namespace xltxlm\orm;

use xltxlm\orm\Sql\SqlParser;

/**
 * 直接执行sql的入口, PdoInterface 封装一层
 * Class PdoInterfaceEasy.
 */
final class PdoInterfaceEasy extends PdoInterface
{
    /**
     * PdoInterfaceEasy constructor.
     *
     * @param string $sql
     * @param array $bind
     */
    public function __construct(string $sql, array $bind = [])
    {
        $this->setSqlParserd(
            (new SqlParser())
                ->setSql($sql)
                ->setBind($bind)
                ->__invoke()
        );
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 9:39.
 */
namespace xltxlm\orm\Exception;

/**
 * Class PdoSqlError.
 */
class PdoSqlError extends \Exception
{
    protected $sql;
    protected $binds;
    protected $errorinfo = '';

    /**
     * @return mixed
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @param mixed $sql
     *
     * @return PdoSqlError
     */
    public function setSql($sql)
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBinds()
    {
        return $this->binds;
    }

    /**
     * @param mixed $binds
     *
     * @return PdoSqlError
     */
    public function setBinds($binds)
    {
        $this->binds = $binds;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorinfo(): string
    {
        return $this->errorinfo;
    }

    /**
     * @param string $errorinfo
     *
     * @return PdoSqlError
     */
    public function setErrorinfo(string $errorinfo): PdoSqlError
    {
        $this->errorinfo = $errorinfo;

        return $this;
    }
}

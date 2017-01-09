<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-11
 * Time: 下午 6:42.
 */

namespace xltxlm\orm\Logger;

use xltxlm\logger\Log\DefineLog as DefineLogOrigin;

final class PdoRunLog extends DefineLogOrigin
{
    /** @var string */
    protected $sql = '';
    /** @var array */
    protected $binds = [];
    /** @var string */
    protected $tns = '';
    /** @var string 错误信息 */
    protected $errorInfo = '';

    /**
     * @return string
     */
    public function getErrorInfo(): string
    {
        return $this->errorInfo;
    }

    /**
     * @param string $errorInfo
     *
     * @return PdoRunLog
     */
    public function setErrorInfo(string $errorInfo): PdoRunLog
    {
        $this->errorInfo = $errorInfo;

        return $this;
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
     * @return PdoRunLog
     */
    public function setSql(string $sql): PdoRunLog
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * @return array
     */
    public function getBinds(): array
    {
        return $this->binds;
    }

    /**
     * @param array $binds
     *
     * @return PdoRunLog
     */
    public function setBinds(array $binds): PdoRunLog
    {
        $this->binds = $binds;

        return $this;
    }

    /**
     * @return string
     */
    public function getTns(): string
    {
        return $this->tns;
    }

    /**
     * @param string $tns
     *
     * @return PdoRunLog
     */
    public function setTns(string $tns): PdoRunLog
    {
        $this->tns = $tns;

        return $this;
    }
}

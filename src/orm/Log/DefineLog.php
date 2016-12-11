<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-11
 * Time: 下午 6:42.
 */

namespace xltxlm\orm\Log;

use xltxlm\logger\Log\DefineLog as DefineLogOrigin;

final class DefineLog extends DefineLogOrigin
{
    /** @var float SQL消耗的实际时间 */
    protected $time = 0.0;
    /** @var string */
    protected $sql = '';
    /** @var array */
    protected $binds = [];
    /** @var string */
    protected $tns = '';
    /** @var string 错误信息 */
    protected $errorInfo = '';
    /** @var string 代码执行的堆栈路径 */
    protected $trace = '';

    /**
     * @return string
     */
    public function getTrace(): string
    {
        return $this->trace;
    }

    /**
     * @param string $trace
     *
     * @return DefineLog
     */
    public function setTrace(string $trace): DefineLog
    {
        $this->trace = $trace;

        return $this;
    }

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
     * @return DefineLog
     */
    public function setErrorInfo(string $errorInfo): DefineLog
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
     * @return DefineLog
     */
    public function setSql(string $sql): DefineLog
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
     * @return DefineLog
     */
    public function setBinds(array $binds): DefineLog
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
     * @return DefineLog
     */
    public function setTns(string $tns): DefineLog
    {
        $this->tns = $tns;

        return $this;
    }

    /**
     * @return float
     */
    public function getTime(): float
    {
        return $this->time;
    }

    /**
     * @param float $time
     *
     * @return DefineLog
     */
    public function setTime(float $time): DefineLog
    {
        $this->time = $time;

        return $this;
    }
}

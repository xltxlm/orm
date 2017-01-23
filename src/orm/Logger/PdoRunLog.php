<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-11
 * Time: 下午 6:42.
 */

namespace xltxlm\orm\Logger;

use xltxlm\orm\PdoClient;
use xltxlm\logger\Log\DefineLog as DefineLogOrigin;

class PdoRunLog extends DefineLogOrigin
{
    /** @var string */
    protected $sql = '';
    /** @var string 运行的查询SQL类型 */
    protected $function = "";
    /** @var array */
    protected $binds = [];
    /** @var string */
    protected $tns = '';
    /** @var string 错误信息 */
    protected $errorInfo = '';

    /**
     * 当前记录的类算在运行类身上,不是orm
     * PdoRunLog constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setReource(PdoClient::class);
        $getNamespaceName = (new \ReflectionClass(PdoClient::class))->getNamespaceName();

        $debug_backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        foreach ($debug_backtrace as $item) {
            if ($item['class'] && strpos($item['class'], $getNamespaceName) === false) {
                $this->setLogClassName($item['class']);
                break;
            }
        }
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * @param string $function
     * @return PdoRunLog
     */
    public function setFunction(string $function): PdoRunLog
    {
        $this->function = $function;
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

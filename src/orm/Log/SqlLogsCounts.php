<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/23
 * Time: 15:18.
 */

namespace xltxlm\orm\Log;

use xltxlm\logger\Log\DefineLog;

/**
 * sql计数日志
 * Class SqlLogsCounts.
 */
final class SqlLogsCounts extends DefineLog
{
    /** @var int 次数 */
    protected $times = 0;
    /** @var string 链接的数据库名称 */
    protected $tns = '';

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
     * @return SqlLogsCounts
     */
    public function setTns(string $tns): SqlLogsCounts
    {
        $this->tns = $tns;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimes(): int
    {
        return $this->times;
    }

    /**
     * @param int $times
     *
     * @return SqlLogsCounts
     */
    public function setTimes(int $times): SqlLogsCounts
    {
        $this->times = $times;

        return $this;
    }
}

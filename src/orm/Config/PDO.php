<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/4/1
 * Time: 11:02
 */

namespace xltxlm\orm\Config;

/**
 * 保证一个实例只有一次提交动作
 * Class PDO
 * @package xltxlm\orm\Config
 */
class PDO extends \PDO
{
    private $tns = "";

    function __destruct()
    {
        /**
         * 注销的时候记录日志
         */
        //如果不是提交类型的
        if (substr($this->tns, -1) == 1) {
            $this->commit();
        }
        PdoConfig::unsetinstance($this->tns);
    }

    /**
     * @param string $tns
     * @return $this
     */
    public function lock(string $tns)
    {
        $this->tns = $tns;
        return $this;
    }

}
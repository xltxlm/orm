<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2019/11/27
 * Time: 下午4:14
 */

namespace xltxlm\ormTool\Template;


interface InsertOrUpdate
{
    /**
     * @param bool $ignore
     * @return static
     */
    public function setIgnore(bool $ignore);
    /**
     * @param bool $debug
     * @return static
     */
    public function setDebug(bool $debug);

    function __invoke() : int;
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:29
 */

namespace test\OrmTool;

use setup\doc;

/**
 * Class Make
 * @package test\OrmTool
 */
class Make extends \PHPUnit_Framework_TestCase
{
    /**
     * 生成Model类
     */
    public function test1()
    {
        (new \OrmTool\Make())
            ->setDbConfig(new doc())
            ->__invoke();
    }
}

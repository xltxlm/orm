<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 8:45
 */

namespace PageObject;

use Orm\PageObject;
use PHPUnit\Framework\TestCase;

/**
 * 分页类操作演示
 * Class Demo
 * @package PageObject
 */
class DemoTest extends TestCase
{
    /**
     * @test
     */
    public function test()
    {
        $PageObject = (new PageObject())
            ->setTotal(105)
            ->setPageID(2)
            ->setPrepage(3)
            ->__invoke();
        echo "<pre>-->";print_r($PageObject->getLimitSql());echo "<--@in ".__FILE__." on line ".__LINE__."\n";
    }
}

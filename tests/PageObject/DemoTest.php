<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 8:45
 */

namespace tests\PageObject;

use xltxlm\orm\PageObject;
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
        $this->assertEquals(" LIMIT 3, 3 ", $PageObject->getLimitSql());
    }
}

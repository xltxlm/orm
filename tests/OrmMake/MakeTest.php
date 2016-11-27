<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:29.
 */
namespace tests\OrmMake;

use PHPUnit\Framework\TestCase;
use setup\Doc;

/**
 * Class Make.
 */
class MakeTest extends TestCase
{
    /**
     * 生成Model类.
     */
    public function test1()
    {
        (new \OrmTool\Make())
            ->setDbConfig(new Doc())
            ->__invoke();
    }
}

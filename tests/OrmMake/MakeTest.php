<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:29.
 */
namespace xltxlm\orm\tests\OrmMake;

use PHPUnit\Framework\TestCase;
use setup\Doc;
use xltxlm\ormTool\OrmMaker;

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
        (new OrmMaker())
            ->setDbConfig(new Doc())
            ->__invoke();
    }
}

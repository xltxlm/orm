<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 下午 2:00.
 */

namespace xltxlm\orm\tests\Demo;

use PHPUnit\Framework\TestCase;
use setup\Doc\enum\EnumGoodsStatus;
use setup\Doc\GoodsInsert;

/**
 * Class InsertTest.
 */
class InsertTest extends TestCase
{
    /**
     * 写入数据库操作.测试返回数据库的自增id
     */
    public function test1()
    {
        $id = (new GoodsInsert())
            ->setTotal(10)
            ->setUsed(2)
            ->setName('abc')
            ->setStatus(EnumGoodsStatus::SHANG_JIA)
            ->__invoke();

        $this->assertGreaterThan(1, $id);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:15.
 */

namespace tests\Demo;

use setup\Doc\GoodsSelectOne;
use setup\Doc\GoodsUpdate;

/**
 * Class Update.
 */
class UpdateTest extends \PHPUnit_Framework_TestCase
{
    //带 where 条件更新
    public function test1()
    {
        $name = '改造过的'.time();
        $num  = (new GoodsUpdate())
            ->setName($name)
            ->setTotal(101)
            ->whereId(2)
            ->__invoke();
        $this->assertEquals(1, $num);
        $goods = (new GoodsSelectOne())
            ->whereId(2)
            ->__invoke();
        $this->assertEquals($name, $goods->getName());
    }

    //带 where 条件更新 + 更新的字段和where字段重叠
    public function test2()
    {
        $num  = (new GoodsUpdate())
            ->setTotal(102)
            ->whereTotal(101)
            ->__invoke();
        $this->assertEquals(1, $num);
    }
}

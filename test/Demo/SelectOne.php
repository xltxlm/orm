<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:01
 */

namespace test\Demo;

use setup\doc\GoodsSelectOne;

/**
 * out:验证普通的sql查询
 * Class selectOne
 * @package test\Demo
 */
class SelectOne extends \PHPUnit_Framework_TestCase
{

    // 带where条件, like 查询
    public function test0()
    {
        $goodsSelectOne = new GoodsSelectOne();

        $data = $goodsSelectOne
            ->setSQL('id like :id', ['id' => '120%'])
            ->__invoke();
        $this->assertTrue(is_a($data, \setup\doc\GoodsModel::class));

        echo "<pre>-->";
        print_r($data);
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";

        $this->assertEquals(
            "SELECT * FROM goods WHERE id=:id ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    // 带where条件, 赋值判断
    public function test1()
    {
        $goodsSelectOne = new GoodsSelectOne();

        $data = $goodsSelectOne
            ->setId(1061)
            ->__invoke();
        $this->assertTrue(is_a($data, \setup\doc\GoodsModel::class));

        echo "<pre>-->";
        print_r($data);
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";

        $this->assertEquals(
            "SELECT * FROM goods WHERE id=:id ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    //带where + 排序
    public function test2()
    {
        $goodsSelectOne = new GoodsSelectOne();

        $data = $goodsSelectOne
            ->setId(1061)
            ->orderIdDesc()
            ->__invoke();
        $this->assertTrue(is_a($data, \setup\doc\GoodsModel::class));

        $this->assertEquals(
            "SELECT * FROM goods WHERE id=:id Order By id DESC ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }
}

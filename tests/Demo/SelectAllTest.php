<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:01.
 */
namespace tests\Demo;

use PHPUnit\Framework\TestCase;
use setup\Doc\GoodsSelectAll;

/**
 * 验证多条结果的数据
 * 查询
 * Class selectAll.
 */
class SelectAllTest extends TestCase
{
    /**
     * 带 where 条件,非赋值查询
     */
    public function test0()
    {
        $goodsSelectOne = new GoodsSelectAll();

        $data = $goodsSelectOne
            ->setSQL('id>=:id', ['id' => 1200])
            ->__invoke();
        $this->assertTrue(is_array($data));

        $this->assertEquals(
            'SELECT goods.* FROM goods WHERE id>=:id ',
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    // 带 where 条件,赋值查询
    public function test1()
    {
        $goodsSelectOne = new GoodsSelectAll();

        $data = $goodsSelectOne
            ->whereId(1020)
            ->__invoke();
        $this->assertTrue(is_array($data));

        $this->assertEquals(
            'SELECT goods.* FROM goods WHERE goods.id=:id ',
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    //带where + 排序
    public function test2()
    {
        $goodsSelectOne = new GoodsSelectAll();

        $data = $goodsSelectOne
            ->whereId(1061)
            ->orderIdDesc()
            ->__invoke();

        $this->assertTrue(is_array($data));

        $this->assertEquals(
            'SELECT goods.* FROM goods WHERE goods.id=:id Order By goods.id DESC ',
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    public function testMaybe()
    {
        $a=(new GoodsSelectAll())
            ->whereNameMaybe('123')
            ->whereIdMaybe(null)
            ->setDebug(true)
            ->__invoke();
        echo "<pre>-->";print_r($a);echo "<--@in ".__FILE__." on line ".__LINE__."\n";
    }

}

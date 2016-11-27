<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:01.
 */
namespace tests\Demo;

use setup\doc\GoodsSelectOne;

/**
 * out:验证普通的sql查询
 * Class selectOne.
 */
class SelectOneTest extends \PHPUnit_Framework_TestCase
{
    // 带where条件, like 查询
    public function test0()
    {
        $goodsSelectOne = new GoodsSelectOne();

        $data = $goodsSelectOne
            ->setSQL('id like :id', ['id' => '120%'])
            ->setSQL('id>1')
            ->__invoke();
        //返回的数据结构是 GoodsModel 类实体
        $this->assertTrue(is_a($data, \setup\doc\GoodsModel::class));

        $this->assertEquals(
            'SELECT goods.* FROM goods WHERE id like :id AND id>1 ',
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

        $this->assertEquals(
            'SELECT goods.* FROM goods WHERE goods.id=:id ',
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
            'SELECT goods.* FROM goods WHERE goods.id=:id Order By goods.id DESC ',
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }
}

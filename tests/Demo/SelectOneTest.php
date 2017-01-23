<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:01.
 */
namespace xltxlm\orm\tests\Demo;

use setup\Doc\GoodsModel;
use setup\Doc\GoodsSelectOne;

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
        $this->assertTrue(is_a($data, GoodsModel::class));

        $this->assertEquals(
            'SELECT goods.* FROM goods WHERE id like :id AND id>1 ',
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    // 带where条件, 赋值判断
    public function test1()
    {
        $goodsSelectOne = new GoodsSelectOne();

        $id = 1061;
        $data = $goodsSelectOne
            ->whereId($id)
            ->__invoke();
        $this->assertTrue(is_a($data, GoodsModel::class));

        $id = md5(serialize([$id]));
        $this->assertEquals(
            "SELECT goods.* FROM goods WHERE goods.id=:id$id ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    //带where + 排序
    public function test2()
    {
        $goodsSelectOne = new GoodsSelectOne();

        $id = 1061;
        $data = $goodsSelectOne
            ->whereId($id)
            ->orderIdDesc()
            ->__invoke();
        $id = md5(serialize([$id]));
        $this->assertTrue(is_a($data, GoodsModel::class));

        $this->assertEquals(
            "SELECT goods.* FROM goods WHERE goods.id=:id$id Order By goods.id DESC ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }
}

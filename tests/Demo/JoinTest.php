<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 2:19
 */

namespace Demo;

use PHPUnit\Framework\TestCase;
use setup\doc\Goods_logsModel;
use setup\doc\Goods_logsSelectOne;
use setup\doc\GoodsModel;

/**
 * 联合表进行查询
 * Class JoinTest
 * @package Demo
 */
class JoinTest extends TestCase
{

    /**
     * 双表联合查询，默认返回从表的数据结构，如果需要主表的结构，用 getTable[table] 方法
     * @test
     */
    public function test()
    {
        $Goods_logsSelectOneObject = (new Goods_logsSelectOne())
            ->joinOnGoodsByidAndname()
            ->setId(2);

        $Goods_logsModel = $Goods_logsSelectOneObject
            ->__invoke();

        $this->assertEquals(Goods_logsModel::class, get_class($Goods_logsModel));

        //获取关联表的数据
        $goodsModel = $Goods_logsSelectOneObject->getTableGoods();
        $this->assertEquals(GoodsModel::class, get_class($goodsModel));
    }
}
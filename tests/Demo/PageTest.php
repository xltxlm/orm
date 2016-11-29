<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:26.
 */

namespace Demo;

use setup\Doc\GoodsModel;
use setup\Doc\GoodsPage;

class PageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * 带 where 条件,非赋值查询.
     */
    public function test1()
    {
        $goodsSelectOne = new GoodsPage();

        $data = $goodsSelectOne
            ->setSQL('id>=:id', ['id' => 1200])
            ->setPageID(2)
            ->setPrepage(3)
            ->__invoke();

        $this->assertTrue(is_array($data));
        $this->assertEquals(GoodsModel::class, get_class(current($data)));

        $this->assertEquals(
            'SELECT * FROM goods WHERE id>=:id  LIMIT 3, 3 ',
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );

        $this->assertEquals($goodsSelectOne->getPageObject()->getPrepage(), 3);
        $this->assertEquals($goodsSelectOne->getPageObject()->getPageID(), 2);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:26.
 */

namespace xltxlm\orm\tests\Demo;

use setup\Doc\GoodsModel;
use setup\Doc\GoodsPage;
use xltxlm\page\PageObject;

class PageTest extends \PHPUnit_Framework_TestCase
{
    private $pageObject;

    protected function setUp()
    {
        $this->pageObject = (new PageObject())
            ->setPageID(2)
            ->setPrepage(3);
    }

    /**
     * 带 where 条件,非赋值查询.
     */
    public function test1()
    {
        $goodsPage = new GoodsPage();

        $data = $goodsPage
            ->setSQL('id>=:id', ['id' => 1])
            ->setPageObject($this->pageObject)
            ->__invoke();

        $this->assertTrue(is_array($data));
        $this->assertEquals(GoodsModel::class, get_class(current($data)));

        $this->assertEquals(
            'SELECT * FROM goods WHERE id>=:id  limit 3,3',
            $goodsPage->getPdoInterface()->getSqlParserd()->getSql()
        );

        $this->assertEquals($goodsPage->getPageObject()->getPrepage(), 3);
        $this->assertEquals($goodsPage->getPageObject()->getPageID(), 2);
    }

    /**
     * 根据传递的字段，进行查询。如果字段值没传递=null，那就不查询
     * 只支持 字符串，数字类型的查询.
     */
    public function testmabey()
    {
        //查询结果只有单条
        $goodsPage = new GoodsPage();
        $data = $goodsPage
            ->setSQL('id=:id', ['id' => 10])
            ->whereNameMaybe('商品名称-10')
            ->setDebug(true)
            ->setPageObject($this->pageObject)
            ->__invoke();
        $this->assertEquals(1, count($data));

        //查询结果又多条
        $data = (new GoodsPage())
            ->whereNameMaybe(null)
            ->setPageObject($this->pageObject)
            ->__invoke();
        $this->assertGreaterThan(1, count($data));
    }
}

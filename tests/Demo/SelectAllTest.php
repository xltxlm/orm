<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 8:01.
 */
namespace xltxlm\orm\tests\Demo;

use PHPUnit\Framework\TestCase;
use setup\Doc\GoodsSelectAll;
use xltxlm\ormTool\Template\PdoAction;

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

        $id = 1020;
        $data = $goodsSelectOne
            ->whereId($id)
            ->__invoke();
        $this->assertTrue(is_array($data));

        $id = md5(serialize([$id]));
        $this->assertEquals(
            "SELECT goods.* FROM goods WHERE goods.id=:id$id ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    //带where + 排序
    public function test2()
    {
        $goodsSelectOne = new GoodsSelectAll();

        $id = 1061;
        $data = $goodsSelectOne
            ->whereId($id)
            ->orderIdDesc()
            ->__invoke();

        $id = md5(serialize([$id]));
        $this->assertTrue(is_array($data));

        $this->assertEquals(
            "SELECT goods.* FROM goods WHERE goods.id=:id$id Order By goods.id DESC ",
            $goodsSelectOne->getPdoInterface()->getSqlParserd()->getSql()
        );
    }

    public function testMaybe()
    {
        $name = '123';
        $GoodsSelectAll = (new GoodsSelectAll())
            ->whereNameMaybe($name)
            ->whereStatusMaybe('')
            ->whereIdMaybe(null);
        $name = md5(serialize([$name]));
        $GoodsSelectAll
            ->__invoke();
        $sql = $GoodsSelectAll->getPdoInterface()->getSqlParserd()->getSql();
        $this->assertEquals("SELECT goods.* FROM goods WHERE goods.name=:name$name ", $sql);
    }

}

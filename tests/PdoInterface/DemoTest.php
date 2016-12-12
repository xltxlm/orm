<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 11:27.
 */

namespace xltxlm\orm\tests\PdoInterface;

use setup\Doc;
use xltxlm\orm\PageObject;
use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

class DemoTest extends \PHPUnit_Framework_TestCase
{
    //最普通的查询:不带参数
    public function test0()
    {
        $SqlParserd = (new SqlParser())
            ->setSql('select * from goods where id=1060  ')
            ->__invoke();
        /** @var \xltxlm\orm\tests\PdoInterface\DataModel $data */
        $data = (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setClassName(\xltxlm\orm\tests\PdoInterface\DataModel::class)
            ->setSqlParserd($SqlParserd)
            ->selectOne();

        $this->assertTrue(is_a($data, \xltxlm\orm\tests\PdoInterface\DataModel::class));
    }

    //最普通的查询:带参数
    public function test1()
    {
        $SqlParserd = (new SqlParser())
            ->setSql('select * from goods where id=:id ')
            ->setBind(
                [
                    'id' => 1006,
                ]
            )
            ->__invoke();
        /** @var \xltxlm\orm\tests\PdoInterface\DataModel $data */
        $data = (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setClassName(\xltxlm\orm\tests\PdoInterface\DataModel::class)
            ->setSqlParserd($SqlParserd)
            ->selectOne();
        $this->assertEquals(\xltxlm\orm\tests\PdoInterface\DataModel::class, get_class($data));
    }

    //最普通的查询 + 绑定多个参数 + 其中某个参数值是数组,改变原来的sql结构
    //返回多个结果
    public function test2()
    {
        $SqlParserd = (new SqlParser())
            ->setSql('select * from goods where id=:id and name<>:name ')
            ->setBind(
                [
                    'id' => [1, 2],
                    'name' => 'noname',
                ]
            )
            ->__invoke();

        /** @var \xltxlm\orm\tests\PdoInterface\DataModel[] $data */
        $data = (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setClassName(\xltxlm\orm\tests\PdoInterface\DataModel::class)
            ->setSqlParserd($SqlParserd)
            ->selectAll();

        $this->assertEquals(\xltxlm\orm\tests\PdoInterface\DataModel::class, get_class($data[0]));
    }

    //普通查询: 带分页效果
    public function test3()
    {
        $sql = 'select * from goods where id>:id  order by id ';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'id' => 1,
                ]
            )
            ->__invoke();
        /* @var \xltxlm\orm\tests\PdoInterface\DataModel[] $data */
        $pageObject = (new PageObject())
            ->setPageID(4)
            ->setPrepage(3);
        $data = (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setSqlParserd($SqlParserd)
            ->setClassName(\xltxlm\orm\tests\PdoInterface\DataModel::class)
            ->page($pageObject);

        $this->assertTrue(is_array($data));
        $this->assertEquals(count($data), 3);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:11.
 */
namespace xltxlm\orm\tests\PdoInterface;

use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;
use setup\Doc;

/**
 * Class MissModel.
 */
class MissModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * 查询时候,不指定model类,不予返回结果.
     * @expectedException  \xltxlm\orm\Exception\PdoInterfaceException
     */
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
        $data = (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setSqlParserd($SqlParserd)
            ->selectVar();
        echo '<pre>-->';
        print_r($data);
        echo '<--@in '.__FILE__.' on line '.__LINE__."\n";
    }

    // update 查询不带上 where 条件,抛异常
    public function test2()
    {
        $this->expectException(\xltxlm\orm\Exception\PdoInterfaceException::class);
        $sql = 'update goods set name=:name ';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'name' => 'abc',
                ]
            )
            ->__invoke();

        (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setSqlParserd($SqlParserd)
            ->update();
    }

    /**
     * @expectedException  \Exception
     */
    public function testsqlerrorlog()
    {
        $sql = 'update goodsxxx set name=:name ';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'name' => 'abc',
                ]
            )
            ->__invoke();

        (new PdoInterface())
            ->setPdoConfig((new Doc()))
            ->setSqlParserd($SqlParserd)
            ->execute();
    }

}

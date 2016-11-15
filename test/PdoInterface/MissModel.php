<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:11.
 */
namespace PdoInterface;

use Orm\PdoInterface;
use Orm\Sql\SqlParser;
use setup\doc;

/**
 * Class MissModel.
 */
class MissModel extends \PHPUnit_Framework_TestCase
{
    /**
     * 查询时候,不指定model类,不予返回结果.
     */
    public function test1()
    {
        $this->expectException(\Orm\Exception\PdoInterfaceException::class);

        $SqlParserd = (new SqlParser())
            ->setSql('select * from goods where id=:id ')
            ->setBind(
                [
                    'id' => 1006,
                ]
            )
            ->__invoke();
        $data = (new PdoInterface())
            ->setPdoConfig((new doc()))
            ->setSqlParserd($SqlParserd)
            ->selectVar();
        echo '<pre>-->';
        print_r($data);
        echo '<--@in '.__FILE__.' on line '.__LINE__."\n";
    }

    // update 查询不带上 where 条件,抛异常
    public function test2()
    {
        $this->expectException(\Orm\Exception\PdoInterfaceException::class);
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
            ->setPdoConfig((new doc()))
            ->setSqlParserd($SqlParserd)
            ->update();
    }
}

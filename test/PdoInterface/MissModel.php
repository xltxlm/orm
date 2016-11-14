<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:11
 */

namespace PdoInterface;

use Orm\PdoInterface;
use Orm\SqlParser;
use setup\doc;

/**
 * Class MissModel
 * @package PdoInterface
 */
class MissModel extends \PHPUnit_Framework_TestCase
{

    /**
     * 查询时候,确认model类,不予返回结果
     */
    public function test1()
    {
        $this->expectException(\Orm\Exception\PdoInterfaceException::class);

        $SqlParserd = (new SqlParser())
            ->setSql("select * from goods where id=:id ")
            ->setBind(
                [
                    'id' => 1006
                ]
            )
            ->__invoke();
        $data = (new PdoInterface())
            ->setPdoObject(
                (new doc())
                    ->instanceSelf()
            )
            ->setSqlParserd($SqlParserd)
            ->selectVar();
        echo "<pre>-->";
        print_r($data);
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";
    }
}

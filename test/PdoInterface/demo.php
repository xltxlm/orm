<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 11:27
 */

namespace test\PdoInterface;

use \Orm\PdoInterface;
use \Orm\SqlParser;
use \setup\doc;

class demo extends \PHPUnit_Framework_TestCase
{

    public function test0()
    {
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
            ->setClassName(\test\PdoInterface\data::class)
            ->setSqlParserd($SqlParserd)
            ->setDebug(true)
            ->selectVar();
        echo "<pre>-->";
        print_r($data);
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";
    }

    public function test1()
    {
        $SqlParserd = (new SqlParser())
            ->setSql("select * from goods where id=:id ")
            ->setBind(
                [
                    'id' => 1006
                ]
            )
            ->__invoke();
        /** @var  \test\PdoInterface\data $data */
        $data = (new PdoInterface())
            ->setPdoObject(
                (new doc())
                    ->instanceSelf()
            )
            ->setClassName(\test\PdoInterface\data::class)
            ->setSqlParserd($SqlParserd)
            ->selectOne();
        echo "<pre>-->";
        print_r($data);
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";

        echo "<pre>-->";
        print_r($data->getName());
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";
    }

    public function test2()
    {
        $SqlParserd = (new SqlParser())
            ->setSql("select * from goods where id=:id and name<>:name")
            ->setBind(
                [
                    'id' => [1006, 1016],
                    'name' => 'noname'
                ]
            )
            ->__invoke();
        /** @var  \test\PdoInterface\data[] $data */
        $data = (new PdoInterface())
            ->setPdoObject(
                (new doc())
                    ->instanceSelf()
            )
            ->setClassName(\test\PdoInterface\data::class)
            ->setSqlParserd($SqlParserd)
            ->setDebug(true)
            ->selectAll();
        echo "<pre>-->";
        print_r($data);
        echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";

        foreach ($data as $item) {
            echo "<pre>-->";
            print_r($item->getName());
            echo "<--@in " . __FILE__ . " on line " . __LINE__ . "\n";
        }
    }
}

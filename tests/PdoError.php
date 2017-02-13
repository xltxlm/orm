<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/2/13
 * Time: 11:00
 */

namespace xltxlm\orm;


use PHPUnit\Framework\TestCase;
use setup\Doc;

class PdoError extends TestCase
{

    public function test()
    {
        $data=(new PdoInterfaceEasy("select now()"))
            ->setPdoConfig(new Doc)
            ->selectOne();
        echo "<pre>-->";print_r($data);echo "<--@in ".__FILE__." on line ".__LINE__."\n";
    }
}
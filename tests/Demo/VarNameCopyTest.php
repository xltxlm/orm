<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/1/23
 * Time: 13:59
 */

namespace xltxlm\orm\tests\Demo;


use PHPUnit\Framework\TestCase;
use setup\Doc\GoodsCopy;

class VarNameCopyTest extends TestCase
{

    public function test()
    {
        $this->assertEquals(GoodsCopy::used(), 'used');
    }
}
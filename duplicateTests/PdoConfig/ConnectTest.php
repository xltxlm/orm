<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-29
 * Time: 下午 5:40.
 */

namespace PdoConfig;

use xltxlm\orm\Config\PdoConfig;
use PHPUnit\Framework\TestCase;
use setup\Doc;

/**
 * 测试同一进程多次请求，是否会重复链接
 * Class ConnectTest.
 */
class ConnectTest extends TestCase
{
    public function test()
    {
        PdoConfig::clearInstance();
        $i = 0;
        while ($i++ < 10) {
            (new Doc())
            ->instanceSelf();
        }
        $this->assertEquals(1, count(PdoConfig::getInstance()));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-30
 * Time: 下午 1:39.
 */

namespace tests\Jmeter;

use PHPUnit\Framework\TestCase;
use xltxlm\Jmeter\Maker;

class JmeterMakerTest extends TestCase
{
    public function testplan1()
    {
        (new Maker())
            ->setJmeterConfig(new Jmeter())
            ->setJmeterUnitDir(dirname(__DIR__))
            ->__invoke();
    }
}

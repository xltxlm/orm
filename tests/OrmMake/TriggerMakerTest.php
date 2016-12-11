<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 下午 6:06.
 */

namespace xltxlm\orm\tests\OrmMake;

use demo\setup\Doclog;
use xltxlm\ormTool\TriggerMaker;
use PHPUnit\Framework\TestCase;
use setup\Doc;

class TriggerMakerTest extends TestCase
{
    public function test()
    {
        (new TriggerMaker())
            ->setOriginalDB(new Doc())
            ->setLogDB(new Doclog())
            ->__invoke();
    }
}

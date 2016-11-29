<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 下午 6:06.
 */

namespace OrmMake;

use demo\setup\Doclog;
use OrmTool\TriggerMaker;
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

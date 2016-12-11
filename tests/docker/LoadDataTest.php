<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-11
 * Time: 下午 3:45.
 */

namespace tests\docker;

use PHPUnit\Framework\TestCase;
use setup\Doc\enum\EnumGoodsStatus;
use setup\Doc\GoodsInsert;

class LoadDataTest extends TestCase
{
    public function test1()
    {
        $status = [
            EnumGoodsStatus::DAI_CHU_LI,
            EnumGoodsStatus::SHANG_JIA,
            EnumGoodsStatus::XIA_JIA,
        ];
        for ($i = 1; $i <= 100; ++$i) {
            $name = '商品名称-'.$i;
            (new GoodsInsert())
                ->setName($name)
                ->setTotal($i)
                ->setUsed(0)
                ->setStatus($status[rand(0, 2)])
                ->__invoke();
        }
    }
}

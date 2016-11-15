<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:16.
 */
namespace sqlParser;

use Orm\Exception\SqlParserException;
use Orm\I18N\I18N;
use Orm\SqlParser;

/**
 * out:当sql绑定参数缺少的时候
 * 另外演示了如何切换报错语言
 * Class MissBind.
 */
class MissBind extends \PHPUnit_Framework_TestCase
{
    /**
     * 缺少绑定变量.
     */
    public function test1()
    {
        $this->expectException(SqlParserException::class);

        I18N::setLang(I18N::EN);
        $sql = 'select * from goods where id=:id and name=:name ';
        (new SqlParser())
            ->setSql($sql)
            ->setBind([
                'id' => 1,
            ])
            ->__invoke();
    }

    /**
     * 绑定的参数不一致.
     */
    public function test2()
    {
        $this->expectException(SqlParserException::class);

        I18N::setLang(I18N::CH);
        $sql = 'select * from goods where id=:id and name=:name ';
        (new SqlParser())
            ->setSql($sql)
            ->setBind([
                'id' => 1,
                'dd' => 'dd',
            ])
            ->__invoke();
    }
}

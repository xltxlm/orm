<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 11:44.
 */
namespace xltxlm\orm\tests\SqlParser;

use xltxlm\orm\Sql\SqlParser;

/**
 * out: 1.正常的绑定变量方式
 *      2.数组方式绑定
 *      3.null 绑定.
 *
 * Class normal
 */
class NormalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * 演示最常规的绑定.
     */
    public function test1()
    {
        $sql = 'select * from goods where id=:id and name=:name ';
        (new SqlParser())
            ->setSql($sql)
            ->setBind([
                'id' => 1,
                'name' => 'name',
            ])
            ->__invoke();
    }

    /**
     * 绑定的顺序和sql的顺序可以不一致.内容一致即可.
     */
    public function test2()
    {
        $sql = 'select * from goods where id=:id and name=:name ';
        (new SqlParser())
            ->setSql($sql)
            ->setBind([
                'name' => 'name',
                'id' => 1,
            ])
            ->__invoke();
    }

    /**
     * 绑定值可以为数组,原始sql会被改动.
     */
    public function test3()
    {
        $sql = 'select * from goods where id=:id and name=:name';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind([
                'name' => 'name',
                'id' => [1, 2, 3],
            ])
            ->__invoke();
        $this->assertEquals(
            'select * from goods where id IN (:id_0,:id_1,:id_2 ) and name=:name ',
            $SqlParserd->getSql()
        );
    }

    /**
     * 绑定值可以是null,原始sql会被改动.
     */
    public function test4()
    {
        $sql = 'select * from goods where id=:id and name=:name';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind([
                'name' => null,
                'id' => [1, 2, 3],
            ])
            ->__invoke();
        $this->assertEquals(
            'select * from goods where id IN (:id_0,:id_1,:id_2 ) and name IS NULL ',
            $SqlParserd->getSql()
        );
    }

    public function test5()
    {
        $sql = "select 
        VideoInfo.videoId,VideoInfo.title,VideoInfo.playNum,VideoInfo.addTime,VideoInfo.videoId
        UserBasicInfo.nickName
        from VideoInfo
        left join UserBasicInfo on (VideoInfo=userId=UserBasicInfo.userId)
        where source='upload' and nickName=:nickName
        and cc=:cc";
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(['cc' => 1, 'nickName' => 2])
            ->__invoke();
    }

    /**
     * 一个key重复2次
     */
    public function test6()
    {
        $sql = 'update audit set username=:username ,
              audit_username_status=:audit_username_status where 
               contentId =:contentId and audit_username_status=:audit_username_status2 and ( username=:username or username="")  ';
        (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'username' => __LINE__,
                    'audit_username_status' => __LINE__,
                    'audit_username_status2' => __LINE__,
                    'contentId' => __LINE__,
                ]
            );
    }


}

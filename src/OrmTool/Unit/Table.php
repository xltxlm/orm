<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-12
 * Time: 上午 11:43
 */

namespace OrmTool\Unit;

/**
 * output:table的各种定义获取
 * Class table
 * @package toolsdk\dborm
 */
final class Table
{
    const MYISAM = "Myisam";
    const INNODB = "InnoDB";

    /** @var  \OrmTool\Unit\Db 所属的数据库类 */
    protected $db;
    /** @var string 表格的名称 */
    protected $name = "";
    /** @var string 表格的描述 */
    protected $comment = "";
    /** @var \OrmTool\Unit\Field[] 字段 */
    protected $field = [];
    /** @var string 数据库的类型引擎 */
    protected $type = self::INNODB;
}

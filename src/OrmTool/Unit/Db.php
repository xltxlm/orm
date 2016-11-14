<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-12
 * Time: 下午 12:33
 */

namespace OrmTool\Unit;

/**
 * output:数据库的各项配置
 * Class db
 * @package toolsdk\dborm
 */
final class Db
{
    /** @var \PDO 数据库的链接句柄 */
    protected $pdo = "";
    /** @var \OrmTool\Unit\Table[] 表格列表 */
    protected $table = [];
}

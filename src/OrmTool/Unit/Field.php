<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-12
 * Time: 上午 11:45
 */

namespace OrmTool\Unit;

/**
 * 一个表的字段描述
 * Class field
 * @package toolsdk\dborm
 */
final class Field
{
    const VARCHAR = "varchar";
    const INT = "int";
    const FLOAT = "float";
    const BIGINT = "bigint";
    const TEXT = "text";
    const DATE = "date";
    const TIME = "time";
    const MEDIUMTEXT = "mediumtext";
    const TINYINT = "tinyint";
    const TIMESTAMP = "timestamp";
    const LONGTEXT = "longtext";
    const DATETIME = "datetime";
    const DECIMAL = "decimal";
    const ENUM = "enum";

    /** @var  \OrmTool\Unit\Table 表格实例 */
    protected $table;
    /** @var string 字段的描述 */
    protected $comment = "";
    /** @var string 字段的名称 */
    protected $name = "";
    /** @var string 字段的类型定义 */
    protected $type = self::VARCHAR;
}

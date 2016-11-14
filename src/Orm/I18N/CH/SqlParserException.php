<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:53
 */

namespace Orm\I18N\CH;

/**
 * Class SqlParserException
 * @package orm\I18N\CH
 */
class SqlParserException extends \Orm\I18N\SqlParserException
{
    public $bindError = "绑定参数不对称,sql要求绑定:%s,实际绑定:%s";
}

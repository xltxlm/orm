<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:55
 */

namespace Orm\I18N\EN;

/**
 * Class SqlParserException
 * @package orm\I18N\EN
 */
class SqlParserException extends \Orm\I18N\CH\SqlParserException
{
    public $bindError = "binds pairs error,need:%s,actually:%s";
}

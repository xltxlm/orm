<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:55.
 */
namespace Orm\Exception\I18N\EN;

/**
 * Class SqlParserException.
 */
class SqlParserI18N extends \Orm\Exception\I18N\CH\SqlParserI18N
{
    public $bindError = 'binds pairs error,need:%s,actually:%s';
}
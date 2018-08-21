<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:55.
 */
namespace xltxlm\orm\Exception\I18N\EN;

/**
 * Class SqlParserException.
 */
class SqlParserI18N extends \xltxlm\orm\Exception\I18N\CH\SqlParserI18N
{
    protected $bindError = 'binds pairs error,need:%s,actually:%s,binds:%s';
}

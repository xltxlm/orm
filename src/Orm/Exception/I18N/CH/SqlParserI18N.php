<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:53.
 */
namespace Orm\Exception\I18N\CH;

/**
 * Class SqlParserException.
 */
class SqlParserI18N extends \Orm\Exception\I18N\SqlParserI18N
{
    protected $bindError = '绑定参数不对称,sql要求绑定:%s,实际绑定:%s';
}

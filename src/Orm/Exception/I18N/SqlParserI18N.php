<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:47.
 */
namespace Orm\Exception\I18N;

/**
 * out:翻译
 * Class SqlParserException.
 */
class SqlParserI18N
{
    public $bindError;

    /**
     * @return string
     */
    public function getBindError()
    {
        return I18N::getVal();
    }
}

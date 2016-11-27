<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 上午 12:08
 */

namespace Orm\Exception\I18N;

/**
 * 文件系统可能产生的错误
 * Class File
 * @package Orm\Exception\I18N
 */
class File
{
    public $makeDirError;

    /**
     * @return mixed
     */
    public function getMakeDirError()
    {
        return I18N::getVal();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:06
 */

namespace Orm\I18N\CH;

/**
 * Class PdoInterface
 * @package Orm\I18N\CH
 */
class PdoInterface extends \Orm\I18N\PdoInterface
{
    public $missModel = "缺少Model类的支持,无法查询数据";
}

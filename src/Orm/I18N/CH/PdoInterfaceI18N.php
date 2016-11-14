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
class PdoInterfaceI18N extends \Orm\I18N\PdoInterfaceI18N
{
    public $missModel = "缺少Model类的支持,无法查询数据";
    public $updateNoWhere = "更新语句必须带上where条件";
}

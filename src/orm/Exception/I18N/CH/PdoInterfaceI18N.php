<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:06.
 */
namespace xltxlm\orm\Exception\I18N\CH;

/**
 * Class PdoInterface.
 */
class PdoInterfaceI18N extends \xltxlm\orm\Exception\I18N\PdoInterfaceI18N
{
    protected $missModel = '缺少Model类的支持,无法查询数据';
    protected $updateNoWhere = '更新语句必须带上where条件';
}

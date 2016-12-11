<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:07.
 */
namespace xltxlm\orm\Exception\I18N\EN;

/**
 * Class PdoInterface.
 */
class PdoInterfaceI18N extends \xltxlm\orm\Exception\I18N\CH\PdoInterfaceI18N
{
    protected $missModel = 'miss model class.';
    protected $updateNoWhere = 'UPDATE statement must bring where condition';
}

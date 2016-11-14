<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:05
 */

namespace Orm\I18N;

/**
 * Class PdoInterface
 * @package Orm\I18N
 */
class PdoInterfaceI18N
{
    public $missModel;
    public $updateNoWhere;

    /**
     * @return mixed
     */
    public function getMissModel()
    {
        return I18N::getVal('missModel');
    }

    /**
     * @return mixed
     */
    public function getUpdateNoWhere()
    {
        return I18N::getVal('updateNoWhere');
    }
}

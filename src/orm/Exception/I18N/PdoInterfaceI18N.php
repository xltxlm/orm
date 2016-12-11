<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 1:05.
 */
namespace xltxlm\orm\Exception\I18N;

/**
 * Class PdoInterface.
 */
class PdoInterfaceI18N
{
    protected $missModel;
    protected $updateNoWhere;

    /**
     * @return mixed
     */
    public function getMissModel()
    {
        return I18N::getVal();
    }

    /**
     * @return mixed
     */
    public function getUpdateNoWhere()
    {
        return I18N::getVal();
    }
}

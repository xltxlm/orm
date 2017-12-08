<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/12/5
 * Time: 15:37
 */

namespace xltxlm\ormTool\Template;


abstract class UpdateMore
{
    protected $Model;
    protected $_UpdateFields = [];

    /**
     * @return array
     */
    public function get_UpdateFields(): array
    {
        return $this->_UpdateFields;
    }

    /**
     * @param array $UpdateFields
     * @return static
     */
    public function set_UpdateFields(array $UpdateFields)
    {
        $this->_UpdateFields = $UpdateFields;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * @param mixed $Model
     * @return UpdateMore
     */
    public function setModel($Model)
    {
        $this->Model = $Model;
        return $this;
    }

    abstract public function __invoke();

}
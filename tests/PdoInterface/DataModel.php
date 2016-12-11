<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 11:38.
 */
namespace xltxlm\orm\tests\PdoInterface;

/**
 * Class data.
 */
class DataModel
{
    protected $name;
    protected $id;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return DataModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return DataModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/11/27
 * Time: 13:42
 */

namespace xltxlm\ormTool\Template;

/**
 * 写入数据的时候，统一执行的操作
 * Class InsertMore
 * @package kuaigeng\kkreview\vendor\xltxlm\orm\src\ormTool\Template
 */
abstract class InsertMore
{
    protected $Model;
    /** @var int 新增的数据id */
    protected $insertID = 0;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * @param mixed $Model
     * @return InsertMore
     */
    public function setModel($Model)
    {
        $this->Model = $Model;
        return $this;
    }


    /**
     * @return int
     */
    public function getInsertID(): int
    {
        return $this->insertID;
    }

    /**
     * @param int $insertID
     * @return static
     */
    public function setInsertID(int $insertID)
    {
        $this->insertID = $insertID;
        return $this;
    }

    //执行操作
    abstract public function __invoke();
}

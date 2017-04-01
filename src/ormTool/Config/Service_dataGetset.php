<?php

namespace xltxlm\ormTool\Config;

use xltxlm\helper\BasicType;

/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait Service_dataGetset
{

    /**
    * 从数据库设置默认值
    */
    public function default()
    {
        return $this;
    }

    /**
    * out:自增id int(11)
    * @return BasicType
    */
    public function getId()
    {
        return new BasicType($this->id);
    }

    /**
    * out:自增id
    * @param mixed $id
    * @return $this
    */
    public function setId($id)
    {
        $this->id = new BasicType($id);
        return $this;
    }
        /**
    * out:日期 date
    * @return BasicType
    */
    public function getDt()
    {
        return new BasicType($this->dt);
    }

    /**
    * out:日期
    * @param mixed $dt
    * @return $this
    */
    public function setDt($dt)
    {
        $this->dt = new BasicType($dt);
        return $this;
    }
        /**
    * out:服务名称 varchar(100)
    * @return BasicType
    */
    public function getServicename()
    {
        return new BasicType($this->servicename);
    }

    /**
    * out:服务名称
    * @param mixed $servicename
    * @return $this
    */
    public function setServicename($servicename)
    {
        $this->servicename = new BasicType($servicename);
        return $this;
    }
        /**
    * out:进程名字 varchar(100)
    * @return BasicType
    */
    public function getProcess()
    {
        return new BasicType($this->process);
    }

    /**
    * out:进程名字
    * @param mixed $process
    * @return $this
    */
    public function setProcess($process)
    {
        $this->process = new BasicType($process);
        return $this;
    }
        /**
    * out:数值 int(11) unsigned
    * @return BasicType
    */
    public function getNum()
    {
        return new BasicType($this->num);
    }

    /**
    * out:数值
    * @param mixed $num
    * @return $this
    */
    public function setNum($num)
    {
        $this->num = new BasicType($num);
        return $this;
    }
    
    /**
     * 魔术函数直接取内容 getxx
     */
    public function __call($name,$arguments)
    {
        $function = lcfirst(substr($name, 3));
        return $this->$function;
    }

}

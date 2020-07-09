<?php
namespace xltxlm\orm\orm\PdoInterface;

/**
 * :类;
 * 请求数据库的接口，包括查询，更新，直接运行sql语句;
*/
abstract class PdoInterface_implements
{


/* @var bool  是否开启调试，打印日志 */
    protected $debug = false;
    




    /**
    * 是否开启调试，打印日志;
    * @return bool;
    */
            public function getdebug():bool        {
                return $this->debug;
        }

    
            public function isdebug():bool        {
        return $this->getdebug();
        }
    




/**
* @param bool $debug;
* @return $this
*/
    public function setdebug(bool $debug  = false)
    {
    $this->debug = $debug;
    return $this;
    }



/* @var bool  继承上次查询的事务 */
    protected $buff = false;
    




    /**
    * 继承上次查询的事务;
    * @return bool;
    */
            public function getbuff():bool        {
                return $this->buff;
        }

    
            public function isbuff():bool        {
        return $this->getbuff();
        }
    




/**
* @param bool $buff;
* @return $this
*/
    public function setbuff(bool $buff  = false)
    {
    $this->buff = $buff;
    return $this;
    }



}
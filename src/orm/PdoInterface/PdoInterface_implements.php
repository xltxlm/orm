<?php
namespace xltxlm\orm\PdoInterface;

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



/* @var bool  继承上次查询的事务。
false:准备查询超级大数据，并且不开启事务 */
    protected $buff = true;
    




    /**
    * 继承上次查询的事务。
false:准备查询超级大数据，并且不开启事务;
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
    public function setbuff(bool $buff  = true)
    {
    $this->buff = $buff;
    return $this;
    }



/* @var bool  返回结果转换成数组 */
    protected $convertToArray = false;
    




    /**
    * 返回结果转换成数组;
    * @return bool;
    */
            public function getconvertToArray():bool        {
                return $this->convertToArray;
        }

    
            public function isconvertToArray():bool        {
        return $this->getconvertToArray();
        }
    




/**
* @param bool $convertToArray;
* @return $this
*/
    abstract public function setconvertToArray(bool $convertToArray  = false);



/* @var string  返回的数据结构对象 */
    protected $className=\stdClass::class;





    /**
    * 返回的数据结构对象;
    * @return string;
    */
            public function getclassName():string        {
                return $this->className;
        }

    
    




/**
* @param string $className;
* @return $this
*/
    public function setclassName(string $className )
    {
    $this->className = $className;
    return $this;
    }



/**
*  生成日志记录对象，通用接口;
*  @return :\xltxlm\logger\LoggerTrack;
*/
abstract protected function getLogger():\xltxlm\logger\LoggerTrack;
}
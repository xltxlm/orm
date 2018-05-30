<?php
namespace Swoole;

/**
 * 请求Swoole数据库连接池;
*/
class Request{
    public function __construct( $pdoaction=null,string $callfunction=null)
    {
        if($pdoaction!==null)
        {
            $this->setpdoaction($pdoaction);
        }
        if($callfunction!==null)
        {
            $this->setcallfunction($callfunction);
        }
    }

    /* @var \xltxlm\ormTool\Template\PdoAction 数据库配置 */
    protected $pdoaction;

    /**
     * @return \xltxlm\ormTool\Template\PdoAction;
     */
    public function getpdoaction():\xltxlm\ormTool\Template\PdoAction    {
        return $this->pdoaction;
    }

    /**
     * @param string $pdoaction;
     * @return $this
     */
    public function setpdoaction( $pdoaction)
    {
        $this->pdoaction = $pdoaction;
        return $this;
    }

    /* @var string 需要调起的函数 */
    protected $callfunction;

    /**
     * @return string;
     */
    public function getcallfunction():string    {
        return $this->callfunction;
    }

    /**
     * @param string $callfunction;
     * @return $this
     */
    public function setcallfunction(string $callfunction)
    {
        $this->callfunction = $callfunction;
        return $this;
    }

}
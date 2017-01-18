<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-02
 * Time: 下午 4:01.
 */

namespace xltxlm\orm;

use xltxlm\orm\Config\PdoConfig;

/**
 * 返回原生的PDO客户端
 * Class PdoClient.
 */
final class PdoClient
{
    /** @var PdoConfig */
    protected $config;

    /**
     * @return PdoConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param PdoConfig $config
     *
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return \PDO
     */
    public function __invoke()
    {
        return $this->getConfig()->instanceSelf();
    }
}

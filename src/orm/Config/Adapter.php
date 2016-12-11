<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-29
 * Time: 下午 4:41.
 */

namespace xltxlm\orm\Config;

/**
 * 读写机器分配
 * Class Adapter.
 */
abstract class Adapter
{
    //读写定义
    const WRITE = __LINE__;
    const READ  = __LINE__;

    /** @var \xltxlm\orm\Config\PdoConfig 读写主服务器 */
    protected $WriteCOnfig;
    /** @var \xltxlm\orm\Config\PdoConfig[] 从服务器 */
    protected $readConfig = [];

    /**
     * @return PdoConfig
     */
    public function getWriteCOnfig(): PdoConfig
    {
        return $this->WriteCOnfig;
    }

    /**
     * @param PdoConfig $WriteCOnfig
     *
     * @return Adapter
     */
    public function setWriteCOnfig(PdoConfig $WriteCOnfig): Adapter
    {
        $this->WriteCOnfig = $WriteCOnfig;

        return $this;
    }

    /**
     * @return PdoConfig[]
     */
    public function getReadConfig(): array
    {
        return $this->readConfig;
    }

    /**
     * @param PdoConfig[] $readConfig
     *
     * @return Adapter
     */
    public function setReadConfig(array $readConfig): Adapter
    {
        $this->readConfig = $readConfig;

        return $this;
    }

    /**
     * 获取实例.
     *
     * @param int $action
     *
     * @return \PDO
     */
    public function instanceSelf($action = self::WRITE)
    {
        if ($action == self::WRITE) {
            return $this->getWriteCOnfig()->instanceSelf();
        } else {
            /** @var PdoConfig $array_rand */
            $array_rand = array_rand($this->getReadConfig());
            return $array_rand->instanceSelf();
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/1/20
 * Time: 14:59.
 */

namespace xltxlm\orm\Logger;

use xltxlm\logger\Log\BasicLog;
use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\PdoClient;

class PdoConnectLogger extends BasicLog
{
    /** @var PdoConfig */
    protected $pdoConfig;

    /**
     * PdoConnectLogger constructor.
     */
    public function __construct($pdoConfig = null)
    {
        parent::__construct();
        $this->setReource(PdoClient::class);
        if ($pdoConfig) {
            $this->setPdoConfig($pdoConfig);
        }
    }

    /**
     * @return PdoConfig
     */
    public function getPdoConfig(): PdoConfig
    {
        return $this->pdoConfig;
    }

    /**
     * @param PdoConfig $pdoConfig
     *
     * @return PdoConnectLogger
     */
    public function setPdoConfig(PdoConfig $pdoConfig): PdoConnectLogger
    {
        $this->pdoConfig = $pdoConfig;

        return $this;
    }
}

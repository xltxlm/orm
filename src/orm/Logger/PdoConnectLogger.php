<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/1/20
 * Time: 14:59
 */

namespace xltxlm\orm\Logger;

use xltxlm\logger\Log\DefineLog;
use xltxlm\orm\PdoClient;

class PdoConnectLogger extends DefineLog
{

    /**
     * PdoConnectLogger constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setReource(PdoClient::class);
    }
}

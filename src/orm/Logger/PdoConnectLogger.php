<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/1/20
 * Time: 14:59
 */

namespace xltxlm\orm\Logger;


use xltxlm\logger\Log\DefineLog;

final class PdoConnectLogger extends DefineLog
{

    /**
     * PdoConnectLogger constructor.
     */
    public function __construct()
    {
        parent::__construct();
        ob_start();
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $this->trace = ob_get_clean();
    }
}
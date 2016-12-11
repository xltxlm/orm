<?php

namespace xltxlm\orm\tests\Jmeter;

use xltxlm\Jmeter\Config\JmeterConfig;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-30
 * Time: 下午 1:38.
 */
class Jmeter extends JmeterConfig
{
    protected $binParth = 'C:\\Program Files\\apache-jmeter-3.1\\bin\\jmeter-n.cmd';
    protected $phpunit = 'D:\\360\\code\\php7\\phpunit.cmd';
    protected $autoload = __DIR__.'/../../vendor/autoload.php';
}

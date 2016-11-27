<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 12:18.
 */
namespace setup;

use Orm\Config\PdoConfig;

/**
 * 数据库的基础配置:账户密码等
 * Class doc.
 */
class Doc extends PdoConfig
{
    protected $driver = self::MYSQL;
    protected $TNS = '127.0.0.1';
    protected $db = 'doc';
    protected $username = 'root';
    protected $password = '';
}

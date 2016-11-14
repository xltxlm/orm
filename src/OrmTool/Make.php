<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 8:39
 */

namespace OrmTool;

use \Orm\Config\PdoConfig;

/**
 * out:把setup目录下的配置生成批量的配置类
 * Class make
 * @package toolsdk\dborm
 */
final class Make
{
    /** @var  pdoConfig */
    protected $dbConfig;

    public function __invoke()
    {
        //生成目录
        $ReflectionClass = new \ReflectionClass($this->dbConfig);
        $path = dirname($ReflectionClass->getFileName());
        mkdir($path . "/" . basename(get_class($this->dbConfig)));
    }
}

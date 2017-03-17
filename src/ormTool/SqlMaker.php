<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/3/17
 * Time: 12:34.
 */

namespace xltxlm\ormTool;

use xltxlm\helper\Ctroller\LoadClassRegister;
use xltxlm\orm\Config\PdoConfig;

/**
 * 根据sql文件+sql配置,生成定时任务的执行代码.
 * Class SqlMaker.
 */
final class SqlMaker
{
    use LoadClassRegister;

    protected $sqls = [];
    private $className = "";
    /** @var string 定时任务写入的文件夹 */
    protected $crontabDir = "";

    /** @var string */
    protected $sqlFile = '';

    /** @var PdoConfig 数据库配置文件 */
    protected $dbconfig;

    /**
     * @return array
     */
    public function getSqls(): array
    {
        return $this->sqls;
    }


    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }


    /**
     * @return string
     */
    public function getCrontabDir(): string
    {
        return $this->crontabDir;
    }

    /**
     * @param string $crontabDir
     * @return SqlMaker
     */
    public function setCrontabDir(string $crontabDir): SqlMaker
    {
        $this->crontabDir = $crontabDir;
        return $this;
    }


    /**
     * @return string
     */
    public function getSqlFile(): string
    {
        return $this->sqlFile;
    }

    /**
     * @param string $sqlFile
     *
     * @return SqlMaker
     */
    public function setSqlFile(string $sqlFile): SqlMaker
    {
        $this->sqlFile = $sqlFile;

        return $this;
    }

    /**
     * @return PdoConfig
     */
    public function getDbconfig(): PdoConfig
    {
        return $this->dbconfig;
    }

    /**
     * @param PdoConfig $dbconfig
     * @return SqlMaker
     */
    public function setDbconfig(PdoConfig $dbconfig): SqlMaker
    {
        $this->dbconfig = $dbconfig;
        return $this;
    }


    /**
     *
     */
    public function __invoke()
    {
        $sqldir = $this->getCrontabDir().'/SQL';
        mkdir($sqldir);
        $this->className = ucfirst(basename($this->getSqlFile(), '.sql'));

        preg_match_all('#--SQLBEGIN--(.*)--SQLEND--#iUs', file_get_contents($this->getSqlFile()), $out);

        $this->sqls = $out[1];

        ob_start();
        include __DIR__.'/../ormTool/Template/Model/SqlMaker.php';
        file_put_contents($sqldir.'/'.$this->className.'.php', ob_get_clean());
    }
}

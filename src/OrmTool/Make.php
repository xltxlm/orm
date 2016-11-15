<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 8:39.
 */
namespace OrmTool;

use Orm\Config\PdoConfig;
use Orm\PdoInterface;
use Orm\Sql\SqlParser;
use OrmTool\Unit\Table;

/**
 * out:把setup目录下的配置生成批量的配置类
 * Class make.
 */
final class Make
{
    /** @var PdoConfig */
    protected $dbConfig;

    protected $dbNameSpace = '';

    /**
     * @return string
     */
    public function getDbNameSpace(): string
    {
        return $this->dbNameSpace;
    }

    /**
     * @return PdoConfig
     */
    public function getDbConfig(): PdoConfig
    {
        return $this->dbConfig;
    }

    /**
     * @param PdoConfig $dbConfig
     *
     * @return Make
     */
    public function setDbConfig(PdoConfig $dbConfig): Make
    {
        $this->dbConfig = $dbConfig;

        return $this;
    }

    public function __invoke()
    {
        //生成目录
        $ReflectionClass = new \ReflectionClass($this->dbConfig);
        $path = dirname($ReflectionClass->getFileName()).'/'.basename(get_class($this->dbConfig));
        $this->dbNameSpace = $ReflectionClass->getNamespaceName();
        mkdir($path);
        mkdir($path."/enum/");

        //获取数据库的全部表列表
        $sql = 'SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=:TABLE_SCHEMA ';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'TABLE_SCHEMA' => $this->getDbConfig()->getDb(),
                ]
            )
            ->__invoke();
        /** @var \OrmTool\Unit\TableSchema[] $tables */
        $tables = (new PdoInterface())
            ->setPdoConfig($this->dbConfig)
            ->setSqlParserd($SqlParserd)
            ->setClassName(\OrmTool\Unit\TableSchema::class)
            ->selectAll();
        foreach ($tables as $table) {
            //表格定义
            ob_start();
            include __DIR__.'/Template/Model/Table.tpl.php';
            file_put_contents($path.'/'.ucfirst($table->getTABLENAME()).'.php', ob_get_clean());


            $fields = (new Table())
                ->setDbConfig($this->dbConfig)
                ->setName($table->getTABLENAME())
                ->getField();

            //基本表字段模型
            ob_start();
            include __DIR__.'/Template/Model/Model.tpl.php';
            file_put_contents($path.'/'.ucfirst($table->getTABLENAME()).'Model.php', ob_get_clean());

            //操作 - 一维查询
            $moreData = false;
            ob_start();
            include __DIR__.'/Template/Model/Select.tpl.php';
            file_put_contents($path.'/'.ucfirst($table->getTABLENAME()).'SelectOne.php', ob_get_clean());
            //操作 - 二维查询
            ob_start();
            $moreData = true;
            include __DIR__.'/Template/Model/Select.tpl.php';
            file_put_contents($path.'/'.ucfirst($table->getTABLENAME()).'SelectAll.php', ob_get_clean());
            //写入数据 模型
            ob_start();
            include __DIR__.'/Template/Model/Insert.tpl.php';
            file_put_contents($path.'/'.ucfirst($table->getTABLENAME()).'Insert.php', ob_get_clean());
            // 更新数据库操作
            ob_start();
            include __DIR__.'/Template/Model/Update.tpl.php';
            file_put_contents($path.'/'.ucfirst($table->getTABLENAME()).'Update.php', ob_get_clean());
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 8:39.
 */

namespace xltxlm\ormTool;

use xltxlm\elasticsearch\MakeTool\ElasticsearchMakeTool;
use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\Exception\FileException;
use xltxlm\orm\Exception\I18N\FileI18N;
use xltxlm\ormTool\Unit\DB;
use xltxlm\ormTool\Unit\FieldSchema;
use xltxlm\ormTool\Unit\Table;
use xltxlm\ormTool\Unit\TableSchema;

/**
 * out:把setup目录下的配置生成批量的配置类
 * Class make.
 */
final class OrmMaker
{
    /** @var PdoConfig */
    protected $dbConfig;

    private $dbNameSpace = '';

    /** @var array 只检出需要的表格来生成 */
    protected $needTableNames = [];

    /**
     * @return array
     */
    public function getNeedTableNames(): array
    {
        return $this->needTableNames;
    }

    /**
     * @param array $needTableNames
     * @return OrmMaker
     */
    public function setNeedTableNames(array $needTableNames): OrmMaker
    {
        $this->needTableNames = $needTableNames;
        return $this;
    }


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
     * @return OrmMaker
     */
    public function setDbConfig(PdoConfig $dbConfig): OrmMaker
    {
        $this->dbConfig = $dbConfig;

        return $this;
    }

    public function __invoke()
    {
        $allTable = $backupTables = [];
        //生成目录
        $ReflectionClass = new \ReflectionClass($this->dbConfig);
        $className = array_pop(explode('\\', get_class($this->dbConfig)));
        $path = dirname($ReflectionClass->getFileName()).'/'.$className;
        $this->dbNameSpace = $ReflectionClass->getNamespaceName().'\\'.$className;
        mkdir($path);
        if (!is_dir($path)) {
            throw new FileException(
                (new FileI18N())
                    ->getMakeDirError()
            );
        }
        mkdir($path.'/enum/');
        if (!is_dir($path.'/enum/')) {
            throw new FileException(
                (new FileI18N())
                    ->getMakeDirError()
            );
        }

        //获取数据库的全部表列表
        /** @var TableSchema[] $tableSchemas */
        $tableSchemas = (new DB())
            ->setDbConfig($this->dbConfig)
            ->__invoke();

        foreach ($tableSchemas as $tableSchema) {
            if ($tableSchema->getTABLENAME()[0] == '_') {
                continue;
            }
            $allTable[] = $tableSchema->getTABLENAME();
            if ($this->getNeedTableNames() && !in_array($tableSchema->getTABLENAME(), $this->getNeedTableNames())) {
                continue;
            }

            //记录下处理到的表名称,等下备份有用
            $backupTables[] = $tableSchema->getTABLENAME();

            //表格定义
            ob_start();
            include __DIR__.'/Template/Model/Table.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'.php', ob_get_clean());

            //字段列表
            $tableObject = (new Table())
                ->setDbConfig($this->dbConfig)
                ->setName($tableSchema->getTABLENAME());
            /** @var FieldSchema[] $fieldSchema */
            $fieldSchema = $tableObject
                ->getFieldSchemas();
            //外键列表
            $foreignKeys = $tableObject
                ->getForeignKey();

            //基本表字段模型
            ob_start();
            include __DIR__.'/Template/Model/Model.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Model.php', ob_get_clean());

            ob_start();
            include __DIR__.'/Template/Model/Base.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Base.php', ob_get_clean());

            ob_start();
            include __DIR__.'/Template/Model/Getset.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Getset.php', ob_get_clean());

            //操作 - 一维查询
            $moreData = false;
            ob_start();
            include __DIR__.'/Template/Model/Select.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'SelectOne.php', ob_get_clean());
            //操作 - 二维查询
            ob_start();
            $moreData = true;
            include __DIR__.'/Template/Model/Select.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'SelectAll.php', ob_get_clean());
            //操作 - 二维查询 - 带分页条
            ob_start();
            $pageClass = true;
            include __DIR__.'/Template/Model/Select.tpl.php';
            $pageClass = false;
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Page.php', ob_get_clean());
            //写入数据 模型
            ob_start();
            include __DIR__.'/Template/Model/Insert.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Insert.php', ob_get_clean());
            // 更新数据库操作
            ob_start();
            include __DIR__.'/Template/Model/Update.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Update.php', ob_get_clean());

            //字段类型
            ob_start();
            include __DIR__.'/Template/Model/Type.tpl.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Type.php', ob_get_clean());

            //elasticsearch.map
            ob_start();
            include __DIR__.'/Template/Model/elasticsearch.map.php';
            file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'ModelElasticsearchQuery.json', ob_get_clean());

            //生成 Elasticsearch 查询操作类
            (new ElasticsearchMakeTool())
                ->setClassNames($this->getDbNameSpace().'\\'.ucfirst($tableSchema->getTABLENAME()).'Model')
                ->__invoke();

            //枚举类型类
            foreach ($fieldSchema as $field) {
                if ($field->getDATATYPE() == FieldSchema::ENUM) {
                    ob_start();
                    include __DIR__.'/Template/Model/Enum.tpl.php';
                    file_put_contents(
                        $path.'/enum/Enum'.ucfirst($tableSchema->getTABLENAME()).
                        ucfirst($field->getCOLUMNNAME()).'.php',
                        ob_get_clean()
                    );
                }
            }
        }

        //生成deploy配置的 k=>v 格式
        $deploy = dirname(dirname($ReflectionClass->getFileName()))."/deployer/";
        mkdir($deploy);
        $nameSpaceArray = explode('\\', $this->getDbNameSpace());
        array_shift($nameSpaceArray);
        $projectName = array_shift($nameSpaceArray);
        $deploy = $deploy."/$projectName-deployer";
        mkdir($deploy);

        $DDL = $deploy."/DDL";
        mkdir($DDL);

        $deploy = $deploy."/db";
        mkdir($deploy);

        //备份出测试环境的数据结构
        $cmd = 'nohup mysqldump -d -h'.$this->getDbConfig()->getTNS().' -p'.$this->getDbConfig()->getPort().'  -u'.$this->getDbConfig()->getUsername().'  -p'.$this->getDbConfig()->getPassword().' -B '.$this->getDbConfig()->getDb().' --tables '.join(' ', $backupTables)." >$DDL/".$this->getDbConfig()->getDb().'.sql &';
        pclose(popen($cmd, 'r'));


        $HOST_TYPE = $_SERVER['HOST_TYPE'];
        foreach (['dev', 'online'] as $hostflag) {
            $_SERVER['HOST_TYPE'] = $hostflag;
            //模板里面使用的变量
            $PdoConfig = (new \ReflectionClass($this->getDbConfig()))->newInstance();
            $deploytype = $deploy."/$hostflag/";
            mkdir($deploytype);
            ob_start();
            include __DIR__.'/Template/Model/Deploy.php';
            file_put_contents($deploytype.$ReflectionClass->getShortName().'.env', ob_get_clean());
            mkdir($deploytype.$ReflectionClass->getShortName());

            foreach ($allTable as $backupTable) {
                ob_start();
                include __DIR__.'/Template/Model/MysqlCopy.php';
                file_put_contents($deploytype.$ReflectionClass->getShortName()."/$backupTable.cmd", ob_get_clean());
            }
        }
        $_SERVER['HOST_TYPE'] = $HOST_TYPE;
    }
}

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

    /** @var  TableSchema */
    protected $tableSchema;
    /** @var  Table */
    protected $tableObject;
    /** @var  FieldSchema */
    protected $field;

    /**
     * @return FieldSchema
     */
    public function getField(): FieldSchema
    {
        return $this->field;
    }

    /**
     * @param FieldSchema $field
     * @return OrmMaker
     */
    public function setField(FieldSchema $field): OrmMaker
    {
        $this->field = $field;
        return $this;
    }


    /**
     * @return Table
     */
    public function getTableObject()
    {
        return $this->tableObject;
    }

    /**
     * @param Table $tableObject
     * @return OrmMaker
     */
    public function setTableObject($tableObject)
    {
        $this->tableObject = $tableObject;
        return $this;
    }


    /**
     * @return TableSchema
     */
    public function getTableSchema(): TableSchema
    {
        return $this->tableSchema;
    }

    /**
     * @param TableSchema $tableSchema
     * @return OrmMaker
     */
    public function setTableSchema(TableSchema $tableSchema): OrmMaker
    {
        $this->tableSchema = $tableSchema;
        return $this;
    }


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
            $this->setTableSchema($tableSchema);
            //记录下处理到的表名称,等下备份有用
            $backupTables[] = $tableSchema->getTABLENAME();

            //表格定义
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'.php', __DIR__.'/Template/Model/Table.tpl.php');

            //字段列表
            $this->tableObject = (new Table())
                ->setDbConfig($this->dbConfig)
                ->setName($tableSchema->getTABLENAME());

            //基本表字段模型
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Model.php', __DIR__.'/Template/Model/Model.tpl.php');

            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Base.php', __DIR__.'/Template/Model/Base.tpl.php');

            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Getset.php', __DIR__.'/Template/Model/Getset.tpl.php');

            //操作 - 一维查询
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'SelectOne.php', __DIR__.'/Template/Model/Select.tpl.php');

            //操作 - 二维查询
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'SelectAll.php', __DIR__.'/Template/Model/Select.tpl.php', true);
            //操作 - 二维查询 - 带分页条
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Page.php', __DIR__.'/Template/Model/Select.tpl.php', true, true);

            //写入数据 模型
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Insert.php', __DIR__.'/Template/Model/Insert.tpl.php');
            // 更新数据库操作
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Update.php', __DIR__.'/Template/Model/Update.tpl.php');

            //字段类型
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'Type.php', __DIR__.'/Template/Model/Type.tpl.php');

            //elasticsearch.map
            $this->file_put_contents($path.'/'.ucfirst($tableSchema->getTABLENAME()).'ModelElasticsearchQuery.json', __DIR__.'/Template/Model/Elasticsearch.map.php');

            //生成 Elasticsearch 查询操作类
            (new ElasticsearchMakeTool())
                ->setClassNames($this->getDbNameSpace().'\\'.ucfirst($tableSchema->getTABLENAME()).'Model')
                ->__invoke();

            //枚举类型类
            foreach ($this->getTableObject()->getFieldSchemas() as $field) {
                $this->setField($field);
                if ($field->getDATATYPE() == FieldSchema::ENUM) {
                    $this->file_put_contents($path.'/enum/Enum'.ucfirst($tableSchema->getTABLENAME()).ucfirst($field->getCOLUMNNAME()).'.php', __DIR__.'/Template/Model/Enum.tpl.php');
                }
            }
        }

        //生成deploy配置的 k=>v 格式
        $deploy = dirname(dirname($ReflectionClass->getFileName()))."/deployer/";
        mkdir($deploy);

        $DDL = $deploy."/DDL";
        mkdir($DDL);

        $deploy = $deploy."/db";
        mkdir($deploy);

        //备份出测试环境的数据结构
        $cmd = 'nohup mysqldump -d --skip-triggers -h'.$this->getDbConfig()->getTNS().' -p'.$this->getDbConfig()->getPort().'  -u'.$this->getDbConfig()->getUsername().'  -p'.$this->getDbConfig()->getPassword().' -B '.$this->getDbConfig()->getDb().' --tables '.join(' ', $backupTables)." >/tmp/dump.sql && rsync -a /tmp/dump.sql $DDL/".$this->getDbConfig()->getDb().'.sql &';
        pclose(popen($cmd, 'r'));
        //线上线下数据结构对比
        $this->file_write_contents("$DDL/sysnc.".$ReflectionClass->getShortName().".table", 'export table="'.join(" ", $backupTables).'"');


        $HOST_TYPE = $_SERVER['HOST_TYPE'];
        foreach (['dev', 'online'] as $hostflag) {
            $_SERVER['HOST_TYPE'] = $hostflag;
            //模板里面使用的变量
            $PdoConfig = (new \ReflectionClass($this->getDbConfig()))->newInstance();
            $deploytype = $deploy."/$hostflag/";
            mkdir($deploytype);
            ob_start();
            include __DIR__.'/Template/Model/Deploy.php';
            $this->file_write_contents($deploytype.$ReflectionClass->getShortName().'.env', ob_get_clean());
            mkdir($deploytype.$ReflectionClass->getShortName());

            foreach ($allTable as $backupTable) {
                $this->file_put_contents($deploytype.$ReflectionClass->getShortName()."/$backupTable.cmd", __DIR__.'/Template/Model/MysqlCopy.php');
            }
        }
        $_SERVER['HOST_TYPE'] = $HOST_TYPE;
    }

    /**
     * @param $classRealFile
     * @param $templatePath
     */
    private function file_put_contents($classRealFile, $templatePath, $moreData = false, $pageClass = false)
    {
        ob_start();
        eval('include $templatePath;');
        $ob_get_clean = ob_get_clean();
        //1:先保证控制层的基准类一定存在
        if (!is_file($classRealFile) || file_get_contents($classRealFile) !== $ob_get_clean) {
            file_put_contents($classRealFile, $ob_get_clean);
        }
    }

    /**
     * @param $classRealFile
     * @param $templatePath
     */
    private function file_write_contents($classRealFile, $ob_get_clean)
    {
        //1:先保证控制层的基准类一定存在
        if (!is_file($classRealFile) || file_get_contents($classRealFile) !== $ob_get_clean) {
            file_put_contents($classRealFile, $ob_get_clean);
        }
    }
}

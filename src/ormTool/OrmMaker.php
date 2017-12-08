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

    /** @var string 当前项目所在的磁盘路径 */
    protected $ProjectPath = "";

    /**
     * @return string
     */
    public function getProjectPath(): string
    {
        return $this->ProjectPath;
    }

    /**
     * @param string $ProjectPath
     * @return OrmMaker
     */
    public function setProjectPath(string $ProjectPath): OrmMaker
    {
        $this->ProjectPath = $ProjectPath;
        return $this;
    }


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
        $allTable = [];
        //生成目录
        $ReflectionClass = new \ReflectionClass($this->dbConfig);
        $className = array_pop(explode('\\', get_class($this->dbConfig)));
        $path = dirname($ReflectionClass->getFileName()) . '/' . $className;
        $this->dbNameSpace = $ReflectionClass->getNamespaceName() . '\\' . $className;
        mkdir($path);
        if (!is_dir($path)) {
            throw new FileException(
                (new FileI18N())
                    ->getMakeDirError()
            );
        }
        mkdir($path . '/enum/');
        if (!is_dir($path . '/enum/')) {
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


            //字段列表
            $this->tableObject = (new Table())
                ->setDbConfig($this->dbConfig)
                ->setName($tableSchema->getTABLENAME());




            //生成表语法结构
            $ddl = $this->getTableObject()->getDdl();
            $ddl = preg_replace("#AUTO_INCREMENT=\d+ #", " ", $ddl);
            $this->file_write_contents($path . '/' . ucfirst($tableSchema->getTABLENAME()) . 'ddl.sql', $ddl);
        }
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

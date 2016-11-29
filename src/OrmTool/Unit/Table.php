<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-12
 * Time: 上午 11:43.
 */

namespace OrmTool\Unit;

use Orm\Config\PdoConfig;
use Orm\PdoInterface;
use Orm\Sql\SqlParser;

/**
 * output:table的各种定义获取
 * Class table.
 */
class Table
{
    /** @var PdoConfig 所属的数据库类 */
    protected $DbConfig;
    /** @var string 表格的名称 */
    protected $name = '';
    /** @var string 表格的描述 */
    protected $comment = '';

    /** @var array */
    protected $joinTables = [];
    /** @var \OrmTool\Unit\FieldSchema[] */
    private $fieldSchema = [];
    /** @var \OrmTool\Unit\ForeignKey[] 外键对 */
    private $foreignKey = [];

    /**
     * @return string
     */
    final public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Table
     */
    final public function setName(string $name): Table
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return PdoConfig
     */
    public function getDbConfig(): PdoConfig
    {
        return $this->DbConfig;
    }

    /**
     * @param PdoConfig $DbConfig
     *
     * @return Table
     */
    final public function setDbConfig(PdoConfig $DbConfig): Table
    {
        $this->DbConfig = $DbConfig;

        return $this;
    }

    /**
     * 获取外键.
     *
     * @return ForeignKey[]
     */
    final public function getForeignKey()
    {
        $sql = 'SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE '.
            'WHERE TABLE_NAME = :TABLE_NAME AND TABLE_SCHEMA=:TABLE_SCHEMA AND REFERENCED_TABLE_NAME IS NOT NULL';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'TABLE_NAME' => $this->getName(),
                    'TABLE_SCHEMA' => $this->getDbConfig()->getDb(),
                ]
            )
            ->__invoke();
        /** @var \OrmTool\Unit\ForeignKeySchema[] $ForeignKeySchema */
        $ForeignKeySchema = (new PdoInterface())
            ->setPdoConfig($this->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setClassName(ForeignKeySchema::class)
            ->selectAll();
        foreach ($ForeignKeySchema as $item) {
            if (!$this->foreignKey[$item->getCONSTRAINTNAME()]) {
                $this->foreignKey[$item->getCONSTRAINTNAME()] = (new ForeignKey())
                    ->setTableObject($this)
                    ->setTableName($this->getName())
                    ->setReferTableName($item->getREFERENCEDTABLENAME())
                    ->setKeysArray([$item->getCOLUMNNAME() => $item->getREFERENCEDCOLUMNNAME()]);
            } else {
                $this->foreignKey[$item->getCONSTRAINTNAME()]
                    ->setKeysArray([$item->getCOLUMNNAME() => $item->getREFERENCEDCOLUMNNAME()]);
            }
            //记录下能关联到表格
            $this->joinTables[$item->getREFERENCEDTABLENAME()] = $item->getREFERENCEDTABLENAME();
        }
        //把索引清除掉
        return array_values($this->foreignKey);
    }

    /**
     * 返回此表关联的表数组.
     *
     * @return array
     */
    public function getJoinTables():array
    {
        return $this->joinTables;
    }

    /**
     * 获取表格的字段，以类集合形式返回.
     *
     * @return \OrmTool\Unit\FieldSchema[]
     */
    final public function getFieldSchemas(): array
    {
        if (!$this->fieldSchema) {
            $sql = 'select * from information_schema.COLUMNS '.
            'WHERE table_name=:table_name  AND TABLE_SCHEMA=:TABLE_SCHEMA ';
            $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'table_name' => $this->getName(),
                    'TABLE_SCHEMA' => $this->getDbConfig()->getDb(),
                ]
            )
            ->__invoke();

            $this->fieldSchema = (new PdoInterface())
            ->setPdoConfig($this->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setClassName(\OrmTool\Unit\FieldSchema::class)
            ->selectAll();
        }

        return $this->fieldSchema;
    }

    /**
     * 返回当前表的字段数组.
     */
    public function getFields()
    {
        $fields       = [];
        $fieldSchemas = $this->getFieldSchemas();
        foreach ($fieldSchemas as $fieldSchema) {
            $fields[] = '`'.$fieldSchema->getCOLUMNNAME().'`';
        }

        return $fields;
    }
    /**
     * 返回表的全部字段别名.
     *
     * @return string
     */
    public function getFieldsAs()
    {
        $array        = [];
        $FieldSchemas = $this->getFieldSchemas();
        foreach ($FieldSchemas as $fieldSchema) {
            $array[] = $this->getName().'.'.$fieldSchema->getCOLUMNNAME().' AS AS'.
                $this->getName().'_'.$fieldSchema->getCOLUMNNAME();
        }

        return implode(',', $array);
    }
}

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
    /** @var  \OrmTool\Unit\FieldSchema */
    private $fieldSchema;
    /** @var  \OrmTool\Unit\ForeignKey 外键对 */
    private $ForeignKey;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Table
     */
    public function setName(string $name): Table
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
    public function setDbConfig(PdoConfig $DbConfig): Table
    {
        $this->DbConfig = $DbConfig;

        return $this;
    }

    /**
     * @return ForeignKey
     */
    public function getForeignKey(): ForeignKey
    {
        return $this->ForeignKey;
    }


    /**
     * @return \OrmTool\Unit\FieldSchema[]
     */
    public function getFieldSchema(): array
    {
        $sql = 'select * from information_schema.COLUMNS where table_name=:table_name ';
        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind(
                [
                    'table_name' => $this->getName(),
                ]
            )
            ->__invoke();

        return $this->fieldSchema = (new PdoInterface())
            ->setPdoConfig($this->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setClassName(\OrmTool\Unit\FieldSchema::class)
            ->selectAll();
    }
}

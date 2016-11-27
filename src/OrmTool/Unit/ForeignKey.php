<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-27
 * Time: 下午 2:53
 */

namespace OrmTool\Unit;

/**
 * 表的实际外键
 * Class ForeignKey
 * @package OrmTool\Unit
 */
final class ForeignKey
{
    /** @var  Table  从表实体 */
    protected $tableObject;
    /** @var string 当前表的名称 - 下级表 */
    protected $tableName = "";
    /** @var string 关联的原始表的名称 */
    protected $referTableName = "";
    /** @var array 外键对应字段 */
    protected $keysArray = [];

    /**
     * @return Table
     */
    public function getTableObject(): Table
    {
        return $this->tableObject;
    }

    /**
     * @param Table $tableObject
     * @return ForeignKey
     */
    public function setTableObject(Table $tableObject): ForeignKey
    {
        $this->tableObject = $tableObject;
        return $this;
    }


    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * 返回可以用于sql拼接的join语句
     */
    public function getJoinSql()
    {
        $str = [];
        foreach ($this->getKeysArray() as $column => $reColumn) {
            $str[] = $this->getTableName() . ".$column=" . $this->getReferTableName() . ".$reColumn";
        }
        return join(" AND ", $str);
    }

    public function getJoinFieldAs()
    {
        $tableObject = $this->tableObject
            ->setName($this->referTableName);
        return $tableObject->getFieldsAs();
    }

    /**
     * @param string $tableName
     * @return ForeignKey
     */
    public function setTableName(string $tableName): ForeignKey
    {
        $this->tableName = $tableName;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferTableName(): string
    {
        return $this->referTableName;
    }

    /**
     * @param string $referTableName
     * @return ForeignKey
     */
    public function setReferTableName(string $referTableName): ForeignKey
    {
        $this->referTableName = $referTableName;
        return $this;
    }

    /**
     * @return array
     */
    public function getKeysArray(): array
    {
        return $this->keysArray;
    }

    /**
     * @param array $keysArray
     * @return ForeignKey
     */
    public function setKeysArray(array $keysArray): ForeignKey
    {
        $this->keysArray = array_merge($this->keysArray, $keysArray);
        return $this;
    }
}

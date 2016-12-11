<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 6:57
 */

namespace xltxlm\ormTool\Unit;

/**
 * 外键结构类
 * Class ForeignKey
 * @package OrmTool\Unit
 */
class ForeignKeySchema
{
    protected $CONSTRAINT_CATALOG = "";

    protected $CONSTRAINT_SCHEMA = "";

    protected $CONSTRAINT_NAME = "";

    protected $TABLE_CATALOG = "";

    protected $TABLE_SCHEMA = "";

    protected $TABLE_NAME = "";

    protected $COLUMN_NAME = "";

    protected $ORDINAL_POSITION = "";

    protected $POSITION_IN_UNIQUE_CONSTRAINT = "";

    protected $REFERENCED_TABLE_SCHEMA = "";

    protected $REFERENCED_TABLE_NAME = "";

    protected $REFERENCED_COLUMN_NAME = "";

    /**
     * @return string
     */
    public function getCONSTRAINTCATALOG(): string
    {
        return $this->CONSTRAINT_CATALOG;
    }

    /**
     * @return string
     */
    public function getCONSTRAINTSCHEMA(): string
    {
        return $this->CONSTRAINT_SCHEMA;
    }

    /**
     * @return string
     */
    public function getCONSTRAINTNAME(): string
    {
        return $this->CONSTRAINT_NAME;
    }

    /**
     * @return string
     */
    public function getTABLECATALOG(): string
    {
        return $this->TABLE_CATALOG;
    }

    /**
     * @return string
     */
    public function getTABLESCHEMA(): string
    {
        return $this->TABLE_SCHEMA;
    }

    /**
     * @return string
     */
    public function getTABLENAME(): string
    {
        return $this->TABLE_NAME;
    }

    /**
     * @return string
     */
    public function getCOLUMNNAME(): string
    {
        return $this->COLUMN_NAME;
    }

    /**
     * @return string
     */
    public function getORDINALPOSITION(): string
    {
        return $this->ORDINAL_POSITION;
    }

    /**
     * @return string
     */
    public function getPOSITIONINUNIQUECONSTRAINT(): string
    {
        return $this->POSITION_IN_UNIQUE_CONSTRAINT;
    }

    /**
     * @return string
     */
    public function getREFERENCEDTABLESCHEMA(): string
    {
        return $this->REFERENCED_TABLE_SCHEMA;
    }

    /**
     * @return string
     */
    public function getREFERENCEDTABLENAME(): string
    {
        return $this->REFERENCED_TABLE_NAME;
    }

    /**
     * @return string
     */
    public function getREFERENCEDCOLUMNNAME(): string
    {
        return $this->REFERENCED_COLUMN_NAME;
    }
}

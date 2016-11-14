<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 4:25
 */

namespace OrmTool\Unit;

/**
 * Mysql数据库的结构体
 * Class TableSchema
 * @package OrmTool\Unit
 */
final class TableSchema
{
    protected $TABLE_CATALOG = "";
    /** @var string 所属数据库名称 */
    protected $TABLE_SCHEMA = "";
    /** @var string 表格名称 */
    protected $TABLE_NAME = "";

    protected $TABLE_TYPE = "";

    protected $ENGINE = "";

    protected $VERSION = "";

    protected $ROW_FORMAT = "";

    protected $TABLE_ROWS = "";

    protected $AVG_ROW_LENGTH = "";

    protected $DATA_LENGTH = "";

    protected $MAX_DATA_LENGTH = "";

    protected $INDEX_LENGTH = "";

    protected $DATA_FREE = "";

    protected $AUTO_INCREMENT = "";

    protected $CREATE_TIME = "";

    protected $UPDATE_TIME = "";

    protected $CHECK_TIME = "";

    protected $TABLE_COLLATION = "";

    protected $CHECKSUM = "";

    protected $CREATE_OPTIONS = "";
    /** @var string 表格注释 */
    protected $TABLE_COMMENT = "";

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
    public function getTABLETYPE(): string
    {
        return $this->TABLE_TYPE;
    }

    /**
     * @return string
     */
    public function getENGINE(): string
    {
        return $this->ENGINE;
    }

    /**
     * @return string
     */
    public function getVERSION(): string
    {
        return $this->VERSION;
    }

    /**
     * @return string
     */
    public function getROWFORMAT(): string
    {
        return $this->ROW_FORMAT;
    }

    /**
     * @return string
     */
    public function getTABLEROWS(): string
    {
        return $this->TABLE_ROWS;
    }

    /**
     * @return string
     */
    public function getAVGROWLENGTH(): string
    {
        return $this->AVG_ROW_LENGTH;
    }

    /**
     * @return string
     */
    public function getDATALENGTH(): string
    {
        return $this->DATA_LENGTH;
    }

    /**
     * @return string
     */
    public function getMAXDATALENGTH(): string
    {
        return $this->MAX_DATA_LENGTH;
    }

    /**
     * @return string
     */
    public function getINDEXLENGTH(): string
    {
        return $this->INDEX_LENGTH;
    }

    /**
     * @return string
     */
    public function getDATAFREE(): string
    {
        return $this->DATA_FREE;
    }

    /**
     * @return string
     */
    public function getAUTOINCREMENT(): string
    {
        return $this->AUTO_INCREMENT;
    }

    /**
     * @return string
     */
    public function getCREATETIME(): string
    {
        return $this->CREATE_TIME;
    }

    /**
     * @return string
     */
    public function getUPDATETIME(): string
    {
        return $this->UPDATE_TIME;
    }

    /**
     * @return string
     */
    public function getCHECKTIME(): string
    {
        return $this->CHECK_TIME;
    }

    /**
     * @return string
     */
    public function getTABLECOLLATION(): string
    {
        return $this->TABLE_COLLATION;
    }

    /**
     * @return string
     */
    public function getCHECKSUM(): string
    {
        return $this->CHECKSUM;
    }

    /**
     * @return string
     */
    public function getCREATEOPTIONS(): string
    {
        return $this->CREATE_OPTIONS;
    }

    /**
     * @return string
     */
    public function getTABLECOMMENT(): string
    {
        return $this->TABLE_COMMENT;
    }
}

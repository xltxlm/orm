<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 6:11.
 */

namespace xltxlm\ormTool\Unit;

use Overtrue\Pinyin\Pinyin;

/**
 * Class FieldSchema.
 */
final class FieldSchema
{
    const VARCHAR = 'varchar';
    const INT = 'int';
    const FLOAT = 'float';
    const BIGINT = 'bigint';
    const TEXT = 'text';
    const DATE = 'date';
    const TIME = 'time';
    const MEDIUMTEXT = 'mediumtext';
    const TINYINT = 'tinyint';
    const TIMESTAMP = 'timestamp';
    const LONGTEXT = 'longtext';
    const DATETIME = 'datetime';
    const DECIMAL = 'decimal';
    const ENUM = 'enum';

    protected $TABLE_CATALOG = '';

    protected $TABLE_SCHEMA = '';
    /** @var string 所在的表名称 */
    protected $TABLE_NAME = '';
    /** @var string 字段名称 */
    protected $COLUMN_NAME = '';

    protected $ORDINAL_POSITION = '';

    protected $COLUMN_DEFAULT = '';

    protected $IS_NULLABLE = '';

    /** @var string 字段类型 */
    protected $DATA_TYPE = '';

    protected $CHARACTER_MAXIMUM_LENGTH = '';

    protected $CHARACTER_OCTET_LENGTH = '';

    protected $NUMERIC_PRECISION = '';

    protected $NUMERIC_SCALE = '';

    protected $DATETIME_PRECISION = '';

    protected $CHARACTER_SET_NAME = '';

    protected $COLLATION_NAME = '';

    protected $COLUMN_TYPE = '';

    protected $COLUMN_KEY = '';

    protected $EXTRA = '';

    protected $PRIVILEGES = '';
    /** @var string 字段注释 */
    protected $COLUMN_COMMENT = '';

    protected $GENERATION_EXPRESSION = '';

    /** @var array 枚举类型的值列表 */
    private $ENUM_ARRAY = [];

    /**
     * @return array
     */
    public function getENUMARRAY(): array
    {
        //准备拼音类
        static $pinyin;
        static $pinyins;
        if (!$pinyin) {
            $pinyin = new Pinyin();
        }
        preg_match_all("#'([^']+)'#iUs", $this->getCOLUMNTYPE(), $out);
        foreach ($out[1] as $key => $item) {
            $itemPinyin = $pinyins[$item];
            if (!$itemPinyin) {
                $sentence = $pinyin->sentence($item);
                $itemPinyin = preg_replace('/[ ，,]/', '_', strtoupper($sentence));
                $pinyins[$item] = $itemPinyin;
            }
            $out[1][$itemPinyin] = $item;
            unset($out[1][$key]);
        }

        return $this->ENUM_ARRAY = $out[1];
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
     * @return string|null
     */
    public function getCOLUMNDEFAULT()
    {
        return $this->COLUMN_DEFAULT;
    }

    /**
     * @return string
     */
    public function getISNULLABLE(): string
    {
        return $this->IS_NULLABLE;
    }

    /**
     * @return string
     */
    public function getDATATYPE(): string
    {
        return $this->DATA_TYPE;
    }

    /**
     * @return string|null
     */
    public function getCHARACTERMAXIMUMLENGTH()
    {
        return $this->CHARACTER_MAXIMUM_LENGTH;
    }

    /**
     * @return string
     */
    public function getCHARACTEROCTETLENGTH(): string
    {
        return $this->CHARACTER_OCTET_LENGTH;
    }

    /**
     * @return string
     */
    public function getNUMERICPRECISION(): string
    {
        return $this->NUMERIC_PRECISION;
    }

    /**
     * @return string
     */
    public function getNUMERICSCALE()
    {
        return $this->NUMERIC_SCALE;
    }

    /**
     * @return string
     */
    public function getDATETIMEPRECISION(): string
    {
        return $this->DATETIME_PRECISION;
    }

    /**
     * @return string
     */
    public function getCHARACTERSETNAME(): string
    {
        return $this->CHARACTER_SET_NAME;
    }

    /**
     * @return string
     */
    public function getCOLLATIONNAME(): string
    {
        return $this->COLLATION_NAME;
    }

    /**
     * @return string
     */
    public function getCOLUMNTYPE(): string
    {
        return $this->COLUMN_TYPE;
    }

    /**
     * @return string
     */
    public function getCOLUMNKEY(): string
    {
        return $this->COLUMN_KEY;
    }

    /**
     * @return string
     */
    public function getEXTRA(): string
    {
        return $this->EXTRA;
    }

    /**
     * @return string
     */
    public function getPRIVILEGES(): string
    {
        return $this->PRIVILEGES;
    }

    /**
     * @return string
     */
    public function getCOLUMNCOMMENT(): string
    {
        return $this->COLUMN_COMMENT;
    }

    /**
     * @return string
     */
    public function getGENERATIONEXPRESSION(): string
    {
        return $this->GENERATION_EXPRESSION;
    }

    /**
     * 获取一个字段的创建方式
     * @param string $prevfix 字段前缀
     */
    public function __invoke($prevfix = ''): string
    {
        $string = "";
        $string .= '`'.$prevfix.$this->getCOLUMNNAME().'` ';
        $string .= $this->getCOLUMNTYPE();
        if ($this->getISNULLABLE() == 'YES') {
            $string .= " ";
        } else {
            $string .= " NOT NULL ";
        }
        if ($this->getCOLUMNDEFAULT() !== null) {
            if (in_array($this->getDATATYPE(), ['varchar', 'enum'])) {
                $string .= " DEFAULT '".$this->getCOLUMNDEFAULT()."'";
            } else {
                $string .= " DEFAULT ".$this->getCOLUMNDEFAULT();
            }
        }

        $string .= " COMMENT '".$this->getCOLUMNCOMMENT()."'";
        return $string;
    }
}

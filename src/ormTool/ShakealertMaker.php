<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/3/28
 * Time: 10:08
 */

namespace xltxlm\ormTool;

use xltxlm\helper\Ctroller\LoadClassRegister;
use xltxlm\ormTool\Unit\Table;

/**
 * 针对给定的表格,生成固定格式的监控.在限制条件下,每天只能存在一条数据
 * 用于监控数据抖动.或者相比昨天少数据条目
 * Class ReportMaker
 * @package xltxlm\ormTool
 */
class ShakealertMaker
{
    use LoadClassRegister;

    /** @var string 定时任务类集合所在的目录 */
    protected $crontabDir = '';

    /** @var  Table 表格实体 */
    protected $table;
    /** @var array 字段名=>注释 */
    protected $fieldKV = [];
    /** @var string 日期字段 */
    protected $dtField = "";
    /** @var [] group by 的约束条件 */
    protected $groupby = [];
    /** @var array 需要监听的字段 */
    protected $fields = [];
    /** @var array 需要监听的字段 */
    protected $fielSums = [];

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getFielSums(): array
    {
        return $this->fielSums;
    }

    /**
     * @param string $fields
     * @return ShakealertMaker
     */
    public function setFields(string $fields): ShakealertMaker
    {
        $this->fields[$fields] = $fields;
        $this->fielSums[$fields] = "sum($fields) as $fields";
        return $this;
    }


    /**
     * @return string
     */
    public function getDtField(): string
    {
        return $this->dtField;
    }

    /**
     * @param string $dtField
     * @return ShakealertMaker
     */
    public function setDtField(string $dtField): ShakealertMaker
    {
        $this->dtField = $dtField;
        return $this;
    }

    /**
     * @return string
     */
    public function getCrontabDir(): string
    {
        return $this->crontabDir;
    }

    /**
     * @param string $crontabDir
     * @return ShakealertMaker
     */
    public function setCrontabDir(string $crontabDir): ShakealertMaker
    {
        $this->crontabDir = $crontabDir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupby()
    {
        return $this->groupby;
    }

    /**
     * @param string $groupby
     * @return ShakealertMaker
     */
    public function setGroupby(string $groupby)
    {
        $this->groupby[$groupby] = $groupby;
        return $this;
    }


    /**
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     * @param Table $table
     * @return ShakealertMaker
     */
    public function setTable(Table $table): ShakealertMaker
    {
        $this->table = $table;
        //拿到表格的全部字段注释
        $Model = (new \ReflectionClass($table))->getName().'Model';
        $this->fieldKV = (new $Model)();
        return $this;
    }


    /**
     * 写入数据
     */
    public function __invoke()
    {
        mkdir($this->getCrontabDir()."/Shakealert/");
        ob_start();
        include __DIR__."/Template/Model/Shakealert.php";
        file_put_contents($this->getCrontabDir()."/Shakealert/".ucfirst($this->getTable()->getName())."ShakealertSync.php", ob_get_clean());
    }
}

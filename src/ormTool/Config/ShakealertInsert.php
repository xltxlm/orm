<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace xltxlm\ormTool\Config;
use \xltxlm\ormTool\Template\Insert;

final class ShakealertInsert extends Insert

{

    final public function __construct()
    {
        $this->tableObject=(new Shakealert);
    }
    protected $id;

    /**
     * out:自增id int 
     * @param mixed $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->sqls['`id`'] = ":id";
        $this->binds['id'] = $id;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setIdSQL($sql, $value = "")
    {
        $this->sqls['`id`'] = 'id=' . $sql;
        if ($value) {
            $this->binds['id'] = $value;
        }
        return $this;
    }
    protected $dtvalue;

    /**
     * out:日期 date 
     * @param mixed $dtvalue
     * @return $this
     */
    public function setDtvalue(string $dtvalue)
    {
        $this->sqls['`dtvalue`'] = ":dtvalue";
        $this->binds['dtvalue'] = $dtvalue;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setDtvalueSQL($sql, $value = "")
    {
        $this->sqls['`dtvalue`'] = 'dtvalue=' . $sql;
        if ($value) {
            $this->binds['dtvalue'] = $value;
        }
        return $this;
    }
    protected $dtfieldname;

    /**
     * out:日期字段 varchar 100
     * @param mixed $dtfieldname
     * @return $this
     */
    public function setDtfieldname(string $dtfieldname)
    {
        $this->sqls['`dtfieldname`'] = ":dtfieldname";
        $this->binds['dtfieldname'] = $dtfieldname;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setDtfieldnameSQL($sql, $value = "")
    {
        $this->sqls['`dtfieldname`'] = 'dtfieldname=' . $sql;
        if ($value) {
            $this->binds['dtfieldname'] = $value;
        }
        return $this;
    }
    protected $tablename;

    /**
     * out:表格名称 varchar 100
     * @param mixed $tablename
     * @return $this
     */
    public function setTablename(string $tablename)
    {
        $this->sqls['`tablename`'] = ":tablename";
        $this->binds['tablename'] = $tablename;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setTablenameSQL($sql, $value = "")
    {
        $this->sqls['`tablename`'] = 'tablename=' . $sql;
        if ($value) {
            $this->binds['tablename'] = $value;
        }
        return $this;
    }
    protected $condition;

    /**
     * out:附加条件 varchar 100
     * @param mixed $condition
     * @return $this
     */
    public function setCondition(string $condition)
    {
        $this->sqls['`condition`'] = ":condition";
        $this->binds['condition'] = $condition;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setConditionSQL($sql, $value = "")
    {
        $this->sqls['`condition`'] = 'condition=' . $sql;
        if ($value) {
            $this->binds['condition'] = $value;
        }
        return $this;
    }
    protected $fieldname;

    /**
     * out:字段名称 varchar 100
     * @param mixed $fieldname
     * @return $this
     */
    public function setFieldname(string $fieldname)
    {
        $this->sqls['`fieldname`'] = ":fieldname";
        $this->binds['fieldname'] = $fieldname;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setFieldnameSQL($sql, $value = "")
    {
        $this->sqls['`fieldname`'] = 'fieldname=' . $sql;
        if ($value) {
            $this->binds['fieldname'] = $value;
        }
        return $this;
    }
    protected $fieldname1day;

    /**
     * out:1天前数据 varchar 100
     * @param mixed $fieldname1day
     * @return $this
     */
    public function setFieldname1day(string $fieldname1day)
    {
        $this->sqls['`fieldname1day`'] = ":fieldname1day";
        $this->binds['fieldname1day'] = $fieldname1day;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setFieldname1daySQL($sql, $value = "")
    {
        $this->sqls['`fieldname1day`'] = 'fieldname1day=' . $sql;
        if ($value) {
            $this->binds['fieldname1day'] = $value;
        }
        return $this;
    }
    protected $fieldname1dayratio;

    /**
     * out:1天前百分比 varchar 100
     * @param mixed $fieldname1dayratio
     * @return $this
     */
    public function setFieldname1dayratio(string $fieldname1dayratio)
    {
        $this->sqls['`fieldname1dayratio`'] = ":fieldname1dayratio";
        $this->binds['fieldname1dayratio'] = $fieldname1dayratio;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setFieldname1dayratioSQL($sql, $value = "")
    {
        $this->sqls['`fieldname1dayratio`'] = 'fieldname1dayratio=' . $sql;
        if ($value) {
            $this->binds['fieldname1dayratio'] = $value;
        }
        return $this;
    }
    protected $fieldname1week;

    /**
     * out:1周前数据 varchar 100
     * @param mixed $fieldname1week
     * @return $this
     */
    public function setFieldname1week(string $fieldname1week)
    {
        $this->sqls['`fieldname1week`'] = ":fieldname1week";
        $this->binds['fieldname1week'] = $fieldname1week;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setFieldname1weekSQL($sql, $value = "")
    {
        $this->sqls['`fieldname1week`'] = 'fieldname1week=' . $sql;
        if ($value) {
            $this->binds['fieldname1week'] = $value;
        }
        return $this;
    }
    protected $fieldname1weekratio;

    /**
     * out:1周前百分比 varchar 100
     * @param mixed $fieldname1weekratio
     * @return $this
     */
    public function setFieldname1weekratio(string $fieldname1weekratio)
    {
        $this->sqls['`fieldname1weekratio`'] = ":fieldname1weekratio";
        $this->binds['fieldname1weekratio'] = $fieldname1weekratio;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setFieldname1weekratioSQL($sql, $value = "")
    {
        $this->sqls['`fieldname1weekratio`'] = 'fieldname1weekratio=' . $sql;
        if ($value) {
            $this->binds['fieldname1weekratio'] = $value;
        }
        return $this;
    }
    protected $fieldnamenew;

    /**
     * out:新数据 varchar 100
     * @param mixed $fieldnamenew
     * @return $this
     */
    public function setFieldnamenew(string $fieldnamenew)
    {
        $this->sqls['`fieldnamenew`'] = ":fieldnamenew";
        $this->binds['fieldnamenew'] = $fieldnamenew;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setFieldnamenewSQL($sql, $value = "")
    {
        $this->sqls['`fieldnamenew`'] = 'fieldnamenew=' . $sql;
        if ($value) {
            $this->binds['fieldnamenew'] = $value;
        }
        return $this;
    }
    protected $add_time;

    /**
     * out:创建时间 timestamp 
     * @param mixed $add_time
     * @return $this
     */
    public function setAdd_time(string $add_time)
    {
        $this->sqls['`add_time`'] = ":add_time";
        $this->binds['add_time'] = $add_time;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setAdd_timeSQL($sql, $value = "")
    {
        $this->sqls['`add_time`'] = 'add_time=' . $sql;
        if ($value) {
            $this->binds['add_time'] = $value;
        }
        return $this;
    }
}

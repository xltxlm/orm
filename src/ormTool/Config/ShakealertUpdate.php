<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace xltxlm\ormTool\Config;
/** 日*/
use \xltxlm\ormTool\Template\PdoAction;
use \xltxlm\ormTool\Template\Update;

final class ShakealertUpdate extends Update

{
    final public function __construct()
    {
        $this->tableObject=(new Shakealert);
    }

    protected $id;

    /**
     * out:自增id
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->sqls['id'] = "`id`=:id";
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
        $this->sqls['id'] = '`id`=' . $sql;
        if ($value) {
            $this->binds['id'] = $value;
        }
        return $this;
    }

    /**
     * out:自增id
     * @param mixed $id
     * @return $this
     */
    public function whereId($id,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['whereid'] = "`id`$action:whereid";
        $this->binds['whereid'] = $id;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereIdSQL($sql, $value = "")
    {
        $this->sqls['whereid'] = '`id`=' . $sql;
        if ($value) {
            $this->binds['whereid'] = $value;
        }
        return $this;
    }
    protected $dtvalue;

    /**
     * out:日期
     * @param mixed $dtvalue
     * @return $this
     */
    public function setDtvalue($dtvalue)
    {
        $this->sqls['dtvalue'] = "`dtvalue`=:dtvalue";
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
        $this->sqls['dtvalue'] = '`dtvalue`=' . $sql;
        if ($value) {
            $this->binds['dtvalue'] = $value;
        }
        return $this;
    }

    /**
     * out:日期
     * @param mixed $dtvalue
     * @return $this
     */
    public function whereDtvalue($dtvalue,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wheredtvalue'] = "`dtvalue`$action:wheredtvalue";
        $this->binds['wheredtvalue'] = $dtvalue;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereDtvalueSQL($sql, $value = "")
    {
        $this->sqls['wheredtvalue'] = '`dtvalue`=' . $sql;
        if ($value) {
            $this->binds['wheredtvalue'] = $value;
        }
        return $this;
    }
    protected $dtfieldname;

    /**
     * out:日期字段
     * @param mixed $dtfieldname
     * @return $this
     */
    public function setDtfieldname($dtfieldname)
    {
        $this->sqls['dtfieldname'] = "`dtfieldname`=:dtfieldname";
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
        $this->sqls['dtfieldname'] = '`dtfieldname`=' . $sql;
        if ($value) {
            $this->binds['dtfieldname'] = $value;
        }
        return $this;
    }

    /**
     * out:日期字段
     * @param mixed $dtfieldname
     * @return $this
     */
    public function whereDtfieldname($dtfieldname,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wheredtfieldname'] = "`dtfieldname`$action:wheredtfieldname";
        $this->binds['wheredtfieldname'] = $dtfieldname;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereDtfieldnameSQL($sql, $value = "")
    {
        $this->sqls['wheredtfieldname'] = '`dtfieldname`=' . $sql;
        if ($value) {
            $this->binds['wheredtfieldname'] = $value;
        }
        return $this;
    }
    protected $tablename;

    /**
     * out:表格名称
     * @param mixed $tablename
     * @return $this
     */
    public function setTablename($tablename)
    {
        $this->sqls['tablename'] = "`tablename`=:tablename";
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
        $this->sqls['tablename'] = '`tablename`=' . $sql;
        if ($value) {
            $this->binds['tablename'] = $value;
        }
        return $this;
    }

    /**
     * out:表格名称
     * @param mixed $tablename
     * @return $this
     */
    public function whereTablename($tablename,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wheretablename'] = "`tablename`$action:wheretablename";
        $this->binds['wheretablename'] = $tablename;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereTablenameSQL($sql, $value = "")
    {
        $this->sqls['wheretablename'] = '`tablename`=' . $sql;
        if ($value) {
            $this->binds['wheretablename'] = $value;
        }
        return $this;
    }
    protected $condition;

    /**
     * out:附加条件
     * @param mixed $condition
     * @return $this
     */
    public function setCondition($condition)
    {
        $this->sqls['condition'] = "`condition`=:condition";
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
        $this->sqls['condition'] = '`condition`=' . $sql;
        if ($value) {
            $this->binds['condition'] = $value;
        }
        return $this;
    }

    /**
     * out:附加条件
     * @param mixed $condition
     * @return $this
     */
    public function whereCondition($condition,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherecondition'] = "`condition`$action:wherecondition";
        $this->binds['wherecondition'] = $condition;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereConditionSQL($sql, $value = "")
    {
        $this->sqls['wherecondition'] = '`condition`=' . $sql;
        if ($value) {
            $this->binds['wherecondition'] = $value;
        }
        return $this;
    }
    protected $fieldname;

    /**
     * out:字段名称
     * @param mixed $fieldname
     * @return $this
     */
    public function setFieldname($fieldname)
    {
        $this->sqls['fieldname'] = "`fieldname`=:fieldname";
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
        $this->sqls['fieldname'] = '`fieldname`=' . $sql;
        if ($value) {
            $this->binds['fieldname'] = $value;
        }
        return $this;
    }

    /**
     * out:字段名称
     * @param mixed $fieldname
     * @return $this
     */
    public function whereFieldname($fieldname,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherefieldname'] = "`fieldname`$action:wherefieldname";
        $this->binds['wherefieldname'] = $fieldname;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereFieldnameSQL($sql, $value = "")
    {
        $this->sqls['wherefieldname'] = '`fieldname`=' . $sql;
        if ($value) {
            $this->binds['wherefieldname'] = $value;
        }
        return $this;
    }
    protected $fieldname1day;

    /**
     * out:1天前数据
     * @param mixed $fieldname1day
     * @return $this
     */
    public function setFieldname1day($fieldname1day)
    {
        $this->sqls['fieldname1day'] = "`fieldname1day`=:fieldname1day";
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
        $this->sqls['fieldname1day'] = '`fieldname1day`=' . $sql;
        if ($value) {
            $this->binds['fieldname1day'] = $value;
        }
        return $this;
    }

    /**
     * out:1天前数据
     * @param mixed $fieldname1day
     * @return $this
     */
    public function whereFieldname1day($fieldname1day,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherefieldname1day'] = "`fieldname1day`$action:wherefieldname1day";
        $this->binds['wherefieldname1day'] = $fieldname1day;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereFieldname1daySQL($sql, $value = "")
    {
        $this->sqls['wherefieldname1day'] = '`fieldname1day`=' . $sql;
        if ($value) {
            $this->binds['wherefieldname1day'] = $value;
        }
        return $this;
    }
    protected $fieldname1dayratio;

    /**
     * out:1天前百分比
     * @param mixed $fieldname1dayratio
     * @return $this
     */
    public function setFieldname1dayratio($fieldname1dayratio)
    {
        $this->sqls['fieldname1dayratio'] = "`fieldname1dayratio`=:fieldname1dayratio";
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
        $this->sqls['fieldname1dayratio'] = '`fieldname1dayratio`=' . $sql;
        if ($value) {
            $this->binds['fieldname1dayratio'] = $value;
        }
        return $this;
    }

    /**
     * out:1天前百分比
     * @param mixed $fieldname1dayratio
     * @return $this
     */
    public function whereFieldname1dayratio($fieldname1dayratio,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherefieldname1dayratio'] = "`fieldname1dayratio`$action:wherefieldname1dayratio";
        $this->binds['wherefieldname1dayratio'] = $fieldname1dayratio;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereFieldname1dayratioSQL($sql, $value = "")
    {
        $this->sqls['wherefieldname1dayratio'] = '`fieldname1dayratio`=' . $sql;
        if ($value) {
            $this->binds['wherefieldname1dayratio'] = $value;
        }
        return $this;
    }
    protected $fieldname1week;

    /**
     * out:1周前数据
     * @param mixed $fieldname1week
     * @return $this
     */
    public function setFieldname1week($fieldname1week)
    {
        $this->sqls['fieldname1week'] = "`fieldname1week`=:fieldname1week";
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
        $this->sqls['fieldname1week'] = '`fieldname1week`=' . $sql;
        if ($value) {
            $this->binds['fieldname1week'] = $value;
        }
        return $this;
    }

    /**
     * out:1周前数据
     * @param mixed $fieldname1week
     * @return $this
     */
    public function whereFieldname1week($fieldname1week,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherefieldname1week'] = "`fieldname1week`$action:wherefieldname1week";
        $this->binds['wherefieldname1week'] = $fieldname1week;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereFieldname1weekSQL($sql, $value = "")
    {
        $this->sqls['wherefieldname1week'] = '`fieldname1week`=' . $sql;
        if ($value) {
            $this->binds['wherefieldname1week'] = $value;
        }
        return $this;
    }
    protected $fieldname1weekratio;

    /**
     * out:1周前百分比
     * @param mixed $fieldname1weekratio
     * @return $this
     */
    public function setFieldname1weekratio($fieldname1weekratio)
    {
        $this->sqls['fieldname1weekratio'] = "`fieldname1weekratio`=:fieldname1weekratio";
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
        $this->sqls['fieldname1weekratio'] = '`fieldname1weekratio`=' . $sql;
        if ($value) {
            $this->binds['fieldname1weekratio'] = $value;
        }
        return $this;
    }

    /**
     * out:1周前百分比
     * @param mixed $fieldname1weekratio
     * @return $this
     */
    public function whereFieldname1weekratio($fieldname1weekratio,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherefieldname1weekratio'] = "`fieldname1weekratio`$action:wherefieldname1weekratio";
        $this->binds['wherefieldname1weekratio'] = $fieldname1weekratio;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereFieldname1weekratioSQL($sql, $value = "")
    {
        $this->sqls['wherefieldname1weekratio'] = '`fieldname1weekratio`=' . $sql;
        if ($value) {
            $this->binds['wherefieldname1weekratio'] = $value;
        }
        return $this;
    }
    protected $fieldnamenew;

    /**
     * out:新数据
     * @param mixed $fieldnamenew
     * @return $this
     */
    public function setFieldnamenew($fieldnamenew)
    {
        $this->sqls['fieldnamenew'] = "`fieldnamenew`=:fieldnamenew";
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
        $this->sqls['fieldnamenew'] = '`fieldnamenew`=' . $sql;
        if ($value) {
            $this->binds['fieldnamenew'] = $value;
        }
        return $this;
    }

    /**
     * out:新数据
     * @param mixed $fieldnamenew
     * @return $this
     */
    public function whereFieldnamenew($fieldnamenew,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherefieldnamenew'] = "`fieldnamenew`$action:wherefieldnamenew";
        $this->binds['wherefieldnamenew'] = $fieldnamenew;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereFieldnamenewSQL($sql, $value = "")
    {
        $this->sqls['wherefieldnamenew'] = '`fieldnamenew`=' . $sql;
        if ($value) {
            $this->binds['wherefieldnamenew'] = $value;
        }
        return $this;
    }
    protected $add_time;

    /**
     * out:创建时间
     * @param mixed $add_time
     * @return $this
     */
    public function setAdd_time($add_time)
    {
        $this->sqls['add_time'] = "`add_time`=:add_time";
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
        $this->sqls['add_time'] = '`add_time`=' . $sql;
        if ($value) {
            $this->binds['add_time'] = $value;
        }
        return $this;
    }

    /**
     * out:创建时间
     * @param mixed $add_time
     * @return $this
     */
    public function whereAdd_time($add_time,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['whereadd_time'] = "`add_time`$action:whereadd_time";
        $this->binds['whereadd_time'] = $add_time;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereAdd_timeSQL($sql, $value = "")
    {
        $this->sqls['whereadd_time'] = '`add_time`=' . $sql;
        if ($value) {
            $this->binds['whereadd_time'] = $value;
        }
        return $this;
    }
}

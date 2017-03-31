<?php

namespace xltxlm\ormTool\Config;

use xltxlm\helper\BasicType;

/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait ShakealertGetset
{

    /**
    * 从数据库设置默认值
    */
    public function default()
    {
        $value = date('Y-m-d H:i:s');
            $this->setAdd_time($value);
        return $this;
    }

    /**
    * out:自增id int(11)
    * @return BasicType
    */
    public function getId()
    {
        return new BasicType($this->id);
    }

    /**
    * out:自增id
    * @param mixed $id
    * @return $this
    */
    public function setId($id)
    {
        $this->id = new BasicType($id);
        return $this;
    }
        /**
    * out:日期 date
    * @return BasicType
    */
    public function getDtvalue()
    {
        return new BasicType($this->dtvalue);
    }

    /**
    * out:日期
    * @param mixed $dtvalue
    * @return $this
    */
    public function setDtvalue($dtvalue)
    {
        $this->dtvalue = new BasicType($dtvalue);
        return $this;
    }
        /**
    * out:日期字段 varchar(100)
    * @return BasicType
    */
    public function getDtfieldname()
    {
        return new BasicType($this->dtfieldname);
    }

    /**
    * out:日期字段
    * @param mixed $dtfieldname
    * @return $this
    */
    public function setDtfieldname($dtfieldname)
    {
        $this->dtfieldname = new BasicType($dtfieldname);
        return $this;
    }
        /**
    * out:表格名称 varchar(100)
    * @return BasicType
    */
    public function getTablename()
    {
        return new BasicType($this->tablename);
    }

    /**
    * out:表格名称
    * @param mixed $tablename
    * @return $this
    */
    public function setTablename($tablename)
    {
        $this->tablename = new BasicType($tablename);
        return $this;
    }
        /**
    * out:附加条件 varchar(100)
    * @return BasicType
    */
    public function getCondition()
    {
        return new BasicType($this->condition);
    }

    /**
    * out:附加条件
    * @param mixed $condition
    * @return $this
    */
    public function setCondition($condition)
    {
        $this->condition = new BasicType($condition);
        return $this;
    }
        /**
    * out:字段名称 varchar(100)
    * @return BasicType
    */
    public function getFieldname()
    {
        return new BasicType($this->fieldname);
    }

    /**
    * out:字段名称
    * @param mixed $fieldname
    * @return $this
    */
    public function setFieldname($fieldname)
    {
        $this->fieldname = new BasicType($fieldname);
        return $this;
    }
        /**
    * out:1天前数据 varchar(100)
    * @return BasicType
    */
    public function getFieldname1day()
    {
        return new BasicType($this->fieldname1day);
    }

    /**
    * out:1天前数据
    * @param mixed $fieldname1day
    * @return $this
    */
    public function setFieldname1day($fieldname1day)
    {
        $this->fieldname1day = new BasicType($fieldname1day);
        return $this;
    }
        /**
    * out:1天前百分比 varchar(100)
    * @return BasicType
    */
    public function getFieldname1dayratio()
    {
        return new BasicType($this->fieldname1dayratio);
    }

    /**
    * out:1天前百分比
    * @param mixed $fieldname1dayratio
    * @return $this
    */
    public function setFieldname1dayratio($fieldname1dayratio)
    {
        $this->fieldname1dayratio = new BasicType($fieldname1dayratio);
        return $this;
    }
        /**
    * out:1周前数据 varchar(100)
    * @return BasicType
    */
    public function getFieldname1week()
    {
        return new BasicType($this->fieldname1week);
    }

    /**
    * out:1周前数据
    * @param mixed $fieldname1week
    * @return $this
    */
    public function setFieldname1week($fieldname1week)
    {
        $this->fieldname1week = new BasicType($fieldname1week);
        return $this;
    }
        /**
    * out:1周前百分比 varchar(100)
    * @return BasicType
    */
    public function getFieldname1weekratio()
    {
        return new BasicType($this->fieldname1weekratio);
    }

    /**
    * out:1周前百分比
    * @param mixed $fieldname1weekratio
    * @return $this
    */
    public function setFieldname1weekratio($fieldname1weekratio)
    {
        $this->fieldname1weekratio = new BasicType($fieldname1weekratio);
        return $this;
    }
        /**
    * out:新数据 varchar(100)
    * @return BasicType
    */
    public function getFieldnamenew()
    {
        return new BasicType($this->fieldnamenew);
    }

    /**
    * out:新数据
    * @param mixed $fieldnamenew
    * @return $this
    */
    public function setFieldnamenew($fieldnamenew)
    {
        $this->fieldnamenew = new BasicType($fieldnamenew);
        return $this;
    }
        /**
    * out:创建时间 timestamp
    * @return BasicType
    */
    public function getAdd_time()
    {
        return new BasicType($this->add_time);
    }

    /**
    * out:创建时间
    * @param mixed $add_time
    * @return $this
    */
    public function setAdd_time($add_time)
    {
        $this->add_time = new BasicType($add_time);
        return $this;
    }
    
    /**
     * 魔术函数直接取内容 getxx
     */
    public function __call($name,$arguments)
    {
        $function = lcfirst(substr($name, 3));
        return $this->$function;
    }

}

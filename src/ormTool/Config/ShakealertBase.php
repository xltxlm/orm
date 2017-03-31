<?php

namespace xltxlm\ormTool\Config;

use xltxlm\helper\Hclass\CopyObjectAttributeName;
/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait ShakealertBase
{
    use CopyObjectAttributeName;
    /** @var string 自增id int(11) */
    protected $id;

        /**
    * out:自增id int(11)
    * @return string
    */
    public static function id()
    {
        return (self::selfInstance()->varName(self::selfInstance()->id));
    }

    /**
    * out:自增id int(11)
    * @return string
    */
    public static function idVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->id)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->id));
        }
    }

        /** @var string 日期 date */
    protected $dtvalue;

        /**
    * out:日期 date
    * @return string
    */
    public static function dtvalue()
    {
        return (self::selfInstance()->varName(self::selfInstance()->dtvalue));
    }

    /**
    * out:日期 date
    * @return string
    */
    public static function dtvalueVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->dtvalue)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->dtvalue));
        }
    }

        /** @var string 日期字段 varchar(100) */
    protected $dtfieldname;

        /**
    * out:日期字段 varchar(100)
    * @return string
    */
    public static function dtfieldname()
    {
        return (self::selfInstance()->varName(self::selfInstance()->dtfieldname));
    }

    /**
    * out:日期字段 varchar(100)
    * @return string
    */
    public static function dtfieldnameVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->dtfieldname)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->dtfieldname));
        }
    }

        /** @var string 表格名称 varchar(100) */
    protected $tablename;

        /**
    * out:表格名称 varchar(100)
    * @return string
    */
    public static function tablename()
    {
        return (self::selfInstance()->varName(self::selfInstance()->tablename));
    }

    /**
    * out:表格名称 varchar(100)
    * @return string
    */
    public static function tablenameVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->tablename)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->tablename));
        }
    }

        /** @var string 附加条件 varchar(100) */
    protected $condition;

        /**
    * out:附加条件 varchar(100)
    * @return string
    */
    public static function condition()
    {
        return (self::selfInstance()->varName(self::selfInstance()->condition));
    }

    /**
    * out:附加条件 varchar(100)
    * @return string
    */
    public static function conditionVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->condition)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->condition));
        }
    }

        /** @var string 字段名称 varchar(100) */
    protected $fieldname;

        /**
    * out:字段名称 varchar(100)
    * @return string
    */
    public static function fieldname()
    {
        return (self::selfInstance()->varName(self::selfInstance()->fieldname));
    }

    /**
    * out:字段名称 varchar(100)
    * @return string
    */
    public static function fieldnameVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname));
        }
    }

        /** @var string 1天前数据 varchar(100) */
    protected $fieldname1day;

        /**
    * out:1天前数据 varchar(100)
    * @return string
    */
    public static function fieldname1day()
    {
        return (self::selfInstance()->varName(self::selfInstance()->fieldname1day));
    }

    /**
    * out:1天前数据 varchar(100)
    * @return string
    */
    public static function fieldname1dayVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1day)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1day));
        }
    }

        /** @var string 1天前百分比 varchar(100) */
    protected $fieldname1dayratio;

        /**
    * out:1天前百分比 varchar(100)
    * @return string
    */
    public static function fieldname1dayratio()
    {
        return (self::selfInstance()->varName(self::selfInstance()->fieldname1dayratio));
    }

    /**
    * out:1天前百分比 varchar(100)
    * @return string
    */
    public static function fieldname1dayratioVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1dayratio)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1dayratio));
        }
    }

        /** @var string 1周前数据 varchar(100) */
    protected $fieldname1week;

        /**
    * out:1周前数据 varchar(100)
    * @return string
    */
    public static function fieldname1week()
    {
        return (self::selfInstance()->varName(self::selfInstance()->fieldname1week));
    }

    /**
    * out:1周前数据 varchar(100)
    * @return string
    */
    public static function fieldname1weekVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1week)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1week));
        }
    }

        /** @var string 1周前百分比 varchar(100) */
    protected $fieldname1weekratio;

        /**
    * out:1周前百分比 varchar(100)
    * @return string
    */
    public static function fieldname1weekratio()
    {
        return (self::selfInstance()->varName(self::selfInstance()->fieldname1weekratio));
    }

    /**
    * out:1周前百分比 varchar(100)
    * @return string
    */
    public static function fieldname1weekratioVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1weekratio)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->fieldname1weekratio));
        }
    }

        /** @var string 新数据 varchar(100) */
    protected $fieldnamenew;

        /**
    * out:新数据 varchar(100)
    * @return string
    */
    public static function fieldnamenew()
    {
        return (self::selfInstance()->varName(self::selfInstance()->fieldnamenew));
    }

    /**
    * out:新数据 varchar(100)
    * @return string
    */
    public static function fieldnamenewVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->fieldnamenew)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->fieldnamenew));
        }
    }

        /** @var string 创建时间 timestamp */
    protected $add_time;

        /**
    * out:创建时间 timestamp
    * @return string
    */
    public static function add_time()
    {
        return (self::selfInstance()->varName(self::selfInstance()->add_time));
    }

    /**
    * out:创建时间 timestamp
    * @return string
    */
    public static function add_timeVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->add_time)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->add_time));
        }
    }

    
}

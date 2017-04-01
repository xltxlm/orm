<?php

namespace xltxlm\ormTool\Config;

use xltxlm\helper\Hclass\CopyObjectAttributeName;
/**
 * 可以被重复利用的数据模型
 * Class select
 */
trait Service_dataBase
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
    protected $dt;

        /**
    * out:日期 date
    * @return string
    */
    public static function dt()
    {
        return (self::selfInstance()->varName(self::selfInstance()->dt));
    }

    /**
    * out:日期 date
    * @return string
    */
    public static function dtVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->dt)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->dt));
        }
    }

        /** @var string 服务名称 varchar(100) */
    protected $servicename;

        /**
    * out:服务名称 varchar(100)
    * @return string
    */
    public static function servicename()
    {
        return (self::selfInstance()->varName(self::selfInstance()->servicename));
    }

    /**
    * out:服务名称 varchar(100)
    * @return string
    */
    public static function servicenameVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->servicename)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->servicename));
        }
    }

        /** @var string 进程名字 varchar(100) */
    protected $process;

        /**
    * out:进程名字 varchar(100)
    * @return string
    */
    public static function process()
    {
        return (self::selfInstance()->varName(self::selfInstance()->process));
    }

    /**
    * out:进程名字 varchar(100)
    * @return string
    */
    public static function processVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->process)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->process));
        }
    }

        /** @var string 数值 int(11) unsigned */
    protected $num;

        /**
    * out:数值 int(11) unsigned
    * @return string
    */
    public static function num()
    {
        return (self::selfInstance()->varName(self::selfInstance()->num));
    }

    /**
    * out:数值 int(11) unsigned
    * @return string
    */
    public static function numVue($add = true)
    {
        if($add)
        {
            return '{{ item.'.(self::selfInstance()->varName(self::selfInstance()->num)).' }}';
        }else
        {
            return 'item.'.(self::selfInstance()->varName(self::selfInstance()->num));
        }
    }

    
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace xltxlm\ormTool\Config;
use xltxlm\ormTool\Config\Service_data;
use \xltxlm\ormTool\Template\Insert;

final class Service_dataInsert extends Insert

{

    final public function __construct()
    {
        $this->tableObject=(new Service_data);
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
    protected $dt;

    /**
     * out:日期 date 
     * @param mixed $dt
     * @return $this
     */
    public function setDt(string $dt)
    {
        $this->sqls['`dt`'] = ":dt";
        $this->binds['dt'] = $dt;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setDtSQL($sql, $value = "")
    {
        $this->sqls['`dt`'] = 'dt=' . $sql;
        if ($value) {
            $this->binds['dt'] = $value;
        }
        return $this;
    }
    protected $servicename;

    /**
     * out:服务名称 varchar 100
     * @param mixed $servicename
     * @return $this
     */
    public function setServicename(string $servicename)
    {
        $this->sqls['`servicename`'] = ":servicename";
        $this->binds['servicename'] = $servicename;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setServicenameSQL($sql, $value = "")
    {
        $this->sqls['`servicename`'] = 'servicename=' . $sql;
        if ($value) {
            $this->binds['servicename'] = $value;
        }
        return $this;
    }
    protected $process;

    /**
     * out:进程名字 varchar 100
     * @param mixed $process
     * @return $this
     */
    public function setProcess(string $process)
    {
        $this->sqls['`process`'] = ":process";
        $this->binds['process'] = $process;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setProcessSQL($sql, $value = "")
    {
        $this->sqls['`process`'] = 'process=' . $sql;
        if ($value) {
            $this->binds['process'] = $value;
        }
        return $this;
    }
    protected $num;

    /**
     * out:数值 int 
     * @param mixed $num
     * @return $this
     */
    public function setNum(string $num)
    {
        $this->sqls['`num`'] = ":num";
        $this->binds['num'] = $num;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function setNumSQL($sql, $value = "")
    {
        $this->sqls['`num`'] = 'num=' . $sql;
        if ($value) {
            $this->binds['num'] = $value;
        }
        return $this;
    }
}

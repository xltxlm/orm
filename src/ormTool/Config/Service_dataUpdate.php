<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 7:42
 */

namespace xltxlm\ormTool\Config;
/** 日*/
use xltxlm\ormTool\Config\Service_data;
use \xltxlm\ormTool\Template\PdoAction;
use \xltxlm\ormTool\Template\Update;

final class Service_dataUpdate extends Update

{
    final public function __construct()
    {
        $this->tableObject=(new Service_data);
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
    public function whereId(string $id,$action=PdoAction::EQUAL)
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
    protected $dt;

    /**
     * out:日期
     * @param mixed $dt
     * @return $this
     */
    public function setDt($dt)
    {
        $this->sqls['dt'] = "`dt`=:dt";
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
        $this->sqls['dt'] = '`dt`=' . $sql;
        if ($value) {
            $this->binds['dt'] = $value;
        }
        return $this;
    }

    /**
     * out:日期
     * @param mixed $dt
     * @return $this
     */
    public function whereDt(string $dt,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wheredt'] = "`dt`$action:wheredt";
        $this->binds['wheredt'] = $dt;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereDtSQL($sql, $value = "")
    {
        $this->sqls['wheredt'] = '`dt`=' . $sql;
        if ($value) {
            $this->binds['wheredt'] = $value;
        }
        return $this;
    }
    protected $servicename;

    /**
     * out:服务名称
     * @param mixed $servicename
     * @return $this
     */
    public function setServicename($servicename)
    {
        $this->sqls['servicename'] = "`servicename`=:servicename";
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
        $this->sqls['servicename'] = '`servicename`=' . $sql;
        if ($value) {
            $this->binds['servicename'] = $value;
        }
        return $this;
    }

    /**
     * out:服务名称
     * @param mixed $servicename
     * @return $this
     */
    public function whereServicename(string $servicename,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['whereservicename'] = "`servicename`$action:whereservicename";
        $this->binds['whereservicename'] = $servicename;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereServicenameSQL($sql, $value = "")
    {
        $this->sqls['whereservicename'] = '`servicename`=' . $sql;
        if ($value) {
            $this->binds['whereservicename'] = $value;
        }
        return $this;
    }
    protected $process;

    /**
     * out:进程名字
     * @param mixed $process
     * @return $this
     */
    public function setProcess($process)
    {
        $this->sqls['process'] = "`process`=:process";
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
        $this->sqls['process'] = '`process`=' . $sql;
        if ($value) {
            $this->binds['process'] = $value;
        }
        return $this;
    }

    /**
     * out:进程名字
     * @param mixed $process
     * @return $this
     */
    public function whereProcess(string $process,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['whereprocess'] = "`process`$action:whereprocess";
        $this->binds['whereprocess'] = $process;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereProcessSQL($sql, $value = "")
    {
        $this->sqls['whereprocess'] = '`process`=' . $sql;
        if ($value) {
            $this->binds['whereprocess'] = $value;
        }
        return $this;
    }
    protected $num;

    /**
     * out:数值
     * @param mixed $num
     * @return $this
     */
    public function setNum($num)
    {
        $this->sqls['num'] = "`num`=:num";
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
        $this->sqls['num'] = '`num`=' . $sql;
        if ($value) {
            $this->binds['num'] = $value;
        }
        return $this;
    }

    /**
     * out:数值
     * @param mixed $num
     * @return $this
     */
    public function whereNum(string $num,$action=PdoAction::EQUAL)
    {
        $this->whereSqls['wherenum'] = "`num`$action:wherenum";
        $this->binds['wherenum'] = $num;
        return $this;
    }

    /**
     * 写入sql原型
     * @param mixed $sql
     * @param $value
     * @return $this
     */
    public function whereNumSQL($sql, $value = "")
    {
        $this->sqls['wherenum'] = '`num`=' . $sql;
        if ($value) {
            $this->binds['wherenum'] = $value;
        }
        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 5:31
 */

namespace xltxlm\ormTool\Config;

use xltxlm\ormTool\Config\Service_data;
use xltxlm\ormTool\Config\Service_dataModel;
use \xltxlm\ormTool\Template\PdoAction;
use \xltxlm\ormTool\Template\Select;
/**
 * Class select
 */
final class Service_dataSelectOne extends Select
{
    /** @var bool  一维查询 还是 二维查询 */
    protected $moreData = false;
    /** @var array 参数执行次数存储 */
    protected $execCount=[];

    /** @var string  模型类 */
    protected $modelClass = Service_dataModel::class;

    final public function __construct()
    {
        $this->tableObject=(new Service_data);
    }


    /**
     * out:自增id
     * @param mixed $id
     * @return $this
     */
    public function whereId(string $id,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['id']?$this->execCount['id']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['id'.$uniqid] = "$action(service_data.id,:id$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['id'.$uniqid] = "service_data.id$action:id$uniqid";
            $this->binds['id'.$uniqid] = "%$id%";
        }else{
            $this->sqls['id'.$uniqid] = "service_data.id$action:id$uniqid";
        }
        $this->binds['id'.$uniqid] = $id;
        $this->execCount['id']++;
        return $this;
    }
    /**
     * out:自增id
     * @param mixed $id
     * @return $this
     */
    public function whereIdNULL($id=true)
    {
        $uniqid=$this->execCount['id']?$this->execCount['id']:null;
        if($id == true)
        {
            $this->sqls['id'.$uniqid] = "service_data.id IS NULL";
        }else
        {
            $this->sqls['id'.$uniqid] = "service_data.id IS NOT NULL";
        }
        $this->execCount['id']++;
        return $this;
    }
    /**
     * out:自增id
     * @param mixed $id
     * @return $this
     */
    public function whereIdMaybe(string$id,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($id) || strlen($id)>0){
            $uniqid=$this->execCount['id']?$this->execCount['id']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$id,2);
                $this->sqls['id'.$uniqid] = "service_data.id >= :id$uniqid";
                $this->binds['id'.$uniqid] = $start;
                $this->execCount['id']++;

                $uniqid=$this->execCount['id']?$this->execCount['id']:null;
                $this->sqls['id'.$uniqid] = "service_data.id <= :id$uniqid";
                $this->binds['id'.$uniqid] = $end;
                $this->execCount['id']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['id'.$uniqid] = "$action(service_data.id,:id$uniqid)=0";
                $this->binds['id'.$uniqid] = $id;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['id'.$uniqid] = "service_data.id$action:id$uniqid";
                $this->binds['id'.$uniqid] = "%$id%";
            }else
            {
                $this->sqls['id'.$uniqid] = "service_data.id$action:id$uniqid";
                $this->binds['id'.$uniqid] = $id;
                $this->execCount['id']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderIdAsc()
    {
        $this->sqlsOrder['id'] = "service_data.id ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderIdDesc()
    {
        $this->sqlsOrder['id'] = "service_data.id DESC";
        return $this;
    }

    /**
     * out:日期
     * @param mixed $dt
     * @return $this
     */
    public function whereDt(string $dt,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['dt']?$this->execCount['dt']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['dt'.$uniqid] = "$action(service_data.dt,:dt$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['dt'.$uniqid] = "service_data.dt$action:dt$uniqid";
            $this->binds['dt'.$uniqid] = "%$dt%";
        }else{
            $this->sqls['dt'.$uniqid] = "service_data.dt$action:dt$uniqid";
        }
        $this->binds['dt'.$uniqid] = $dt;
        $this->execCount['dt']++;
        return $this;
    }
    /**
     * out:日期
     * @param mixed $dt
     * @return $this
     */
    public function whereDtNULL($dt=true)
    {
        $uniqid=$this->execCount['dt']?$this->execCount['dt']:null;
        if($dt == true)
        {
            $this->sqls['dt'.$uniqid] = "service_data.dt IS NULL";
        }else
        {
            $this->sqls['dt'.$uniqid] = "service_data.dt IS NOT NULL";
        }
        $this->execCount['dt']++;
        return $this;
    }
    /**
     * out:日期
     * @param mixed $dt
     * @return $this
     */
    public function whereDtMaybe(string$dt,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($dt) || strlen($dt)>0){
            $uniqid=$this->execCount['dt']?$this->execCount['dt']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$dt,2);
                $this->sqls['dt'.$uniqid] = "service_data.dt >= :dt$uniqid";
                $this->binds['dt'.$uniqid] = $start;
                $this->execCount['dt']++;

                $uniqid=$this->execCount['dt']?$this->execCount['dt']:null;
                $this->sqls['dt'.$uniqid] = "service_data.dt <= :dt$uniqid";
                $this->binds['dt'.$uniqid] = $end;
                $this->execCount['dt']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['dt'.$uniqid] = "$action(service_data.dt,:dt$uniqid)=0";
                $this->binds['dt'.$uniqid] = $dt;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['dt'.$uniqid] = "service_data.dt$action:dt$uniqid";
                $this->binds['dt'.$uniqid] = "%$dt%";
            }else
            {
                $this->sqls['dt'.$uniqid] = "service_data.dt$action:dt$uniqid";
                $this->binds['dt'.$uniqid] = $dt;
                $this->execCount['dt']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderDtAsc()
    {
        $this->sqlsOrder['dt'] = "service_data.dt ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderDtDesc()
    {
        $this->sqlsOrder['dt'] = "service_data.dt DESC";
        return $this;
    }

    /**
     * out:服务名称
     * @param mixed $servicename
     * @return $this
     */
    public function whereServicename(string $servicename,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['servicename']?$this->execCount['servicename']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['servicename'.$uniqid] = "$action(service_data.servicename,:servicename$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['servicename'.$uniqid] = "service_data.servicename$action:servicename$uniqid";
            $this->binds['servicename'.$uniqid] = "%$servicename%";
        }else{
            $this->sqls['servicename'.$uniqid] = "service_data.servicename$action:servicename$uniqid";
        }
        $this->binds['servicename'.$uniqid] = $servicename;
        $this->execCount['servicename']++;
        return $this;
    }
    /**
     * out:服务名称
     * @param mixed $servicename
     * @return $this
     */
    public function whereServicenameNULL($servicename=true)
    {
        $uniqid=$this->execCount['servicename']?$this->execCount['servicename']:null;
        if($servicename == true)
        {
            $this->sqls['servicename'.$uniqid] = "service_data.servicename IS NULL";
        }else
        {
            $this->sqls['servicename'.$uniqid] = "service_data.servicename IS NOT NULL";
        }
        $this->execCount['servicename']++;
        return $this;
    }
    /**
     * out:服务名称
     * @param mixed $servicename
     * @return $this
     */
    public function whereServicenameMaybe(string$servicename,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($servicename) || strlen($servicename)>0){
            $uniqid=$this->execCount['servicename']?$this->execCount['servicename']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$servicename,2);
                $this->sqls['servicename'.$uniqid] = "service_data.servicename >= :servicename$uniqid";
                $this->binds['servicename'.$uniqid] = $start;
                $this->execCount['servicename']++;

                $uniqid=$this->execCount['servicename']?$this->execCount['servicename']:null;
                $this->sqls['servicename'.$uniqid] = "service_data.servicename <= :servicename$uniqid";
                $this->binds['servicename'.$uniqid] = $end;
                $this->execCount['servicename']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['servicename'.$uniqid] = "$action(service_data.servicename,:servicename$uniqid)=0";
                $this->binds['servicename'.$uniqid] = $servicename;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['servicename'.$uniqid] = "service_data.servicename$action:servicename$uniqid";
                $this->binds['servicename'.$uniqid] = "%$servicename%";
            }else
            {
                $this->sqls['servicename'.$uniqid] = "service_data.servicename$action:servicename$uniqid";
                $this->binds['servicename'.$uniqid] = $servicename;
                $this->execCount['servicename']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderServicenameAsc()
    {
        $this->sqlsOrder['servicename'] = "service_data.servicename ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderServicenameDesc()
    {
        $this->sqlsOrder['servicename'] = "service_data.servicename DESC";
        return $this;
    }

    /**
     * out:进程名字
     * @param mixed $process
     * @return $this
     */
    public function whereProcess(string $process,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['process']?$this->execCount['process']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['process'.$uniqid] = "$action(service_data.process,:process$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['process'.$uniqid] = "service_data.process$action:process$uniqid";
            $this->binds['process'.$uniqid] = "%$process%";
        }else{
            $this->sqls['process'.$uniqid] = "service_data.process$action:process$uniqid";
        }
        $this->binds['process'.$uniqid] = $process;
        $this->execCount['process']++;
        return $this;
    }
    /**
     * out:进程名字
     * @param mixed $process
     * @return $this
     */
    public function whereProcessNULL($process=true)
    {
        $uniqid=$this->execCount['process']?$this->execCount['process']:null;
        if($process == true)
        {
            $this->sqls['process'.$uniqid] = "service_data.process IS NULL";
        }else
        {
            $this->sqls['process'.$uniqid] = "service_data.process IS NOT NULL";
        }
        $this->execCount['process']++;
        return $this;
    }
    /**
     * out:进程名字
     * @param mixed $process
     * @return $this
     */
    public function whereProcessMaybe(string$process,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($process) || strlen($process)>0){
            $uniqid=$this->execCount['process']?$this->execCount['process']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$process,2);
                $this->sqls['process'.$uniqid] = "service_data.process >= :process$uniqid";
                $this->binds['process'.$uniqid] = $start;
                $this->execCount['process']++;

                $uniqid=$this->execCount['process']?$this->execCount['process']:null;
                $this->sqls['process'.$uniqid] = "service_data.process <= :process$uniqid";
                $this->binds['process'.$uniqid] = $end;
                $this->execCount['process']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['process'.$uniqid] = "$action(service_data.process,:process$uniqid)=0";
                $this->binds['process'.$uniqid] = $process;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['process'.$uniqid] = "service_data.process$action:process$uniqid";
                $this->binds['process'.$uniqid] = "%$process%";
            }else
            {
                $this->sqls['process'.$uniqid] = "service_data.process$action:process$uniqid";
                $this->binds['process'.$uniqid] = $process;
                $this->execCount['process']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderProcessAsc()
    {
        $this->sqlsOrder['process'] = "service_data.process ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderProcessDesc()
    {
        $this->sqlsOrder['process'] = "service_data.process DESC";
        return $this;
    }

    /**
     * out:数值
     * @param mixed $num
     * @return $this
     */
    public function whereNum(string $num,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['num']?$this->execCount['num']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['num'.$uniqid] = "$action(service_data.num,:num$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['num'.$uniqid] = "service_data.num$action:num$uniqid";
            $this->binds['num'.$uniqid] = "%$num%";
        }else{
            $this->sqls['num'.$uniqid] = "service_data.num$action:num$uniqid";
        }
        $this->binds['num'.$uniqid] = $num;
        $this->execCount['num']++;
        return $this;
    }
    /**
     * out:数值
     * @param mixed $num
     * @return $this
     */
    public function whereNumNULL($num=true)
    {
        $uniqid=$this->execCount['num']?$this->execCount['num']:null;
        if($num == true)
        {
            $this->sqls['num'.$uniqid] = "service_data.num IS NULL";
        }else
        {
            $this->sqls['num'.$uniqid] = "service_data.num IS NOT NULL";
        }
        $this->execCount['num']++;
        return $this;
    }
    /**
     * out:数值
     * @param mixed $num
     * @return $this
     */
    public function whereNumMaybe(string$num,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($num) || strlen($num)>0){
            $uniqid=$this->execCount['num']?$this->execCount['num']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$num,2);
                $this->sqls['num'.$uniqid] = "service_data.num >= :num$uniqid";
                $this->binds['num'.$uniqid] = $start;
                $this->execCount['num']++;

                $uniqid=$this->execCount['num']?$this->execCount['num']:null;
                $this->sqls['num'.$uniqid] = "service_data.num <= :num$uniqid";
                $this->binds['num'.$uniqid] = $end;
                $this->execCount['num']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['num'.$uniqid] = "$action(service_data.num,:num$uniqid)=0";
                $this->binds['num'.$uniqid] = $num;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['num'.$uniqid] = "service_data.num$action:num$uniqid";
                $this->binds['num'.$uniqid] = "%$num%";
            }else
            {
                $this->sqls['num'.$uniqid] = "service_data.num$action:num$uniqid";
                $this->binds['num'.$uniqid] = $num;
                $this->execCount['num']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderNumAsc()
    {
        $this->sqlsOrder['num'] = "service_data.num ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderNumDesc()
    {
        $this->sqlsOrder['num'] = "service_data.num DESC";
        return $this;
    }



    /**
     * 写入sql原型
     * @param mixed $sql
     * @param array $value
     * @return $this
     */
    public function setSQL($sql, $value = [])
    {
        $this->sqls[] = $sql;
        if ($value) {
            $this->binds = array_merge($this->binds,$value);
        }
        return $this;
    }

    /**
     * @return Service_dataModel
     */
    final public function __invoke()
    {
        return parent::__invoke();
    }
}

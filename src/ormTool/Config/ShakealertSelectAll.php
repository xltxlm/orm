<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 下午 5:31
 */

namespace xltxlm\ormTool\Config;

use \xltxlm\ormTool\Template\PdoAction;
use \xltxlm\ormTool\Template\Select;
/**
 * Class select
 */
final class ShakealertSelectAll extends Select
{
    /** @var bool  一维查询 还是 二维查询 */
    protected $moreData = true;
    /** @var array 参数执行次数存储 */
    protected $execCount=[];

    /** @var string  模型类 */
    protected $modelClass = ShakealertModel::class;

    final public function __construct()
    {
        $this->tableObject=(new Shakealert);
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
            $this->sqls['id'.$uniqid] = "shakealert.id$action:(id$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['id'.$uniqid] = "shakealert.id$action:id$uniqid";
            $this->binds['id'.$uniqid] = "%$id%";
        }else{
            $this->sqls['id'.$uniqid] = "shakealert.id$action:id$uniqid";
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
            $this->sqls['id'.$uniqid] = "shakealert.id IS NULL";
        }else
        {
            $this->sqls['id'.$uniqid] = "shakealert.id IS NOT NULL";
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
                $this->sqls['id'.$uniqid] = "shakealert.id >= :id$uniqid";
                $this->binds['id'.$uniqid] = $start;
                $this->execCount['id']++;

                $uniqid=$this->execCount['id']?$this->execCount['id']:null;
                $this->sqls['id'.$uniqid] = "shakealert.id <= :id$uniqid";
                $this->binds['id'.$uniqid] = $end;
                $this->execCount['id']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['id'.$uniqid] = "$action(shakealert.id,:id$uniqid)=0";
                $this->binds['id'.$uniqid] = $id;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['id'.$uniqid] = "shakealert.id$action:id$uniqid";
                $this->binds['id'.$uniqid] = "%$id%";
            }else
            {
                $this->sqls['id'.$uniqid] = "shakealert.id$action:id$uniqid";
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
        $this->sqlsOrder['id'] = "shakealert.id ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderIdDesc()
    {
        $this->sqlsOrder['id'] = "shakealert.id DESC";
        return $this;
    }

    /**
     * out:日期
     * @param mixed $dtvalue
     * @return $this
     */
    public function whereDtvalue(string $dtvalue,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['dtvalue']?$this->execCount['dtvalue']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue$action:(dtvalue$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue$action:dtvalue$uniqid";
            $this->binds['dtvalue'.$uniqid] = "%$dtvalue%";
        }else{
            $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue$action:dtvalue$uniqid";
        }
        $this->binds['dtvalue'.$uniqid] = $dtvalue;
        $this->execCount['dtvalue']++;
        return $this;
    }
    /**
     * out:日期
     * @param mixed $dtvalue
     * @return $this
     */
    public function whereDtvalueNULL($dtvalue=true)
    {
        $uniqid=$this->execCount['dtvalue']?$this->execCount['dtvalue']:null;
        if($dtvalue == true)
        {
            $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue IS NULL";
        }else
        {
            $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue IS NOT NULL";
        }
        $this->execCount['dtvalue']++;
        return $this;
    }
    /**
     * out:日期
     * @param mixed $dtvalue
     * @return $this
     */
    public function whereDtvalueMaybe(string$dtvalue,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($dtvalue) || strlen($dtvalue)>0){
            $uniqid=$this->execCount['dtvalue']?$this->execCount['dtvalue']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$dtvalue,2);
                $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue >= :dtvalue$uniqid";
                $this->binds['dtvalue'.$uniqid] = $start;
                $this->execCount['dtvalue']++;

                $uniqid=$this->execCount['dtvalue']?$this->execCount['dtvalue']:null;
                $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue <= :dtvalue$uniqid";
                $this->binds['dtvalue'.$uniqid] = $end;
                $this->execCount['dtvalue']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['dtvalue'.$uniqid] = "$action(shakealert.dtvalue,:dtvalue$uniqid)=0";
                $this->binds['dtvalue'.$uniqid] = $dtvalue;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue$action:dtvalue$uniqid";
                $this->binds['dtvalue'.$uniqid] = "%$dtvalue%";
            }else
            {
                $this->sqls['dtvalue'.$uniqid] = "shakealert.dtvalue$action:dtvalue$uniqid";
                $this->binds['dtvalue'.$uniqid] = $dtvalue;
                $this->execCount['dtvalue']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderDtvalueAsc()
    {
        $this->sqlsOrder['dtvalue'] = "shakealert.dtvalue ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderDtvalueDesc()
    {
        $this->sqlsOrder['dtvalue'] = "shakealert.dtvalue DESC";
        return $this;
    }

    /**
     * out:日期字段
     * @param mixed $dtfieldname
     * @return $this
     */
    public function whereDtfieldname(string $dtfieldname,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['dtfieldname']?$this->execCount['dtfieldname']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname$action:(dtfieldname$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname$action:dtfieldname$uniqid";
            $this->binds['dtfieldname'.$uniqid] = "%$dtfieldname%";
        }else{
            $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname$action:dtfieldname$uniqid";
        }
        $this->binds['dtfieldname'.$uniqid] = $dtfieldname;
        $this->execCount['dtfieldname']++;
        return $this;
    }
    /**
     * out:日期字段
     * @param mixed $dtfieldname
     * @return $this
     */
    public function whereDtfieldnameNULL($dtfieldname=true)
    {
        $uniqid=$this->execCount['dtfieldname']?$this->execCount['dtfieldname']:null;
        if($dtfieldname == true)
        {
            $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname IS NULL";
        }else
        {
            $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname IS NOT NULL";
        }
        $this->execCount['dtfieldname']++;
        return $this;
    }
    /**
     * out:日期字段
     * @param mixed $dtfieldname
     * @return $this
     */
    public function whereDtfieldnameMaybe(string$dtfieldname,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($dtfieldname) || strlen($dtfieldname)>0){
            $uniqid=$this->execCount['dtfieldname']?$this->execCount['dtfieldname']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$dtfieldname,2);
                $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname >= :dtfieldname$uniqid";
                $this->binds['dtfieldname'.$uniqid] = $start;
                $this->execCount['dtfieldname']++;

                $uniqid=$this->execCount['dtfieldname']?$this->execCount['dtfieldname']:null;
                $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname <= :dtfieldname$uniqid";
                $this->binds['dtfieldname'.$uniqid] = $end;
                $this->execCount['dtfieldname']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['dtfieldname'.$uniqid] = "$action(shakealert.dtfieldname,:dtfieldname$uniqid)=0";
                $this->binds['dtfieldname'.$uniqid] = $dtfieldname;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname$action:dtfieldname$uniqid";
                $this->binds['dtfieldname'.$uniqid] = "%$dtfieldname%";
            }else
            {
                $this->sqls['dtfieldname'.$uniqid] = "shakealert.dtfieldname$action:dtfieldname$uniqid";
                $this->binds['dtfieldname'.$uniqid] = $dtfieldname;
                $this->execCount['dtfieldname']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderDtfieldnameAsc()
    {
        $this->sqlsOrder['dtfieldname'] = "shakealert.dtfieldname ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderDtfieldnameDesc()
    {
        $this->sqlsOrder['dtfieldname'] = "shakealert.dtfieldname DESC";
        return $this;
    }

    /**
     * out:表格名称
     * @param mixed $tablename
     * @return $this
     */
    public function whereTablename(string $tablename,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['tablename']?$this->execCount['tablename']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['tablename'.$uniqid] = "shakealert.tablename$action:(tablename$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['tablename'.$uniqid] = "shakealert.tablename$action:tablename$uniqid";
            $this->binds['tablename'.$uniqid] = "%$tablename%";
        }else{
            $this->sqls['tablename'.$uniqid] = "shakealert.tablename$action:tablename$uniqid";
        }
        $this->binds['tablename'.$uniqid] = $tablename;
        $this->execCount['tablename']++;
        return $this;
    }
    /**
     * out:表格名称
     * @param mixed $tablename
     * @return $this
     */
    public function whereTablenameNULL($tablename=true)
    {
        $uniqid=$this->execCount['tablename']?$this->execCount['tablename']:null;
        if($tablename == true)
        {
            $this->sqls['tablename'.$uniqid] = "shakealert.tablename IS NULL";
        }else
        {
            $this->sqls['tablename'.$uniqid] = "shakealert.tablename IS NOT NULL";
        }
        $this->execCount['tablename']++;
        return $this;
    }
    /**
     * out:表格名称
     * @param mixed $tablename
     * @return $this
     */
    public function whereTablenameMaybe(string$tablename,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($tablename) || strlen($tablename)>0){
            $uniqid=$this->execCount['tablename']?$this->execCount['tablename']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$tablename,2);
                $this->sqls['tablename'.$uniqid] = "shakealert.tablename >= :tablename$uniqid";
                $this->binds['tablename'.$uniqid] = $start;
                $this->execCount['tablename']++;

                $uniqid=$this->execCount['tablename']?$this->execCount['tablename']:null;
                $this->sqls['tablename'.$uniqid] = "shakealert.tablename <= :tablename$uniqid";
                $this->binds['tablename'.$uniqid] = $end;
                $this->execCount['tablename']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['tablename'.$uniqid] = "$action(shakealert.tablename,:tablename$uniqid)=0";
                $this->binds['tablename'.$uniqid] = $tablename;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['tablename'.$uniqid] = "shakealert.tablename$action:tablename$uniqid";
                $this->binds['tablename'.$uniqid] = "%$tablename%";
            }else
            {
                $this->sqls['tablename'.$uniqid] = "shakealert.tablename$action:tablename$uniqid";
                $this->binds['tablename'.$uniqid] = $tablename;
                $this->execCount['tablename']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderTablenameAsc()
    {
        $this->sqlsOrder['tablename'] = "shakealert.tablename ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderTablenameDesc()
    {
        $this->sqlsOrder['tablename'] = "shakealert.tablename DESC";
        return $this;
    }

    /**
     * out:附加条件
     * @param mixed $condition
     * @return $this
     */
    public function whereCondition(string $condition,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['condition']?$this->execCount['condition']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['condition'.$uniqid] = "shakealert.condition$action:(condition$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['condition'.$uniqid] = "shakealert.condition$action:condition$uniqid";
            $this->binds['condition'.$uniqid] = "%$condition%";
        }else{
            $this->sqls['condition'.$uniqid] = "shakealert.condition$action:condition$uniqid";
        }
        $this->binds['condition'.$uniqid] = $condition;
        $this->execCount['condition']++;
        return $this;
    }
    /**
     * out:附加条件
     * @param mixed $condition
     * @return $this
     */
    public function whereConditionNULL($condition=true)
    {
        $uniqid=$this->execCount['condition']?$this->execCount['condition']:null;
        if($condition == true)
        {
            $this->sqls['condition'.$uniqid] = "shakealert.condition IS NULL";
        }else
        {
            $this->sqls['condition'.$uniqid] = "shakealert.condition IS NOT NULL";
        }
        $this->execCount['condition']++;
        return $this;
    }
    /**
     * out:附加条件
     * @param mixed $condition
     * @return $this
     */
    public function whereConditionMaybe(string$condition,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($condition) || strlen($condition)>0){
            $uniqid=$this->execCount['condition']?$this->execCount['condition']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$condition,2);
                $this->sqls['condition'.$uniqid] = "shakealert.condition >= :condition$uniqid";
                $this->binds['condition'.$uniqid] = $start;
                $this->execCount['condition']++;

                $uniqid=$this->execCount['condition']?$this->execCount['condition']:null;
                $this->sqls['condition'.$uniqid] = "shakealert.condition <= :condition$uniqid";
                $this->binds['condition'.$uniqid] = $end;
                $this->execCount['condition']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['condition'.$uniqid] = "$action(shakealert.condition,:condition$uniqid)=0";
                $this->binds['condition'.$uniqid] = $condition;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['condition'.$uniqid] = "shakealert.condition$action:condition$uniqid";
                $this->binds['condition'.$uniqid] = "%$condition%";
            }else
            {
                $this->sqls['condition'.$uniqid] = "shakealert.condition$action:condition$uniqid";
                $this->binds['condition'.$uniqid] = $condition;
                $this->execCount['condition']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderConditionAsc()
    {
        $this->sqlsOrder['condition'] = "shakealert.condition ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderConditionDesc()
    {
        $this->sqlsOrder['condition'] = "shakealert.condition DESC";
        return $this;
    }

    /**
     * out:字段名称
     * @param mixed $fieldname
     * @return $this
     */
    public function whereFieldname(string $fieldname,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['fieldname']?$this->execCount['fieldname']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname$action:(fieldname$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname$action:fieldname$uniqid";
            $this->binds['fieldname'.$uniqid] = "%$fieldname%";
        }else{
            $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname$action:fieldname$uniqid";
        }
        $this->binds['fieldname'.$uniqid] = $fieldname;
        $this->execCount['fieldname']++;
        return $this;
    }
    /**
     * out:字段名称
     * @param mixed $fieldname
     * @return $this
     */
    public function whereFieldnameNULL($fieldname=true)
    {
        $uniqid=$this->execCount['fieldname']?$this->execCount['fieldname']:null;
        if($fieldname == true)
        {
            $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname IS NULL";
        }else
        {
            $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname IS NOT NULL";
        }
        $this->execCount['fieldname']++;
        return $this;
    }
    /**
     * out:字段名称
     * @param mixed $fieldname
     * @return $this
     */
    public function whereFieldnameMaybe(string$fieldname,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($fieldname) || strlen($fieldname)>0){
            $uniqid=$this->execCount['fieldname']?$this->execCount['fieldname']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$fieldname,2);
                $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname >= :fieldname$uniqid";
                $this->binds['fieldname'.$uniqid] = $start;
                $this->execCount['fieldname']++;

                $uniqid=$this->execCount['fieldname']?$this->execCount['fieldname']:null;
                $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname <= :fieldname$uniqid";
                $this->binds['fieldname'.$uniqid] = $end;
                $this->execCount['fieldname']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['fieldname'.$uniqid] = "$action(shakealert.fieldname,:fieldname$uniqid)=0";
                $this->binds['fieldname'.$uniqid] = $fieldname;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname$action:fieldname$uniqid";
                $this->binds['fieldname'.$uniqid] = "%$fieldname%";
            }else
            {
                $this->sqls['fieldname'.$uniqid] = "shakealert.fieldname$action:fieldname$uniqid";
                $this->binds['fieldname'.$uniqid] = $fieldname;
                $this->execCount['fieldname']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderFieldnameAsc()
    {
        $this->sqlsOrder['fieldname'] = "shakealert.fieldname ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderFieldnameDesc()
    {
        $this->sqlsOrder['fieldname'] = "shakealert.fieldname DESC";
        return $this;
    }

    /**
     * out:1天前数据
     * @param mixed $fieldname1day
     * @return $this
     */
    public function whereFieldname1day(string $fieldname1day,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['fieldname1day']?$this->execCount['fieldname1day']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day$action:(fieldname1day$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day$action:fieldname1day$uniqid";
            $this->binds['fieldname1day'.$uniqid] = "%$fieldname1day%";
        }else{
            $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day$action:fieldname1day$uniqid";
        }
        $this->binds['fieldname1day'.$uniqid] = $fieldname1day;
        $this->execCount['fieldname1day']++;
        return $this;
    }
    /**
     * out:1天前数据
     * @param mixed $fieldname1day
     * @return $this
     */
    public function whereFieldname1dayNULL($fieldname1day=true)
    {
        $uniqid=$this->execCount['fieldname1day']?$this->execCount['fieldname1day']:null;
        if($fieldname1day == true)
        {
            $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day IS NULL";
        }else
        {
            $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day IS NOT NULL";
        }
        $this->execCount['fieldname1day']++;
        return $this;
    }
    /**
     * out:1天前数据
     * @param mixed $fieldname1day
     * @return $this
     */
    public function whereFieldname1dayMaybe(string$fieldname1day,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($fieldname1day) || strlen($fieldname1day)>0){
            $uniqid=$this->execCount['fieldname1day']?$this->execCount['fieldname1day']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$fieldname1day,2);
                $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day >= :fieldname1day$uniqid";
                $this->binds['fieldname1day'.$uniqid] = $start;
                $this->execCount['fieldname1day']++;

                $uniqid=$this->execCount['fieldname1day']?$this->execCount['fieldname1day']:null;
                $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day <= :fieldname1day$uniqid";
                $this->binds['fieldname1day'.$uniqid] = $end;
                $this->execCount['fieldname1day']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['fieldname1day'.$uniqid] = "$action(shakealert.fieldname1day,:fieldname1day$uniqid)=0";
                $this->binds['fieldname1day'.$uniqid] = $fieldname1day;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day$action:fieldname1day$uniqid";
                $this->binds['fieldname1day'.$uniqid] = "%$fieldname1day%";
            }else
            {
                $this->sqls['fieldname1day'.$uniqid] = "shakealert.fieldname1day$action:fieldname1day$uniqid";
                $this->binds['fieldname1day'.$uniqid] = $fieldname1day;
                $this->execCount['fieldname1day']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderFieldname1dayAsc()
    {
        $this->sqlsOrder['fieldname1day'] = "shakealert.fieldname1day ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderFieldname1dayDesc()
    {
        $this->sqlsOrder['fieldname1day'] = "shakealert.fieldname1day DESC";
        return $this;
    }

    /**
     * out:1天前百分比
     * @param mixed $fieldname1dayratio
     * @return $this
     */
    public function whereFieldname1dayratio(string $fieldname1dayratio,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['fieldname1dayratio']?$this->execCount['fieldname1dayratio']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio$action:(fieldname1dayratio$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio$action:fieldname1dayratio$uniqid";
            $this->binds['fieldname1dayratio'.$uniqid] = "%$fieldname1dayratio%";
        }else{
            $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio$action:fieldname1dayratio$uniqid";
        }
        $this->binds['fieldname1dayratio'.$uniqid] = $fieldname1dayratio;
        $this->execCount['fieldname1dayratio']++;
        return $this;
    }
    /**
     * out:1天前百分比
     * @param mixed $fieldname1dayratio
     * @return $this
     */
    public function whereFieldname1dayratioNULL($fieldname1dayratio=true)
    {
        $uniqid=$this->execCount['fieldname1dayratio']?$this->execCount['fieldname1dayratio']:null;
        if($fieldname1dayratio == true)
        {
            $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio IS NULL";
        }else
        {
            $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio IS NOT NULL";
        }
        $this->execCount['fieldname1dayratio']++;
        return $this;
    }
    /**
     * out:1天前百分比
     * @param mixed $fieldname1dayratio
     * @return $this
     */
    public function whereFieldname1dayratioMaybe(string$fieldname1dayratio,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($fieldname1dayratio) || strlen($fieldname1dayratio)>0){
            $uniqid=$this->execCount['fieldname1dayratio']?$this->execCount['fieldname1dayratio']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$fieldname1dayratio,2);
                $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio >= :fieldname1dayratio$uniqid";
                $this->binds['fieldname1dayratio'.$uniqid] = $start;
                $this->execCount['fieldname1dayratio']++;

                $uniqid=$this->execCount['fieldname1dayratio']?$this->execCount['fieldname1dayratio']:null;
                $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio <= :fieldname1dayratio$uniqid";
                $this->binds['fieldname1dayratio'.$uniqid] = $end;
                $this->execCount['fieldname1dayratio']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['fieldname1dayratio'.$uniqid] = "$action(shakealert.fieldname1dayratio,:fieldname1dayratio$uniqid)=0";
                $this->binds['fieldname1dayratio'.$uniqid] = $fieldname1dayratio;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio$action:fieldname1dayratio$uniqid";
                $this->binds['fieldname1dayratio'.$uniqid] = "%$fieldname1dayratio%";
            }else
            {
                $this->sqls['fieldname1dayratio'.$uniqid] = "shakealert.fieldname1dayratio$action:fieldname1dayratio$uniqid";
                $this->binds['fieldname1dayratio'.$uniqid] = $fieldname1dayratio;
                $this->execCount['fieldname1dayratio']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderFieldname1dayratioAsc()
    {
        $this->sqlsOrder['fieldname1dayratio'] = "shakealert.fieldname1dayratio ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderFieldname1dayratioDesc()
    {
        $this->sqlsOrder['fieldname1dayratio'] = "shakealert.fieldname1dayratio DESC";
        return $this;
    }

    /**
     * out:1周前数据
     * @param mixed $fieldname1week
     * @return $this
     */
    public function whereFieldname1week(string $fieldname1week,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['fieldname1week']?$this->execCount['fieldname1week']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week$action:(fieldname1week$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week$action:fieldname1week$uniqid";
            $this->binds['fieldname1week'.$uniqid] = "%$fieldname1week%";
        }else{
            $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week$action:fieldname1week$uniqid";
        }
        $this->binds['fieldname1week'.$uniqid] = $fieldname1week;
        $this->execCount['fieldname1week']++;
        return $this;
    }
    /**
     * out:1周前数据
     * @param mixed $fieldname1week
     * @return $this
     */
    public function whereFieldname1weekNULL($fieldname1week=true)
    {
        $uniqid=$this->execCount['fieldname1week']?$this->execCount['fieldname1week']:null;
        if($fieldname1week == true)
        {
            $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week IS NULL";
        }else
        {
            $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week IS NOT NULL";
        }
        $this->execCount['fieldname1week']++;
        return $this;
    }
    /**
     * out:1周前数据
     * @param mixed $fieldname1week
     * @return $this
     */
    public function whereFieldname1weekMaybe(string$fieldname1week,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($fieldname1week) || strlen($fieldname1week)>0){
            $uniqid=$this->execCount['fieldname1week']?$this->execCount['fieldname1week']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$fieldname1week,2);
                $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week >= :fieldname1week$uniqid";
                $this->binds['fieldname1week'.$uniqid] = $start;
                $this->execCount['fieldname1week']++;

                $uniqid=$this->execCount['fieldname1week']?$this->execCount['fieldname1week']:null;
                $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week <= :fieldname1week$uniqid";
                $this->binds['fieldname1week'.$uniqid] = $end;
                $this->execCount['fieldname1week']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['fieldname1week'.$uniqid] = "$action(shakealert.fieldname1week,:fieldname1week$uniqid)=0";
                $this->binds['fieldname1week'.$uniqid] = $fieldname1week;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week$action:fieldname1week$uniqid";
                $this->binds['fieldname1week'.$uniqid] = "%$fieldname1week%";
            }else
            {
                $this->sqls['fieldname1week'.$uniqid] = "shakealert.fieldname1week$action:fieldname1week$uniqid";
                $this->binds['fieldname1week'.$uniqid] = $fieldname1week;
                $this->execCount['fieldname1week']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderFieldname1weekAsc()
    {
        $this->sqlsOrder['fieldname1week'] = "shakealert.fieldname1week ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderFieldname1weekDesc()
    {
        $this->sqlsOrder['fieldname1week'] = "shakealert.fieldname1week DESC";
        return $this;
    }

    /**
     * out:1周前百分比
     * @param mixed $fieldname1weekratio
     * @return $this
     */
    public function whereFieldname1weekratio(string $fieldname1weekratio,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['fieldname1weekratio']?$this->execCount['fieldname1weekratio']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio$action:(fieldname1weekratio$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio$action:fieldname1weekratio$uniqid";
            $this->binds['fieldname1weekratio'.$uniqid] = "%$fieldname1weekratio%";
        }else{
            $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio$action:fieldname1weekratio$uniqid";
        }
        $this->binds['fieldname1weekratio'.$uniqid] = $fieldname1weekratio;
        $this->execCount['fieldname1weekratio']++;
        return $this;
    }
    /**
     * out:1周前百分比
     * @param mixed $fieldname1weekratio
     * @return $this
     */
    public function whereFieldname1weekratioNULL($fieldname1weekratio=true)
    {
        $uniqid=$this->execCount['fieldname1weekratio']?$this->execCount['fieldname1weekratio']:null;
        if($fieldname1weekratio == true)
        {
            $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio IS NULL";
        }else
        {
            $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio IS NOT NULL";
        }
        $this->execCount['fieldname1weekratio']++;
        return $this;
    }
    /**
     * out:1周前百分比
     * @param mixed $fieldname1weekratio
     * @return $this
     */
    public function whereFieldname1weekratioMaybe(string$fieldname1weekratio,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($fieldname1weekratio) || strlen($fieldname1weekratio)>0){
            $uniqid=$this->execCount['fieldname1weekratio']?$this->execCount['fieldname1weekratio']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$fieldname1weekratio,2);
                $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio >= :fieldname1weekratio$uniqid";
                $this->binds['fieldname1weekratio'.$uniqid] = $start;
                $this->execCount['fieldname1weekratio']++;

                $uniqid=$this->execCount['fieldname1weekratio']?$this->execCount['fieldname1weekratio']:null;
                $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio <= :fieldname1weekratio$uniqid";
                $this->binds['fieldname1weekratio'.$uniqid] = $end;
                $this->execCount['fieldname1weekratio']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['fieldname1weekratio'.$uniqid] = "$action(shakealert.fieldname1weekratio,:fieldname1weekratio$uniqid)=0";
                $this->binds['fieldname1weekratio'.$uniqid] = $fieldname1weekratio;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio$action:fieldname1weekratio$uniqid";
                $this->binds['fieldname1weekratio'.$uniqid] = "%$fieldname1weekratio%";
            }else
            {
                $this->sqls['fieldname1weekratio'.$uniqid] = "shakealert.fieldname1weekratio$action:fieldname1weekratio$uniqid";
                $this->binds['fieldname1weekratio'.$uniqid] = $fieldname1weekratio;
                $this->execCount['fieldname1weekratio']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderFieldname1weekratioAsc()
    {
        $this->sqlsOrder['fieldname1weekratio'] = "shakealert.fieldname1weekratio ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderFieldname1weekratioDesc()
    {
        $this->sqlsOrder['fieldname1weekratio'] = "shakealert.fieldname1weekratio DESC";
        return $this;
    }

    /**
     * out:新数据
     * @param mixed $fieldnamenew
     * @return $this
     */
    public function whereFieldnamenew(string $fieldnamenew,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['fieldnamenew']?$this->execCount['fieldnamenew']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew$action:(fieldnamenew$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew$action:fieldnamenew$uniqid";
            $this->binds['fieldnamenew'.$uniqid] = "%$fieldnamenew%";
        }else{
            $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew$action:fieldnamenew$uniqid";
        }
        $this->binds['fieldnamenew'.$uniqid] = $fieldnamenew;
        $this->execCount['fieldnamenew']++;
        return $this;
    }
    /**
     * out:新数据
     * @param mixed $fieldnamenew
     * @return $this
     */
    public function whereFieldnamenewNULL($fieldnamenew=true)
    {
        $uniqid=$this->execCount['fieldnamenew']?$this->execCount['fieldnamenew']:null;
        if($fieldnamenew == true)
        {
            $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew IS NULL";
        }else
        {
            $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew IS NOT NULL";
        }
        $this->execCount['fieldnamenew']++;
        return $this;
    }
    /**
     * out:新数据
     * @param mixed $fieldnamenew
     * @return $this
     */
    public function whereFieldnamenewMaybe(string$fieldnamenew,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($fieldnamenew) || strlen($fieldnamenew)>0){
            $uniqid=$this->execCount['fieldnamenew']?$this->execCount['fieldnamenew']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$fieldnamenew,2);
                $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew >= :fieldnamenew$uniqid";
                $this->binds['fieldnamenew'.$uniqid] = $start;
                $this->execCount['fieldnamenew']++;

                $uniqid=$this->execCount['fieldnamenew']?$this->execCount['fieldnamenew']:null;
                $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew <= :fieldnamenew$uniqid";
                $this->binds['fieldnamenew'.$uniqid] = $end;
                $this->execCount['fieldnamenew']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['fieldnamenew'.$uniqid] = "$action(shakealert.fieldnamenew,:fieldnamenew$uniqid)=0";
                $this->binds['fieldnamenew'.$uniqid] = $fieldnamenew;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew$action:fieldnamenew$uniqid";
                $this->binds['fieldnamenew'.$uniqid] = "%$fieldnamenew%";
            }else
            {
                $this->sqls['fieldnamenew'.$uniqid] = "shakealert.fieldnamenew$action:fieldnamenew$uniqid";
                $this->binds['fieldnamenew'.$uniqid] = $fieldnamenew;
                $this->execCount['fieldnamenew']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderFieldnamenewAsc()
    {
        $this->sqlsOrder['fieldnamenew'] = "shakealert.fieldnamenew ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderFieldnamenewDesc()
    {
        $this->sqlsOrder['fieldnamenew'] = "shakealert.fieldnamenew DESC";
        return $this;
    }

    /**
     * out:创建时间
     * @param mixed $add_time
     * @return $this
     */
    public function whereAdd_time(string $add_time,$action=PdoAction::EQUAL)
    {
        $uniqid=$this->execCount['add_time']?$this->execCount['add_time']:null;
        if($action == PdoAction::NOTLIKE) {
            $this->sqls['add_time'.$uniqid] = "shakealert.add_time$action:(add_time$uniqid)=0";
        }elseif($action == PdoAction::LIKE) {
            $this->sqls['add_time'.$uniqid] = "shakealert.add_time$action:add_time$uniqid";
            $this->binds['add_time'.$uniqid] = "%$add_time%";
        }else{
            $this->sqls['add_time'.$uniqid] = "shakealert.add_time$action:add_time$uniqid";
        }
        $this->binds['add_time'.$uniqid] = $add_time;
        $this->execCount['add_time']++;
        return $this;
    }
    /**
     * out:创建时间
     * @param mixed $add_time
     * @return $this
     */
    public function whereAdd_timeNULL($add_time=true)
    {
        $uniqid=$this->execCount['add_time']?$this->execCount['add_time']:null;
        if($add_time == true)
        {
            $this->sqls['add_time'.$uniqid] = "shakealert.add_time IS NULL";
        }else
        {
            $this->sqls['add_time'.$uniqid] = "shakealert.add_time IS NOT NULL";
        }
        $this->execCount['add_time']++;
        return $this;
    }
    /**
     * out:创建时间
     * @param mixed $add_time
     * @return $this
     */
    public function whereAdd_timeMaybe(string$add_time,$action=PdoAction::EQUAL,$explode =' - ')
    {
        if(!empty($add_time) || strlen($add_time)>0){
            $uniqid=$this->execCount['add_time']?$this->execCount['add_time']:null;
            if($action == PdoAction::INDATE)
            {
                list($start,$end) = explode($explode,$add_time,2);
                $this->sqls['add_time'.$uniqid] = "shakealert.add_time >= :add_time$uniqid";
                $this->binds['add_time'.$uniqid] = $start;
                $this->execCount['add_time']++;

                $uniqid=$this->execCount['add_time']?$this->execCount['add_time']:null;
                $this->sqls['add_time'.$uniqid] = "shakealert.add_time <= :add_time$uniqid";
                $this->binds['add_time'.$uniqid] = $end;
                $this->execCount['add_time']++;
            }elseif($action == PdoAction::NOTLIKE) {
                $this->sqls['add_time'.$uniqid] = "$action(shakealert.add_time,:add_time$uniqid)=0";
                $this->binds['add_time'.$uniqid] = $add_time;
            }elseif($action == PdoAction::LIKE) {
                $this->sqls['add_time'.$uniqid] = "shakealert.add_time$action:add_time$uniqid";
                $this->binds['add_time'.$uniqid] = "%$add_time%";
            }else
            {
                $this->sqls['add_time'.$uniqid] = "shakealert.add_time$action:add_time$uniqid";
                $this->binds['add_time'.$uniqid] = $add_time;
                $this->execCount['add_time']++;
            }
        }
        return $this;
    }

    /**
     * 排序的方向:ASC
     * @return $this
     */
    public function orderAdd_timeAsc()
    {
        $this->sqlsOrder['add_time'] = "shakealert.add_time ASC";
        return $this;
    }

    /**
     * 排序的方向:DESC
     * @return $this
     */
    public function orderAdd_timeDesc()
    {
        $this->sqlsOrder['add_time'] = "shakealert.add_time DESC";
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
     * @return ShakealertModel[]
     */
    final public function __invoke()
    {
        return parent::__invoke();
    }
}

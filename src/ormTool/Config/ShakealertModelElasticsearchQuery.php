<?php

namespace xltxlm\ormTool\Config;

use xltxlm\elasticsearch\ElasticsearchQuery;
use \xltxlm\elasticsearch\Unit\ElasticsearchAction;
use xltxlm\page\PageObject;
use xltxlm\elasticsearch\Unit\ElasticsearchConfig;

final class ShakealertModelElasticsearchQuery
{
    /** @var array 查询的内容  */
    protected $__binds = [];
    /** @var array 区间范围  */
    protected $__ranges = [];
    /** @var array 区间范围  */
    protected $__orderby = [];
    /** @var array 被排除的关键词数组  */
    protected $__notin = [];

    /** @var string 模糊检索的字符串  */
    protected $__string = "";

    /** @var  PageObject */
    protected $pageObject;

    /** @var  ElasticsearchConfig */
    protected $ElasticsearchConfig;

    /**
     * @return ElasticsearchConfig
     */
    public function getElasticsearchConfig(): ElasticsearchConfig
    {
        return $this->ElasticsearchConfig;
    }

    /**
     * @param ElasticsearchConfig $ElasticsearchConfig
     * @return $this
     */
    public function setElasticsearchConfig(ElasticsearchConfig $ElasticsearchConfig)
    {
        $this->ElasticsearchConfig = $ElasticsearchConfig;
        return $this;
    }

    /**
     * @return \xltxlm\ormTool\Config\ShakealertModel[]
     */
    public function __invoke()
    {
        $query = $queryNotIn = [];
        if ($this->__ranges) {
            foreach ($this->__ranges as $field => $bind) {
                $query[] = $bind;
            }
        }
        $sort = '';
        if ($this->__orderby) {
            $sort = ' ,"sort": [ '.join(",", $this->__orderby).' ] ';
        }

        if (!empty($this->__string)) {
            $query[] = sprintf('{"query_string": { "query": "%s"} }', $this->__string);
        }
        foreach ($this->__binds as $field => $bind) {
            $query[] = sprintf('{ "%s":{ "%s":"%s" } }', $bind['action'], $field, addslashes($bind['string']));
        }
        foreach ($this->__notin as $field => $bind) {
            $queryNotIn[] = $bind;
        }

        $bodyString = '{
                "query": {
                    "bool": {
                         "must":
                         [
                            '.implode(",\n", $query).'
                         ],
                        "must_not":
                        [
                            '.implode(",\n", $queryNotIn).'
                        ]
                    }
                }'.$sort.'
            }';


        return (new ElasticsearchQuery())
            ->setElasticsearchConfig($this->getElasticsearchConfig())
            ->setClassName(ShakealertModel::class)
            //由于下面有踢出结果的操作,查询结果放大3倍
            ->setPageObject($this->getPageObject())
            ->setBodyString($bodyString)
            ->__invoke();

    }
    /**
     * @return PageObject
     */
    public function getPageObject(): PageObject
    {
        return $this->pageObject;
    }

    /**
     * @param PageObject $pageObject
     * @return static
     */
    public function setPageObject(PageObject $pageObject)
    {
        $this->pageObject = $pageObject;
        return $this;
    }

    /**
     * 模糊检索,全部字段都查询
     * @return static
     */
    public function where($keyword)
    {
        if($keyword)
        {
                $this->__string = $keyword;
        }
        return $this;
    }


    /**
    * @param string $id
    * @param string $action
    * @return static
    */
    public function whereId($id,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $id=is_string($id)?trim($id):$id;
        if(empty($id))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['id'] =
                [
                    'action' => $action,
                    'string' => $id                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['id'] = sprintf('{ "range":{ "id":{ "%s":"%s" } } }',  $action, $id);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$id);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['id'] = sprintf('{ "range":{ "id":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $id
    * @param string $action
    * @return static
    */
    public function whereIdNotin($id,$action=ElasticsearchAction::EQUAL)
    {
        $id=is_string($id)?trim($id):$id;
        if(empty($id))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $id as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "id": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyIdAsc()
    {
        $this->__orderby['id'] = '{"id" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyIdDesc()
    {
        $this->__orderby['id'] = '{"id" : "desc"}';
        return $this;
    }
    /**
    * @param string $dtvalue
    * @param string $action
    * @return static
    */
    public function whereDtvalue($dtvalue,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $dtvalue=is_string($dtvalue)?trim($dtvalue):$dtvalue;
        if(empty($dtvalue))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['dtvalue'] =
                [
                    'action' => $action,
                    'string' => $dtvalue                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['dtvalue'] = sprintf('{ "range":{ "dtvalue":{ "%s":"%s" } } }',  $action, $dtvalue);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$dtvalue);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['dtvalue'] = sprintf('{ "range":{ "dtvalue":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $dtvalue
    * @param string $action
    * @return static
    */
    public function whereDtvalueNotin($dtvalue,$action=ElasticsearchAction::EQUAL)
    {
        $dtvalue=is_string($dtvalue)?trim($dtvalue):$dtvalue;
        if(empty($dtvalue))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $dtvalue as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "dtvalue": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyDtvalueAsc()
    {
        $this->__orderby['dtvalue'] = '{"dtvalue" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyDtvalueDesc()
    {
        $this->__orderby['dtvalue'] = '{"dtvalue" : "desc"}';
        return $this;
    }
    /**
    * @param string $dtfieldname
    * @param string $action
    * @return static
    */
    public function whereDtfieldname($dtfieldname,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $dtfieldname=is_string($dtfieldname)?trim($dtfieldname):$dtfieldname;
        if(empty($dtfieldname))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['dtfieldname'] =
                [
                    'action' => $action,
                    'string' => $dtfieldname                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['dtfieldname'] = sprintf('{ "range":{ "dtfieldname":{ "%s":"%s" } } }',  $action, $dtfieldname);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$dtfieldname);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['dtfieldname'] = sprintf('{ "range":{ "dtfieldname":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $dtfieldname
    * @param string $action
    * @return static
    */
    public function whereDtfieldnameNotin($dtfieldname,$action=ElasticsearchAction::EQUAL)
    {
        $dtfieldname=is_string($dtfieldname)?trim($dtfieldname):$dtfieldname;
        if(empty($dtfieldname))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $dtfieldname as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "dtfieldname": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyDtfieldnameAsc()
    {
        $this->__orderby['dtfieldname'] = '{"dtfieldname" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyDtfieldnameDesc()
    {
        $this->__orderby['dtfieldname'] = '{"dtfieldname" : "desc"}';
        return $this;
    }
    /**
    * @param string $tablename
    * @param string $action
    * @return static
    */
    public function whereTablename($tablename,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $tablename=is_string($tablename)?trim($tablename):$tablename;
        if(empty($tablename))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['tablename'] =
                [
                    'action' => $action,
                    'string' => $tablename                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['tablename'] = sprintf('{ "range":{ "tablename":{ "%s":"%s" } } }',  $action, $tablename);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$tablename);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['tablename'] = sprintf('{ "range":{ "tablename":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $tablename
    * @param string $action
    * @return static
    */
    public function whereTablenameNotin($tablename,$action=ElasticsearchAction::EQUAL)
    {
        $tablename=is_string($tablename)?trim($tablename):$tablename;
        if(empty($tablename))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $tablename as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "tablename": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyTablenameAsc()
    {
        $this->__orderby['tablename'] = '{"tablename" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyTablenameDesc()
    {
        $this->__orderby['tablename'] = '{"tablename" : "desc"}';
        return $this;
    }
    /**
    * @param string $condition
    * @param string $action
    * @return static
    */
    public function whereCondition($condition,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $condition=is_string($condition)?trim($condition):$condition;
        if(empty($condition))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['condition'] =
                [
                    'action' => $action,
                    'string' => $condition                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['condition'] = sprintf('{ "range":{ "condition":{ "%s":"%s" } } }',  $action, $condition);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$condition);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['condition'] = sprintf('{ "range":{ "condition":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $condition
    * @param string $action
    * @return static
    */
    public function whereConditionNotin($condition,$action=ElasticsearchAction::EQUAL)
    {
        $condition=is_string($condition)?trim($condition):$condition;
        if(empty($condition))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $condition as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "condition": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyConditionAsc()
    {
        $this->__orderby['condition'] = '{"condition" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyConditionDesc()
    {
        $this->__orderby['condition'] = '{"condition" : "desc"}';
        return $this;
    }
    /**
    * @param string $fieldname
    * @param string $action
    * @return static
    */
    public function whereFieldname($fieldname,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $fieldname=is_string($fieldname)?trim($fieldname):$fieldname;
        if(empty($fieldname))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['fieldname'] =
                [
                    'action' => $action,
                    'string' => $fieldname                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['fieldname'] = sprintf('{ "range":{ "fieldname":{ "%s":"%s" } } }',  $action, $fieldname);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$fieldname);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['fieldname'] = sprintf('{ "range":{ "fieldname":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $fieldname
    * @param string $action
    * @return static
    */
    public function whereFieldnameNotin($fieldname,$action=ElasticsearchAction::EQUAL)
    {
        $fieldname=is_string($fieldname)?trim($fieldname):$fieldname;
        if(empty($fieldname))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $fieldname as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "fieldname": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyFieldnameAsc()
    {
        $this->__orderby['fieldname'] = '{"fieldname" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyFieldnameDesc()
    {
        $this->__orderby['fieldname'] = '{"fieldname" : "desc"}';
        return $this;
    }
    /**
    * @param string $fieldname1day
    * @param string $action
    * @return static
    */
    public function whereFieldname1day($fieldname1day,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $fieldname1day=is_string($fieldname1day)?trim($fieldname1day):$fieldname1day;
        if(empty($fieldname1day))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['fieldname1day'] =
                [
                    'action' => $action,
                    'string' => $fieldname1day                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['fieldname1day'] = sprintf('{ "range":{ "fieldname1day":{ "%s":"%s" } } }',  $action, $fieldname1day);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$fieldname1day);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['fieldname1day'] = sprintf('{ "range":{ "fieldname1day":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $fieldname1day
    * @param string $action
    * @return static
    */
    public function whereFieldname1dayNotin($fieldname1day,$action=ElasticsearchAction::EQUAL)
    {
        $fieldname1day=is_string($fieldname1day)?trim($fieldname1day):$fieldname1day;
        if(empty($fieldname1day))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $fieldname1day as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "fieldname1day": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyFieldname1dayAsc()
    {
        $this->__orderby['fieldname1day'] = '{"fieldname1day" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyFieldname1dayDesc()
    {
        $this->__orderby['fieldname1day'] = '{"fieldname1day" : "desc"}';
        return $this;
    }
    /**
    * @param string $fieldname1dayratio
    * @param string $action
    * @return static
    */
    public function whereFieldname1dayratio($fieldname1dayratio,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $fieldname1dayratio=is_string($fieldname1dayratio)?trim($fieldname1dayratio):$fieldname1dayratio;
        if(empty($fieldname1dayratio))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['fieldname1dayratio'] =
                [
                    'action' => $action,
                    'string' => $fieldname1dayratio                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['fieldname1dayratio'] = sprintf('{ "range":{ "fieldname1dayratio":{ "%s":"%s" } } }',  $action, $fieldname1dayratio);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$fieldname1dayratio);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['fieldname1dayratio'] = sprintf('{ "range":{ "fieldname1dayratio":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $fieldname1dayratio
    * @param string $action
    * @return static
    */
    public function whereFieldname1dayratioNotin($fieldname1dayratio,$action=ElasticsearchAction::EQUAL)
    {
        $fieldname1dayratio=is_string($fieldname1dayratio)?trim($fieldname1dayratio):$fieldname1dayratio;
        if(empty($fieldname1dayratio))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $fieldname1dayratio as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "fieldname1dayratio": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyFieldname1dayratioAsc()
    {
        $this->__orderby['fieldname1dayratio'] = '{"fieldname1dayratio" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyFieldname1dayratioDesc()
    {
        $this->__orderby['fieldname1dayratio'] = '{"fieldname1dayratio" : "desc"}';
        return $this;
    }
    /**
    * @param string $fieldname1week
    * @param string $action
    * @return static
    */
    public function whereFieldname1week($fieldname1week,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $fieldname1week=is_string($fieldname1week)?trim($fieldname1week):$fieldname1week;
        if(empty($fieldname1week))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['fieldname1week'] =
                [
                    'action' => $action,
                    'string' => $fieldname1week                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['fieldname1week'] = sprintf('{ "range":{ "fieldname1week":{ "%s":"%s" } } }',  $action, $fieldname1week);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$fieldname1week);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['fieldname1week'] = sprintf('{ "range":{ "fieldname1week":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $fieldname1week
    * @param string $action
    * @return static
    */
    public function whereFieldname1weekNotin($fieldname1week,$action=ElasticsearchAction::EQUAL)
    {
        $fieldname1week=is_string($fieldname1week)?trim($fieldname1week):$fieldname1week;
        if(empty($fieldname1week))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $fieldname1week as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "fieldname1week": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyFieldname1weekAsc()
    {
        $this->__orderby['fieldname1week'] = '{"fieldname1week" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyFieldname1weekDesc()
    {
        $this->__orderby['fieldname1week'] = '{"fieldname1week" : "desc"}';
        return $this;
    }
    /**
    * @param string $fieldname1weekratio
    * @param string $action
    * @return static
    */
    public function whereFieldname1weekratio($fieldname1weekratio,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $fieldname1weekratio=is_string($fieldname1weekratio)?trim($fieldname1weekratio):$fieldname1weekratio;
        if(empty($fieldname1weekratio))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['fieldname1weekratio'] =
                [
                    'action' => $action,
                    'string' => $fieldname1weekratio                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['fieldname1weekratio'] = sprintf('{ "range":{ "fieldname1weekratio":{ "%s":"%s" } } }',  $action, $fieldname1weekratio);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$fieldname1weekratio);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['fieldname1weekratio'] = sprintf('{ "range":{ "fieldname1weekratio":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $fieldname1weekratio
    * @param string $action
    * @return static
    */
    public function whereFieldname1weekratioNotin($fieldname1weekratio,$action=ElasticsearchAction::EQUAL)
    {
        $fieldname1weekratio=is_string($fieldname1weekratio)?trim($fieldname1weekratio):$fieldname1weekratio;
        if(empty($fieldname1weekratio))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $fieldname1weekratio as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "fieldname1weekratio": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyFieldname1weekratioAsc()
    {
        $this->__orderby['fieldname1weekratio'] = '{"fieldname1weekratio" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyFieldname1weekratioDesc()
    {
        $this->__orderby['fieldname1weekratio'] = '{"fieldname1weekratio" : "desc"}';
        return $this;
    }
    /**
    * @param string $fieldnamenew
    * @param string $action
    * @return static
    */
    public function whereFieldnamenew($fieldnamenew,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $fieldnamenew=is_string($fieldnamenew)?trim($fieldnamenew):$fieldnamenew;
        if(empty($fieldnamenew))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['fieldnamenew'] =
                [
                    'action' => $action,
                    'string' => $fieldnamenew                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['fieldnamenew'] = sprintf('{ "range":{ "fieldnamenew":{ "%s":"%s" } } }',  $action, $fieldnamenew);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$fieldnamenew);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['fieldnamenew'] = sprintf('{ "range":{ "fieldnamenew":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $fieldnamenew
    * @param string $action
    * @return static
    */
    public function whereFieldnamenewNotin($fieldnamenew,$action=ElasticsearchAction::EQUAL)
    {
        $fieldnamenew=is_string($fieldnamenew)?trim($fieldnamenew):$fieldnamenew;
        if(empty($fieldnamenew))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $fieldnamenew as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "fieldnamenew": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyFieldnamenewAsc()
    {
        $this->__orderby['fieldnamenew'] = '{"fieldnamenew" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyFieldnamenewDesc()
    {
        $this->__orderby['fieldnamenew'] = '{"fieldnamenew" : "desc"}';
        return $this;
    }
    /**
    * @param string $add_time
    * @param string $action
    * @return static
    */
    public function whereAdd_time($add_time,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $add_time=is_string($add_time)?trim($add_time):$add_time;
        if(empty($add_time))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['add_time'] =
                [
                    'action' => $action,
                    'string' => $add_time                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['add_time'] = sprintf('{ "range":{ "add_time":{ "%s":"%s" } } }',  $action, $add_time);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$add_time);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['add_time'] = sprintf('{ "range":{ "add_time":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $add_time
    * @param string $action
    * @return static
    */
    public function whereAdd_timeNotin($add_time,$action=ElasticsearchAction::EQUAL)
    {
        $add_time=is_string($add_time)?trim($add_time):$add_time;
        if(empty($add_time))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $add_time as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "add_time": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyAdd_timeAsc()
    {
        $this->__orderby['add_time'] = '{"add_time" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyAdd_timeDesc()
    {
        $this->__orderby['add_time'] = '{"add_time" : "desc"}';
        return $this;
    }
}
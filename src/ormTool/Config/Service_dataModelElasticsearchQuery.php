<?php

namespace xltxlm\ormTool\Config;

use xltxlm\elasticsearch\ElasticsearchQuery;
use \xltxlm\elasticsearch\Unit\ElasticsearchAction;
use xltxlm\ormTool\Config\Service_dataModel;
use xltxlm\page\PageObject;
use xltxlm\elasticsearch\Unit\ElasticsearchConfig;

final class Service_dataModelElasticsearchQuery
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
     * @return \xltxlm\ormTool\Config\Service_dataModel[]
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
            ->setClassName(Service_dataModel::class)
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
    * @param string $dt
    * @param string $action
    * @return static
    */
    public function whereDt($dt,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $dt=is_string($dt)?trim($dt):$dt;
        if(empty($dt))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['dt'] =
                [
                    'action' => $action,
                    'string' => $dt                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['dt'] = sprintf('{ "range":{ "dt":{ "%s":"%s" } } }',  $action, $dt);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$dt);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['dt'] = sprintf('{ "range":{ "dt":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $dt
    * @param string $action
    * @return static
    */
    public function whereDtNotin($dt,$action=ElasticsearchAction::EQUAL)
    {
        $dt=is_string($dt)?trim($dt):$dt;
        if(empty($dt))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $dt as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "dt": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyDtAsc()
    {
        $this->__orderby['dt'] = '{"dt" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyDtDesc()
    {
        $this->__orderby['dt'] = '{"dt" : "desc"}';
        return $this;
    }
    /**
    * @param string $servicename
    * @param string $action
    * @return static
    */
    public function whereServicename($servicename,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $servicename=is_string($servicename)?trim($servicename):$servicename;
        if(empty($servicename))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['servicename'] =
                [
                    'action' => $action,
                    'string' => $servicename                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['servicename'] = sprintf('{ "range":{ "servicename":{ "%s":"%s" } } }',  $action, $servicename);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$servicename);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['servicename'] = sprintf('{ "range":{ "servicename":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $servicename
    * @param string $action
    * @return static
    */
    public function whereServicenameNotin($servicename,$action=ElasticsearchAction::EQUAL)
    {
        $servicename=is_string($servicename)?trim($servicename):$servicename;
        if(empty($servicename))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $servicename as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "servicename": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyServicenameAsc()
    {
        $this->__orderby['servicename'] = '{"servicename" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyServicenameDesc()
    {
        $this->__orderby['servicename'] = '{"servicename" : "desc"}';
        return $this;
    }
    /**
    * @param string $process
    * @param string $action
    * @return static
    */
    public function whereProcess($process,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $process=is_string($process)?trim($process):$process;
        if(empty($process))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['process'] =
                [
                    'action' => $action,
                    'string' => $process                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['process'] = sprintf('{ "range":{ "process":{ "%s":"%s" } } }',  $action, $process);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$process);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['process'] = sprintf('{ "range":{ "process":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $process
    * @param string $action
    * @return static
    */
    public function whereProcessNotin($process,$action=ElasticsearchAction::EQUAL)
    {
        $process=is_string($process)?trim($process):$process;
        if(empty($process))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $process as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "process": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyProcessAsc()
    {
        $this->__orderby['process'] = '{"process" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyProcessDesc()
    {
        $this->__orderby['process'] = '{"process" : "desc"}';
        return $this;
    }
    /**
    * @param string $num
    * @param string $action
    * @return static
    */
    public function whereNum($num,$action=ElasticsearchAction::EQUAL, $explode=" - ")
    {
        $num=is_string($num)?trim($num):$num;
        if(empty($num))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ,ElasticsearchAction::LIKE ]) )
        {
            $this->__binds['num'] =
                [
                    'action' => $action,
                    'string' => $num                ];
        }

        if( in_array( $action , [ ElasticsearchAction::MORE ,ElasticsearchAction::LESS, ElasticsearchAction::MOREANDEQUAL, ElasticsearchAction::LESSANDEQUAL ]) )
        {
            $this->__ranges['num'] = sprintf('{ "range":{ "num":{ "%s":"%s" } } }',  $action, $num);
        }
        if( in_array( $action , [ ElasticsearchAction::IN_EQUAL ,ElasticsearchAction::IN_EQUAL ]) )
        {
            list($ltval,$gtval)=explode($explode,$num);
            list($lt,$gt)=explode("|",$action);
            $this->__ranges['num'] = sprintf('{ "range":{ "num":{ "%s":"%s","%s":"%s" } } }',  $lt,$ltval,$gt,$gtval);
        }
        return $this;
    }
    /**
    * @param string $num
    * @param string $action
    * @return static
    */
    public function whereNumNotin($num,$action=ElasticsearchAction::EQUAL)
    {
        $num=is_string($num)?trim($num):$num;
        if(empty($num))
        {
            return $this;
        }
        if( in_array( $action , [ ElasticsearchAction::EQUAL ]) )
        {
            foreach( $num as $item)
            {
                $this->__notin[] = sprintf('{ "%s":{ "num": "%s" } }',  ElasticsearchAction::EQUAL,$item);
            }
        }
        return $this;
    }

    /**
     * 排序:正序
     * @return static
    */
    public function orderbyNumAsc()
    {
        $this->__orderby['num'] = '{"num" : "asc"}';
        return $this;
    }


    /**
     * 排序:倒序
     * @return static
    */
    public function orderbyNumDesc()
    {
        $this->__orderby['num'] = '{"num" : "desc"}';
        return $this;
    }
}
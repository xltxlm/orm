<?php

namespace xltxlm\ormTool\Config;

use xltxlm\helper\Hclass\ObjectToArray;
use xltxlm\helper\Hclass\ObjectToJson;
use xltxlm\helper\Hclass\ObjectIteratorAggregate;
use xltxlm\ormTool\Config\Service_dataBase;
use xltxlm\ormTool\Config\Service_dataGetset;

/**
* Class select
*/
class Service_dataModel extends ObjectIteratorAggregate
{
    use ObjectToArray;
    use ObjectToJson;
    use Service_dataBase;
    use Service_dataGetset;

    /**
    * @return array
    */
    final public function __invoke()
    {
        $fieldSchema=[];
        $fieldSchema['id']='自增id';
        $fieldSchema['dt']='日期';
        $fieldSchema['servicename']='服务名称';
        $fieldSchema['process']='进程名字';
        $fieldSchema['num']='数值';
        return $fieldSchema;
    }
}

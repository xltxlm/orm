<?php

namespace xltxlm\ormTool\Config;

use xltxlm\helper\Hclass\ObjectToArray;
use xltxlm\helper\Hclass\ObjectToJson;
use xltxlm\helper\Hclass\ObjectIteratorAggregate;

/**
* Class select
*/
class ShakealertModel extends ObjectIteratorAggregate
{
    use ObjectToArray;
    use ObjectToJson;
    use ShakealertBase;
    use ShakealertGetset;

    /**
    * @return array
    */
    final public function __invoke()
    {
        $fieldSchema=[];
        $fieldSchema['id']='自增id';
        $fieldSchema['dtvalue']='日期';
        $fieldSchema['dtfieldname']='日期字段';
        $fieldSchema['tablename']='表格名称';
        $fieldSchema['condition']='附加条件';
        $fieldSchema['fieldname']='字段名称';
        $fieldSchema['fieldname1day']='1天前数据';
        $fieldSchema['fieldname1dayratio']='1天前百分比';
        $fieldSchema['fieldname1week']='1周前数据';
        $fieldSchema['fieldname1weekratio']='1周前百分比';
        $fieldSchema['fieldnamenew']='新数据';
        $fieldSchema['add_time']='创建时间';
        return $fieldSchema;
    }
}

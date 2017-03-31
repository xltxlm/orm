<?php

namespace xltxlm\ormTool\Config;

use xltxlm\orm\Config\PdoConfig;
use xltxlm\ormTool\Unit\Table;

final class Shakealert extends Table
{

    /** @var string 表格的名称 */
    protected $name = "shakealert";

    /** @var string 表格的描述 */
    protected $comment = "数据抖动统计";

    /**
     * @return PdoConfig|string
     */
    public function getDbConfig()
    {
        return $this->DbConfig;
    }

    /**
     * 获取自增 id
     */
    public function getAutoIncrement(): string
    {
        return "id";
    }

    /**
     *
     * 主键id
     */
    public function getPrimaryKey(): array
    {
        return json_decode('["id"]', true);
    }

    /**
     * 优先返回唯一键,如果没有唯一键,返回主键,
     */
    public function getUniqueKey(): array
    {
        return json_decode('["dtvalue","tablename","fieldname","condition"]', true);
    }

    /**
     * 所有的特别字段
     */
    public function getSpecial(): array
    {
        return array_unique(array_merge([$this->getAutoIncrement()], $this->getUniqueKey(), $this->getPrimaryKey()));
    }
}

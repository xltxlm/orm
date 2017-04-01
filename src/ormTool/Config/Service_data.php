<?php

    namespace xltxlm\ormTool\Config;

    use xltxlm\orm\Config\PdoConfig;
    use xltxlm\ormTool\Unit\Table;

    final class Service_data extends Table
    {

    /** @var string 表格的名称 */
    protected $name = "service_data";

    /** @var string 表格的描述 */
    protected $comment = "业务每日数据";

    /**
    * @return PdoConfig
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
        return json_decode('["id"]',true);
    }

    /**
     * 优先返回唯一键,如果没有唯一键,返回主键,
     */
    public function getUniqueKey():array
    {
        return json_decode('["dt","servicename","process"]',true);
    }

    /**
     * 所有的特别字段
     */
    public function getSpecial():array
    {
        return array_unique(array_merge([$this->getAutoIncrement()],$this->getUniqueKey(),$this->getPrimaryKey()));
    }

    /**
     * 所有的特别字段
     */
    public function getComment():string
    {
        return "业务每日数据";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-27
 * Time: 下午 7:48.
 */

namespace xltxlm\ormTool\Template;

use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;

/**
 * 支持分组查询，只能执行一种算值的方法，返回二维数组
 * Class Group.
 */
class Group extends PdoAction
{
    const COUNT = 'count';
    const MAX = 'max';
    const MIN = 'min';

    protected $groupbysql = [];
    protected $groupbyfield = [];

    //主检索字段的计算方式
    protected $groupMethod = self::COUNT;
    //
    protected $mainField = '*';

    /**
     * @return string
     */
    public function getMainField(): string
    {
        return $this->mainField;
    }

    /**
     * @param string $mainField
     * @return Group
     */
    public function setMainField(string $mainField): Group
    {
        $this->mainField = $mainField;
        return $this;
    }


    /**
     * @return string
     */
    public function getGroupMethod(): string
    {
        return $this->groupMethod;
    }

    /**
     * @param string $groupMethod
     * @return Group
     */
    public function setGroupMethod(string $groupMethod): Group
    {
        $this->groupMethod = $groupMethod;
        return $this;
    }


    /**
     * @return array
     */
    public function getGroupbyfield(): array
    {
        return $this->groupbyfield;
    }

    /**
     * @param array $groupbyfield
     * @return Group
     */
    public function setGroupbyfield(array $groupbyfield): Group
    {
        $this->groupbyfield = $groupbyfield;
        return $this;
    }


    /**
     * @return array
     */
    public function getGroupbysql(): array
    {
        return $this->groupbysql;
    }

    /**
     * @param array $groupbysql
     * @return Group
     */
    public function setGroupbysql(array $groupbysql): Group
    {
        $this->groupbysql = $groupbysql;
        return $this;
    }


    public function __invoke()
    {
        if ($this->getGroupbyfield()) {
            $sql = "SELECT {$this->getGroupMethod()}({$this->getMainField()}) as _num," . join(',', $this->getGroupbyfield()) . " FROM " . $this->tableObject->getName() .
                join(" ", $this->joinSql) .
                ($this->getSqls() ? ' WHERE ' . implode(' AND ', $this->getSqls()) : '') .
                " Group by " . join(',', $this->getGroupbysql()).
                " Order by " . join(',', $this->getGroupbysql());
        } else {
            $sql = "SELECT {$this->getGroupMethod()}({$this->getMainField()}) as _num   FROM " . $this->tableObject->getName() .
                join(" ", $this->joinSql) .
                ($this->getSqls() ? ' WHERE ' . implode(' AND ', $this->getSqls()) : '');
        }

        $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->setBind($this->getBinds())
            ->__invoke();
        //执行sql
        $this->pdoInterface = (new PdoInterface())
            ->setPdoConfig($this->tableObject->getDbConfig())
            ->setSqlParserd($SqlParserd)
            ->setDebug($this->debug)
            ->setConvertToArray(true);
        return $this->pdoInterface
            ->selectAll();
    }
}

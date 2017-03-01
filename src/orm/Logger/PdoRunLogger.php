<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-11
 * Time: 下午 6:42.
 */

namespace xltxlm\orm\Logger;

use xltxlm\orm\Sql\SqlParserd;

class PdoRunLogger extends PdoConnectLogger
{
    /** @var  sqlParserd */
    protected $pdoSql;

    /**
     * @return SqlParserd
     */
    public function getPdoSql(): SqlParserd
    {
        return $this->pdoSql;
    }

    /**
     * @param SqlParserd $pdoSql
     * @return PdoRunLogger
     */
    public function setPdoSql(SqlParserd $pdoSql): PdoRunLogger
    {
        $this->pdoSql = $pdoSql;
        return $this;
    }
}

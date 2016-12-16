<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:40.
 */

namespace xltxlm\orm;

use Psr\Log\LogLevel;
use xltxlm\logger\Logger;
use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\Log\DefineLog;
use xltxlm\orm\Sql\SqlParserd;

/**
 *  out:最基础的数据库执行方式.
 * Interface sqlInterface.
 */
final class PdoInterface
{
    /** @var PdoConfig 数据库配置 */
    protected $pdoConfig;

    /** @var SqlParserd */
    protected $sqlParserd;

    /** @var string 数据对象 */
    protected $className;

    /** @var bool 是否开启调试 */
    protected $debug = false;

    /**
     * @return PdoConfig
     */
    public function getPdoConfig(): PdoConfig
    {
        return $this->pdoConfig;
    }

    /**
     * @param PdoConfig $pdoConfig
     *
     * @return PdoInterface
     */
    public function setPdoConfig(PdoConfig $pdoConfig): PdoInterface
    {
        $this->pdoConfig = $pdoConfig;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     *
     * @return PdoInterface
     */
    public function setDebug(bool $debug): PdoInterface
    {
        $this->debug = $debug;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     *
     * @return PdoInterface
     */
    public function setClassName($className): PdoInterface
    {
        $this->className = $className;

        return $this;
    }

    /**
     * @return SqlParserd
     */
    public function getSqlParserd(): SqlParserd
    {
        return $this->sqlParserd;
    }

    /**
     * @param SqlParserd $sqlParserd
     *
     * @return PdoInterface
     */
    public function setSqlParserd(SqlParserd $sqlParserd): PdoInterface
    {
        $this->sqlParserd = $sqlParserd;

        return $this;
    }

    /**
     * @return int|string
     */
    public function selectVar()
    {
        return current(get_object_vars($this->selectOne()));
    }

    /**
     * @throws Exception\PdoInterfaceException
     *
     * @return object
     */
    public function selectOne()
    {
        $stmt = $this->pdoexecute();
        $this->checkClassName();

        $return = $stmt->fetchObject($this->className);
        if (empty($return)) {
            $return = new $this->className();
        }

        return $return;
    }

    public function selectAll()
    {
        $stmt = $this->pdoexecute();
        $this->checkClassName();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }

    public function insert()
    {
        $this->pdoexecute();

        return $this->pdoConfig->instanceSelf()->lastInsertId();
    }

    /**
     * 纯粹执行sql.
     *
     * @return \PDOStatement
     */
    public function execute()
    {
        return $this->pdoexecute();
    }

    /**
     * @throws Exception\PdoInterfaceException
     *
     * @return int
     */
    public function update()
    {
        if (stripos($this->getSqlParserd()->getSql(), 'where') === false) {
            throw new \xltxlm\orm\Exception\PdoInterfaceException(
                (new \xltxlm\orm\Exception\I18N\PdoInterfaceI18N())
                    ->getUpdateNoWhere()
            );
        }
        $stmt = $this->pdoexecute();

        return $stmt->rowCount();
    }

    /**
     * @param PageObject $pageObject
     *
     * @return array
     */
    public function page(\xltxlm\orm\PageObject &$pageObject)
    {
        //查询当前条件下可以命中多少数据量
        $str = ' FROM ';
        $pos = stripos($this->sqlParserd->getSql(), $str);
        $whereSql = substr($this->sqlParserd->getSql(), $pos + strlen($str));
        $SqlParserd = (new SqlParserd())
            ->setSql('SELECT count(*) FROM '.$whereSql);
        foreach ($this->getSqlParserd()->getBind() as $value) {
            $SqlParserd->setBind($value);
        }

        $num = (new self())
            ->setPdoConfig($this->getPdoConfig())
            ->setSqlParserd($SqlParserd)
            ->setClassName(\stdClass::class)
            ->selectVar();

        $pageObject
            ->setTotal($num)
            ->__invoke();

        $this->getSqlParserd()
            ->setSql($this->getSqlParserd()->getSql().$pageObject->getLimitSql());

        return $this->selectAll();
    }

    /**
     * @throws \Exception
     *
     * @return \PDOStatement
     */
    private function pdoexecute(): \PDOStatement
    {
        //记录日志
        $start = $DefineLog = null;
        if ($this->getPdoConfig()->isLog()) {
            $DefineLog = (new DefineLog())
                ->setSql($this->sqlParserd->getSql())
                ->setBinds($this->sqlParserd->getBindArray())
                ->setTns($this->getPdoConfig()->getPdoString());
            $start = microtime(true);
        }
        //执行sql
        $stmt = $this->pdoConfig->instanceSelf()->prepare($this->sqlParserd->getSql());
        foreach ($this->sqlParserd->getBind() as $bind) {
            $stmt->bindValue($bind->getKey(), $bind->getValue());
        }
        $stmt->execute();
        if ($DefineLog) {
            $end = microtime(true);
            $DefineLog->setTime(sprintf('%.4f', $end - $start));
        }
        $error = $stmt->errorInfo();
        $error[0] = (int)filter_var($error[0], FILTER_SANITIZE_NUMBER_INT);

        if ($error[0] || $error[2]) {
            if ($DefineLog) {
                ob_start();
                debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
                $trace = ob_get_clean();
                $DefineLog
                    ->setErrorInfo(json_encode($error, JSON_UNESCAPED_UNICODE))
                    ->setTrace($trace)
                    ->setType(LogLevel::ERROR);
                (new Logger())
                    ->setDefine($DefineLog)
                    ->__invoke();
            }
            throw (new \xltxlm\orm\Exception\PdoSqlError(
                json_encode(
                    [
                        $this->sqlParserd->getSql(),
                        $this->sqlParserd->getBindArray(),
                        $error,
                    ]
                )
            )
            )
                ->setSql($this->sqlParserd->getSql())
                ->setBinds($this->sqlParserd->getBind())
                ->setErrorinfo(json_encode($error));
        }
        if ($DefineLog) {
            (new Logger())
                ->setDefine($DefineLog)
                ->__invoke();
        }
        if ($this->debug) {
            echo "\n=========================\n";
            echo "SQL:\n";
            print_r($this->sqlParserd);
            echo "\nTNS:\n";
            print_r($this->getPdoConfig()->getPdoString());
            echo "\nDEBUG:\n";
            debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            echo "\n=========================@in ".__FILE__.' on line '.__LINE__."\n";
        }

        return $stmt;
    }

    /**
     * ORM返回的数据结构必须是类,检测类是不是有设置.
     *
     * @throws Exception\PdoInterfaceException
     */
    private function checkClassName()
    {
        if (!$this->className) {
            throw new \xltxlm\orm\Exception\PdoInterfaceException(
                (new \xltxlm\orm\Exception\I18N\PdoInterfaceI18N())
                    ->getMissModel()
            );
        }
    }
}
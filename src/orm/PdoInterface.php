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
use xltxlm\orm\Exception\I18N\PdoInterfaceI18N;
use xltxlm\orm\Exception\PdoInterfaceException;
use xltxlm\orm\Exception\PdoSqlError;
use xltxlm\orm\Logger\PdoRunLog;
use xltxlm\orm\Sql\SqlParserd;
use xltxlm\page\PageObject;

/**
 *  out:最基础的数据库执行方式.
 * Interface sqlInterface.
 */
class PdoInterface
{
    /** @var PdoConfig 数据库配置 */
    protected $pdoConfig;

    /** @var SqlParserd */
    protected $sqlParserd;
    /** @var bool 是否再转换成数组,如果是的话, $className= \stdClass:class */
    protected $convertToArray = false;
    /** @var string 数据对象 */
    protected $className = \stdClass::class;
    /** @var bool 是否开启调试 */
    protected $debug = false;

    /** @var int 执行sql的条数 */
    private static $sqlCount = 0;

    /**
     * @return int
     */
    public static function getSqlCount(): int
    {
        return self::$sqlCount;
    }

    /**
     * @param int $sqlCount
     */
    public static function setSqlCount(int $sqlCount = 1)
    {
        self::$sqlCount += $sqlCount;
    }

    /**
     * @return PdoConfig
     */
    public function getPdoConfig(): PdoConfig
    {
        return $this->pdoConfig;
    }

    /**
     * @return bool
     */
    public function isConvertToArray(): bool
    {
        return $this->convertToArray;
    }

    /**
     * @param bool $convertToArray
     *
     * @return PdoInterface
     */
    public function setConvertToArray(bool $convertToArray): PdoInterface
    {
        $this->convertToArray = $convertToArray;
        if ($convertToArray) {
            $this->className = \stdClass::class;
        }

        return $this;
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
     * @return mixed
     */
    public function selectOne()
    {
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();

        $return = $stmt->fetchObject($this->className);
        if (empty($return)) {
            $return = new $this->className();
        }
        if ($this->isConvertToArray()) {
            $return = get_object_vars($return);
        }

        return $return;
    }

    public function selectAll()
    {
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();

        $return = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
        if ($this->isConvertToArray()) {
            foreach ($return as &$v) {
                $return = get_object_vars($v);
            }
        }

        return $return;
    }

    public function insert()
    {
        $this->pdoexecute(__FUNCTION__);

        return $this->pdoConfig->instanceSelf()->lastInsertId();
    }

    /**
     * 纯粹执行sql.
     *
     * @return \PDOStatement
     */
    public function execute()
    {
        return $this->pdoexecute(__FUNCTION__);
    }

    /**
     * @throws Exception\PdoInterfaceException
     *
     * @return int
     */
    public function update()
    {
        if (stripos($this->getSqlParserd()->getSql(), 'where') === false) {
            throw new PdoInterfaceException(
                (new PdoInterfaceI18N())
                    ->getUpdateNoWhere()
            );
        }
        $stmt = $this->pdoexecute(__FUNCTION__);

        return $stmt->rowCount();
    }

    /**
     * @param PageObject $pageObject
     *
     * @return array
     */
    public function page(PageObject &$pageObject)
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
            ->setDebug($this->getDebug())
            ->setClassName(\stdClass::class)
            ->selectVar();

        $pageObject
            ->setTotal($num)
            ->__invoke();

        $this->getSqlParserd()
            ->setSql($this->getSqlParserd()->getSql().' limit '.$pageObject->getFrom().','.$pageObject->getPrepage());

        return $this->selectAll();
    }

    /**
     * @param string $function
     * @return \PDOStatement
     * @throws PdoSqlError
     * @throws \Exception
     */
    private function pdoexecute(string $function): \PDOStatement
    {
        //记录日志
        $DefineLog = (new PdoRunLog())
            ->setSql($this->sqlParserd->getSql())
            ->setBinds($this->sqlParserd->getBindArray())
            ->setFunction($function)
            ->setTns($this->getPdoConfig()->getPdoString());
        $start = microtime(true);
        //执行sql
        try {
            $stmt = $this->pdoConfig->instanceSelf()->prepare($this->sqlParserd->getSql());
        } catch (\Exception $e) {
            $DefineLog
                ->setErrorInfo(mb_convert_encoding($e->getMessage(), 'UTF-8'))
                ->setType(LogLevel::ERROR);
            (new Logger())
                ->setDefine($DefineLog)
                ->__invoke();
            throw $e;
        }
        foreach ($this->sqlParserd->getBind() as $bind) {
            $stmt->bindValue($bind->getKey(), $bind->getValue());
        }
        $stmt->execute();
        if ($DefineLog) {
            $time = sprintf('%.4f', microtime(true) - $start);
            $DefineLog->setRunTime($time);
        }
        $error = $stmt->errorInfo();
        $error[0] = (int)filter_var($error[0], FILTER_SANITIZE_NUMBER_INT);

        if ($error[0] || $error[2]) {
            if ($DefineLog) {
                $DefineLog
                    ->setErrorInfo(json_encode($error, JSON_UNESCAPED_UNICODE))
                    ->setType(LogLevel::ERROR);
                (new Logger())
                    ->setDefine($DefineLog)
                    ->__invoke();
            }
            throw (new PdoSqlError(
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
        $this->debug();
        //sql计数
        self::setSqlCount(1);

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
            throw new PdoInterfaceException(
                (new PdoInterfaceI18N())
                    ->getMissModel()
            );
        }
    }

    /**
     * 输出调试信息.
     */
    private function debug()
    {
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
    }
}

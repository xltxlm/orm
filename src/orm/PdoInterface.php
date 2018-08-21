<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:40.
 */

namespace xltxlm\orm;

use Psr\Log\LogLevel;
use xltxlm\crontab\Config\RedisCacheConfig;
use xltxlm\helper\Hclass\ConvertObject;
use xltxlm\helper\Util;
use xltxlm\logger\Log\DefineLog;
use xltxlm\logger\Operation\Action\PdoRead;
use xltxlm\logger\Operation\Action\PdoRunLog;
use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\Exception\I18N\PdoInterfaceI18N;
use xltxlm\orm\Exception\PdoInterfaceException;
use xltxlm\orm\Exception\PdoSqlError;
use xltxlm\orm\Sql\SqlParserd;
use xltxlm\page\PageObject;
use xltxlm\redis\Config\RedisConfig;
use xltxlm\redis\LockKey;

/**
 *  out:最基础的数据库执行方式.
 * Interface sqlInterface.
 */
class PdoInterface
{
    /** @var string 当前所处理的表格名称，由外部告诉，不去分析sql */
    protected $table_name = "";
    /** @var PdoConfig 数据库配置 */
    protected $pdoConfig;

    /** @var SqlParserd */
    protected $sqlParserd;
    /** @var bool 是否再转换成数组,如果是的话, $className= \stdClass:class */
    protected $convertToArray = false;
    /** @var string 查询是，默认数据对象结构 */
    protected $className = \stdClass::class;
    /** @var bool 是否开启调试 */
    protected $debug = false;

    /** @var int 整个会话里面执行sql的数量 */
    private static $sqlCount = 0;

    /** @var bool 是否正常数据量查询. false:准备查询超级大数据，并且不开启事务 */
    protected $buff = true;

    /** @var RedisConfig  在是新更新,写入的时候,进行并发锁 */
    protected $RedisCacheConfig;

    /** @var LockKey */
    private $lockKeyObject;

    /**
     * @return RedisConfig
     */

    public function getRedisCacheConfig()
    {
        return $this->RedisCacheConfig;
    }

    /**
     * @param RedisConfig $RedisCacheConfig
     * @return PdoInterface
     */
    public function setRedisCacheConfig($RedisCacheConfig): PdoInterface
    {
        $this->RedisCacheConfig = $RedisCacheConfig;
        return $this;
    }


    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * @param string $table_name
     * @return PdoInterface
     */
    public function setTableName(string $table_name): PdoInterface
    {
        $this->table_name = $table_name;
        return $this;
    }


    /**
     * @return bool
     */
    public function isBuff(): bool
    {
        return $this->buff;
    }

    /**
     * @param bool $buff
     *
     * @return PdoInterface
     */
    public function setBuff(bool $buff): PdoInterface
    {
        $this->buff = $buff;

        return $this;
    }

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
    public function getSqlParserd()
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

        $pdoRead = new PdoRead($this);
        $return = $stmt->fetchObject($this->className);
        if (empty($return)) {
            $return = new $this->className();
        }
        if ($this->isConvertToArray()) {
            $return = get_object_vars($return);
        }
        $pdoRead
            ->setTableName($this->getTableName())
            ->setSqlaction(__FUNCTION__)
            ->setFetchnum($return ? 1 : 0)
            ->__invoke();

        return $return;
    }

    /**
     * 查询一列数据.
     *
     * @return array
     */
    public function selectColumn($ColumnName = 0): array
    {
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();

        $pdoRead = new PdoRead($this);
        $return = $stmt->fetchAll(\PDO::FETCH_COLUMN, $ColumnName);

        $pdoRead
            ->setTableName($this->getTableName())
            ->setSqlaction(__FUNCTION__)
            ->setFetchnum(count($return))
            ->__invoke();
        return $return;
    }

    /**
     * 查询多条数据,一次性全部返回
     * @return array
     */
    public function selectAll()
    {
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();

        $pdoRead = new PdoRead($this);
        $return = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
        if ($this->isConvertToArray()) {
            foreach ($return as &$v) {
                $v = get_object_vars($v);
            }
        }
        $pdoRead
            ->setTableName($this->getTableName())
            ->setSqlaction(__FUNCTION__)
            ->setFetchnum(count($return))
            ->__invoke();

        return $return;
    }

    /**
     * 查询多条数据,延迟返回
     * @return \Generator
     */
    public function yield()
    {
        $this->setBuff(false);
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();
        while ($return = $stmt->fetchObject($this->className)) {
            if ($this->isConvertToArray()) {
                $return = get_object_vars($return);
            }
            //每次循环开始，都重置日志记录。
            DefineLog::resetUniqids();
            yield $return;
        }
    }

    public function insert()
    {
        $this->并发上锁(__FUNCTION__);
        $insertId = $this->pdoexecute(__FUNCTION__);
        $this->并发释放锁();
        return $insertId;
    }

    /**
     * 纯粹执行sql.
     *
     * @return \PDOStatement
     */
    public function execute()
    {
        $this->并发上锁(__FUNCTION__);
        $Statement = $this->pdoexecute(__FUNCTION__);
        $this->并发释放锁();
        return $Statement;
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
        $this->并发上锁(__FUNCTION__);
        $updated = $this->pdoexecute(__FUNCTION__);
        $this->并发释放锁();

        return $updated;
    }

    /**
     * 防止并发更新,写入同一张表
     */
    protected function 并发上锁($function = null)
    {
        return true;
        //如果存在redis配置,执行并发改串行操作
        if ($this->getRedisCacheConfig() instanceof RedisConfig && $_SERVER['dockername']) {
            $toJson = (new ConvertObject())->setObject($this->getSqlParserd())->toJson();
            $this->lockKeyObject = (new LockKey())
                ->setKey("PDOLOCK_{$function}_".$_SERVER['dockername'] . $this->getTableName())
                ->setValue($toJson)
                ->setExpire(1)
                ->setWaitForunlock(true)
                ->setRedisConfig($this->getRedisCacheConfig());
            //加上redis锁,防止并发操作
            $SQl更新并发锁失败 = !$this->lockKeyObject
                ->__invoke();
            if ($SQl更新并发锁失败) {
                throw new \Exception("SQL并发锁失败($function)." . $toJson);
            }
        }
    }

    protected function 并发释放锁()
    {
        return true;
        if ($this->lockKeyObject instanceof LockKey) {
            $this->lockKeyObject->free();
        }
    }

    /**
     * @param PageObject $pageObject
     *
     * @return array
     */
    public function page(PageObject &$pageObject)
    {
        //如果已经处理过分页了，那么不要再折腾了
        if ($pageObject->getTotal()) {
        } else {
            //查询当前条件下可以命中多少数据量
            $str = ' FROM ';
            $pos = stripos($this->sqlParserd->getSql(), $str);
            $whereSql = substr($this->sqlParserd->getSql(), $pos + strlen($str));
            $SqlParserd = (new SqlParserd())
                ->setSql('SELECT count(*) FROM ' . $whereSql);
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
        }
        $this->getSqlParserd()
            ->setSql($this->getSqlParserd()->getSql() . ' limit ' . $pageObject->getFrom() . ',' . $pageObject->getPrepage());

        return $this->selectAll();
    }

    /**
     * @throws PdoSqlError
     * @throws \Exception
     *
     * @return \PDOStatement | int
     */
    private function pdoexecute($action)
    {
        tryagain:
        $PDO = $this->getPdoConfig()->instanceSelf($this->isBuff());
        //记录日志
        $PdoRunLog = (new PdoRunLog($this))
            ->setTableName($this->getTableName())
            ->setSqlaction($action);

        //执行sql
        try {
            $stmt = $PDO->prepare($this->getSqlParserd()->getSql());
        } catch (\Exception $e) {
            $PdoRunLog
                ->setMessage(mb_convert_encoding($e->getMessage(), 'UTF-8'))
                ->setMessageDescribe('链接服务器异常')
                ->setException($e->getMessage())
                ->setType(LogLevel::ERROR)
                ->__invoke();
            throw $e;
        }
        foreach ($this->getSqlParserd()->getBind() as $bind) {
            $stmt->bindValue($bind->getKey(), $bind->getValue());
        }
        $stmt->execute();
        $error = $stmt->errorInfo();
        $error[1] = (int)filter_var($error[1], FILTER_SANITIZE_NUMBER_INT);

        //如果是在非事务下面，并且是被数据库断开了链接，那么可以重试
        if ($this->isBuff() == false && in_array($error[1], [2013, 2006])) {
            $this->getPdoConfig()->resetInstance($this->isBuff());
            goto tryagain;
        }

        if ($error[1] || $error[2]) {
            $this->isBuff() && $this->rollBack();
            $PdoRunLog
                ->setMessage(json_encode($error, JSON_UNESCAPED_UNICODE))
                ->setException(json_encode($error, JSON_UNESCAPED_UNICODE))
                ->setMessageDescribe('SQL运行错误')
                ->setType(LogLevel::ERROR)
                ->__invoke();
            throw new \Exception(json_encode(
                [
                    $error,
                    $this->getSqlParserd()->getSql(),
                    $this->getSqlParserd()->getBindArray(),
                ], JSON_UNESCAPED_UNICODE
            ));
        }
        $this->debug();
        //sql计数
        self::setSqlCount(1);

        //如果是更新的话，返回的是被影响到的条数
        if ($action == 'update') {
            $num = $stmt->rowCount();
            $PdoRunLog
                ->setFetchnum($num)
                ->__invoke();
            return $num;
        } elseif ($action == 'insert') {
            $inserid = $PDO->lastInsertId();
            $PdoRunLog
                ->setFetchnum($inserid ? 1 : 0)
                ->__invoke();
            return $inserid;
        }elseif(in_array($action,['selectOne','selectColumn','selectAll']))
        {
            $PdoRunLog
                ->setWritefilelog(false);
            return $stmt;
        } else {
            $PdoRunLog
                ->__invoke();
            return $stmt;
        }
    }

    /**
     * @desc   回滚事务
     *
     * @since  2015-04-27 17:09:19
     *
     * @return bool
     */
    public function rollBack()
    {
        $this->pdoConfig->instanceSelf()->rollBack();
        return $this->pdoConfig->instanceSelf()->beginTransaction($this->isBuff());
    }

    /**
     * @desc   提交事务
     *
     * @since  2015-04-27 17:09:19
     *
     * @return bool
     */
    public function commit()
    {
        $this->pdoConfig->instanceSelf()->commit();
        return $this->pdoConfig->instanceSelf()->beginTransaction($this->isBuff());
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
        if ($this->getDebug()) {
            ob_start();
            echo "\n=========================\n";
            echo "SQL:\n";
            print_r($this->sqlParserd);
            echo "\nTNS:\n";
            print_r($this->getPdoConfig()->getPdoString());
            echo "\nDEBUG:\n";
            debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            echo "\n=========================@in " . __FILE__ . ' on line ' . __LINE__ . "\n";
            Util::d(ob_get_clean());
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:40.
 */

namespace xltxlm\orm;

use Psr\Log\LogLevel;
use xltxlm\h5skin\Request\UserCookieModel;
use xltxlm\helper\Ctroller\LoadClass;
use xltxlm\helper\Util;
use xltxlm\logger\Logger;
use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\Exception\I18N\PdoInterfaceI18N;
use xltxlm\orm\Exception\PdoInterfaceException;
use xltxlm\orm\Exception\PdoSqlError;
use xltxlm\orm\Logger\PdoRunLogger;
use xltxlm\orm\Sql\SqlParser;
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

    /** @var bool 是否正常数据量查询. false:准备查询超级大数据 */
    protected $buff = true;

    /** @var bool 是否修改了数据库 */
    protected $changeData = false;

    /**
     * @return bool
     */
    public function isChangeData(): bool
    {
        return $this->changeData;
    }

    /**
     * 只要有一次是修改了数据,整个都连接过程记录修改数据
     * @param bool $changeData
     *
     * @return PdoInterface
     */
    public function setChangeData(bool $changeData): PdoInterface
    {
        if ($changeData) {
            $this->changeData = $changeData;
        }

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
        $stmt = $this->pdoexecute();
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

    /**
     * 查询一列数据.
     *
     * @return array
     */
    public function selectColumn($ColumnName = 0): array
    {
        $stmt = $this->pdoexecute();
        $this->checkClassName();

        return $stmt->fetchAll(\PDO::FETCH_COLUMN, $ColumnName);
    }

    /**
     * 查询多条数据,一次性全部返回
     * @return array
     */
    public function selectAll()
    {
        $stmt = $this->pdoexecute();
        $this->checkClassName();

        $return = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
        if ($this->isConvertToArray()) {
            foreach ($return as &$v) {
                $v = get_object_vars($v);
            }
        }

        return $return;
    }

    /**
     * 查询多条数据,延迟返回
     * @return \Generator
     */
    public function yield()
    {
        $this->setBuff(false);
        $stmt = $this->pdoexecute();
        $this->checkClassName();
        while ($return = $stmt->fetchObject($this->className)) {
            if ($this->isConvertToArray()) {
                $return = get_object_vars($return);
            }
            yield $return;
        }
    }

    public function insert()
    {
        //保证会话参数存在
        $this->setSession();
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
        //保证会话参数存在
        $this->setSession();

        return $this->pdoexecute();
    }

    /**
     * 设置当前账户的会话参数,在触发器中可以用来记录账户信息.
     */
    final protected function setSession()
    {
        static $session = [];

        if (!$session[spl_object_hash($this->pdoConfig->instanceSelf())]) {
            $userCookieModel = new UserCookieModel();
            $userCookieModel->url = $_SERVER['REQUEST_URI'];
            $userCookieModel->hostname = $_SERVER['HOSTNAME'];
            (clone $this)
                ->setSqlParserd(
                    (new SqlParser())
                        ->setSql('set  @userflag=:userflag ,@username=:username ,@ip=:ip  ')
                        ->setBind([
                            'userflag' => $userCookieModel->__toString(),
                            'username' => $userCookieModel->getUsername(),
                            'ip' => $userCookieModel->getIp(),
                        ])
                        ->__invoke()
                )
                ->pdoexecute();
            $session[spl_object_hash($this->pdoConfig->instanceSelf())] = true;
        }
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
        //保证会话参数存在
        $this->setSession();
        $stmt = $this->pdoexecute();

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
     * @throws PdoSqlError
     * @throws \Exception
     *
     * @return \PDOStatement
     */
    private function pdoexecute(): \PDOStatement
    {
        //记录日志
        $DefineLog = (new PdoRunLogger($this->getPdoConfig()))
            ->setPdoSql($this->getSqlParserd());
        $start = microtime(true);
        //执行sql
        try {
            $this->setChangeData($this->getSqlParserd()->isChangeData());
            $stmt = $this->pdoConfig->instanceSelf($this->isBuff())->prepare($this->getSqlParserd()->getSql());
        } catch (\Exception $e) {
            $DefineLog
                ->setMessage(mb_convert_encoding($e->getMessage(), 'UTF-8'))
                ->setMessageDescribe('链接服务器异常')
                ->setType(LogLevel::ERROR);
            (new Logger())
                ->setLogDefine($DefineLog)
                ->__invoke();
            throw $e;
        }
        foreach ($this->getSqlParserd()->getBind() as $bind) {
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
            $this->rollBack();
            if ($DefineLog) {
                $DefineLog
                    ->setMessage(json_encode($error, JSON_UNESCAPED_UNICODE))
                    ->setMessageDescribe('SQL运行错误')
                    ->setType(LogLevel::ERROR);
                (new Logger())
                    ->setLogDefine($DefineLog)
                    ->__invoke();
            }
            throw (new PdoSqlError(
                json_encode(
                    [
                        $this->getSqlParserd()->getSql(),
                        $this->getSqlParserd()->getBindArray(),
                        $error,
                    ]
                )
            )
            )
                ->setSql($this->getSqlParserd()->getSql())
                ->setBinds($this->getSqlParserd()->getBind())
                ->setErrorinfo(json_encode($error));
        }
        if ($DefineLog) {
            (new Logger())
                ->setLogDefine($DefineLog)
                ->__invoke();
        }
        $this->debug();
        //sql计数
        self::setSqlCount(1);

        return $stmt;
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
        return $this->pdoConfig->instanceSelf()->beginTransaction();
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
        return $this->pdoConfig->instanceSelf()->beginTransaction();
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
            echo "\n=========================@in ".__FILE__.' on line '.__LINE__."\n";
            Util::d(ob_get_clean());
        }
    }
}

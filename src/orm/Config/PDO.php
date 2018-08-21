<?php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/4/1
 * Time: 11:02
 */

namespace xltxlm\orm\Config;

use xltxlm\h5skin\Request\UserCookieModel;
use xltxlm\logger\Operation\Connect\PdoConnectLog;
use xltxlm\orm\PdoInterface;
use \xltxlm\logger\Log\DefineLog;

/**
 * 保证一个实例只有一次提交动作
 * Class PDO
 * @package xltxlm\orm\Config
 */
class PDO extends \PDO
{
    /** @var PdoConfig */
    private $PdoConfig;
    private $tns = "";
    /** @var int 数据库的会话id */
    public static $thread_ids = [];
    /** @var string 链接的唯一标志 */
    protected $sign = "";
    protected $statement;

    /** @var bool 是否开启过事务 */
    protected $Transaction = false;
    /** @var int 记录是哪个进程开启的链接，最后只能是那个进程来结束链接 */
    protected $posix_getpid = 0;


    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * Creates a PDO instance representing a connection to a database
     * @link http://php.net/manual/en/pdo.construct.php
     * @param $dsn
     * @param $username [optional]
     * @param $passwd [optional]
     * @param $options [optional]
     */
    public function __construct($dsn, $username, $passwd, $options = [])
    {
        parent::__construct($dsn, $username, $passwd, $options);
        $this->sign = $dsn . $username . $passwd;
        $this->setPosixGetpid(posix_getpid());
        //设置客户端的各个参数
        $userCookieModel = new UserCookieModel();
        $userCookieModel->setUrl(substr(urldecode($_SERVER['REQUEST_URI']) ?: join(",", $_SERVER['argv']), 0, 1000));
        $userCookieModel->setHostname($_SERVER['HOSTNAME']);
        $userCookieModel->setDockername($_SERVER['dockername']);
        $userCookieModel->setPid($this->getPosixGetpid());
        $userCookieModel->setUniqid(DefineLog::getUniqid_static());

        $stmt = $this->prepare("set  @userflag=:userflag ,@username=:username ,@ip=:ip");
        $stmt->bindValue('userflag', $userCookieModel->__toString());
        $stmt->bindValue('username', $userCookieModel->getUsername());
        $stmt->bindValue('ip', $userCookieModel->getIp());
        $stmt->execute();
    }

    /**
     * @return int
     */
    public function getPosixGetpid(): int
    {
        return $this->posix_getpid;
    }

    /**
     * @param int $posix_getpid
     * @return PDO
     */
    public function setPosixGetpid(int $posix_getpid): PDO
    {
        $this->posix_getpid = $posix_getpid;
        return $this;
    }


    /**
     * @return PdoConfig
     */
    public function getPdoConfig(): PdoConfig
    {
        return $this->PdoConfig;
    }

    /**
     * @param PdoConfig $PdoConfig
     * @return PDO
     */
    public function setPdoConfig(PdoConfig $PdoConfig): PDO
    {
        $PdoConfig->setPDOObject(null);
        $this->PdoConfig = $PdoConfig;
        return $this;
    }


    public static function thread_id($sign)
    {
        return self::$thread_ids[$sign];
    }

    /**
     * @return bool
     */
    public function isTransaction(): bool
    {
        return $this->Transaction;
    }

    /**
     * @param bool $Transaction
     * @return PDO
     */
    public function setTransaction(bool $Transaction): PDO
    {
        $this->Transaction = $Transaction;
        return $this;
    }


    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * Initiates a transaction
     * @link http://php.net/manual/en/pdo.begintransaction.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function beginTransaction($buff = true)
    {
        $this->Transaction = $buff;
        $thread_sign = $this->sign . posix_getpid() . (int)$buff;
        if (!self::$thread_ids[$thread_sign]) {
            //设置会话id
            $stmt = $this->prepare("SELECT CONNECTION_ID() as ThreadId");
            $stmt->execute();
            $ThreadId = $stmt->fetchObject(\stdClass::class);
            $stmt->closeCursor();
            if ($ThreadId->ThreadId) {
                self::$thread_ids[$thread_sign] = $ThreadId->ThreadId;
            }
        }
        if ($this->Transaction) {
            return parent::beginTransaction();
        }
    }


    public function prepare($statement, array $driver_options = array())
    {
        $this->statement = $statement;
        return parent::prepare($statement, $driver_options);
    }

    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * Commits a transaction
     * @link http://php.net/manual/en/pdo.commit.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function commit()
    {
        //记录日志
//        (new PdoConnectLog(
//            (new PdoInterface())
//                ->setBuff($this->isTransaction())
//                ->setPdoConfig($this->getPdoConfig())
//        ))
//            ->setAction(PdoConnectLog::TI_JIAO_SHI_WU)
//            ->__invoke();
        return parent::commit();
    }

    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * Rolls back a transaction
     * @link http://php.net/manual/en/pdo.rollback.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function rollBack()
    {
        //记录日志
        (new PdoConnectLog(
            (new PdoInterface())
                ->setBuff($this->isTransaction())
                ->setPdoConfig($this->getPdoConfig())
        ))
            ->setAction(PdoConnectLog::HUI_GUN_SHI_WU)
            ->__invoke();
        return parent::rollBack();
    }


    /**
     * @return string
     */
    public function getTns(): string
    {
        return $this->tns;
    }

    /**
     * @param string $tns
     * @return PDO
     */
    public function setTns(string $tns): PDO
    {
        $this->tns = $tns;
        return $this;
    }

    /**
     * 退出的时候，主动提交事务
     */
    public function __destruct()
    {
        if ($this->getPosixGetpid() == posix_getpid() && $this->Transaction) {
            $this->commit();
        }
        PdoConfig::unsetinstance($this->tns);
    }
}

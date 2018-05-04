<?php
/**
 * Created by PhpStorm.
 * User: sahara
 * Date: 2015/12/27
 * Time: 21:54.
 */

namespace xltxlm\orm\Config;

use xltxlm\config\TestConfig;
use xltxlm\logger\Operation\Connect\PdoConnectLog;

/**
 * PDO配置的参数清单,文件的名称就是数据库的名称,所有没有db属性
 * Class pdoConfig.
 */
abstract class PdoConfig implements TestConfig
{
    protected $db;
    /** @var PDO[] 确保一个进程相同配置只能链接一次 */
    private static $instance = [];

    const MYSQL = 'mysql';
    const POSTGRESQL = 'postgresql';
    /** @var string tns链接字符串 */
    private $link = '';
    /** @var PDO */
    protected $PDOObject;
    /** @var string 数据库的驱动 */
    protected $driver = self::MYSQL;
    /** @var string 服务器的ip地址 */
    protected $TNS;
    /** @var string 服务器的端口 */
    protected $port = 3306;
    /** @var string 数据的编码 */
    protected $encode = 'utf8';
    /** @var string 数据库账户 */
    protected $username;
    /** @var string 数据密码 */
    protected $password;


    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     *
     * @return $this
     */
    public function setDriver(string $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @return string
     */
    public function getTNS(): string
    {
        return $this->TNS;
    }

    /**
     * @param string $TNS
     *
     * @return $this
     */
    public function setTNS(string $TNS)
    {
        $this->TNS = $TNS;

        return $this;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @param string $port
     *
     * @return $this
     */
    public function setPort(string $port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncode(): string
    {
        return $this->encode;
    }

    /**
     * @param string $encode
     *
     * @return $this
     */
    public function setEncode(string $encode)
    {
        $this->encode = $encode;

        return $this;
    }

    /**
     * 数据如果没有设置,那么用类的名称
     * @return string
     */
    public function getDb(): string
    {
        if (empty($this->db)) {
            $this->db = strtolower(array_pop(explode('\\', static::class)));
        }
        return $this->db;
    }

    /**
     * @param mixed $db
     * @return PdoConfig
     */
    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * 返回链接,重新链接.
     * @return PDO
     */
    private function instance($buff = true)
    {
        $tns = $this->getPdoString();
        try {
            $start = microtime(true);
            $this->PDOObject = new  PDO($tns, $this->getUsername(), $this->getPassword());
            $this->PDOObject->setAttribute(\PDO::ATTR_TIMEOUT, 2);
            $this->PDOObject->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, $buff);
            //所有数据库,默认都必须开启事务
            if ($buff) {
                $this->PDOObject->beginTransaction();
            }
            $time = sprintf('%.4f', microtime(true) - $start);
            (new PdoConnectLog($this))->setRunTime($time)->__invoke();
        } catch (\PDOException $e) {
            throw new \PDOException(trim($e->getMessage()) . "[$tns]");
        }
        return $this->PDOObject;
    }

    /**
     * 返回链接,单例.
     * @param bool $buff 是否正常数据量查询. false:准备查询超级大数据,两种连接在一个进程里面只能各开一种
     * @return PDO
     */
    final public function instanceSelf($buff = true)
    {
        $tns = $this->getPdoString() . '_' . (int)posix_getpid() . '_' . (int)$buff;
        if (!self::$instance[$tns]) {
            if (!$buff) {
                self::$instance[$tns] = $this->instance($buff);
            } else {
                self::$instance[$tns] = $this->instance($buff);
                $this->PDOObject->lock($tns);
            }
        }

        return self::$instance[$tns];
    }

    /**
     * 断开连接，重新连接
     */
    public function resetInstance($buff = true)
    {
        $tns = $this->getPdoString() . '_' . (int)posix_getpid() . '_' . (int)$buff;
        unset(self::$instance[$tns]);
        return $this->instanceSelf($buff);
    }

    /**
     * 全部数据提交事务
     */
    final public static function commit()
    {
        foreach (self::$instance as $key => $item) {
            //如果不是提交类型的
            if (substr($key, -1) == 0) {
                continue;
            }
            try {
                $item->commit();//提交之后,继续事务
                $item->beginTransaction();
            } catch (\Throwable $e) {
            }
        }
    }

    /**
     * 全部数据回滚事务
     */
    final public static function rollback()
    {
        foreach (self::$instance as $key => $item) {
            //如果不是提交类型的
            if (substr($key, -1) == 0) {
                continue;
            }
            try {
                $item->rollBack();//提交之后,继续事务
                $item->beginTransaction();
            } catch (\Throwable $e) {
            }
        }
    }


    //注销完毕之后删除掉实例
    final public static function unsetinstance($tns)
    {
        unset(self::$instance[$tns]);
    }

    /**
     * @return \PDO
     */
    public function test()
    {
        $PDOObject = $this::instanceSelf();
        //查询锁，如果存在，那么报错
        foreach ($PDOObject->query("information_schema.INNODB_LOCK_WAITS", \PDO::FETCH_ASSOC) as $lock) {
            throw new \Exception("Mysql锁等待:", var_export($lock, true));
        }
        return $PDOObject;
    }

    /**
     * @return array
     */
    public static function getInstance(): array
    {
        return self::$instance;
    }

    public static function clearInstance()
    {
        self::$instance = [];
    }


    /**
     * 获取PDO链接的字符串.
     *
     * @return string
     */
    public function getPdoString(): string
    {
        $this->link = $this->getDriver() .
            ':dbname=' . $this->getDb() .
            ';host=' . $this->getTNS() .
            ';port=' . $this->getPort();
        //强制UTF8编码
        if ($this->getDriver() == self::MYSQL) {
            $this->link .= ';charset=utf8mb4';
        }

        return $this->link;
    }
}

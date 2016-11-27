<?php
/**
 * Created by PhpStorm.
 * User: sahara
 * Date: 2015/12/27
 * Time: 21:54.
 */
namespace Orm\Config;

/**
 * PDO配置的参数清单
 * Class pdoConfig.
 */
abstract class PdoConfig
{
    const MYSQL = 'mysql';
    const POSTGRESQL = 'postgresql';

    /** @var \PDO */
    protected $PDOObject;
    /** @var string 数据库的驱动 */
    protected $driver = self::MYSQL;
    /** @var string 服务器的ip地址 */
    protected $TNS;
    /** @var string 服务器的端口 */
    protected $port = 3306;
    /** @var string 数据的编码 */
    protected $encode = 'utf8';
    /** @var string 数据库的名称 */
    protected $db;
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
     * @return string
     */
    public function getDb(): string
    {
        return strtolower(array_pop(explode('\\', static::class)));
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
     */
    private function instance()
    {
        $tns = $this->getPdoString();
        $this->PDOObject = new  \PDO($tns, $this->getUsername(), $this->getPassword());
        $this->PDOObject->setAttribute(\PDO::ATTR_TIMEOUT, 1);
        //所有数据库,默认都必须开启事务
        $this->PDOObject->beginTransaction();

        return $this->PDOObject;
    }

    /**
     * 返回链接,单例.
     */
    final public function instanceSelf()
    {
        static $instance;
        if (!$instance) {
            $instance = $this->instance();
        }

        return $instance;
    }

    public function __destruct()
    {
        if ($this->PDOObject) {
            $this->PDOObject->commit();
        }
    }

    /**
     * 获取PDO链接的字符串
     * @return string
     */
    public function getPdoString():string
    {
        $tns = $this->getDriver() .
            ':dbname=' . $this->getDb() .
            ';host=' . $this->getTNS() .
            ';port=' . $this->getPort();
        //强制UTF8编码
        if ($this->getDriver() == self::MYSQL) {
            $tns .= ';charset=utf8';
            return $tns;
        }
        return $tns;
    }
}

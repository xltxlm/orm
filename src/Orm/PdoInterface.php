<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:40.
 */
namespace Orm;

use Orm\Config\PdoConfig;

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
    public function isDebug(): bool
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
        if (!$this->className) {
            throw new \Orm\Exception\PdoInterfaceException(
                (new \Orm\I18N\PdoInterfaceI18N())
                    ->getMissModel()
            );
        }

        return $stmt->fetchObject($this->className);
    }

    public function selectAll()
    {
        $stmt = $this->pdoexecute();
        if (!$this->className) {
            throw new \Orm\Exception\PdoInterfaceException(
                (new \Orm\I18N\PdoInterfaceI18N())
                    ->getMissModel()
            );
        }

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }

    public function insert()
    {
        $this->pdoexecute();

        return $this->pdoConfig->instanceSelf()->lastInsertId();
    }

    /**
     * @throws Exception\PdoInterfaceException
     *
     * @return int
     */
    public function update()
    {
        if (stripos($this->getSqlParserd()->getSql(), 'where') === false) {
            throw new \Orm\Exception\PdoInterfaceException(
                (new \Orm\I18N\PdoInterfaceI18N())
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
    public function page(\Orm\PageObject &$pageObject)
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
    private function pdoexecute():\PDOStatement
    {
        $stmt = $this->pdoConfig->instanceSelf()->prepare($this->sqlParserd->getSql());
        foreach ($this->sqlParserd->getBind() as $bind) {
            $stmt->bindValue($bind->getKey(), $bind->getValue());
        }
        $stmt->execute();
        $error = $stmt->errorInfo();
        $error[0] = (int) filter_var(
            $error[0],
            FILTER_SANITIZE_NUMBER_INT
        );

        if ($error[0] || $error[2]) {
            throw (new \Orm\Exception\PdoSqlError(
                json_encode(
                    [
                        $this->sqlParserd->getSql(),
                        $this->sqlParserd->getBind(),
                        $error,
                    ]
                )
            )
            )
                ->setSql($this->sqlParserd->getSql())
                ->setBinds($this->sqlParserd->getBind())
                ->setErrorinfo(json_encode($error));
        }

        if ($this->debug) {
            echo "\n=========================\n";
            print_r($this->sqlParserd);
            echo "\n=========================@in ".__FILE__.' on line '.__LINE__."\n";
        }

        return $stmt;
    }
}

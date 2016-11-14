<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:40
 */

namespace Orm;

/**
 *  out:最基础的数据库执行方式.
 * Interface sqlInterface
 * @package libs\db
 */
final class PdoInterface
{
    /** @var  \PDO */
    protected $pdoObject;

    /** @var  SqlParserd */
    protected $sqlParserd;

    /** @var  string 数据对象 */
    protected $className;

    /** @var bool 是否开启调试 */
    protected $debug = false;

    /**
     * @return boolean
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
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
     * @param \stdClass $className
     * @return PdoInterface
     */
    public function setClassName($className): PdoInterface
    {
        $this->className = $className;
        return $this;
    }


    /**
     * @return \PDO
     */
    public function getPdoObject(): \PDO
    {
        return $this->pdoObject;
    }

    /**
     * @param \PDO $pdoObject
     * @return PdoInterface
     */
    public function setPdoObject(\PDO $pdoObject): PdoInterface
    {
        $this->pdoObject = $pdoObject;
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
        return current($this->selectOne());
    }

    /**
     * @return array
     * @throws Exception\PdoInterfaceException
     */
    public function selectOne()
    {
        $stmt = $this->pdoexecute();
        if (!$this->className) {
            throw new \Orm\Exception\PdoInterfaceException(
                (new \Orm\I18N\PdoInterface)
                    ->getMissModel()
            );
        }
        return $stmt->fetchObject($this->className);
    }

    public function selectAll()
    {
        $datas = [];
        $stmt = $this->pdoexecute();
        if (!$this->className) {
            throw new \Orm\Exception\PdoInterfaceException(
                (new \Orm\I18N\PdoInterface)
                    ->getMissModel()
            );
        }
        do {
            $datas[] = $stmt->fetchObject($this->className);
        } while ($stmt->nextRowset());
        return $datas;
    }

    public function add()
    {
        $this->pdoexecute();
        return $this->pdoObject->lastInsertId();
    }

    /**
     * @return int
     */
    public function update()
    {
        $stmt = $this->pdoexecute();
        return $stmt->rowCount();
    }

    /**
     * @return \PDOStatement
     */
    private function pdoexecute():\PDOStatement
    {
        $stmt = $this->pdoObject->prepare($this->sqlParserd->getSql());
        foreach ($this->sqlParserd->getBind() as $bind) {
            $stmt->bindValue($bind->getKey(), $bind->getValue());
        }
        $stmt->execute();
        if ($this->debug) {
            echo "\n=========================\n";
            print_r($this->sqlParserd);
            echo "\n=========================@in " . __FILE__ . " on line " . __LINE__ . "\n";
        }
        return $stmt;
    }
}

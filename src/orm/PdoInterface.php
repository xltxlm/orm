<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:40.
 */

namespace xltxlm\orm;

use xltxlm\logger\LoggerTrack;
use xltxlm\logger\Mysqllog\Mysqllog_TraitClass;
use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\Exception\I18N\PdoInterfaceI18N;
use xltxlm\orm\Exception\PdoInterfaceException;
use xltxlm\orm\Exception\PdoSqlError;
use xltxlm\orm\PdoInterface\PdoInterface_implements;
use xltxlm\orm\Sql\SqlParserd;
use xltxlm\page\PageObject;

/**
 *  out:最基础的数据库执行方式.
 * Interface sqlInterface.
 */
class PdoInterface extends PdoInterface_implements
{
    /** @var string 当前所处理的表格名称，由外部告诉，不去分析sql */
    protected $table_name = "";
    /** @var PdoConfig 数据库配置 */
    protected $pdoConfig;

    /** @var SqlParserd */
    protected $sqlParserd;

    /** @var int 整个会话里面执行sql的数量 */
    private static $sqlCount = 0;

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
     * @param bool $convertToArray
     *
     * @return PdoInterface
     */
    public function setConvertToArray(bool $convertToArray = false): PdoInterface
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
     *  生成日志记录对象，通用接口;
     *
     * @return :\xltxlm\logger\LoggerTrack;
     */
    protected function getLogger(): LoggerTrack
    {
        return (new LoggerTrack())
            ->setresource_type('mysql')
            ->setcontext(
                [
                    'tns' => $this->getPdoConfig()->getPdoString(),
                    'sql' => $this->getSqlParserd()->getSql(),
                    'bind' => $this->getSqlParserd()->getBindArray() ?: [],
                    'tablename' => $this->getTableName(),
                ]
            );
    }


    private function getMysqllog_TraitClass(): Mysqllog_TraitClass
    {
        return (new Mysqllog_TraitClass())
            ->settns($this->getPdoConfig()->getTNS())
            ->setpdoSql($this->getSqlParserd()->getSql())
            ->setsqlbinds(json_encode($this->getSqlParserd()->getBindArray() ?: [], JSON_UNESCAPED_UNICODE))
            ->settable_name($this->getTableName());
    }

    /**
     * @return mixed
     * @throws Exception\PdoInterfaceException
     *
     */
    public function selectOne()
    {
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();

        $logger = $this->getLogger();
        $return = $stmt->fetchObject($this->className);
        if (empty($return)) {
            $return = new $this->className();
        }
        if ($this->isConvertToArray()) {
            $return = get_object_vars($return);
        }
        $logger
            ->setcontext(
                [
                    'function' => __FUNCTION__,
                    'num' => $return ? 1 : 0
                ]
            );
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

        $mysqllog_TraitClass = $this->getMysqllog_TraitClass();
        $return = $stmt->fetchAll(\PDO::FETCH_COLUMN, $ColumnName);

        $mysqllog_TraitClass
            ->setSqlaction(__FUNCTION__)
            ->setFetchnum(count($return))
            ->__invoke();
        return $return;
    }

    /**
     * 查询多条数据,一次性全部返回
     *
     * @return array
     */
    public function selectAll()
    {
        $stmt = $this->pdoexecute(__FUNCTION__);
        $this->checkClassName();

        $mysqllog_TraitClass = $this->getMysqllog_TraitClass();
        $return = $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
        if ($this->isConvertToArray()) {
            foreach ($return as &$v) {
                $v = get_object_vars($v);
            }
        }
        $mysqllog_TraitClass
            ->setSqlaction(__FUNCTION__)
            ->setFetchnum(count($return))
            ->__invoke();
        return $return;
    }

    /**
     * 查询多条数据,延迟返回
     *
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
            yield $return;
        }
    }

    public function insert()
    {
        $insertId = $this->pdoexecute(__FUNCTION__);
        return $insertId;
    }

    /**
     * 纯粹执行sql.
     *
     * @return \PDOStatement
     */
    public function execute()
    {
        $Statement = $this->pdoexecute(__FUNCTION__);
        return $Statement;
    }

    /**
     * @return int
     * @throws \Exception
     *
     */
    public function update()
    {
        if (stripos($this->getSqlParserd()->getSql(), 'where') === false) {
            throw new \Exception("update操作没有包含where条件");
        }
        $updated = $this->pdoexecute(__FUNCTION__);
        return $updated;
    }


    /**
     * @param PageObject $pageObject
     *
     * @return array
     */
    public function page(PageObject &$pageObject, $selectColumn = '')
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
                ->setTableName($this->getTableName())
                ->selectVar();

            $pageObject
                ->setTotal($num)
                ->__invoke();
        }
        $this->getSqlParserd()
            ->setSql($this->getSqlParserd()->getSql() . ' limit ' . $pageObject->getFrom() . ',' . $pageObject->getPrepage());

        if ($selectColumn) {
            $selectColumn1 = $this->selectColumn($selectColumn);
            return $selectColumn1;
        } else {
            $selectAll = $this->selectAll();
            return $selectAll;
        }
    }

    /**
     * @return \PDOStatement | int
     * @throws \Exception
     *
     * @throws PdoSqlError
     */
    private function pdoexecute($action)
    {
        $PDO = $this->getPdoConfig()->instanceSelf($this->isBuff());
        //设置客户端的各个参数
        $userflag = [];
        $debug_backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        foreach ($debug_backtrace as $k => $item) {
            if (strpos($item['file'], '/vendor/') !== false) {
                unset($debug_backtrace[$k]);
            }
        }
        $userflag['debug'] = $debug_backtrace;

        $stmt = $PDO->prepare("set  @userflag=:userflag");
        $stmt->bindValue('userflag', json_encode($userflag, JSON_UNESCAPED_UNICODE));
        $stmt->execute();

        tryagain:
        //记录日志
        $logger = $this->getLogger()
            ->setcontext([
                'function' => $action
            ]);

        //执行sql
        try {
            $stmt = $PDO->prepare($this->getSqlParserd()->getSql());
        } catch (\Exception $e) {
            $logger
                ->setcontext(['exception' => "pdo-prepare 阶段出错" . mb_convert_encoding($e->getMessage(), 'UTF-8')]
                );
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
            $logger
                ->setcontext(['exception' => "pdo-execute sql出错" . ($this->isBuff() ? '并且整个事务被回滚了。' : '') . json_encode($error, JSON_UNESCAPED_UNICODE)]);
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
            $logger
                ->setcontext(
                    [
                        'num' => $num
                    ]
                );
            return $num;
        } elseif ($action == 'insert') {
            $inserid = $PDO->lastInsertId();
            $logger
                ->setcontext(
                    [
                        'num' => $inserid ? 1 : 0,
                        'inserid' => $inserid
                    ]
                );
            return $inserid;
        } elseif (in_array($action, ['selectOne', 'selectColumn', 'selectAll'])) {
            return $stmt;
        } else {
            $logger
                ->__invoke();
            return $stmt;
        }
    }

    /**
     * @desc   回滚事务
     *
     * @return bool
     * @since  2015-04-27 17:09:19
     *
     */
    public function rollBack()
    {
        $this->pdoConfig->instanceSelf()->rollBack();
        return $this->pdoConfig->instanceSelf()->beginTransaction($this->isBuff());
    }

    /**
     * @desc   提交事务
     *
     * @return bool
     * @since  2015-04-27 17:09:19
     *
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
            p(ob_get_clean());
        }
    }
}

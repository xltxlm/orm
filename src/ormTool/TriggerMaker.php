<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 下午 4:34.
 */

namespace xltxlm\OrmTool;

use xltxlm\orm\Config\PdoConfig;
use xltxlm\orm\PdoInterface;
use xltxlm\orm\Sql\SqlParser;
use xltxlm\ormTool\Unit\DB;
use xltxlm\ormTool\Unit\Table;

/**
 * 触发器生成
 * Class TriggerMaker.
 */
final class TriggerMaker
{
    private $newTriggerTableFields;
    private $oldTriggerTableFields = [];
    /** @var PdoConfig 业务数据库 */
    protected $originalDB;
    /** @var PdoConfig 日志数据库 */
    protected $LogDB;

    /**
     * @return mixed
     */
    public function getNewTriggerTableFields()
    {
        return $this->newTriggerTableFields;
    }

    /**
     * @return array
     */
    public function getOldTriggerTableFields(): array
    {
        return $this->oldTriggerTableFields;
    }

    public function __invoke()
    {
        $originalDBTables = (new DB())
            ->setDbConfig($this->getOriginalDB())
            ->__invoke();
        foreach ($originalDBTables as $originalDBTable) {
            //获取原始表的所有字段
            $tableObject = (new Table())
                ->setDbConfig($this->getOriginalDB())
                ->setName($originalDBTable->getTABLENAME());
            $tableFields = $tableObject
                ->getFieldSchemas();

            $sql = 'CREATE TABLE IF NOT EXISTS `'.$originalDBTable->getTABLENAME().'` (
                `logid` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `logactiontype` varchar(50) NOT NULL,
                `logupdatetype` varchar(50),
                `logtime`  datetime NOT NULL,'."\n";
            foreach ($tableFields as $tableField) {
                $nullable = '';
                $DEFAULT = ' DEFAULT NULL ';
                if ($tableField->getISNULLABLE() == 'NO') {
                    $nullable = ' NOT NULL ';
                    $DEFAULT = '';
                }
                if ($tableField->getCOLUMNDEFAULT() !== null) {
                    if ($tableField->getCOLUMNDEFAULT() == 'CURRENT_TIMESTAMP') {
                        $DEFAULT = " DEFAULT CURRENT_TIMESTAMP ";
                    } else {
                        $DEFAULT = " DEFAULT '".$tableField->getCOLUMNDEFAULT()."' ";
                    }
                }
                $sql .= $tableField->getCOLUMNNAME().' '.$tableField->getCOLUMNTYPE()." $nullable  $DEFAULT COMMENT '".
                    $tableField->getCOLUMNCOMMENT()."',\n";

                $this->oldTriggerTableFields[] = 'old.'.$tableField->getCOLUMNNAME();
                $this->newTriggerTableFields[] = 'new.'.$tableField->getCOLUMNNAME();
            }
            $sql .= '    PRIMARY KEY (`logid`),
            KEY `logtime` (`logtime`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8';

            //创建日志数据表
            $SqlParserd = (new SqlParser())
            ->setSql($sql)
            ->__invoke();

            (new PdoInterface())
                ->setPdoConfig($this->getLogDB())
                ->setSqlParserd($SqlParserd)
                ->execute();

            //写入触发器
            ob_start();
            include __DIR__.'/Template/Trigger/Insert.tpl.php';
            $insertSql = ob_get_clean();
            $SqlParserd = (new SqlParser())
                ->setSql($insertSql)
                ->__invoke();
            (new PdoInterface())
                ->setPdoConfig($this->getOriginalDB())
                ->setSqlParserd($SqlParserd)
                ->execute();
            //更新触发器
            ob_start();
            include __DIR__.'/Template/Trigger/Update.tpl.php';
            $insertSql = ob_get_clean();
            $SqlParserd = (new SqlParser())
                ->setSql($insertSql)
                ->__invoke();
            (new PdoInterface())
                ->setPdoConfig($this->getOriginalDB())
                ->setSqlParserd($SqlParserd)
                ->execute();
            //删除触发器
            ob_start();
            include __DIR__.'/Template/Trigger/Delete.tpl.php';
            $insertSql = ob_get_clean();
            $SqlParserd = (new SqlParser())
                ->setSql($insertSql)
                ->__invoke();
            (new PdoInterface())
                ->setPdoConfig($this->getOriginalDB())
                ->setSqlParserd($SqlParserd)
                ->execute();
        }
        //生成触发器SQL
    }

    /**
     * @return PdoConfig
     */
    public function getOriginalDB(): PdoConfig
    {
        return $this->originalDB;
    }

    /**
     * @param PdoConfig $originalDB
     *
     * @return TriggerMaker
     */
    public function setOriginalDB(PdoConfig $originalDB): TriggerMaker
    {
        $this->originalDB = $originalDB;

        return $this;
    }

    /**
     * @return PdoConfig
     */
    public function getLogDB(): PdoConfig
    {
        return $this->LogDB;
    }

    /**
     * @param PdoConfig $LogDB
     *
     * @return TriggerMaker
     */
    public function setLogDB(PdoConfig $LogDB): TriggerMaker
    {
        $this->LogDB = $LogDB;

        return $this;
    }
}

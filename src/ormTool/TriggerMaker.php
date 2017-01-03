<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-28
 * Time: 下午 4:34.
 */

namespace xltxlm\ormTool;

use xltxlm\orm\Config\PdoConfig;
use xltxlm\ormTool\Unit\DB;
use xltxlm\ormTool\Unit\FieldSchema;
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

    public function __invoke()
    {
        $trigger = 'trigger.sql';
        file_put_contents($trigger, "\n");
        $originalDBTables = (new DB())
            ->setDbConfig($this->getOriginalDB())
            ->__invoke();
        foreach ($originalDBTables as $originalDBTable) {

            $this->oldTriggerTableFields = [];
            $this->newTriggerTableFields=[];

            //获取原始表的所有字段
            $tableObject = (new Table())
                ->setDbConfig($this->getOriginalDB())
                ->setName($originalDBTable->getTABLENAME());
            $tableFields = $tableObject
                ->getFieldSchemas();
            if ($originalDBTable->getTABLENAME()[0] == '_') {
                continue;
            }

            $sql = 'CREATE TABLE  `_'.$originalDBTable->getTABLENAME().'` (
                `logid` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `logactiontype` varchar(50) NOT NULL,
                `logupdatetype` varchar(50),
                `logtime`  datetime NOT NULL,'."\n";
            /** @var FieldSchema $tableField */
            foreach ($tableFields as $tableField) {
                $nullable = 'NULL';
                $DEFAULT = ' DEFAULT NULL ';
                if ($tableField->getISNULLABLE() == 'NO') {
                    $nullable = ' NOT NULL ';
                    $DEFAULT = '';
                }
                if ($tableField->getCOLUMNDEFAULT() !== null) {
                    if ($tableField->getCOLUMNDEFAULT() == 'CURRENT_TIMESTAMP') {
                        $DEFAULT = ' DEFAULT CURRENT_TIMESTAMP ';
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
            ) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;';

            file_put_contents($trigger, "\n\n\n#====================================\n\n\n", FILE_APPEND);
            file_put_contents($trigger, $sql."\n", FILE_APPEND);

            //写入触发器
            ob_start();
            include __DIR__.'/Template/Trigger/Insert.tpl.php';
            $insertSql = ob_get_clean();
            file_put_contents($trigger, $insertSql."\n", FILE_APPEND);
            //更新触发器
            ob_start();
            include __DIR__.'/Template/Trigger/Update.tpl.php';
            $insertSql = ob_get_clean();

            file_put_contents($trigger, $insertSql."\n", FILE_APPEND);

            //删除触发器
            ob_start();
            include __DIR__.'/Template/Trigger/Delete.tpl.php';
            $insertSql = ob_get_clean();

            file_put_contents($trigger, $insertSql."\n", FILE_APPEND);
        }
        //生成触发器SQL
    }
}

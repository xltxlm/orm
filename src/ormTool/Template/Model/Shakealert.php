<?php /** @var \xltxlm\ormTool\ShakealertMaker $this */?>
<?='<'?>?php
declare(ticks = 1);

namespace <?=$this::$rootNamespce?>;

use <?=(new \ReflectionClass($this->getTable()->getDbConfig()))->getName()?>;
use <?=(new \ReflectionClass($this->getTable()))->getName()?>Model;
use kuaigeng\pushconfig\Config\KuaigengPushConfig\ShakealertInsert;
use xltxlm\crontab\CrontabLock;
use xltxlm\orm\PdoInterfaceEasy;

eval('include "/var/www/html/vendor/autoload.php";');
/**
* 监控表格数据
*/
class <?=ucfirst($this->getTable()->getName())?>ShakealertSync
{
    use CrontabLock;

    protected function getSleepSecond(): int
    {
        return 3600;
    }


    protected function whileRun()
    {
        $format='Y-m-d';
        $sql="select <?=join(",",$this->getFielSums())?>,<?=$this->getDtField()?> <?php if($this->getGroupby()){?>,<?=join(',',$this->getGroupby())?> <?php }?>
                    from `<?=$this->getTable()->getName()?>`  where <?=$this->getDtField()?>=:<?=$this->getDtField()?>
                <?php if($this->getGroupby()){?>GROUP BY <?=join(',',$this->getGroupby())?> <?php }?>";
        /** @var PushmessageModel[] $selectAll */
        $selectAll = (new PdoInterfaceEasy($sql,['<?=$this->getDtField()?>' => date($format,strtotime('-1 day')) ]))
            ->setPdoConfig(new <?=(new \ReflectionClass($this->getTable()->getDbConfig()))->getShortName()?>)
            ->setClassName(<?=ucfirst($this->getTable()->getName())?>Model::class)
            ->selectAll();

        foreach ($selectAll as $item) {
            $Condition = [];
<?php
$where=$this->getGroupby()?' and ':'';
foreach ($this->getGroupby() as $field){
    $where .= " $field=:$field ";
?>
            $Condition['<?=$field?>'] = $item->get<?=ucfirst($field)?>();
<?php }?>


            //开始写入数据
<?php foreach ($this->getFields() as $field){?>

            $sql = "select <?=join(",",$this->getFielSums())?> from `pushmessage`  where dt=:dt <?=$where?>";
            /** @var PushmessageModel $selectOne 查询一天前的数据 */
            $selectOne = (new PdoInterfaceEasy($sql, ['dt' => date($format, strtotime($item->get<?=ucfirst($this->getDtField())?>()->getValue().' -1 day'))] + $Condition))
                ->setPdoConfig(new KuaigengPushConfig)
                ->setClassName(PushmessageModel::class)
                ->selectOne();
            /** @var PushmessageModel $selectOneWeek 查询一天前的数据 */
            $selectOneWeek = (new PdoInterfaceEasy($sql, ['dt' => date($format, strtotime($item->get<?=ucfirst($this->getDtField())?>()->getValue().' -1 week'))] + $Condition))
                ->setPdoConfig(new KuaigengPushConfig)
                ->setClassName(PushmessageModel::class)
                ->selectOne();

            (new ShakealertInsert())
                ->setIgnore(true)
                ->setTablename('<?=$this->getTable()->getName()?>')
                ->setDtvalue($item->get<?=ucfirst($this->getDtField())?>())
                ->setDtfieldname('<?=$this->getDtField()?>')
                ->setCondition(json_encode($Condition,JSON_UNESCAPED_UNICODE))
                ->setFieldnamenew($item->get<?=ucfirst($field)?>())
                ->setFieldname1day($selectOne->get<?=ucfirst($field)?>())
                ->setFieldname1dayratio(sprintf('%.2f',($item->get<?=ucfirst($field)?>()->getValue() - $selectOne->get<?=ucfirst($field)?>()->getValue())/$selectOne->get<?=ucfirst($field)?>()->getValue()*100))
                ->setFieldname1week($selectOneWeek->get<?=ucfirst($field)?>())
                ->setFieldname1weekratio(sprintf('%.2f',($item->get<?=ucfirst($field)?>()->getValue() - $selectOneWeek->get<?=ucfirst($field)?>()->getValue())/$selectOneWeek->get<?=ucfirst($field)?>()->getValue()*100))
                ->setFieldname('<?=$field?>')
                ->__invoke();

<?php }?>
        }
    }

}

(new <?=ucfirst($this->getTable()->getName())?>ShakealertSync)();

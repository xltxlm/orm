<?php /** @var \xltxlm\ormTool\SqlMaker $this */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2017/3/10
 * Time: 18:26
 */

namespace <?=$this::$rootNamespce?>;

use <?=(new \ReflectionClass($this->getDbconfig()))->getName()?>;
use xltxlm\logger\Log\BasicLog;
use xltxlm\crontab\CrontabLock;
use xltxlm\orm\PdoInterfaceEasy;

eval('include "/var/www/html/vendor/autoload.php";');

/**
 * 更新到Elasticsearch检索的定时任务
 */
final class <?=$this->getClassName()?>Sync

{
    use CrontabLock;

    protected function getSleepSecond(): int
    {
        return 60;
    }

    protected function whileRun()
    {
<?php foreach ($this->getSqls() as $sql) {?>
        $sql="<?=trim($sql," ;\r\n")?>";
        $PdoInterfaceEasy=(new PdoInterfaceEasy($sql));
        $num = $PdoInterfaceEasy
            ->setPdoConfig(new <?=(new \ReflectionClass($this->getDbconfig()))->getShortName()?>())
            ->setDebug(true)
            ->update();

        //记录操作日志
        (new BasicLog($PdoInterfaceEasy))
            ->setMessageDescribe("执行SQL语句,影响条数:$num")
            ->__invoke();
<?php }?>
    }

}

(new <?=$this->getClassName()?>Sync)();
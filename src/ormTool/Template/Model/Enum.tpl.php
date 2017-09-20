<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
<<?='?'?>php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-26
 * Time: 下午 7:26
 */

namespace <?=$this->getDbNameSpace()?>\enum;

class Enum<?=ucfirst($this->getTableSchema()->getTABLENAME())?><?=ucfirst($this->getField()->getCOLUMNNAME())?>

{
<?php foreach ($this->getField()->getENUMARRAY() as $key=>$value) {   ?>
    const <?=$key?>='<?=$value?>';
<?php }?>

    /**
     * 返回当前选项所在的索引位置，从1开始计算
     * @param $key
     * @return int|null
     */
    public static function index($key)
    {
            $indexs=[];
<?php $i=0; foreach ($this->getField()->getENUMARRAY() as $key=>$value) {   ?>
            $indexs[self::<?=$key?>]=<?=++$i?>;
<?php }?>
        return $indexs[$key];
    }
    /**
     * 返回索引位置的值，从1开始计算
     * @param $key
     * @return int|null
     */
    public static function value($key)
    {
            $indexs=[];
<?php $i=0; foreach ($this->getField()->getENUMARRAY() as $key=>$value) {   ?>
            $indexs[<?=++$i?>]=self::<?=$key?>;
<?php }?>
        return $indexs[$key];
    }

    public static function ALL():array
    {
        return [
<?php foreach ($this->getField()->getENUMARRAY() as $key=>$value) {
    ?>
            '<?=$value?>'=>'<?=$value?>',
            <?php

}?>
            ];
    }
}

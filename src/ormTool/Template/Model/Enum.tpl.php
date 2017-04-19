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
<?php foreach ($this->getField()->getENUMARRAY() as $key=>$value) {
    ?>
    const <?=$key?>='<?=$value?>';
<?php

}?>

    public static function ALL():array
    {
        return [<?php foreach ($this->getField()->getENUMARRAY() as $key=>$value) {
    ?>
            '<?=$value?>'=>'<?=$value?>',
            <?php

}?>
            ];
    }
}

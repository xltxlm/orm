<?php /** @var \xltxlm\ormTool\Unit\FieldSchema[] $fieldSchema */
use xltxlm\ormTool\Unit\FieldSchema; ?>
{
    "mappings": {
        "data": {
            "properties": {
            <?php $i=0;foreach ($fieldSchema as $item) { $i++; ?>
                "<?= $item->getCOLUMNNAME() ?>": { "type": <?php
                switch ($item->getDATATYPE()) {
                    case  FieldSchema::DATE :
                    case  FieldSchema::DATETIME:
                    case FieldSchema::TIMESTAMP:
                        echo '"date","format":"yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis||strict_date_optional_time"';
                        break;
                    case FieldSchema::INT:
                    case FieldSchema::TINYINT:
                        echo '"integer"';
                        break;
                    case FieldSchema::BIGINT:
                        echo '"long"';
                        break;
                    case FieldSchema::FLOAT:
                        echo '"float"';
                        break;
                    case FieldSchema::DECIMAL:
                        echo '"double"';
                        break;
                    default:
                        echo '"keyword"';
                        break;
                }
                ?>
                }<?php if(count($fieldSchema)>$i){?>,<?php }?>

            <?php } ?>
            }
        }
    }
}
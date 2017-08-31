<?php /** @var \xltxlm\ormTool\OrmMaker $this */
use xltxlm\helper\BasicType;
use xltxlm\ormTool\Unit\FieldSchema;

$TableName=ucfirst($this->getTableObject()->getName());
?>

// thrift -r   --gen php:psr4  ./Thrift/<?=ucfirst($this->getTableObject()->getName())?>.thrift

/**
 * The first thing to know about are types. The available types in Thrift are:
 *
 *  bool        Boolean, one byte
 *  i8 (byte)   Signed 8-bit integer
 *  i16         Signed 16-bit integer
 *  i32         Signed 32-bit integer
 *  i64         Signed 64-bit integer
 *  double      64-bit floating point value
 *  string      String
 *  binary      Blob (byte array)
 *  map<t1,t2>  Map from one type to another
 *  list<t1>    Ordered list of one type
 *  set<t1>     Set of unique elements of one type
 *
 * Did you also notice that Thrift supports C style comments?
 */


namespace php <?=strtr(trim((new BasicType($this->getDbNameSpace()))->popby('\\',2),'\\'),['\\'=>'.'])?>.Thrift.<?=$TableName?>


/**
 * You can define enums, which are just 32 bit integers. Values are optional
 * and start at 1 if not supplied, C style again.
 */
<?php
$className=(new \ReflectionClass($this->getTableObject()))->getName();
foreach ($this->getTableObject()->getFieldSchemas() as $fieldSchema){
    if( $fieldSchema->getDATATYPE()==FieldSchema::ENUM)
    {
?>
enum <?=$fieldSchema->getCOLUMNNAME()?> {
<?php $i=0; foreach ($fieldSchema->getENUMARRAY() as $key=>$value){ $i++;?>
    //<?=$value?>; mysql的枚举类型呢，写入的时候，可以写入值，也可以写入索引，1=第一个值
    <?=$key?>=<?=$i?><?php if(count($fieldSchema->getENUMARRAY())!=$i){?>,<?php }?>

<?php }?>
}
<?php }}?>

/**
 * Structs are the basic complex data structures. They are comprised of fields
 * which each have an integer identifier, a type, a symbolic name, and an
 * optional default value.
 *
 * Fields can be declared "optional", which ensures they will not be included
 * in the serialized output if they aren't set.  Note that this requires some
 * manual management in some languages.
 */
<?php
//修正 thrift的天坑，自作聪明修改的生成的类名,下划线改成驼峰命名
$TableNameStrings=explode("_",$TableName);
$fixTableName="";
foreach ($TableNameStrings as $tableNameString) {
    $fixTableName.=ucfirst($tableNameString);
}
?>
struct <?=$fixTableName?> {
<?php $i=0; foreach ($this->getTableObject()->getFieldSchemas() as $fieldSchema){ $i++;?>
  //<?=$fieldSchema->getCOLUMNCOMMENT()?>

  <?=$i?>: string <?=$fieldSchema->getCOLUMNNAME()?>

<?php }?>
}

service ThriftServer<?=$fixTableName?> {
   i32 <?=ucfirst($this->getTableObject()->getName())?>Insert(1:<?=$fixTableName?> <?=$fixTableName?>)
    <?=$fixTableName?> <?=ucfirst($this->getTableObject()->getName())?>SelectOne(1:<?=$fixTableName?> <?=$fixTableName?>)
   list<<?=$fixTableName?>> <?=ucfirst($this->getTableObject()->getName())?>SelectAll(1:<?=$fixTableName?> <?=$fixTableName?>)
}

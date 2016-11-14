<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:49
 */

namespace Orm\I18N;

/**
 * out:可翻译的语言配置
 * Class I18N
 * @package orm\I18N
 */
abstract class I18N
{
    const CH = 'CH';
    const EN = 'EN';
    protected static $lang = self::CH;

    /**
     * @return string
     */
    public static function getLang(): string
    {
        return self::$lang;
    }

    /**
     * @param string $lang
     * @return string
     */
    public static function setLang(string $lang): string
    {
        return self::$lang = $lang;
    }


    final public static function getVal($key)
    {
        $ReflectionClass = new \ReflectionClass(__CLASS__);
        $className = $ReflectionClass->getNamespaceName() .
            '\\' . I18N::getLang() .
            '\\' . basename(debug_backtrace()[0]['file'], '.php');
        /** @var  \Orm\I18N\SqlParserI18N $classObject */
        $classObject = (new \ReflectionClass($className))
            ->newInstance();
        return $classObject->$key;
    }
}

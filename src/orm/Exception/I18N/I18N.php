<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-14
 * Time: 上午 10:49.
 */

namespace xltxlm\orm\Exception\I18N;

/**
 * out:可翻译的语言配置
 * Class I18N.
 */
final class I18N
{
    const CH = 'CH';
    const EN = 'EN';
    protected static $lang = self::CH;

    /**
     * @return string
     */
    final public static function getLang(): string
    {
        return self::$lang;
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    final public static function setLang(string $lang): string
    {
        return self::$lang = $lang;
    }

    final public static function getVal()
    {
        $debug_backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $key = lcfirst(substr($debug_backtrace[1]['function'], 3));
        $ReflectionClass = new \ReflectionClass($debug_backtrace[1]['class']);
        //获取语言类名
        $className = $ReflectionClass->getNamespaceName().
            '\\'.self::getLang().
            '\\'.basename($debug_backtrace[0]['file'], '.php');
        /** @var \xltxlm\orm\Exception\I18N\SqlParserI18N $classObject */
        $I18NObject = new $className();
        $reflectionClass = new \ReflectionClass($I18NObject);
        $property = $reflectionClass->getProperty($key);
        $property->setAccessible(true);

        return $property->getValue($I18NObject);
    }
}

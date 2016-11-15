<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-11-13
 * Time: 下午 9:58.
 */
namespace Orm\Unit;

/**
 * out:sql中需要绑定的键值对
 * Class bind.
 */
class BindPair
{
    /** @var string 绑定的key */
    protected $key = '';
    /** @var string 绑定的value */
    protected $value = '';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     *
     * @return BindPair
     */
    public function setKey(string $key): BindPair
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string|int|array $value
     *
     * @return BindPair
     */
    public function setValue($value): BindPair
    {
        $this->value = $value;

        return $this;
    }
}

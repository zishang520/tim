<?php

namespace luoyy\Tim\Support;

use JsonSerializable;
use luoyy\Tim\Contracts\Support\Arrayable;
use luoyy\Tim\Contracts\Support\Jsonable;
use luoyy\Tim\Contracts\Support\Renderable;

/**
 * UserAttrs.
 */
class UserAttrs implements JsonSerializable, Arrayable, Renderable, Jsonable
{
    /**
     * [$To_Account 目标用户帐号].
     * @var string
     */
    protected $To_Account;

    /**
     * [$Attrs 属性集合。每个属性是一个键值对，键为属性名，值为该用户对应的属性值。用户属性值不能超过50字节].
     * @var array
     */
    protected $Attrs;

    public function __construct(string $to_account, array $attrs)
    {
        $this->To_Account = $to_account;
        $this->Attrs = $attrs;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->render();
    }

    public function setTo_Account(string $to_account)
    {
        $this->To_Account = $to_account;

        return $this;
    }

    public function setAttrs(array $attrs)
    {
        $this->Attrs = $attrs;

        return $this;
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'To_Account' => $this->To_Account,
            'Attrs' => $this->Attrs,
        ];
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function render()
    {
        return $this->toJson();
    }

    /**
     * Convert the fluent instance to JSON.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}

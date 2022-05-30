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
     * 目标用户帐号.
     * @var string
     */
    protected $To_Account;

    /**
     * 属性集合。每个属性是一个键值对，键为属性名，值为该用户对应的属性值。用户属性值不能超过50字节.
     * @var array<string, string>
     */
    protected $Attrs;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $to_account 目标用户帐号
     * @param array<string, string> $attrs 属性集合。每个属性是一个键值对，键为属性名，值为该用户对应的属性值。用户属性值不能超过50字节.
     */
    public function __construct(string $to_account, array $attrs)
    {
        $this->To_Account = $to_account;
        $this->Attrs = $attrs;
    }

    /**
     * @return mixed
     */
    public function __toString(): string
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
     */
    public function toArray(): array
    {
        return [
            'To_Account' => $this->To_Account,
            'Attrs' => $this->Attrs,
        ];
    }

    /**
     * Convert the object into something JSON serializable.
     */
    public function jsonSerialize(): array
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

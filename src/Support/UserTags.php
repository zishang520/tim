<?php

namespace luoyy\Tim\Support;

use JsonSerializable;
use luoyy\Tim\Contracts\Support\Arrayable;
use luoyy\Tim\Contracts\Support\Jsonable;
use luoyy\Tim\Contracts\Support\Renderable;

/**
 * UserTags.
 */
class UserTags implements JsonSerializable, Arrayable, Renderable, Jsonable
{
    /**
     * 目标用户帐号.
     * @var string
     */
    protected $To_Account;

    /**
     * 标签集合.
     * @var array
     */
    protected $Tags;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $to_account 目标用户帐号
     * @param array $tags 标签集合
     */
    public function __construct(string $to_account, array $tags)
    {
        $this->To_Account = $to_account;
        $this->Tags = $tags;
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

    public function setTags(array $tags)
    {
        $this->Tags = $tags;

        return $this;
    }

    /**
     * Convert the fluent instance to an array.
     */
    public function toArray(): array
    {
        return [
            'To_Account' => $this->To_Account,
            'Tags' => $this->Tags,
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

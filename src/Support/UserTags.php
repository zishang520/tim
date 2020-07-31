<?php
namespace luoyy\Tim\Support;

use JsonSerializable;
use luoyy\Tim\Contracts\Support\Arrayable;
use luoyy\Tim\Contracts\Support\Jsonable;
use luoyy\Tim\Contracts\Support\Renderable;

/**
 * UserTags
 */
class UserTags implements JsonSerializable, Arrayable, Renderable, Jsonable
{
    /**
     * [$To_Account 目标用户帐号]
     * @var string
     */
    protected $To_Account;

    /**
     * [$Tags 标签集合]
     * @var array
     */
    protected $Tags;

    public function __construct(string $to_account, array $tags)
    {
        $this->To_Account = $to_account;
        $this->Tags = $tags;
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
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'To_Account' => $this->To_Account,
            'Tags' => $this->Tags
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
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->render();
    }
}

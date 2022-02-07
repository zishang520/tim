<?php

namespace luoyy\Tim\Support;

use JsonSerializable;
use luoyy\Tim\Contracts\Support\Arrayable;
use luoyy\Tim\Contracts\Support\Jsonable;
use luoyy\Tim\Contracts\Support\Renderable;

/**
 * MsgBody.
 */
class MsgBody implements JsonSerializable, Arrayable, Renderable, Jsonable
{
    private $MsgBody = [];

    public function __construct(Arrayable ...$msg_body)
    {
        $this->MsgBody = $msg_body;
    }

    /**
     * @return mixed
     */
    public function __toString(): string
    {
        return $this->render();
    }

    public function set(Arrayable ...$msg_body)
    {
        $this->MsgBody = $msg_body;

        return $this;
    }

    public function add(Arrayable ...$msg_body)
    {
        array_push($this->MsgBody, ...$msg_body);

        return $this;
    }

    /**
     * @deprecated
     */
    public function append(Arrayable ...$msg_body)
    {
        return $this->add(...$msg_body);
    }

    public function isEmpty()
    {
        return !$this->MsgBody;
    }

    /**
     * Convert the fluent instance to an array.
     */
    public function toArray(): array
    {
        return array_map(function ($item) {
            return $item->toArray();
        }, $this->MsgBody);
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

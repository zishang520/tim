<?php

namespace luoyy\Tim\Support\MsgBody;

use InvalidArgumentException;
use luoyy\Tim\Contracts\Elem;

/**
 * Raw.
 */
class Raw extends Elem
{
    /**
     * [$Elem 消息数据部分].
     * @var array
     */
    protected $Elem;

    public function __construct(array $elem)
    {
        $this->setElem($elem);
    }

    public function setElem(array $elem)
    {
        if (!isset($elem['MsgType'], $elem['MsgContent'])) {
            throw new InvalidArgumentException('The array keys MsgType and MsgContent must exist and cannot be null');
        }
        $this->Elem = $elem;

        return $this;
    }

    public function type()
    {
        return $this->Elem['MsgType'];
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function data()
    {
        return $this->Elem;
    }
}

<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMFaceElem.
 */
class Face extends Elem
{
    /**
     * [MSGTYPE 消息类型].
     * @var string
     */
    public const MSGTYPE = 'TIMFaceElem';

    /**
     * [$Index 索引].
     * @var int
     */
    protected $Index;

    /**
     * [$Data 额外数据].
     * @var string
     */
    protected $Data = '';

    public function __construct(int $index = null, string $data = '')
    {
        $this->Index = $index;
        $this->Data = $data;
    }

    public function setIndex(int $index)
    {
        $this->Index = $index;

        return $this;
    }

    public function setData(string $data)
    {
        $this->Data = $data;

        return $this;
    }

    public function type()
    {
        return self::MSGTYPE;
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function data()
    {
        return [
            'MsgType' => $this->type(),
            'MsgContent' => [
                'Index' => $this->Index,
                'Data' => $this->Data,
            ],
        ];
    }
}

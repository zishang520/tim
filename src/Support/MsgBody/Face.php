<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMFaceElem.
 */
class Face extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMFaceElem';

    /**
     * 索引.
     * @var int
     */
    protected $Index;

    /**
     * 额外数据.
     * @var string
     */
    protected $Data = '';

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param int|null $index 索引
     * @param string $data 额外数据
     */
    public function __construct(int $index = null, string $data = '')
    {
        $this->Index = $index;
        $this->Data = $data;
    }

    /**
     * 设置索引.
     * @copyright (c) zishang520 All Rights Reserved
     * @param int $index 索引
     */
    public function setIndex(int $index)
    {
        $this->Index = $index;

        return $this;
    }

    /**
     * 设置额外数据.
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $data 额外数据
     */
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

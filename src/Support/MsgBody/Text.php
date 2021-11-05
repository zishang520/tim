<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMTextElem.
 */
class Text extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMTextElem';

    /**
     * 消息数据部分.
     * @var string
     */
    protected $Text = '';

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $text 消息数据部分
     */
    public function __construct(string $text = '')
    {
        $this->Text = $text;
    }

    /**
     * 消息数据部分.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setText(string $text)
    {
        $this->Text = $text;

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
                'Text' => $this->Text,
            ],
        ];
    }
}

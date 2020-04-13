<?php
namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMTextElem
 */
class Text extends Elem
{
    /**
     * [MSGTYPE 消息类型]
     * @var string
     */
    const MSGTYPE = 'TIMTextElem';

    /**
     * [$Text 消息数据部分]
     * @var string
     */
    protected $Text = '';

    public function __construct(string $text = '')
    {
        $this->Text = $text;
    }

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
                'Text' => $this->Text
            ]
        ];
    }
}

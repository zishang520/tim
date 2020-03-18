<?php
namespace luoyy\Tim\MsgBody;

use JsonSerializable;

/**
 * TIMTextElem
 */
class Text implements JsonSerializable
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

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'MsgType' => self::MSGTYPE,
            'MsgContent' => [
                'Text' => $this->Text
            ]
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

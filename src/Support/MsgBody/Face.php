<?php
namespace luoyy\Tim\Support\MsgBody;

use JsonSerializable;

/**
 * TIMFaceElem
 */
class Face implements JsonSerializable
{
    /**
     * [MSGTYPE 消息类型]
     * @var string
     */
    const MSGTYPE = 'TIMFaceElem';

    /**
     * [$Index 索引]
     * @var int
     */
    protected $Index;

    /**
     * [$Data 额外数据]
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
                'Index' => $this->Index,
                'Data' => $this->Data
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

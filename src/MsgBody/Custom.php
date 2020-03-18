<?php
namespace luoyy\Tim\MsgBody;

use JsonSerializable;

/**
 * TIMCustomElem
 */
class Custom implements JsonSerializable
{
    /**
     * [MSGTYPE 消息类型]
     * @var string
     */
    const MSGTYPE = 'TIMCustomElem';

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

    /**
     * [$Desc 描述]
     * @var string
     */
    protected $Desc = '';

    /**
     * [$Ext 扩展字段。当接收方为 iOS 系统且应用处在后台时，此字段作为 APNs 请求包 Payloads 中的 Ext 键值下发，Ext 的协议格式由业务方确定，APNs 只做透传。]
     * @var string
     */
    protected $Ext = '';

    /**
     * [$Sound 自定义 APNs 推送铃音。]
     * @var string
     */
    protected $Sound = '';

    public function __construct(string $data = '', string $desc = '', string $ext = '', string $sound = '')
    {
        $this->Data = $data;
        $this->Desc = $desc;
        $this->Ext = $ext;
        $this->Sound = $sound;
    }

    public function setData(string $data)
    {
        $this->Data = $data;

        return $this;
    }

    public function setDesc(string $desc)
    {
        $this->Desc = $desc;

        return $this;
    }

    public function setExt(string $ext)
    {
        $this->Ext = $ext;

        return $this;
    }

    public function setSound(string $sound)
    {
        $this->Sound = $sound;

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
                "Data" => $this->Data,
                "Desc" => $this->Desc,
                "Ext" => $this->Ext,
                "Sound" => $this->Sound
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

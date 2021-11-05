<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMCustomElem.
 */
class Custom extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMCustomElem';

    /**
     * 额外数据.
     * @var string
     */
    protected $Data = '';

    /**
     * 描述.
     * @var string
     */
    protected $Desc = '';

    /**
     * 扩展字段。当接收方为 iOS 系统且应用处在后台时，此字段作为 APNs 请求包 Payloads 中的 Ext 键值下发，Ext 的协议格式由业务方确定，APNs 只做透传.
     * @var string
     */
    protected $Ext = '';

    /**
     * 自定义 APNs 推送铃音.
     * @var string
     */
    protected $Sound = '';

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $data 额外数据
     * @param string $desc 描述
     * @param string $ext 扩展字段。当接收方为 iOS 系统且应用处在后台时，此字段作为 APNs 请求包 Payloads 中的 Ext 键值下发，Ext 的协议格式由业务方确定，APNs 只做透传.
     * @param string $sound 自定义 APNs 推送铃音
     */
    public function __construct(string $data = '', string $desc = '', string $ext = '', string $sound = '')
    {
        $this->Data = $data;
        $this->Desc = $desc;
        $this->Ext = $ext;
        $this->Sound = $sound;
    }

    /**
     * 额外数据.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setData(string $data)
    {
        $this->Data = $data;

        return $this;
    }

    /**
     * 描述.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setDesc(string $desc)
    {
        $this->Desc = $desc;

        return $this;
    }

    /**
     * 扩展字段。当接收方为 iOS 系统且应用处在后台时，此字段作为 APNs 请求包 Payloads 中的 Ext 键值下发，Ext 的协议格式由业务方确定，APNs 只做透传.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setExt(string $ext)
    {
        $this->Ext = $ext;

        return $this;
    }

    /**
     * 自定义 APNs 推送铃音.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setSound(string $sound)
    {
        $this->Sound = $sound;

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
                'Data' => $this->Data,
                'Desc' => $this->Desc,
                'Ext' => $this->Ext,
                'Sound' => $this->Sound,
            ],
        ];
    }
}

<?php

namespace luoyy\Tim\Support;

use JsonSerializable;
use luoyy\Tim\Contracts\Support\Arrayable;
use luoyy\Tim\Contracts\Support\Jsonable;
use luoyy\Tim\Contracts\Support\Renderable;

/**
 * OfflinePushInfo.
 */
class OfflinePushInfo implements JsonSerializable, Arrayable, Renderable, Jsonable
{
    /**
     * 0表示推送，1表示不离线推送.
     * @var int
     */
    protected $PushFlag = 0;

    /**
     * 离线推送标题。该字段为 iOS 和 Android 共用.
     * @var string
     */
    protected $Title = '';

    /**
     * 离线推送内容。该字段会覆盖上面各种消息元素 TIMMsgElement 的离线推送展示文本。 若发送的消息只有一个 TIMCustomElem 自定义消息元素，该 Desc 字段会覆盖 TIMCustomElem 中的 Desc 字段。如果两个 Desc 字段都不填，将收不到该自定义消息的离线推送
     * @var string
     */
    protected $Desc = '';

    /**
     * 离线推送透传内容.
     * @var string
     */
    protected $Ext = '';

    /**
     * Android 离线推送声音文件路径.
     * @var string
     */
    protected $AndroidInfoSound = '';

    /**
     * OPPO 手机 Android 8.0 以上的 NotificationChannel 通知适配字段.
     * @var string
     */
    protected $AndroidInfoOPPOChannelID = '';

    /**
     * Ios 离线推送声音文件路径.
     * @var string
     */
    protected $ApnsInfoSound = '';

    /**
     * 这个字段缺省或者为0表示需要计数，为1表示本条消息不需要计数，即右上角图标数字不增加.
     * @var int
     */
    protected $ApnsInfoBadgeMode = 0;

    /**
     * 该字段用于标识 APNs 推送的标题，若填写则会覆盖最上层 Title.
     * @var string
     */
    protected $ApnsInfoTitle = '';

    /**
     * 该字段用于标识 APNs 推送的子标题.
     * @var string
     */
    protected $ApnsInfoSubTitle = '';

    /**
     * 该字段用于标识 APNs 携带的图片地址，当客户端拿到该字段时，可以通过下载图片资源的方式将图片展示在弹窗上.
     * @var string
     */
    protected $ApnsInfoImage = '';

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param int $push_flag 0表示推送，1表示不离线推送.
     * @param string $title 离线推送标题。该字段为 iOS 和 Android 共用.
     * @param string $desc 离线推送内容。该字段会覆盖上面各种消息元素 TIMMsgElement 的离线推送展示文本。 若发送的消息只有一个 TIMCustomElem 自定义消息元素，该 Desc 字段会覆盖 TIMCustomElem 中的 Desc 字段。如果两个 Desc 字段都不填，将收不到该自定义消息的离线推送
     * @param string $ext 离线推送透传内容.
     * @param string $android_info_sound Android 离线推送声音文件路径.
     * @param string $android_info_oppo_channel_id OPPO 手机 Android 8.0 以上的 NotificationChannel 通知适配字段.
     * @param string $apns_info_sound Ios 离线推送声音文件路径.
     * @param int $apns_info_badge_mode 这个字段缺省或者为0表示需要计数，为1表示本条消息不需要计数，即右上角图标数字不增加.
     * @param string $apns_info_title 该字段用于标识 APNs 推送的标题，若填写则会覆盖最上层 Title.
     * @param string $apns_info_sub_title 该字段用于标识 APNs 推送的子标题.
     * @param string $apns_info_image 该字段用于标识 APNs 携带的图片地址，当客户端拿到该字段时，可以通过下载图片资源的方式将图片展示在弹窗上.
     */
    public function __construct(
        int $push_flag = 0,
        string $title = '',
        string $desc = '',
        string $ext = '',
        string $android_info_sound = '',
        string $android_info_oppo_channel_id = '',
        string $apns_info_sound = '',
        int $apns_info_badge_mode = 0,
        string $apns_info_title = '',
        string $apns_info_sub_title = '',
        string $apns_info_image = ''
    ) {
        $this->PushFlag = $push_flag;
        $this->Title = $title;
        $this->Desc = $desc;
        $this->Ext = $ext;
        $this->AndroidInfoSound = $android_info_sound;
        $this->AndroidInfoOPPOChannelID = $android_info_oppo_channel_id;
        $this->ApnsInfoSound = $apns_info_sound;
        $this->ApnsInfoBadgeMode = $apns_info_badge_mode;
        $this->ApnsInfoTitle = $apns_info_title;
        $this->ApnsInfoSubTitle = $apns_info_sub_title;
        $this->ApnsInfoImage = $apns_info_image;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->render();
    }

    public function setPushFlag(int $push_flag)
    {
        $this->PushFlag = $push_flag;

        return $this;
    }

    public function setTitle(string $title)
    {
        $this->Title = $title;

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

    public function setAndroidInfoSound(string $android_info_sound)
    {
        $this->AndroidInfoSound = $android_info_sound;

        return $this;
    }

    public function setAndroidInfoOPPOChannelID(string $android_info_oppo_channel_id)
    {
        $this->AndroidInfoOPPOChannelID = $android_info_oppo_channel_id;

        return $this;
    }

    public function setApnsInfoSound(string $apns_info_sound)
    {
        $this->ApnsInfoSound = $apns_info_sound;

        return $this;
    }

    public function setApnsInfoBadgeMode(int $apns_info_badge_mode)
    {
        $this->ApnsInfoBadgeMode = $apns_info_badge_mode;

        return $this;
    }

    public function setApnsInfoTitle(string $apns_info_title)
    {
        $this->ApnsInfoTitle = $apns_info_title;

        return $this;
    }

    public function setApnsInfoSubTitle(string $apns_info_sub_title)
    {
        $this->ApnsInfoSubTitle = $apns_info_sub_title;

        return $this;
    }

    public function setApnsInfoImage(string $apns_info_image)
    {
        $this->ApnsInfoImage = $apns_info_image;

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
            'PushFlag' => $this->PushFlag,
            'Title' => $this->Title,
            'Desc' => $this->Desc,
            'Ext' => $this->Ext,
            'AndroidInfo' => [
                'Sound' => $this->AndroidInfoSound,
                'OPPOChannelID' => $this->AndroidInfoOPPOChannelID,
            ],
            'ApnsInfo' => [
                'Sound' => $this->ApnsInfoSound,
                'BadgeMode' => $this->ApnsInfoBadgeMode,
                'Title' => $this->ApnsInfoTitle,
                'SubTitle' => $this->ApnsInfoSubTitle,
                'Image' => $this->ApnsInfoImage,
            ],
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
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}

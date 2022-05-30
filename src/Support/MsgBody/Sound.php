<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMSoundElem.
 */
class Sound extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMSoundElem';

    /**
     * 语音下载地址，可通过该 URL 地址直接下载相应语音.
     * @var string
     */
    protected $Url = '';

    /**
     * 语音的唯一标识，客户端用于索引语音的键值.
     * @var string
     */
    protected $UUID = '';

    /**
     * 语音数据大小，单位：字节.
     * @var int
     */
    protected $Size = 0;

    /**
     * 语音时长，单位：秒.
     * @var int
     */
    protected $Second = 0;

    /**
     * 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音.
     * @var int
     */
    protected $Download_Flag = 2;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $url 语音下载地址，可通过该 URL 地址直接下载相应语音
     * @param string $uuid 语音的唯一标识，客户端用于索引语音的键值
     * @param int $size 语音数据大小，单位：字节
     * @param int $second 语音时长，单位：秒
     * @param int $download_flag 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音。
     */
    public function __construct(string $url, string $uuid, int $size, int $second, int $download_flag = 2)
    {
        $this->Url = $url;
        $this->UUID = $uuid;
        $this->Size = $size;
        $this->Second = $second;
        $this->Download_Flag = $download_flag;
    }

    /**
     * 消息数据部分.
     * @copyright (c) zishang520 All Rights Reserved
     */

    /**
     * 语音下载地址，可通过该 URL 地址直接下载相应语音.
     */
    public function SetUrl(string $url)
    {
        $this->Url = $url;

        return $this;
    }

    /**
     * 语音的唯一标识，客户端用于索引语音的键值.
     */
    public function SetUUID(string $uuid)
    {
        $this->UUID = $uuid;

        return $this;
    }

    /**
     * 语音数据大小，单位：字节.
     */
    public function SetSize(int $size)
    {
        $this->Size = $size;

        return $this;
    }

    /**
     * 语音时长，单位：秒.
     */
    public function SetSecond(int $second)
    {
        $this->Second = $second;

        return $this;
    }

    /**
     * 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音.
     */
    public function SetDownloadFlag(int $download_flag)
    {
        $this->Download_Flag = $download_flag;

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
                'Url' => $this->Url,
                'UUID' => $this->UUID,
                'Size' => $this->Size,
                'Second' => $this->Second,
                'Download_Flag' => $this->Download_Flag,
            ],
        ];
    }
}

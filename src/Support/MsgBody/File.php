<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMFileElem.
 */
class File extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMFileElem';

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
     * 文件数据大小，单位：字节。
     * @var int
     */
    protected $FileSize = 0;

    /**
     * 文件名称。
     * @var string
     */
    protected $FileName = '';

    /**
     * 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音.
     * @var int
     */
    protected $Download_Flag = 2;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $url 语音下载地址，可通过该 URL 地址直接下载相应语音
     * @param string $uuid 语音的唯一标识，客户端用于索引语音的键值
     * @param int $file_size 文件数据大小，单位：字节
     * @param string $file_name 文件名称
     * @param int $download_flag 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音。
     */
    public function __construct(string $url, string $uuid, int $file_size, string $file_name, int $download_flag = 2)
    {
        $this->Url = $url;
        $this->UUID = $uuid;
        $this->FileSize = $file_size;
        $this->FileName = $file_name;
        $this->Download_Flag = $download_flag;
    }

    /**
     * 消息数据部分.
     * @copyright (c) zishang520 All Rights Reserved
     */

    /**
     * 语音下载地址，可通过该 URL 地址直接下载相应语音.
     */
    public function setUrl(string $url)
    {
        $this->Url = $url;

        return $this;
    }

    /**
     * 语音的唯一标识，客户端用于索引语音的键值.
     */
    public function setUUID(string $uuid)
    {
        $this->UUID = $uuid;

        return $this;
    }

    /**
     * 文件数据大小，单位：字节.
     */
    public function setFileSize(int $file_size)
    {
        $this->FileSize = $file_size;

        return $this;
    }

    /**
     * 文件名称.
     */
    public function setFileName(string $file_name)
    {
        $this->FileName = $file_name;

        return $this;
    }

    /**
     * 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音.
     */
    public function setDownload_Flag(int $download_flag)
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
                'FileSize' => $this->FileSize,
                'FileName' => $this->FileName,
                'Download_Flag' => $this->Download_Flag,
            ],
        ];
    }
}

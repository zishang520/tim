<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMVideoFileElem.
 */
class VideoFile extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMVideoFileElem';

    /**
     * 视频下载地址。可通过该 URL 地址直接下载相应视频。
     * @var string
     */
    protected $VideoUrl;

    /**
     * 视频的唯一标识，客户端用于索引视频的键值。
     * @var string
     */
    protected $VideoUUID;

    /**
     * 视频数据大小，单位：字节。
     * @var int
     */
    protected $VideoSize;

    /**
     * 视频时长，单位：秒。
     * @var int
     */
    protected $VideoSecond;

    /**
     * 视频格式，例如 mp4。
     * @var string
     */
    protected $VideoFormat;

    /**
     * 视频下载方式标记。目前 VideoDownloadFlag 取值只能为2，表示可通过VideoUrl字段值的 URL 地址直接下载视频。
     * @var int
     */
    protected $VideoDownloadFlag;

    /**
     * 视频缩略图下载地址。可通过该 URL 地址直接下载相应视频缩略图。
     * @var string
     */
    protected $ThumbUrl;

    /**
     * 视频缩略图的唯一标识，客户端用于索引视频缩略图的键值。
     * @var string
     */
    protected $ThumbUUID;

    /**
     * 缩略图大小，单位：字节。
     * @var int
     */
    protected $ThumbSize;

    /**
     * 缩略图宽度，单位为像素。
     * @var int
     */
    protected $ThumbWidth;

    /**
     * 缩略图高度，单位为像素。
     * @var int
     */
    protected $ThumbHeight;

    /**
     * 缩略图格式，例如 JPG、BMP 等。
     * @var string
     */
    protected $ThumbFormat;

    /**
     * 视频缩略图下载方式标记。目前 ThumbDownloadFlag 取值只能为2，表示可通过ThumbUrl字段值的 URL 地址直接下载视频缩略图。
     * @var int
     */
    protected $ThumbDownloadFlag;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function __construct(
        string $video_url,
        string $video_uuid,
        int $video_size,
        int $video_second,
        string $video_format,
        int $video_download_flag,
        string $thumb_url,
        string $thumb_uuid,
        int $thumb_size,
        int $thumb_width,
        int $thumb_height,
        string $thumb_format,
        int $thumb_download_flag,
    ) {
        $this->VideoUrl = $video_url;
        $this->VideoUUID = $video_uuid;
        $this->VideoSize = $video_size;
        $this->VideoSecond = $video_second;
        $this->VideoFormat = $video_format;
        $this->VideoDownloadFlag = $video_download_flag;
        $this->ThumbUrl = $thumb_url;
        $this->ThumbUUID = $thumb_uuid;
        $this->ThumbSize = $thumb_size;
        $this->ThumbWidth = $thumb_width;
        $this->ThumbHeight = $thumb_height;
        $this->ThumbFormat = $thumb_format;
        $this->ThumbDownloadFlag = $thumb_download_flag;
    }

    /**
     * 消息数据部分.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function type()
    {
        return self::MSGTYPE;
    }

    /**
     * 视频下载地址。可通过该 URL 地址直接下载相应视频。
     */
    public function setVideoUrl(string $video_url)
    {
        $this->VideoUrl = $video_url;
        return $this;
    }

    /**
     * 视频的唯一标识，客户端用于索引视频的键值。
     */
    public function setVideoUUID(string $video_uuid)
    {
        $this->VideoUUID = $video_uuid;
        return $this;
    }

    /**
     * 视频数据大小，单位：字节。
     */
    public function setVideoSize(int $video_size)
    {
        $this->VideoSize = $video_size;
        return $this;
    }

    /**
     * 视频时长，单位：秒。
     */
    public function setVideoSecond(int $video_second)
    {
        $this->VideoSecond = $video_second;
        return $this;
    }

    /**
     * 视频格式，例如 mp4。
     */
    public function setVideoFormat(string $video_format)
    {
        $this->VideoFormat = $video_format;
        return $this;
    }

    /**
     * 视频下载方式标记。目前 VideoDownloadFlag 取值只能为2，表示可通过VideoUrl字段值的 URL 地址直接下载视频。
     */
    public function setVideoDownloadFlag(int $video_download_flag)
    {
        $this->VideoDownloadFlag = $video_download_flag;
        return $this;
    }

    /**
     * 视频缩略图下载地址。可通过该 URL 地址直接下载相应视频缩略图。
     */
    public function setThumbUrl(string $thumb_url)
    {
        $this->ThumbUrl = $thumb_url;
        return $this;
    }

    /**
     * 视频缩略图的唯一标识，客户端用于索引视频缩略图的键值。
     */
    public function setThumbUUID(string $thumb_uuid)
    {
        $this->ThumbUUID = $thumb_uuid;
        return $this;
    }

    /**
     * 缩略图大小，单位：字节。
     */
    public function setThumbSize(int $thumb_size)
    {
        $this->ThumbSize = $thumb_size;
        return $this;
    }

    /**
     * 缩略图宽度，单位为像素。
     */
    public function setThumbWidth(int $thumb_width)
    {
        $this->ThumbWidth = $thumb_width;
        return $this;
    }

    /**
     * 缩略图高度，单位为像素。
     */
    public function setThumbHeight(int $thumb_height)
    {
        $this->ThumbHeight = $thumb_height;
        return $this;
    }

    /**
     * 缩略图格式，例如 JPG、BMP 等。
     */
    public function setThumbFormat(string $thumb_format)
    {
        $this->ThumbFormat = $thumb_format;
        return $this;
    }

    /**
     * 视频缩略图下载方式标记。目前 ThumbDownloadFlag 取值只能为2，表示可通过ThumbUrl字段值的 URL 地址直接下载视频缩略图。
     */
    public function setThumbDownloadFlag(int $thumb_download_flag)
    {
        $this->ThumbDownloadFlag = $thumb_download_flag;
        return $this;
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
                'VideoUrl' => $this->VideoUrl,
                'VideoUUID' => $this->VideoUUID,
                'VideoSize' => $this->VideoSize,
                'VideoSecond' => $this->VideoSecond,
                'VideoFormat' => $this->VideoFormat,
                'VideoDownloadFlag' => $this->VideoDownloadFlag,
                'ThumbUrl' => $this->ThumbUrl,
                'ThumbUUID' => $this->ThumbUUID,
                'ThumbSize' => $this->ThumbSize,
                'ThumbWidth' => $this->ThumbWidth,
                'ThumbHeight' => $this->ThumbHeight,
                'ThumbFormat' => $this->ThumbFormat,
                'ThumbDownloadFlag' => $this->ThumbDownloadFlag,
            ],
        ];
    }
}

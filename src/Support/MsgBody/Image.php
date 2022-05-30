<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;
use luoyy\Tim\Support\ImageInfo;

/**
 * TIMImageElem.
 */
class Image extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMImageElem';

    /**
     * 图片的唯一标识，客户端用于索引图片的键值.
     * @var string
     */
    protected $UUID = '';

    /**
     * 图片格式。JPG = 1，GIF = 2，PNG = 3，BMP = 4，其他 = 255。
     * @var int
     */
    protected $ImageFormat = 0xFF;

    /**
     * 原图、缩略图或者大图下载信息。
     * @var array<int, ImageInfo>
     */
    protected $ImageInfoArray = [];

    /**
     * @param string $uuid 图片的唯一标识，客户端用于索引图片的键值
     * @param int $image_format 图片格式。JPG = 1，GIF = 2，PNG = 3，BMP = 4，其他 = 255。
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function __construct(string $uuid, int $image_format, ImageInfo ...$image_info_array)
    {
        $this->UUID = $uuid;
        $this->ImageFormat = $image_format;
        $this->ImageInfoArray = $image_info_array;
    }

    /**
     * 消息数据部分.
     * @copyright (c) zishang520 All Rights Reserved
     */

    /**
     * 图片的唯一标识，客户端用于索引图片的键值.
     */
    public function setUUID(string $uuid)
    {
        $this->UUID = $uuid;
        return $this;
    }

    /**
     * 图片格式。JPG = 1，GIF = 2，PNG = 3，BMP = 4，其他 = 255。
     */
    public function setImageFormat(int $image_format)
    {
        $this->ImageFormat = $image_format;
        return $this;
    }

    /**
     * 原图、缩略图或者大图下载信息。
     */
    public function setImageInfoArray(ImageInfo ...$image_info_array)
    {
        $this->ImageInfoArray = $image_info_array;
        return $this;
    }

    public function addImageInfoArray(ImageInfo ...$image_info_array)
    {
        $this->ImageInfoArray = $this->ImageInfoArray + $image_info_array;
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
                'UUID' => $this->UUID,
                'ImageFormat' => $this->ImageFormat,
                'ImageInfoArray' => $this->ImageInfoArray,
            ],
        ];
    }
}

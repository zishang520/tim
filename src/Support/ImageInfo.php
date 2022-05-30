<?php

namespace luoyy\Tim\Support;

use JsonSerializable;
use luoyy\Tim\Contracts\Support\Arrayable;
use luoyy\Tim\Contracts\Support\Jsonable;
use luoyy\Tim\Contracts\Support\Renderable;

/**
 * ImageInfo.
 */
class ImageInfo implements JsonSerializable, Arrayable, Renderable, Jsonable
{
    /**
     * 图片类型： 1-原图，2-大图，3-缩略图。
     * @var int
     */
    protected $Type;

    /**
     * 图片数据大小，单位：字节。
     * @var int
     */
    protected $Size;

    /**
     * 图片宽度，单位为像素。
     * @var int
     */
    protected $Width;

    /**
     * 图片高度，单位为像素。
     * @var int
     */
    protected $Height;

    /**
     * 图片下载地址。
     * @var string
     */
    protected $URL;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $to_account 目标用户帐号
     * @param array<int, string> $tags 标签集合
     */
    public function __construct(int $type, int $size, int $width, int $height, string $url)
    {
        $this->Type = $type;
        $this->Size = $size;
        $this->Width = $width;
        $this->Height = $height;
        $this->URL = $url;
    }

    /**
     * @return mixed
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * 图片类型： 1-原图，2-大图，3-缩略图。
     */
    public function setType(int $type)
    {
        $this->Type = $type;
        return $this;
    }

    /**
     * 图片数据大小，单位：字节。
     */
    public function setSize(int $size)
    {
        $this->Size = $size;
        return $this;
    }

    /**
     * 图片宽度，单位为像素。
     */
    public function setWidth(int $width)
    {
        $this->Width = $width;
        return $this;
    }

    /**
     * 图片高度，单位为像素。
     */
    public function setHeight(int $height)
    {
        $this->Height = $height;
        return $this;
    }

    /**
     * 图片下载地址。
     */
    public function setURL(string $url)
    {
        $this->URL = $url;
        return $this;
    }

    /**
     * Convert the fluent instance to an array.
     */
    public function toArray(): array
    {
        return [
            'Type' => $this->Type,
            'Size' => $this->Size,
            'Width' => $this->Width,
            'Height' => $this->Height,
            'URL' => $this->URL,
        ];
    }

    /**
     * Convert the object into something JSON serializable.
     */
    public function jsonSerialize(): array
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

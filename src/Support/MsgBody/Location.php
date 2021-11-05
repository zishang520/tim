<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMLocationElem.
 */
class Location extends Elem
{
    /**
     * 消息类型.
     * @var string
     */
    public const MSGTYPE = 'TIMLocationElem';

    /**
     * 经纬度描述.
     * @var string
     */
    protected $Desc = '';

    /**
     * 纬度.
     * @var float
     */
    protected $Latitude;

    /**
     * 经度.
     * @var float
     */
    protected $Longitude;

    /**
     * @copyright (c) zishang520 All Rights Reserved
     * @param float|null $longitude 经度
     * @param float|null $latitude 纬度
     * @param string $desc 经纬度描述
     */
    public function __construct(float $longitude = null, float $latitude = null, string $desc = '')
    {
        $this->Desc = $desc;
        $this->Latitude = $latitude;
        $this->Longitude = $longitude;
    }

    /**
     * 经纬度描述.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setDesc(string $desc)
    {
        $this->Desc = $desc;

        return $this;
    }

    /**
     * 纬度.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setLatitude(float $latitude)
    {
        $this->Latitude = $latitude;

        return $this;
    }

    /**
     * 经度.
     * @copyright (c) zishang520 All Rights Reserved
     */
    public function setLongitude(float $longitude)
    {
        $this->Longitude = $longitude;

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
                'Desc' => $this->Desc,
                'Latitude' => $this->Latitude,
                'Longitude' => $this->Longitude,
            ],
        ];
    }
}

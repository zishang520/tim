<?php

namespace luoyy\Tim\Support\MsgBody;

use luoyy\Tim\Contracts\Elem;

/**
 * TIMLocationElem.
 */
class Location extends Elem
{
    /**
     * [MSGTYPE 消息类型].
     * @var string
     */
    public const MSGTYPE = 'TIMLocationElem';

    /**
     * [$Desc 经纬度描述].
     * @var string
     */
    protected $Desc = '';

    /**
     * [$Latitude 纬度].
     * @var float
     */
    protected $Latitude;

    /**
     * [$Longitude 经度].
     * @var float
     */
    protected $Longitude;

    public function __construct(float $longitude = null, float $latitude = null, string $desc = '')
    {
        $this->Desc = $desc;
        $this->Latitude = $latitude;
        $this->Longitude = $longitude;
    }

    public function setDesc(string $desc)
    {
        $this->Desc = $desc;

        return $this;
    }

    public function setLatitude(float $latitude)
    {
        $this->Latitude = $latitude;

        return $this;
    }

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

<?php
namespace luoyy\Tim\MsgBody;

use JsonSerializable;

/**
 * TIMLocationElem
 */
class Location implements JsonSerializable
{
    /**
     * [MSGTYPE 消息类型]
     * @var string
     */
    const MSGTYPE = 'TIMLocationElem';

    /**
     * [$Desc 经纬度描述]
     * @var string
     */
    protected $Desc = '';

    /**
     * [$Latitude 纬度]
     * @var float
     */
    protected $Latitude;

    /**
     * [$Longitude 经度]
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
                "Desc" => $this->Desc,
                "Latitude" => $this->Latitude,
                "Longitude" => $this->Longitude
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

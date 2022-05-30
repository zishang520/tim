<?php

namespace luoyy\Tim;

use Exception;
use GuzzleHttp\Client;
use League\Flysystem\Config;

/**
 * Tim REST API.
 */
class Tim
{
    // 开放IM https接口参数, 一般不需要修改
    public const API_URL = 'https://console.tim.qq.com';

    public const METHOD = 'POST';

    public const VER = 'v4';

    public const CONTENTTYPE = 'json';

    // app基本信息
    protected $config = null;

    /**
     * TLSSig.
     * @var \luoyy\Tim\TLSSigAPI|\luoyy\Tim\TLSSigAPIv2
     */
    protected $TLS = null;

    protected $errMsg = '';

    protected $errCode = 0;

    protected $msg_random = null;

    public function __construct($options = [])
    {
        $this->config = new Config($options);
    }

    /**
     * 获取签名.
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T14:09:21+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param string $identifier 用户名，调用 REST API 时必须为 App 管理员帐号
     * @param int|int $expires 过期时间
     * @return string 生成的token
     */
    public function genSig(string $identifier, int $expires = 86400): string
    {
        return $this->TLSinit()->genSig($identifier, $expires);
    }

    /**
     * 获取管理员账户.
     * @Author    zishang520
     * @DateTime  2020-03-17T18:21:33+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @return string [管理员账户]
     */
    public function identifier()
    {
        return $this->config->get('identifier');
    }

    /**
     * 获取错误信息.
     * @Author    zishang520
     * @DateTime  2020-03-17T18:22:13+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @return mixed [错误内容]
     */
    public function errMsg()
    {
        try {
            return $this->errMsg;
        } finally {
            // 防止重复使用
            $this->errMsg = '';
        }
    }

    /**
     * 获取错误Code.
     * @Author    zishang520
     * @DateTime  2020-03-17T18:22:38+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @return mixed [code值]
     */
    public function errCode()
    {
        try {
            return $this->errCode;
        } finally {
            // 防止重复使用
            $this->errCode = 0;
        }
    }

    /**
     * 是否广播大群.
     * @Author    zishang520
     * @DateTime  2020-05-09T11:29:00+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $type 直播类型
     */
    public function isBChatRoom(string $type): bool
    {
        return strcmp($type, 'BChatRoom') === 0;
    }

    /**
     * 是否音视频聊天室.
     * @Author    zishang520
     * @DateTime  2020-05-09T11:29:12+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $type 直播类型
     */
    public function isAVChatRoom(string $type): bool
    {
        return strcmp($type, 'AVChatRoom') === 0;
    }

    /**
     * 是否聊天室.
     * @Author    zishang520
     * @DateTime  2020-05-09T11:29:49+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $type 直播类型
     */
    public function isChatRoom(string $type): bool
    {
        return strcmp($type, 'ChatRoom') === 0;
    }

    /**
     * 是否公开群.
     * @Author    zishang520
     * @DateTime  2020-05-09T11:30:01+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $type 直播类型
     */
    public function isPublicRoom(string $type): bool
    {
        return strcmp($type, 'Public') === 0;
    }

    /**
     * 是否私有群.
     * @Author    zishang520
     * @DateTime  2020-05-09T11:30:12+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $type 直播类型
     */
    public function isPrivateRoom(string $type): bool
    {
        return strcmp($type, 'Private') === 0;
    }

    /**
     * 设置某些接口需要的MsgRandom，不设置则是随机.
     * @Author    zishang520
     * @DateTime  2020-12-23T17:42:35+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @param int $msg_random 随机数0~0xFFFFFFFF
     */
    public function setMsgRandom(int $msg_random)
    {
        $this->msg_random = $msg_random;

        return $this;
    }

    /**
     * APi.
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T14:41:44+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param string $servicename 内部服务名，不同的 servicename 对应不同的服务类型
     * @param string $command 命令字，与 servicename 组合用来标识具体的业务功能
     * @param array $data 请求包体
     * @return mixed [返回数据]
     */
    public function api(string $servicename, string $command, array $data)
    {
        $querystring = http_build_query([
            'sdkappid' => $this->config->get('sdkappid'),
            'identifier' => $this->config->get('identifier'),
            'usersig' => $this->genSig($this->config->get('identifier')),
            'random' => $this->getMsgRandom(),
            'contenttype' => self::CONTENTTYPE,
        ]);

        try {
            $_data = (string) (new Client())->request(self::METHOD, sprintf('%s/%s/%s/%s?%s', self::API_URL, self::VER, $servicename, $command, $querystring), [
                'headers' => [
                    'pragma' => 'no-cache',
                    'cache-control' => 'no-cache',
                    'upgrade-insecure-requests' => '1',
                    'dnt' => '1',
                    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 Safari/537.36',
                    'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                    'accept-encoding' => 'gzip, deflate',
                    'accept-language' => 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
                ],
                'json' => array_filter($data, function ($v) {
                    return !is_null($v);
                }),
            ])->getBody();
            if (!empty($_data) && !empty($body = json_decode($_data))) {
                if (!empty($body->ErrorCode) || !isset($body->ActionStatus) || (strtolower($body->ActionStatus) !== 'ok')) {
                    $this->errMsg = $body->ErrorInfo ?? '请求失败';
                    $this->errCode = $body->ErrorCode ?? -1;
                    return false;
                }
                return $body;
            }
            $this->errMsg = -1;
            $this->errCode = '请求失败';
            return false;
        } catch (Exception $e) {
            $this->errMsg = $e->getMessage();
            $this->errCode = $e->getCode();
            return false;
        } finally {
            // 防止重复使用
            $this->msg_random = null;
        }
    }

    /**
     * 初始化Tls组件.
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T14:40:35+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @return \luoyy\Tim\TLSSigAPI|\luoyy\Tim\TLSSigAPIv2 TLSSig
     */
    protected function TLSinit()
    {
        if (is_null($this->TLS)) {
            switch ($this->config->get('tls')) {
                case 'v1':
                    $this->TLS = new TLSSigAPI($this->config->get('sdkappid'), sprintf("-----BEGIN PRIVATE KEY-----\n%s\n-----END PRIVATE KEY-----\n", wordwrap($this->config->get('private_key'), 64, "\n", true)), sprintf("-----BEGIN PUBLIC KEY-----\n%s\n-----END PUBLIC KEY-----\n", wordwrap($this->config->get('public_key'), 64, "\n", true)));
                    break;
                case 'v2':
                default:
                    $this->TLS = new TLSSigAPIv2($this->config->get('sdkappid'), $this->config->get('secret_key'));
                    break;
            }
        }
        return $this->TLS;
    }

    /**
     * 获取随机数.
     * @Author    zishang520
     * @DateTime  2020-12-23T17:43:26+0800
     * @copyright (c) zishang520 All Rights Reserved
     * @return int [随机数0~0xFFFFFFFF]
     */
    protected function getMsgRandom(): int
    {
        try {
            return ($this->msg_random ?? mt_rand(0, mt_getrandmax())) % 0xFFFFFFFF;
        } finally {
            // 防止重复使用
            $this->msg_random = null;
        }
    }
}

<?php
namespace luoyy\Tim;

use Exception;
use GuzzleHttp\Client;
use League\Flysystem\Config;
use luoyy\Tim\TLSSigAPI;
use luoyy\Tim\TLSSigAPIv2;

/**
 * Tim REST API
 */
class Tim
{
    // 开放IM https接口参数, 一般不需要修改
    const API_URL = 'https://console.tim.qq.com';
    const METHOD = 'POST';
    const VER = 'v4';
    const CONTENTTYPE = 'json';

    // app基本信息
    protected $config = null;

    protected static $TLS = null;

    protected $errMsg = '';
    protected $errCode = 0;

    public function __construct($options = [])
    {
        $this->config = new Config($options);
    }

    /**
     * [TLSinit 初始化Tls组件]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T14:40:35+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     */
    protected function TLSinit()
    {
        if (is_null(self::$TLS)) {
            switch ($this->config->get('tls')) {
                case 'v1':
                    self::$TLS = new TLSSigAPI($this->config->get('sdkappid'), sprintf("-----BEGIN PUBLIC KEY-----\n%s\n-----END PUBLIC KEY-----", wordwrap($this->config->get('public_key'), 64, "\n", true)), sprintf("-----BEGIN RSA PRIVATE KEY-----\n%s\n-----END PRIVATE KEY-----", wordwrap($this->config->get('private_key'), 64, "\n", true)));
                    break;
                case 'v2':
                default:
                    self::$TLS = new TLSSigAPIv2($this->config->get('sdkappid'), $this->config->get('secret_key'));
                    break;
            }
        }
        return self::$TLS;
    }

    /**
     * [genSig 获取签名]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T14:09:21+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $identifier [用户名，调用 REST API 时必须为 App 管理员帐号]
     * @param     int|integer $expires [过期时间]
     * @return    [type] [description]
     */
    public function genSig(string $identifier, int $expires = 60): string
    {
        return $this->TLSinit()->genSig($identifier, $expires);
    }

    public function identifier()
    {
        return $this->config->get('identifier');
    }

    public function errMsg()
    {
        return $this->errMsg;
    }

    public function errCode()
    {
        return $this->errCode;
    }

    /**
     * [api APi]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T14:41:44+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     [type] $servicename [内部服务名，不同的 servicename 对应不同的服务类型]
     * @param     [type] $command [命令字，与 servicename 组合用来标识具体的业务功能]
     * @param     [type] $data [请求包体]
     * @return    [type] [description]
     */
    public function api($servicename, $command, array $data)
    {
        $querystring = http_build_query([
            'sdkappid' => $this->config->get('sdkappid'),
            'identifier' => $this->config->get('identifier'),
            'usersig' => $this->genSig($this->config->get('identifier')),
            'random' => mt_rand(0, 4294967295),
            'contenttype' => self::CONTENTTYPE
        ]);

        try {
            $body = (string) (new Client())->request(self::METHOD, sprintf('%s/%s/%s/%s?%s', self::API_URL, self::VER, $servicename, $command, $querystring), [
                'headers' => [
                    'pragma' => 'no-cache',
                    'cache-control' => 'no-cache',
                    'upgrade-insecure-requests' => '1',
                    'dnt' => '1',
                    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 Safari/537.36',
                    'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                    'accept-encoding' => 'gzip, deflate',
                    'accept-language' => 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7'
                ],
                'json' => array_filter($data, function ($v) {
                    return !is_null($v);
                })
            ])->getBody();
            if (!empty($body) && !empty($body = json_decode($body))) {
                if (!empty($body->ErrorCode)) {
                    $this->errMsg = $body->ErrorInfo;
                    $this->errCode = $body->ErrorCode;
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
        }
    }
}

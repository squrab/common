<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/7/5
 * Time: 13:37
 */

namespace SquRab\Common\Services;

use GuzzleHttp\Client;
use SquRab\Common\Exception\ErrorException;

class BaiDu
{
    private $cache_key = 'baidu_image_discern';
    private $secret;
    private $base_url = [
        'token' => 'https://aip.baidubce.com/oauth/2.0/token',
        'id_card' => 'https://aip.baidubce.com/rest/2.0/ocr/v1/idcard'
    ];
    private static $http;

    /**
     * 百度文字识别
     * BaiDu constructor.
     * @throws ErrorException
     */
    public function __construct()
    {
        $redis = (new Redis())::connection();
        self::$http = new Client();
        if ($redis->exists($this->cache_key) === 0) {
            $result = self::$http->post($this->base_url['token'], [
                'query' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('squrab.baidu.key'),
                    'client_secret' => config('squrab.baidu.secret')
                ]
            ]);
            if ($result->getStatusCode() === 200) {
                $array = json_decode($result->getBody()->getContents(), true);
                $cache_bool = $redis->setex($this->cache_key, $array['expires_in'], $array['access_token']);
                if ($cache_bool)
                    $this->secret = $array['access_token'];
                else {
                    throw new ErrorException('cache error');
                }
            } else {
                throw new ErrorException($result->getReasonPhrase());
            }
        } else {
            $this->secret = $redis->get($this->cache_key);
        }

    }

    /**
     * 身份证
     * @param string $filepath
     * @return bool|mixed
     */
    public function idCard(string $filepath)
    {
        $result = self::$http->post($this->base_url['id_card'], [
            'query' => [
                'access_token' => $this->secret
            ],
            'form_params' => [
                'detect_risk' => 'true',
                'id_card_side' => 'front',
                'image' => base64_encode(file_get_contents($filepath)),
            ]
        ]);

        if ($result->getStatusCode() === 200) {
            return json_decode($result->getBody()->getContents(), true);
        }

        return false;
    }

    /**
     * 营业执照
     * @param string $filepath
     * @return bool|mixed
     */
    public function businessLicense(string $filepath)
    {
        $result = self::$http->post($this->base_url['id_card'], [
            'query' => [
                'access_token' => $this->secret
            ],
            'form_params' => [
                'image' => base64_encode(file_get_contents($filepath)),
            ]
        ]);

        if ($result->getStatusCode() === 200) {
            return json_decode($result->getBody()->getContents(), true);
        }

        return false;
    }
}

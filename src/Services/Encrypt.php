<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/5/23
 * Time: 13:14
 */

namespace SquRab\Common\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Encrypt
{
    private $secret;
    private $secretCacheName = 'http_encrypt_secret';
    private $config;

    public function __construct()
    {
        $redis = (new Redis())::connection();

        $this->config = config('squrab.encrypt');

        if ($redis->exists($this->secretCacheName) === 0) {
            $secret = Str::random();
            $res = $redis->setex($this->secretCacheName, $this->config['ttl'], $secret);
            if ($res)
                $this->secret = $secret;
            else {
                Log::error("存储{$this->secretCacheName}失败", [
                    'secret' => $secret
                ]);
            }
        } else {
            $this->secret = $redis->get($this->secretCacheName);
        }

    }

    //加密
    public function authEncrypt()
    {
        return openssl_encrypt($this->secret, $this->config['method'], $this->config['key'], 0, $this->config['iv']);
    }

    function check(string $token)
    {
        $secret = openssl_decrypt($token, $this->config['method'], $this->config['key'], 0, $this->config['iv']);

        return $secret === $this->secret;
    }
}

<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/5/23
 * Time: 13:14
 */

namespace SquRab\Common\Services;

use SquRab\Common\Traits\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Encrypt
{
    use Response;

    private $key;
    private $keyCacheName = 'http_encrypt_key';
    private $keyTTL = 60 * 60 * 2;
    private $localIV = 'F6$elFe5QK$!902c';
    private $encryptKey = 'K%Xn3%@3XWs1f$!uR4TxXaiVpbNUhN^K';
    private $method = 'AES-128-CBC';

    public function __construct()
    {
        $redis = new Redis();

        if ($redis->exists($this->keyCacheName) === 0) {
            $key = Str::random();
            $res = $redis->setex($this->keyCacheName, 60 * 60 * 2, $key);
            if ($res)
                $this->key = $key;
            else {
                Log::error("存储{$this->keyCacheName}失败", [
                    'key' => $key
                ]);
            }
        } else {
            $this->key = $redis->get($this->keyCacheName);
        }
    }

    //加密
    function authEncrypt()
    {
        return openssl_encrypt($this->key, $this->method, $this->encryptKey, 0, $this->localIV);
    }

    //解密
    function authDecrypt($str)
    {
        return openssl_decrypt($str, $this->method, $this->encryptKey, 0, $this->localIV);
    }
}

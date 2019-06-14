<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/5/23
 * Time: 13:14
 */

namespace SquRab\Common\Services;

class Encrypt
{
    public $key = 'J9IUC@Kd9o!mbNK1';
    private $localIV = 'F6$elFe5QK$!902c';
    private $encryptKey = 'K%Xn3%@3XWs1f$!uR4TxXaiVpbNUhN^K';
    private $method = 'AES-128-CBC';

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

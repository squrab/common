<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QiniuService
{
    private $type;
    private static $disk;

    public function __construct(string $diskType)
    {
        self::$disk = Storage::disk($diskType);
        $this->type = $diskType == 'qiniu' ? 2 : 3;
    }

    /**
     * 获取url
     * @param string $path
     * @return mixed
     */
    public function getPrivateUrl(string $path)
    {
        return self::$disk->privateDownloadUrl($path);
    }

    public function uploadFile(Request $request, string $filename)
    {
        return self::$disk->put($filename, $request->get('file'));
    }

    public function uploadFileToken($filename = null)
    {
        return self::$disk->getUploadToken($filename, 300);
    }
}

<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2018/11/24
 * Time: 15:07
 */

namespace SquRab\Models;

use SquRab\Services\QiNiu;
use Exception;

class Image extends BaseModel
{
    protected $table = 'image';

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function getImageSite(int $id)
    {
        $img = $this::query()->find($id, ['pic_path', 'small_path', 'path_type'])->toArray();
        if (empty($img))
            throw new \Exception('图片id不存在');
        switch ($img['path_type']) {
            case 1:
                unset($img['path_type']);
                return $img;
            case 2:
                return [
                    'pic_path' => config('filesystems.disks.qiniu.domain') . '/' . $img['pic_path'],
                    'small_path' => config('filesystems.disks.qiniu.domain') . '/' . $img['small_path']
                ];
            case 3:
                $qiNiu = new QiNiu('qiniu_pvt');
                return [
                    'pic_path' => $qiNiu->getPrivateUrl($img['pic_path']),
                    'small_path' => $qiNiu->getPrivateUrl($img['small_path'])
                ];
        }
        throw new Exception('获取失败');
    }
}

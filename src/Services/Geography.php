<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/7/8
 * Time: 14:54
 */

namespace SquRab\Common\Services;

class Geography
{
    private $radius = 6378.137; //赤道半径

    /**
     * 通过弧度计算两组经纬度的直线距离
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return int
     */
    function getStraightDistance($lat1, $lng1, $lat2, $lng2)
    {
        $radLat1 = deg2rad($lat1);

        $radLat2 = deg2rad($lat2);

        $radLng1 = deg2rad($lng1);

        $radLng2 = deg2rad($lng2);

        $a = $radLat1 - $radLat2;

        $b = $radLng1 - $radLng2;

        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * $this->radius;

        return intval(floor($s * 1000));
    }
}

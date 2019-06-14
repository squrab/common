<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/6/14
 * Time: 13:53
 */

namespace SquRab\Common\Services;

use Predis\Client;

class Redis
{
    public static function connection()
    {
        return new Client(config('squrab.redis'));
    }
}

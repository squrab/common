<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/7/16
 * Time: 11:55
 */

namespace SquRab\Common\Models;

/**
 * SquRab\Common\Models\DriverRealTimeLocation
 *
 * @property int $id
 * @property int $user_id 骑手id
 * @property string $lat 经度
 * @property string $lng 纬度
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SquRab\Common\Models\DriverRealTimeLocation whereUserId($value)
 * @mixin \Eloquent
 */
class DriverRealTimeLocation extends BaseModel
{
    protected $table = 'driver_real_time_location';
}

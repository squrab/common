<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/7/3
 * Time: 15:31
 */

namespace App\Models;


/**
 * App\Models\ExpressOrderReservation
 *
 * @property int $id
 * @property int $express_order_id 专送订单id
 * @property int $order_id 订单主表id
 * @property string $label 预约时间可读名称
 * @property string $reservation_at 预约时间
 * @property int $push_status 是否已推送
 * @property string|null $push_at 推送时间
 * @property string|null $push_user 已推送专送员id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation whereExpressOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation wherePushAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation wherePushStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation wherePushUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExpressOrderReservation whereReservationAt($value)
 * @mixin \Eloquent
 */
class ExpressOrderReservation extends BaseModel
{
    protected $table = 'express_order_reservation';
    public $timestamps = false;
}

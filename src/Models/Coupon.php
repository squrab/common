<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2018/11/27
 * Time: 10:28
 */

namespace SquRab\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends BaseModel
{
    use SoftDeletes;

    protected $table = 'coupon';
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];
}

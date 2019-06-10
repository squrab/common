<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/3/4
 * Time: 14:04
 */

namespace SquRab\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends BaseModel
{
    use SoftDeletes;
    protected $table = 'vehicle';
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];
    protected $hidden = ['deleted_at'];
}

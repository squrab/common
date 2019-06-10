<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/3/4
 * Time: 14:04
 */

namespace SquRab\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class SelfService extends BaseModel
{
    use SoftDeletes;
    protected $table = 'self_service';
    protected $hidden = ['deleted_at', 'updated_at'];
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];
}

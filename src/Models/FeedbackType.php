<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2018/11/30
 * Time: 20:13
 */

namespace SquRab\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackType extends BaseModel
{
    use SoftDeletes;
    protected $table = 'feedback_type';
    protected $hidden = ['deleted_at'];
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];
}

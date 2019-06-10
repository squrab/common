<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2018/11/24
 * Time: 15:07
 */

namespace SquRab\Models;

class Order extends BaseModel
{
    protected $table = 'order';
    protected $dates = ['updated_at', 'created_at', 'pay_at', 'expire_at'];
}

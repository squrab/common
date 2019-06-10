<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2018/12/11
 * Time: 10:48
 */

namespace SquRab\Models;

class FreightOrder extends BaseModel
{
    protected $table = 'freight_order';
    protected $dates = ['updated_at', 'created_at', 'complete_at'];
}

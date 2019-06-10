<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/3/4
 * Time: 14:04
 */

namespace SquRab\Models;

class UserBalanceLog extends BaseModel
{
    protected $table = 'user_balance_log';
    protected $hidden = ['updated_at', 'user_id'];
}

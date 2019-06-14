<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/3/4
 * Time: 14:04
 */

namespace SquRab\Common\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'user';
    protected $guarded = [];
    protected $hidden = ['password', 'login_token_sign', 'pay_password'];
    protected $dates = ['updated_at', 'created_at'];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

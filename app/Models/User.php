<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\Activity;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Rate;
use App\Models\Order;
use App\Models\BaseModel;

class User extends BaseModel implements
    AuthenticatableContract,
    CanResetPasswordContract,
    AuthorizableContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'is_active', 'is_admin', 
        'avatar', 'facebook_id', 'google_id', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function rules($ruleName)
    {
        if ($ruleName == 'update') {
            return [
                'name' => 'required'
            ];
        }
        
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function scopeFindUser($query, $data)
    {
        return $query->where('email', $data)
            ->orWhere('facebook_id', $data)
            ->orWhere('google_id', $data);
    }
}

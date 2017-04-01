<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\User;
use App\Models\BaseModel;

class Like extends BaseModel
{
    protected $fillable = ['user_id', 'shop_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

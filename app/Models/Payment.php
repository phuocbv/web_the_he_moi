<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\BaseModel;

class Payment extends BaseModel
{
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}

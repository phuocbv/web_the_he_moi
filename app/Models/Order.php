<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Receiver;
use App\Models\Payment;
use App\Models\BaseModel;

class Order extends BaseModel
{
    protected $table = 'orders';

    protected $fillable = ['quantity_item', 'total_discount', 'total_price', 'status', 'user_id', 'receiver_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function receiver()
    {
        return $this->hasOne(Receiver::class, 'id', 'receiver_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

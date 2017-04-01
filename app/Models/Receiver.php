<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\BaseModel;

class Receiver extends BaseModel
{
    protected $table = 'receivers';

    protected $fillable = ['name', 'address', 'phone', 'email', 'stripe_customer_id'];

    public function rules($ruleName)
    {
        return [
            'name' => 'required|string|min:2|max:32',
            'address' => 'required|string|min:2|max:32',
            'phone' => 'required|min:2|max:12',
            'email' => 'required|email'
        ];
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}

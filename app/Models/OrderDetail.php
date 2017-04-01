<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\BaseModel;

class OrderDetail extends BaseModel
{
    protected $table = 'order_details';

    protected $fillable = ['product_id', 'quantity_item', 'order_id', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

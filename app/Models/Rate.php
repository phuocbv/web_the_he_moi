<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\BaseModel;

class Rate extends BaseModel
{
    protected $fillable = ['number', 'product_id', 'user_id', 'content'];

    public function rules($ruleName)
    {
        return [
            'content' => 'required',
            'number' => 'required',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

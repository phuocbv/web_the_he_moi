<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\BaseModel;

class Image extends BaseModel
{
    protected $fillable = ['product_id', 'url'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}

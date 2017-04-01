<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;
use App\Models\Collection;
use App\Models\Image;
use App\Models\Category;
use App\Models\Shop;
use App\Models\OrderDetail;
use App\Models\BaseModel;

class Product extends BaseModel
{
    protected $fillable = ['name', 'code', 'price', 'quantity', 'discount', 
        'point_rate', 'number_rate', 'description', 'status', 'category_id', 'shop_id'];

    public function rates()
    {
        return $this->hasMany(Rate::class)->orderBy('created_at', 'desc');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'product_collections');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

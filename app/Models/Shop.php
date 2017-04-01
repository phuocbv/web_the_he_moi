<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Category;
use App\Models\BaseModel;
use App\Models\OrderDetail;

class Shop extends BaseModel
{
    protected $table = 'shops';

    protected $fillable = ['name', 'address', 'description', 'status', 'user_id', 'category_id'];

    public function rules($ruleName)
    {
        if ($ruleName == 'update') {
            $nameRules = 'required|max:50|unique:shops,name,' . $this->id;
        } else {
            $nameRules = 'required|max:50|unique:shops,name';
        }
        
        return [
            'name' => $nameRules,
            'address' => 'required',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('created_at', 'desc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function orderDetails()
    {
        return $result = $this->hasManyThrough(OrderDetail::class, Product::class,
            'shop_id', 'product_id')->orderBy('created_at', 'desc');
    }
}

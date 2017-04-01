<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\Collection;
use App\Models\Product;
use App\Models\BaseModel;

class Collection extends BaseModel
{
    protected $table = 'collections';

    protected $fillable = ['name', 'shop_id'];

    public function rules($ruleName)
    {
        if ($ruleName == 'create') {
            return [
                'name' => 'required|max:50|unique:collections,name'
            ];
        }

        return [
            'name' => 'required|max:50|unique:collections,name,' . $this->id
        ];
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_collections')
            ->orderBy('created_at', 'desc');
    }
}

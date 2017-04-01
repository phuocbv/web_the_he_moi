<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use App\Models\BaseModel;

class Category extends BaseModel
{
    protected $table = 'categories';

    protected $fillable = ['name', 'parent_id', 'sort'];

    public function rules($ruleName)
    {
        if ($ruleName == 'update') {
            $nameRules = 'required|max:50|unique:categories,name,' . $this->id;
        } else {
            $nameRules = 'required|max:50|unique:categories,name';
        }
        return [
            'name' => $nameRules,
            'sort' => 'required|numeric'
        ];
    }

    public function scopeFindCate($query, $id)
    {
        return $query->where('parent_id', $id)->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('created_at', 'desc')->with('images');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('sort', '<>', 0)->orderBy('sort', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function productsThrough($take = null)
    {
        $result = $this->hasManyThrough( Product::class, Category::class,
            'parent_id', 'category_id')->orderBy('created_at', 'desc');

        switch ($take) {
            case 'all':
                return $result;
            case null:
                return $result->limit(config('view.take-product'));
            default:
                return $result->limit($take);
        }
    }

    public function allProductsByCate()
    {
        return $result = $this->hasManyThrough( Product::class, Category::class,
            'parent_id', 'category_id')->orderBy('created_at', 'desc')->with('images');
    }
}

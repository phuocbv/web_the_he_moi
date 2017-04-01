<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ProductCollection extends BaseModel
{
    protected $fillable = ['product_id', 'collection_id'];
}
